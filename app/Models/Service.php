<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'category',
        'description', // <-- Agregado para soportar las descripciones largas
        'images',      // <-- Agregado para guardar las fotos (URL o rutas)
        'base_price',
    ];

    /**
     * Convierte el campo JSON de la base de datos a un Array de PHP.
     * Esto es obligatorio para que Filament pueda subir y leer múltiples imágenes.
     */
    protected function casts(): array
    {
        return [
            'images' => 'array',
        ];
    }

    public function events()
    {
        // Corrección: La tabla pivote para los servicios es 'event_services', no 'event_inventory'.
        // Y el campo extra en tu tabla event_services es 'notes'.
        return $this->belongsToMany(Event::class, 'event_services')
                    ->withPivot('notes')
                    ->withTimestamps();
    }
}