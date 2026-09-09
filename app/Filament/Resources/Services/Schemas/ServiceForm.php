<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('category')
                    ->required(),
                TextInput::make('base_price')
                    ->required()
                    ->numeric()
                    ->default(0.0)
                    ->prefix('$'),
            ]);
    }
}
