{{-- ====================================================================
     MOTOR DE COTIZACIÓN & RESERVAS VIP "EVENT CANVAS 4.0"
     Atelier & Studio Inmersivo: Vestidos de Alta Costura (Boda & 15 Años),
     Locaciones Propias / Externas / Predio Cliente,
     Conceptos Visuales, Mobiliario con Fotos Reales, Banquete & Shows
     Conexión 100% directa con Base de Datos, Modelos y Panel Filament
==================================================================== --}}
@php
    // 1. Carga de Salones propios desde la BD
    $salonesList = \App\Models\Salons::all()->map(function($s) {
        $img = 'https://images.unsplash.com/photo-1519167758481-83f550bb49b3?q=80&w=800';
        if (!empty($s->images) && is_array($s->images) && count($s->images) > 0) {
            $first = $s->images[0];
            $img = str_starts_with($first, 'http') ? $first : asset('storage/' . $first);
        }
        return [
            'id' => $s->id,
            'name' => $s->name,
            'desc' => $s->description ?: ('Capacidad de hasta ' . $s->capacity . ' personas'),
            'img' => $img,
            'capacity' => (int) $s->capacity,
            'price' => (float) $s->price,
        ];
    });

    // 2. Carga dinámica de Vestidos de Alta Costura desde la BD
    $dressesList = \App\Models\Dress::where('is_active', true)->get()->map(function($d) {
        $firstImg = 'https://images.unsplash.com/photo-1594552072238-b8a33785b261?q=80&w=800';
        $imagesCollection = [];
        if (!empty($d->images) && is_array($d->images) && count($d->images) > 0) {
            $imagesCollection = collect($d->images)->map(function($img) {
                return str_starts_with($img, 'http') ? $img : asset('storage/' . $img);
            })->toArray();
            $firstImg = $imagesCollection[0] ?? $firstImg;
        }
        return [
            'id' => $d->id,
            'name' => $d->name,
            'category' => $d->category,
            'silhouette' => $d->silhouette,
            'color' => $d->color,
            'price' => (float) $d->price,
            'description' => $d->description ?: 'Diseño exclusivo de alta costura The Ring Atelier',
            'sizes' => $d->sizes ?: ['XS', 'S', 'M', 'L', 'A Medida'],
            'img' => $firstImg,
            'images' => $imagesCollection,
        ];
    });

    // 3. Carga dinámica de todos los Servicios desde la base de datos
    $servicesRaw = \App\Models\Service::all();
    $categoriesGrouped = $servicesRaw->groupBy('category')->map(function($items, $catName) {
        return $items->map(function($svc) {
            $img = 'https://images.unsplash.com/photo-1511795409834-ef04bbd61622?q=80&w=800';
            if (!empty($svc->images) && is_array($svc->images) && count($svc->images) > 0) {
                $first = $svc->images[0];
                $img = str_starts_with($first, 'http') ? $first : asset('storage/' . $first);
            }
            return [
                'id' => $svc->id,
                'name' => $svc->name,
                'category' => $svc->category,
                'description' => $svc->description ?: 'Servicio exclusivo de producción The Ring',
                'base_price' => (float) $svc->base_price,
                'img' => $img,
            ];
        });
    });

    $categoriesList = $categoriesGrouped->keys()->toArray();
@endphp

