<?php

namespace App\Filament\Cliente\Resources\Events\Pages;

use App\Filament\Cliente\Resources\Events\EventResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEvent extends CreateRecord
{
    protected static string $resource = EventResource::class;
}
