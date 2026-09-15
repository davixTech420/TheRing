@include('partials.header')



{{-- ENVOLTORIO PRINCIPAL CON SOPORTE DARK/LIGHT --}}
<div class="relative w-full overflow-hidden font-sans transition-colors duration-500 bg-zinc-50 dark:bg-zinc-950 text-zinc-900 dark:text-white selection:bg-zinc-900 selection:text-white dark:selection:bg-white dark:selection:text-zinc-900">
    
    {{-- ==========================================
         ACTO 1: HERO INTERACTIVO
         ========================================== --}}
    <section class="relative flex flex-col items-center justify-center w-full h-screen overflow-hidden hero-section">
        
        <div class="absolute inset-0 z-0 w-full h-full hero-bg-wrapper">
            <img src="https://images.unsplash.com/photo-1519167758481-83f550bb49b3?q=80&w=2500" class="object-cover w-[110%] h-[110%] -top-[5%] -left-[5%] absolute origin-center opacity-30 dark:opacity-40 grayscale hero-img">
        </div>
        
        <div class="absolute z-10 flex w-[200vw] overflow-hidden opacity-10 dark:opacity-20 top-1/3 -rotate-2">
            <div class="flex whitespace-nowrap marquee-track text-[8rem] font-black uppercase text-transparent [-webkit-text-stroke:2px_#18181b] dark:[-webkit-text-stroke:2px_white]">
                <span class="px-4">THE RING EXPERIENCE —</span>
                <span class="px-4">THE RING EXPERIENCE —</span>
                <span class="px-4">THE RING EXPERIENCE —</span>
            </div>
        </div>
        
        <div class="relative z-20 flex flex-col items-center hero-text-wrapper pointer-events-none">
            <span class="block mb-6 font-mono text-sm tracking-[0.5em] uppercase hero-label [clip-path:polygon(0_100%,100%_100%,100%_100%,0_100%)]">
                Arquitectura Efímera
            </span>
            <h1 class="font-black tracking-tighter uppercase text-[5rem] md:text-[12rem] leading-[0.85] text-center">
                <span class="block hero-title-line [clip-path:polygon(0_100%,100%_100%,100%_100%,0_100%)]">The</span>
                <span class="block hero-title-line [clip-path:polygon(0_100%,100%_100%,100%_100%,0_100%)]">Ring</span>
            </h1>
        </div>

        <div class="absolute z-20 flex flex-col items-center bottom-12 scroll-indicator opacity-0">
            <div class="w-[1px] h-16 bg-zinc-300 dark:bg-white/30 overflow-hidden relative">
                <div class="absolute top-0 left-0 w-full h-full bg-zinc-900 dark:bg-white scroll-line"></div>
            </div>
        </div>
    </section>

    {{-- ==========================================
         ACTO 2: GRID BRUTALISTA (Dark/Light)
         ========================================== --}}
    <section class="relative w-full max-w-[95vw] mx-auto py-32 md:py-48 grid grid-cols-1 md:grid-cols-12 gap-6 md:gap-12 z-20">
        
        <div class="flex flex-col justify-between md:col-span-4 md:mt-12">
            <div>
                <h2 class="text-6xl md:text-8xl font-black uppercase tracking-tighter mb-8 grid-title [clip-path:polygon(0_100%,100%_100%,100%_100%,0_100%)] leading-[0.9]">
                    Nuestros <br> Formatos
                </h2>
                <p class="font-light leading-relaxed text-zinc-600 dark:text-zinc-400 text-xl grid-desc [clip-path:polygon(0_100%,100%_100%,100%_100%,0_100%)]">
                    Infraestructura técnica impecable. Pasa el cursor sobre los proyectos para revelar su verdadera esencia.
                </p>
            </div>
        </div>

        <div class="flex flex-col gap-12 md:col-span-8 md:gap-32">
            <div class="relative w-full aspect-[4/5] md:aspect-[21/9] overflow-hidden grid-card [clip-path:inset(100%_0_0_0)] group cursor-hover-target">
                <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=2000" class="object-cover w-full h-full scale-125 grayscale transition-all duration-700 ease-out group-hover:scale-100 group-hover:grayscale-0 grid-img">
                
                <div class="absolute inset-0 flex flex-col justify-between p-8 transition-opacity duration-500 border pointer-events-none md:p-12 border-zinc-200 dark:border-white/20 bg-white/80 dark:bg-black/40 group-hover:bg-transparent group-hover:opacity-0">
                    <span class="font-mono text-sm tracking-widest uppercase">01</span>
                    <h3 class="text-4xl font-black tracking-tighter uppercase md:text-6xl">Corporativos</h3>
                </div>
            </div>

            <div class="relative w-full md:w-[80%] md:ml-auto aspect-[4/5] md:aspect-[16/9] overflow-hidden grid-card [clip-path:inset(100%_0_0_0)] group cursor-hover-target">
                <img src="https://images.unsplash.com/photo-1511556532299-8f662fc26c06?q=80&w=2000" class="object-cover w-full h-full scale-125 grayscale transition-all duration-700 ease-out group-hover:scale-100 group-hover:grayscale-0 grid-img">
                
                <div class="absolute inset-0 flex flex-col justify-between p-8 transition-opacity duration-500 border pointer-events-none md:p-12 border-zinc-200 dark:border-white/20 bg-white/80 dark:bg-black/40 group-hover:bg-transparent group-hover:opacity-0">
                    <span class="font-mono text-sm tracking-widest uppercase">02</span>
                    <h3 class="text-4xl font-black tracking-tighter uppercase md:text-6xl">Espectáculos</h3>
                </div>
            </div>
        </div>
    </section>

    {{-- ==========================================
         ACTO 3: SCROLL HORIZONTAL
         ========================================== --}}
    <section class="relative w-full h-screen overflow-hidden transition-colors duration-500 horizontal-wrapper 
                    bg-zinc-950 text-white dark:bg-zinc-50 dark:text-zinc-900 border-t border-zinc-900 dark:border-zinc-200">
        
        <div class="flex h-full horizontal-container w-[300vw] md:w-[250vw]">
            
            <div class="flex flex-col items-center justify-center w-screen h-full shrink-0 panel-skew">
                <h2 class="text-[6rem] md:text-[12rem] font-black uppercase tracking-tighter leading-none">
                    Historial
                </h2>
                <span class="block mt-8 font-mono text-sm tracking-[0.4em] uppercase border-b border-current pb-2">
                    Scroll to explore
                </span>
            </div>

            <div class="flex items-center justify-center w-screen h-full px-4 md:px-12 shrink-0 panel-skew">
                <div class="relative flex flex-col md:flex-row w-full max-w-[90vw] md:max-w-7xl h-[80vh] md:h-[70vh] border border-zinc-800 dark:border-zinc-300 group cursor-hover-target overflow-hidden">
                    <div class="relative w-full h-1/2 md:h-full md:w-2/3 overflow-hidden border-b border-zinc-800 dark:border-zinc-300 md:border-b-0 md:border-r">
                        <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?q=80&w=2000" class="object-cover w-[130%] h-full absolute top-0 -left-[15%] grayscale transition-all duration-700 group-hover:grayscale-0 panel-img">
                    </div>
                    
                    <div class="flex flex-col justify-center w-full p-8 md:w-1/3 md:p-16 z-10 transition-colors duration-500 
                                bg-zinc-950 text-white group-hover:bg-white group-hover:text-zinc-900 
                                dark:bg-zinc-50 dark:text-zinc-900 dark:group-hover:bg-zinc-950 dark:group-hover:text-white">
                        <span class="font-mono text-xs tracking-widest mb-6 border-t border-current pt-4 uppercase">Octubre 2025</span>
                        <h3 class="text-4xl md:text-5xl font-black uppercase mb-6 leading-none tracking-tighter">Global <br>Summit</h3>
                        <p class="font-light text-lg opacity-70">Pantallas LED curvas 4K, 500 asistentes y transmisión global simultánea.</p>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-center w-screen h-full px-4 md:px-12 shrink-0 panel-skew">
                <div class="relative flex flex-col md:flex-row-reverse w-full max-w-[90vw] md:max-w-7xl h-[80vh] md:h-[70vh] border border-zinc-800 dark:border-zinc-300 group cursor-hover-target overflow-hidden">
                    <div class="relative w-full h-1/2 md:h-full md:w-2/3 overflow-hidden border-b border-zinc-800 dark:border-zinc-300 md:border-b-0 md:border-l">
                        <img src="https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?q=80&w=2000" class="object-cover w-[130%] h-full absolute top-0 -left-[15%] grayscale transition-all duration-700 group-hover:grayscale-0 panel-img">
                    </div>
                    
                    <div class="flex flex-col justify-center w-full p-8 md:w-1/3 md:p-16 z-10 transition-colors duration-500 
                                bg-zinc-950 text-white group-hover:bg-white group-hover:text-zinc-900 
                                dark:bg-zinc-50 dark:text-zinc-900 dark:group-hover:bg-zinc-950 dark:group-hover:text-white">
                        <span class="font-mono text-xs tracking-widest mb-6 border-t border-current pt-4 uppercase">Diciembre 2025</span>
                        <h3 class="text-4xl md:text-5xl font-black uppercase mb-6 leading-none tracking-tighter">Gala <br>Costura</h3>
                        <p class="font-light text-lg opacity-70">Jardín Botánico adaptado con control térmico y pasarela infinita.</p>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

@include('partials.footer')