<style>
    .bg-canvas-pattern {
        background-image: radial-gradient(rgba(245, 158, 11, 0.15) 1px, transparent 1px);
        background-size: 32px 32px;
    }
    .dark .bg-canvas-pattern {
        background-image: radial-gradient(rgba(245, 158, 11, 0.08) 1px, transparent 1px);
    }
    
    .glass-luxury {
        background: rgba(255, 255, 255, 0.90);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(0, 0, 0, 0.08);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.04);
    }
    .dark .glass-luxury {
        background: rgba(18, 18, 23, 0.85);
        border: 1px solid rgba(255, 255, 255, 0.08);
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.6);
    }

    .custom-scroll-gold::-webkit-scrollbar { width: 5px; }
    .custom-scroll-gold::-webkit-scrollbar-track { background: transparent; }
    .custom-scroll-gold::-webkit-scrollbar-thumb { background: rgba(245, 158, 11, 0.3); border-radius: 9999px; }
    .custom-scroll-gold::-webkit-scrollbar-thumb:hover { background: rgba(245, 158, 11, 0.8); }

    .input-canvas {
        background: transparent;
        border: none;
        border-bottom: 2px solid rgba(161, 161, 170, 0.3);
        border-radius: 0;
        padding: 0.75rem 0;
        font-size: 1.05rem;
        font-weight: 500;
        transition: all 0.3s ease;
        width: 100%;
        color: inherit;
    }
    .input-canvas:focus {
        outline: none;
        border-bottom-color: #f59e0b;
        box-shadow: 0 10px 15px -10px rgba(245, 158, 11, 0.4);
    }
    .dark .input-canvas { border-bottom-color: rgba(255, 255, 255, 0.12); }
    .dark .input-canvas:focus { border-bottom-color: #f59e0b; }
    .input-canvas::placeholder { color: rgba(161, 161, 170, 0.6); font-weight: 300; }

    .choice-card-active {
        border-color: #f59e0b !important;
        box-shadow: 0 0 0 2px #f59e0b, 0 12px 30px -5px rgba(245, 158, 11, 0.35) !important;
        transform: translateY(-2px);
    }
</style>

{{-- ========================================================
     SCRIPT CONTROLADOR DE ALPINE: EXPERIENCIA INMERSIVA VIP
     ======================================================== --}}
<script>
    function eventCanvas() {
        return {
            step: 1,
            totalSteps: 8,

            salones: @json($salonesList),
            allDresses: @json($dressesList),
            categoriesMap: @json($categoriesGrouped),
            categoryKeys: @json($categoriesList),

            csrfToken: '{{ csrf_token() }}',
            storeUrl: '{{ route('reservas.store') }}',

            minDate: new Date().toISOString().split('T')[0],
            dateError: '',
            isSubmitting: false,
            submitSuccess: false,
            submitError: '',
            confirmedEvent: null,

            // Vista previa modal de vestido en grande
            previewDressModal: null,

            // Atributos del Evento Completo
            event: {
                clientName: '',
                phone: '',
                email: '',
                date: '',
                timeSlot: 'Noche de Gala (18:00 a 04:00)',
                type: 'Boda',
                guests: 120,

                // Modalidad de Locación
                location_type: 'the_ring', // 'the_ring', 'external_the_ring', 'client_location'
                salon: null,
                location_details: {
                    city: 'Bogotá / Sabana',
                    venue_name: '',
                    venue_type: 'Hacienda Campestre',
                    address: '',
                    notes: ''
                },

                generalNotes: '',

                // 1. Alta Costura & Vestuario (Solo aplica para Boda y 15 Años)
                vestuario: {
                    aplica: true,
                    dress_id: null,
                    vestido_estilo: 'Corte Princesa Real de Encaje Francés',
                    vestido_color: 'Blanco Nupcial / Marfil',
                    vestido_img: 'https://images.unsplash.com/photo-1594552072238-b8a33785b261?q=80&w=800',
                    vestido_precio: 0,
                    segundo_vestido: false,
                    segundo_vestido_detalles: '',
                    traje_anfitrion: 'Smoking Clásico',
                    traje_color: 'Negro Clásico',
                    traje_img: 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?q=80&w=800',
                    spa_maquillaje: true,
                    notas_vestuario: ''
                },

                // 2. Concepto Temático Visual con Fotos Reales
                tematica: {
                    concepto: 'Gala Imperial & Candelabros',
                    concepto_img: 'https://images.unsplash.com/photo-1519167758481-83f550bb49b3?q=80&w=800',
                    paleta_nombre: 'Oro Imperial & Negro Ónix',
                    color_primario: '#d97706',
                    color_secundario: '#18181b',
                    detalles_decoracion: ''
                },

                // 3. Mobiliario con Fotos Reales: Sillas, Trono & Alfombra
                mobiliario: {
                    sillas: 'Sillas Tiffany Doradas',
                    sillas_img: 'https://images.unsplash.com/photo-1520854221256-17451cc331bf?q=80&w=800',
                    trono_presidencial: 'Trono Imperial Capitón de Alto Respaldo',
                    trono_img: 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?q=80&w=800',
                    pasarela_alfombra: 'Alfombra Roja de Gala Real',
                    pasarela_img: 'https://images.unsplash.com/photo-1574717024653-61fd2cf4d44d?q=80&w=800',
                    centros_mesa: 'Candelabros Altos de Cristal'
                },

                // 4. Banquete & Repostería
                banquete: {
                    tipo_servicio: 'Banquete a la Mesa 3 Tiempos',
                    torta_gala: 'Torta Monumental 5 Pisos',
                    bar_cocteleria: 'Barra Libre Premium',
                    dietas_especiales: ''
                },

                // 5. Protocolo & Shows
                protocolo: {
                    maestro_ceremonia: true,
                    vals_humo_frio: true,
                    pirotecnia_brindis: true,
                    pista_3d_led: true,
                    show_hora_loca: 'Robots LED con CO2 Criogénico & Venecia',
                    musica_vivo: 'Saxofonista Recepción + Orquesta de Gala'
                }
            },

            selectedServices: {},

            // Catálogos Visuales con Fotos de Alta Definición
            tematicasCatalog: [
                {
                    nombre: 'Gala Imperial & Candelabros',
                    desc: 'Candelabros dorados monumentales, destellos de cristal, mantelería de satén y velas infinitas.',
                    img: 'https://images.unsplash.com/photo-1519167758481-83f550bb49b3?q=80&w=800'
                },
                {
                    nombre: 'Noche de Estrellas & Constelaciones',
                    desc: 'Techo cubierto de micro-LEDs cielo estrellado, iluminación azul zafiro y orbe de luna.',
                    img: 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?q=80&w=800'
                },
                {
                    nombre: 'Jardín Secreto / Bosque Encantado',
                    desc: 'Follaje natural colgante, orquídeas, enredaderas con micro-bombillas cálidas y madera noble.',
                    img: 'https://images.unsplash.com/photo-1465495976277-4387d4b0b4c6?q=80&w=800'
                },
                {
                    nombre: 'Gatsby & Años Dorados 1920',
                    desc: 'Plumas de avestruz gigantes, torres de champaña, dorados geométricos y glamour vintage.',
                    img: 'https://images.unsplash.com/photo-1511795409834-ef04bbd61622?q=80&w=800'
                },
                {
                    nombre: 'Carnaval Veneciano de Máscaras',
                    desc: 'Antifaces venecianos dorados, candelabros barrocos, terciopelo púrpura y dramatismo palaciego.',
                    img: 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=800'
                },
                {
                    nombre: 'Cyberpunk & Neón Futurista',
                    desc: 'Barras LED de colores, rayos láser, pantallas hiperreactivas y fiesta electrónica de última era.',
                    img: 'https://images.unsplash.com/photo-1508700115892-45ecd05ae2ad?q=80&w=800'
                }
            ],

            sillasCatalog: [
                {
                    nombre: 'Sillas Tiffany Doradas',
                    desc: 'Elegancia clásica nupcial con cojín acolchado blanco perla y marco dorado satinado.',
                    img: 'https://images.unsplash.com/photo-1520854221256-17451cc331bf?q=80&w=800'
                },
                {
                    nombre: 'Sillas Ghost / Phoenix Cristal',
                    desc: 'Acrílico translúcido de ultra lujo que refleja los rayos lumínicos y da amplitud aérea.',
                    img: 'https://images.unsplash.com/photo-1545232979-fbf68fe9b1af?q=80&w=800'
                },
                {
                    nombre: 'Sillas Luis XV Terciopelo Real',
                    desc: 'Estructura tallada con molduras finas y respaldo acolchado en terciopelo capitoné.',
                    img: 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?q=80&w=800'
                },
                {
                    nombre: 'Sillas Crossback Madera Noble',
                    desc: 'Madera natural rústica con cruceta trasera para bodas y galas campestres románticas.',
                    img: 'https://images.unsplash.com/photo-1478146896981-b80fe463b330?q=80&w=800'
                }
            ],

            tronosCatalog: [
                {
                    nombre: 'Trono Imperial Capitón de Alto Respaldo',
                    desc: 'Sillón presidencial individual de 1.80m de altura, pan de oro y tapiz blanco capitoné.',
                    img: 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?q=80&w=800'
                },
                {
                    nombre: 'Love Seat Romántico Imperial Tapizado',
                    desc: 'Sofá curvo biplaza para novios o anfitriones con detalles dorados y terciopelo champagne.',
                    img: 'https://images.unsplash.com/photo-1493663284031-b7e3aefcae8e?q=80&w=800'
                },
                {
                    nombre: 'Dúo King & Queen Reales',
                    desc: 'Pareja de tronos gemelos con coronación dorada para una realeza compartida de gala.',
                    img: 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?q=80&w=800'
                },
                {
                    nombre: 'Sillón Peacock Bohemia Floral',
                    desc: 'Pieza de ratán artesanal de pavo real rodeada de follaje, ideal para 15 años y bodas boho.',
                    img: 'https://images.unsplash.com/photo-1583847268964-b28dc8f51f92?q=80&w=800'
                }
            ],

            pasarelasCatalog: [
                {
                    nombre: 'Alfombra Roja de Gala Real',
                    desc: 'Paseo triunfal cinematográfico de terciopelo carmesí con postes dorados y cordón trenzado.',
                    img: 'https://images.unsplash.com/photo-1574717024653-61fd2cf4d44d?q=80&w=800'
                },
                {
                    nombre: 'Pasarela Blanca Nupcial Imperial',
                    desc: 'Superficie blanca inmaculada flanqueada por arreglos florales altos y pétalos de rosa.',
                    img: 'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=800'
                },
                {
                    nombre: 'Pasarela Espejo Infinita',
                    desc: 'Vidrio templado reflectivo de alta resistencia que duplica la iluminación y efecto flotante.',
                    img: 'https://images.unsplash.com/photo-1507676184212-d03ab07a01bf?q=80&w=800'
                },
                {
                    nombre: 'Sendero Rústico de Pétalos & Faroles',
                    desc: 'Madera natural, faroles de hierro con velas titilantes y camino de pétalos frescos.',
                    img: 'https://images.unsplash.com/photo-1469371670807-013ccf25f16a?q=80&w=800'
                }
            ],

            trajesCatalog: [
                {
                    nombre: 'Smoking Clásico de Solapa de Seda',
                    desc: 'Negro azabache con solapa chal en satén italiano y pajarita de seda.',
                    img: 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?q=80&w=800'
                },
                {
                    nombre: 'Frac Diplomático de Gran Gala',
                    desc: 'Levita de cola negra con chaleco piqué blanco y protocolo imperial estricto.',
                    img: 'https://images.unsplash.com/photo-1594938298603-c8148c4dae35?q=80&w=800'
                },
                {
                    nombre: 'Traje Slim Fit Italiano (Lana / Lino)',
                    desc: 'Corte moderno entallado en azul noche, gris oxford o verde bosque con pañuelo de bolsillo.',
                    img: 'https://images.unsplash.com/photo-1617137984095-74e4e5e3613f?q=80&w=800'
                },
                {
                    nombre: 'Traje Propio / No Aplica',
                    desc: 'El anfitrión o novio ya cuenta con vestuario propio o se gestiona independientemente.',
                    img: 'https://images.unsplash.com/photo-1517457373958-b7bdd4587205?q=80&w=800'
                }
            ],

            paletasCatalog: [
                { nombre: 'Oro Imperial & Negro Ónix', c1: '#d97706', c2: '#09090b', text: 'Elegancia y poder clásico' },
                { nombre: 'Oro Rosa & Blanco Marfil', c1: '#f472b6', c2: '#fdfbf7', text: 'Romance dulce y sofisticado' },
                { nombre: 'Esmeralda & Champán', c1: '#059669', c2: '#fef08a', text: 'Naturaleza noble y prestigio' },
                { nombre: 'Azul Zafiro & Plata', c1: '#2563eb', c2: '#e2e8f0', text: 'Noche estrellada y realeza' },
                { nombre: 'Borgoña Real & Dorado', c1: '#991b1b', c2: '#fbbf24', text: 'Pasión dramática y banquete' },
                { nombre: 'Blanco Puro Monocromático', c1: '#ffffff', c2: '#a1a1aa', text: 'Minimalismo y pureza total' }
            ],

            // Lógica de condicionalidad del Vestido
            dressApplies: function() {
                return this.event.type === 'Boda' || this.event.type === '15 Años';
            },

            // Obtiene los vestidos filtrados según el tipo de evento
            getFilteredDresses: function() {
                if (this.event.type === 'Boda') {
                    return this.allDresses.filter(d => d.category === 'boda' || d.category === 'ambos');
                } else if (this.event.type === '15 Años') {
                    return this.allDresses.filter(d => d.category === '15_anos' || d.category === 'ambos');
                }
                return [];
            },

            // Navegación inteligente de pasos
            nextStep: function() {
                if (this.step === 1) {
                    if (!this.event.clientName || !this.event.phone || !this.event.date) {
                        alert('Por favor completa tu nombre, teléfono y fecha deseada.');
                        return;
                    }
                    this.checkDate();
                    if (this.dateError) {
                        alert(this.dateError);
                        return;
                    }
                }

                // Si estamos en Paso 2 y el evento NO es Boda ni 15 Años, saltar directamente a Paso 4 (Temática y Mobiliario)
                if (this.step === 2 && !this.dressApplies()) {
                    this.step = 4;
                    return;
                }

                if (this.step < this.totalSteps) {
                    this.step++;
                }
            },

            prevStep: function() {
                // Si estamos en Paso 4 y el evento NO es Boda ni 15 Años, regresar directamente a Paso 2 (Salones)
                if (this.step === 4 && !this.dressApplies()) {
                    this.step = 2;
                    return;
                }

                if (this.step > 1) {
                    this.step--;
                }
            },

            selectDress: function(dress) {
                if (this.event.vestuario.dress_id === dress.id) {
                    this.event.vestuario.dress_id = null;
                    this.event.vestuario.vestido_estilo = 'Vestido de Autor Personalizado';
                    this.event.vestuario.vestido_precio = 0;
                } else {
                    this.event.vestuario.dress_id = dress.id;
                    this.event.vestuario.vestido_estilo = dress.name;
                    this.event.vestuario.vestido_color = dress.color;
                    this.event.vestuario.vestido_img = dress.img;
                    this.event.vestuario.vestido_precio = dress.price || 0;
                }
            },

            toggleService: function(svc) {
                if (this.selectedServices[svc.id]) {
                    delete this.selectedServices[svc.id];
                } else {
                    this.selectedServices[svc.id] = {
                        id: svc.id,
                        name: svc.name,
                        category: svc.category,
                        price: parseFloat(svc.base_price) || 0,
                        quantity: 1,
                        notes: '',
                        img: svc.img
                    };
                }
            },

            isServiceSelected: function(id) {
                return !!this.selectedServices[id];
            },

            changeServiceQty: function(id, delta) {
                if (!this.selectedServices[id]) return;
                var newQty = this.selectedServices[id].quantity + delta;
                if (newQty <= 0) {
                    delete this.selectedServices[id];
                } else {
                    this.selectedServices[id].quantity = newQty;
                }
            },

            checkDate: function() {
                if (!this.event.date) return;
                var selected = new Date(this.event.date + 'T00:00:00');
                var today = new Date();
                today.setHours(0, 0, 0, 0);
                if (selected < today) {
                    this.dateError = 'No se puede crear un evento con una fecha anterior a la actual.';
                    this.event.date = '';
                } else {
                    this.dateError = '';
                }
            },

            getSalonTotal: function() {
                if (this.event.location_type === 'the_ring') {
                    return this.event.salon ? (parseFloat(this.event.salon.price) || 0) : 0;
                }
                return 0; // Para externa o predio propio el valor base se cotiza con la producción
            },

            getDressTotal: function() {
                if (this.dressApplies() && this.event.vestuario.dress_id) {
                    return parseFloat(this.event.vestuario.vestido_precio) || 0;
                }
                return 0;
            },

            getServicesTotal: function() {
                var sum = 0;
                for (var key in this.selectedServices) {
                    var item = this.selectedServices[key];
                    sum += (item.price * item.quantity);
                }
                return sum;
            },

            getGrandTotal: function() {
                return this.getSalonTotal() + this.getDressTotal() + this.getServicesTotal();
            },

            formatMoney: function(amount) {
                return '$' + new Intl.NumberFormat('es-CO').format(amount) + ' COP';
            },

            submitReservation: async function() {
                if (!this.event.clientName || !this.event.clientName.trim()) {
                    alert('Por favor ingresa el nombre de contacto para la reserva.');
                    this.step = 1;
                    return;
                }
                if (!this.event.phone || !this.event.phone.trim()) {
                    alert('Por favor ingresa tu número telefónico o WhatsApp de contacto.');
                    this.step = 1;
                    return;
                }
                if (!this.event.date) {
                    alert('Por favor selecciona la fecha deseada para tu evento.');
                    this.step = 1;
                    return;
                }
                this.checkDate();
                if (this.dateError) {
                    alert(this.dateError);
                    this.step = 1;
                    return;
                }

                this.isSubmitting = true;
                this.submitError = '';

                try {
                    var servicesPayload = [];
                    var servicesSummary = [];

                    for (var id in this.selectedServices) {
                        var item = this.selectedServices[id];
                        servicesPayload.push({
                            id: item.id,
                            quantity: item.quantity,
                            price: item.price,
                            notes: item.notes
                        });
                        servicesSummary.push(item.name + ' (x' + item.quantity + ')');
                    }

                    // Determinar el nombre del lugar para el resumen
                    var venueName = 'Sede The Ring (Por Asignar)';
                    if (this.event.location_type === 'the_ring') {
                        venueName = this.event.salon ? this.event.salon.name : 'Salón The Ring (Por Asignar)';
                    } else if (this.event.location_type === 'external_the_ring') {
                        venueName = 'Locación Externa: ' + (this.event.location_details.venue_name || this.event.location_details.city);
                    } else if (this.event.location_type === 'client_location') {
                        venueName = 'Predio Propio del Cliente: ' + (this.event.location_details.venue_name || this.event.location_details.city);
                    }

                    var payload = {
                        clientName: this.event.clientName,
                        phone: this.event.phone,
                        email: this.event.email,
                        date: this.event.date,
                        type: this.event.type,
                        guests: parseInt(this.event.guests) || 100,
                        salon_id: (this.event.location_type === 'the_ring' && this.event.salon) ? this.event.salon.id : null,
                        dress_id: this.dressApplies() ? this.event.vestuario.dress_id : null,
                        location_type: this.event.location_type,
                        services: servicesPayload,
                        custom_details: {
                            time_slot: this.event.timeSlot,
                            location_type: this.event.location_type,
                            location_details: this.event.location_details,
                            vestuario: this.dressApplies() ? this.event.vestuario : { aplica: false, nota: 'No aplica para ' + this.event.type },
                            tematica: this.event.tematica,
                            mobiliario: this.event.mobiliario,
                            banquete: this.event.banquete,
                            protocolo: this.event.protocolo,
                            general_notes: this.event.generalNotes,
                            salon_name: venueName,
                            services_summary: servicesSummary,
                            estimated_total: this.getGrandTotal()
                        }
                    };

                    var res = await fetch(this.storeUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': this.csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(payload)
                    });

                    var data = await res.json();

                    if (!res.ok) {
                        var errMsg = data.message;
                        if (data.errors) {
                            var allErrors = [];
                            for (var k in data.errors) {
                                allErrors.push(data.errors[k].join(', '));
                            }
                            errMsg = allErrors.join(' | ');
                        }
                        throw new Error(errMsg || 'Error al procesar la reserva');
                    }

                    this.confirmedEvent = data;
                    this.submitSuccess = true;
                } catch (err) {
                    this.submitError = err.message || 'Error de conexión al servidor. Inténtalo de nuevo.';
                } finally {
                    this.isSubmitting = false;
                }
            }
        };
    }
</script>

