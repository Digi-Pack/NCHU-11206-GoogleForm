<?php

use App\Http\Controllers\EditorController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResponseController;

Route::get('/test4', function () {
    return Inertia::render('Backend/ResponseSumTest');
})->name('response');


// Route::prefix('response')->group(function () {
//     Route::get('/sum',[EditorController::class,'response_sum'])->name('response.sum');
//     Route::get('/que', function () {
//         return Inertia::render('Backend/ResponseQue');
//     })->name('response.que');
//     Route::get('/ind', function () {
//         return Inertia::render('Backend/ResponseInd');
//     })->name('response.ind');
// });

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
    Route::get('/tzuchi', [ResponseController::class,'response_tzuchi'])->name('response.tzuchi');
    Route::get('/123', function () {
        return Inertia::render('Tzuchitry/abc123');
    });
    Route::get('/echarts', function () {
        return Inertia::render('Tzuchitry/abc123Copy');
    });
    Route::get('/op', function () {
        return Inertia::render('Tzuchitry/abc456Copy');
    });
    Route::get('/dropDownMenu', function () {
        return Inertia::render('Tzuchitry/dropDownMenu');
    });
    Route::get('/multipleChoice ', function () {
        return Inertia::render('Tzuchitry/multipleChoice');
    });
    Route::get('/multipleChoice0 ', function () {
        return Inertia::render('Tzuchitry/multipleChoice0');
    });
    Route::get('/multipleChoice1 ', function () {
        return Inertia::render('Tzuchitry/multipleChoice1');
    });
    Route::get('/choose ', function () {
        return Inertia::render('Tzuchitry/choose');
    });
    Route::get('/combine ', function () {
        return Inertia::render('Tzuchitry/combine');
    });
    Route::get('/checkbox ', function () {
        return Inertia::render('Tzuchitry/checkbox');
    });
    Route::get('/combine3s ', function () {
        return Inertia::render('Tzuchitry/combine3s');
    });
    Route::get('/linear ', function () {
        return Inertia::render('Tzuchitry/linear');
    });
});
