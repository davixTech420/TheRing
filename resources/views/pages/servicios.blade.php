@include('partials.header')

{{-- 
    VISTA SERVICIOS - EXPERIENCIA "CONFIGURADOR VIP"
    Conectado 100% con la base de datos de The Ring (tabla `services`).
    Cualquier servicio agregado o editado en Filament Admin se refleja en tiempo real.
--}}
@php
    $dbServices = \App\Models\Service::all();
    $categoriesData = $dbServices->groupBy('category')->map(function ($items, $categoryName) {
        return [
            'name' => $categoryName,
            'items' => $items->map(function ($item) {
                $firstImg = 'https://images.unsplash.com/photo-1545128485-c400e7702796?q=80&w=800';
                if (!empty($item->images) && is_array($item->images) && count($item->images) > 0) {
                    $img = $item->images[0];
                    $firstImg = str_starts_with($img, 'http') ? $img : asset('storage/' . $img);
                }
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'desc' => $item->description,
                    'price' => '$' . number_format($item->base_price, 0, ',', '.'),
                    'img' => $firstImg,
                ];
            })->values()
        ];
    })->values();
@endphp

<div class="bg-zinc-50 dark:bg-zinc-950 text-zinc-900 dark:text-zinc-50 font-sans selection:bg-amber-500 selection:text-black transition-colors duration-500">

    {{-- EXPERIENCIA VISUALIZADOR (Controlado estrictamente por app.js con GSAP) --}}
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

    {{-- SECCIÓN CATÁLOGO (Alimentado directamente de la BD) --}}
    <div class="relative z-10 py-32 px-6 max-w-7xl mx-auto">
        <div class="text-center mb-20">
            <h2 class="text-5xl md:text-7xl font-black uppercase tracking-tighter mb-6 text-zinc-900 dark:text-white">Nuestro <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-amber-600">Catálogo</span></h2>
            <p class="text-zinc-600 dark:text-zinc-400 max-w-2xl mx-auto text-lg font-light">Explora los servicios oficiales sincronizados directamente con nuestro inventario y staff técnico.</p>
        </div>

        {{-- Componente Alpine alimentado por la base de datos --}}
        <div x-data="portfolioGrid()">
            <template x-for="(category, index) in categories" :key="index">
                <div class="mb-24">
                    <div class="flex items-center gap-6 mb-12">
                        <div class="w-12 h-px bg-amber-500"></div>
                        <h3 class="text-3xl font-black uppercase text-zinc-900 dark:text-white" x-text="category.name"></h3>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <template x-for="(item, iIndex) in category.items" :key="iIndex">
                            <div class="group relative rounded-3xl overflow-hidden h-96 shadow-lg dark:shadow-2xl border border-zinc-200 dark:border-white/5 cursor-pointer bg-zinc-200 dark:bg-zinc-900 flex flex-col justify-end">
                                <img :src="item.img" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent opacity-80 group-hover:opacity-95 transition-opacity"></div>
                                <div class="relative z-10 p-6 transform transition-transform duration-500 group-hover:-translate-y-2">
                                    <span class="text-amber-400 font-mono text-xs font-bold uppercase tracking-widest block mb-1" x-text="item.price"></span>
                                    <h4 class="text-xl font-bold text-white mb-2 drop-shadow-md" x-text="item.name"></h4>
                                    <p class="text-white/80 text-xs font-light line-clamp-3 leading-relaxed" x-text="item.desc"></p>
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
        <a href="/reservas" class="inline-block px-12 py-5 bg-zinc-900 text-white font-black uppercase tracking-widest text-xs rounded-full hover:bg-black hover:scale-105 transition-transform shadow-2xl">
            Iniciar Configuración VIP
        </a>
    </section>

</div>

{{-- Data de Categorías sincronizada desde BD --}}
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('portfolioGrid', () => ({
            categories: @json($categoriesData)
        }));
    });
</script>

@include('partials.footer')
