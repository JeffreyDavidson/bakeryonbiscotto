<?php

use App\Models\Order;
use App\Models\User;
use Filament\Panel;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('admin panel access uses configured admin emails through the gate', function () {
    config(['saas.admin_emails' => ['owner@example.com']]);

    $admin = User::factory()->create(['email' => 'owner@example.com']);
    $customer = User::factory()->create(['email' => 'customer@example.com']);

    expect($admin->canAccessPanel(app(Panel::class)))->toBeTrue()
        ->and($customer->canAccessPanel(app(Panel::class)))->toBeFalse();
});

test('admin invoice route denies non admin users', function () {
    config(['saas.admin_emails' => ['owner@example.com']]);

    $user = User::factory()->create(['email' => 'customer@example.com']);
    $order = Order::factory()->create();

    $this->actingAs($user)
        ->get(route('admin.orders.invoice', $order))
        ->assertForbidden();
});

test('admin invoice route allows configured admin users', function () {
    config(['saas.admin_emails' => ['owner@example.com']]);

    $admin = User::factory()->create(['email' => 'owner@example.com']);
    $order = Order::factory()->create();

    $this->actingAs($admin)
        ->get(route('admin.orders.invoice', $order))
        ->assertOk();
});
