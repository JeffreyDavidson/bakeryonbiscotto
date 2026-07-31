<?php

use App\Http\Controllers\Billing\CancelController;
use App\Http\Controllers\Billing\CheckoutController;
use App\Http\Controllers\Billing\PortalController;
use App\Http\Controllers\Billing\ShowPlansController;
use App\Http\Controllers\Billing\SwapController;
use Illuminate\Support\Facades\Route;
use Laravel\Cashier\Http\Controllers\WebhookController;

Route::middleware(['web', 'auth'])->prefix('billing')->name('billing.')->group(function () {
    Route::get('/plans', ShowPlansController::class)->name('plans');
    Route::post('/checkout/{plan}', CheckoutController::class)->name('checkout');
    Route::get('/portal', PortalController::class)->name('portal');
    Route::post('/cancel', CancelController::class)->name('cancel');
    Route::post('/swap/{plan}', SwapController::class)->name('swap');
});

// Stripe webhooks (excluded from CSRF)
Route::post('/stripe/webhook', [WebhookController::class, 'handleWebhook'])
    ->name('cashier.webhook');
