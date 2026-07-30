<?php

use App\Enums\Plan;
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
        ->hasPlan('starter')->toBeTrue()
        ->hasPlan('pro')->toBeFalse()
        ->hasPlan('enterprise')->toBeFalse();
});

test('subscription plan enum centralizes labels hierarchy route parsing and Stripe price resolution', function () {
    config([
        'saas.plans.growth.name' => 'Growth',
        'saas.stripe_prices' => [
            'starter' => 'price_starter_configured',
            'growth' => 'price_growth_configured',
            'pro' => 'price_pro_configured',
        ],
    ]);

    expect(Plan::fromRoute('growth'))->toBe(Plan::Growth)
        ->and(Plan::fromRoute('enterprise'))->toBeNull()
        ->and(Plan::Growth->label())->toBe('Growth')
        ->and(Plan::Growth->level())->toBeGreaterThan(Plan::Starter->level())
        ->and(Plan::Growth->includes(Plan::Starter))->toBeTrue()
        ->and(Plan::Starter->includes(Plan::Growth))->toBeFalse()
        ->and(Plan::Growth->stripePriceId())->toBe('price_growth_configured')
        ->and(Plan::fromStripePriceId('price_growth_configured'))->toBe(Plan::Growth)
        ->and(Plan::fromStripePriceId('price_enterprise_configured'))->toBeNull();
});

test('checkout rejects unsupported route plans before matching a Stripe price', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('billing.checkout', ['plan' => 'enterprise']))
        ->assertNotFound();
});
