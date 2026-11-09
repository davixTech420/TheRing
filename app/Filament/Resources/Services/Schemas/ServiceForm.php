<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre del Servicio')
                    ->required()
                    ->maxLength(255),

                TextInput::make('category')
                    ->label('Categoría')
                    ->required()
                    ->placeholder('Ej: Catering, Decoración, Fotografía')
                    ->maxLength(255),

                TextInput::make('base_price')
                    ->label('Precio Base')
                    ->required()
                    ->numeric()
                    ->default(0.0)
                    ->prefix('$'),

                Textarea::make('description')
                    ->label('Descripción')
                    ->rows(3)
                    ->columnSpanFull(),

                FileUpload::make('images')
                    ->label('Imágenes')
                    ->disk('public')
                    ->directory('services')
                    ->multiple()
                    ->image()
                    ->reorderable()
                    ->columnSpanFull(),
            ]);
    }
}
