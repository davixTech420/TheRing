<?php

namespace App\Filament\Resources\Events\RelationManagers;

use App\Models\Service;
use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ServiceRelationManager extends RelationManager
{
    protected static string $relationship = 'services';

    protected static ?string $title = 'Servicios y Cotización del Evento';

    public function form(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->label('Servicio / Item')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('category')
                    ->label('Categoría')
                    ->badge()
                    ->color(fn (string $state): string => match (strtolower($state)) {
                        'gastronomía', 'catering' => 'success',
                        'escenografía', 'tematica' => 'info',
                        'efectos & shows', 'efectos' => 'warning',
                        'tecnología', 'medios' => 'primary',
                        default => 'gray',
                    }),

                TextColumn::make('pivot.quantity')
                    ->label('Cantidad')
                    ->alignCenter()
                    ->sortable()
                    ->badge(),

                TextColumn::make('pivot.unit_price')
                    ->label('Precio Unitario')
                    ->formatStateUsing(function ($state, Service $record) {
                        $price = $state !== null ? $state : $record->base_price;
                        return '$' . number_format((float) $price, 2);
                    })
                    ->sortable(),

                TextColumn::make('total')
                    ->label('Total Cotizado')
                    ->state(function (Service $record): string {
                        $price = $record->pivot->unit_price ?? $record->base_price;
                        $qty = $record->pivot->quantity ?? 1;
                        return '$' . number_format((float) $price * (int) $qty, 2);
                    })
                    ->weight('bold')
                    ->color('success'),

                TextColumn::make('pivot.notes')
                    ->label('Especificaciones')
                    ->limit(45)
                    ->placeholder('Sin notas especiales')
                    ->wrap(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                AttachAction::make()
                    ->label('Agregar a Cotización')
                    ->icon('heroicon-o-plus-circle')
                    ->preloadRecordSelect()
                    ->form(fn (AttachAction $action): array => [
                        $action->getRecordSelect()
                            ->live()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state) {
                                    $service = Service::find($state);
                                    if ($service) {
                                        $set('unit_price', $service->base_price);
                                    }
                                }
                            }),
                        TextInput::make('quantity')
                            ->label('Cantidad')
                            ->numeric()
                            ->default(1)
                            ->minValue(1)
                            ->required(),
                        TextInput::make('unit_price')
                            ->label('Precio Unitario Negociado ($)')
                            ->numeric()
                            ->prefix('$')
                            ->helperText('Si se deja vacío, tomará el precio base del catálogo.'),
                        Textarea::make('notes')
                            ->label('Detalles / Notas de Personalización')
                            ->placeholder('Ej: 20 menús veganos, 6 cabezas móviles beam con efecto estrobo...'),
                    ])
                    ->mutateFormDataUsing(function (array $data): array {
                        if (empty($data['unit_price']) && !empty($data['recordId'])) {
                            $service = Service::find($data['recordId']);
                            $data['unit_price'] = $service?->base_price ?? 0;
                        }
                        return $data;
                    }),
            ])
            ->recordActions([
                EditAction::make()
                    ->label('Modificar Precio/Cantidad')
                    ->form([
                        TextInput::make('quantity')
                            ->label('Cantidad')
                            ->numeric()
                            ->default(1)
                            ->minValue(1)
                            ->required(),
                        TextInput::make('unit_price')
                            ->label('Precio Unitario ($)')
                            ->numeric()
                            ->prefix('$')
                            ->required(),
                        Textarea::make('notes')
                            ->label('Detalles / Especificaciones'),
                    ]),
                DetachAction::make()
                    ->label('Quitar de Cotización'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DetachBulkAction::make(),
                ]),
            ]);
    }
}

