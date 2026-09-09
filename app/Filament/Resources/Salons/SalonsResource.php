<?php

namespace App\Filament\Resources\Salons;

use App\Filament\Resources\Salons\Pages\CreateSalons;
use App\Filament\Resources\Salons\Pages\EditSalons;
use App\Filament\Resources\Salons\Pages\ListSalons;
use App\Filament\Resources\Salons\Pages\ViewSalons;
use App\Filament\Resources\Salons\Schemas\SalonsForm;
use App\Filament\Resources\Salons\Schemas\SalonsInfolist;
use App\Filament\Resources\Salons\Tables\SalonsTable;
use App\Models\Salons;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SalonsResource extends Resource
{
    protected static ?string $model = Salons::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::BuildingOffice;

    protected static ?string $recordTitleAttribute = 'Salons';

    public static function form(Schema $schema): Schema
    {
        return SalonsForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SalonsInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SalonsTable::configure($table);
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
            'index' => ListSalons::route('/'),
        ];
    }
}
