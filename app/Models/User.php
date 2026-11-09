<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Panel;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function events()
{
    return $this->hasMany(Event::class);
}

    protected static function booted(): void
    {
        static::creating(function (User $user) {
            // Todo nuevo usuario registrado recibe por defecto el rol 'client'
            if (empty($user->role)) {
                $user->role = 'client';
            }
        });
    }

    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        // Tanto el rol 'admin' como 'client' tienen acceso autorizado a la plataforma de Filament
        // para permitir el inicio de sesión unificado desde cualquier ruta (/login, /cliente/login, /admin/login).
        // La seguridad estricta y separación de paneles se garantiza mediante los middlewares Authenticate y RedirectionRole.
        return in_array($this->role, ['admin', 'client']);
    }
}
