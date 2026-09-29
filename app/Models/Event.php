<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'event_type',
        'guest_count',    // <-- Nuevo: Cantidad de invitados
        'start_date',
        'end_date',
        'status',
        'custom_details', // <-- Nuevo: Habilitado para guardar el JSON con (comida, invitaciones, recordatorios)
    ];

    protected $casts = [
        'custom_details' => 'array',
    ];

    // El evento pertenece a un cliente
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Salones seleccionados (puede ser 1, 2 o varios)
    public function salons()
    {
        // Nota: Asegúrate de que el nombre de tu modelo sea Salons (o Salon si lo creaste en singular)
        return $this->belongsToMany(Salons::class, 'event_salons')
                    ->withTimestamps();
    }

    // Inventario físico asignado (sillas, mesas, etc. con sus cantidades y JSON de personalización)
    public function inventoryItems()
    {
        return $this->belongsToMany(InventoryItem::class, 'event_inventory')
                    ->withPivot('quantity', 'customization')
                    ->withTimestamps();
    }

    // Servicios de comida, catering o entretenimiento seleccionados
    public function services()
    {
        return $this->belongsToMany(Service::class, 'event_services')
                    ->withPivot('notes')
                    ->withTimestamps();
    }

    // Empleados de staff asignados para el evento
    public function staff()
    {
        return $this->belongsToMany(Staff::class, 'event_staff')
                    ->withTimestamps();
    }
}