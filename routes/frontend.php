<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReplyController;

Route::get('/', function () {
    return Inertia::render('Frontend/Index', [
        'response' => rtFormat([100, 200, 300]),
    ]);
});

Route::prefix('reply')->middleware(['auth', 'verified'])->group(function () {
    // 新增表單
    Route::get('/index/{id}',[ReplyController::class,'reply_index'])->name('reply.index');
    Route::post('/store',[ReplyController::class,'reply_store'])->name('reply.store');
    Route::get('/final',[ReplyController::class,'reply_final'])->name('reply.final');
    Route::get('/review',[ReplyController::class,'reply_review'])->name('reply.review');
});
