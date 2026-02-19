<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('concepts.g'));
Route::get('/menu-concepts', fn() => view('menu-concepts'));
Route::get('/gallery-concepts', fn() => view('gallery-concepts'));
Route::get('/gallery-concepts-2', fn() => view('gallery-concepts-2'));
Route::get('/gallery-concepts-3', fn() => view('gallery-concepts-3'));
Route::get('/gallery-concepts-4', fn() => view('gallery-concepts-4'));
Route::get('/gallery-concepts-5', fn() => view('gallery-concepts-5'));
Route::get('/upgrades', fn() => view('upgrades'));
Route::get('/wow', fn() => view('wow'));
