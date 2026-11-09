<?php

namespace App\Filament\Cliente\Resources\Events\Pages;

use App\Filament\Cliente\Resources\Events\EventResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

class ListEvents extends ListRecords
{
    protected static string $resource = EventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('cotizarNuevo')
                ->label('Diseñar Nuevo Evento')
                ->icon('heroicon-o-sparkles')
                ->color('primary')
                ->url('/reservas'),
        ];
    }
}
