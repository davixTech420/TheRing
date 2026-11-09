@include('partials.header')

{{-- ====================================================================
     EXPERIENCIA THE RING: ALTA COSTURA ESCÉNICA & ARQUITECTURA EFÍMERA
     Compatible con Dark/Light Mode y Animaciones GSAP / ScrollTrigger
==================================================================== --}}
<div class="relative w-full overflow-hidden font-sans transition-colors duration-500 bg-zinc-50 dark:bg-zinc-950 text-zinc-900 dark:text-white selection:bg-amber-500 selection:text-black">
    
    {{-- ==========================================
         ACTO 1: HERO MONUMENTAL INTERACTIVO
         ========================================== --}}
    <section class="relative flex flex-col items-center justify-center w-full min-h-screen overflow-hidden hero-section pt-24 pb-16">
        
        <div class="absolute inset-0 z-0 w-full h-full hero-bg-wrapper pointer-events-none">
            <img src="https://images.unsplash.com/photo-1519167758481-83f550bb49b3?q=80&w=2500" 
                 class="object-cover w-[110%] h-[110%] -top-[5%] -left-[5%] absolute origin-center opacity-30 dark:opacity-35 grayscale contrast-125 hero-img transition-all duration-700">
            <div class="absolute inset-0 bg-gradient-to-b from-zinc-50/80 via-transparent to-zinc-50 dark:from-zinc-950/80 dark:via-transparent dark:to-zinc-950"></div>
        </div>
        
        {{-- Marquee tipográfico infinito --}}
        <div class="absolute z-10 flex w-[200vw] overflow-hidden opacity-10 dark:opacity-20 top-1/4 -rotate-1 pointer-events-none">
            <div class="flex whitespace-nowrap marquee-track text-[8rem] md:text-[11rem] font-black uppercase text-transparent [-webkit-text-stroke:2px_#18181b] dark:[-webkit-text-stroke:2px_#f59e0b]">
                <span class="px-6">THE RING EXPERIENCE —</span>
                <span class="px-6">ALTA ESCENOGRAFÍA —</span>
                <span class="px-6">PRODUCCIÓN INMERSIVA —</span>
            </div>
        </div>
        
        {{-- Título y Manifiesto --}}
        <div class="relative z-20 flex flex-col items-center hero-text-wrapper text-center px-6 max-w-5xl">
            <div class="inline-flex items-center gap-3 px-5 py-2 rounded-full border border-amber-500/30 bg-amber-500/10 backdrop-blur-md mb-8">
                <span class="w-2 h-2 rounded-full bg-amber-500 animate-ping"></span>
                <span class="font-mono text-xs uppercase tracking-[0.3em] text-amber-600 dark:text-amber-400 font-bold hero-label">
                    Arquitectura Efímera & Lujo Sensorial
                </span>
            </div>
            
            <h1 class="font-black tracking-tighter uppercase text-6xl sm:text-8xl md:text-9xl lg:text-[10rem] leading-[0.88] text-center mb-8">
                <span class="block hero-title-line">The</span>
                <span class="block text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-amber-500 to-amber-600 hero-title-line">
                    Experience
                </span>
            </h1>

            <p class="text-lg md:text-2xl font-light text-zinc-600 dark:text-zinc-300 max-w-3xl leading-relaxed mb-10">
                Diseñamos universos donde la emoción humana se funde con la ingeniería escénica más avanzada de Colombia. Cada instante es una obra de arte irrepetible.
            </p>

            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="/reservas" class="px-8 py-4 bg-zinc-900 dark:bg-white text-white dark:text-black font-black uppercase tracking-widest text-xs rounded-full hover:bg-amber-500 dark:hover:bg-amber-500 hover:text-black transition-all shadow-2xl hover:scale-105">
                    Diseñar mi Celebración
                </a>
                <a href="#formatos" class="px-8 py-4 border border-zinc-300 dark:border-white/20 text-zinc-700 dark:text-zinc-300 hover:border-amber-500 hover:text-amber-500 font-bold uppercase tracking-widest text-xs rounded-full transition-all backdrop-blur-sm">
                    Explorar Obras
                </a>
            </div>
        </div>

        {{-- Indicador de Scroll --}}
        <div class="absolute z-20 flex flex-col items-center bottom-8 scroll-indicator">
            <span class="text-[9px] font-mono tracking-widest uppercase text-zinc-400 mb-2">Desliza para Descubrir</span>
            <div class="w-[1px] h-14 bg-zinc-300 dark:bg-white/20 overflow-hidden relative">
                <div class="absolute top-0 left-0 w-full h-full bg-amber-500 scroll-line"></div>
            </div>
        </div>
    </section>

    {{-- ==========================================
         ACTO 2: MÉTRICAS DE DISTINCIÓN
         ========================================== --}}
    <section class="relative z-20 border-y border-zinc-200 dark:border-white/10 bg-white/50 dark:bg-zinc-900/40 backdrop-blur-xl py-16">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div class="space-y-1">
                <div class="text-4xl md:text-5xl font-black text-amber-500 font-mono">+12</div>
                <div class="text-xs uppercase tracking-widest font-bold text-zinc-500 dark:text-zinc-400">Años de Trayectoria</div>
                <div class="text-[11px] text-zinc-400">Liderando eventos de élite</div>
            </div>
            <div class="space-y-1">
                <div class="text-4xl md:text-5xl font-black text-amber-500 font-mono">+950</div>
                <div class="text-xs uppercase tracking-widest font-bold text-zinc-500 dark:text-zinc-400">Bodas & Galas Reales</div>
                <div class="text-[11px] text-zinc-400">Momentos inolvidables</div>
            </div>
            <div class="space-y-1">
                <div class="text-4xl md:text-5xl font-black text-amber-500 font-mono">100%</div>
                <div class="text-xs uppercase tracking-widest font-bold text-zinc-500 dark:text-zinc-400">Producción In-House</div>
                <div class="text-[11px] text-zinc-400">Staff & tecnología propia</div>
            </div>
            <div class="space-y-1">
                <div class="text-4xl md:text-5xl font-black text-amber-500 font-mono">4</div>
                <div class="text-xs uppercase tracking-widest font-bold text-zinc-500 dark:text-zinc-400">Salones Emblemáticos</div>
                <div class="text-[11px] text-zinc-400">Espacios con domótica 360°</div>
            </div>
        </div>
    </section>

    {{-- ==========================================
         ACTO 3: NUESTROS FORMATOS DE ALTA GALA
         ========================================== --}}
    <section id="formatos" class="relative w-full max-w-[95vw] mx-auto py-32 md:py-40 grid grid-cols-1 md:grid-cols-12 gap-8 md:gap-14 z-20">
        
        <div class="flex flex-col justify-between md:col-span-4 md:sticky md:top-32 h-fit">
            <div>
                <span class="text-xs font-mono uppercase tracking-[0.3em] text-amber-500 font-bold block mb-4">Portafolio Curado</span>
                <h2 class="text-5xl md:text-7xl font-black uppercase tracking-tighter mb-8 grid-title leading-[0.9]">
                    Nuestros <br> Formatos
                </h2>
                <p class="font-light leading-relaxed text-zinc-600 dark:text-zinc-400 text-lg md:text-xl grid-desc mb-8">
                    Desde matrimonios imperiales hasta cumbres corporativas de talla internacional. Cada formato cuenta con dirección artística dedicada y tecnología lumínica de última generación.
                </p>
                <div class="flex items-center gap-3 text-xs font-mono tracking-widest text-amber-500 uppercase">
                    <span class="w-8 h-[2px] bg-amber-500"></span> Desliza las producciones
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-16 md:col-span-8 md:gap-28">
            
            {{-- Formato 01: Bodas de Lujo --}}
            <div class="relative w-full aspect-[4/5] md:aspect-[21/10] rounded-3xl overflow-hidden grid-card group cursor-pointer border border-zinc-200 dark:border-white/10 shadow-2xl">
                <img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=2000" 
                     class="object-cover w-full h-full scale-110 grayscale transition-all duration-700 ease-out group-hover:scale-100 group-hover:grayscale-0 grid-img">
                
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent flex flex-col justify-end p-8 md:p-12">
                    <div class="flex justify-between items-end">
                        <div>
                            <span class="font-mono text-xs tracking-widest uppercase text-amber-400 mb-2 block">Formato 01</span>
                            <h3 class="text-3xl md:text-5xl font-black tracking-tight uppercase text-white mb-3">Bodas de Autor</h3>
                            <p class="text-sm md:text-base text-zinc-300 max-w-lg font-light leading-relaxed opacity-90">
                                Pasarelas florales suspendidas, iluminación cenital envolvente, pirotecnia fría para el primer vals y catering gastronómico de 3 tiempos.
                            </p>
                        </div>
                        <span class="hidden md:inline-block px-4 py-2 rounded-full border border-amber-400/40 text-amber-300 font-mono text-xs uppercase tracking-widest group-hover:bg-amber-400 group-hover:text-black transition-colors">
                            Ver Experiencia
                        </span>
                    </div>
                </div>
            </div>

            {{-- Formato 02: Mis Dulces 15 Años --}}
            <div class="relative w-full md:w-[92%] md:ml-auto aspect-[4/5] md:aspect-[16/9] rounded-3xl overflow-hidden grid-card group cursor-pointer border border-zinc-200 dark:border-white/10 shadow-2xl">
                <img src="https://images.unsplash.com/photo-1470229722913-7c090be5bc6e?q=80&w=2000" 
                     class="object-cover w-full h-full scale-110 grayscale transition-all duration-700 ease-out group-hover:scale-100 group-hover:grayscale-0 grid-img">
                
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent flex flex-col justify-end p-8 md:p-12">
                    <div class="flex justify-between items-end">
                        <div>
                            <span class="font-mono text-xs tracking-widest uppercase text-amber-400 mb-2 block">Formato 02</span>
                            <h3 class="text-3xl md:text-5xl font-black tracking-tight uppercase text-white mb-3">15 Años & Galas Juveniles</h3>
                            <p class="text-sm md:text-base text-zinc-300 max-w-lg font-light leading-relaxed opacity-90">
                                Pista LED infinita 3D, robots futuristas con pistolas de CO2, letras gigantes tridimensionales y cabina de fotos 360 Spin.
                            </p>
                        </div>
                        <span class="hidden md:inline-block px-4 py-2 rounded-full border border-amber-400/40 text-amber-300 font-mono text-xs uppercase tracking-widest group-hover:bg-amber-400 group-hover:text-black transition-colors">
                            Ver Galería
                        </span>
                    </div>
                </div>
            </div>

            {{-- Formato 03: Corporativos & Cumbres --}}
            <div class="relative w-full aspect-[4/5] md:aspect-[21/10] rounded-3xl overflow-hidden grid-card group cursor-pointer border border-zinc-200 dark:border-white/10 shadow-2xl">
                <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=2000" 
                     class="object-cover w-full h-full scale-110 grayscale transition-all duration-700 ease-out group-hover:scale-100 group-hover:grayscale-0 grid-img">
                
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent flex flex-col justify-end p-8 md:p-12">
                    <div class="flex justify-between items-end">
                        <div>
                            <span class="font-mono text-xs tracking-widest uppercase text-amber-400 mb-2 block">Formato 03</span>
                            <h3 class="text-3xl md:text-5xl font-black tracking-tight uppercase text-white mb-3">Convenciones & Banquete Corporativo</h3>
                            <p class="text-sm md:text-base text-zinc-300 max-w-lg font-light leading-relaxed opacity-90">
                                Muro LED gigante 4K, audio lineal electro-acústico sincronizado, streaming en vivo multi-cámara y protocolo impecable de staff.
                            </p>
                        </div>
                        <span class="hidden md:inline-block px-4 py-2 rounded-full border border-amber-400/40 text-amber-300 font-mono text-xs uppercase tracking-widest group-hover:bg-amber-400 group-hover:text-black transition-colors">
                            Ver Especificaciones
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- ==========================================
         ACTO 4: LA ANATOMÍA DE UNA NOCHE PERFECTA
         ========================================== --}}
    <section class="py-28 px-6 bg-zinc-100 dark:bg-zinc-900/50 border-t border-zinc-200 dark:border-white/10 transition-colors">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-20">
                <span class="text-xs font-mono uppercase tracking-[0.3em] text-amber-500 font-bold block mb-3">La Coreografía del Tiempo</span>
                <h2 class="text-4xl md:text-6xl font-black uppercase tracking-tight text-zinc-900 dark:text-white">
                    Anatomía de una Velada
                </h2>
                <p class="text-zinc-500 dark:text-zinc-400 mt-4 max-w-2xl mx-auto font-light text-base md:text-lg">
                    Cada celebración en The Ring está cronometrada con rigor cinematográfico para que los anfitriones disfruten sin preocupaciones.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                
                <div class="p-8 rounded-3xl bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-white/10 space-y-4 hover:border-amber-500 transition-colors shadow-lg">
                    <div class="text-amber-500 font-mono text-xl font-black">17:00 HRS</div>
                    <h3 class="text-xl font-bold text-zinc-900 dark:text-white">Recepción Sensorial</h3>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400 leading-relaxed font-light">
                        Llegada sobre alfombra de honor. Saxofonista o cuarteto clásico en vivo con barra libre de cócteles de autor.
                    </p>
                </div>

                <div class="p-8 rounded-3xl bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-white/10 space-y-4 hover:border-amber-500 transition-colors shadow-lg">
                    <div class="text-amber-500 font-mono text-xl font-black">19:30 HRS</div>
                    <h3 class="text-xl font-bold text-zinc-900 dark:text-white">Apertura Triunfal</h3>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400 leading-relaxed font-light">
                        Niebla criogénica cubriendo el suelo y disparo controlado de chispas frías para la entrada y vals soñado.
                    </p>
                </div>

                <div class="p-8 rounded-3xl bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-white/10 space-y-4 hover:border-amber-500 transition-colors shadow-lg">
                    <div class="text-amber-500 font-mono text-xl font-black">21:00 HRS</div>
                    <h3 class="text-xl font-bold text-zinc-900 dark:text-white">Banquete de Autor</h3>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400 leading-relaxed font-light">
                        Cena de 3 tiempos servida a la mesa por camareros de etiqueta con maridaje de vinos y cascadas de chocolate.
                    </p>
                </div>

                <div class="p-8 rounded-3xl bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-white/10 space-y-4 hover:border-amber-500 transition-colors shadow-lg">
                    <div class="text-amber-500 font-mono text-xl font-black">23:00 HRS</div>
                    <h3 class="text-xl font-bold text-zinc-900 dark:text-white">Hora Loca Futurista</h3>
                    <p class="text-xs text-zinc-500 dark:text-zinc-400 leading-relaxed font-light">
                        Pista LED infinita activada al ritmo del DJ, shows robóticos con trajes lumínicos y plataforma 360 Spin.
                    </p>
                </div>

            </div>
        </div>
    </section>

    {{-- ==========================================
         ACTO 5: SCROLL HORIZONTAL DE PROYECTOS HISTÓRICOS
         ========================================== --}}
    <section class="relative w-full h-screen overflow-hidden transition-colors duration-500 horizontal-wrapper 
                    bg-zinc-950 text-white dark:bg-zinc-900 dark:text-zinc-100 border-t border-zinc-900 dark:border-zinc-800">
        
        <div class="flex h-full horizontal-container w-[300vw] md:w-[250vw]">
            
            <div class="flex flex-col items-center justify-center w-screen h-full shrink-0 panel-skew px-6 text-center">
                <span class="text-xs font-mono uppercase tracking-[0.4em] text-amber-500 font-bold mb-4">Galería de Producción</span>
                <h2 class="text-6xl md:text-[10rem] font-black uppercase tracking-tighter leading-none mb-6">
                    Historial
                </h2>
                <span class="block font-mono text-xs tracking-[0.4em] uppercase border-b border-amber-500 text-amber-400 pb-2">
                    Scroll para recorrer el archivo
                </span>
            </div>

            {{-- Proyecto 1 --}}
            <div class="flex items-center justify-center w-screen h-full px-4 md:px-12 shrink-0 panel-skew">
                <div class="relative flex flex-col md:flex-row w-full max-w-[90vw] md:max-w-7xl h-[80vh] md:h-[70vh] border border-zinc-800 rounded-3xl group overflow-hidden bg-zinc-950">
                    <div class="relative w-full h-1/2 md:h-full md:w-2/3 overflow-hidden border-b border-zinc-800 md:border-b-0 md:border-r">
                        <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?q=80&w=2000" class="object-cover w-[130%] h-full absolute top-0 -left-[15%] grayscale transition-all duration-700 group-hover:grayscale-0 panel-img">
                    </div>
                    
                    <div class="flex flex-col justify-center w-full p-8 md:w-1/3 md:p-14 z-10 bg-zinc-950 text-white">
                        <span class="font-mono text-xs tracking-widest text-amber-500 uppercase mb-4 block">Boda Imperial — Gran Salón</span>
                        <h3 class="text-3xl md:text-5xl font-black uppercase mb-4 leading-none tracking-tight">Valentina & Alejandro</h3>
                        <p class="font-light text-sm md:text-base text-zinc-400 leading-relaxed mb-6">
                            400 invitados, sillería Trono Luis XV, cielo completo de telas con 12 candelabros de cristal y cobertura cinematográfica 4K con Drone.
                        </p>
                        <div class="text-xs font-mono text-zinc-500">Dirección: The Ring Luxury Team</div>
                    </div>
                </div>
            </div>

            {{-- Proyecto 2 --}}
            <div class="flex items-center justify-center w-screen h-full px-4 md:px-12 shrink-0 panel-skew">
                <div class="relative flex flex-col md:flex-row-reverse w-full max-w-[90vw] md:max-w-7xl h-[80vh] md:h-[70vh] border border-zinc-800 rounded-3xl group overflow-hidden bg-zinc-950">
                    <div class="relative w-full h-1/2 md:h-full md:w-2/3 overflow-hidden border-b border-zinc-800 md:border-b-0 md:border-l">
                        <img src="https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?q=80&w=2000" class="object-cover w-[130%] h-full absolute top-0 -left-[15%] grayscale transition-all duration-700 group-hover:grayscale-0 panel-img">
                    </div>
                    
                    <div class="flex flex-col justify-center w-full p-8 md:w-1/3 md:p-14 z-10 bg-zinc-950 text-white">
                        <span class="font-mono text-xs tracking-widest text-amber-500 uppercase mb-4 block">15 Años — Concepto Gatsby</span>
                        <h3 class="text-3xl md:text-5xl font-black uppercase mb-4 leading-none tracking-tight">Gala de Sofía</h3>
                        <p class="font-light text-sm md:text-base text-zinc-400 leading-relaxed mb-6">
                            Montaje años 20 con acabados en oro y plumas de avestruz, pista infinita 3D, vestido de alta costura a medida y show de robots gigantes.
                        </p>
                        <div class="text-xs font-mono text-zinc-500">Dirección: The Ring Youth Studio</div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- ==========================================
         ACTO 6: LLAMADO A LA ACCIÓN DEFINITIVO
         ========================================== --}}
    <section class="py-32 px-6 text-center relative overflow-hidden bg-gradient-to-b from-transparent to-amber-500/10">
        <div class="max-w-4xl mx-auto space-y-8">
            <span class="text-xs font-mono uppercase tracking-[0.4em] text-amber-500 font-bold block">Tu Historia Merece Esta Grandeza</span>
            <h2 class="text-5xl md:text-7xl font-black uppercase tracking-tight text-zinc-900 dark:text-white leading-tight">
                Convierte tu Sueño en un Recuerdo Eterno
            </h2>
            <p class="text-zinc-600 dark:text-zinc-300 text-lg md:text-xl font-light max-w-2xl mx-auto leading-relaxed">
                Utiliza nuestro configurador de reservas con servicios reales y cotiza en tiempo real cada detalle de tu noche inolvidable.
            </p>
            <div class="pt-4 flex flex-wrap justify-center gap-4">
                <a href="/reservas" class="px-10 py-5 bg-gradient-to-r from-amber-500 to-amber-600 text-white font-black uppercase tracking-widest text-xs rounded-full hover:scale-105 transition-transform shadow-2xl shadow-amber-500/30">
                    Comenzar Cotización VIP
                </a>
                <a href="/salones" class="px-8 py-5 border border-zinc-400 dark:border-white/20 text-zinc-800 dark:text-zinc-200 hover:border-amber-500 hover:text-amber-500 font-bold uppercase tracking-widest text-xs rounded-full transition-colors">
                    Ver Recorrido 360° de Salones
                </a>
            </div>
        </div>
    </section>

</div>

@include('partials.footer')
