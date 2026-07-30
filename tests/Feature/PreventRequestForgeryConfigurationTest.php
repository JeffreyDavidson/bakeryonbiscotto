<?php

use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;

function bindStrictRequestForgeryMiddleware(): void
{
    app()->bind(PreventRequestForgery::class, function ($app): PreventRequestForgery {
        return new class($app, $app['encrypter']) extends PreventRequestForgery
        {
            protected function runningUnitTests(): bool
            {
                return false;
            }
        };
    });
}

it('excludes only the actual Cashier webhook path from request forgery checks', function () {
    bindStrictRequestForgeryMiddleware();

    $middleware = app(PreventRequestForgery::class);

    expect(route('cashier.webhook', absolute: false))->toBe('/stripe/webhook');
    expect($middleware->getExcludedPaths())->toContain('stripe/webhook');
    expect($middleware->getExcludedPaths())->not->toContain('stripe/*');
});

it('allows the real Stripe webhook route through to Cashier without a csrf token', function () {
    bindStrictRequestForgeryMiddleware();

    $response = $this->withMiddleware()->postJson(route('cashier.webhook'), []);

    expect($response->getStatusCode())->not->toBe(419);
});

it('keeps request forgery protection enabled for ordinary form posts', function () {
    bindStrictRequestForgeryMiddleware();

    $this->withMiddleware()->post(route('contact.store'), [])->assertStatus(419);
});
