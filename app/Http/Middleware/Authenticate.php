<?php

namespace App\Http\Middleware;

use Filament\Facades\Filament;
use Filament\Http\Middleware\Authenticate as FilamentAuthenticate;
use Filament\Models\Contracts\FilamentUser;

class Authenticate extends FilamentAuthenticate
{
    /**
     * Autenticación segura de paneles con enrutamiento inteligente por roles (Sin 403).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array<string>  $guards
     */
    protected function authenticate($request, array $guards): void
    {
        $guard = Filament::auth();

        if (! $guard->check()) {
            $this->unauthenticated($request, $guards);

            return;
        }

        $this->auth->shouldUse(Filament::getAuthGuard());

        // Si es una petición de logout, permitir que proceda sin bloquear
        if ($request->is('*/logout*')) {
            return;
        }

        /** @var \App\Models\User $user */
        $user = $guard->user();
        $panel = Filament::getCurrentOrDefaultPanel();

        // 1. Si un CLIENTE intenta entrar al panel de administración 'admin':
        // En lugar de mostrar 403 Forbidden, se redirige directamente a /cliente
        if ($panel && $panel->getId() === 'admin' && ($user->role === 'client' || $user->role !== 'admin')) {
            abort(redirect('/cliente'));
        }

        // 2. Si el ADMIN intenta entrar al panel de 'cliente':
        // Se redirige directamente a /admin y no al panel del cliente
        if ($panel && $panel->getId() === 'cliente' && $user->role === 'admin') {
            abort(redirect('/admin'));
        }

        // 3. Validación de roles autorizados
        if ($user instanceof FilamentUser && ! $user->canAccessPanel($panel)) {
            $guard->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            abort(redirect('/login')->withErrors(['email' => 'No tienes permisos para acceder a esta área.']));
        }
    }
}
