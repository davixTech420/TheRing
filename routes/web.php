<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/salones', function(){
    return view('pages/salones');
});


Route::get('/servicios', function(){
    return view('pages/servicios');
});
