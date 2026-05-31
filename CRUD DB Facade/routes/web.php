<?php

use App\Http\Controllers\StudentsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('students.login');
});
Route::get('/register', [StudentsController::class, 'registerView'])->name('students.register');

Route::get('/register/create', [StudentsController::class, 'registerCreate'])->name('students.create');
Route::post('/register', [StudentsController::class, 'registerStore'])->name('students.store');

Route::get('/login', [StudentsController::class, 'loginView'])->name('students.loginview');
Route::get('/login/create', [StudentsController::class, 'loginCreate'])->name('students.logincreate');
Route::post('/login', [StudentsController::class, 'logins'])->name('students.logins');

Route::get('/homepage', [StudentsController::class, 'homepageView'])->name('students.homepageView');

Route::get('/students/{id}/edit', [StudentsController::class, 'studentsEdit'])->name('students.edit');
Route::put('/students/{id}', [StudentsController::class, 'studentsUpdate'])->name('students.update');

Route::post('/logout', [StudentsController::class, 'logout'])->name('students.logout');

