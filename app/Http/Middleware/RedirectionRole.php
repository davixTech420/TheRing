<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectionRole
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $user = auth()->user();

            // Los usuarios con rol cliente NO pueden ingresar al panel de administración.
            // Si intentan entrar a cualquier ruta de /admin, se redirigen automáticamente a /cliente
            if ($user->role === 'client' && $request->is('admin*') && ! $request->is('admin/logout*')) {
                return redirect('/cliente');
            }

            // Los administradores son redirigidos a /admin si intentan entrar al panel de cliente
            if ($user->role === 'admin' && $request->is('cliente*') && ! $request->is('cliente/logout*')) {
                return redirect('/admin');
            }
        }

        return $next($request);
    }
}
