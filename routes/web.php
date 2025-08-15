<?php

use Illuminate\Support\Facades\Route;

route::get('/', function () {
    return view('pages/landingPage');
});
Route::get('/about', function () {
    return view('pages/aboutPage');
});
Route::get('/products', function () {
    return view('pages/productsPage');
});

