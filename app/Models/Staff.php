<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Event;

class Staff extends Model
{
    public function events()
{
    return $this->belongsToMany(Event::class, 'event_inventory')
                ->withPivot('quantity', 'customization')
                ->withTimestamps();
}
}
