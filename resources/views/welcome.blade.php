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
            <div class="absolute bottom-12 left-12 bg-white/90 dark:bg-zinc-950/80 backdrop-blur-md border border-zinc-200 dark:border-zinc-800 p-6 rounded-2xl pointer-events-auto hover:border-amber-500/50 transition-colors shadow-xl map-info-card flex flex-col gap-5">
    
    <!-- Info original -->
    <div>
        <h3 class="text-zinc-900 dark:text-white font-bold text-lg">Eventos The Ring</h3>
        <div class="mt-2 flex items-center gap-2">
            <div class="h-2 w-2 bg-green-500 rounded-full animate-pulse"></div>
            <span class="text-xs uppercase tracking-widest text-zinc-600 dark:text-zinc-300">Sistemas en línea</span>
        </div>
    </div>

    <!-- Nuevo botón de Navegación GPS -->
    <a href="https://www.google.com/maps/dir/?api=1&destination=4.5506186,-74.0921332" 
       target="_blank" 
       rel="noopener noreferrer"
       class="flex items-center justify-center gap-2 w-full py-3 px-4 bg-amber-500 hover:bg-amber-600 text-white text-sm font-bold uppercase tracking-widest rounded-xl transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
        </svg>
        Trazar Ruta
    </a>

</div>
         </div>
         <div class="absolute inset-0 z-10 scale-110 map-iframe-wrapper"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1988.6204666345434!2d-74.09213319999998!3d4.550618599999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f99006ca77b4d%3A0x4441edf6f9ccea9f!2sEventos%20THE%20RING!5e0!3m2!1ses!2sco!4v1789274453732!5m2!1ses!2sco" class="w-full h-full border-0 pointer-events-auto" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
         <div class="absolute inset-0 z-15 bg-gradient-to-t from-zinc-50 via-transparent to-zinc-50 dark:from-zinc-950 dark:via-transparent dark:to-zinc-950 pointer-events-none opacity-80 transition-colors duration-500"></div>
     </div>
 </section>





 




 @include('partials.footer')