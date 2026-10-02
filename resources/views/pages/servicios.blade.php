@include('partials.header')

{{-- 
    VISTA SERVICIOS - EXPERIENCIA "CONFIGURADOR VIP"
    Todo el JS se ejecuta nativamente desde Vite (app.js). 
    No hay CDNs externos ni scripts de GSAP en línea.
    Dark & Light mode 100% adaptados con Tailwind.
--}}
<div class="bg-zinc-50 dark:bg-zinc-950 text-zinc-900 dark:text-zinc-50 font-sans selection:bg-amber-500 selection:text-black transition-colors duration-500">

    {{-- EXPERIENCIA VISUALIZADOR (Controlado estrictamente por app.js) --}}
    <div class="customizer-track relative w-full h-[400vh]">
        
        {{-- VISUALIZADOR FIJO --}}
        <div class="customizer-visualizer h-screen w-full sticky top-0 overflow-hidden bg-zinc-950 flex items-center justify-center">
            <div class="relative w-full h-full max-w-[2000px] mx-auto">
                
                {{-- 1. BASE ARQUITECTÓNICA --}}
                <div class="layer-arch absolute inset-0 z-10 bg-zinc-900">
                    <img src="https://images.unsplash.com/photo-1519167758481-83f550bb49b3?q=80&w=2000" class="w-full h-full object-cover opacity-30 dark:opacity-40 filter grayscale" alt="Arquitectura Base">
                </div>

                {{-- 2. MOBILIARIO Y DISEÑO (Revelado por Scanner) --}}
                <div class="layer-layout absolute inset-0 z-20" style="clip-path: inset(0 100% 0 0);">
                    <img src="https://images.unsplash.com/photo-1505236858219-8359eb29e329?q=80&w=2000" class="w-full h-full object-cover opacity-80" alt="Mobiliario">
                </div>
                
                {{-- LÍNEA ESCÁNER --}}
                <div class="scanner-line absolute top-0 bottom-0 left-0 w-1 bg-amber-500 shadow-[0_0_30px_rgba(245,158,11,1)] z-30" style="left: 0%;"></div>

                {{-- 3. ILUMINACIÓN (Revelado por Círculo) --}}
                <div class="layer-lighting absolute inset-0 z-40" style="clip-path: circle(0% at 50% 50%);">
                    <div class="absolute inset-0 bg-amber-500/20 dark:bg-amber-500/30 mix-blend-color-dodge z-10"></div>
                    <img src="https://images.unsplash.com/photo-1470229722913-7c090be5bc6e?q=80&w=2000" class="w-full h-full object-cover opacity-70 mix-blend-screen" alt="Iluminación">
                </div>

                {{-- 4. EFECTOS ESPECIALES (Opacity & Scale) --}}
                <div class="layer-fx absolute inset-0 z-50 pointer-events-none opacity-0">
                    <img src="https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=2000" class="w-full h-full object-cover opacity-90 mix-blend-screen" alt="Efectos">
                </div>

                {{-- CORTINA PROTECTORA (Garantiza legibilidad de las tarjetas en Light y Dark Mode) --}}
                <div class="absolute inset-0 z-50 bg-gradient-to-r from-zinc-50 via-zinc-50/70 to-transparent dark:from-zinc-950 dark:via-zinc-950/70 pointer-events-none transition-colors duration-500 w-[95%] md:w-1/2"></div>
            </div>
        </div>

        {{-- PASOS (Tarjetas flotantes manejadas por app.js) --}}
        <div class="absolute top-0 left-0 w-full h-full pointer-events-none z-50">
            <div class="max-w-7xl mx-auto h-full flex flex-col justify-around px-6 md:px-12 py-[40vh] md:py-[50vh]">
                
                {{-- PASO 1 --}}
                <div class="step-card pointer-events-auto w-full max-w-md backdrop-blur-2xl bg-white/80 dark:bg-zinc-900/80 border border-zinc-200 dark:border-white/10 p-8 md:p-10 rounded-[2rem] shadow-2xl transition-colors duration-500">
                    <span class="font-mono text-[10px] uppercase tracking-[0.4em] text-amber-600 dark:text-amber-500 font-bold mb-3 block">Fase 01</span>
                    <h3 class="text-3xl md:text-4xl font-black uppercase text-zinc-900 dark:text-white mb-4 leading-none">Arquitectura</h3>
                    <p class="text-zinc-600 dark:text-zinc-400 text-sm md:text-base font-light leading-relaxed">Seleccionamos el espacio perfecto. Un lienzo en blanco donde comenzaremos a diseñar la experiencia desde cero, adaptando cada rincón a tu visión.</p>
                </div>

                {{-- PASO 2 --}}
                <div class="step-card pointer-events-auto w-full max-w-md backdrop-blur-2xl bg-white/80 dark:bg-zinc-900/80 border border-zinc-200 dark:border-white/10 p-8 md:p-10 rounded-[2rem] shadow-2xl transition-colors duration-500 mt-20 md:mt-32">
                    <span class="font-mono text-[10px] uppercase tracking-[0.4em] text-amber-600 dark:text-amber-500 font-bold mb-3 block">Fase 02</span>
                    <h3 class="text-3xl md:text-4xl font-black uppercase text-zinc-900 dark:text-white mb-4 leading-none">Mobiliario</h3>
                    <p class="text-zinc-600 dark:text-zinc-400 text-sm md:text-base font-light leading-relaxed">Escaneamos e integramos el mobiliario de lujo. Desde sillería premium hasta mesas imperiales, diseñando el flujo perfecto para los invitados.</p>
                </div>

                {{-- PASO 3 --}}
                <div class="step-card pointer-events-auto w-full max-w-md backdrop-blur-2xl bg-white/80 dark:bg-zinc-900/80 border border-zinc-200 dark:border-white/10 p-8 md:p-10 rounded-[2rem] shadow-2xl transition-colors duration-500 mt-20 md:mt-32">
                    <span class="font-mono text-[10px] uppercase tracking-[0.4em] text-amber-600 dark:text-amber-500 font-bold mb-3 block">Fase 03</span>
                    <h3 class="text-3xl md:text-4xl font-black uppercase text-zinc-900 dark:text-white mb-4 leading-none">Iluminación</h3>
                    <p class="text-zinc-600 dark:text-zinc-400 text-sm md:text-base font-light leading-relaxed">Bañamos el espacio de color. Sistemas de luces robóticas y arquitectónicas que transforman completamente la energía de la recepción.</p>
                </div>

                {{-- PASO 4 --}}
                <div class="step-card pointer-events-auto w-full max-w-md backdrop-blur-2xl bg-white/80 dark:bg-zinc-900/80 border border-zinc-200 dark:border-white/10 p-8 md:p-10 rounded-[2rem] shadow-2xl transition-colors duration-500 mt-20 md:mt-32">
                    <span class="font-mono text-[10px] uppercase tracking-[0.4em] text-amber-600 dark:text-amber-500 font-bold mb-3 block">Fase 04</span>
                    <h3 class="text-3xl md:text-4xl font-black uppercase text-zinc-900 dark:text-white mb-4 leading-none">Efectos FX</h3>
                    <p class="text-zinc-600 dark:text-zinc-400 text-sm md:text-base font-light leading-relaxed">El toque final para explotar la pista. Nubes de hielo seco, pólvora fría, disparos de CO2 y shows que elevan el evento a otro nivel.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- SECCIÓN CATÁLOGO (Lista todos los servicios adicionales al final de la experiencia) --}}
    <div class="relative z-10 py-32 px-6 max-w-7xl mx-auto">
        <div class="text-center mb-20">
            <h2 class="text-5xl md:text-7xl font-black uppercase tracking-tighter mb-6 text-zinc-900 dark:text-white">Nuestro <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-amber-600">Catálogo</span></h2>
            <p class="text-zinc-600 dark:text-zinc-400 max-w-2xl mx-auto text-lg font-light">Explora la colección completa de elementos disponibles para personalizar tu evento.</p>
        </div>

        {{-- Componente Alpine puramente para manejar el HTML limpio sin repetir código --}}
        <div x-data="portfolioGrid()">
            <template x-for="(category, index) in categories" :key="index">
                <div class="mb-24">
                    <div class="flex items-center gap-6 mb-12">
                        <div class="w-12 h-px bg-amber-500"></div>
                        <h3 class="text-3xl font-black uppercase text-zinc-900 dark:text-white" x-text="category.name"></h3>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <template x-for="(item, iIndex) in category.items" :key="iIndex">
                            <div class="group relative rounded-3xl overflow-hidden h-80 shadow-lg dark:shadow-2xl border border-zinc-200 dark:border-white/5 cursor-pointer bg-zinc-200 dark:bg-zinc-900">
                                <img :src="item.img" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent opacity-80 group-hover:opacity-100 transition-opacity"></div>
                                <div class="absolute bottom-0 left-0 p-6 transform transition-transform duration-500 group-hover:-translate-y-2">
                                    <h4 class="text-xl font-bold text-white mb-2 drop-shadow-md" x-text="item.name"></h4>
                                    <p class="text-white/80 text-xs font-light opacity-0 group-hover:opacity-100 transition-opacity duration-500" x-text="item.desc"></p>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </template>
        </div>
    </div>

    {{-- CTA FINAL --}}
    <section class="py-32 px-6 text-center bg-amber-500 text-black">
        <h2 class="text-5xl md:text-7xl font-black uppercase tracking-tighter mb-8">Tu Visión,<br>Nuestra Realidad.</h2>
        <a href="/cotizar" class="inline-block px-12 py-5 bg-zinc-900 text-white font-black uppercase tracking-widest text-xs rounded-full hover:bg-black hover:scale-105 transition-transform shadow-2xl">
            Iniciar Configuración VIP
        </a>
    </section>

