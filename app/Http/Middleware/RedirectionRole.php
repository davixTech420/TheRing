<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectionRole
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->role === 'client') {
            // Evitamos el bucle: Solo redirige si NO está ya en el panel de cliente
            if (! $request->is('cliente*')) {
                return redirect('/cliente'); 
            }
        }

        return $next($request);
    }
}