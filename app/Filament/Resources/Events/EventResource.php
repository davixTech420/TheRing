<?php

namespace App\Filament\Resources\Events;

use App\Filament\Resources\Events\Pages\ManageEvents;
use App\Models\Event;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Tables\Table;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nameClient';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nameClient')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->required()
                    ->maxLength(255),

                TextInput::make('phone')
                    ->numeric(),
                TextInput::make('guests')
                    ->numeric()
                    ->maxLength(255),
                TimePicker::make('startime')
                    ->required()
                    ->native(false),
                TimePicker::make('endtime')
                    ->required()
                    ->native(false),

                DatePicker::make('date')
                    ->required()
                    ->native(false),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nameClient')
            ->columns([
                TextColumn::make('nameClient')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('date')
                    ->searchable(),
                TextColumn::make('startime')
                    ->searchable(),
                TextColumn::make('endtime')
                    ->searchable(),


            ])
            ->filters([
                //
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

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nameClient'),
                TextEntry::make('email'),
                TextEntry::make('guests')
                    ->numeric(),
                TextEntry::make('phone'),
                TextEntry::make('date')
                    ->date()
                    ->placeholder('-'),
                    TextEntry::make('startime')
                    ->time(),
                    TextEntry::make('endtime')
                    ->time(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageEvents::route('/'),
        ];
    }
}
