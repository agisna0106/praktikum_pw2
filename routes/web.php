<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\ProfileController;
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

Route::middleware('auth')->group(function(){
    Route::get('/books', [BukuController::class, 'index'])->name('books');
    Route::get('/books/create', [BukuController::class, 'create'])->name('books.create');
    Route::post('/books', [BukuController::class, 'store'])->name('books.store');
    Route::get('/books/{id}/edit', [BukuController::class, 'edit'])->name('books.edit');
    Route::match(['put', 'patch'], '/books/{id}', [BukuController::class, 'update'])->name('books.update');
    Route::delete('/books/{id}', [BukuController::class, 'destroy'])->name('books.destroy');
});

require __DIR__.'/auth.php';
