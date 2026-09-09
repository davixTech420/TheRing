<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class EventInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user_id')
                    ->numeric(),
                TextEntry::make('name'),
                TextEntry::make('event_type'),
                TextEntry::make('start_date')
                    ->dateTime(),
                TextEntry::make('end_date')
                    ->dateTime(),
                TextEntry::make('status'),
                TextEntry::make('custom_details')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
