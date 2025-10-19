<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Review;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index()
    {
        $listings = Listing::with('category')->paginate(10);
        return view('listing', compact('listings'));
    }

    public function show($id)
    {
        $listing = Listing::with(['category', 'reviews.user', 'address'])->findOrFail($id);
        return view('dlist', compact('listing'));
    }

    public function submitReview(Request $request, $id)
    {
        if (!auth()->check()) {
            return redirect()->route('signin')->with('error', 'Please sign in to leave a review.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $listing = Listing::findOrFail($id);

        Review::create([
            'listing_id' => $listing->id,
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // Update average rating
        $listing->updateAverageRating();

        return redirect()->route('listing.show', $id)->with('success', 'Thank you for your review!');
    }
}