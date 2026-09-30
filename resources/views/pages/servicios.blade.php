@include('partials.header')

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
