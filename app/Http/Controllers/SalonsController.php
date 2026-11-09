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


    public function index()
    {
        $salones = Salons::all();

        return view('pages.salones', [
            'salones' => $salones
        ]);
    }
    
}
