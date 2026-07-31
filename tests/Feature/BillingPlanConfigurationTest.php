<?php

use App\Enums\Plan;
use App\Http\Middleware\EnsureSubscribed;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

uses(RefreshDatabase::class);

function configureStripePrices(): void
{
    config([
        'saas.stripe_prices' => [
            'starter' => 'price_starter_configured',
            'growth' => 'price_growth_configured',
            'pro' => 'price_pro_configured',
        ],
    ]);
}

function createSubscribedUser(string $priceId = 'price_growth_configured'): User
{
    $user = User::factory()->create();

    $user->subscriptions()->create([
        'type' => 'default',
        'stripe_id' => 'sub_configured_'.str($priceId)->afterLast('_'),
        'stripe_status' => 'active',
        'stripe_price' => $priceId,
        'quantity' => 1,
    ]);

    return $user->fresh();
}

test('plans resolve configured Stripe prices', function () {
    configureStripePrices();

    expect(Plan::Starter->stripePriceId())->toBe('price_starter_configured')
        ->and(Plan::Growth->stripePriceId())->toBe('price_growth_configured')
        ->and(Plan::Pro->stripePriceId())->toBe('price_pro_configured');
});

test('plan lookup fails clearly when Stripe price configuration is missing or not a string', function (mixed $configuredPrice) {
    config(['saas.stripe_prices.starter' => $configuredPrice]);

    expect(fn () => Plan::Starter->stripePriceId())
        ->toThrow(RuntimeException::class, 'Missing Stripe price configuration for [starter] plan.');
})->with([
    'missing' => null,
    'empty' => '',
    'non-string' => 123,
]);

test('plans resolve back from nullable Stripe prices', function () {
    configureStripePrices();

    expect(Plan::fromStripePriceId('price_starter_configured'))->toBe(Plan::Starter)
        ->and(Plan::fromStripePriceId('price_growth_configured'))->toBe(Plan::Growth)
        ->and(Plan::fromStripePriceId('price_pro_configured'))->toBe(Plan::Pro)
        ->and(Plan::fromStripePriceId('price_unknown'))->toBeNull()
        ->and(Plan::fromStripePriceId(null))->toBeNull();
});

test('plans compare tier ordering', function () {
    expect(Plan::Growth->includes(Plan::Starter))->toBeTrue()
        ->and(Plan::Growth->includes(Plan::Growth))->toBeTrue()
        ->and(Plan::Growth->includes(Plan::Pro))->toBeFalse();
});

test('subscription plan helpers resolve configured Stripe prices without runtime env reads', function () {
    configureStripePrices();

    $user = createSubscribedUser();

    expect($user)
        ->currentPlan()->toBe(Plan::Growth)
        ->hasPlan(Plan::Growth)->toBeTrue()
        ->hasPlan(Plan::Starter)->toBeTrue()
        ->hasPlan(Plan::Pro)->toBeFalse();
});

test('billing routes reject unsupported plans through implicit enum route binding', function (string $routeName) {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route($routeName, ['plan' => 'enterprise']))
        ->assertNotFound();
})->with([
    'checkout' => 'billing.checkout',
    'swap' => 'billing.swap',
]);

test('subscribed billing routes redirect authenticated non-subscribed users to plans', function (string $method, string $routeName, array $parameters = []) {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->{$method}(route($routeName, $parameters))
        ->assertRedirect(route('billing.plans'));
})->with([
    'portal' => ['get', 'billing.portal'],
    'cancel' => ['post', 'billing.cancel'],
    'swap' => ['post', 'billing.swap', ['plan' => Plan::Growth->value]],
]);

test('valid billing plans reach controller plan price lookup', function () {
    $this->withoutExceptionHandling();

    $user = User::factory()->create();

    config(['saas.stripe_prices.starter' => null]);

    $this->actingAs($user)
        ->post(route('billing.checkout', ['plan' => Plan::Starter->value]));
})->throws(RuntimeException::class, 'Missing Stripe price configuration for [starter] plan.');

test('subscription middleware delegates required plan comparison to the current plan', function () {
    configureStripePrices();

    $user = createSubscribedUser();
    $request = Request::create('/protected');
    $request->setUserResolver(fn () => $user);
    $middleware = new EnsureSubscribed;

    $response = $middleware->handle(
        $request,
        fn () => new Response('allowed'),
        Plan::Starter->value,
    );

    expect($response->getContent())->toBe('allowed');

    $middleware->handle(
        $request,
        fn () => new Response('blocked'),
        Plan::Pro->value,
    );
})->throws(HttpException::class, 'Your current plan does not include this feature. Please upgrade.');
