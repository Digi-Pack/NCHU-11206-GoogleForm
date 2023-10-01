<?php

use App\Http\Controllers\EditorController;
use App\Http\Controllers\GuideController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
    // Route::get('/', function () {
    //     return Inertia::render('Frontend/guide_index');
    // });
    Route::get('/',[GuideController::class,'guide_index'])->name('guide.index');
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
});

Route::prefix('guide')->middleware(['auth', 'verified'])->group(function () {
    // 新增表單
    Route::get('/index',[GuideController::class,'guide_index'])->name('guide.index');
    Route::delete('/destroy',[GuideController::class,'guide_destroy'])->name('guide.destroy');
});
