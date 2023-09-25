<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return Inertia::render('Backend/nav');
})->name('nav2');

Route::get('/test2', function () {
    return Inertia::render('Backend/nav-2');
})->name('nav');
