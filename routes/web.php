<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('concepts.a'));
Route::get('/concept-b', fn() => view('concepts.b'));
Route::get('/concept-c', fn() => view('concepts.c'));
