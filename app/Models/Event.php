<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Saade\FilamentFullCalendar\Contracts\Eventable;
use Saade\FilamentFullCalendar\Data\EventData;

class Event extends Model implements Eventable
{
    protected $fillable = [
        'user_id',
        'name',
        'event_type',
        'guest_count',    // Cantidad de invitados
        'dress_id',       // Vestido seleccionado de alta costura
        'location_type',  // 'the_ring', 'external_the_ring', 'client_location'
        'start_date',
        'end_date',
        'status',
        'custom_details', // JSON con (comida, invitaciones, recordatorios)
    ];

    protected $casts = [
        'custom_details' => 'array',
        'start_date'     => 'datetime',
        'end_date'       => 'datetime',
    ];

    /**
     * Convierte el modelo a un evento del calendario.
     */
    public function toCalendarEvent(): EventData | array
    {
        $color = match ($this->status) {
            'confirmed' => 'success',
            'cancelled' => 'danger',
            default     => 'warning',
        };

        $eventData = EventData::make()
            ->title("📋 {$this->name}")
            ->start($this->start_date)
            ->end($this->end_date ?: ($this->start_date ? $this->start_date->copy()->addHours(4) : null))
            ->color($color)
            ->tooltip([
                "📌 {$this->event_type}",
                "👥 {$this->guest_count} invitados",
                "📊 Estado: " . ucfirst($this->status ?? 'pending'),
            ]);

        if ($this->getKey()) {
            $eventData->id($this->getKey());
        }

        return $eventData;
    }

    // El evento pertenece a un cliente
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Vestido de alta costura seleccionado (Boda o 15 Años)
    public function dress()
    {
        return $this->belongsTo(Dress::class);
    }

    // Salones seleccionados (puede ser 1, 2 o varios)
    public function salons()
    {
        return $this->belongsToMany(Salons::class, 'event_salons', 'event_id', 'salon_id')
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
                    ->withPivot(['quantity', 'unit_price', 'notes'])
                    ->withTimestamps();
    }

    /**
     * Calcula el subtotal estimado de los servicios contratados
     */
    public function getServicesTotalAttribute(): float
    {
        return (float) $this->services->sum(function ($service) {
            $price = $service->pivot->unit_price ?? $service->base_price;
            $qty = $service->pivot->quantity ?? 1;
            return (float) $price * (int) $qty;
        });
    }

    // Empleados de staff asignados para el evento
    public function staff()
    {
        return $this->belongsToMany(Staff::class, 'event_staff')
                    ->withPivot(['status', 'confirmation_token', 'confirmed_at', 'notes'])
                    ->withTimestamps();
    }
}
