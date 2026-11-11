<?php

namespace App\Providers\Filament;

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\RedirectionRole;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Filament\Widgets\AccountWidget;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\HtmlString;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Saade\FilamentFullCalendar\FilamentFullCalendarPlugin;


class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel

        
            ->id('admin')
            ->path('admin')
            ->login()
            ->registration()
            ->passwordReset()
            ->renderHook(
        PanelsRenderHook::BODY_START,
        fn (): string => request()->routeIs([
            'filament.admin.auth.login',
            'filament.admin.auth.register',
            'filament.admin.auth.password-reset.*',
        ]) ? view('partials.header')->render() : '',
    )
    ->renderHook(
        PanelsRenderHook::BODY_END,
        fn (): string => request()->routeIs([
            'filament.admin.auth.login',
            'filament.admin.auth.register',
            'filament.admin.auth.password-reset.*',
        ]) ? view('partials.footer')->render() : '',
    )
            ->colors([
                'primary' => Color::Amber,
            ])
            ->plugins([
                FilamentFullCalendarPlugin::make()
                    ->selectable()
                    ->editable()
                    ->timezone('America/Bogota')
                    ->locale('es'),
            ])
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn (): Htmlable => new HtmlString('
                    <link rel="stylesheet" href="' . asset('css/filament-fullcalendar/fullcalendar.css') . '">
                    <link rel="stylesheet" href="' . asset('css/filament-fullcalendar/filament-fullcalendar.css') . '">
                    <style>
                        /* Estilos de estructura para el Calendario de Eventos FullCalendar */
                        .fc {
                            --fc-border-color: rgba(228, 228, 231, 0.8);
                            --fc-page-bg-color: transparent;
                            --fc-neutral-bg-color: rgba(245, 158, 11, 0.04);
                            --fc-today-bg-color: rgba(245, 158, 11, 0.12);
                            display: flex;
                            flex-direction: column;
                            width: 100%;
                            min-height: 650px;
                        }
                        .dark .fc {
                            --fc-border-color: rgba(255, 255, 255, 0.1);
                            --fc-today-bg-color: rgba(245, 158, 11, 0.18);
                        }
                        .fc table {
                            border-collapse: collapse !important;
                            width: 100% !important;
                        }
                        .fc-scrollgrid {
                            border-radius: 1rem !important;
                            overflow: hidden;
                            border: 1px solid rgba(228, 228, 231, 0.8) !important;
                        }
                        .dark .fc-scrollgrid {
                            border-color: rgba(255, 255, 255, 0.1) !important;
                        }
                        .fc .fc-toolbar.fc-header-toolbar {
                            margin-bottom: 1.25rem !important;
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                            flex-wrap: wrap;
                            gap: 0.75rem;
                        }
                        .fc .fc-toolbar-title {
                            font-size: 1.5rem !important;
                            font-weight: 900 !important;
                            text-transform: capitalize;
                            color: #f59e0b;
                            letter-spacing: -0.025em;
                        }
                        .fc .fc-button {
                            font-weight: 700 !important;
                            font-size: 0.8rem !important;
                            border-radius: 0.6rem !important;
                            padding: 0.45rem 0.9rem !important;
                            text-transform: capitalize;
                            transition: all 0.2s ease;
                        }
                        .fc .fc-button-primary {
                            background-color: #f59e0b !important;
                            border-color: #d97706 !important;
                            color: #000 !important;
                        }
                        .fc .fc-button-primary:hover {
                            background-color: #d97706 !important;
                            border-color: #b45309 !important;
                            color: #fff !important;
                        }
                        .fc .fc-button-primary:disabled {
                            opacity: 0.45;
                        }
                        .fc .fc-button-active {
                            background-color: #b45309 !important;
                            border-color: #92400e !important;
                            color: #fff !important;
                        }
                        .fc-theme-standard th {
                            padding: 0.75rem 0.25rem !important;
                            font-size: 0.75rem !important;
                            text-transform: uppercase;
                            letter-spacing: 0.08em;
                            font-weight: 800 !important;
                            background: rgba(245, 158, 11, 0.06);
                            border-color: rgba(228, 228, 231, 0.8) !important;
                            color: #f59e0b;
                        }
                        .dark .fc-theme-standard th {
                            border-color: rgba(255, 255, 255, 0.1) !important;
                        }
                        .fc .fc-daygrid-day-number {
                            font-size: 0.875rem !important;
                            font-weight: 700 !important;
                            padding: 0.45rem 0.6rem !important;
                        }
                        .fc-daygrid-event {
                            border-radius: 0.5rem !important;
                            padding: 0.25rem 0.5rem !important;
                            font-size: 0.75rem !important;
                            font-weight: 700 !important;
                            margin: 2px 4px !important;
                            cursor: pointer;
                        }
                    </style>
                ')
            )
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                \App\Filament\Widgets\CalendarWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class, 
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                 Authenticate::class,
                 \App\Http\Middleware\RedirectionRole::class,
            ]);
    }
}
