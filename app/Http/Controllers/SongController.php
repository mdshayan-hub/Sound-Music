<?php

namespace App\Http\Controllers;

use App\Models\Song; // Import Song model
use App\Models\Album; // Import Song model
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SongController extends Controller
{
    // Show all songs
    public function index()
    {
        // Joining 'albums' table to get the title instead of album id
        $songs = Song::join('albums', 'songs.album', '=', 'albums.id')
                    ->select('songs.*', 'albums.title as album_title') // Select song fields and album title
                    ->get();
    
        return view('admin.songs.index', compact('songs'));
    }
    
    

    // Show form to create a new song
    public function create()
    {

        $albums =  Album::all();
        return view('admin.songs.create',["album"=>$albums,]); // No categories needed
    }

    // Store a new song
    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'album' => 'required|exists:albums,id',  // Assuming 'albums' table is present
            'music_type' => 'required|string|max:255',
            'music_file' => 'required|mimes:mp3,wav,flac|max:20480', // Validation for music file
            'music_cover' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation for music cover
            'year' => 'required|numeric',
            'genre' => 'required|string|max:255',
            'language' => 'required|string|max:255',
        ]);  

        
        // Handling the music file upload
        $musicPath = null;
        if ($request->hasFile('music_file')) {
            // Store the music file in the 'songs' folder within 'public/storage'
            $musicPath =   $request->music_file = $request->file('music_file')->store('songs', 'public');
        }
    
        $picturePath = null;
        if ($request->hasFile('music_cover')) {
            $picturePath = $request->file('music_cover')->store('songs', 'public'); // Save in storage/app/public/pictures
        }
    
        // Create the new song record in the database
        // Save user data in the database
        Song::create([
            'title' => $request->title,
            'album' => $request->album, // Password will be hashed in the model
            'music_type' => $request->music_type,
            'music_file' => $musicPath,
            'music_cover' => $picturePath, // Include picture path here
            'year' => $request->year,
            'genre' => $request->genre,
            'language' => $request->language

        ]);
    
        return redirect()->route('songs.index')->with('success', 'Song added successfully!');
    }

    public function show(Song $song)
    {
        // Joining 'albums' table to get the album title
        $song = Song::join('albums', 'songs.album', '=', 'albums.id')
                    ->select('songs.*', 'albums.title as album_title') // Select song fields and album title
                    ->where('songs.id', $song->id)
                    ->first(); // Fetch the specific song with album title
    
        return view('admin.songs.show', compact('song'));
    }
    
    


    // Edit song
    public function edit(Song $song)
    {
        $albums = Album::all(); // Saare albums fetch kar rahe hain
        return view('admin.songs.edit', compact('song', 'albums')); // 'albums' ko pass kar rahe hain
    }
    
    

    // Update song
    public function update(Request $request, Song $song)
    {
        // Agar naya music file upload hua ho to uska path update karein
        if ($request->hasFile('music_file')) {
            $musicPath = $request->file('music_file')->store('songs', 'public');
            $song->music_file = $musicPath;
        }
    
        // Agar nayi cover image upload hui ho to uska path update karein
        if ($request->hasFile('music_cover')) {
            $picturePath = $request->file('music_cover')->store('songs', 'public');
            $song->music_cover = $picturePath;
        }
    
        // Baaki fields ko directly update karein
        $song->update([
            'title' => $request->title,
            'album' => $request->album,
            'music_type' => $request->music_type,
            'year' => $request->year,
            'genre' => $request->genre,
            'language' => $request->language,
        ]);
    
        // User ko success message ke saath redirect karein
        return redirect()->route('songs.index')->with('success', 'Song updated successfully!');
    }
    

    // Delete song
    public function destroy(Song $song)
    {
        $song->delete();
        return redirect()->route('songs.index')->with('success', 'Song deleted successfully!');
    }

    public function streamAudio(Request $request, $filename)
    {
        $filePath = storage_path('app/public/songs/' . $filename);
        
        if (!file_exists($filePath)) {
            return response()->json(['error' => 'File not found.'], 404);
        }
    
        $size = filesize($filePath);
        $start = 0;
        $end = $size - 1;
    
        // Check if the request has a Range header
        if ($request->hasHeader('Range')) {
            preg_match('/bytes=(\d+)-(\d+)?/', $request->header('Range'), $matches);
            $start = intval($matches[1]);
            if (isset($matches[2])) {
                $end = intval($matches[2]);
            }
        }
    
        $length = ($end - $start) + 1;
    
        // Open file stream
        $stream = function () use ($filePath, $start, $length) {
            $file = fopen($filePath, 'rb');
            fseek($file, $start);
            echo fread($file, $length);
            fclose($file);
        };
    
        return response()->stream($stream, 206, [
            'Content-Type'  => 'audio/mpeg',
            'Content-Length' => $length,
            'Accept-Ranges'  => 'bytes',
            'Content-Range'  => "bytes $start-$end/$size",
        ]);
    }
}
