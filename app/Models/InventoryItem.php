<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    protected $fillable = [
        'name',
        'total_stock',
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_inventory')
                    ->withPivot('quantity', 'customization')
                    ->withTimestamps();
    }
}
