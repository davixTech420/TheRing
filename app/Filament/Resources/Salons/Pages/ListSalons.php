<?php

namespace App\Filament\Resources\Salons\Pages;

use App\Filament\Resources\Salons\SalonsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSalons extends ListRecords
{
    protected static string $resource = SalonsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
