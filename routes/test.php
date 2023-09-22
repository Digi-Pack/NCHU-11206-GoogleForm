<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return Inertia::render('Backend/nav');
});
