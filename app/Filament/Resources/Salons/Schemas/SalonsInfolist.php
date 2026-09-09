<?php

namespace App\Filament\Resources\Salons\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Schema;

class SalonsInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ImageEntry::make('images')
                ->label('Galeria de fotos')
                    ->disk('public')
                    ->columnSpanFull()
                    ->square()
    ->height(100) // Uniformiza la altura de todas las fotos
,
                TextEntry::make('name'),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('capacity')
                    ->numeric(),
                TextEntry::make('price')
                    ->money(),
                
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
