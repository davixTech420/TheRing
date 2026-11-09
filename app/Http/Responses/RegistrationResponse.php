<?php

namespace App\Http\Responses;

use Filament\Auth\Http\Responses\Contracts\RegistrationResponse as Responsable;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;

class RegistrationResponse implements Responsable
{
    /**
     * Redirección tras el registro: Todo nuevo usuario siempre va a /cliente.
     */
    public function toResponse($request): RedirectResponse | Redirector
    {
        $user = auth()->user();

        // Asegurar que su rol sea cliente
        if ($user && $user->role !== 'admin') {
            $user->update(['role' => 'client']);
        }

        return redirect()->to('/cliente');
    }
}

