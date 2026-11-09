<?php

namespace App\Http\Responses;

use Filament\Auth\Http\Responses\Contracts\LoginResponse as Responsable;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;

class LoginResponse implements Responsable
{
    /**
     * Redirección inteligente tras el login según el rol del usuario.
     */
    public function toResponse($request): RedirectResponse | Redirector
    {
        $user = auth()->user();

        // Si el admin inicia sesión (incluso desde /cliente/login o /login), va directamente a /admin
        if ($user && $user->role === 'admin') {
            $intended = session()->pull('url.intended');
            if ($intended && str_contains($intended, '/admin')) {
                return redirect()->to($intended);
            }

            return redirect()->to('/admin');
        }

        // Si es cliente, va directamente a su panel de cliente /cliente
        if ($user && $user->role === 'client') {
            $intended = session()->pull('url.intended');
            if ($intended && str_contains($intended, '/cliente')) {
                return redirect()->to($intended);
            }

            return redirect()->to('/cliente');
        }

        return redirect()->to('/');
    }
}

