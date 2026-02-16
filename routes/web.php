<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('concepts.a'));
Route::get('/concept-b', fn() => view('concepts.b'));
Route::get('/concept-c', fn() => view('concepts.c'));
Route::get('/concept-d', fn() => view('concepts.d'));
Route::get('/concept-e', fn() => view('concepts.e'));
Route::get('/concept-f', fn() => view('concepts.f'));
