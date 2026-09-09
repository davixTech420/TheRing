<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Event;

class Salons extends Model
{
    protected $fillable = [
        'name',
        'description',
        'capacity',
        'price',
        'images',   
        // Agrega aquí los demás campos de tu tabla (ej: 'capacity', 'description', etc.)
    ];


    protected $casts = [
        'images' => 'array', // Esto le dice a Eloquent que trate el campo 'images' como un array
    ];

    
    public function events()
{
    return $this->belongsToMany(Event::class, 'event_salons')
                ->withTimestamps();
}
}
