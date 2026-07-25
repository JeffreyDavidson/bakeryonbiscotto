<?php

use App\Models\ContactMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;

uses(RefreshDatabase::class);

it('silently accepts honeypot submissions without storing or mailing them', function () {
    Mail::fake();

    $response = $this->post(route('contact.store'), [
        'name' => 'Spam Bot',
        'email' => 'bot@example.com',
        'phone' => '555-555-5555',
        'subject' => 'Spam',
        'message' => 'This should not be stored.',
        'website' => 'https://spam.example',
    ]);

    $response->assertRedirect(route('contact'));
    $response->assertSessionHas('success', true);
    expect(ContactMessage::count())->toBe(0);
    Mail::assertNothingSent();
});
