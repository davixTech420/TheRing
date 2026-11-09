<?php

namespace App\Filament\Resources\Dresses;

use App\Filament\Resources\Dresses\Pages\ListDresses;
use App\Filament\Resources\Dresses\Schemas\DressForm;
use App\Filament\Resources\Dresses\Tables\DressesTable;
use App\Models\Dress;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DressResource extends Resource
{
    protected static ?string $model = Dress::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Sparkles;

    protected static \UnitEnum|string|null $navigationGroup = 'Catálogo & Experiencia';

    protected static ?string $navigationLabel = 'Vestidos & Atelier';

    protected static ?string $modelLabel = 'Vestido';

    protected static ?string $pluralModelLabel = 'Vestidos de Alta Costura';

    public static function form(Schema $schema): Schema
    {
        return DressForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DressesTable::configure($table);
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
            'index' => ListDresses::route('/'),
        ];
    }
}
