<?php

namespace App\Http\Controllers;

use App\Mail\NewReviewNotification;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        $review = Review::create($validated);

        try {
            Mail::to(config('mail.notify_address'))->send(new NewReviewNotification($review));
        } catch (\Exception $e) {
            report($e);
        }

        return redirect(url()->previous() . '#review-form')->with('review_submitted', true);
    }
}
