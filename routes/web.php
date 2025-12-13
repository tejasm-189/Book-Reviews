<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('books.index');
});

Route::resource('books', \App\Http\Controllers\BookController::class);
Route::resource('books.reviews', \App\Http\Controllers\ReviewController::class)
    ->scoped(['review' => 'review'])
    ->only(['create', 'store']);
