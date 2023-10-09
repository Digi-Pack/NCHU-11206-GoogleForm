<?php

use App\Http\Controllers\EditorController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResponseController;

Route::get('/test4', function () {
    return Inertia::render('Backend/ResponseSumTest');
})->name('response');

Route::get('/see', [EditorController::class,'index'])->name('see.index');

Route::post('/see/store', [EditorController::class,'seeStore'])->name('see.store');

Route::get('/test3', function () {
    return Inertia::render('Backend/Response');
})->name('nav2');

Route::get('/test2', function () {
    return Inertia::render('Frontend/Guide');
})->name('guide');


Route::prefix('response')->group(function () {
    // 新增表單
    Route::get('/op', function () {
        return Inertia::render('Tzuchitry/abc456Copy');
    });
    Route::get('/dropDownMenu', function () {
        return Inertia::render('Tzuchitry/dropDownMenu');
    });
    Route::get('/multipleChoice ', function () {
        return Inertia::render('Tzuchitry/multipleChoice');
    });
    Route::get('/choose ', function () {
        return Inertia::render('Tzuchitry/choose');
    });
    Route::get('/checkbox ', function () {
        return Inertia::render('Tzuchitry/checkbox');
    });

    Route::get('/linear ', function () {
        return Inertia::render('Tzuchitry/linear');
    });

    Route::get('/radioSquare ', function () {
        return Inertia::render('Tzuchitry/radioSquare');
    });
    Route::get('/combine6s ', function () {
        return Inertia::render('Tzuchitry/combine6s');
    });
    Route::get('/date ', function () {
        return Inertia::render('Tzuchitry/dateDate');
    });
    Route::get('/combine7s ', function () {
        return Inertia::render('Tzuchitry/combine7s');
    });
    Route::get('/combine8s ', function () {
        return Inertia::render('Tzuchitry/combine8s');
    });
});
