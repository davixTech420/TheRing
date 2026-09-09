<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('event_type')
                    ->required(),
                DateTimePicker::make('start_date')
                    ->required(),
                DateTimePicker::make('end_date')
                    ->required(),
                TextInput::make('status')
                    ->required()
                    ->default('pending'),
                Textarea::make('custom_details')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
