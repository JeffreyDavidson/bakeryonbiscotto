<?php

namespace App\Http\Controllers;

use App\Mail\ContactConfirmation;
use App\Mail\ContactMessage;
use App\Models\ContactMessage as ContactMessageModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        if ($request->filled('website') || $request->filled('fax_number')) {
            return redirect()->route('contact')->with('success', true);
        }

        $throttleKey = Str::lower($request->input('email', 'guest')).'|'.$request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
            return redirect()->route('contact')->with('success', true);
        }

        RateLimiter::hit($throttleKey, 3600);

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:200',
            'message' => 'required|string|max:2000',
            'website' => 'nullable|string|max:100',
            'fax_number' => 'nullable|string|max:100',
        ]);

        unset($validated['website'], $validated['fax_number']);

        // Save to database
        ContactMessageModel::create($validated);

        // Email to Cassie
        try {
            Mail::to(config('mail.notify_address'))->send(new ContactMessage($validated));
        } catch (\Exception $e) {
            report($e);
        }

        // Confirmation email to user
        try {
            Mail::to($validated['email'])->send(new ContactConfirmation($validated));
        } catch (\Exception $e) {
            report($e);
        }

        return redirect()->route('contact')->with('success', true);
    }
}
