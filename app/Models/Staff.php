<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'role',
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_staff')
                    ->withPivot(['status', 'confirmation_token', 'confirmed_at', 'notes'])
                    ->withTimestamps();
    }
}
