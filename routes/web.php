<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Book Routes
Route::get('/', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

// Review Routes (protected by auth middleware)
Route::middleware('auth')->prefix('reviews')->name('reviews.')->group(function () {
    Route::get('/create', [ReviewController::class, 'create'])->name('create');
    Route::get('/{review}/edit', [ReviewController::class, 'edit'])->name('edit');
    Route::post('/store', [ReviewController::class, 'store'])->name('store');
    Route::put('/{review}/update', [ReviewController::class, 'update'])->name('update');
    Route::delete('/{review}/delete', [ReviewController::class, 'destroy'])->name('destroy');
});

require __DIR__.'/auth.php';
