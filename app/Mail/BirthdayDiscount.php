<?php

namespace App\Mail;

use App\Models\Coupon;
use App\Models\CustomerProfile;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BirthdayDiscount extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public CustomerProfile $customer,
        public Coupon $coupon,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Happy Birthday, ' . $this->customer->name . '! 🎂 A treat from us!',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.birthday-discount',
        );
    }
}
