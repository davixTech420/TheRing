 @include('partials.header')

    {{-- 1. HERO --}}
    <section class="relative h-screen flex flex-col items-center justify-center overflow-hidden px-6 hero-section">
        <div class="absolute inset-0 z-0 hero-bg-container scale-110">
            <video autoplay loop muted playsinline class="w-full h-full object-cover opacity-60 dark:opacity-40 hero-media">
                <source src="https://videos.pexels.com/video-files/14268100/14268100-hd_1080_1920_24fps.mp4" type="video/mp4">
            </video>
            <div class="absolute inset-0 bg-gradient-to-b from-white/30 via-zinc-50/70 to-zinc-50 dark:from-zinc-950/30 dark:via-zinc-950/70 dark:to-zinc-950 transition-colors duration-500"></div>
        </div>
        <div class="relative z-10 text-center w-full max-w-6xl mx-auto flex flex-col items-center justify-center">
            <div class="overflow-hidden mb-6"><span class="text-amber-500 tracking-[0.8em] text-xl font-mono uppercase block translate-y-full hero-title-part">Eventos</span></div>
            <div class="overflow-hidden">
                <h1 class="text-7xl md:text-[10rem] font-black tracking-tighter uppercase leading-none translate-y-full hero-title-part text-zinc-900 dark:text-white transition-colors duration-500">THE <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-orange-500 to-amber-700">RING</span></h1>
            </div>
            <div class="overflow-hidden mt-8 max-w-2xl">
                <p class="text-zinc-600 dark:text-zinc-400 text-lg md:text-2xl font-light translate-y-full hero-title-part transition-colors duration-500">En tus sueños cada detalle cuenta.</p>
            </div>
        </div>
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center scroll-indicator opacity-0"><span class="text-[10px] font-mono text-zinc-400 dark:text-zinc-500 uppercase tracking-widest mb-2">Descubrir</span>
            <div class="w-[1px] h-12 bg-gradient-to-b from-amber-500 to-transparent"></div>
        </div>
    </section>

    {{-- 2. CINTA DE CAPACIDADES --}}
    <div class="w-full bg-amber-500 py-3 overflow-hidden border-y border-amber-600 relative z-20 flex whitespace-nowrap">
        <div class="animate-marquee flex items-center text-zinc-950 font-black uppercase text-sm tracking-widest"><span class="mx-8">• Sincronización JSON</span><span class="mx-8">• Gestión de Aforos en Tiempo Real</span><span class="mx-8">• Control de Inventario</span><span class="mx-8">• Asignación de Staff Dinámica</span><span class="mx-8">• Arquitectura Modular</span></div>
        <div class="animate-marquee flex items-center text-zinc-950 font-black uppercase text-sm tracking-widest" aria-hidden="true"><span class="mx-8">• Sincronización JSON</span><span class="mx-8">• Gestión de Aforos en Tiempo Real</span><span class="mx-8">• Control de Inventario</span><span class="mx-8">• Asignación de Staff Dinámica</span><span class="mx-8">• Arquitectura Modular</span></div>
    </div>



    {{-- 4. SCROLL HORIZONTAL --}}
    <section class="horizontal-scroll-container overflow-hidden bg-zinc-100 dark:bg-zinc-950 relative border-t border-zinc-200 dark:border-zinc-900 transition-colors duration-500">
        <div class="horizontal-wrapper flex w-[400vw] h-screen">
            <div class="panel w-screen h-screen flex items-center justify-center px-6 md:px-20 relative">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 w-full max-w-7xl items-center">
                    <div class="space-y-6"><span class="text-8xl font-black text-zinc-200 dark:text-zinc-900 absolute -top-10 -left-10 select-none transition-colors duration-500">01</span>
                        <h2 class="text-5xl md:text-7xl font-black text-zinc-900 dark:text-white relative z-10">Salones<br>Inteligentes</h2>
                        <p class="text-zinc-600 dark:text-zinc-400 text-xl font-light">Mapeo de espacios con capacidad dinámica. Asigna el recinto perfecto en milisegundos.</p>
                    </div>
                    <div class="reveal-img-container h-[60vh] rounded-[2rem] overflow-hidden shadow-2xl"><img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover" alt="Salones"></div>
                </div>
            </div>
            <div class="panel w-screen h-screen flex items-center justify-center px-6 md:px-20 relative">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 w-full max-w-7xl items-center">
                    <div class="reveal-img-container h-[60vh] rounded-[2rem] overflow-hidden md:order-1 order-2 shadow-2xl"><img src="https://images.unsplash.com/photo-1517457373958-b7bdd4587205?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover" alt="Staff"></div>
                    <div class="space-y-6 md:order-2 order-1"><span class="text-8xl font-black text-zinc-200 dark:text-zinc-900 absolute -top-10 right-10 select-none transition-colors duration-500">02</span>
                        <h2 class="text-5xl md:text-7xl font-black text-zinc-900 dark:text-white relative z-10">Staff<br>Sincronizado</h2>
                        <p class="text-zinc-600 dark:text-zinc-400 text-xl font-light">Asignación de roles en tiempo real. Desde seguridad hasta protocolo, todos conectados.</p>
                    </div>
                </div>
            </div>
            <div class="panel w-screen h-screen flex items-center justify-center px-6 md:px-20 relative">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 w-full max-w-7xl items-center">
                    <div class="space-y-6"><span class="text-8xl font-black text-zinc-200 dark:text-zinc-900 absolute -bottom-10 -left-10 select-none transition-colors duration-500">03</span>
                        <h2 class="text-5xl md:text-7xl font-black text-zinc-900 dark:text-white relative z-10">Inventario<br>Técnico</h2>
                        <p class="text-zinc-600 dark:text-zinc-400 text-xl font-light">Control preciso de equipos, mobiliario y tecnología audiovisual para evitar fallos.</p>
                    </div>
                    <div class="reveal-img-container h-[60vh] rounded-[2rem] overflow-hidden shadow-2xl"><img src="https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover" alt="Inventario"></div>
                </div>
            </div>
            <div class="panel w-screen h-screen flex items-center justify-center px-6 md:px-20 relative bg-zinc-200/50 dark:bg-zinc-900/50 transition-colors duration-500">
                <div class="text-center max-w-4xl mx-auto space-y-8">
                    <h2 class="text-5xl md:text-8xl font-black text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-orange-600">Gestión a Medida</h2>
                    <p class="text-zinc-600 dark:text-zinc-400 text-2xl font-light">Personaliza tu evento al 100% en el motor de reservas a continuación.</p>
                </div>
            </div>
        </div>
    </section>







  



    @include('components.formEvent')

    {{-- 6. MAPA TÁCTICO --}}
    <section class="py-32 px-6 max-w-7xl mx-auto relative map-section border-t border-zinc-200 dark:border-zinc-900 transition-colors duration-500">
        <div class="text-center mb-16 map-header"><span class="text-amber-500 font-mono text-xs uppercase tracking-widest flex items-center justify-center gap-2"><span class="relative flex h-2 w-2"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span><span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span></span> Cobertura y Logística</span>
            <h2 class="text-4xl md:text-6xl font-black tracking-tight mt-4 text-zinc-900 dark:text-white">Base de Operaciones</h2>
            <p class="text-zinc-600 dark:text-zinc-400 mt-4 max-w-2xl mx-auto font-light">Estratégicamente ubicados en Bogotá, Colombia, coordinamos el despliegue de tecnología y staff para eventos de alto impacto.</p>
        </div>
        <div class="relative w-full h-[600px] md:h-[700px] rounded-[3rem] overflow-hidden border border-zinc-200 dark:border-zinc-800 shadow-2xl map-container bg-white dark:bg-zinc-900 transition-colors duration-500">
            <div class="absolute inset-0 z-20 pointer-events-none">
                <div class="absolute top-8 left-8 border-l-2 border-t-2 border-amber-500/50 w-16 h-16"></div>
                <div class="absolute top-8 right-8 border-r-2 border-t-2 border-amber-500/50 w-16 h-16"></div>
                <div class="absolute bottom-8 left-8 border-l-2 border-b-2 border-amber-500/50 w-16 h-16"></div>
                <div class="absolute bottom-8 right-8 border-r-2 border-b-2 border-amber-500/50 w-16 h-16"></div>
                <div class="absolute bottom-12 left-12 bg-white/90 dark:bg-zinc-950/80 backdrop-blur-md border border-zinc-200 dark:border-zinc-800 p-6 rounded-2xl pointer-events-auto hover:border-amber-500/50 transition-colors cursor-pointer map-info-card shadow-xl">
                    <h3 class="text-zinc-900 dark:text-white font-bold text-lg">The Ring HQ</h3>
                    <p class="text-zinc-500 dark:text-zinc-400 text-sm mt-1 font-mono">LAT 4.6097° N | LON 74.0817° W</p>
                    <div class="mt-4 flex items-center gap-2">
                        <div class="h-2 w-2 bg-green-500 rounded-full animate-pulse"></div><span class="text-xs uppercase tracking-widest text-zinc-600 dark:text-zinc-300">Sistemas en línea</span>
                    </div>
                </div>
            </div>
            <div class="absolute inset-0 z-10 scale-110 map-iframe-wrapper"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127255.10549449488!2d-74.16781292026543!3d4.648283717208886!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f9bfd2da6cb29%3A0x239d635520a33914!2sBogot%C3%A1%2C%20Bogota%2C%20Colombia!5e0!3m2!1sen!2sco!4v1700000000000!5m2!1sen!2sco" class="w-full h-full border-0 pointer-events-auto" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
            <div class="absolute inset-0 z-15 bg-gradient-to-t from-zinc-50 via-transparent to-zinc-50 dark:from-zinc-950 dark:via-transparent dark:to-zinc-950 pointer-events-none opacity-80 transition-colors duration-500"></div>
        </div>
    </section>










  {{-- 3. MISIÓN Y VISIÓN --}}
    <section class="py-32 px-6 max-w-7xl mx-auto relative corporate-section">
        <div class="text-center mb-20 corporate-header"><span class="text-amber-500 font-mono text-xs uppercase tracking-widest">Nuestra Filosofía</span>
            <h2 class="text-4xl md:text-6xl font-bold tracking-tight mt-2 text-zinc-900 dark:text-white">Redefiniendo el Estándar</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
            <div class="md:col-span-7 bg-white/60 dark:bg-zinc-900/40 border border-zinc-200 dark:border-zinc-800/80 rounded-[2.5rem] p-10 md:p-14 backdrop-blur-xl relative overflow-hidden group hover:border-amber-500/50 dark:hover:border-amber-500/30 transition-colors duration-500 reveal-box">
                <div class="absolute top-0 right-0 w-64 h-64 bg-amber-500/10 dark:bg-amber-500/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 group-hover:bg-amber-500/20 transition-all duration-700"></div>
                <div class="w-14 h-14 rounded-2xl bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center mb-8 border border-zinc-200 dark:border-zinc-700 transition-colors duration-500"><svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg></div>
                <h3 class="text-3xl font-black mb-4">Nuestra Misión</h3>
                <p class="text-zinc-600 dark:text-zinc-400 text-lg leading-relaxed font-light transition-colors duration-500">Automatizar y perfeccionar la producción de eventos complejos, entregando a organizadores y clientes una plataforma centralizada que elimine el margen de error mediante tecnología en tiempo real.</p>
            </div>
            <div class="md:col-span-5 bg-white/60 dark:bg-zinc-900/40 border border-zinc-200 dark:border-zinc-800/80 rounded-[2.5rem] p-10 md:p-14 backdrop-blur-xl relative overflow-hidden group hover:border-amber-500/50 dark:hover:border-amber-500/30 transition-colors duration-500 reveal-box">
                <div class="w-14 h-14 rounded-2xl bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center mb-8 border border-zinc-200 dark:border-zinc-700 transition-colors duration-500"><svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg></div>
                <h3 class="text-3xl font-black mb-4">Visión 2030</h3>
                <p class="text-zinc-600 dark:text-zinc-400 text-lg leading-relaxed font-light transition-colors duration-500">Consolidarnos como el sistema operativo líder para la gestión integral de recintos, staff e inventario tecnológico de alta gama.</p>
            </div>
            <div class="md:col-span-4 bg-amber-500 text-zinc-950 rounded-[2.5rem] p-10 flex flex-col justify-center reveal-box shadow-lg"><span class="text-5xl font-black tracking-tighter">0 ms</span><span class="text-sm font-bold uppercase tracking-widest mt-2 opacity-80">Latencia JSON</span></div>
            <div class="md:col-span-4 bg-white/60 dark:bg-zinc-900/40 border border-zinc-200 dark:border-zinc-800/80 rounded-[2.5rem] p-10 flex flex-col justify-center reveal-box"><span class="text-5xl font-black tracking-tighter text-zinc-900 dark:text-white transition-colors duration-500">+50</span><span class="text-sm font-bold uppercase tracking-widest mt-2 text-zinc-500">Salones Mapeados</span></div>
            <div class="md:col-span-4 bg-white/60 dark:bg-zinc-900/40 border border-zinc-200 dark:border-zinc-800/80 rounded-[2.5rem] p-10 flex flex-col justify-center reveal-box"><span class="text-5xl font-black tracking-tighter text-zinc-900 dark:text-white transition-colors duration-500">100%</span><span class="text-sm font-bold uppercase tracking-widest mt-2 text-zinc-500">Personalización Modular</span></div>
        </div>
    </section>




    @include('partials.footer')
