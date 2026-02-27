<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RepeatOrderReminder extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Order $order
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Ready for more sourdough? 🍞',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.repeat-order-reminder',
            with: [
                'reorderUrl' => url('/order?reorder=' . $this->order->id),
            ],
        );
    }
}
