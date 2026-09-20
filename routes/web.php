<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalonsController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;


Route::get('/', function () {
    return view('welcome',[SalonsController::class, 'index']);
});

Route::get('/salones', [SalonsController::class, 'index']);


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






Route::get('/tour360/{filename}', function ($filename) {
    // Busca la foto físicamente en tu carpeta storage
    $path = storage_path('app/public/360/' . $filename);
    
    if (!File::exists($path)) {
        abort(404);
    }
    
    $file = File::get($path);
    $type = File::mimeType($path);
    
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    
    // LA CLAVE: Forzamos el permiso de lectura para el canvas 3D
    $response->header("Access-Control-Allow-Origin", "*"); 
    
    return $response;
});


