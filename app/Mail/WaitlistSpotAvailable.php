<?php

namespace App\Mail;

use App\Models\WaitlistEntry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WaitlistSpotAvailable extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public WaitlistEntry $entry
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Good News — A Spot Opened Up!',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.waitlist-spot-available',
        );
    }
}
