<?php

namespace App\Filament\Resources\Dresses\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class DressesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('images')
                    ->label('Foto')
                    ->circular()
                    ->stacked()
                    ->limit(2)
                    ->disk('public'),

                TextColumn::make('name')
                    ->label('Vestido')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('category')
                    ->label('Categoría')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'boda'    => '👰 Boda',
                        '15_anos' => '👑 15 Años',
                        'ambos'   => '✨ Ambos',
                        default   => $state,
                    })
                    ->color(fn ($state) => match ($state) {
                        'boda'    => 'info',
                        '15_anos' => 'warning',
                        'ambos'   => 'success',
                        default   => 'gray',
                    }),

                TextColumn::make('silhouette')
                    ->label('Silueta')
                    ->badge()
                    ->color('gray')
                    ->searchable(),

                TextColumn::make('color')
                    ->label('Color')
                    ->searchable(),

                TextColumn::make('price')
                    ->label('Precio / Alquiler')
                    ->money('COP')
                    ->sortable(),

                IconColumn::make('is_active')
                    ->label('Activo')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->label('Filtrar por Evento')
                    ->options([
                        'boda'    => '👰 Bodas',
                        '15_anos' => '👑 15 Años',
                        'ambos'   => '✨ Ambos',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

