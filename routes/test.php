<?php

use App\Http\Controllers\EditorController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

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

Route::prefix('reply')->group(function () {
    // 新增表單
    Route::get('/tzuchi',[ProfileController::class,'reply_index_tzuchi'])->name('reply.tzuchi.index');
    Route::post('/tzuchi/store',[ProfileController::class,'reply_index_tzuchi_store'])->name('reply.tzuchi.store');
    Route::get('/tzuchi/final',[ProfileController::class,'reply_index_tzuchi_final'])->name('reply.tzuchi.final');
});
