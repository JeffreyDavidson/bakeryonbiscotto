<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('concepts.g'));
Route::get('/menu-concepts', fn() => view('menu-concepts'));
