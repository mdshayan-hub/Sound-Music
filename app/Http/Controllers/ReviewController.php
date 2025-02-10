<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{   

    // Store review
    public function store(Request $request)
    {
        $request->validate([
            'content_id' => 'required|integer',
            'content_type' => 'required|in:song,video',
            'review_text' => 'required|string|max:500',
            'rating' => 'required|integer|min:1|max:5',
        ]);
    
        Review::create([
            'user_id' => Auth::id(),
            'content_id' => $request->content_id,
            'content_type' => $request->content_type,
            'review_text' => $request->review_text,
            'rating' => $request->rating,
        ]);
    
        return back()->with('success', 'Review submitted successfully!');
    }

public function index()
{
    $reviews = Review::with('song', 'user')->get(); // Song aur User dono ka data load karo
    return view('admin.reviews.reviews', compact('reviews'));
}


    

    // Delete review
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return back()->with('success', 'Review deleted successfully!');
    }
}
