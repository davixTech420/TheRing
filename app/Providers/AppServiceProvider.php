<?php

namespace App\Providers;

use App\Http\Responses\LoginResponse as CustomLoginResponse;
use App\Http\Responses\RegistrationResponse as CustomRegistrationResponse;
use Filament\Auth\Http\Responses\Contracts\LoginResponse;
use Filament\Auth\Http\Responses\Contracts\RegistrationResponse;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // <-- 1. Importa la fachada URL

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Redirección inteligente de autenticación de Filament según el rol del usuario
        $this->app->singleton(LoginResponse::class, CustomLoginResponse::class);
        $this->app->singleton(RegistrationResponse::class, CustomRegistrationResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 2. Forzar HTTPS estrictamente cuando estés en producción
        if (app()->environment('production')) {
            URL::forceHttps();
        }
    }
}