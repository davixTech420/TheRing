<?php

namespace App\Filament\Cliente\Resources\Events;

use App\Filament\Cliente\Resources\Events\Pages\EditEvent;
use App\Filament\Cliente\Resources\Events\Pages\ListEvents;
use App\Filament\Cliente\Resources\Events\Pages\ViewEvent;
use App\Filament\Cliente\Resources\Events\Schemas\EventForm;
use App\Filament\Cliente\Resources\Events\Schemas\EventInfolist;
use App\Filament\Cliente\Resources\Events\Tables\EventsTable;
use App\Models\Event;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::CalendarDays;

    protected static ?string $navigationLabel = 'Mis Eventos & Cotizaciones';

    protected static ?string $modelLabel = 'Mi Evento';

    protected static ?string $pluralModelLabel = 'Mis Eventos';

    protected static ?string $recordTitleAttribute = 'name';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        // El cliente puede editar su cotización siempre que esté pendiente o en revisión
        return $record->user_id === auth()->id() && ($record->status === 'pending' || empty($record->status));
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    /**
     * El cliente SOLO puede consultar sus propios eventos.
     */
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('user_id', auth()->id());
    }

    public static function form(Schema $schema): Schema
    {
        return EventForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return EventInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EventsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEvents::route('/'),
            'view'  => ViewEvent::route('/{record}'),
            'edit'  => EditEvent::route('/{record}/edit'),
        ];
    }
}
