<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// 各ルートにミドルウェアを適用する
Route::middleware('auth')->group(function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit')
        ->middleware('can:update,post');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update')
        ->middleware('can:update,post');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy')
        ->middleware('can:delete,post');
});
