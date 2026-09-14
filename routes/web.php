<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalonsController;



Route::get('/', function () {
    return view('welcome',[SalonsController::class, 'index']);
});

Route::get('/salones', function(){
    return view('pages/salones' ,[SalonsController::class, 'index']);
});


Route::get('/servicios', function(){
    return view('pages/servicios');
});


Route::get('/experiencia', function(){
    return view('pages/experiencia');
});

Route::get('/reservas', function(){
    return view('pages/reservas');
});

Route::get('/cliente/login', function () {
    return redirect('/admin/login');
})->name('filament.cliente.auth.login');