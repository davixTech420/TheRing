@include('partials.header')

{{-- ====================================================================
     VISTA: SALONES & RECORRIDO VIRTUAL 360°
     Eventos The Ring: Alta arquitectura escénica e inmersión virtual
     El Tour 360° es el PROTAGONISTA HERO destacado en la cabecera
==================================================================== --}}

<div x-data="{
    activeScene: 'entrada',
    activeSceneTitle: 'Entrada Principal - Acceso',
    autoRotateActive: false,
    lightboxOpen: false,
    lightboxImg: '',
    lightboxCaption: '',
    activeSalonImg: {
        @foreach($salones as $salon)
        @php
            $imgs = is_string($salon->images) ? json_decode($salon->images, true) : $salon->images;
            $firstImg = is_array($imgs) && count($imgs) > 0 ? asset('storage/' . $imgs[0]) : '';
        @endphp
        {{ $salon->id }}: '{{ $firstImg }}',
        @endforeach
    },
    openLightbox(img, caption = '') {
        if (!img) return;
        this.lightboxImg = img;
        this.lightboxCaption = caption;
        this.lightboxOpen = true;
        document.body.style.overflow = 'hidden';
    },
    closeLightbox() {
        this.lightboxOpen = false;
        this.lightboxImg = '';
        document.body.style.overflow = '';
    },
    selectScene(sceneId, title) {
        this.activeScene = sceneId;
        this.activeSceneTitle = title;
        if (window.ringTourController) {
            window.ringTourController.loadScene(sceneId);
        }
    },
    toggleTourRotate() {
        if (window.ringTourController) {
            this.autoRotateActive = window.ringTourController.toggleAutoRotate();
        }
    },
    zoomTourIn() {
        if (window.ringTourController) window.ringTourController.zoomIn();
    },
    zoomTourOut() {
        if (window.ringTourController) window.ringTourController.zoomOut();
    },
    toggleTourFullscreen() {
        if (window.ringTourController) window.ringTourController.toggleFullscreen();
    },
    scrollToTour(sceneId, title) {
        this.selectScene(sceneId, title);
        const el = document.getElementById('tour-360-hero');
        if (el) {
            el.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }
}"
x-init="
    window.addEventListener('ring-scene-changed', (e) => {
        if (e.detail) {
            activeScene = e.detail.sceneId || activeScene;
            activeSceneTitle = e.detail.title || activeSceneTitle;
        }
    });
