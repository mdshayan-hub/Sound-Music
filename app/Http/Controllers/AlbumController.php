<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    public function index()
    {
        // Joining albums and artists
        $albums = Album::join('artists', 'albums.artist_id', '=', 'artists.id')
                        ->select('albums.*', 'artists.name as artist_name') // Select columns you want
                        ->get();
    
        return view('admin.albums.index', compact('albums'));
    }
    

    public function create()
    {
        $artists = Artist::all();
        return view('admin.albums.create', compact('artists'));
    }
    

    public function store(Request $request)
    {
        $album = new Album();
        $album->title = $request->title;
        $album->album_cover = $request->album_cover;
        $album->description = $request->description;
        $album->artist_id = $request->artist_id;
    
        // Handle album cover upload (if exists)
        if ($request->hasFile('album_cover')) {
            $imagePath = $request->file('album_cover')->store('albums', 'public');
            $album->album_cover = $imagePath;
        } else {
            $album->album_cover = null; // Ensure NULL instead of empty value
        }
    
        $album->save();
    
        return redirect()->route('albums.index')->with('success', 'Album added successfully!');
    }
    

    public function show(Album $album)
    {
        return view('admin.albums.show', compact('album'));
    }

    public function edit(Album $album)
    {
        $artists = Artist::all(); // Retrieve all artists for dropdown
        return view('admin.albums.edit', compact('album', 'artists'));
    }

    public function update(Request $request, Album $album)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'artist_id' => 'required|exists:artists,id',
            'album_cover' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
    
        $album->title = $request->title;
        $album->description = $request->description;
        $album->artist_id = $request->artist_id;
    
        // **Fix: Old Image Delete Only If New Image Is Uploaded**
        if ($request->hasFile('album_cover')) {
            // Purana image delete karo
            if ($album->album_cover) {
                Storage::delete('public/' . $album->album_cover);
            }
            
            // Naya image store karo
            $imagePath = $request->file('album_cover')->store('albums', 'public');
            $album->album_cover = $imagePath;
        }
    
        // **Fix: Agar naya image nahi mila, to purana image hi rahe**
        // (Isko set karne ki zaroorat nahi, kyunki pehle se model me hai)
    
        // Save the updated album
        $album->save();
    
        return redirect()->route('albums.index')->with('success', 'Album updated successfully!');
    }
    
    
    

    public function destroy(Album $album)
    {
        $album->delete();

        return redirect()->route('albums.index')->with('success', 'Album deleted successfully!');
    }
}

