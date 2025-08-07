<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostInteractionController;

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

Route::get('/devlog', [PostController::class, 'devlog'])->name('devlog');

Route::get('/donation', function () {
    return view('donation');
});

Route::get('/addpost', [PostController::class, 'create'])->name('addpost');
Route::post('/addpost', [PostController::class, 'store'])->name('addpost.submit');
Route::get('/{post}/edit', [PostController::class, 'edit'])->name('editpost');
Route::put('/{post}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/{post}', [PostController::class, 'destroy'])->name('deletepost');
Route::post('/posts/{post}/like', [PostInteractionController::class, 'like'])->name('posts.like');
Route::post('/posts/{post}/comment', [PostInteractionController::class, 'comment'])->name('posts.comment');
