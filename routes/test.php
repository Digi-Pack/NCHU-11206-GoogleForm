<?php

use App\Http\Controllers\EditorController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::get('/see', [EditorController::class,'index'])->name('see.index');

Route::post('/see/store', [EditorController::class,'seeStore'])->name('see.store');

Route::get('/test2', function () {
    return Inertia::render('Frontend/Guide');
})->name('guide');


Route::prefix('response')->group(function () {
    // 新增表單

    Route::get('/combine9s ', function () {
        return Inertia::render('Tzuchitry/combine9s');
    });
    Route::get('/combine10s ', function () {
        return Inertia::render('Tzuchitry/combine10s');
    });
    Route::get('/combine11s ', function () {
        return Inertia::render('Tzuchitry/combine11s');
    });

    Route::get('/fileUpload ', function () {
        return Inertia::render('Tzuchitry/fileUpload');
    });
});
