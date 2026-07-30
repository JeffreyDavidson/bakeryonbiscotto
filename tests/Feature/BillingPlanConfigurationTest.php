<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('subscription plan helpers resolve configured Stripe prices without runtime env reads', function () {
    config([
        'saas.stripe_prices' => [
            'starter' => 'price_starter_configured',
            'growth' => 'price_growth_configured',
            'pro' => 'price_pro_configured',
        ],
    ]);

    $user = User::factory()->create();

    $user->subscriptions()->create([
        'type' => 'default',
        'stripe_id' => 'sub_configured_growth',
        'stripe_status' => 'active',
        'stripe_price' => 'price_growth_configured',
        'quantity' => 1,
    ]);

    expect($user->fresh())
        ->currentPlan()->toBe('growth')
        ->hasPlan('growth')->toBeTrue()
        ->hasPlan('starter')->toBeTrue();
});
