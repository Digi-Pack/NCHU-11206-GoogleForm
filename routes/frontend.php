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
    Route::get('/index',[ReplyController::class,'reply_index'])->name('reply.index');
});
