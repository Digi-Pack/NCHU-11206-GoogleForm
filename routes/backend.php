<?php

use App\Http\Controllers\EditorController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\ResponseController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
    // Route::get('/', function () {
    //     return Inertia::render('Frontend/GuideIndex');
    // });
    Route::get('/', [GuideController::class,'guide_index'])->name('guide.index');
});

//編輯者頁面
Route::prefix('edit')->middleware(['auth', 'verified'])->group(function () {
    // 新增表單
    Route::get('/index', [EditorController::class, 'edit_index'])->name('edit.index');
    // 儲存表單
    Route::post('/store', [EditorController::class, 'edit_store'])->name('edit.store');
    // 編輯舊表單
    Route::get('/old', [EditorController::class, 'edit_old'])->name('edit.old');
    Route::post('/update', [EditorController::class, 'edit_update'])->name('edit.update');
    Route::delete('/delete', [EditorController::class, 'edit_delete'])->name('edit.delete');
    Route::post('/rename', [EditorController::class, 'edit_rename'])->name('edit.rename');
    Route::post('/same', [EditorController::class, 'edit_addSameForm'])->name('edit.addSameForm');
    Route::get('/coformid', [EditorController::class,'coformid_index'])->name('coformid.index');
    Route::post('/coformid/store', [EditorController::class,'coformid_store'])->name('coformid.store');
    Route::delete('cofomid/delete',[EditorController::class,'coformidDelete'])->name('coformid.delete');
});

Route::prefix('guide')->middleware(['auth', 'verified'])->group(function () {
    // 新增表單
    Route::get('/index', [GuideController::class,'guide_index'])->name('guide.index');
    Route::delete('/destroy', [GuideController::class,'guide_destroy'])->name('guide.destroy');
    Route::post('/change', [GuideController::class,'guide_change'])->name('guide.change');
});

Route::prefix('response')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/sum', [ResponseController::class,'response_sum'])->name('response.sum');
    Route::get('/que/{id}',[ResponseController::class,'responseQue'])->name('response.que');
    Route::get('/ind/{id}',[ResponseController::class,'responseInd'])->name('response.ind');
    Route::delete('/del',[ResponseController::class,'responseDelete'])->name('response.delete');
});

Route::prefix('response')->group(function () {
    // 新增表單
    Route::get('/combine11s ', function () {
        return Inertia::render('Tzuchitry/combine11s');
    });

});
