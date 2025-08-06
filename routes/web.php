<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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