<section class="min-h-screen bg-zinc-50 dark:bg-zinc-950 text-zinc-900 dark:text-zinc-100 font-sans relative flex flex-col bg-canvas-pattern transition-colors duration-500 pt-28 md:pt-32"
    x-data="eventCanvas()">

    {{-- MODAL LIGHTBOX PARA VER FOTOS DEL VESTIDO EN ALTA DEFINICIÓN --}}
    <div x-show="previewDressModal" x-cloak class="fixed inset-0 z-[130] bg-black/95 backdrop-blur-2xl flex items-center justify-center p-4 md:p-8" x-transition.opacity>
        <template x-if="previewDressModal">
            <div class="relative max-w-4xl w-full bg-zinc-900 rounded-3xl overflow-hidden border border-amber-500/40 shadow-2xl flex flex-col md:flex-row">
                <button type="button" @click="previewDressModal = null" class="absolute top-4 right-4 z-20 w-10 h-10 rounded-full bg-black/70 hover:bg-black text-white flex items-center justify-center text-xl font-bold transition-all">
                    &times;
                </button>
                <div class="md:w-1/2 h-80 md:h-[550px] relative overflow-hidden bg-black">
                    <img :src="previewDressModal.img" class="w-full h-full object-cover">
                    <div class="absolute bottom-3 left-3 bg-black/75 backdrop-blur-md px-3 py-1 rounded-full text-[10px] font-mono text-amber-400 uppercase tracking-widest" x-text="previewDressModal.category === 'boda' ? 'Colección Nupcial' : 'Colección 15 Años'"></div>
                </div>
                <div class="md:w-1/2 p-6 md:p-8 flex flex-col justify-between bg-zinc-950 text-white">
                    <div>
                        <span class="text-xs font-mono text-amber-500 uppercase tracking-widest font-bold">Atelier de Alta Costura</span>
                        <h3 class="text-2xl font-black mt-1 mb-2 text-white" x-text="previewDressModal.name"></h3>
                        <p class="text-sm text-zinc-400 leading-relaxed mb-4" x-text="previewDressModal.description"></p>
                        
                        <div class="space-y-2 py-3 border-y border-white/10 text-xs font-mono">
                            <div class="flex justify-between"><span class="text-zinc-500">Silueta:</span> <span class="text-white font-bold uppercase" x-text="previewDressModal.silhouette"></span></div>
                            <div class="flex justify-between"><span class="text-zinc-500">Color Base:</span> <span class="text-amber-400 font-bold" x-text="previewDressModal.color"></span></div>
                            <div class="flex justify-between"><span class="text-zinc-500">Tallas:</span> <span class="text-zinc-300" x-text="previewDressModal.sizes ? previewDressModal.sizes.join(', ') : 'A Medida'"></span></div>
                            <div class="flex justify-between"><span class="text-zinc-500">Inversión Alquiler:</span> <span class="text-emerald-400 font-bold text-sm" x-text="previewDressModal.price > 0 ? formatMoney(previewDressModal.price) : 'Incluido en Paquete VIP'"></span></div>
                        </div>
                    </div>

                    <div class="pt-6 flex gap-3">
                        <button type="button" @click="selectDress(previewDressModal); previewDressModal = null;" :class="event.vestuario.dress_id === previewDressModal.id ? 'bg-emerald-500 text-white' : 'bg-amber-500 hover:bg-amber-600 text-black'" class="flex-grow py-3.5 px-6 rounded-2xl font-black text-xs uppercase tracking-widest transition-all text-center">
                            <span x-text="event.vestuario.dress_id === previewDressModal.id ? '✓ Vestido Seleccionado' : 'Elegir Este Vestido para mi Gala'"></span>
                        </button>
                        <button type="button" @click="previewDressModal = null" class="py-3.5 px-4 rounded-2xl bg-zinc-800 hover:bg-zinc-700 text-zinc-300 font-bold text-xs uppercase">
                            Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </template>
    </div>

    {{-- MODAL DE CONFIRMACIÓN VIP DE RESERVA --}}
    <div x-show="submitSuccess" x-cloak class="fixed inset-0 z-[120] bg-black/90 backdrop-blur-2xl flex items-center justify-center p-6" x-transition.opacity>
        <div class="glass-luxury max-w-xl w-full rounded-3xl p-8 md:p-10 text-center relative border border-amber-500/40 shadow-[0_0_80px_rgba(245,158,11,0.25)] bg-zinc-950 text-white">
            <div class="w-20 h-20 mx-auto rounded-full bg-emerald-500/20 border-2 border-emerald-500 flex items-center justify-center text-emerald-400 mb-6 shadow-[0_0_30px_rgba(16,185,129,0.4)]">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <h3 class="text-3xl font-black tracking-tight text-white mb-2">¡Celebración VIP Agendada con Éxito!</h3>
            <p class="text-zinc-400 text-sm mb-6 leading-relaxed">
                Tu cotización y reserva han sido ingresadas al sistema central de <span class="text-amber-400 font-bold">Eventos The Ring</span>. Puedes gestionarla y ver el staff asignado desde tu panel de cliente.
            </p>

            <div class="bg-zinc-900/90 rounded-2xl p-5 mb-8 text-left space-y-2 border border-white/10 font-mono text-xs">
                <div class="flex justify-between text-zinc-400"><span>Código del Evento:</span> <span class="text-amber-400 font-bold" x-text="'#' + (confirmedEvent ? confirmedEvent.event_id : 'PENDIENTE')"></span></div>
                <div class="flex justify-between text-zinc-400"><span>Anfitrión / Celebración:</span> <span class="text-white font-bold" x-text="confirmedEvent ? confirmedEvent.event_name : event.clientName"></span></div>
                <div class="flex justify-between text-zinc-400"><span>Fecha de la Gala:</span> <span class="text-white" x-text="confirmedEvent ? confirmedEvent.date : event.date"></span></div>
                <div class="flex justify-between text-zinc-400"><span>Aforo Confirmado:</span> <span class="text-white" x-text="event.guests + ' personas'"></span></div>
                <div class="flex justify-between text-zinc-400"><span>Locación Elegida:</span> <span class="text-amber-400 font-bold" x-text="event.location_type === 'the_ring' ? (event.salon ? event.salon.name : 'Salón The Ring') : (event.location_type === 'external_the_ring' ? 'Hacienda Externa' : 'Predio Propio Cliente')"></span></div>
                <template x-if="dressApplies() && event.vestuario.dress_id">
                    <div class="flex justify-between text-zinc-400"><span>Vestido Principal:</span> <span class="text-white font-bold" x-text="event.vestuario.vestido_estilo"></span></div>
                </template>
                <div class="flex justify-between text-zinc-400"><span>Concepto Temático:</span> <span class="text-white" x-text="event.tematica.concepto"></span></div>
                <div class="flex justify-between text-zinc-400"><span>Sillas Seleccionadas:</span> <span class="text-white" x-text="event.mobiliario.sillas"></span></div>
                <div class="flex justify-between text-zinc-400"><span>Trono Presidencial:</span> <span class="text-white" x-text="event.mobiliario.trono_presidencial"></span></div>
                <div class="flex justify-between text-zinc-400"><span>Servicios Contratados:</span> <span class="text-emerald-400 font-bold" x-text="Object.keys(selectedServices).length + ' ítems'"></span></div>
                <div class="flex justify-between text-zinc-400 pt-2 border-t border-white/10 font-sans text-sm"><span>Presupuesto Estimado:</span> <span class="text-amber-400 font-black" x-text="formatMoney(getGrandTotal())"></span></div>
            </div>

            <div class="space-y-3">
                <a :href="'https://wa.me/573000000000?text=' + encodeURIComponent('Hola Eventos The Ring, acabo de registrar la cotización para mi ' + event.type + ' (' + event.clientName + ') para la fecha ' + event.date + ' con locación ' + (event.salon ? event.salon.name : event.location_type) + '. Código de evento: #' + (confirmedEvent ? confirmedEvent.event_id : ''))" target="_blank" class="w-full py-4 bg-emerald-500 hover:bg-emerald-600 text-white font-bold rounded-2xl flex items-center justify-center gap-3 transition-colors shadow-lg">
                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.007c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.275.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.043.073.043.419-.101.824z"/></svg>
                    Hablar por WhatsApp con el Asesor Principal
                </a>
                <a href="/cliente" class="block w-full py-3 bg-zinc-800 hover:bg-zinc-700 text-amber-400 font-bold rounded-2xl transition-colors text-xs uppercase tracking-widest text-center">
                    Acceder a mi Panel de Cliente
                </a>
            </div>
        </div>
    </div>

    {{-- BARRA SUPERIOR DE PROGRESO DEL ATELIER --}}
    <div class="w-full max-w-7xl mx-auto px-6 mb-8">
        <div class="flex items-center justify-between py-4 border-b border-zinc-200 dark:border-white/10">
            <div>
                <span class="text-xs font-mono tracking-widest uppercase text-amber-500 font-bold">Atelier & Event Studio The Ring</span>
                <h1 class="text-2xl md:text-3xl font-black tracking-tight text-zinc-900 dark:text-white">
                    <span x-show="step === 1">1. Fundamentos & Fecha Soñada</span>
                    <span x-show="step === 2">2. 🏰 Salón & Locación (The Ring, Finca Externa o Propia)</span>
                    <span x-show="step === 3">3. 👗 Alta Costura & Vestuario Real (Boda & 15 Años)</span>
                    <span x-show="step === 4">4. 🎨 Concepto Temático, Sillas & Trono Presidencial</span>
                    <span x-show="step === 5">5. 🍽️ Banquete Gourmet & Brindis</span>
                    <span x-show="step === 6">6. ✨ Escenografía, Efectos & Pista 3D</span>
                    <span x-show="step === 7">7. 📸 Memorias, Audiovisuales & Drones</span>
                    <span x-show="step === 8">8. 📋 Resumen Maestro & Confirmación</span>
                </h1>
            </div>

            <div class="flex items-center gap-4">
                <span class="text-xs font-mono uppercase tracking-widest text-zinc-500">Etapa <span x-text="step"></span> de <span x-text="totalSteps"></span></span>
                <div class="w-28 md:w-44 h-2.5 bg-zinc-200 dark:bg-zinc-800 rounded-full overflow-hidden p-0.5">
                    <div class="h-full bg-gradient-to-r from-amber-400 to-amber-600 rounded-full transition-all duration-500" :style="'width: ' + ((step / totalSteps) * 100) + '%'"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- CONTENEDOR PRINCIPAL: FORMULARIO + RESUMEN EN VIVO --}}
    <div class="w-full max-w-7xl mx-auto px-6 flex-grow grid grid-cols-1 lg:grid-cols-12 gap-8 pb-32">
        
        {{-- COLUMNA IZQUIERDA: FORMULARIO PASO A PASO (8 COLUMNAS) --}}
        <div class="lg:col-span-8 space-y-8">
            
            {{-- Mensaje de Error si falla la API --}}
            <div x-show="submitError" x-cloak class="p-4 rounded-2xl bg-red-500/10 border border-red-500/30 text-red-500 text-sm flex items-center justify-between">
                <span x-text="submitError"></span>
                <button type="button" @click="submitError = ''" class="font-bold text-lg">&times;</button>
            </div>

            {{-- ========================================================
                 PASO 1: FUNDAMENTOS Y FECHA
                 ======================================================== --}}
            <div x-show="step === 1" x-cloak class="glass-luxury p-8 md:p-10 rounded-3xl space-y-8">
                <div>
                    <h2 class="text-xl font-black text-zinc-900 dark:text-white uppercase tracking-wider mb-1">Los Anfitriones & La Fecha Soñada</h2>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Cuéntanos quién celebra y cuándo cobrará vida la magia.</p>
                </div>

                {{-- Tipo de Celebración (Define si el Vestuario aplica) --}}
                <div>
                    <label class="text-xs font-bold uppercase tracking-widest text-zinc-500 dark:text-zinc-400 block mb-4">
                        Tipo de Celebración 
                        <span class="text-amber-500 font-normal lowercase">(los vestidos de alta costura aplican para Bodas y 15 Años)</span>
                    </label>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                        <template x-for="t in ['Boda', '15 Años', 'Gala / Banquete', 'Corporativo', 'Cumpleaños VIP', 'Graduación', 'Aniversario', 'Otro']" :key="t">
                            <button type="button" @click="event.type = t" :class="event.type === t ? 'bg-amber-500 text-black font-black shadow-lg shadow-amber-500/30 border-amber-500' : 'bg-zinc-100 dark:bg-zinc-900 border-zinc-200 dark:border-white/10 text-zinc-700 dark:text-zinc-300'" class="py-3 px-4 rounded-2xl text-xs uppercase tracking-wider font-bold border transition-all text-center flex flex-col items-center justify-center gap-1">
                                <span class="text-base" x-text="t === 'Boda' ? '💍' : (t === '15 Años' ? '👑' : (t === 'Corporativo' ? '🏢' : '✨'))"></span>
                                <span x-text="t"></span>
                            </button>
                        </template>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="text-xs font-bold uppercase tracking-widest text-zinc-500 dark:text-zinc-400 block mb-2">Nombre Completo del Anfitrión(a) *</label>
                        <input type="text" x-model="event.clientName" class="input-canvas" placeholder="Ej: Valentina Gómez & Mateo Silva" required>
                    </div>

                    <div>
                        <label class="text-xs font-bold uppercase tracking-widest text-zinc-500 dark:text-zinc-400 block mb-2">WhatsApp / Teléfono Móvil *</label>
                        <input type="tel" x-model="event.phone" class="input-canvas" placeholder="+57 300 123 4567" required>
                    </div>

                    <div>
                        <label class="text-xs font-bold uppercase tracking-widest text-zinc-500 dark:text-zinc-400 block mb-2">Correo Electrónico (Para tu panel privado)</label>
                        <input type="email" x-model="event.email" class="input-canvas" placeholder="correo@ejemplo.com">
                    </div>

                    <div>
                        <label class="text-xs font-bold uppercase tracking-widest text-zinc-500 dark:text-zinc-400 block mb-2">Fecha Tentativa del Evento *</label>
                        <input type="date" x-model="event.date" :min="minDate" @change="checkDate()" class="input-canvas" required>
                        <span x-show="dateError" class="text-red-500 text-xs mt-2 block font-bold" x-text="dateError"></span>
                    </div>
                </div>

                {{-- Horario / Jornada del Evento --}}
                <div>
                    <label class="text-xs font-bold uppercase tracking-widest text-zinc-500 dark:text-zinc-400 block mb-3">Momento de la Celebración</label>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <button type="button" @click="event.timeSlot = 'Noche de Gala (18:00 a 04:00)'" :class="event.timeSlot.includes('Noche') ? 'border-amber-500 bg-amber-500/10 text-amber-500 font-bold' : 'border-zinc-200 dark:border-white/10 text-zinc-400'" class="p-3.5 rounded-2xl border text-xs uppercase tracking-wider text-left transition-all">
                            <span class="block font-black text-sm">🌙 Noche de Gala</span>
                            <span class="text-[10px] opacity-75">18:00 a 04:00 AM (Clásica The Ring)</span>
                        </button>
                        <button type="button" @click="event.timeSlot = 'Atardecer Dorado (15:00 a 23:00)'" :class="event.timeSlot.includes('Atardecer') ? 'border-amber-500 bg-amber-500/10 text-amber-500 font-bold' : 'border-zinc-200 dark:border-white/10 text-zinc-400'" class="p-3.5 rounded-2xl border text-xs uppercase tracking-wider text-left transition-all">
                            <span class="block font-black text-sm">🌅 Atardecer Dorado</span>
                            <span class="text-[10px] opacity-75">15:00 a 23:00 PM (Golden Hour)</span>
                        </button>
                        <button type="button" @click="event.timeSlot = 'Día Radiante (10:00 a 18:00)'" :class="event.timeSlot.includes('Día') ? 'border-amber-500 bg-amber-500/10 text-amber-500 font-bold' : 'border-zinc-200 dark:border-white/10 text-zinc-400'" class="p-3.5 rounded-2xl border text-xs uppercase tracking-wider text-left transition-all">
                            <span class="block font-black text-sm">☀️ Día Radiante</span>
                            <span class="text-[10px] opacity-75">10:00 a 18:00 PM (Almuerzo de Gala)</span>
                        </button>
                    </div>
                </div>

                {{-- Slider Aforo --}}
                <div>
                    <div class="flex justify-between items-end mb-4">
                        <label class="text-xs font-bold uppercase tracking-widest text-zinc-500 dark:text-zinc-400">Aforo de Invitados Estimado</label>
                        <span class="text-3xl font-black text-amber-500" x-text="event.guests + ' personas'"></span>
                    </div>
                    <input type="range" min="30" max="800" step="10" x-model="event.guests" class="w-full accent-amber-500 h-2 bg-zinc-200 dark:bg-zinc-800 rounded-lg appearance-none cursor-pointer">
                    <div class="flex justify-between text-[10px] text-zinc-400 uppercase font-mono mt-2">
                        <span>30 Íntimo</span>
                        <span>150 Salón Nubes</span>
                        <span>350 Salón Imperial</span>
                        <span>800+ Todo The Ring o Hacienda</span>
                    </div>
                </div>
            </div>

            {{-- ========================================================
                 PASO 2: SALONES Y LOCACIONES (PROPIOS, EXTERNOS O DEL CLIENTE)
                 (¡Requerimiento explícito del usuario!)
                 ======================================================== --}}
            <div x-show="step === 2" x-cloak class="glass-luxury p-8 md:p-10 rounded-3xl space-y-8">
                <div>
                    <h2 class="text-xl font-black text-zinc-900 dark:text-white uppercase tracking-wider mb-1">Escenario & Modalidad de Locación</h2>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">
                        Celebra en los exclusivos salones de The Ring, déjanos conseguir la hacienda de tus sueños en cualquier parte del país, o llevamos toda nuestra producción a tu propio lugar.
                    </p>
                </div>

                {{-- 3 MODALIDADES VISUALES DE LOCACIÓN --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    {{-- Opción 1: Salones The Ring --}}
                    <div @click="event.location_type = 'the_ring'" class="cursor-pointer rounded-2xl p-5 border transition-all relative flex flex-col justify-between" :class="event.location_type === 'the_ring' ? 'choice-card-active bg-amber-500/10' : 'border-zinc-200 dark:border-white/10 hover:border-amber-500/50 bg-white/40 dark:bg-zinc-900/40'">
                        <div>
                            <div class="w-12 h-12 rounded-xl bg-amber-500/20 text-amber-500 flex items-center justify-center text-2xl mb-3">
                                🏰
                            </div>
                            <h3 class="font-bold text-base text-zinc-900 dark:text-white mb-1">Salones The Ring (Sede Principal)</h3>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400 leading-relaxed">
                                Nuestros pisos inteligentes con acústica envolvente, suites privadas y montaje listo en Bogotá.
                            </p>
                        </div>
                        <div class="mt-4 pt-3 border-t border-zinc-200 dark:border-white/10 flex items-center justify-between text-xs font-bold text-amber-500">
                            <span>Sede Insignia</span>
                            <span x-show="event.location_type === 'the_ring'">✓ Activo</span>
                        </div>
                    </div>

                    {{-- Opción 2: Locación Externa Gestionada por The Ring --}}
                    <div @click="event.location_type = 'external_the_ring'" class="cursor-pointer rounded-2xl p-5 border transition-all relative flex flex-col justify-between" :class="event.location_type === 'external_the_ring' ? 'choice-card-active bg-amber-500/10' : 'border-zinc-200 dark:border-white/10 hover:border-amber-500/50 bg-white/40 dark:bg-zinc-900/40'">
                        <div>
                            <div class="w-12 h-12 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-2xl mb-3">
                                🌳
                            </div>
                            <h3 class="font-bold text-base text-zinc-900 dark:text-white mb-1">Hacienda Externa Gestionada por The Ring</h3>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400 leading-relaxed">
                                Buscamos, alquilamos y producimos tu evento en haciendas de la Sabana, Villa de Leyva, Medellín o Cartagena.
                            </p>
                        </div>
                        <div class="mt-4 pt-3 border-t border-zinc-200 dark:border-white/10 flex items-center justify-between text-xs font-bold text-emerald-500">
                            <span>Cobertura Nacional</span>
                            <span x-show="event.location_type === 'external_the_ring'">✓ Activo</span>
                        </div>
                    </div>

                    {{-- Opción 3: Predio Propio del Cliente --}}
                    <div @click="event.location_type = 'client_location'" class="cursor-pointer rounded-2xl p-5 border transition-all relative flex flex-col justify-between" :class="event.location_type === 'client_location' ? 'choice-card-active bg-amber-500/10' : 'border-zinc-200 dark:border-white/10 hover:border-amber-500/50 bg-white/40 dark:bg-zinc-900/40'">
                        <div>
                            <div class="w-12 h-12 rounded-xl bg-purple-500/20 text-purple-400 flex items-center justify-center text-2xl mb-3">
                                🏡
                            </div>
                            <h3 class="font-bold text-base text-zinc-900 dark:text-white mb-1">Tu Propio Salón, Finca o Casa</h3>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400 leading-relaxed">
                                Ya tienes el espacio. Nosotros trasladamos mobiliario, banquete, sonido, show y el staff completo.
                            </p>
                        </div>
                        <div class="mt-4 pt-3 border-t border-zinc-200 dark:border-white/10 flex items-center justify-between text-xs font-bold text-purple-500">
                            <span>Despliegue Móvil</span>
                            <span x-show="event.location_type === 'client_location'">✓ Activo</span>
                        </div>
                    </div>
                </div>

                {{-- SUB-VISTA 1: SALONES PROPIOS THE RING --}}
                <div x-show="event.location_type === 'the_ring'" x-transition class="space-y-4">
                    <label class="text-xs font-bold uppercase tracking-widest text-zinc-500 dark:text-zinc-400 block">Selecciona el Salón de la Sede Principal</label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <template x-for="salon in salones" :key="salon.id">
                            <div @click="event.salon = (event.salon && event.salon.id === salon.id ? null : salon)" class="group cursor-pointer rounded-2xl overflow-hidden border transition-all relative flex flex-col justify-between" :class="event.salon && event.salon.id === salon.id ? 'choice-card-active' : 'border-zinc-200 dark:border-white/10 hover:border-amber-500/50'">
                                <div class="relative h-48 overflow-hidden">
                                    <img :src="salon.img" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                    <div class="absolute top-3 right-3 bg-black/75 backdrop-blur-md text-amber-400 text-[10px] font-mono px-3 py-1 rounded-full uppercase tracking-widest" x-text="'Hasta ' + salon.capacity + ' pax'"></div>
                                </div>
                                <div class="p-5 flex-grow flex flex-col justify-between bg-white dark:bg-zinc-900/60">
                                    <div>
                                        <h3 class="font-bold text-lg text-zinc-900 dark:text-white" x-text="salon.name"></h3>
                                        <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1 line-clamp-2" x-text="salon.desc"></p>
                                    </div>
                                    <div class="mt-4 pt-4 border-t border-zinc-100 dark:border-white/10 flex justify-between items-center">
                                        <span class="text-xs text-zinc-400 font-mono">Inversión Base:</span>
                                        <span class="text-sm font-black text-amber-500" x-text="formatMoney(salon.price)"></span>
                                    </div>
                                </div>
                                <div x-show="event.salon && event.salon.id === salon.id" class="absolute top-3 left-3 bg-amber-500 text-black text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest shadow-lg">
                                    Seleccionado
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                {{-- SUB-VISTA 2: LOCACIÓN EXTERNA GESTIONADA POR THE RING --}}
                <div x-show="event.location_type === 'external_the_ring'" x-transition class="p-6 rounded-3xl border border-emerald-500/30 bg-emerald-500/5 space-y-6">
                    <div class="flex items-center gap-3">
                        <span class="px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-400 font-mono text-xs uppercase font-bold tracking-widest">Servicio Concierge</span>
                        <h3 class="text-base font-bold text-zinc-900 dark:text-white">The Ring Consigue & Gestiona tu Locación Externa</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="text-xs font-bold uppercase tracking-widest text-zinc-500 dark:text-zinc-400 block mb-2">Ciudad o Destino Deseado *</label>
                            <input type="text" x-model="event.location_details.city" class="input-canvas" placeholder="Ej: Sabana de Bogotá, Sopó, Chía, Villa de Leyva, Medellín, etc.">
                        </div>

                        <div>
                            <label class="text-xs font-bold uppercase tracking-widest text-zinc-500 dark:text-zinc-400 block mb-2">Preferencia de Entorno</label>
                            <select x-model="event.location_details.venue_type" class="input-canvas text-sm py-2">
                                <option value="Hacienda Campestre de Lujo">🌳 Hacienda Campestre con Jardines</option>
                                <option value="Hotel Boutique 5 Estrellas">🏨 Hotel Boutique / Centro Histórico</option>
                                <option value="Club Campestre Privado">⛳ Club Campestre Privado</option>
                                <option value="Playa / Destino Caribe">🏖️ Frente a la Playa / Destino Tropical</option>
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label class="text-xs font-bold uppercase tracking-widest text-zinc-500 dark:text-zinc-400 block mb-2">Nombre de Hacienda de tu Preferencia (Opcional si ya tienes una en mente)</label>
                            <input type="text" x-model="event.location_details.venue_name" class="input-canvas" placeholder="Ej: Hacienda San Rafael, Hacienda Pozo Chico, o déjalo vacío para que te enviemos opciones">
                        </div>
                    </div>
                </div>

                {{-- SUB-VISTA 3: SALÓN O PREDIO PROPIO DEL CLIENTE --}}
                <div x-show="event.location_type === 'client_location'" x-transition class="p-6 rounded-3xl border border-purple-500/30 bg-purple-500/5 space-y-6">
                    <div class="flex items-center gap-3">
                        <span class="px-3 py-1 rounded-full bg-purple-500/20 text-purple-400 font-mono text-xs uppercase font-bold tracking-widest">Producción a Domicilio</span>
                        <h3 class="text-base font-bold text-zinc-900 dark:text-white">Tu Lugar Propio: The Ring Monta la Magia</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="text-xs font-bold uppercase tracking-widest text-zinc-500 dark:text-zinc-400 block mb-2">Ciudad / Municipio *</label>
                            <input type="text" x-model="event.location_details.city" class="input-canvas" placeholder="Ej: La Calera, Tabio, Bogotá...">
                        </div>

                        <div>
                            <label class="text-xs font-bold uppercase tracking-widest text-zinc-500 dark:text-zinc-400 block mb-2">Nombre de la Finca o Salón</label>
                            <input type="text" x-model="event.location_details.venue_name" class="input-canvas" placeholder="Ej: Finca Los Eucaliptos / Conjunto...">
                        </div>

                        <div>
                            <label class="text-xs font-bold uppercase tracking-widest text-zinc-500 dark:text-zinc-400 block mb-2">Dirección o Referencia</label>
                            <input type="text" x-model="event.location_details.address" class="input-canvas" placeholder="Ej: Km 5 Vía Principal">
                        </div>
                    </div>
                </div>
            </div>

            {{-- ========================================================
                 PASO 3: ALTA COSTURA & VESTIDOS REALES DESDE EL ADMIN
                 (¡Solo aplica para Boda y 15 Años!)
                 ======================================================== --}}
            <div x-show="step === 3" x-cloak class="glass-luxury p-8 md:p-10 rounded-3xl space-y-8">
                
                {{-- Caso 1: El evento NO es Boda ni 15 Años --}}
                <template x-if="!dressApplies()">
                    <div class="py-12 text-center space-y-4">
                        <div class="w-16 h-16 mx-auto rounded-full bg-zinc-200 dark:bg-zinc-800 text-zinc-400 flex items-center justify-center text-3xl">
                            👗
                        </div>
                        <h3 class="text-2xl font-black text-zinc-900 dark:text-white">Vestuario de Alta Costura No Requerido</h3>
                        <p class="text-sm text-zinc-500 max-w-lg mx-auto">
                            El catálogo de vestidos de novia y quinceañera aplica exclusivamente para <strong class="text-amber-500">Bodas</strong> y <strong class="text-amber-500">Fiestas de 15 Años</strong>. Para celebraciones tipo <span class="font-bold text-zinc-900 dark:text-white" x-text="event.type"></span>, avanzamos directamente al diseño de mobiliario y concepto temático.
                        </p>
                        <div class="pt-4">
                            <button type="button" @click="step = 4" class="px-8 py-3.5 bg-amber-500 text-black font-black text-xs uppercase tracking-widest rounded-full shadow-lg hover:scale-105 transition-all">
                                Continuar a Temática & Mobiliario Visual &rarr;
                            </button>
                        </div>
                    </div>
                </template>

                {{-- Caso 2: El evento ES Boda o 15 Años (Catálogo Fotográfico Real desde el Admin) --}}
                <template x-if="dressApplies()">
                    <div class="space-y-8">
                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <div class="flex items-center gap-2">
                                    <span class="px-2.5 py-0.5 rounded-full bg-amber-500/10 text-amber-500 font-mono text-[10px] uppercase font-bold tracking-widest">Atelier de Moda Real</span>
                                    <h2 class="text-xl font-black text-zinc-900 dark:text-white uppercase tracking-wider">
                                        <span x-text="event.type === 'Boda' ? '👗 Vestidos de Novia de Alta Costura' : '👑 Vestidos de Quinceañera de Gala'"></span>
                                    </h2>
                                </div>
                                <span class="text-xs font-mono text-zinc-400" x-text="getFilteredDresses().length + ' modelos disponibles'"></span>
                            </div>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">
                                Fotografías reales de nuestras piezas de alta costura subidas por el atelier central. Selecciona el diseño que lucirás en tu noche de ensueño.
                            </p>
                        </div>

                        {{-- Galería de Tarjetas Fotográficas de Vestidos Reales --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                            <template x-for="dress in getFilteredDresses()" :key="dress.id">
                                <div class="group rounded-3xl overflow-hidden border transition-all flex flex-col justify-between bg-white dark:bg-zinc-900/70"
                                     :class="event.vestuario.dress_id === dress.id ? 'choice-card-active' : 'border-zinc-200 dark:border-white/10 hover:border-amber-500/50'">
                                    
                                    {{-- Foto Principal del Vestido --}}
                                    <div class="relative h-64 overflow-hidden bg-black">
                                        <img :src="dress.img" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                        
                                        {{-- Badge de Silueta y Color --}}
                                        <div class="absolute top-3 left-3 flex flex-col gap-1.5">
                                            <span class="bg-black/80 backdrop-blur-md text-amber-400 text-[10px] font-mono px-2.5 py-0.5 rounded-full uppercase tracking-wider" x-text="dress.silhouette"></span>
                                            <span class="bg-white/90 text-zinc-900 text-[9px] font-bold px-2 py-0.5 rounded-full" x-text="dress.color"></span>
                                        </div>

                                        {{-- Botón para ver más fotos / zoom --}}
                                        <button type="button" @click.stop="previewDressModal = dress" class="absolute bottom-3 right-3 bg-black/75 hover:bg-black text-white p-2 rounded-xl text-xs backdrop-blur-md transition-all flex items-center gap-1 shadow-md">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            <span>Ver Fotos</span>
                                        </button>

                                        {{-- Check de Seleccionado --}}
                                        <div x-show="event.vestuario.dress_id === dress.id" class="absolute top-3 right-3 bg-amber-500 text-black p-1.5 rounded-full shadow-lg">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                    </div>

                                    {{-- Detalles y Botón de Selección --}}
                                    <div class="p-5 flex-grow flex flex-col justify-between">
                                        <div>
                                            <h3 class="font-bold text-base text-zinc-900 dark:text-white" x-text="dress.name"></h3>
                                            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1 line-clamp-2 leading-relaxed" x-text="dress.description"></p>
                                        </div>

                                        <div class="mt-4 pt-4 border-t border-zinc-100 dark:border-white/10 flex items-center justify-between">
                                            <div>
                                                <span class="text-[10px] text-zinc-400 font-mono block">Inversión:</span>
                                                <span class="text-xs font-black text-amber-500" x-text="dress.price > 0 ? formatMoney(dress.price) : 'Incluido'"></span>
                                            </div>

                                            <button type="button" @click="selectDress(dress)" :class="event.vestuario.dress_id === dress.id ? 'bg-amber-500 text-black font-black' : 'bg-zinc-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-200 hover:bg-amber-500 hover:text-black'" class="px-4 py-2 rounded-xl text-xs font-bold transition-all">
                                                <span x-text="event.vestuario.dress_id === dress.id ? '✓ Elegido' : 'Seleccionar'"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>

                        {{-- Opción: Ya tengo mi propio vestido --}}
                        <div class="p-5 rounded-2xl border border-zinc-200 dark:border-white/10 bg-white/40 dark:bg-zinc-900/40 flex items-center justify-between">
                            <div>
                                <h4 class="text-sm font-bold text-zinc-900 dark:text-white">¿Ya tienes tu propio vestido o confección independiente?</h4>
                                <p class="text-xs text-zinc-500">Puedes omitir la selección del catálogo y traer tu propio atuendo sin costo adicional.</p>
                            </div>
                            <button type="button" @click="event.vestuario.dress_id = null; event.vestuario.vestido_estilo = 'Vestuario Propio del Cliente'" :class="event.vestuario.vestido_estilo === 'Vestuario Propio del Cliente' ? 'bg-amber-500 text-black font-bold' : 'bg-zinc-200 dark:bg-zinc-800 text-zinc-400'" class="px-4 py-2 rounded-xl text-xs uppercase tracking-wider transition-all">
                                Traeré Mi Propio Vestido
                            </button>
                        </div>

                        {{-- Segundo Vestido para Rumba / Hora Loca --}}
                        <div class="p-5 rounded-2xl border border-zinc-200 dark:border-white/10 bg-white/40 dark:bg-zinc-900/40 space-y-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-sm font-bold text-zinc-900 dark:text-white block">¿Incluye 2do Vestido para la Rumba / Hora Loca?</span>
                                    <span class="text-xs text-zinc-500">Un diseño más cómodo, festivo y ligero para disfrutar el baile a plenitud.</span>
                                </div>
                                <button type="button" @click="event.vestuario.segundo_vestido = !event.vestuario.segundo_vestido" :class="event.vestuario.segundo_vestido ? 'bg-amber-500' : 'bg-zinc-300 dark:bg-zinc-800'" class="w-12 h-6 rounded-full transition-colors relative p-0.5">
                                    <span :class="event.vestuario.segundo_vestido ? 'translate-x-6 bg-black' : 'translate-x-0 bg-white'" class="block w-5 h-5 rounded-full transition-transform shadow-md"></span>
                                </button>
                            </div>
                            <div x-show="event.vestuario.segundo_vestido" x-transition>
                                <input type="text" x-model="event.vestuario.segundo_vestido_detalles" class="input-canvas text-sm" placeholder="Ej: Vestido cóctel corto con brillos plateados y tenis personalizados">
                            </div>
                        </div>

                        {{-- Traje del Novio / Anfitrión con FOTOS REALES --}}
                        <div class="pt-6 border-t border-zinc-200 dark:border-white/10 space-y-4">
                            <div>
                                <label class="text-xs font-bold uppercase tracking-widest text-zinc-500 dark:text-zinc-400 block mb-1">Traje del Novio / Padre / Anfitrión (Con Fotos Reales)</label>
                                <p class="text-xs text-zinc-400">Selecciona el porte visual del anfitrión:</p>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                                <template x-for="traje in trajesCatalog" :key="traje.nombre">
                                    <div @click="event.vestuario.traje_anfitrion = traje.nombre; event.vestuario.traje_img = traje.img" class="cursor-pointer rounded-2xl overflow-hidden border transition-all flex flex-col justify-between" :class="event.vestuario.traje_anfitrion === traje.nombre ? 'choice-card-active' : 'border-zinc-200 dark:border-white/10 hover:border-amber-500/40'">
                                        <div class="h-36 overflow-hidden bg-black relative">
                                            <img :src="traje.img" class="w-full h-full object-cover">
                                            <div x-show="event.vestuario.traje_anfitrion === traje.nombre" class="absolute top-2 right-2 bg-amber-500 text-black p-1 rounded-full">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                            </div>
                                        </div>
                                        <div class="p-3 bg-white dark:bg-zinc-900/80">
                                            <h5 class="text-xs font-bold text-zinc-900 dark:text-white" x-text="traje.nombre"></h5>
                                            <p class="text-[10px] text-zinc-400 mt-0.5 line-clamp-2" x-text="traje.desc"></p>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            {{-- Spa & Maquillaje VIP --}}
                            <div class="flex items-center justify-between p-4 rounded-2xl border border-zinc-200 dark:border-white/10 bg-white/40 dark:bg-zinc-900/40 mt-4">
                                <div>
                                    <span class="text-xs font-bold uppercase tracking-wider text-zinc-900 dark:text-white block">Spa, Peinado & Maquillaje VIP in-situ</span>
                                    <span class="text-[11px] text-zinc-400">Atención de alta cosmética en la suite privada antes de iniciar la gala</span>
                                </div>
                                <input type="checkbox" x-model="event.vestuario.spa_maquillaje" class="w-5 h-5 accent-amber-500 rounded cursor-pointer">
                            </div>
                        </div>
                    </div>
                </template>

            </div>

            {{-- ========================================================
                 PASO 4: CONCEPTO TEMÁTICO, SILLAS, TRONOS & ALFOMBRAS
                 (¡100% VISUAL CON FOTOS REALES!)
                 ======================================================== --}}
            <div x-show="step === 4" x-cloak class="glass-luxury p-8 md:p-10 rounded-3xl space-y-10">
                <div>
                    <h2 class="text-xl font-black text-zinc-900 dark:text-white uppercase tracking-wider mb-1">Atmósfera Visual & Mobiliario de Gala</h2>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Aprecia las fotos reales de cada elemento de decoración, sillería y el trono de honor.</p>
                </div>

                {{-- 1. CONCEPTO TEMÁTICO CON FOTOS REALES --}}
                <div class="space-y-4">
                    <label class="text-xs font-bold uppercase tracking-widest text-zinc-500 dark:text-zinc-400 block">
                        1. Concepto Temático Central (Fotos Reales de Montaje)
                    </label>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5">
                        <template x-for="tem in tematicasCatalog" :key="tem.nombre">
                            <div @click="event.tematica.concepto = tem.nombre; event.tematica.concepto_img = tem.img" class="cursor-pointer rounded-2xl overflow-hidden border transition-all flex flex-col justify-between group" :class="event.tematica.concepto === tem.nombre ? 'choice-card-active' : 'border-zinc-200 dark:border-white/10 hover:border-amber-500/40'">
                                <div class="h-40 overflow-hidden relative bg-black">
                                    <img :src="tem.img" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                    <div x-show="event.tematica.concepto === tem.nombre" class="absolute top-2.5 right-2.5 bg-amber-500 text-black px-2 py-0.5 rounded-full text-[9px] font-black uppercase tracking-widest shadow-md">
                                        Elegido
                                    </div>
                                </div>
                                <div class="p-4 bg-white dark:bg-zinc-900/80">
                                    <h4 class="font-bold text-sm text-zinc-900 dark:text-white mb-1" x-text="tem.nombre"></h4>
                                    <p class="text-[11px] text-zinc-500 dark:text-zinc-400 leading-relaxed" x-text="tem.desc"></p>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                {{-- 2. SILLAS DE INVITADOS CON FOTOS REALES --}}
                <div class="pt-6 border-t border-zinc-200 dark:border-white/10 space-y-4">
                    <label class="text-xs font-bold uppercase tracking-widest text-zinc-500 dark:text-zinc-400 block">
                        2. Sillería de Invitados (Fotos Reales de Sillas de Gala)
                    </label>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                        <template x-for="silla in sillasCatalog" :key="silla.nombre">
                            <div @click="event.mobiliario.sillas = silla.nombre; event.mobiliario.sillas_img = silla.img" class="cursor-pointer rounded-2xl overflow-hidden border transition-all flex flex-col justify-between group" :class="event.mobiliario.sillas === silla.nombre ? 'choice-card-active' : 'border-zinc-200 dark:border-white/10 hover:border-amber-500/40'">
                                <div class="h-44 overflow-hidden relative bg-black">
                                    <img :src="silla.img" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                    <div x-show="event.mobiliario.sillas === silla.nombre" class="absolute top-2 right-2 bg-amber-500 text-black p-1 rounded-full shadow-md">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                </div>
                                <div class="p-3.5 bg-white dark:bg-zinc-900/80">
                                    <h4 class="font-bold text-xs text-zinc-900 dark:text-white" x-text="silla.nombre"></h4>
                                    <p class="text-[10px] text-zinc-500 dark:text-zinc-400 mt-1 leading-relaxed" x-text="silla.desc"></p>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                {{-- 3. TRONO PRESIDENCIAL CON FOTOS REALES --}}
                <div class="pt-6 border-t border-zinc-200 dark:border-white/10 space-y-4">
                    <label class="text-xs font-bold uppercase tracking-widest text-zinc-500 dark:text-zinc-400 block">
                        3. Trono Presidencial de Honor (Fotos Reales)
                    </label>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                        <template x-for="trono in tronosCatalog" :key="trono.nombre">
                            <div @click="event.mobiliario.trono_presidencial = trono.nombre; event.mobiliario.trono_img = trono.img" class="cursor-pointer rounded-2xl overflow-hidden border transition-all flex flex-col justify-between group" :class="event.mobiliario.trono_presidencial === trono.nombre ? 'choice-card-active' : 'border-zinc-200 dark:border-white/10 hover:border-amber-500/40'">
                                <div class="h-44 overflow-hidden relative bg-black">
                                    <img :src="trono.img" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                    <div x-show="event.mobiliario.trono_presidencial === trono.nombre" class="absolute top-2 right-2 bg-amber-500 text-black p-1 rounded-full shadow-md">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                </div>
                                <div class="p-3.5 bg-white dark:bg-zinc-900/80">
                                    <h4 class="font-bold text-xs text-zinc-900 dark:text-white" x-text="trono.nombre"></h4>
                                    <p class="text-[10px] text-zinc-500 dark:text-zinc-400 mt-1 leading-relaxed" x-text="trono.desc"></p>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                {{-- 4. PASARELA & ALFOMBRA TRIUNFAL CON FOTOS REALES --}}
                <div class="pt-6 border-t border-zinc-200 dark:border-white/10 space-y-4">
                    <label class="text-xs font-bold uppercase tracking-widest text-zinc-500 dark:text-zinc-400 block">
                        4. Paseo Triunfal / Alfombra de Entrada (Fotos Reales)
                    </label>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                        <template x-for="pasarela in pasarelasCatalog" :key="pasarela.nombre">
                            <div @click="event.mobiliario.pasarela_alfombra = pasarela.nombre; event.mobiliario.pasarela_img = pasarela.img" class="cursor-pointer rounded-2xl overflow-hidden border transition-all flex flex-col justify-between group" :class="event.mobiliario.pasarela_alfombra === pasarela.nombre ? 'choice-card-active' : 'border-zinc-200 dark:border-white/10 hover:border-amber-500/40'">
                                <div class="h-36 overflow-hidden relative bg-black">
                                    <img :src="pasarela.img" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                    <div x-show="event.mobiliario.pasarela_alfombra === pasarela.nombre" class="absolute top-2 right-2 bg-amber-500 text-black p-1 rounded-full shadow-md">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                </div>
                                <div class="p-3 bg-white dark:bg-zinc-900/80">
                                    <h4 class="font-bold text-xs text-zinc-900 dark:text-white" x-text="pasarela.nombre"></h4>
                                    <p class="text-[10px] text-zinc-500 dark:text-zinc-400 mt-0.5 line-clamp-2" x-text="pasarela.desc"></p>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                {{-- 5. Paletas Cromáticas Interactivas --}}
                <div class="pt-6 border-t border-zinc-200 dark:border-white/10 space-y-4">
                    <label class="text-xs font-bold uppercase tracking-widest text-zinc-500 dark:text-zinc-400 block">
                        5. Paleta Cromática de Iluminación & Mantelería
                    </label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                        <template x-for="pal in paletasCatalog" :key="pal.nombre">
                            <div @click="event.tematica.paleta_nombre = pal.nombre; event.tematica.color_primario = pal.c1; event.tematica.color_secundario = pal.c2" class="p-3.5 rounded-2xl border cursor-pointer transition-all flex items-center gap-3" :class="event.tematica.paleta_nombre === pal.nombre ? 'choice-card-active bg-amber-500/10' : 'border-zinc-200 dark:border-white/10'">
                                <div class="flex -space-x-2 shrink-0">
                                    <span class="w-6 h-6 rounded-full border-2 border-white dark:border-black shadow-sm" :style="'background-color: ' + pal.c1"></span>
                                    <span class="w-6 h-6 rounded-full border-2 border-white dark:border-black shadow-sm" :style="'background-color: ' + pal.c2"></span>
                                </div>
                                <div class="truncate">
                                    <span class="text-xs font-bold text-zinc-900 dark:text-white block truncate" x-text="pal.nombre"></span>
                                    <span class="text-[10px] text-zinc-400 truncate block" x-text="pal.text"></span>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            {{-- ========================================================
                 PASO 5: BANQUETE GOURMET & BRINDIS (Servicios BD)
                 ======================================================== --}}
            <div x-show="step === 5" x-cloak class="glass-luxury p-8 md:p-10 rounded-3xl space-y-8">
                <div>
                    <h2 class="text-xl font-black text-zinc-900 dark:text-white uppercase tracking-wider mb-1">Gastronomía Culinaria & Coctelería</h2>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Servicios culinarios oficiales The Ring, repostería y barras de autor.</p>
                </div>

                {{-- Selección de Modalidad Culinaria --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="p-4 rounded-2xl border border-zinc-200 dark:border-white/10 bg-white/40 dark:bg-zinc-900/40">
                        <label class="text-xs font-bold uppercase tracking-widest text-zinc-500 block mb-2">Modalidad de Banquete</label>
                        <select x-model="event.banquete.tipo_servicio" class="input-canvas text-xs py-1.5">
                            <option value="Banquete a la Mesa 3 Tiempos">🍽️ Emplatado a la Mesa (3 Tiempos)</option>
                            <option value="Gala Gourmet 4 Tiempos">🍷 Degustación de Autor (4 Tiempos)</option>
                            <option value="Buffet Internacional">🥗 Gran Buffet Asistido</option>
                            <option value="Estaciones Gastronómicas">🍢 Estaciones en Vivo (Sushi & Grill)</option>
                        </select>
                    </div>
                    <div class="p-4 rounded-2xl border border-zinc-200 dark:border-white/10 bg-white/40 dark:bg-zinc-900/40">
                        <label class="text-xs font-bold uppercase tracking-widest text-zinc-500 block mb-2">Torta & Repostería</label>
                        <select x-model="event.banquete.torta_gala" class="input-canvas text-xs py-1.5">
                            <option value="Torta Monumental 5 Pisos">🎂 Torta Monumental 5 Pisos</option>
                            <option value="Torta Artística 3 Pisos">🎂 Torta Artística 3 Pisos</option>
                            <option value="Mesa de Postres Franceses">🧁 Mesa de Postres Franceses</option>
                        </select>
                    </div>
                    <div class="p-4 rounded-2xl border border-zinc-200 dark:border-white/10 bg-white/40 dark:bg-zinc-900/40">
                        <label class="text-xs font-bold uppercase tracking-widest text-zinc-500 block mb-2">Brindis & Bebidas</label>
                        <select x-model="event.banquete.bar_cocteleria" class="input-canvas text-xs py-1.5">
                            <option value="Barra Libre Premium">🍸 Barra Libre Licores Premium</option>
                            <option value="Cóctel de Autor">🍹 Cóctel de Bienvenida de Autor</option>
                            <option value="Brindis Champaña">🥂 Brindis con Champaña Brut</option>
                        </select>
                    </div>
                </div>

                {{-- Servicios de Gastronomía desde la BD --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <template x-for="svc in (categoriesMap['Gastronomía'] || [])" :key="svc.id">
                        <div class="p-5 rounded-2xl border transition-all flex gap-4" :class="isServiceSelected(svc.id) ? 'border-amber-500 bg-amber-500/5 ring-1 ring-amber-500/30' : 'border-zinc-200 dark:border-white/10 bg-white/50 dark:bg-zinc-900/40'">
                            <img :src="svc.img" class="w-24 h-24 object-cover rounded-xl shrink-0">
                            <div class="flex-grow flex flex-col justify-between">
                                <div>
                                    <div class="flex justify-between items-start gap-2">
                                        <h3 class="font-bold text-base text-zinc-900 dark:text-white" x-text="svc.name"></h3>
                                        <input type="checkbox" :checked="isServiceSelected(svc.id)" @change="toggleService(svc)" class="w-5 h-5 accent-amber-500 rounded cursor-pointer mt-1">
                                    </div>
                                    <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1 line-clamp-2" x-text="svc.description"></p>
                                </div>
                                
                                <div class="mt-3 pt-3 border-t border-zinc-100 dark:border-white/10 flex justify-between items-center">
                                    <span class="text-xs font-black text-amber-500" x-text="formatMoney(svc.base_price)"></span>
                                    
                                    <div x-show="isServiceSelected(svc.id)" class="flex items-center gap-2 bg-zinc-100 dark:bg-zinc-800 rounded-lg px-2 py-1">
                                        <button type="button" @click="changeServiceQty(svc.id, -1)" class="w-5 h-5 text-zinc-600 dark:text-zinc-300 font-bold hover:text-amber-500">-</button>
                                        <span class="text-xs font-bold text-zinc-900 dark:text-white px-1" x-text="selectedServices[svc.id] ? selectedServices[svc.id].quantity : 1"></span>
                                        <button type="button" @click="changeServiceQty(svc.id, 1)" class="w-5 h-5 text-zinc-600 dark:text-zinc-300 font-bold hover:text-amber-500">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            {{-- ========================================================
                 PASO 6: ESCENOGRAFÍA, EFECTOS & PISTA (Servicios BD)
                 ======================================================== --}}
            <div x-show="step === 6" x-cloak class="glass-luxury p-8 md:p-10 rounded-3xl space-y-6">
                <div>
                    <h2 class="text-xl font-black text-zinc-900 dark:text-white uppercase tracking-wider mb-1">Efectos Especiales, Shows & Pista</h2>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Pista LED infinita, niebla criogénica para el vals y pirotecnia fría segura.</p>
                </div>

                {{-- Protocolos destacados --}}
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 p-4 rounded-2xl border border-zinc-200 dark:border-white/10 bg-white/40 dark:bg-zinc-900/40">
                    <label class="flex items-center gap-2 text-xs font-bold cursor-pointer">
                        <input type="checkbox" x-model="event.protocolo.vals_humo_frio" class="w-4 h-4 accent-amber-500 rounded">
                        <span>Humo Frío Vals</span>
                    </label>
                    <label class="flex items-center gap-2 text-xs font-bold cursor-pointer">
                        <input type="checkbox" x-model="event.protocolo.pirotecnia_brindis" class="w-4 h-4 accent-amber-500 rounded">
                        <span>Chispas Brindis</span>
                    </label>
                    <label class="flex items-center gap-2 text-xs font-bold cursor-pointer">
                        <input type="checkbox" x-model="event.protocolo.pista_3d_led" class="w-4 h-4 accent-amber-500 rounded">
                        <span>Pista 3D LED</span>
                    </label>
                    <label class="flex items-center gap-2 text-xs font-bold cursor-pointer">
                        <input type="checkbox" x-model="event.protocolo.maestro_ceremonia" class="w-4 h-4 accent-amber-500 rounded">
                        <span>Animador Protocolar</span>
                    </label>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <template x-for="svc in (categoriesMap['Efectos & Shows'] || categoriesMap['Escenografía'] || [])" :key="svc.id">
                        <div class="p-5 rounded-2xl border transition-all flex gap-4" :class="isServiceSelected(svc.id) ? 'border-amber-500 bg-amber-500/5 ring-1 ring-amber-500/30' : 'border-zinc-200 dark:border-white/10 bg-white/50 dark:bg-zinc-900/40'">
                            <img :src="svc.img" class="w-24 h-24 object-cover rounded-xl shrink-0">
                            <div class="flex-grow flex flex-col justify-between">
                                <div>
                                    <div class="flex justify-between items-start gap-2">
                                        <h3 class="font-bold text-base text-zinc-900 dark:text-white" x-text="svc.name"></h3>
                                        <input type="checkbox" :checked="isServiceSelected(svc.id)" @change="toggleService(svc)" class="w-5 h-5 accent-amber-500 rounded cursor-pointer mt-1">
                                    </div>
                                    <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1 line-clamp-2" x-text="svc.description"></p>
                                </div>
                                
                                <div class="mt-3 pt-3 border-t border-zinc-100 dark:border-white/10 flex justify-between items-center">
                                    <span class="text-xs font-black text-amber-500" x-text="formatMoney(svc.base_price)"></span>
                                    
                                    <div x-show="isServiceSelected(svc.id)" class="flex items-center gap-2 bg-zinc-100 dark:bg-zinc-800 rounded-lg px-2 py-1">
                                        <button type="button" @click="changeServiceQty(svc.id, -1)" class="w-5 h-5 text-zinc-600 dark:text-zinc-300 font-bold hover:text-amber-500">-</button>
                                        <span class="text-xs font-bold text-zinc-900 dark:text-white px-1" x-text="selectedServices[svc.id] ? selectedServices[svc.id].quantity : 1"></span>
                                        <button type="button" @click="changeServiceQty(svc.id, 1)" class="w-5 h-5 text-zinc-600 dark:text-zinc-300 font-bold hover:text-amber-500">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            {{-- ========================================================
                 PASO 7: TECNOLOGÍA & AUDIOVISUALES (Servicios BD)
                 ======================================================== --}}
            <div x-show="step === 7" x-cloak class="glass-luxury p-8 md:p-10 rounded-3xl space-y-6">
                <div>
                    <h2 class="text-xl font-black text-zinc-900 dark:text-white uppercase tracking-wider mb-1">Tecnología & Captura de Memorias</h2>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Plataforma 360 Spin, pantallas gigantes de alta tasa de refresco y cinematografía Drone 4K.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <template x-for="svc in (categoriesMap['Tecnología'] || [])" :key="svc.id">
                        <div class="p-5 rounded-2xl border transition-all flex gap-4" :class="isServiceSelected(svc.id) ? 'border-amber-500 bg-amber-500/5 ring-1 ring-amber-500/30' : 'border-zinc-200 dark:border-white/10 bg-white/50 dark:bg-zinc-900/40'">
                            <img :src="svc.img" class="w-24 h-24 object-cover rounded-xl shrink-0">
                            <div class="flex-grow flex flex-col justify-between">
                                <div>
                                    <div class="flex justify-between items-start gap-2">
                                        <h3 class="font-bold text-base text-zinc-900 dark:text-white" x-text="svc.name"></h3>
                                        <input type="checkbox" :checked="isServiceSelected(svc.id)" @change="toggleService(svc)" class="w-5 h-5 accent-amber-500 rounded cursor-pointer mt-1">
                                    </div>
                                    <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1 line-clamp-2" x-text="svc.description"></p>
                                </div>
                                
                                <div class="mt-3 pt-3 border-t border-zinc-100 dark:border-white/10 flex justify-between items-center">
                                    <span class="text-xs font-black text-amber-500" x-text="formatMoney(svc.base_price)"></span>
                                    
                                    <div x-show="isServiceSelected(svc.id)" class="flex items-center gap-2 bg-zinc-100 dark:bg-zinc-800 rounded-lg px-2 py-1">
                                        <button type="button" @click="changeServiceQty(svc.id, -1)" class="w-5 h-5 text-zinc-600 dark:text-zinc-300 font-bold hover:text-amber-500">-</button>
                                        <span class="text-xs font-bold text-zinc-900 dark:text-white px-1" x-text="selectedServices[svc.id] ? selectedServices[svc.id].quantity : 1"></span>
                                        <button type="button" @click="changeServiceQty(svc.id, 1)" class="w-5 h-5 text-zinc-600 dark:text-zinc-300 font-bold hover:text-amber-500">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            {{-- ========================================================
                 PASO 8: RESUMEN MAESTRO & CONFIRMACIÓN
                 ======================================================== --}}
            <div x-show="step === 8" x-cloak class="glass-luxury p-8 md:p-10 rounded-3xl space-y-8">
                <div>
                    <h2 class="text-xl font-black text-zinc-900 dark:text-white uppercase tracking-wider mb-1">Resumen & Validación de tu Evento</h2>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">Verifica cada elemento de tu celebración antes de transferirlo al calendario oficial.</p>
                </div>

                {{-- Ficha de Resumen Maestro --}}
                <div class="bg-zinc-100 dark:bg-zinc-900/80 rounded-2xl p-6 border border-zinc-200 dark:border-white/10 space-y-4">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 pb-4 border-b border-zinc-200 dark:border-white/10">
                        <div>
                            <span class="text-[10px] font-mono uppercase text-zinc-400 block">Anfitrión</span>
                            <span class="font-bold text-sm text-zinc-900 dark:text-white" x-text="event.clientName"></span>
                        </div>
                        <div>
                            <span class="text-[10px] font-mono uppercase text-zinc-400 block">Fecha Solicitada</span>
                            <span class="font-bold text-sm text-amber-500" x-text="event.date"></span>
                        </div>
                        <div>
                            <span class="text-[10px] font-mono uppercase text-zinc-400 block">Celebración</span>
                            <span class="font-bold text-sm text-zinc-900 dark:text-white" x-text="event.type + ' (' + event.guests + ' pax)'"></span>
                        </div>
                        <div>
                            <span class="text-[10px] font-mono uppercase text-zinc-400 block">Locación</span>
                            <span class="font-bold text-sm text-zinc-900 dark:text-white" x-text="event.location_type === 'the_ring' ? (event.salon ? event.salon.name : 'The Ring Principal') : (event.location_type === 'external_the_ring' ? 'Hacienda Externa' : 'Predio Propio Cliente')"></span>
                        </div>
                    </div>

                    {{-- Vestuario y Temática --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pb-4 border-b border-zinc-200 dark:border-white/10 font-mono text-xs">
                        <div>
                            <span class="text-[10px] uppercase text-amber-500 font-bold block mb-1">Atelier & Vestuario:</span>
                            <template x-if="dressApplies()">
                                <p class="text-zinc-700 dark:text-zinc-300">
                                    • <strong x-text="event.vestuario.vestido_estilo"></strong> (<span x-text="event.vestuario.vestido_color"></span>)<br>
                                    • Traje: <span x-text="event.vestuario.traje_anfitrion"></span><br>
                                    • 2do Vestido: <span x-text="event.vestuario.segundo_vestido ? 'Sí (Incluido)' : 'No'"></span> | Spa VIP: <span x-text="event.vestuario.spa_maquillaje ? 'Sí' : 'No'"></span>
                                </p>
                            </template>
                            <template x-if="!dressApplies()">
                                <p class="text-zinc-400 italic">No aplica catálogo de vestidos para <span x-text="event.type"></span>.</p>
                            </template>
                        </div>
                        <div>
                            <span class="text-[10px] uppercase text-amber-500 font-bold block mb-1">Ambientación & Mobiliario:</span>
                            <p class="text-zinc-700 dark:text-zinc-300">
                                • Concepto: <strong x-text="event.tematica.concepto"></strong><br>
                                • Sillas: <span x-text="event.mobiliario.sillas"></span><br>
                                • Trono: <span x-text="event.mobiliario.trono_presidencial"></span><br>
                                • Paseo: <span x-text="event.mobiliario.pasarela_alfombra"></span>
                            </p>
                        </div>
                    </div>

                    {{-- Lista de Servicios Contratados --}}
                    <div>
                        <span class="text-xs font-mono uppercase tracking-widest text-zinc-500 dark:text-zinc-400 block mb-3">Servicios de Producción Adicionales:</span>
                        <div class="space-y-2">
                            <template x-if="Object.keys(selectedServices).length === 0">
                                <p class="text-xs text-zinc-400 italic">No has seleccionado servicios adicionales. Solo se cotiza la experiencia base.</p>
                            </template>
                            <template x-for="svc in Object.values(selectedServices)" :key="svc.id">
                                <div class="flex justify-between items-center text-xs py-1.5 border-b border-zinc-200/50 dark:border-white/5">
                                    <span class="text-zinc-800 dark:text-zinc-200 font-medium">
                                        <span class="text-amber-500 font-bold" x-text="'[' + svc.category + '] '"></span>
                                        <span x-text="svc.name"></span>
                                        <span class="text-zinc-400 ml-1" x-text="'(x' + svc.quantity + ')'"></span>
                                    </span>
                                    <span class="font-mono font-bold text-zinc-900 dark:text-white" x-text="formatMoney(svc.price * svc.quantity)"></span>
                                </div>
                            </template>
                        </div>
                    </div>

                    {{-- Subtotales --}}
                    <div class="pt-4 border-t border-zinc-200 dark:border-white/10 space-y-2 font-mono text-xs">
                        <div class="flex justify-between text-zinc-500 dark:text-zinc-400">
                            <span>Subtotal Locación:</span>
                            <span x-text="formatMoney(getSalonTotal())"></span>
                        </div>
                        <template x-if="dressApplies() && getDressTotal() > 0">
                            <div class="flex justify-between text-zinc-500 dark:text-zinc-400">
                                <span>Alquiler Vestido Atelier:</span>
                                <span x-text="formatMoney(getDressTotal())"></span>
                            </div>
                        </template>
                        <div class="flex justify-between text-zinc-500 dark:text-zinc-400">
                            <span>Subtotal Servicios Especializados:</span>
                            <span x-text="formatMoney(getServicesTotal())"></span>
                        </div>
                        <div class="flex justify-between text-base font-black text-amber-500 pt-2 border-t border-zinc-200 dark:border-white/10 font-sans">
                            <span>PRESUPUESTO TOTAL ESTIMADO:</span>
                            <span x-text="formatMoney(getGrandTotal())"></span>
                        </div>
                    </div>
                </div>

                {{-- Campo para aclaraciones del cliente --}}
                <div>
                    <label class="text-xs font-bold uppercase tracking-widest text-zinc-500 dark:text-zinc-400 block mb-2">Comentarios, Notas o Requerimientos Especiales:</label>
                    <textarea x-model="event.generalNotes" rows="3" class="input-canvas text-sm" placeholder="Ej: Degustación de banquete para 4 personas, orquesta a las 21:00, llegada de invitados en van..."></textarea>
                </div>
            </div>

            {{-- BOTONES DE NAVEGACIÓN INFERIOR --}}
            <div class="flex justify-between items-center pt-4">
                <button type="button" @click="prevStep()" :disabled="step === 1" :class="step === 1 ? 'opacity-30 cursor-not-allowed' : 'hover:bg-zinc-200 dark:hover:bg-zinc-800'" class="px-6 py-3 rounded-full text-xs uppercase font-bold tracking-widest text-zinc-700 dark:text-zinc-300 transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    Atrás
                </button>

                <button x-show="step < totalSteps" type="button" @click="nextStep()" class="px-8 py-3.5 bg-zinc-900 dark:bg-white text-white dark:text-black hover:bg-amber-500 dark:hover:bg-amber-500 font-black text-xs uppercase tracking-widest rounded-full transition-all shadow-xl hover:scale-105 flex items-center gap-2 cursor-pointer">
                    Siguiente
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>

                <button x-show="step === totalSteps" type="button" @click="submitReservation()" :disabled="isSubmitting" class="px-10 py-4 bg-gradient-to-r from-amber-500 via-amber-600 to-orange-600 text-white font-black text-xs uppercase tracking-widest rounded-full transition-all shadow-2xl hover:scale-105 flex items-center gap-2 disabled:opacity-50 cursor-pointer">
                    <span x-text="isSubmitting ? 'Agendando Celebración...' : 'Confirmar & Registrar Evento'"></span>
                    <svg x-show="!isSubmitting" class="w-4 h-4 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </button>
            </div>

        </div>

        {{-- COLUMNA DERECHA: MOODBOARD & COTIZADOR EN VIVO (4 COLUMNAS) --}}
        <div class="lg:col-span-4 space-y-6">
            
            {{-- Tarjeta de Cotización en Tiempo Real --}}
            <div class="glass-luxury p-6 rounded-3xl sticky top-28 space-y-6 border-amber-500/20">
                <div class="flex justify-between items-center pb-4 border-b border-zinc-200 dark:border-white/10">
                    <div>
                        <span class="text-[10px] font-mono text-amber-500 uppercase tracking-widest font-bold">Presupuesto en Vivo</span>
                        <h3 class="text-lg font-black text-zinc-900 dark:text-white truncate max-w-[180px]" x-text="event.clientName || 'Tu Celebración VIP'"></h3>
                    </div>
                    <span class="text-xs font-bold px-3 py-1 bg-amber-500/10 text-amber-500 rounded-full" x-text="event.type"></span>
                </div>

                {{-- Gran Total --}}
                <div class="text-center py-4 bg-gradient-to-br from-amber-500/10 to-transparent rounded-2xl border border-amber-500/20">
                    <span class="text-[10px] uppercase font-mono tracking-widest text-zinc-500 dark:text-zinc-400 block mb-1">Inversión Estimada Acumulada</span>
                    <span class="text-2xl sm:text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-amber-500 to-amber-600" x-text="formatMoney(getGrandTotal())"></span>
                    <span class="text-[10px] text-zinc-400 block mt-1">Sujeto a confirmación y personalizaciones de staff</span>
                </div>

                {{-- Resumen Visual Rápido: Locación, Vestido y Mobiliario --}}
                <div class="p-4 rounded-2xl bg-zinc-100 dark:bg-zinc-900/60 border border-zinc-200 dark:border-white/5 space-y-2.5 text-xs font-mono">
                    <div class="flex justify-between items-center">
                        <span class="text-zinc-400">Locación:</span>
                        <span class="font-bold text-zinc-800 dark:text-zinc-200 truncate max-w-[140px]" x-text="event.location_type === 'the_ring' ? (event.salon ? event.salon.name : 'The Ring Sede') : (event.location_type === 'external_the_ring' ? 'Hacienda Externa' : 'Predio Propio')"></span>
                    </div>

                    <template x-if="dressApplies()">
                        <div class="flex justify-between items-center">
                            <span class="text-zinc-400">Vestido:</span>
                            <span class="font-bold text-amber-500 truncate max-w-[140px]" x-text="event.vestuario.dress_id ? event.vestuario.vestido_estilo : 'Sin Vestido Atelier'"></span>
                        </div>
                    </template>

                    <div class="flex justify-between items-center">
                        <span class="text-zinc-400">Temática:</span>
                        <span class="font-bold text-zinc-800 dark:text-zinc-200 truncate max-w-[140px]" x-text="event.tematica.concepto"></span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-zinc-400">Sillas:</span>
                        <span class="text-zinc-300 truncate max-w-[140px]" x-text="event.mobiliario.sillas"></span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-zinc-400">Trono:</span>
                        <span class="text-zinc-300 truncate max-w-[140px]" x-text="event.mobiliario.trono_presidencial"></span>
                    </div>
                </div>

                {{-- Moodboard de FOTOS REALES seleccionadas --}}
                <div>
                    <span class="text-[10px] uppercase font-mono tracking-widest text-zinc-400 block mb-3">Tu Moodboard Visual en Vivo:</span>
                    
                    <div class="grid grid-cols-2 gap-2 max-h-64 overflow-y-auto custom-scroll-gold pr-1">
                        {{-- Foto del salón / locación --}}
                        <template x-if="event.location_type === 'the_ring' && event.salon">
                            <div class="relative rounded-xl overflow-hidden aspect-video border border-amber-500/50 group">
                                <img :src="event.salon.img" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black/60 flex items-end p-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <span class="text-[9px] text-white font-bold uppercase truncate" x-text="event.salon.name"></span>
                                </div>
                            </div>
                        </template>

                        {{-- Foto del vestido seleccionado si aplica --}}
                        <template x-if="dressApplies() && event.vestuario.dress_id">
                            <div class="relative rounded-xl overflow-hidden aspect-video border border-amber-500/50 group">
                                <img :src="event.vestuario.vestido_img" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black/60 flex items-end p-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <span class="text-[9px] text-white font-bold uppercase truncate" x-text="event.vestuario.vestido_estilo"></span>
                                </div>
                            </div>
                        </template>

                        {{-- Foto del concepto temático --}}
                        <template x-if="event.tematica.concepto_img">
                            <div class="relative rounded-xl overflow-hidden aspect-video border border-zinc-200 dark:border-white/10 group">
                                <img :src="event.tematica.concepto_img" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black/60 flex items-end p-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <span class="text-[9px] text-white font-bold uppercase truncate" x-text="event.tematica.concepto"></span>
                                </div>
                            </div>
                        </template>

                        {{-- Foto de la silla elegida --}}
                        <template x-if="event.mobiliario.sillas_img">
                            <div class="relative rounded-xl overflow-hidden aspect-video border border-zinc-200 dark:border-white/10 group">
                                <img :src="event.mobiliario.sillas_img" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black/60 flex items-end p-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <span class="text-[9px] text-white font-bold uppercase truncate" x-text="event.mobiliario.sillas"></span>
                                </div>
                            </div>
                        </template>

                        {{-- Foto del trono elegido --}}
                        <template x-if="event.mobiliario.trono_img">
                            <div class="relative rounded-xl overflow-hidden aspect-video border border-zinc-200 dark:border-white/10 group">
                                <img :src="event.mobiliario.trono_img" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black/60 flex items-end p-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <span class="text-[9px] text-white font-bold uppercase truncate" x-text="event.mobiliario.trono_presidencial"></span>
                                </div>
                            </div>
                        </template>

                        {{-- Fotos de los servicios elegidos --}}
                        <template x-for="svc in Object.values(selectedServices)" :key="svc.id">
                            <div class="relative rounded-xl overflow-hidden aspect-video border border-zinc-200 dark:border-white/10 group">
                                <img :src="svc.img" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black/60 flex items-end p-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <span class="text-[9px] text-white font-bold uppercase truncate" x-text="svc.name"></span>
                                </div>
                            </div>
                        </template>
                    </div>

                    <div x-show="!event.salon && !event.vestuario.dress_id && Object.keys(selectedServices).length === 0" class="py-8 text-center border border-dashed border-zinc-300 dark:border-zinc-800 rounded-2xl">
                        <span class="text-xs text-zinc-400 italic">Tus elecciones visuales aparecerán aquí</span>
                    </div>
                </div>

                {{-- Acceso Rápido a Pasos --}}
                <div class="pt-4 border-t border-zinc-200 dark:border-white/10">
                    <span class="text-[10px] uppercase font-mono tracking-widest text-zinc-400 block mb-2">Saltar a Etapa:</span>
                    <div class="flex flex-wrap gap-1.5">
                        <button type="button" @click="step = 1" :class="step === 1 ? 'bg-amber-500 text-black' : 'bg-zinc-200 dark:bg-zinc-800 text-zinc-400'" class="px-2 py-1 rounded-md text-[10px] font-bold">1. Datos</button>
                        <button type="button" @click="step = 2" :class="step === 2 ? 'bg-amber-500 text-black' : 'bg-zinc-200 dark:bg-zinc-800 text-zinc-400'" class="px-2 py-1 rounded-md text-[10px] font-bold">2. Salón</button>
                        <button type="button" @click="if(dressApplies()) step = 3; else alert('El vestuario aplica solo para Bodas y 15 Años');" :class="step === 3 ? 'bg-amber-500 text-black' : (dressApplies() ? 'bg-zinc-200 dark:bg-zinc-800 text-zinc-400' : 'bg-zinc-100 dark:bg-zinc-900 text-zinc-500 line-through')" class="px-2 py-1 rounded-md text-[10px] font-bold">3. Vestido</button>
                        <button type="button" @click="step = 4" :class="step === 4 ? 'bg-amber-500 text-black' : 'bg-zinc-200 dark:bg-zinc-800 text-zinc-400'" class="px-2 py-1 rounded-md text-[10px] font-bold">4. Temática</button>
                        <button type="button" @click="step = 5" :class="step === 5 ? 'bg-amber-500 text-black' : 'bg-zinc-200 dark:bg-zinc-800 text-zinc-400'" class="px-2 py-1 rounded-md text-[10px] font-bold">5. Menú</button>
                        <button type="button" @click="step = 6" :class="step === 6 ? 'bg-amber-500 text-black' : 'bg-zinc-200 dark:bg-zinc-800 text-zinc-400'" class="px-2 py-1 rounded-md text-[10px] font-bold">6. Shows</button>
                        <button type="button" @click="step = 7" :class="step === 7 ? 'bg-amber-500 text-black' : 'bg-zinc-200 dark:bg-zinc-800 text-zinc-400'" class="px-2 py-1 rounded-md text-[10px] font-bold">7. Tech</button>
                        <button type="button" @click="step = 8" :class="step === 8 ? 'bg-amber-500 text-black' : 'bg-zinc-200 dark:bg-zinc-800 text-zinc-400'" class="px-2 py-1 rounded-md text-[10px] font-bold">8. Total</button>
                    </div>
                </div>
            </div>

        </div>

    </div>

</section>
