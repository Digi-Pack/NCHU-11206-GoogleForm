<?php

use App\Http\Controllers\CartController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Inertia::render('Backend/Question');
})->name('response');
Route::get('/see',[CartController::class,'index'])->name('indexall');
Route::post('/indexStore',[CartController::class,'indexStore'])->name('index.Store');