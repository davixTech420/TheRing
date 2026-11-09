<?php

namespace App\Filament\Resources\Staff\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StaffForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nombre Completo')
                    ->required()
                    ->maxLength(255),

                TextInput::make('phone')
                    ->label('Teléfono / WhatsApp')
                    ->tel()
                    ->required()
                    ->maxLength(50),

                TextInput::make('email')
                    ->label('Correo Electrónico (Para confirmaciones)')
                    ->email()
                    ->required()
                    ->maxLength(255),

                TextInput::make('role')
                    ->label('Rol / Cargo')
                    ->required()
                    ->placeholder('Ej: Coordinador de Protocolo, Diseñador Floral, Técnico de Luces')
                    ->maxLength(255),
            ]);
    }
}
