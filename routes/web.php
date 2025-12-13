<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('books.index');
});

Route::resource('books', \App\Http\Controllers\BookController::class);
Route::get('books/{book}/reviews/create', [\App\Http\Controllers\ReviewController::class, 'create'])
    ->name('books.reviews.create');

Route::post('books/{book}/reviews', [\App\Http\Controllers\ReviewController::class, 'store'])
    ->name('books.reviews.store')
    ->middleware('throttle:reviews');
