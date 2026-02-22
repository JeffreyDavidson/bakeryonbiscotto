<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    $featuredReview = \App\Models\Review::approved()->where('is_featured', true)->first();
    $approvedReviews = \App\Models\Review::approved()
        ->when($featuredReview, fn($q) => $q->where('id', '!=', $featuredReview->id))
        ->inRandomOrder()
        ->get();
    if (!$featuredReview && $approvedReviews->count()) {
        $featuredReview = $approvedReviews->shift();
    }

    $categories = \App\Models\Category::with(['products' => function($q) {
        $q->where('is_available', true)->orderBy('sort_order');
    }])->orderBy('sort_order')->get();

    return view('home', compact('featuredReview', 'approvedReviews', 'categories'));
});
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/order', [OrderController::class, 'index'])->name('order');
Route::post('/order/paypal/create', [OrderController::class, 'createPayPalOrder'])->name('order.paypal.create');
Route::post('/order/paypal/capture', [OrderController::class, 'capturePayPalOrder'])->name('order.paypal.capture');
Route::get('/order/confirmation/{orderNumber}', [OrderController::class, 'confirmation'])->name('order.confirmation');
Route::get('/about', fn() => view('about'));
Route::get('/review', fn() => view('review'));
Route::get('/gallery', fn() => view('gallery'));
Route::get('/menu', function() {
    $categories = \App\Models\Category::with(['products' => function($q) {
        $q->where('is_available', true)->orderBy('sort_order');
    }])->orderBy('sort_order')->get();
    return view('menu', compact('categories'));
});
Route::get('/menu-concepts', fn() => view('menu-concepts'));
Route::get('/gallery-concepts', fn() => view('gallery-concepts'));
Route::get('/gallery-concepts-2', fn() => view('gallery-concepts-2'));
Route::get('/gallery-concepts-3', fn() => view('gallery-concepts-3'));
Route::get('/gallery-concepts-4', fn() => view('gallery-concepts-4'));
Route::get('/gallery-concepts-5', fn() => view('gallery-concepts-5'));
Route::get('/gallery-finals', fn() => view('gallery-finals'));
Route::get('/upgrades', fn() => view('upgrades'));
Route::get('/wow', fn() => view('wow'));
