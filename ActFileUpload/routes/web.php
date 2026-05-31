<?php

use App\Http\Controllers\PhotoController;
use App\Models\Photo;
use Illuminate\Support\Facades\Route;

Route::get('/upload', [PhotoController::class, 'create'])->name('photos.create');
Route::post('/upload-single', [PhotoController::class, 'storeSingle'])->name('photos.store.single');
Route::post('/upload-multiple', [PhotoController::class, 'storeMultiple'])->name('photos.store.multiple');
Route::delete('/destroy/{id?}', [PhotoController::class, 'destroy'])->name('photos.destroy');
