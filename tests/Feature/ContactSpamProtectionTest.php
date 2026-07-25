<?php

use App\Models\ContactMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;

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

it('does not build throttle keys from malformed oversized emails before validation', function () {
    Mail::fake();
    RateLimiter::clear('contact-form|127.0.0.1');

    $oversizedEmail = str_repeat('A', 300).'not-an-email';

    $response = $this->post(route('contact.store'), [
        'name' => 'Real Person',
        'email' => $oversizedEmail,
        'phone' => '555-555-5555',
        'subject' => 'Question',
        'message' => 'This should validate before any storage or mail happens.',
    ]);

    $response->assertSessionHasErrors('email');
    expect(ContactMessage::count())->toBe(0);
    expect(RateLimiter::attempts('contact-form|127.0.0.1'))->toBe(1);
    expect(RateLimiter::attempts(strtolower($oversizedEmail).'|127.0.0.1'))->toBe(0);
    Mail::assertNothingSent();
});
