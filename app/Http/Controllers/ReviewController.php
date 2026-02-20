<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'nullable|email|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'body' => 'required|string|max:1000',
            'favorite_bread' => 'nullable|string|max:100',
        ]);

        $validated['status'] = 'pending';

        Review::create($validated);

        return back()->with('review_submitted', true);
    }
}
