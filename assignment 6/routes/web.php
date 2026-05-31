<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/student/{id?}/{name?}', function ($id=null, $name=null) {
    return view('student', ['id' => $id, 'name' => $name]);
});

Route::get('/course/{course?}/{year?}', function ($course=null, $year=null) {
    return view('course', ['course' => $course, 'year' => $year]);
});

Route::get('/ojt/{company?}/{city?}/{allowance?}', function ($company=null, $city=null, $allowance=null) {
    return view('ojt', ['company' => $company, 'city' => $city, 'allowance' => $allowance]);
});

Route::get('/event/{event?}/{participant?}/{year?}', function ($event=null, $participant=null, $year=null) {
    return view('event', ['event' => $event, 'participant' => $participant, 'year' => $year]);
});