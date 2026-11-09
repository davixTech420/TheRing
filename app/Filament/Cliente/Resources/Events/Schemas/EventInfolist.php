<?php

namespace App\Filament\Cliente\Resources\Events\Schemas;

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
                Section::make('Estado del Evento & Proceso')
                    ->description('Seguimiento en tiempo real de tu celebración')
                    ->icon(Heroicon::OutlinedSparkles)
                    ->columns(3)
                    ->schema([
                        TextEntry::make('name')
                            ->label('Nombre del Evento')
                            ->weight('bold')
                            ->size('lg'),

                        TextEntry::make('event_type')
                            ->label('Tipo de Celebración')
                            ->badge()
                            ->color('warning'),

                        TextEntry::make('status')
                            ->label('Estado de Confirmación')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'confirmed' => 'success',
                                'cancelled' => 'danger',
                                default     => 'warning',
                            })
                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                'confirmed' => '✅ Confirmado y Agendado',
                                'cancelled' => '❌ Cancelado',
                                default     => '⏳ En Revisión por Dirección',
                            }),

                        TextEntry::make('start_date')
                            ->label('Fecha & Hora Apertura')
                            ->dateTime('d/m/Y - h:i A'),

                        TextEntry::make('end_date')
                            ->label('Hora de Finalización Estimada')
                            ->dateTime('d/m/Y - h:i A'),

                        TextEntry::make('guest_count')
                            ->label('Aforo / Invitados')
                            ->suffix(' personas')
                            ->weight('bold'),

                        TextEntry::make('salons.name')
                            ->label('Salón(es) Reservado(s)')
                            ->badge()
                            ->color('info')
                            ->placeholder('Por Asignar'),
                    ]),

                Section::make('👗 Alta Costura & Vestuario Elegido')
                    ->description('Tu selección de diseño, colores y estilismo')
                    ->icon(Heroicon::OutlinedSparkles)
                    ->columns(3)
                    ->collapsible()
                    ->schema([
                        TextEntry::make('custom_details.vestuario.vestido_estilo')
                            ->label('Silueta del Vestido')
                            ->placeholder('No seleccionado')
                            ->weight('bold'),

                        TextEntry::make('custom_details.vestuario.vestido_color')
                            ->label('Color del Vestido')
                            ->placeholder('No seleccionado'),

                        TextEntry::make('custom_details.vestuario.segundo_vestido')
                            ->label('Cambio para Rumba / 2do Vestido')
                            ->badge()
                            ->formatStateUsing(fn ($state) => $state ? 'Sí (Incluido)' : 'No')
                            ->color(fn ($state) => $state ? 'success' : 'gray'),

                        TextEntry::make('custom_details.vestuario.traje_anfitrion')
                            ->label('Traje del Novio / Anfitrión')
                            ->placeholder('No especificado'),

                        TextEntry::make('custom_details.vestuario.traje_color')
                            ->label('Color del Traje')
                            ->placeholder('No especificado'),

                        TextEntry::make('custom_details.vestuario.spa_maquillaje')
                            ->label('Spa & Maquillaje VIP')
                            ->badge()
                            ->formatStateUsing(fn ($state) => $state ? 'Sí (Solicitado)' : 'No')
                            ->color(fn ($state) => $state ? 'success' : 'gray'),

                        TextEntry::make('custom_details.vestuario.notas_vestuario')
                            ->label('Aclaraciones de Vestuario')
                            ->placeholder('Sin notas')
                            ->columnSpanFull(),
                    ]),

                Section::make('🎨 Concepto Temático & Mobiliario')
                    ->description('Ambientación estética, paleta cromática y montaje')
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
                            ->label('Sillería')
                            ->placeholder('Tiffany Doradas'),

                        TextEntry::make('custom_details.mobiliario.trono_presidencial')
                            ->label('Silla / Trono de Honor')
                            ->placeholder('Trono Imperial'),

                        TextEntry::make('custom_details.mobiliario.pasarela_alfombra')
                            ->label('Paseo Triunfal')
                            ->placeholder('Alfombra Roja'),

                        TextEntry::make('custom_details.mobiliario.centros_mesa')
                            ->label('Centros de Mesa')
                            ->placeholder('Candelabros Altos'),
                    ]),

                Section::make('🍽️ Banquete, Menú & Momentos Cumbre')
                    ->description('Experiencia culinaria, brindis y shows')
                    ->icon(Heroicon::OutlinedCake)
                    ->columns(3)
                    ->collapsible()
                    ->schema([
                        TextEntry::make('custom_details.banquete.tipo_servicio')
                            ->label('Servicio Gastronómico')
                            ->placeholder('Banquete de Gala'),

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
                            ->formatStateUsing(fn ($state) => $state ? 'Sí' : 'No')
                            ->color(fn ($state) => $state ? 'info' : 'gray'),

                        TextEntry::make('custom_details.protocolo.pirotecnia_brindis')
                            ->label('Chispas Frías Brindis')
                            ->badge()
                            ->formatStateUsing(fn ($state) => $state ? 'Sí (Sparkular)' : 'No')
                            ->color(fn ($state) => $state ? 'warning' : 'gray'),
                    ]),

                Section::make('💰 Cotización & Servicios Contratados')
                    ->description('Desglose de servicios especializados contratados con The Ring')
                    ->icon(Heroicon::OutlinedBanknotes)
                    ->collapsible()
                    ->schema([
                        TextEntry::make('services_breakdown')
                            ->label('Desglose de Servicios')
                            ->state(function (Event $record): string {
                                $services = $record->services;
                                if ($services->isEmpty()) {
                                    return 'Tu cotización base está en proceso de revisión por parte del equipo de The Ring.';
                                }
                                $lines = [];
                                foreach ($services as $service) {
                                    $qty = $service->pivot->quantity ?? 1;
                                    $unitPrice = (float) ($service->pivot->unit_price ?? $service->base_price);
                                    $subtotal = $qty * $unitPrice;
                                    $notes = $service->pivot->notes ? " — ({$service->pivot->notes})" : "";
                                    $lines[] = "• {$service->name} [x{$qty}] a \$" . number_format($unitPrice, 0, ',', '.') . " COP c/u = \$" . number_format($subtotal, 0, ',', '.') . " COP{$notes}";
                                }
                                $lines[] = "────────────────────────────────────────";
                                $lines[] = "💰 TOTAL ESTIMADO SERVICIOS: \$" . number_format($record->services_total, 0, ',', '.') . " COP";
                                return implode("\n", $lines);
                            })
                            ->columnSpanFull(),
                    ]),

                Section::make('Staff Asignado a tu Evento')
                    ->description('Equipo profesional que garantizará una velada impecable')
                    ->icon(Heroicon::OutlinedUserGroup)
                    ->collapsible()
                    ->schema([
                        TextEntry::make('staff_list')
                            ->label('Integrantes y Confirmación de Asistencia')
                            ->state(function (Event $record): string {
                                $staff = $record->staff;
                                if ($staff->isEmpty()) {
                                    return 'Tu equipo de staff exclusivo está siendo asignado y calibrado por la dirección de The Ring.';
                                }
                                $lines = [];
                                foreach ($staff as $member) {
                                    $statusEmoji = match ($member->pivot->status) {
                                        'confirmed' => '✅ Confirmado',
                                        'declined'  => '❌ No disponible',
                                        default     => '⏳ Convocado (Pendiente)',
                                    };
                                    $role = $member->role ?? 'Coordinador';
                                    $instrucciones = $member->pivot->notes ? " — ({$member->pivot->notes})" : "";
                                    $lines[] = "• {$member->name} [{$role}] → Estado: {$statusEmoji}{$instrucciones}";
                                }
                                return implode("\n", $lines);
                            })
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
