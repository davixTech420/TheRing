<?php

namespace App\Filament\Cliente\Resources\Events\Tables;

use App\Models\Event;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EventsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nombre del Evento')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('event_type')
                    ->label('Tipo')
                    ->badge()
                    ->color('gray'),

                TextColumn::make('salons.name')
                    ->label('Salón / Locación')
                    ->placeholder('Por Asignar')
                    ->badge()
                    ->color('warning'),

                TextColumn::make('start_date')
                    ->label('Fecha del Evento')
                    ->dateTime('d/m/Y - h:i A')
                    ->sortable(),

                TextColumn::make('guest_count')
                    ->label('Invitados')
                    ->numeric()
                    ->suffix(' personas'),

                TextColumn::make('status')
                    ->label('Estado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'confirmed' => 'success',
                        'cancelled' => 'danger',
                        default     => 'warning',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'confirmed' => 'Confirmado',
                        'cancelled' => 'Cancelado',
                        default     => 'En Revisión',
                    }),

                TextColumn::make('etapa_proceso')
                    ->label('Progreso de Preparación')
                    ->state(function (Event $record): string {
                        if ($record->status === 'cancelled') {
                            return 'Cancelado';
                        }
                        if ($record->status === 'confirmed') {
                            return 'Etapa 4: ¡Evento Confirmado & Listo!';
                        }
                        if ($record->staff()->count() > 0) {
                            return 'Etapa 3: Staff Asignado & En Logística';
                        }
                        if ($record->salons()->count() > 0) {
                            return 'Etapa 2: Salón y Menú Apartados';
                        }
                        return 'Etapa 1: Solicitud Recibida';
                    })
                    ->badge()
                    ->color(function (Event $record): string {
                        if ($record->status === 'cancelled') return 'danger';
                        if ($record->status === 'confirmed') return 'success';
                        if ($record->staff()->count() > 0) return 'info';
                        return 'warning';
                    }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Action::make('cotizar')
                    ->label('Cotizar Nuevo Evento')
                    ->icon('heroicon-o-sparkles')
                    ->color('primary')
                    ->url('/reservas')
                    ->openUrlInNewTab(false),
            ])
            ->recordActions([
                ViewAction::make()
                    ->label('Ver Proceso'),
                EditAction::make()
                    ->label('Modificar')
                    ->visible(fn (Event $record) => $record->status === 'pending' || empty($record->status)),
            ]);
    }
}
