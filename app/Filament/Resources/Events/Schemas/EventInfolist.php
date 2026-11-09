<?php

namespace App\Filament\Resources\Events\Schemas;

use App\Models\Event;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class EventInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Ficha Oficial del Evento')
                    ->description('Datos de identificación, titular y estado en agenda')
                    ->icon(Heroicon::OutlinedSparkles)
                    ->columns(3)
                    ->schema([
                        TextEntry::make('name')
                            ->label('Nombre del Evento')
                            ->weight('bold')
                            ->size('lg'),

                        TextEntry::make('user.name')
                            ->label('Cliente Titular')
                            ->weight('bold'),

                        TextEntry::make('user.phone')
                            ->label('Teléfono de Contacto')
                            ->placeholder('No registrado'),

                        TextEntry::make('event_type')
                            ->label('Tipo de Celebración')
                            ->badge()
                            ->color('warning'),

                        TextEntry::make('guest_count')
                            ->label('Aforo / Invitados')
                            ->suffix(' personas')
                            ->weight('bold'),

                        TextEntry::make('status')
                            ->label('Estado de la Reserva')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'confirmed' => 'success',
                                'cancelled' => 'danger',
                                default     => 'warning',
                            })
                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                'confirmed' => '✅ Confirmado y Agendado',
                                'cancelled' => '❌ Cancelado',
                                default     => '⏳ En Revisión / Cotización',
                            }),

                        TextEntry::make('start_date')
                            ->label('Fecha & Hora Apertura')
                            ->dateTime('d/m/Y - h:i A'),

                        TextEntry::make('end_date')
                            ->label('Fecha & Hora Cierre')
                            ->dateTime('d/m/Y - h:i A'),

                        TextEntry::make('location_type')
                            ->label('Modalidad de Locación')
                            ->badge()
                            ->formatStateUsing(fn ($state) => match ($state) {
                                'external_the_ring' => '🌳 Externa The Ring (Hacienda / Finca / País)',
                                'client_location'   => '🏡 Predio Propio del Cliente',
                                default             => '🏰 Salones The Ring (Sede)',
                            })
                            ->color(fn ($state) => match ($state) {
                                'external_the_ring' => 'info',
                                'client_location'   => 'success',
                                default             => 'warning',
                            }),

                        TextEntry::make('custom_details.location_details.city')
                            ->label('Ciudad / Municipio')
                            ->placeholder('Sede Principal'),

                        TextEntry::make('custom_details.location_details.venue_name')
                            ->label('Hacienda / Predio')
                            ->placeholder('Sede The Ring'),

                        TextEntry::make('salons.name')
                            ->label('Salón(es) The Ring')
                            ->badge()
                            ->placeholder('No aplica / Externa')
                            ->color('info'),
                    ]),

                Section::make('👗 Vestuario & Estilismo de Gala')
                    ->description('Detalles del atuendo principal, cortejo y estilistas')
                    ->icon(Heroicon::OutlinedSparkles)
                    ->columns(3)
                    ->collapsible()
                    ->schema([
                        TextEntry::make('dress.name')
                            ->label('Modelo del Catálogo Atelier')
                            ->weight('bold')
                            ->color('warning')
                            ->placeholder('Confección a Medida / Ninguno'),

                        TextEntry::make('custom_details.vestuario.vestido_estilo')
                            ->label('Silueta / Estilo')
                            ->placeholder('No especificado')
                            ->weight('bold'),

                        TextEntry::make('custom_details.vestuario.vestido_color')
                            ->label('Color del Vestido')
                            ->placeholder('No especificado'),

                        TextEntry::make('custom_details.vestuario.segundo_vestido')
                            ->label('¿Segundo Vestido para Rumba?')
                            ->badge()
                            ->formatStateUsing(fn ($state) => $state ? 'Sí (Incluido)' : 'No')
                            ->color(fn ($state) => $state ? 'success' : 'gray'),

                        TextEntry::make('custom_details.vestuario.segundo_vestido_detalles')
                            ->label('Detalles 2do Vestido')
                            ->placeholder('-')
                            ->columnSpan(2),

                        TextEntry::make('custom_details.vestuario.traje_anfitrion')
                            ->label('Traje del Novio / Anfitrión')
                            ->placeholder('No especificado'),

                        TextEntry::make('custom_details.vestuario.traje_color')
                            ->label('Color del Traje')
                            ->placeholder('No especificado'),

                        TextEntry::make('custom_details.vestuario.spa_maquillaje')
                            ->label('Spa & Maquillaje in-situ')
                            ->badge()
                            ->formatStateUsing(fn ($state) => $state ? 'Sí (Solicitado)' : 'No')
                            ->color(fn ($state) => $state ? 'success' : 'gray'),

                        TextEntry::make('custom_details.vestuario.notas_vestuario')
                            ->label('Notas de Tallas y Accesorios')
                            ->placeholder('Sin notas')
                            ->columnSpanFull(),
                    ]),

                Section::make('🎨 Temática, Paleta & Mobiliario')
                    ->description('Ambientación estética, escenografía y sillería')
                    ->icon(Heroicon::OutlinedPaintBrush)
                    ->columns(3)
                    ->collapsible()
                    ->schema([
                        TextEntry::make('custom_details.tematica.concepto')
                            ->label('Concepto Temático')
                            ->placeholder('Estándar The Ring')
                            ->weight('bold'),

                        TextEntry::make('custom_details.tematica.paleta_nombre')
                            ->label('Paleta Cromática')
                            ->placeholder('Personalizada'),

                        TextEntry::make('custom_details.mobiliario.sillas')
                            ->label('Sillería de Invitados')
                            ->placeholder('Tiffany Doradas'),

                        TextEntry::make('custom_details.mobiliario.trono_presidencial')
                            ->label('Silla / Trono de Honor')
                            ->placeholder('Trono Imperial'),

                        TextEntry::make('custom_details.mobiliario.pasarela_alfombra')
                            ->label('Paseo Triunfal / Alfombra')
                            ->placeholder('Alfombra Roja'),

                        TextEntry::make('custom_details.mobiliario.centros_mesa')
                            ->label('Centros de Mesa')
                            ->placeholder('Candelabros Altos'),

                        TextEntry::make('custom_details.tematica.detalles_decoracion')
                            ->label('Instrucciones de Ambientación')
                            ->placeholder('Sin detalles extra')
                            ->columnSpanFull(),
                    ]),

                Section::make('🍽️ Banquete, Menú & Protocolo')
                    ->description('Catering culinario, torta, brindis y momentos estelares')
                    ->icon(Heroicon::OutlinedCake)
                    ->columns(3)
                    ->collapsible()
                    ->schema([
                        TextEntry::make('custom_details.banquete.tipo_servicio')
                            ->label('Servicio Culinario')
                            ->placeholder('A coordinar'),

                        TextEntry::make('custom_details.banquete.menu_principal')
                            ->label('Menú / Plato Fuerte')
                            ->placeholder('Por definir en degustación'),

                        TextEntry::make('custom_details.banquete.dietas_especiales')
                            ->label('Dietas Especiales')
                            ->placeholder('Ninguna'),

                        TextEntry::make('custom_details.banquete.torta_gala')
                            ->label('Torta de Gala')
                            ->placeholder('Torta Monumental'),

                        TextEntry::make('custom_details.banquete.bar_cocteleria')
                            ->label('Bar & Coctelería')
                            ->placeholder('Barra Libre'),

                        TextEntry::make('custom_details.protocolo.show_hora_loca')
                            ->label('Show de Hora Loca')
                            ->placeholder('Robots LED CO2'),

                        TextEntry::make('custom_details.protocolo.vals_humo_frio')
                            ->label('Humo Bajo / Niebla Vals')
                            ->badge()
                            ->formatStateUsing(fn ($state) => $state ? 'Sí (Activo)' : 'No')
                            ->color(fn ($state) => $state ? 'info' : 'gray'),

                        TextEntry::make('custom_details.protocolo.pirotecnia_brindis')
                            ->label('Chispas Frías Brindis')
                            ->badge()
                            ->formatStateUsing(fn ($state) => $state ? 'Sí (Sparkular)' : 'No')
                            ->color(fn ($state) => $state ? 'warning' : 'gray'),

                        TextEntry::make('custom_details.protocolo.pista_3d_led')
                            ->label('Pista 3D LED')
                            ->badge()
                            ->formatStateUsing(fn ($state) => $state ? 'Sí (Activa)' : 'No')
                            ->color(fn ($state) => $state ? 'success' : 'gray'),
                    ]),

                Section::make('💰 Cotización & Control de Servicios')
                    ->description('Resumen financiero de los servicios especializados')
                    ->icon(Heroicon::OutlinedBanknotes)
                    ->columns(2)
                    ->schema([
                        TextEntry::make('custom_details.estimated_total')
                            ->label('Presupuesto Total Estimado')
                            ->formatStateUsing(fn ($state) => $state ? '$' . number_format((float) $state, 0, ',', '.') . ' COP' : 'A Cotizar')
                            ->weight('black')
                            ->color('warning')
                            ->size('lg'),

                        TextEntry::make('custom_details.admin_notes')
                            ->label('Notas Internas del Administrador')
                            ->placeholder('Sin observaciones registradas')
                            ->wrap(),
                    ]),
            ]);
    }
}
