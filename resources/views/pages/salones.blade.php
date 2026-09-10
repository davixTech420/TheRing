@include('partials.header')
    <div class="min-h-screen overflow-hidden font-sans transition-colors duration-500 bg-zinc-50 dark:bg-zinc-950 text-zinc-900 dark:text-zinc-50 selection:bg-amber-500 selection:text-black">
        
        {{-- BARRA DE PROGRESO GLOBAL --}}
        <div class="fixed top-0 left-0 z-50 w-full h-1 bg-zinc-200 dark:bg-zinc-800">
            <div class="h-full scroll-progress-bar bg-amber-500 w-0"></div>
        </div>

        {{-- SECCIÓN INTRODUCTORIA --}}
        <section class="relative z-10 flex flex-col items-center justify-center h-screen px-6 text-center intro-section">
            <span class="text-amber-600 dark:text-amber-500 font-mono text-sm uppercase tracking-[0.3em] block mb-6 overflow-hidden">
                <span class="block intro-badge">The Ring / Collection</span>
            </span>
            <h1 class="text-6xl font-black tracking-tighter uppercase md:text-9xl text-zinc-900 dark:text-white">
                <div class="overflow-hidden"><span class="block intro-title-line">Espacios</span></div>
                <div class="overflow-hidden"><span class="block text-transparent bg-clip-text bg-gradient-to-r from-zinc-400 to-zinc-600 dark:from-zinc-500 dark:to-zinc-700 intro-title-line">Singulares</span></div>
            </h1>
            <div class="absolute bottom-12 animate-bounce intro-scroll-indicator">
                <p class="mb-4 font-mono text-xs tracking-widest text-zinc-400">SCROLL TO EXPLORE</p>
                <svg class="w-6 h-6 mx-auto text-zinc-400 dark:text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
            </div>
        </section>

        {{-- CONTENEDOR MAESTRO DE SCROLL HORIZONTAL --}}
        <section class="relative h-screen transition-colors duration-500 venues-horizontal-wrapper bg-zinc-50 dark:bg-zinc-950">
            
            {{-- w-[400vw] porque ahora tenemos la intro + 3 salones (100vw cada uno) --}}
            <div class="flex h-full venues-horizontal-container w-[400vw]">
                
                {{-- ESPACIO EN BLANCO PARA TRANSICIÓN --}}
                <div class="w-screen h-full shrink-0"></div>

                {{-- ==========================================
                     SALÓN 01: GRAN SALÓN IMPERIAL (Layout Centrado)
                     ========================================== --}}
                <article class="relative flex items-center justify-center h-full w-screen px-[5vw] venue-slide overflow-hidden shrink-0">
                    
                    <div class="absolute inset-0 w-full h-full md:w-[70%] md:left-[15%] md:h-[80%] md:top-[10%] rounded-none md:rounded-[2rem] overflow-hidden venue-main-img-mask cursor-hover-target">
                        <img src="https://images.unsplash.com/photo-1519167758481-83f550bb49b3?q=80&w=2000" alt="Gran Salón" class="object-cover w-full h-full scale-125 venue-parallax-bg">
                        <div class="absolute inset-0 transition-colors duration-500 bg-black/40 dark:bg-black/60 group-hover:bg-black/20"></div>
                    </div>

                    <div class="absolute top-[15%] left-[5%] w-[40vw] md:w-[20vw] aspect-[4/5] rounded-2xl overflow-hidden shadow-2xl z-20 venue-float-1 hidden md:block border border-white/10">
                        <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?q=80&w=1000" alt="Detalle Iluminación" class="object-cover w-full h-full">
                    </div>
                    
                    <div class="relative z-30 flex flex-col justify-end w-full h-full pb-20 md:flex-row md:items-center md:justify-between">
                        <div class="md:w-1/2 venue-text-reveal">
                            <span class="block mb-2 font-mono text-sm tracking-widest text-amber-500">01 / AFORO: 500 PAX</span>
                            <div class="overflow-hidden"><h2 class="text-5xl font-black uppercase md:text-8xl text-zinc-50 dark:text-white text-line">Gran Salón</h2></div>
                            <div class="overflow-hidden"><h2 class="text-5xl font-black uppercase md:text-8xl text-zinc-50 dark:text-white text-line">Imperial</h2></div>
                        </div>

                        <div class="mt-8 md:mt-0 md:w-1/3 backdrop-blur-xl bg-white/10 dark:bg-black/40 border border-zinc-200/20 dark:border-white/10 p-8 rounded-[2rem] venue-specs-panel magnetic-wrapper">
                            <h3 class="mb-6 font-mono text-xs tracking-widest text-white uppercase">Data Estructural (BIM)</h3>
                            <ul class="space-y-4 font-mono text-sm">
                                <li class="flex justify-between border-b border-white/10 pb-2"><span class="text-zinc-400">Área Útil</span><span class="text-white">850 m²</span></li>
                                <li class="flex justify-between border-b border-white/10 pb-2"><span class="text-zinc-400">Altura Libre</span><span class="text-white">8.5 metros</span></li>
                                <li class="flex justify-between border-b border-white/10 pb-2"><span class="text-zinc-400">Nodos de Rigging</span><span class="text-white">24 (1 Ton)</span></li>
                            </ul>
                            <button class="w-full mt-6 py-4 rounded-full bg-amber-500 text-black font-bold uppercase tracking-widest hover:bg-amber-400 transition-colors duration-300 magnetic-button">
                                Modelo 3D
                            </button>
                        </div>
                    </div>
                </article>

                {{-- ==========================================
                     SALÓN 02: THE VAULT (Layout Izquierda)
                     ========================================== --}}
                <article class="relative flex items-center justify-center h-full w-screen px-[5vw] venue-slide overflow-hidden shrink-0">
                    
                    <div class="absolute inset-0 w-full h-full md:w-[60%] md:right-[5%] md:left-auto md:h-[90%] md:top-[5%] rounded-none md:rounded-[2rem] overflow-hidden venue-main-img-mask cursor-hover-target">
                        <img src="https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=2000" alt="The Vault" class="object-cover w-full h-full scale-125 venue-parallax-bg">
                        <div class="absolute inset-0 bg-black/40 dark:bg-black/60"></div>
                    </div>

                    <div class="absolute bottom-[10%] right-[40%] w-[30vw] md:w-[25vw] aspect-video rounded-2xl overflow-hidden shadow-2xl z-20 venue-float-2 hidden md:block border border-white/10">
                        <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?q=80&w=1000" alt="Concierto" class="object-cover w-full h-full">
                    </div>

                    <div class="relative z-30 flex flex-col justify-center w-full h-full md:w-1/2 venue-text-reveal">
                        <span class="block mb-2 font-mono text-sm tracking-widest text-amber-500">02 / AFORO: 800 PAX</span>
                        <div class="overflow-hidden"><h2 class="text-5xl font-black uppercase md:text-8xl text-zinc-900 dark:text-white text-line">The Vault</h2></div>
                        <div class="overflow-hidden"><h2 class="text-5xl font-black uppercase md:text-8xl text-transparent bg-clip-text bg-gradient-to-r from-zinc-400 to-zinc-600 text-line">Studio</h2></div>
                        <p class="max-w-md mt-6 text-lg font-light text-zinc-600 dark:text-zinc-300">
                            Estilo industrial chic, paredes crudas y estructura optimizada para Video Mapping. El lienzo perfecto para marcas disruptivas.
                        </p>
                        
                        <div class="flex gap-4 mt-8">
                            <div class="p-4 border backdrop-blur-md bg-white/50 dark:bg-black/30 border-zinc-200 dark:border-white/10 rounded-2xl">
                                <span class="block font-mono text-xs text-zinc-400 uppercase">Potencia</span>
                                <span class="font-bold text-zinc-900 dark:text-white">150 kW Trifásica</span>
                            </div>
                            <div class="p-4 border backdrop-blur-md bg-white/50 dark:bg-black/30 border-zinc-200 dark:border-white/10 rounded-2xl">
                                <span class="block font-mono text-xs text-zinc-400 uppercase">Red</span>
                                <span class="font-bold text-zinc-900 dark:text-white">Fibra 1Gbps</span>
                            </div>
                        </div>
                    </div>
                </article>

                {{-- ==========================================
                     SALÓN 03: JARDÍN BOTÁNICO (Layout Derecha)
                     ========================================== --}}
                <article class="relative flex items-center justify-center h-full w-screen px-[5vw] venue-slide overflow-hidden shrink-0">
                    
                    <div class="absolute inset-0 w-full h-full md:w-[60%] md:left-[5%] md:h-[90%] md:top-[5%] rounded-none md:rounded-[2rem] overflow-hidden venue-main-img-mask cursor-hover-target">
                        <img src="https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?q=80&w=2000" alt="Jardín Botánico" class="object-cover w-full h-full scale-125 venue-parallax-bg">
                        <div class="absolute inset-0 bg-black/30 dark:bg-black/50"></div>
                    </div>

                    <div class="absolute top-[20%] left-[45%] w-[30vw] md:w-[18vw] aspect-[3/4] rounded-2xl overflow-hidden shadow-2xl z-20 venue-float-1 hidden md:block border border-white/10">
                        <img src="https://images.unsplash.com/photo-1540304620023-e18e8f2fa4d7?q=80&w=1000" alt="Naturaleza" class="object-cover w-full h-full">
                    </div>

                    <div class="relative z-30 flex flex-col items-end justify-center w-full h-full text-right md:w-1/2 md:ml-auto venue-text-reveal">
                        <span class="block mb-2 font-mono text-sm tracking-widest text-amber-500">03 / AFORO: 250 PAX</span>
                        <div class="overflow-hidden"><h2 class="text-5xl font-black uppercase md:text-8xl text-zinc-900 dark:text-white text-line">Jardín</h2></div>
                        <div class="overflow-hidden"><h2 class="text-5xl font-black uppercase md:text-8xl text-transparent bg-clip-text bg-gradient-to-l from-green-600 to-green-900 text-line">Botánico</h2></div>
                        <p class="max-w-md mt-6 text-lg font-light text-zinc-600 dark:text-zinc-300">
                            Invernadero arquitectónico climatizado. Conexión directa con la naturaleza sin perder la sofisticación del control ambiental paramétrico.
                        </p>
                    </div>
                </article>

            </div>
        </section>
        
    </div>

@include('partials.footer')