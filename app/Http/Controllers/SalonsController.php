<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salons;
use App\Models\Service;
use App\Models\User;
use App\Models\Event;
use App\Models\InventoryItem;


class SalonsController extends Controller
{


public function index(){
    // Obtener los datos de forma segura usando Eloquent
        // Usarpaginate() es una buena práctica si tienes muchos registros
        $salones = Salons::paginate(3); // Cambia 10 por el número de registros que quieras mostrar por página

        // Pasar los datos a la vista Blade
        return view('welcome', compact('salones'));

}
    
}
