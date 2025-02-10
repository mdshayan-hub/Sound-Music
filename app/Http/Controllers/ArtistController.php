<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtistController extends Controller
{
    public function index()
    {
        $artists = Artist::all(); // Fetch all artists
        return view('admin.artists.index', compact('artists'));
    }

    public function create()
    {
        return view('admin.artists.create');
    }

    public function store(Request $request)
    {
        $data = $request->all(); // Fetch all request data

        // Image processing
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('artists', 'public'); // Save image in storage
        }

        Artist::create($data);

        return redirect()->route('artists.index')->with('success', 'Artist added successfully!');
    }

    public function show(Artist $artist)
    {
        return view('admin.artists.show', compact('artist'));
    }

    public function edit(Artist $artist)
    {
        return view('admin.artists.edit', compact('artist'));
    }

    public function update(Request $request, Artist $artist)
    {
        $data = $request->all(); // Fetch all request data

        // Image processing
        if ($request->hasFile('image')) {
            // Old image delete karein
            if ($artist->image) {
                Storage::disk('public')->delete($artist->image);
            }
            $data['image'] = $request->file('image')->store('artists', 'public');
        }

        $artist->update($data);

        return redirect()->route('artists.index')->with('success', 'Artist updated successfully!');
    }

    public function destroy(Artist $artist)
    {
        $artist->delete();

        return redirect()->route('artists.index')->with('success', 'Artist deleted successfully!');
    }
}
