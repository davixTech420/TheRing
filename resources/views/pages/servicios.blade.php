@include('partials.header')

    <div class="bg-zinc-50 dark:bg-zinc-950 text-zinc-900 dark:text-zinc-50 font-sans selection:bg-amber-500 selection:text-black">
        
        <section class="h-[70vh] flex flex-col items-center justify-center text-center px-6">
            <span class="text-amber-600 dark:text-amber-500 font-mono text-sm uppercase tracking-[0.4em] block mb-4">Motor Paramétrico</span>
            <h1 class="text-5xl md:text-8xl font-black uppercase tracking-tighter">
                Renderizado <span class="text-transparent bg-clip-text bg-gradient-to-r from-zinc-400 to-zinc-600 dark:from-zinc-500 dark:to-zinc-700">Evolutivo</span>
            </h1>
        </section>

        <div class="relative customizer-track" style="height: 400vh;">
            
            <div class="customizer-visualizer sticky top-0 left-0 w-full h-screen overflow-hidden perspective-[2000px]">
                
                {{-- La línea láser del escáner --}}
                <div class="absolute top-0 left-0 z-50 w-1 h-full shadow-[0_0_30px_rgba(245,158,11,1)] bg-amber-500 scanner-line"></div>

                {{-- Capa 1: Arquitectura Base (Fondo que se aleja en 3D) --}}
                <div class="absolute inset-0 z-10 w-full h-full layer-arch transform-style-3d">
                    <img src="https://images.unsplash.com/photo-1513694203232-719a280e022f?q=80&w=2000" class="object-cover w-full h-full filter grayscale contrast-125">
                </div>

                {{-- Capa 2: Layout y Mobiliario (Revelado por el escáner) --}}
                <div class="absolute inset-0 z-20 w-full h-full layer-layout" style="clip-path: inset(0 100% 0 0);">
                    <img src="https://images.unsplash.com/photo-1519167758481-83f550bb49b3?q=80&w=2000" class="object-cover w-full h-full">
                </div>

                {{-- Capa 3: Iluminación (Expansión radial) --}}
                <div class="absolute inset-0 z-30 w-full h-full layer-lighting" style="clip-path: circle(0% at 50% 50%);">
                    <img src="https://images.unsplash.com/photo-1492684223066-81342ee5ff30?q=80&w=2000" class="object-cover w-full h-full mix-blend-screen">
                </div>

                {{-- Capa 4: FX (Impacto inercial) --}}
                <div class="absolute inset-0 z-40 w-full h-full opacity-0 layer-fx transform-style-3d">
                    <img src="https://images.unsplash.com/photo-1540304620023-e18e8f2fa4d7?q=80&w=2000" class="object-cover w-full h-full">
                </div>
            </div>

            {{-- Tarjetas de Datos UI --}}
            <div class="relative z-50 w-full pointer-events-none" style="margin-top: -100vh;">
                <div class="flex items-center w-full h-screen px-[5vw] md:px-[10vw]">
                    <div class="w-full md:w-1/3 backdrop-blur-xl bg-white/10 dark:bg-black/30 border border-white/20 p-8 rounded-[2rem] step-card">
                        <span class="block mb-2 font-mono text-xs tracking-widest text-amber-500">FASE 01 / ESTRUCTURA</span>
                        <h2 class="text-4xl font-black uppercase text-zinc-900 dark:text-white">Lienzo Base</h2>
                    </div>
                </div>
                <div class="flex items-center justify-end w-full h-screen px-[5vw] md:px-[10vw]">
                    <div class="w-full md:w-1/3 backdrop-blur-xl bg-white/10 dark:bg-black/30 border border-white/20 p-8 rounded-[2rem] step-card">
                        <span class="block mb-2 font-mono text-xs tracking-widest text-amber-500">FASE 02 / LAYOUT</span>
                        <h2 class="text-4xl font-black uppercase text-zinc-900 dark:text-white">Detección Espacial</h2>
                    </div>
                </div>
                <div class="flex items-center w-full h-screen px-[5vw] md:px-[10vw]">
                    <div class="w-full md:w-1/3 backdrop-blur-xl bg-white/10 dark:bg-black/30 border border-white/20 p-8 rounded-[2rem] step-card">
                        <span class="block mb-2 font-mono text-xs tracking-widest text-amber-500">FASE 03 / ATMÓSFERA</span>
                        <h2 class="text-4xl font-black uppercase text-zinc-900 dark:text-white">Cálculo Lumínico</h2>
                    </div>
                </div>
                <div class="flex items-center justify-end w-full h-screen px-[5vw] md:px-[10vw]">
                    <div class="w-full md:w-1/3 backdrop-blur-xl bg-white/10 dark:bg-black/30 border border-white/20 p-8 rounded-[2rem] step-card">
                        <span class="block mb-2 font-mono text-xs tracking-widest text-amber-500">FASE 04 / RIGGING</span>
                        <h2 class="text-4xl font-black uppercase text-zinc-900 dark:text-white">Inmersión Final</h2>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

@include('partials.footer')