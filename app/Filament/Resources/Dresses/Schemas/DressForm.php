<?php

namespace App\Filament\Resources\Dresses\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class DressForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre del Diseño / Vestido')
                    ->required()
                    ->placeholder('Ej: Corte Princesa Real con Pedrería')
                    ->maxLength(255),

                Select::make('category')
                    ->label('Aplica Para')
                    ->options([
                        'boda'    => '👰 Solo Boda (Nupcial)',
                        '15_anos' => '👑 Solo 15 Años (Quinceañera)',
                        'ambos'   => '✨ Ambos (Boda & 15 Años)',
                    ])
                    ->required()
                    ->default('boda'),

                Select::make('silhouette')
                    ->label('Silueta / Corte')
                    ->options([
                        'princesa'     => 'Corte Princesa (Falda Voluminosa)',
                        'sirena'       => 'Corte Sirena (Entallado con Cola)',
                        'linea_a'      => 'Línea A (Fluido Romántico)',
                        'imperio'      => 'Corte Imperio',
                        'vanguardista' => 'Vanguardista / Pasarela',
                    ])
                    ->searchable()
                    ->required(),

                TextInput::make('color')
                    ->label('Color / Tonalidad Principal')
                    ->placeholder('Ej: Blanco Nupcial, Rosa Pastel, Esmeralda...')
                    ->required()
                    ->maxLength(100),

                TextInput::make('price')
                    ->label('Precio / Tarifa Alquiler')
                    ->numeric()
                    ->prefix('$')
                    ->default(0)
                    ->helperText('Si está incluido dentro del paquete de gala, puedes dejarlo en $0'),

                TagsInput::make('sizes')
                    ->label('Tallas Disponibles')
                    ->placeholder('Añadir talla (Ej: XS, S, M, L, A Medida)')
                    ->default(['XS', 'S', 'M', 'L', 'A Medida']),

                Toggle::make('is_active')
                    ->label('Visible en el Cotizador Frontend')
                    ->default(true),

                Toggle::make('is_featured')
                    ->label('Destacado Especial')
                    ->default(false),

                Textarea::make('description')
                    ->label('Descripción de Alta Costura & Detalles')
                    ->placeholder('Describe telas, encajes, corsetería, bordados, pedrería...')
                    ->rows(3)
                    ->columnSpanFull(),

                FileUpload::make('images')
                    ->label('Galería Fotográfica Real del Vestido')
                    ->disk('public')
                    ->directory('dresses')
                    ->multiple()
                    ->image()
                    ->reorderable()
                    ->columnSpanFull()
                    ->helperText('Sube fotos reales en alta definición para que el cliente aprecie el diseño exacto'),
            ]);
    }
}

