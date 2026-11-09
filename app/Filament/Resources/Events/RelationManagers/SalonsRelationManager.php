<?php

namespace App\Filament\Resources\Events\RelationManagers;

use App\Models\Salons;
use Filament\Actions\AttachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DetachAction;
use Filament\Actions\DetachBulkAction;
use Filament\Actions\ViewAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SalonsRelationManager extends RelationManager
{
    protected static string $relationship = 'salons';

    protected static ?string $title = 'Salones Asignados al Evento';

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
                    ->label('Nombre del Salón')
                    ->weight('bold')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('capacity')
                    ->label('Aforo Máximo')
                    ->suffix(' personas')
                    ->sortable(),

                TextColumn::make('price')
                    ->label('Inversión Base')
                    ->money('COP', locale: 'es_CO')
                    ->sortable(),

                TextColumn::make('description')
                    ->label('Descripción')
                    ->limit(50)
                    ->wrap(),
            ])
            ->headerActions([
                AttachAction::make()
                    ->label('Asignar Salón')
                    ->icon('heroicon-o-plus')
                    ->preloadRecordSelect(),
            ])
            ->recordActions([
                DetachAction::make()
                    ->label('Desvincular Salón'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DetachBulkAction::make(),
                ]),
            ]);
    }
}

