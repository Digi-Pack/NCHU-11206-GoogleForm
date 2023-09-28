<?php

use App\Http\Controllers\EditorController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return Inertia::render('Backend/Question');
// })->name('response');

Route::get('/see',[EditorController::class,'index'])->name('see.index');

Route::post('/see/store',[EditorController::class,'seeStore'])->name('see.store');

Route::get('/test3', function () {
    return Inertia::render('Backend/Response');
})->name('nav2');

Route::get('/test2', function () {
    return Inertia::render('Frontend/Guide');
})->name('guide');
