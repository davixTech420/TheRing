<?php

namespace App\Filament\Resources\InventoryItems\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class InventoryItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('total_stock')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
