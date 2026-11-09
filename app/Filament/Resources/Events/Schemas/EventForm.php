<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('EventTabs')
                    ->columnSpanFull()
                    ->tabs([

                        // ==========================================
                        // PESTAÑA 1: DATOS GENERALES Y COORDINACIÓN
                        // ==========================================
                        Tab::make('General & Coordinación')
                            ->icon(Heroicon::OutlinedCalendarDays)
                            ->schema([
                                Section::make('Identificación & Cliente')
                                    ->description('Información principal de la celebración y el titular')
                                    ->columns(2)
                                    ->schema([
                                        Select::make('user_id')
                                            ->label('Cliente Titular')
                                            ->relationship('user', 'name')
                                            ->searchable()
                                            ->preload()
                                            ->required()
                                            ->createOptionForm([
                                                TextInput::make('name')
                                                    ->label('Nombre Completo')
                                                    ->required(),
                                                TextInput::make('email')
                                                    ->label('Correo Electrónico')
                                                    ->email()
                                                    ->required(),
                                                TextInput::make('phone')
                                                    ->label('Teléfono de Contacto (WhatsApp)'),
                                                TextInput::make('password')
                                                    ->label('Contraseña Temporal')
                                                    ->password()
                                                    ->required(),
                                            ]),

                                        TextInput::make('name')
                                            ->label('Nombre Oficial del Evento')
                                            ->placeholder('Ej: Boda Real Valentina & Alejandro')
                                            ->required()
                                            ->maxLength(255),

                                        Select::make('event_type')
                                            ->label('Tipo de Celebración')
                                            ->options([
                                                'Boda'        => '💍 Boda de Ensueño',
                                                '15 Años'     => '👑 Mis Dulces 15 Años',
                                                'Bautizo'     => '⛪ Bautizo / Primera Comunión',
                                                'Baby Shower' => '🍼 Baby Shower',
                                                'Cumpleaños'  => '🎂 Cumpleaños / Jubileo',
                                                'Graduación'  => '🎓 Gala de Graduación',
                                                'Corporativo' => '🏢 Evento Corporativo / Congreso',
                                                'Gala'        => '✨ Gran Gala / Banquete Anual',
                                                'Otro'        => '🌟 Otra Celebración Exclusiva',
                                            ])
                                            ->required()
                                            ->native(false),

                                        TextInput::make('guest_count')
                                            ->label('Aforo / Invitados Confirmados')
                                            ->numeric()
                                            ->minValue(1)
                                            ->maxValue(5000)
                                            ->default(100)
                                            ->suffix('personas')
                                            ->required(),

                                        Select::make('status')
                                            ->label('Estado de la Reserva')
                                            ->options([
                                                'pending'   => '⏳ En Revisión / Cotización',
                                                'confirmed' => '✅ Confirmado & Agendado',
                                                'cancelled' => '❌ Cancelado / No Efectuado',
                                            ])
                                            ->default('pending')
                                            ->required()
                                            ->native(false),

                                        Select::make('location_type')
                                            ->label('Modalidad de Locación')
                                            ->options([
                                                'the_ring'          => '🏰 Salones Propios The Ring (Bogotá)',
                                                'external_the_ring' => '🌳 Locación Externa Gestionada por The Ring (Hacienda, Finca u otra parte del país)',
                                                'client_location'   => '🏡 Locación / Salón Propio del Cliente (The Ring despliega producción total)',
                                            ])
                                            ->default('the_ring')
                                            ->required()
                                            ->reactive(),

                                        Select::make('salons')
                                            ->label('Salón(es) Asignado(s) The Ring')
                                            ->relationship('salons', 'name')
                                            ->preload()
                                            ->searchable()
                                            ->multiple()
                                            ->visible(fn (callable $get) => $get('location_type') === 'the_ring')
                                            ->helperText('Puedes asignar uno o múltiples salones de Eventos The Ring para este evento.'),
                                    ]),

                                Section::make('Detalles de Locación Externa o Propia')
                                    ->description('Información del predio, hacienda o salón donde se trasladará el equipo')
                                    ->columns(3)
                                    ->visible(fn (callable $get) => in_array($get('location_type'), ['external_the_ring', 'client_location']))
                                    ->schema([
                                        TextInput::make('custom_details.location_details.city')
                                            ->label('Ciudad / Municipio / Región')
                                            ->placeholder('Ej: Sopó, Chía, Villa de Leyva, Medellín, etc.'),

                                        TextInput::make('custom_details.location_details.venue_name')
                                            ->label('Nombre del Predio / Hacienda / Salón')
                                            ->placeholder('Ej: Hacienda San Rafael / Finca Campestre Los Sauces'),

                                        TextInput::make('custom_details.location_details.address')
                                            ->label('Dirección o Vía de Acceso')
                                            ->placeholder('Ej: Km 4 Vía La Calera'),
                                    ]),

                                Section::make('Fechas & Cronograma')
                                    ->description('Definición de apertura y clausura del evento')
                                    ->columns(2)
                                    ->schema([
                                        DateTimePicker::make('start_date')
                                            ->label('Fecha y Hora de Inicio / Recepción')
                                            ->required()
                                            ->minDate(now()->startOfDay())
                                            ->native(false)
                                            ->displayFormat('d/m/Y H:i')
                                            ->closeOnDateSelection()
                                            ->rule('after_or_equal:today'),

                                        DateTimePicker::make('end_date')
                                            ->label('Fecha y Hora Estimada de Cierre')
                                            ->required()
                                            ->minDate(now()->startOfDay())
                                            ->native(false)
                                            ->displayFormat('d/m/Y H:i')
                                            ->closeOnDateSelection()
                                            ->rule('after_or_equal:start_date'),
                                    ]),
                            ]),

                        // ==========================================
                        // PESTAÑA 2: VESTUARIO & ESTILISMO DE GALA
                        // ==========================================
                        Tab::make('Vestuario & Estilismo')
                            ->icon(Heroicon::OutlinedSparkles)
                            ->schema([
                                Section::make('Vestido de Alta Costura (Novia / Quinceañera)')
                                    ->description('Configuración de confección, corte, color y cambios de vestuario')
                                    ->columns(2)
                                    ->schema([
                                        Select::make('dress_id')
                                            ->label('👗 Modelo de Vestido del Catálogo de Atelier')
                                            ->relationship('dress', 'name')
                                            ->searchable()
                                            ->preload()
                                            ->columnSpanFull()
                                            ->helperText('Selecciona un vestido subido al catálogo o personaliza los campos abajo si es a medida.'),

                                        Select::make('custom_details.vestuario.vestido_estilo')
                                            ->label('Estilo / Silueta del Vestido Principal')
                                            ->options([
                                                'Corte Princesa Real' => '👑 Corte Princesa Real (Corset bordado en pedrería y falda voluptuosa de tul)',
                                                'Corte Sirena Glamour' => '🧜‍♀️ Corte Sirena Glamour (Silueta entallada con encaje francés y cola catedral)',
                                                'Línea A Romántica'   => '🌸 Línea A Romántica (Caída fluida en seda con aplicaciones florales 3D)',
                                                'Gala Vanguardista'   => '✨ Gala Vanguardista / Época (Organza tornasolada con capa imperial)',
                                                'Vestido Gala Cóctel' => '👗 Vestido de Gala Cóctel / Corto',
                                                'Confección de Autor' => '✂️ Confección Exclusiva de Autor a Medida',
                                                'No Aplica'           => '🚫 No Aplica (Traje formal / Corporativo)',
                                            ])
                                            ->native(false),

                                        Select::make('custom_details.vestuario.vestido_color')
                                            ->label('Color Principal del Vestido')
                                            ->options([
                                                'Blanco Nupcial / Marfil' => 'Blanco Nupcial / Marfil Clásico',
                                                'Rosa Champagne'          => 'Rosa Champagne / Blush Gold',
                                                'Esmeralda Imperial'      => 'Verde Esmeralda Imperial',
                                                'Azul Medianoche'         => 'Azul Medianoche / Zafiro Profundo',
                                                'Oro Glaseado'            => 'Oro Glaseado / Lentejuelas Doradas',
                                                'Rojo Rubí'               => 'Rojo Rubí / Borgoña Pasión',
                                                'Lila / Lavanda Pastel'   => 'Lila / Lavanda Pastel',
                                                'Negro Diamante'          => 'Negro Diamante de Gala',
                                                'Personalizado'           => 'Color Personalizado',
                                            ])
                                            ->native(false),

                                        Toggle::make('custom_details.vestuario.segundo_vestido')
                                            ->label('¿Incluye 2do Vestido / Cambio para Hora Loca?')
                                            ->helperText('Permite a la homenajeda cambiarse a un diseño más cómodo y festivo para la rumba.')
                                            ->reactive(),

                                        TextInput::make('custom_details.vestuario.segundo_vestido_detalles')
                                            ->label('Detalles del Segundo Vestido')
                                            ->placeholder('Ej: Vestido corto con pedrería plateada y tenis decorados')
                                            ->visible(fn (callable $get) => (bool) $get('custom_details.vestuario.segundo_vestido')),

                                        Select::make('custom_details.vestuario.traje_anfitrion')
                                            ->label('Traje del Novio / Padre / Anfitrión')
                                            ->options([
                                                'Smoking Clásico'        => '🎩 Smoking Clásico (Solapa de seda y corbatín)',
                                                'Frac Diplomático'       => '👑 Frac Diplomático de Gran Gala',
                                                'Traje Slim Fit Italiano'=> '👔 Traje Slim Fit en Lana Italiana / Lino',
                                                'Gala Militar / Instit.' => '🎖️ Uniforme de Gala Militar / Institucional',
                                                'No Aplica'              => '🚫 No Aplica',
                                            ])
                                            ->native(false),

                                        Select::make('custom_details.vestuario.traje_color')
                                            ->label('Color del Traje')
                                            ->options([
                                                'Negro Clásico'        => 'Negro Clásico',
                                                'Midnight Blue'        => 'Azul Noche / Midnight Blue',
                                                'Ivory / Blanco Gala'  => 'Ivory / Blanco de Gala',
                                                'Gris Oxford'          => 'Gris Oxford / Plomo',
                                                'Verde Bosque'         => 'Verde Bosque / Esmeralda',
                                            ])
                                            ->native(false),

                                        Toggle::make('custom_details.vestuario.spa_maquillaje')
                                            ->label('¿Servicio de Spa, Peinado y Maquillaje VIP in-situ?')
                                            ->helperText('Estilistas profesionales en la suite privada antes de iniciar el evento.')
                                            ->columnSpanFull(),

                                        Textarea::make('custom_details.vestuario.notas_vestuario')
                                            ->label('Notas de Talla, Accesorios y Pruebas de Vestuario')
                                            ->placeholder('Tiara de cristales swarovski, velo de 3 metros, prueba de maquillaje agendada...')
                                            ->rows(3)
                                            ->columnSpanFull(),
                                    ]),
                            ]),

                        // ==========================================
                        // PESTAÑA 3: CONCEPTO TEMÁTICO & PALETA DE COLOR
                        // ==========================================
                        Tab::make('Temática & Paleta Visual')
                            ->icon(Heroicon::OutlinedPaintBrush)
                            ->schema([
                                Section::make('Atmósfera & Estilo Visual')
                                    ->description('Concepto que regirá la iluminación, arreglos florales y elementos escénicos')
                                    ->columns(2)
                                    ->schema([
                                        Select::make('custom_details.tematica.concepto')
                                            ->label('Concepto Temático Central')
                                            ->options([
                                                'Gala Imperial & Candelabros' => '👑 Gala Imperial con Candelabros de Cristal',
                                                'Noche de Estrellas'          => '✨ Noche de Estrellas & Constelaciones',
                                                'Jardín Secreto Romántico'    => '🌿 Jardín Secreto / Bosque Encantado',
                                                'Gatsby & Años Dorados 1920'  => '🎷 Gatsby & Años Dorados 1920',
                                                'Carnaval Veneciano'          => '🎭 Carnaval Veneciano de Máscaras',
                                                'Minimalismo & Alta Joyería'  => '💎 Minimalismo Moderno & Alta Joyería',
                                                'Cyberpunk & Neón Futurista'  => '⚡ Cyberpunk & Luces de Neón',
                                                'Personalizada'               => '🎨 Temática de Diseño Personalizada',
                                            ])
                                            ->native(false),

                                        Select::make('custom_details.tematica.paleta_nombre')
                                            ->label('Paleta Cromática de Referencia')
                                            ->options([
                                                'Oro Imperial & Negro Ónix' => 'Oro Imperial & Negro Ónix',
                                                'Oro Rosa & Blanco Marfil'  => 'Oro Rosa & Blanco Marfil',
                                                'Esmeralda & Champán'       => 'Verde Esmeralda & Champán',
                                                'Azul Zafiro & Plata'       => 'Azul Zafiro & Plata',
                                                'Borgoña Real & Dorado'     => 'Borgoña Real & Dorado Glaseado',
                                                'Blanco Puro & Cristal'     => 'Blanco Puro Monocromático & Cristal',
                                                'Personalizada'             => 'Paleta Libre Personalizada',
                                            ])
                                            ->native(false),

                                        ColorPicker::make('custom_details.tematica.color_primario')
                                            ->label('Tono Primario de Iluminación / Mantelería'),

                                        ColorPicker::make('custom_details.tematica.color_secundario')
                                            ->label('Tono Secundario de Acento / Flores'),

                                        Textarea::make('custom_details.tematica.detalles_decoracion')
                                            ->label('Especificaciones de Ambientación y Flores')
                                            ->placeholder('Rosas blancas importadas, hortensias azules, guirnaldas de luces micro-led suspendidas...')
                                            ->rows(3)
                                            ->columnSpanFull(),
                                    ]),
                            ]),

                        // ==========================================
                        // PESTAÑA 4: MOBILIARIO, TRONO & MENAJE
                        // ==========================================
                        Tab::make('Mobiliario & Estilismo')
                            ->icon(Heroicon::OutlinedBuildingStorefront)
                            ->schema([
                                Section::make('Montaje de Salón & Mobiliario')
                                    ->description('Sillas, mesas, pasarela y trono de honor')
                                    ->columns(2)
                                    ->schema([
                                        Select::make('custom_details.mobiliario.sillas')
                                            ->label('Tipo de Sillería para Invitados')
                                            ->options([
                                                'Sillas Tiffany Doradas'      => '✨ Sillas Tiffany Doradas con Cojín Blanco',
                                                'Sillas Phoenix Transparentes'=> '💎 Sillas Phoenix / Ghost de Policarbonato Cristal',
                                                'Sillas Luis XV Acolchadas'   => '👑 Sillas Luis XV Acolchadas en Terciopelo',
                                                'Sillas Crossback Rústicas'   => '🌿 Sillas Crossback de Madera Rústica VIP',
                                            ])
                                            ->native(false),

                                        Select::make('custom_details.mobiliario.trono_presidencial')
                                            ->label('Silla / Trono Presidencial de los Anfitriones')
                                            ->options([
                                                'Trono Imperial Capitón' => '👑 Trono Imperial de Alto Respaldo con Capitón Dorado',
                                                'Love Seat Romántico'    => '🛋️ Love Seat Romántico Tapizado en Terciopelo',
                                                'Sillas King & Queen'    => '👑 Par de Sillas Majestuosas King & Queen',
                                                'Mesa Presidencial VIP'  => '🍽️ Mesa de Honor Rectangular de Cristal',
                                            ])
                                            ->native(false),

                                        Select::make('custom_details.mobiliario.pasarela_alfombra')
                                            ->label('Paseo Triunfal / Alfombra de Entrada')
                                            ->options([
                                                'Alfombra Roja Gala'     => '🔴 Alfombra Roja de Gala Clásica',
                                                'Alfombra Blanca Nupcial'=> '⚪ Alfombra Blanca Nupcial Inmaculada',
                                                'Pasarela Espejo Cristal'=> '✨ Pasarela de Espejo / Cristal con Iluminación LED',
                                                'Paseo de Pétalos'       => '🌸 Sendero con Alfombra de Pétalos Naturales',
                                            ])
                                            ->native(false),

                                        Select::make('custom_details.mobiliario.centros_mesa')
                                            ->label('Estilo de Centros de Mesa')
                                            ->options([
                                                'Candelabros Altos'   => '🕯️ Candelabros Altos de Cristal con Velas LED Cálidas',
                                                'Arreglos Florales'   => '💐 Arreglos Florales Exóticos sobre Pedestales Dorados',
                                                'Árboles de Luces'    => '🌳 Árboles Escultóricos con Luces de Fibra Óptica',
                                                'Centros Minimalistas'=> '💎 Espejos Circulares con Flores Bajas y Velones',
                                            ])
                                            ->native(false),
                                    ]),
                            ]),

                        // ==========================================
                        // PESTAÑA 5: BANQUETE, MENÚ & BAR
                        // ==========================================
                        Tab::make('Banquete & Bar')
                            ->icon(Heroicon::OutlinedCake)
                            ->schema([
                                Section::make('Experiencia Gastronómica & Repostería')
                                    ->description('Menú culinario de gala, torta conmemorativa y barra de cócteles')
                                    ->columns(2)
                                    ->schema([
                                        Select::make('custom_details.banquete.tipo_servicio')
                                            ->label('Modalidad de Servicio Culinario')
                                            ->options([
                                                'Banquete a la Mesa 3 Tiempos' => '🍽️ Banquete Emplatado a la Mesa (Entrada, Plato Fuerte, Postre)',
                                                'Gala Gourmet 4 Tiempos'       => '🍷 Menú Degustación de Gala (4 Tiempos de Autor)',
                                                'Buffet Internacional'         => '🥗 Gran Buffet Internacional Asistido',
                                                'Estaciones Gastronómicas'     => '🍢 Estaciones Temáticas en Vivo (Sushi, Parrilla, Quesos)',
                                            ])
                                            ->native(false),

                                        TextInput::make('custom_details.banquete.menu_principal')
                                            ->label('Plato Fuerte / Propuesta de Menú')
                                            ->placeholder('Ej: Medallón de lomo al oporto con risotto trufado'),

                                        TextInput::make('custom_details.banquete.dietas_especiales')
                                            ->label('Dietas Especiales & Alergias')
                                            ->placeholder('Ej: 8 menús vegetarianos, 2 celíacos, 15 menús infantiles'),

                                        Select::make('custom_details.banquete.torta_gala')
                                            ->label('Torta de Gala & Repostería')
                                            ->options([
                                                'Torta Monumental 5 Pisos' => '🎂 Torta Monumental de Gala (5 Pisos con Diseño Artístico)',
                                                'Torta Artística 3 Pisos'  => '🎂 Torta Clásica Decorada (3 Pisos)',
                                                'Mesa de Postres Franceses'=> '🧁 Gran Mesa de Postres Franceses & Macarons',
                                                'Cascada de Chocolate'     => '🍫 Cascada de Chocolate Belga con Frutas',
                                            ])
                                            ->native(false),

                                        Select::make('custom_details.banquete.bar_cocteleria')
                                            ->label('Servicio de Coctelería & Bebidas')
                                            ->options([
                                                'Barra Libre Premium'  => '🍸 Barra Libre con Licores Internacionales Premium',
                                                'Cóctel de Autor'      => '🍹 Cóctel de Bienvenida de Autor Personalizado',
                                                'Brindis Champaña'     => '🥂 Brindis Exclusivo con Champaña Brut',
                                                'Bar Sin Alcohol'      => '🥤 Bar de Mocktails y Jugos Naturales Gourmet',
                                            ])
                                            ->native(false),
                                    ]),
                            ]),

                        // ==========================================
                        // PESTAÑA 6: PROTOCOLO, SHOWS & MOMENTOS CUMBRE
                        // ==========================================
                        Tab::make('Protocolo & Shows')
                            ->icon(Heroicon::OutlinedMusicalNote)
                            ->schema([
                                Section::make('Efectos Escénicos & Puesta en Escena')
                                    ->description('Momentos de alta emoción protocolaria y entretenimiento')
                                    ->columns(2)
                                    ->schema([
                                        Toggle::make('custom_details.protocolo.maestro_ceremonia')
                                            ->label('¿Incluye Maestro de Ceremonias / Animador Protocolario?'),

                                        Toggle::make('custom_details.protocolo.vals_humo_frio')
                                            ->label('¿Niebla Baja Criogénica para el Vals / Baile Principal?')
                                            ->helperText('Humo blanco denso a ras de suelo para simular bailar sobre las nubes.'),

                                        Toggle::make('custom_details.protocolo.pirotecnia_brindis')
                                            ->label('¿Chispas Frías Sparkular de Interior para el Brindis?')
                                            ->helperText('Pirotecnia fría 100% segura que no genera humo ni olor.'),

                                        Toggle::make('custom_details.protocolo.pista_3d_led')
                                            ->label('¿Pista de Baile 3D Infinita LED?'),

                                        TextInput::make('custom_details.protocolo.show_hora_loca')
                                            ->label('Show de Hora Loca / Rumba Temática')
                                            ->placeholder('Ej: Robots LED gigantes con pistolas de CO2 criogénico y antifaces de Venecia'),

                                        TextInput::make('custom_details.protocolo.musica_vivo')
                                            ->label('Música en Vivo / Artistas Contratados')
                                            ->placeholder('Ej: Saxofonista para el cóctel + Orquesta 8 músicos para la rumba'),
                                    ]),
                            ]),

                        // ==========================================
                        // PESTAÑA 7: OBSERVACIONES DEL ADMINISTRADOR
                        // ==========================================
                        Tab::make('Acuerdos & Notas Admin')
                            ->icon(Heroicon::OutlinedDocumentText)
                            ->schema([
                                Section::make('Control Administrativo & Financiero')
                                    ->description('Anotaciones internas y control de cotización')
                                    ->columns(2)
                                    ->schema([
                                        TextInput::make('custom_details.estimated_total')
                                            ->label('Presupuesto Total Estimado ($ COP)')
                                            ->numeric()
                                            ->prefix('$')
                                            ->helperText('Monto preliminar calculado para la cotización.'),

                                        Textarea::make('custom_details.admin_notes')
                                            ->label('Observaciones Internas del Administrador')
                                            ->placeholder('Anotaciones sobre abonos recibidos, requerimientos logísticos de montaje o acuerdos comerciales especiales...')
                                            ->rows(4)
                                            ->columnSpanFull(),
                                    ]),
                            ]),

                    ]),
            ]);
    }
}
