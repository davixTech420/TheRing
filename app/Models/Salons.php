<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salons extends Model
{
    protected $fillable = [
        'name',
        'description',
        'capacity',
        'price',
        'images',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_salons', 'salon_id', 'event_id')
                    ->withTimestamps();
    }
}