"
@keydown.escape.window="closeLightbox()"
class="salones-page relative w-full overflow-hidden bg-zinc-50 dark:bg-zinc-950 font-sans text-zinc-900 dark:text-zinc-100 transition-colors duration-500 selection:bg-amber-500 selection:text-black">

    {{-- Fondos Ambientales Difuminados (Glow) --}}
    <div class="pointer-events-none fixed inset-0 z-0 overflow-hidden">
        <div class="absolute -top-40 left-1/2 -translate-x-1/2 w-[800px] md:w-[1200px] h-[600px] bg-gradient-to-b from-amber-500/10 dark:from-amber-500/15 via-transparent to-transparent blur-3xl opacity-60"></div>
        <div class="absolute top-[50%] -right-40 w-[500px] h-[500px] bg-gradient-to-br from-amber-500/5 dark:from-amber-500/10 to-transparent blur-3xl opacity-50"></div>
    </div>

    {{-- ========================================================
         ACTO 1: HERO ESTELAR — RECORRIDO VIRTUAL 360° EN VIVO
         (Protagonista absoluto al entrar a la página)
         ======================================================== --}}
    <section id="tour-360-hero" class="relative z-20 w-full h-[88vh] md:h-[92vh] min-h-[640px] max-h-[1050px] overflow-hidden bg-zinc-950">
        
        {{-- Contenedor Canvas Pannellum 360° --}}
        <div id="panorama" class="w-full h-full relative z-0"></div>

        {{-- Gradiente Superior Protector (Para legibilidad de textos y controles) --}}
        <div class="absolute top-0 inset-x-0 h-44 bg-gradient-to-b from-black/85 via-black/40 to-transparent pointer-events-none z-10"></div>

        {{-- Gradiente Inferior Protector --}}
        <div class="absolute bottom-0 inset-x-0 h-44 bg-gradient-to-t from-black/90 via-black/40 to-transparent pointer-events-none z-10"></div>

        {{-- HUD SUPERIOR: Título del Tour & Herramientas --}}
        <div class="absolute top-20 md:top-24 inset-x-0 z-30 px-4 sm:px-8 md:px-12 flex flex-col md:flex-row md:items-center justify-between gap-4 pointer-events-none">
            
            {{-- Título y Badge del Espacio --}}
            <div class="pointer-events-auto">
                <div class="flex items-center gap-2 mb-1.5">
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-black/60 backdrop-blur-md border border-amber-500/30 text-amber-400 font-mono text-[10px] sm:text-xs font-bold uppercase tracking-[0.25em]">
                        <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
                        Recorrido Virtual 360°
                    </span>
                    <span class="hidden sm:inline-block px-3 py-1 rounded-full bg-black/50 backdrop-blur-md border border-white/10 text-zinc-300 font-mono text-[10px] uppercase tracking-wider">
                        Eventos The Ring
                    </span>
                </div>
                <h1 class="text-3xl sm:text-5xl md:text-6xl font-black uppercase tracking-tighter text-white drop-shadow-2xl leading-none">
                    Nuestras <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-amber-300 to-amber-500">Locaciones</span>
                </h1>
            </div>

            {{-- Herramientas de Control Flotantes --}}
            <div class="pointer-events-auto flex items-center gap-2 sm:gap-3 self-start md:self-center">
                {{-- Badge Ambiente Actual en Vivo --}}
                <div class="flex items-center gap-2.5 bg-black/70 backdrop-blur-xl border border-white/20 px-4 py-2.5 rounded-full shadow-2xl">
                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span class="text-xs sm:text-sm font-bold text-white drop-shadow-md truncate max-w-[170px] sm:max-w-xs" x-text="activeSceneTitle"></span>
                </div>

                {{-- Botón Auto-Giro --}}
                <button type="button" @click="toggleTourRotate()" :class="autoRotateActive ? 'bg-amber-500 text-black border-amber-400' : 'bg-black/70 text-white border-white/20 hover:bg-white/15'" class="flex items-center gap-2 px-3.5 sm:px-4 py-2.5 rounded-full border backdrop-blur-xl transition-all text-xs font-bold uppercase tracking-wider cursor-pointer shadow-xl" title="Rotación automática">
                    <svg class="w-4 h-4" :class="autoRotateActive ? 'animate-spin' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    <span class="hidden sm:inline" x-text="autoRotateActive ? 'Pausar' : 'Girar'"></span>
                </button>

                {{-- Botón Pantalla Completa --}}
                <button type="button" @click="toggleTourFullscreen()" class="p-2.5 rounded-full bg-black/70 border border-white/20 text-white hover:bg-amber-500 hover:text-black hover:border-amber-400 transition-all backdrop-blur-xl cursor-pointer shadow-xl" title="Ver en pantalla completa">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path></svg>
                </button>
            </div>
        </div>

        {{-- Controles de Zoom Flotantes Verticales --}}
        <div class="absolute right-4 sm:right-8 top-1/2 -translate-y-1/2 z-30 flex flex-col gap-2.5 pointer-events-auto">
            <button type="button" @click="zoomTourIn()" class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-black/70 hover:bg-amber-500 hover:text-black text-white border border-white/20 backdrop-blur-xl flex items-center justify-center transition-all cursor-pointer shadow-2xl text-xl font-black" title="Acercar (+)">
                +
            </button>
            <button type="button" @click="zoomTourOut()" class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-black/70 hover:bg-amber-500 hover:text-black text-white border border-white/20 backdrop-blur-xl flex items-center justify-center transition-all cursor-pointer shadow-2xl text-xl font-black" title="Alejar (−)">
                −
            </button>
        </div>

        {{-- HUD INFERIOR: SELECTOR DE AMBIENTES & PISOS RÁPIDOS --}}
        <div class="absolute bottom-4 sm:bottom-6 inset-x-0 z-30 px-3 sm:px-6 flex flex-col items-center gap-3 pointer-events-auto">
            
            {{-- Barra de Cápsulas con Scroll Horizontal --}}
            <div class="flex items-center gap-2 sm:gap-2.5 overflow-x-auto p-1.5 sm:p-2 bg-black/80 backdrop-blur-2xl border border-white/20 rounded-2xl sm:rounded-full max-w-full shadow-2xl scrollbar-none">
                
                {{-- Entrada --}}
                <button type="button" @click="selectScene('entrada', 'Entrada Principal - Acceso')" :class="activeScene === 'entrada' ? 'bg-amber-500 text-black font-black shadow-lg shadow-amber-500/40' : 'text-zinc-200 hover:text-white hover:bg-white/10'" class="px-3.5 sm:px-4 py-2 sm:py-2.5 rounded-full text-xs uppercase tracking-wider whitespace-nowrap transition-all duration-200 flex items-center gap-2 cursor-pointer font-bold">
                    <span>🚪</span>
                    <span>Entrada</span>
                </button>

                {{-- Recepción --}}
                <button type="button" @click="selectScene('recepcion', 'Recepción de Gala - Piso 1')" :class="activeScene === 'recepcion' ? 'bg-amber-500 text-black font-black shadow-lg shadow-amber-500/40' : 'text-zinc-200 hover:text-white hover:bg-white/10'" class="px-3.5 sm:px-4 py-2 sm:py-2.5 rounded-full text-xs uppercase tracking-wider whitespace-nowrap transition-all duration-200 flex items-center gap-2 cursor-pointer font-bold">
                    <span>🛎️</span>
                    <span>Recepción</span>
                </button>

                {{-- Segundo Piso --}}
                <button type="button" @click="selectScene('segundopiso', 'Segundo Piso - Conexiones')" :class="activeScene === 'segundopiso' ? 'bg-amber-500 text-black font-black shadow-lg shadow-amber-500/40' : 'text-zinc-200 hover:text-white hover:bg-white/10'" class="px-3.5 sm:px-4 py-2 sm:py-2.5 rounded-full text-xs uppercase tracking-wider whitespace-nowrap transition-all duration-200 flex items-center gap-2 cursor-pointer font-bold">
                    <span>🪜</span>
                    <span>Piso 2</span>
                </button>

                {{-- Salón Nubes --}}
                <button type="button" @click="selectScene('primersalon', 'Salón Nubes - Piso 3')" :class="activeScene === 'primersalon' ? 'bg-amber-500 text-black font-black shadow-lg shadow-amber-500/40' : 'text-zinc-200 hover:text-white hover:bg-white/10'" class="px-3.5 sm:px-4 py-2 sm:py-2.5 rounded-full text-xs uppercase tracking-wider whitespace-nowrap transition-all duration-200 flex items-center gap-2 cursor-pointer font-bold">
                    <span>☁️</span>
                    <span>Salón Nubes (P3)</span>
                </button>

                {{-- Gran Salón Imperial --}}
                <button type="button" @click="selectScene('cuartopiso', 'Gran Salón Imperial - Piso 4')" :class="activeScene === 'cuartopiso' ? 'bg-amber-500 text-black font-black shadow-lg shadow-amber-500/40' : 'text-zinc-200 hover:text-white hover:bg-white/10'" class="px-3.5 sm:px-4 py-2 sm:py-2.5 rounded-full text-xs uppercase tracking-wider whitespace-nowrap transition-all duration-200 flex items-center gap-2 cursor-pointer font-bold">
                    <span>👑</span>
                    <span>Salón Imperial (P4)</span>
                </button>

                {{-- Cocinas --}}
                <button type="button" @click="selectScene('cocinacuarto', 'Cocina de Alta Producción')" :class="activeScene === 'cocinacuarto' || activeScene === 'cocinasegundo' ? 'bg-amber-500 text-black font-black shadow-lg shadow-amber-500/40' : 'text-zinc-200 hover:text-white hover:bg-white/10'" class="px-3.5 sm:px-4 py-2 sm:py-2.5 rounded-full text-xs uppercase tracking-wider whitespace-nowrap transition-all duration-200 flex items-center gap-2 cursor-pointer font-bold">
                    <span>🍳</span>
                    <span>Cocinas</span>
                </button>

            </div>

            {{-- Indicador de Desplazamiento Inferior --}}
            <a href="#coleccion-salones" class="flex items-center gap-2 text-zinc-400 hover:text-amber-400 text-[11px] font-mono uppercase tracking-[0.2em] transition-colors py-1 group">
                <span>Ver Catálogo de Salones Físicos</span>
                <span class="animate-bounce">↓</span>
            </a>

        </div>

    </section>

    {{-- ========================================================
         ACTO 2: COLECCIÓN DE SALONES FÍSICOS (SHOWCASE VIP)
         ======================================================== --}}
    <section id="coleccion-salones" class="relative z-20 px-6 md:px-12 py-20 md:py-28 max-w-[94rem] mx-auto scroll-mt-20">
        
        {{-- Encabezado Editorial --}}
        <div class="text-center max-w-4xl mx-auto mb-20 md:mb-28">
            <span class="font-mono text-xs uppercase tracking-[0.4em] text-amber-600 dark:text-amber-500 font-bold block mb-4">
                Catálogo Oficial & Capacidad
            </span>
            <h2 class="text-4xl sm:text-6xl md:text-7xl font-black uppercase tracking-tight leading-[0.9] text-zinc-900 dark:text-white mb-6">
                Salones de Alta Producción
            </h2>
            <p class="text-base sm:text-lg md:text-xl font-light text-zinc-600 dark:text-zinc-400 leading-relaxed">
                Descubre los detalles arquitectónicos, aforos e inversión estimada de cada locación. Selecciona cualquier espacio para cotizarlo en tiempo real.
            </p>
        </div>

        @if($salones->isEmpty())
        <div class="p-16 text-center border-2 border-dashed border-zinc-300 dark:border-white/15 rounded-3xl bg-white/40 dark:bg-zinc-900/40 max-w-xl mx-auto">
            <p class="font-mono text-xs uppercase tracking-widest text-amber-500 mb-2 font-bold">Colección en Preparación</p>
            <h3 class="text-2xl font-black text-zinc-900 dark:text-white uppercase mb-2">No hay salones registrados</h3>
            <p class="text-zinc-500 text-sm">Vuelve pronto para consultar la disponibilidad de nuestras locaciones.</p>
        </div>
        @else

        <div class="space-y-24 md:space-y-36">
            @foreach($salones as $index => $salon)
            @php
                $imgs = is_string($salon->images) ? json_decode($salon->images, true) : $salon->images;
                $imgs = is_array($imgs) ? $imgs : [];
                $isReversed = $index % 2 !== 0;

                // Mapeo a la escena 360 correspondiente
                $mappedScene = 'entrada';
                $mappedTitle = 'Entrada Principal';
                if ($index === 0) {
                    $mappedScene = 'primersalon';
                    $mappedTitle = 'Salón Nubes - Piso 3';
                } elseif ($index === 1) {
                    $mappedScene = 'cuartopiso';
                    $mappedTitle = 'Gran Salón Imperial - Piso 4';
                } else {
                    $mappedScene = 'tercerpiso';
                    $mappedTitle = 'Salón Eventos The Ring';
                }
            @endphp

            <article class="salon-card-section grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-center">
                
                {{-- LADO A: GALERÍA FOTOGRÁFICA INTERACTIVA --}}
                <div class="salon-img-showcase lg:col-span-7 {{ $isReversed ? 'lg:order-2' : 'lg:order-1' }}">
                    <div class="relative group rounded-[2.5rem] overflow-hidden border border-zinc-200/90 dark:border-white/15 bg-zinc-100 dark:bg-zinc-900 shadow-2xl shadow-zinc-200/50 dark:shadow-black/70">
                        
                        {{-- Imagen Principal con Lightbox al Clic --}}
                        <div class="relative h-[380px] sm:h-[480px] md:h-[520px] w-full overflow-hidden cursor-pointer" @click="openLightbox(activeSalonImg[{{ $salon->id }}], '{{ $salon->name }}')">
                            <template x-if="activeSalonImg[{{ $salon->id }}]">
                                <img :src="activeSalonImg[{{ $salon->id }}]" alt="{{ $salon->name }}" class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">
                            </template>
                            <template x-if="!activeSalonImg[{{ $salon->id }}]">
                                <div class="w-full h-full flex items-center justify-center font-mono text-xs uppercase text-zinc-400">Sin imágenes registradas</div>
                            </template>

                            {{-- Gradiente de Contraste --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/10 to-transparent pointer-events-none"></div>

                            {{-- Badge de Aforo Superior --}}
                            <div class="absolute top-5 left-5 z-10 flex items-center gap-2 bg-black/70 backdrop-blur-md border border-white/20 text-white px-4 py-2 rounded-full font-mono text-xs font-bold uppercase tracking-wider shadow-lg">
                                <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                <span>Aforo {{ $salon->capacity ?? '100' }} pax</span>
                            </div>

                            {{-- Botón de Lupa / Zoom --}}
                            <div class="absolute bottom-5 right-5 z-10 w-11 h-11 rounded-full bg-white/80 dark:bg-black/80 backdrop-blur-md border border-zinc-200 dark:border-white/20 flex items-center justify-center text-zinc-900 dark:text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300 shadow-xl" title="Ver imagen en tamaño completo">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"></path></svg>
                            </div>
                        </div>

                        {{-- Tira de Miniaturas Inferiores --}}
                        @if(count($imgs) > 1)
                        <div class="p-3 sm:p-4 bg-white/95 dark:bg-zinc-900/95 backdrop-blur-xl border-t border-zinc-200 dark:border-white/10 flex items-center gap-3 overflow-x-auto scrollbar-none">
                            @foreach($imgs as $thumbImg)
                            @php $fullThumb = asset('storage/' . $thumbImg); @endphp
                            <button type="button" @click="activeSalonImg[{{ $salon->id }}] = '{{ $fullThumb }}'" :class="activeSalonImg[{{ $salon->id }}] === '{{ $fullThumb }}' ? 'ring-2 ring-amber-500 scale-105 opacity-100' : 'opacity-60 hover:opacity-100'" class="w-16 h-14 sm:w-20 sm:h-16 rounded-xl overflow-hidden shrink-0 border border-zinc-200 dark:border-white/10 transition-all duration-200 cursor-pointer">
                                <img src="{{ $fullThumb }}" alt="Thumbnail {{ $salon->name }}" class="w-full h-full object-cover">
                            </button>
                            @endforeach
                            <span class="text-[11px] font-mono text-zinc-400 uppercase tracking-widest pl-2 hidden sm:inline">
                                Clic para alternar foto
                            </span>
                        </div>
                        @endif

                    </div>
                </div>

                {{-- LADO B: INFORMACIÓN & ESPECIFICACIONES TÉCNICAS --}}
                <div class="salon-content-showcase lg:col-span-5 {{ $isReversed ? 'lg:order-1' : 'lg:order-2' }} space-y-7">
                    
                    {{-- Serial & Número de Espacio --}}
                    <div class="flex items-center gap-3 font-mono text-xs uppercase tracking-[0.3em] text-amber-600 dark:text-amber-500 font-bold">
                        <span>// Espacio {{ sprintf('%02d', $index + 1) }}</span>
                        <span class="h-px w-10 bg-amber-500/50"></span>
                        <span class="px-3 py-1 rounded-full bg-amber-500/10 border border-amber-500/20 text-amber-600 dark:text-amber-400 text-[10px]">
                            Nivel {{ $index === 0 ? 'Piso 3' : ($index === 1 ? 'Piso 4' : 'VIP') }}
                        </span>
                    </div>

                    {{-- Nombre del Salón --}}
                    <h3 class="text-4xl sm:text-5xl lg:text-6xl font-black uppercase tracking-tight text-zinc-900 dark:text-white leading-[0.95]">
                        {{ $salon->name }}
                    </h3>

                    {{-- Descripción --}}
                    @if($salon->description)
                    <p class="text-base sm:text-lg font-light text-zinc-600 dark:text-zinc-300 leading-relaxed">
                        {{ $salon->description }}
                    </p>
                    @endif

                    {{-- Inversión Base & Estado (Pills Glassmorphism) --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-4 sm:p-5 rounded-2xl bg-white/80 dark:bg-zinc-900/60 border border-zinc-200/80 dark:border-white/10 backdrop-blur-xl shadow-md">
                            <span class="block font-mono text-[10px] uppercase tracking-widest text-zinc-500 dark:text-zinc-400 mb-1">Inversión Base</span>
                            <span class="text-xl sm:text-2xl font-black text-zinc-900 dark:text-white font-mono">
                                ${{ number_format($salon->price, 0, ',', '.') }}
                            </span>
                            <span class="text-[10px] font-mono text-zinc-400 uppercase tracking-widest block">COP / Evento</span>
                        </div>
                        <div class="p-4 sm:p-5 rounded-2xl bg-white/80 dark:bg-zinc-900/60 border border-zinc-200/80 dark:border-white/10 backdrop-blur-xl shadow-md">
                            <span class="block font-mono text-[10px] uppercase tracking-widest text-zinc-500 dark:text-zinc-400 mb-1">Disponibilidad</span>
                            <span class="text-xl sm:text-2xl font-black text-emerald-600 dark:text-emerald-400">
                                Abierto
                            </span>
                            <span class="text-[10px] font-mono text-zinc-400 uppercase tracking-widest block">Para Reservas</span>
                        </div>
                    </div>

                    {{-- Lista de Amenidades Incluidas --}}
                    <div>
                        <span class="block font-mono text-xs uppercase tracking-widest text-zinc-400 mb-3 font-bold">Equipamiento Incluido:</span>
                        <div class="grid grid-cols-2 gap-2.5 text-xs text-zinc-700 dark:text-zinc-300 font-medium">
                            <div class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                <span>Iluminación inteligente RGB</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                <span>Sonido envolvente Pro</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                <span>Climatización central</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                <span>Cocina de apoyo en piso</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                <span>Baterías de baño privadas</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                <span>Planta eléctrica 100%</span>
                            </div>
                        </div>
                    </div>

                    {{-- Botones de Acción: Cotizar & Teletransporte al 360 --}}
                    <div class="pt-4 flex flex-wrap items-center gap-4">
                        <a href="/reservas" class="px-7 py-4 rounded-full bg-amber-500 hover:bg-amber-400 text-black font-black uppercase tracking-widest text-xs transition-all duration-300 hover:scale-105 shadow-xl shadow-amber-500/25 flex items-center gap-3">
                            <span>Cotizar este Salón</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>

                        <button type="button" @click="scrollToTour('{{ $mappedScene }}', '{{ $mappedTitle }}')" class="px-6 py-4 rounded-full border border-zinc-300 dark:border-white/20 hover:border-amber-500 text-zinc-800 dark:text-zinc-200 hover:text-amber-500 font-bold uppercase tracking-widest text-xs transition-all duration-300 flex items-center gap-2 cursor-pointer backdrop-blur-md">
                            <span>🌐 Subir al Tour 360°</span>
                        </button>
                    </div>

                </div>

            </article>
            @endforeach
        </div>
        @endif

    </section>

    {{-- ========================================================
         ACTO 3: CUADRO COMPARATIVO TÉCNICO (SPECS MATRIX)
         ======================================================== --}}
    @if(!$salones->isEmpty())
    <section class="specs-matrix-section relative z-20 px-6 md:px-12 py-20 max-w-[94rem] mx-auto border-t border-zinc-200/80 dark:border-white/10">
        <div class="max-w-4xl mx-auto text-center mb-14">
            <span class="font-mono text-xs uppercase tracking-[0.4em] text-amber-600 dark:text-amber-500 font-bold block mb-3">
                Resumen Técnico
            </span>
            <h2 class="text-3xl sm:text-5xl font-black uppercase tracking-tight text-zinc-900 dark:text-white">
                Cuadro Comparativo de Salones
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($salones as $idx => $s)
            <div class="specs-matrix-card p-8 rounded-3xl bg-white/80 dark:bg-zinc-900/50 border border-zinc-200/80 dark:border-white/10 backdrop-blur-xl shadow-xl flex flex-col justify-between transition-transform duration-300 hover:-translate-y-1.5">
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="font-mono text-xs font-bold text-amber-500 uppercase tracking-widest">
                            Espacio {{ sprintf('%02d', $idx + 1) }}
                        </span>
                        <span class="px-3 py-1 rounded-full bg-amber-500/10 text-amber-600 dark:text-amber-400 border border-amber-500/20 text-[10px] font-mono uppercase font-bold">
                            {{ $idx === 0 ? 'Piso 3' : ($idx === 1 ? 'Piso 4' : 'VIP') }}
                        </span>
                    </div>

                    <h4 class="text-2xl font-black uppercase text-zinc-900 dark:text-white mb-4">
                        {{ $s->name }}
                    </h4>

                    <div class="space-y-3 pt-4 border-t border-zinc-200 dark:border-white/10 text-sm">
                        <div class="flex justify-between items-center text-zinc-600 dark:text-zinc-400">
                            <span>Aforo Máximo:</span>
                            <strong class="text-zinc-900 dark:text-white font-mono">{{ $s->capacity }} personas</strong>
                        </div>
                        <div class="flex justify-between items-center text-zinc-600 dark:text-zinc-400">
                            <span>Inversión Base:</span>
                            <strong class="text-zinc-900 dark:text-white font-mono">${{ number_format($s->price, 0, ',', '.') }}</strong>
                        </div>
                        <div class="flex justify-between items-center text-zinc-600 dark:text-zinc-400">
                            <span>Eventos Ideales:</span>
                            <span class="font-bold text-zinc-800 dark:text-zinc-200 text-xs">
                                {{ $idx === 0 ? '15 Años & Cocteles' : ($idx === 1 ? 'Bodas & Galas VIP' : 'Corporativos & Grados') }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center text-zinc-600 dark:text-zinc-400">
                            <span>Piso / Nivel:</span>
                            <span class="font-bold text-zinc-800 dark:text-zinc-200 text-xs">
                                {{ $idx === 0 ? 'Piso 3 (Techo Nubes)' : ($idx === 1 ? 'Piso 4 (Gran Altura)' : 'Piso 3 Posterior') }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="pt-8 mt-6 border-t border-zinc-200 dark:border-white/10">
                    <a href="/reservas" class="block w-full py-3.5 rounded-full bg-zinc-900 dark:bg-white text-white dark:text-black font-black uppercase tracking-widest text-xs text-center transition-all hover:bg-amber-500 dark:hover:bg-amber-500 hover:text-black">
                        Seleccionar en Cotizador
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    {{-- ========================================================
         ACTO 4: CALL TO ACTION (CTA) VIP
         ======================================================== --}}
    <section class="salones-cta-section relative z-20 px-6 md:px-12 py-24 max-w-7xl mx-auto text-center">
        <div class="relative p-12 sm:p-16 md:p-20 rounded-[3rem] overflow-hidden border border-amber-500/30 bg-gradient-to-b from-amber-500/10 via-white/80 dark:via-zinc-900/60 to-white dark:to-zinc-950 backdrop-blur-2xl shadow-2xl">
            
            <div class="relative z-10 max-w-3xl mx-auto space-y-6">
                <span class="font-mono text-xs uppercase tracking-[0.4em] text-amber-600 dark:text-amber-400 font-bold">
                    The Ring Private Concierge
                </span>
                
                <h2 class="text-4xl sm:text-6xl font-black uppercase tracking-tight text-zinc-900 dark:text-white leading-[0.95]">
                    ¿Deseas visitar nuestras instalaciones en persona?
                </h2>

                <p class="text-base sm:text-lg font-light text-zinc-600 dark:text-zinc-300 leading-relaxed max-w-2xl mx-auto">
                    Agenda una cita privada con nuestros directores de eventos. Realizaremos una prueba de iluminación en vivo y degustación de cortesía para tu fecha especial.
                </p>

                <div class="pt-6 flex flex-wrap items-center justify-center gap-4">
                    <a href="/reservas" class="px-9 py-5 rounded-full bg-amber-500 hover:bg-amber-400 text-black font-black uppercase tracking-widest text-xs transition-all hover:scale-105 shadow-xl shadow-amber-500/30">
                        Iniciar Cotización VIP
                    </a>
                    <a href="https://wa.me/+573015717859" target="_blank" rel="noopener noreferrer" class="px-9 py-5 rounded-full border border-zinc-300 dark:border-white/20 hover:border-green-500 hover:text-green-500 text-zinc-800 dark:text-zinc-200 font-bold uppercase tracking-widest text-xs transition-all hover:scale-105 backdrop-blur-md flex items-center gap-2">
                        <span>💬 Chatear por WhatsApp</span>
                    </a>
                </div>
            </div>

        </div>
    </section>

    {{-- ========================================================
         MODAL LIGHTBOX A PANTALLA COMPLETA
         ======================================================== --}}
    <div x-cloak x-show="lightboxOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-[200] bg-black/95 backdrop-blur-2xl flex items-center justify-center p-4 sm:p-8">
        
        {{-- Botón de Cierre --}}
        <button type="button" @click="closeLightbox()" class="absolute top-6 right-6 z-50 p-3 rounded-full bg-white/10 hover:bg-amber-500 hover:text-black text-white transition-all cursor-pointer" title="Cerrar (Esc)">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>

        {{-- Contenedor de la Imagen --}}
        <div class="relative max-w-6xl max-h-[85vh] w-full flex flex-col items-center" @click.away="closeLightbox()">
            <img :src="lightboxImg" :alt="lightboxCaption" class="max-h-[80vh] w-auto max-w-full rounded-2xl object-contain shadow-2xl border border-white/15">
            <p class="text-white font-mono text-xs uppercase tracking-widest mt-4" x-text="lightboxCaption"></p>
        </div>
    </div>

</div>

@include('partials.footer')
