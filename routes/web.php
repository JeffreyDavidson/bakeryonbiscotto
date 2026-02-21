<?php

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

    return view('concepts.g', compact('featuredReview', 'approvedReviews', 'categories'));
});
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/menu-concepts', fn() => view('menu-concepts'));
Route::get('/gallery-concepts', fn() => view('gallery-concepts'));
Route::get('/gallery-concepts-2', fn() => view('gallery-concepts-2'));
Route::get('/gallery-concepts-3', fn() => view('gallery-concepts-3'));
Route::get('/gallery-concepts-4', fn() => view('gallery-concepts-4'));
Route::get('/gallery-concepts-5', fn() => view('gallery-concepts-5'));
Route::get('/gallery-finals', fn() => view('gallery-finals'));
Route::get('/upgrades', fn() => view('upgrades'));
Route::get('/wow', fn() => view('wow'));
