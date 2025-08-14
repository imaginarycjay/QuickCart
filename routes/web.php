<?php

use Illuminate\Support\Facades\Route;

route::get('/', function () {
    return view('landingPage');
});
Route::get('/about', function () {
    return view('aboutPage');
});
Route::get('/about', function () {
    return view('aboutPage');
});

