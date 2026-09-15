@include('partials.header')

@if($salones->isEmpty())
{{-- PANTALLA CUANDO NO HAY SALONES --}}
<div class="flex flex-col items-center justify-center min-h-screen bg-zinc-50 dark:bg-zinc-950">
    <h2 class="text-4xl font-black text-zinc-900 dark:text-white uppercase tracking-tighter">No hay espacios disponibles</h2>
    <p class="mt-4 text-zinc-500 font-mono text-sm tracking-widest uppercase">Aún no se han registrado salones en el sistema.</p>
</div>
@else
{{-- PANTALLA PRINCIPAL CON DATOS --}}
<div class="min-h-screen overflow-hidden font-sans transition-colors duration-500 bg-zinc-50 dark:bg-zinc-950 text-zinc-900 dark:text-zinc-50 selection:bg-amber-500 selection:text-black">

    {{-- BARRA DE PROGRESO GLOBAL --}}
    <div class="fixed top-0 left-0 z-50 w-full h-1 bg-zinc-200 dark:bg-zinc-800">
        <div class="h-full scroll-progress-bar bg-amber-500 w-0"></div>
    </div>

    {{-- SECCIÓN INTRODUCTORIA --}}
    <section class="relative z-10 flex flex-col items-center justify-center h-screen px-6 text-center intro-section">
        <span class="text-amber-600 dark:text-amber-500 font-mono text-sm uppercase tracking-[0.3em] block mb-6">
            <span class="block">Colección Exclusiva</span>
        </span>
        <h1 class="text-6xl font-black tracking-tighter uppercase md:text-9xl text-zinc-900 dark:text-white">
            <span class="block">Espacios</span>
            <span class="block text-transparent bg-clip-text bg-gradient-to-r from-zinc-400 to-zinc-600 dark:from-zinc-500 dark:to-zinc-700">Singulares</span>
        </h1>
        <div class="absolute bottom-12 animate-bounce">
            <p class="mb-4 font-mono text-xs tracking-widest text-zinc-400">DESLIZA PARA EXPLORAR</p>
            <svg class="w-6 h-6 mx-auto text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </section>

    {{-- CONTENEDOR MAESTRO DE SCROLL HORIZONTAL --}}
    <section class="relative h-screen transition-colors duration-500 venues-horizontal-wrapper bg-zinc-50 dark:bg-zinc-950">

        <div class="flex h-full venues-horizontal-container" style="width: {{ ($salones->count() + 1) * 100 }}vw;">

            {{-- ESPACIO DE TRANSICIÓN --}}
            <div class="w-screen h-full shrink-0"></div>


            @foreach ($salones as $index => $salon)
            @php
            $isEven = $index % 2 == 0;


            $imagenes = is_string($salon->images) ? json_decode($salon->images, true) : $salon->images;

            $imagenes = is_array($imagenes) ? $imagenes : [];
            @endphp

            {{-- Layout 50/50 Simétrico --}}
            <article class="relative flex flex-col {{ $isEven ? 'md:flex-row' : 'md:flex-row-reverse' }} items-center justify-center h-full w-screen px-8 md:px-[8vw] gap-12 shrink-0 venue-slide">

                {{-- MITAD 1: GALERÍA DE IMÁGENES (Bento Box) --}}
                <div class="w-full md:w-1/2 h-[50vh] md:h-[75vh] grid gap-4 {{ count($imagenes) > 1 ? 'grid-cols-2 grid-rows-2' : 'grid-cols-1 grid-rows-1' }}">

                    @if(count($imagenes) == 0)
                    {{-- Sin imagen --}}
                    <div class="flex items-center justify-center w-full h-full bg-zinc-200 dark:bg-zinc-800 rounded-3xl">
                        <span class="font-mono text-zinc-400">Sin imágenes</span>
                    </div>

                    @elseif(count($imagenes) == 1)
                    {{-- 1 Imagen: Pantalla completa --}}
                    <img src="{{ asset('storage/' . $imagenes[0]) }}" alt="{{ $salon->name }}" class="object-cover w-full h-full shadow-2xl rounded-3xl">

                    @elseif(count($imagenes) == 2)
                    {{-- 2 Imágenes: Mitad y mitad --}}
                    <img src="{{ asset('storage/' . $imagenes[0]) }}" class="object-cover w-full h-full row-span-2 shadow-2xl rounded-3xl">
                    <img src="{{ asset('storage/' . $imagenes[1]) }}" class="object-cover w-full h-full row-span-2 shadow-2xl rounded-3xl">

                    @else
                    {{-- 3 o más Imágenes: Collage Profesional (1 Grande, 2 Pequeñas) --}}
                    <img src="{{ asset('storage/' . $imagenes[0]) }}" class="object-cover w-full h-full col-span-1 row-span-2 shadow-2xl rounded-3xl">
                    <img src="{{ asset('storage/' . $imagenes[1]) }}" class="object-cover w-full h-full col-span-1 row-span-1 shadow-2xl rounded-3xl">
                    <img src="{{ asset('storage/' . $imagenes[2]) }}" class="object-cover w-full h-full col-span-1 row-span-1 shadow-2xl rounded-3xl">
                    @endif

                </div>

                {{-- MITAD 2: INFORMACIÓN DEL SALÓN --}}
                <div class="flex flex-col justify-center w-full text-left md:w-1/2 venue-text-reveal">

                    <span class="block mb-4 font-mono text-sm tracking-widest text-amber-500">
                        {{ sprintf("%02d", $index + 1) }} — AFORO: {{ $salon->capacity ?? 'N/A' }} PAX
                    </span>

                    <h2 class="text-5xl font-black tracking-tighter uppercase md:text-7xl text-zinc-900 dark:text-white mb-6">
                        {{ $salon->name }}
                    </h2>

                    @if($salon->description)
                    <p class="max-w-xl text-lg font-light leading-relaxed text-zinc-600 dark:text-zinc-400 mb-10">
                        {{ $salon->description }}
                    </p>
                    @endif

                    <div class="flex flex-wrap gap-6">
                        <div class="px-6 py-4 border backdrop-blur-md bg-white/50 dark:bg-black/30 border-zinc-200 dark:border-zinc-800 rounded-2xl">
                            <span class="block mb-1 font-mono text-xs tracking-widest text-zinc-400 uppercase">Inversión</span>
                            <span class="text-2xl font-black text-zinc-900 dark:text-white">
                                ${{ number_format($salon->price, 0, ',', '.') }} <span class="text-sm font-normal text-zinc-500">COP</span>
                            </span>
                        </div>

                        <div class="px-6 py-4 border backdrop-blur-md bg-white/50 dark:bg-black/30 border-zinc-200 dark:border-zinc-800 rounded-2xl">
                            <span class="block mb-1 font-mono text-xs tracking-widest text-zinc-400 uppercase">Estado</span>
                            <span class="text-lg font-bold text-zinc-900 dark:text-white mt-1 block">
                                {{ $salon->estado ?? 'Disponible' }}
                            </span>
                        </div>
                    </div>

                </div>
            </article>
            @endforeach

        </div>
    </section>

    {{-- PAGINACIÓN FLOTANTE --}}
    <div class="fixed bottom-8 left-0 z-50 w-full flex justify-center pointer-events-none">
        <div class="pointer-events-auto bg-white/90 dark:bg-black/90 backdrop-blur-xl rounded-full shadow-2xl overflow-hidden border border-zinc-200 dark:border-zinc-800 p-2">
            {{ $salones->links() }}
        </div>
    </div>

</div>
@endif

@include('partials.footer')