<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalonsController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\StaffConfirmationController;
use App\Models\Salons;
use App\Models\Service;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

// Acceso y login unificado
Route::get('/login', function () {
    if (auth()->check()) {
        return auth()->user()->role === 'admin'
            ? redirect('/admin')
            : redirect('/cliente');
    }

    return redirect('/cliente/login');
})->name('login');

Route::get('/', function () {
    $salones = Salons::all();
    $servicios = Service::all();
    return view('welcome', compact('salones', 'servicios'));
});

Route::get('/salones', [SalonsController::class, 'index']);

Route::get('/servicios', function () {
    $servicios = Service::all();
    return view('pages.servicios', compact('servicios'));
});

Route::get('/experiencia', function () {
    return view('pages.experiencia');
});

// Rutas de Reservas conectadas al backend
Route::get('/reservas', [ReservationController::class, 'index'])->name('reservas.index');
Route::post('/reservas', [ReservationController::class, 'store'])->name('reservas.store');

// Confirmación de Staff vía Email
Route::get('/staff/confirm/{token}', [StaffConfirmationController::class, 'confirm'])->name('staff.confirm');
Route::get('/staff/decline/{token}', [StaffConfirmationController::class, 'decline'])->name('staff.decline');

Route::get('/tour360/{filename}', function ($filename) {
    $path = storage_path('app/public/360/' . $filename);
    
    if (!File::exists($path)) {
        abort(404);
    }
    
    $file = File::get($path);
    $type = File::mimeType($path);
    
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    $response->header("Access-Control-Allow-Origin", "*"); 
    
    return $response;
});
