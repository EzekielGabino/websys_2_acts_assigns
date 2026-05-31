<?php

use App\Http\Controllers\BooksController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BooksController::class, 'index'])->name('books.index');

Route::get('/create', [BooksController::class, 'create'])->name('books.create');
Route::post('/store', [BooksController::class, 'store'])->name('books.store');
Route::delete('/destroy/{id}', [BooksController::class, 'destroy'])->name('books.destroy');

Route::get('/edit/create/{id}', [BooksController::class, 'editcreate'])->name('books.editcreate');
Route::put('/edit/edit/{id}', [BooksController::class, 'edit'])->name('books.edit');

// Route::post('/delete', [BooksController::class, 'destroy'])->name('books.')


// Route::resource('books', BooksController::class);