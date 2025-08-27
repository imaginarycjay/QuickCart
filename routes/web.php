<?php

use Illuminate\Support\Facades\Route;

route::get('/', function () {
    return view('pages/userSide/landingPage');
});


// changes this later into class base if naayos na ang models and controllers