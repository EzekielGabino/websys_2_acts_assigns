<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::match(['get', 'post'],'/evaluation', function (Request $request) {
    return view('evaluation', [
        'name'=> $request->name,
        'prelim'=> $request->prelim,
        'midterm'=> $request->midterm,
        'final'=> $request->final,
    ]);
});
