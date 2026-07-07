<?php

namespace App\Filament\Resources\Salons\Pages;

use App\Filament\Resources\Salons\SalonResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageSalons extends ManageRecords
{
    protected static string $resource = SalonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
