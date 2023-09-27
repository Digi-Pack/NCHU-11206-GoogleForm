<?php

use App\Http\Controllers\EditorController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Inertia::render('Backend/Modal-test');
})->name('response');

Route::get('/see',[EditorController::class,'index'])->name('see.index');

Route::post('/see/store',[EditorController::class,'seeStore'])->name('see.store');
Route::get('/test', function () {
    return Inertia::render('Backend/nav');
})->name('nav2');

Route::get('/test2', function () {
    return Inertia::render('Backend/Answer');
})->name('nav');
