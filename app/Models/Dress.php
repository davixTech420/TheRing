<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dress extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'silhouette',
        'color',
        'price',
        'images',
        'description',
        'sizes',
        'is_active',
        'is_featured',
    ];

    protected $casts = [
        'images'      => 'array',
        'sizes'       => 'array',
        'price'       => 'decimal:2',
        'is_active'   => 'boolean',
        'is_featured' => 'boolean',
    ];

    /**
     * Obtiene la URL de la primera imagen para mostrar en catálogos y tarjetas
     */
    public function getFirstImageUrlAttribute(): string
    {
        if (!empty($this->images) && is_array($this->images) && count($this->images) > 0) {
            $img = $this->images[0];
            return str_starts_with($img, 'http') ? $img : asset('storage/' . $img);
        }

        return 'https://images.unsplash.com/photo-1594552072238-b8a33785b261?q=80&w=800';
    }

    /**
     * Eventos que han seleccionado este vestido
     */
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}

