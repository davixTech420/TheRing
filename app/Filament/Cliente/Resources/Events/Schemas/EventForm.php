<?php

namespace App\Filament\Cliente\Resources\Events\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Ajustar Datos de la Celebración')
                    ->description('Puedes modificar los detalles preliminares de tu evento mientras se encuentra en revisión.')
                    ->icon(Heroicon::OutlinedPencilSquare)
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nombre del Evento')
                            ->placeholder('Ej: Boda Real Valentina & Alejandro')
                            ->required()
                            ->maxLength(255),

                        Select::make('event_type')
                            ->label('Tipo de Celebración')
                            ->options([
                                'Boda'         => '💍 Boda de Ensueño',
                                '15 Años'      => '👑 Mis Dulces 15 Años',
                                'Graduación'   => '🎓 Gala de Graduación',
                                'Corporativo'  => '🏢 Evento Corporativo / Banquete',
                                'Cumpleaños'   => '🎂 Cumpleaños / Jubileo',
                                'Aniversario'  => '🥂 Gala de Aniversario',
                                'Otro'         => '🌟 Otro Tipo de Evento',
                            ])
                            ->required(),

                        TextInput::make('guest_count')
                            ->label('Aforo / Invitados Estimados')
                            ->numeric()
                            ->minValue(10)
                            ->maxValue(2000)
                            ->required(),

                        DateTimePicker::make('start_date')
                            ->label('Fecha y Hora Tentativa de Inicio')
                            ->minDate(now())
                            ->required(),

                        DateTimePicker::make('end_date')
                            ->label('Fecha y Hora Tentativa de Cierre')
                            ->minDate(now())
                            ->required(),
                    ]),

                Section::make('👗 Vestuario, Estilismo & Temática')
                    ->description('Personaliza el atuendo soñado y la atmósfera del evento')
                    ->icon(Heroicon::OutlinedSparkles)
                    ->columns(2)
                    ->collapsible()
                    ->schema([
                        Select::make('custom_details.vestuario.vestido_estilo')
                            ->label('Silueta del Vestido')
                            ->options([
                                'Corte Princesa Real' => '👑 Corte Princesa Real',
                                'Corte Sirena Glamour' => '🧜‍♀️ Corte Sirena Glamour',
                                'Línea A Romántica'   => '🌸 Línea A Romántica',
                                'Gala Vanguardista'   => '✨ Gala Vanguardista',
                                'Vestido Gala Cóctel' => '👗 Vestido Cóctel / Corto',
                                'No Aplica'           => '🚫 No Aplica',
                            ]),

                        Select::make('custom_details.vestuario.vestido_color')
                            ->label('Color del Vestido')
                            ->options([
                                'Blanco Nupcial / Marfil' => 'Blanco Nupcial / Marfil',
                                'Rosa Champagne'          => 'Rosa Champagne',
                                'Esmeralda Imperial'      => 'Esmeralda Imperial',
                                'Azul Medianoche'         => 'Azul Medianoche',
                                'Oro Glaseado'            => 'Oro Glaseado',
                                'Rojo Rubí / Borgoña'     => 'Rojo Rubí / Borgoña',
                                'Lila / Lavanda'          => 'Lila / Lavanda',
                                'Negro Diamante'          => 'Negro Diamante',
                            ]),

                        Toggle::make('custom_details.vestuario.segundo_vestido')
                            ->label('¿Deseas incluir segundo vestido para la rumba?'),

                        Select::make('custom_details.tematica.concepto')
                            ->label('Concepto Temático Deseado')
                            ->options([
                                'Gala Imperial & Candelabros' => '👑 Gala Imperial & Candelabros',
                                'Noche de Estrellas'          => '✨ Noche de Estrellas & Constelaciones',
                                'Jardín Secreto Romántico'    => '🌿 Jardín Secreto / Bosque Encantado',
                                'Gatsby & Años Dorados 1920'  => '🎷 Gatsby & Años Dorados 1920',
                                'Carnaval Veneciano'          => '🎭 Carnaval Veneciano de Máscaras',
                                'Cyberpunk & Neón Futurista'  => '⚡ Cyberpunk & Luces de Neón',
                            ]),

                        Textarea::make('custom_details.general_notes')
                            ->label('Peticiones Especiales, Cambios o Dudas')
                            ->placeholder('Cuéntanos si deseas agendar degustación de banquete, pruebas de vestido o cambios en la música.')
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
