<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salon extends Model
{





    protected $fillable = [
        'nombre',
        'images',
        'capacidad',
        'precio',
        'activo',
    ];

    protected $casts = [
        'images' => 'array',
    ];




}
