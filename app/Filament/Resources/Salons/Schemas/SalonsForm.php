<?php

namespace App\Filament\Resources\Salons\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class SalonsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('capacity')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->default(0.0)
                    ->prefix('$'),
                FileUpload::make('images')
                    ->image()                    // Solo permite imágenes
                    ->multiple()
                    ->disk('public')                 // Permite seleccionar y subir varias a la vez
                    ->directory('salons') // Carpeta dentro de storage/app/public donde se guardarán
                    ->reorderable()              // Permite ordenar las imágenes arrastrándolas
                    ->panelLayout('grid')        // Vista de galería moderna
                    ->columnSpanFull(),
            ]);
    }
}