</div>

{{-- Data de Categorías en Alpine (Sin lógica GSAP) --}}
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('portfolioGrid', () => ({
            categories: [
                {
                    name: 'Efectos & Shows',
                    items: [
                        { name: 'Trajes y Robots LED', desc: 'Personajes gigantes iluminados con tecnología LED.', img: 'https://images.unsplash.com/photo-1545128485-c400e7702796?q=80&w=800' },
                        { name: 'Cámara de Niebla', desc: 'Efecto de niebla baja que crea un piso de nubes.', img: 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?q=80&w=800' },
                        { name: 'Pistas LED', desc: 'Pistas infinitas programables al ritmo del DJ.', img: 'https://images.unsplash.com/photo-1470229722913-7c090be5bc6e?q=80&w=800' },
                    ]
                },
                {
                    name: 'Gastronomía',
                    items: [
                        { name: 'Fuente de Chocolate', desc: 'Cascada ininterrumpida de chocolate premium.', img: 'https://images.unsplash.com/photo-1621303837174-89787a7d4729?q=80&w=800' },
                        { name: 'Mesa de Dulces', desc: 'Candy bar temático y repostería fina.', img: 'https://images.unsplash.com/photo-1481391319762-47dff72954d9?q=80&w=800' },
                    ]
                },
                {
                    name: 'Escenografía',
                    items: [
                        { name: 'Sillería VIP', desc: 'Sillas Trono Reales, Isabelinas y Tiffany.', img: 'https://images.unsplash.com/photo-1505236858219-8359eb29e329?q=80&w=800' },
                        { name: 'Backings', desc: 'Muros florales y estructuras para fotos.', img: 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=800' },
                    ]
                },
                {
                    name: 'Tecnología',
                    items: [
                        { name: 'Plataforma 360', desc: 'Video booths rotativos con brazos robóticos.', img: 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?q=80&w=800' },
                        { name: 'Pantallas LED', desc: 'Módulos de alta resolución para proyecciones.', img: 'https://images.unsplash.com/photo-1505373877841-8d25f7d46678?q=80&w=800' },
                    ]
                }
            ]
        }));
    });
</script>

@include('partials.footer')
 -->



















<!-- @include('partials.header')

    {{-- 
        NUEVA UI/UX "OTRO NIVEL" 
        Diseño ultra organizado por secciones (Sticky Sidebar + Scroll Gallery).
        Altamente inmersivo, enfocado en imágenes grandes y animaciones suaves.
    --}}
    
    <div class="bg-zinc-950 text-zinc-50 font-sans selection:bg-amber-500 selection:text-black overflow-hidden"
         x-data="portfolioExperience()"
         x-init="initObserver()">
        
        {{-- HERO SECTION --}}
        <section class="relative h-screen flex flex-col items-center justify-center text-center px-6 overflow-hidden">
            {{-- Background Video/Image con overlay --}}
            <div class="absolute inset-0 z-0">
                <img src="https://images.unsplash.com/photo-1519167758481-83f550bb49b3?q=80&w=2000" class="w-full h-full object-cover opacity-30 filter grayscale mix-blend-screen" alt="Atmosphere">
                <div class="absolute inset-0 bg-gradient-to-b from-transparent via-zinc-950/80 to-zinc-950"></div>
            </div>

            <div class="relative z-10 max-w-5xl mx-auto gsap-hero">
                <span class="text-amber-500 font-mono text-xs md:text-sm uppercase tracking-[0.5em] block mb-6">Colección Exclusiva</span>
                <h1 class="text-6xl md:text-9xl font-black uppercase tracking-tighter leading-[0.85] mb-8">
                    El Arte de <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-amber-600">Celebrar</span>
                </h1>
                <p class="text-lg md:text-xl text-zinc-400 font-light max-w-2xl mx-auto">
                    No hacemos fiestas, creamos universos. Explora nuestro catálogo de servicios donde cada detalle está diseñado para impactar.
                </p>
                
                <div class="mt-16 animate-bounce">
                    <svg class="w-8 h-8 text-amber-500 mx-auto opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                </div>
            </div>
        </section>

        {{-- MAIN PORTFOLIO SECTIONS --}}
        <div class="relative z-10 bg-zinc-950">
            <template x-for="(category, cIndex) in categories" :key="cIndex">
                
                {{-- LAYOUT DIVIDIDO: Sticky Left + Scrollable Right --}}
                <div class="flex flex-col lg:flex-row border-t border-white/5 relative">
                    
                    {{-- SIDEBAR FIJO (Categoría) --}}
                    <div class="lg:w-1/3 lg:sticky top-0 lg:h-screen flex flex-col justify-center p-10 lg:p-20 z-20 bg-zinc-950/80 backdrop-blur-xl lg:bg-transparent lg:backdrop-blur-none border-b lg:border-b-0 border-white/5">
                        <div class="gsap-reveal opacity-0 translate-y-10">
                            <span class="text-amber-500 font-mono text-[10px] uppercase tracking-widest block mb-4" x-text="'0' + (cIndex + 1) + ' // CATÁLOGO'"></span>
                            <h2 class="text-4xl md:text-6xl font-black uppercase leading-none mb-6" x-text="category.name"></h2>
                            <p class="text-zinc-400 text-sm md:text-base font-light leading-relaxed" x-text="category.desc"></p>
                        </div>
                    </div>
                    
                    {{-- GALERÍA DE SERVICIOS (Scroll) --}}
                    <div class="lg:w-2/3 p-6 md:p-10 lg:py-32 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-10">
                        
                        <template x-for="(item, iIndex) in category.items" :key="iIndex">
                            
                            {{-- TARJETA DE SERVICIO (Hover Glassmorphism) --}}
                            <div class="gsap-reveal opacity-0 translate-y-12 relative h-[400px] lg:h-[500px] w-full rounded-[2rem] overflow-hidden group cursor-pointer shadow-2xl bg-zinc-900 border border-white/5"
                                 :class="(iIndex % 3 === 0 && iIndex !== 0) ? 'md:col-span-2 md:h-[600px]' : ''">
                                
                                {{-- Imagen de Fondo --}}
                                <img :src="item.img" class="absolute inset-0 w-full h-full object-cover transition-transform duration-[2s] ease-out group-hover:scale-110">
                                
                                {{-- Gradiente Inferior (Estado Normal) --}}
                                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent transition-opacity duration-700 group-hover:opacity-0"></div>
                                
                                {{-- Título (Estado Normal) --}}
                                <div class="absolute bottom-0 left-0 p-8 transition-all duration-700 group-hover:translate-y-10 group-hover:opacity-0">
                                    <h3 class="text-2xl md:text-3xl font-black text-white leading-tight" x-text="item.name"></h3>
                                </div>

                                {{-- Overlay Glassmorphism (Estado Hover) --}}
                                <div class="absolute inset-0 bg-black/70 backdrop-blur-lg opacity-0 group-hover:opacity-100 transition-all duration-500 flex flex-col justify-center items-center text-center p-8 lg:p-12">
                                    <div class="transform translate-y-10 group-hover:translate-y-0 transition-transform duration-700 ease-out flex flex-col items-center">
                                        <h3 class="text-3xl md:text-4xl font-black text-amber-500 mb-4" x-text="item.name"></h3>
                                        <p class="text-white/80 text-sm md:text-base font-light leading-relaxed mb-8 max-w-sm" x-text="item.desc"></p>
                                        <button class="px-8 py-4 bg-white text-black font-black uppercase tracking-widest rounded-full text-[10px] hover:bg-amber-500 hover:scale-105 transition-all shadow-[0_0_20px_rgba(255,255,255,0.2)] hover:shadow-[0_0_30px_rgba(245,158,11,0.5)]">
                                            Añadir al Evento
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </template>

                    </div>
                </div>

            </template>
        </div>
        
        {{-- CALL TO ACTION FINAL --}}
        <section class="py-32 px-6 text-center bg-amber-500 text-black">
            <h2 class="text-5xl md:text-7xl font-black uppercase tracking-tighter mb-8 gsap-reveal opacity-0 translate-y-10">Tu Visión,<br>Nuestra Realidad.</h2>
            <a href="/cotizar" class="inline-block px-12 py-5 bg-black text-white font-black uppercase tracking-widest text-xs rounded-full hover:bg-zinc-800 hover:scale-105 transition-all gsap-reveal opacity-0 translate-y-10">
                Iniciar Configuración VIP
            </a>
        </section>

    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('portfolioExperience', () => ({
                categories: [
                    {
                        name: 'Efectos & Shows',
                        desc: 'Experiencias inmersivas que elevan la energía de tu evento al límite. Desde impacto visual hasta performances que encienden la pista.',
                        items: [
                            { name: 'Trajes y Robots LED', desc: 'Personajes gigantes iluminados con tecnología LED para detonar la hora loca.', img: 'https://images.unsplash.com/photo-1545128485-c400e7702796?q=80&w=800' },
                            { name: 'Cámara de Niebla', desc: 'Efecto de niebla baja (hielo seco) que crea un piso de nubes para el primer baile perfecto.', img: 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?q=80&w=800' },
                            { name: 'Pistas LED', desc: 'Pistas de baile infinitas iluminadas y programables al ritmo de la música y el DJ.', img: 'https://images.unsplash.com/photo-1470229722913-7c090be5bc6e?q=80&w=800' },
                            { name: 'Pistolas CO2 & Pintura', desc: 'Disparos refrescantes de humo frío y ráfagas de pintura neón de alto impacto visual.', img: 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=800' },
                            { name: 'Shows Temáticos', desc: 'Performances virales, show de La Monja, bailarines profesionales y coreografías exclusivas.', img: 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?q=80&w=800' },
                        ]
                    },
                    {
                        name: 'Gastronomía',
                        desc: 'Sabores que cautivan. Una propuesta culinaria diseñada para deleitar los sentidos de tus invitados y decorar tu recepción.',
                        items: [
                            { name: 'Fuente de Chocolate', desc: 'Cascada ininterrumpida de chocolate premium con exquisitos acompañamientos y frutas.', img: 'https://images.unsplash.com/photo-1621303837174-89787a7d4729?q=80&w=800' },
                            { name: 'Mesa de Dulces VIP', desc: 'Candy bar temático, repostería fina, macarrones y estaciones de postres.', img: 'https://images.unsplash.com/photo-1481391319762-47dff72954d9?q=80&w=800' },
                            { name: 'Banquete de Autor', desc: 'Plato servido a 3 tiempos, buffet internacional de lujo y pasabocas gourmet.', img: 'https://images.unsplash.com/photo-1555244162-803834f70033?q=80&w=800' },
                        ]
                    },
                    {
                        name: 'Escenografía',
                        desc: 'La arquitectura de tu evento. Estructuras, iluminación focal y mobiliario que transforman completamente cualquier espacio.',
                        items: [
                            { name: 'Sillería VIP', desc: 'Sillas Trono Reales, Isabelinas majestuosas y estilo Tiffany para invitados.', img: 'https://images.unsplash.com/photo-1505236858219-8359eb29e329?q=80&w=800' },
                            { name: 'Backings Fotográficos', desc: 'Muros de rosas naturales, aros florales y estructuras escenográficas para fotos.', img: 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=800' },
                            { name: 'Letras 3D Iluminadas', desc: 'Nombres gigantes en 3D para exteriores y letreros fotográficos en Neón Flex.', img: 'https://images.unsplash.com/photo-1563841930606-67e2bce48b78?q=80&w=800' },
                        ]
                    },
                    {
                        name: 'Tecnología',
                        desc: 'El corazón audiovisual. Equipos de última generación para asegurar que todos escuchen, vean y sientan la experiencia.',
                        items: [
                            { name: 'Plataforma 360', desc: 'Video booths rotativos con brazos robóticos para reels dinámicos de tus invitados.', img: 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?q=80&w=800' },
                            { name: 'Pantallas LED', desc: 'Módulos de alta resolución para proyecciones visuales de DJ y circuito cerrado.', img: 'https://images.unsplash.com/photo-1505373877841-8d25f7d46678?q=80&w=800' },
                            { name: 'Fotografía & Cine', desc: 'Cobertura profesional, multicámaras, drones y edición audiovisual estilo cine.', img: 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=800' },
                        ]
                    }
                ],

                initObserver() {
                    // Si GSAP está disponible, animar el hero
                    if (window.gsap) {
                        gsap.fromTo('.gsap-hero', 
                            { opacity: 0, y: 100 }, 
                            { opacity: 1, y: 0, duration: 1.5, ease: 'power4.out', delay: 0.2 }
                        );
                    }

                    // Intersection Observer para revelar elementos al hacer scroll
                    const options = { root: null, rootMargin: '0px', threshold: 0.15 };
                    
                    const observer = new IntersectionObserver((entries, observer) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                if (window.gsap) {
                                    gsap.to(entry.target, { 
                                        opacity: 1, 
                                        y: 0, 
                                        duration: 1, 
                                        ease: 'power3.out',
                                        clearProps: 'all' // Limpiar tras animar para no chocar con hover
                                    });
                                } else {
                                    // Fallback CSS si no cargó GSAP
                                    entry.target.style.transition = 'all 1s cubic-bezier(0.16, 1, 0.3, 1)';
                                    entry.target.style.opacity = '1';
                                    entry.target.style.transform = 'translateY(0)';
                                }
                                observer.unobserve(entry.target);
                            }
                        });
                    }, options);

                    // Observar todos los elementos con la clase gsap-reveal
                    this.$nextTick(() => {
                        document.querySelectorAll('.gsap-reveal').forEach(el => observer.observe(el));
                    });
                }
            }));
        });
    </script>

@include('partials.footer')
 -->