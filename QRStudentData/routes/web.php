<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [StudentController::class, 'index'])->name('students.index');
Route::get('/addcreate', [StudentController::class, 'addcreate'])->name('students.create');
Route::get('/viewDetails/{id?}', [StudentController::class, 'show'])->name('students.view');
Route::get('/editcreate/{id?}', [StudentController::class, 'edit'])->name('students.edit.create');
Route::delete('/delete/{id?}', [StudentController::class, 'delete'])->name('students.delete');

Route::post('/studentadd', [StudentController::class, 'addstudent'])->name('students.add');
Route::put('/studentupdate/{id?}', [StudentController::class, 'updatestudent'])->name('students.update');