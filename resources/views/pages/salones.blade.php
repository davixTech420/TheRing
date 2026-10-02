
@include('partials.header')




{{-- RECORRIDO VIRTUAL 360 --}}
<div class="relative w-full h-[100dvh] min-h-[600px] overflow-hidden bg-zinc-950">
    
    {{-- Gradiente protector para asegurar legibilidad en cualquier dispositivo --}}
    <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-transparent to-black/80 pointer-events-none z-10"></div>
    
    {{-- Título superpuesto (Responsivo) --}}
    <div class="absolute z-20 pointer-events-none top-20 left-6 md:top-32 md:left-12 lg:left-20">
        <h1 class="text-5xl md:text-7xl lg:text-8xl font-black tracking-tighter text-white uppercase drop-shadow-2xl leading-[0.9]">
            Recorrido <br> 
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-amber-600">Virtual</span>
        </h1>
        <p class="font-mono text-[10px] md:text-xs tracking-[0.3em] text-amber-500 uppercase mt-5 backdrop-blur-md bg-black/30 inline-block px-5 py-2.5 rounded-full border border-white/10 shadow-xl">
            The Ring Experience
        </p>
    </div>

    {{-- Contenedor del Tour 360 --}}
    <div id="panorama" class="w-full h-full relative z-0"></div>

    {{-- Indicador de interacción visual para móviles y desktop --}}
    <div class="absolute z-20 bottom-12 left-1/2 -translate-x-1/2 pointer-events-none flex flex-col items-center gap-3 opacity-80 mix-blend-screen">
        <div class="w-10 h-10 rounded-full bg-black/40 backdrop-blur-md border border-white/20 flex items-center justify-center animate-bounce shadow-xl">
            <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path></svg>
        </div>
        <span class="font-mono text-[10px] uppercase tracking-[0.2em] text-white font-bold drop-shadow-md">Explora en 360°</span>
    </div>
</div>

@if($salones->isEmpty())
<main class="grid min-h-screen place-items-center bg-zinc-50 dark:bg-zinc-950 px-6 text-center text-zinc-900 dark:text-white transition-colors duration-500">
    <div class="max-w-xl">
        <p class="mb-6 font-mono text-xs uppercase tracking-[0.4em] text-amber-500">Colección en construcción</p>
        <h1 class="text-5xl font-black uppercase tracking-tighter md:text-7xl mb-6">No hay espacios <br><span class="text-zinc-400 dark:text-zinc-600">disponibles</span></h1>
        <p class="text-zinc-500 dark:text-zinc-400 text-lg font-light leading-relaxed">Aún no se han registrado salones en el sistema. Vuelve pronto para descubrir nuestras locaciones exclusivas.</p>
    </div>
</main>
@else
<div class="venue-experience min-h-screen overflow-hidden bg-zinc-50 dark:bg-zinc-950 font-sans text-zinc-900 dark:text-white selection:bg-amber-400 selection:text-black transition-colors duration-500">

    {{-- BARRA DE PROGRESO SUPERIOR --}}
    <div class="fixed inset-x-0 top-0 z-50 h-1 bg-zinc-200 dark:bg-white/10">
        <div class="venue-progress h-full w-0 origin-left bg-amber-500 shadow-[0_0_15px_rgba(245,158,11,0.5)]"></div>
    </div>

    {{-- SECCIÓN INTRO --}}
    <section class="venue-intro relative flex min-h-screen flex-col justify-between overflow-hidden px-6 py-12 md:px-12 md:py-16 mt-16 md:mt-0">
        <div class="max-w-7xl mx-auto w-full pt-10 md:pt-20">
            <p class="venue-kicker mb-8 font-mono text-xs md:text-sm uppercase tracking-[0.5em] text-amber-600 dark:text-amber-500 intro-badge font-bold">
                Una colección para recordar
            </p>
            <h1 class="venue-title text-[clamp(4rem,12vw,13rem)] font-black uppercase leading-[0.8] tracking-[-.06em]">
                <span class="text-line-wrapper"><span class="block intro-title-line text-zinc-900 dark:text-white">Espacios</span></span>
                <span class="text-line-wrapper"><span class="block text-transparent bg-clip-text bg-gradient-to-r from-zinc-400 to-zinc-600 dark:from-zinc-500 dark:to-zinc-700 intro-title-line">Singulares.</span></span>
            </h1>
        </div>
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-8 intro-scroll-indicator max-w-7xl mx-auto w-full pb-10">
            <p class="max-w-md text-base md:text-lg font-light leading-relaxed text-zinc-600 dark:text-zinc-400">
                Arquitectura, atmósfera y posibilidades. Descubre el escenario perfecto y diseñado a medida para tu próximo momento inolvidable.
            </p>
            <div class="venue-scroll-hint flex items-center gap-4 font-mono text-[10px] md:text-xs uppercase tracking-[0.3em] text-amber-600 dark:text-amber-500 font-bold">
                <span class="h-px w-16 bg-amber-600 dark:bg-amber-500"></span> Desliza para explorar
            </div>
        </div>
    </section>

    {{-- SCROLL HORIZONTAL (MOTOR GSAP) --}}
    <section class="venues-horizontal-wrapper relative h-[100dvh]">
        <div class="venues-horizontal-container flex h-full" style="width: {{ ($salones->count() + 1) * 100 }}vw;">
            
            {{-- Slide espaciador inicial --}}
            <div class="w-screen shrink-0"></div>

            @foreach ($salones as $index => $salon)
            @php
            $imagenes = is_string($salon->images) ? json_decode($salon->images, true) : $salon->images;
            $imagenes = is_array($imagenes) ? $imagenes : [];
            @endphp

            <article class="venue-slide relative flex h-full w-screen shrink-0 items-center px-6 py-20 md:px-[6vw] lg:px-[8vw]" data-index="{{ $index }}">
                
                {{-- Fondo Parallax Dinámico --}}
                <div class="absolute inset-0 bg-gradient-to-br from-amber-500/5 via-transparent to-transparent dark:from-amber-500/10 venue-parallax-bg scale-110"></div>

                <div class="relative z-10 grid w-full items-center gap-12 lg:grid-cols-[1.2fr_1fr] lg:gap-16">
                    
                    {{-- Galería de Imágenes (Bento Grid) --}}
                    <div class="venue-gallery group grid h-[45dvh] lg:h-[75dvh] gap-3 md:gap-5 {{ count($imagenes) > 1 ? 'grid-cols-2 grid-rows-2' : 'grid-cols-1' }}">
                        @forelse(array_slice($imagenes, 0, 3) as $imageIndex => $imagen)
                        <button type="button" class="venue-image relative overflow-hidden rounded-[2rem] lg:rounded-[3rem] text-left shadow-2xl shadow-zinc-200/50 dark:shadow-black/50 border border-zinc-200/50 dark:border-white/10 venue-main-img-mask cursor-hover-target {{ count($imagenes) > 2 && $imageIndex === 0 ? 'row-span-2' : (count($imagenes) === 2 ? 'row-span-2' : '') }}" data-lightbox="{{ asset('storage/' . $imagen) }}">
                            <img src="{{ asset('storage/' . $imagen) }}" alt="{{ $salon->name }}" loading="lazy" class="h-full w-full object-cover transition-transform duration-[1.5s] ease-out group-hover:scale-110">
                            {{-- Overlay Oscuro al Hover --}}
                            <span class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-0 transition-opacity duration-500 group-hover:opacity-100"></span>
                        </button>
                        @empty
                        <div class="grid place-items-center rounded-[2rem] lg:rounded-[3rem] border-2 border-dashed border-zinc-300 dark:border-white/20 bg-zinc-100/50 dark:bg-white/5 font-mono text-xs uppercase tracking-widest text-zinc-500 dark:text-zinc-400 venue-main-img-mask">
                            Imágenes no disponibles
                        </div>
                        @endforelse
                    </div>

                    {{-- Copy / Info del Salón --}}
                    <div class="venue-copy max-w-2xl">
                        {{-- Meta Info Superior --}}
                        <div class="mb-8 flex items-center gap-4 font-mono text-xs md:text-sm uppercase tracking-[.3em] text-amber-600 dark:text-amber-500">
                            <span class="text-line font-black">{{ sprintf('%02d', $index + 1) }}</span>
                            <span class="h-px w-12 md:w-16 bg-amber-500/60 text-line"></span>
                            <span class="text-line rounded-full border border-amber-500/30 px-4 py-1.5 bg-amber-500/10 font-bold shadow-sm">
                                Aforo {{ $salon->capacity ?? 'N/A' }} pax
                            </span>
                        </div>
                        
                        {{-- Título Principal --}}
                        <h2 class="mb-8 text-5xl font-black uppercase leading-[0.85] tracking-tighter md:text-7xl lg:text-8xl text-line drop-shadow-sm text-zinc-900 dark:text-white">
                            {{ $salon->name }}
                        </h2>

                        {{-- Descripción --}}
                        @if($salon->description)
                        <p class="mb-10 text-base leading-relaxed text-zinc-600 dark:text-zinc-400 md:text-lg lg:text-xl text-line font-light">
                            {{ $salon->description }}
                        </p>
                        @endif

                        {{-- Datos Financieros / Estado (Glassmorphism) --}}
                        <div class="mb-12 flex flex-wrap gap-4">
                            <div class="rounded-3xl border border-zinc-200/80 dark:border-white/10 bg-white/80 dark:bg-white/[.03] px-6 py-5 md:px-8 md:py-6 backdrop-blur-2xl shadow-xl shadow-zinc-200/40 dark:shadow-black/40 venue-float-1 cursor-hover-target transition-all hover:bg-zinc-50 dark:hover:bg-white/[.05] hover:-translate-y-1">
                                <span class="mb-2 block font-mono text-[10px] md:text-xs uppercase tracking-widest text-zinc-500 dark:text-zinc-500">Inversión Base</span>
                                <strong class="text-2xl font-black md:text-4xl text-zinc-900 dark:text-white">
                                    ${{ number_format($salon->price, 0, ',', '.') }} 
                                    <small class="text-xs md:text-sm font-normal text-zinc-500 dark:text-zinc-500">COP</small>
                                </strong>
                            </div>
                            
                            <div class="rounded-3xl border border-zinc-200/80 dark:border-white/10 bg-white/80 dark:bg-white/[.03] px-6 py-5 md:px-8 md:py-6 backdrop-blur-2xl shadow-xl shadow-zinc-200/40 dark:shadow-black/40 venue-float-2 cursor-hover-target transition-all hover:bg-zinc-50 dark:hover:bg-white/[.05] hover:-translate-y-1">
                                <span class="mb-2 block font-mono text-[10px] md:text-xs uppercase tracking-widest text-zinc-500 dark:text-zinc-500">Disponibilidad</span>
                                <strong class="text-2xl font-black text-emerald-600 dark:text-emerald-400 md:text-4xl">
                                    {{ $salon->estado ?? 'Disponible' }}
                                </strong>
                            </div>
                        </div>

                        {{-- Botón Magnético --}}
                        <div class="magnetic-wrapper inline-block mt-2">
                            <a href="#contacto" class="magnetic-button group inline-flex items-center gap-6 rounded-full bg-zinc-900 dark:bg-white px-8 py-5 text-xs md:text-sm font-black uppercase tracking-[0.2em] text-white dark:text-black transition-all hover:scale-105 hover:bg-amber-500 dark:hover:bg-amber-500 cursor-hover-target shadow-2xl hover:shadow-amber-500/30">
                                <span class="magnetic-text">Reservar espacio</span> 
                                <span aria-hidden="true" class="magnetic-text flex h-8 w-8 items-center justify-center rounded-full bg-white/20 dark:bg-black/10 transition-transform duration-300 group-hover:rotate-45">↗</span>
                            </a>
                        </div>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
    </section>

    {{-- FOOTER CONTACTO DE LUJO --}}
    <footer id="contacto" class="flex flex-col md:flex-row min-h-[40vh] items-center justify-between border-t border-zinc-200 dark:border-white/10 bg-white dark:bg-zinc-950 px-8 py-16 md:px-16 lg:px-24 relative z-20 gap-10 text-center md:text-left">
        <div>
            <p class="font-mono text-xs uppercase tracking-[.4em] text-amber-500 mb-4 font-bold">The Ring Studio</p>
            <h3 class="text-3xl md:text-5xl font-black uppercase tracking-tighter text-zinc-900 dark:text-white leading-tight">
                El escenario perfecto <br>
                <span class="text-zinc-400 dark:text-zinc-600">para tu próxima historia.</span>
            </h3>
        </div>
        <div class="md:text-right flex flex-col items-center md:items-end">
            <p class="mb-4 text-xs font-mono uppercase tracking-widest text-zinc-500 dark:text-zinc-500">¿Comenzamos a planear?</p>
            <a href="mailto:reservas@thering.com" class="text-2xl md:text-4xl lg:text-5xl font-black text-amber-600 dark:text-amber-500 transition-all hover:text-zinc-900 dark:hover:text-white cursor-hover-target relative inline-block group py-2">
                reservas@thering.com
                <span class="absolute bottom-0 left-0 w-0 h-1 md:h-2 bg-amber-500 transition-all duration-500 ease-out group-hover:w-full"></span>
            </a>
        </div>
    </footer>

</div>
@endif

@include('partials.footer')
















<!-- @include('partials.header')

<div class="relative w-full h-screen overflow-hidden bg-black">

    {{-- Título superpuesto --}}
    <div class="absolute z-20 pointer-events-none top-24 left-12">
        <h1 class="text-4xl font-black tracking-tighter text-white uppercase drop-shadow-2xl">
            Recorrido <br> Virtual
        </h1>
        <p class="font-mono text-xs tracking-widest text-amber-500 uppercase mt-2">The Ring Experience</p>
    </div>

    {{-- Contenedor del Tour 360 --}}
    <div id="panorama" class="w-full h-screen"></div>

</div>
@if($salones->isEmpty())
<main class="grid min-h-screen place-items-center bg-zinc-50 dark:bg-zinc-950 px-6 text-center text-zinc-900 dark:text-white transition-colors duration-500">
    <div>
        <p class="mb-5 font-mono text-xs uppercase tracking-[0.35em] text-amber-500">Colección en construcción</p>
        <h1 class="text-4xl font-black uppercase tracking-tighter md:text-7xl">No hay espacios disponibles</h1>
        <p class="mt-5 text-zinc-500 dark:text-zinc-400">Aún no se han registrado salones en el sistema.</p>
    </div>
</main>
@else
<div class="venue-experience min-h-screen overflow-hidden bg-zinc-50 dark:bg-[#0b0b0c] font-sans text-zinc-900 dark:text-white selection:bg-amber-400 selection:text-black transition-colors duration-500">

    {{-- BARRA DE PROGRESO SUPERIOR --}}
    <div class="fixed inset-x-0 top-0 z-50 h-1 bg-zinc-200 dark:bg-white/10">
        <div class="venue-progress h-full w-0 origin-left bg-amber-500"></div>
    </div>

    {{-- SECCIÓN INTRO --}}
    <section class="venue-intro relative flex min-h-screen flex-col justify-between overflow-hidden px-6 py-8 md:px-12 md:py-10  mt-20">
        <div class="max-w-6xl">
            <p class="venue-kicker mb-7 font-mono text-xs uppercase tracking-[0.4em] text-amber-600 dark:text-amber-400 intro-badge">Una colección para recordar</p>
            <h1 class="venue-title max-w-5xl text-[clamp(4.2rem,13vw,12rem)] font-black uppercase leading-[.8] tracking-[-.08em]">
                <span class="text-line-wrapper"><span class="block intro-title-line">Espacios</span></span>
                <span class="text-line-wrapper"><span class="block text-zinc-300 dark:text-white/25 intro-title-line">singulares.</span></span>
            </h1>
        </div>
        <div class="flex items-end justify-between gap-8 intro-scroll-indicator">
            <p class="max-w-xs text-sm leading-relaxed text-zinc-500 dark:text-white/50">Arquitectura, atmósfera y posibilidades. Encuentra el escenario perfecto para tu próximo momento.</p>
            <div class="venue-scroll-hint flex items-center gap-3 font-mono text-[10px] uppercase tracking-[0.3em] text-amber-600 dark:text-amber-400">
                <span class="h-px w-12 bg-amber-600 dark:bg-amber-400"></span>Desliza
            </div>
        </div>
    </section>

    {{-- SCROLL HORIZONTAL --}}
    <section class="venues-horizontal-wrapper relative h-screen">
        <div class="venues-horizontal-container flex h-full" style="width: {{ ($salones->count() + 1) * 100 }}vw;">
            <div class="w-screen shrink-0"></div>

            @foreach ($salones as $index => $salon)
            @php
            $imagenes = is_string($salon->images) ? json_decode($salon->images, true) : $salon->images;
            $imagenes = is_array($imagenes) ? $imagenes : [];
            @endphp

            <article class="venue-slide relative flex h-full w-screen shrink-0 items-center px-6 py-16 md:px-[8vw]" data-index="{{ $index }}">
                {{-- Fondo Parallax --}}
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_70%_50%,rgba(245,158,11,.05),transparent_40%)] dark:bg-[radial-gradient(circle_at_70%_50%,rgba(245,158,11,.09),transparent_34%)] venue-parallax-bg scale-110"></div>

                <div class="relative z-10 grid w-full items-center gap-10 md:grid-cols-[1.08fr_.92fr] md:gap-[7vw]">
                    {{-- Galería --}}
                    <div class="venue-gallery group grid h-[47vh] gap-3 md:h-[70vh] {{ count($imagenes) > 1 ? 'grid-cols-2 grid-rows-2' : 'grid-cols-1' }}">
                        @forelse(array_slice($imagenes, 0, 3) as $imageIndex => $imagen)
                        <button type="button" class="venue-image relative overflow-hidden rounded-[1.5rem] text-left shadow-2xl venue-main-img-mask cursor-hover-target {{ count($imagenes) > 2 && $imageIndex === 0 ? 'row-span-2' : (count($imagenes) === 2 ? 'row-span-2' : '') }}" data-lightbox="{{ asset('storage/' . $imagen) }}">
                            <img src="{{ asset('storage/' . $imagen) }}" alt="{{ $salon->name }}" loading="lazy" class="h-full w-full object-cover transition-transform duration-1000 group-hover:scale-105">
                            <span class="absolute inset-0 bg-black/5 dark:bg-black/0 transition-colors group-hover:bg-black/10 dark:group-hover:bg-black/20"></span>
                        </button>
                        @empty
                        <div class="grid place-items-center rounded-[1.5rem] border border-zinc-200 dark:border-white/10 bg-zinc-100 dark:bg-white/[.04] font-mono text-xs uppercase tracking-widest text-zinc-400 dark:text-white/35 venue-main-img-mask">Sin imágenes</div>
                        @endforelse
                    </div>

                    {{-- Copy / Info --}}
                    <div class="venue-copy max-w-xl">
                        <div class="mb-6 flex items-center gap-4 font-mono text-xs uppercase tracking-[.25em] text-amber-600 dark:text-amber-400">
                            <span class="text-line">{{ sprintf('%02d', $index + 1) }}</span>
                            <span class="h-px w-12 bg-amber-500/60 text-line"></span>
                            <span class="text-line">Aforo {{ $salon->capacity ?? 'N/A' }} pax</span>
                        </div>
                        <h2 class="mb-6 text-5xl font-black uppercase leading-[.88] tracking-[-.06em] md:text-8xl text-line">{{ $salon->name }}</h2>

                        @if($salon->description)
                        <p class="mb-9 max-w-lg text-base leading-relaxed text-zinc-600 dark:text-white/55 md:text-lg text-line">{{ $salon->description }}</p>
                        @endif

                        <div class="mb-10 flex flex-wrap gap-3">
                            <div class="rounded-2xl border border-zinc-200 dark:border-white/10 bg-white/50 dark:bg-white/[.06] px-5 py-4 backdrop-blur-xl venue-float-1 cursor-hover-target">
                                <span class="mb-1 block font-mono text-[10px] uppercase tracking-widest text-zinc-500 dark:text-white/35">Inversión</span>
                                <strong class="text-xl">${{ number_format($salon->price, 0, ',', '.') }} <small class="text-xs font-normal text-zinc-500 dark:text-white/40">COP</small></strong>
                            </div>
                            <div class="rounded-2xl border border-zinc-200 dark:border-white/10 bg-white/50 dark:bg-white/[.06] px-5 py-4 backdrop-blur-xl venue-float-2 cursor-hover-target">
                                <span class="mb-1 block font-mono text-[10px] uppercase tracking-widest text-zinc-500 dark:text-white/35">Estado</span>
                                <strong class="text-xl">{{ $salon->estado ?? 'Disponible' }}</strong>
                            </div>
                        </div>

                        <div class="magnetic-wrapper inline-block">
                            <a href="#contacto" class="magnetic-button inline-flex items-center gap-5 rounded-full bg-amber-500 px-6 py-4 text-sm font-bold uppercase tracking-widest text-black transition-transform hover:bg-amber-400 cursor-hover-target">
                                <span class="magnetic-text">Reservar este espacio</span> <span aria-hidden="true" class="magnetic-text">↗</span>
                            </a>
                        </div>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
    </section>

    {{-- FOOTER CONTACTO --}}
    <footer id="contacto" class="flex min-h-[35vh] items-center justify-between border-t border-zinc-200 dark:border-white/10 bg-zinc-50 dark:bg-[#0b0b0c] px-6 py-12 md:px-12 relative z-20">
        <p class="font-mono text-xs uppercase tracking-[.3em] text-zinc-500 dark:text-white/40">El escenario de tu próxima historia</p>
        <div class="text-right">
            <p class="mb-2 text-sm text-zinc-500 dark:text-white/40">¿Hablamos?</p>
            <a href="mailto:eventosthering@gmail.com" class="text-xl font-bold text-amber-600 dark:text-amber-400 transition-colors hover:text-zinc-900 dark:hover:text-white md:text-3xl cursor-hover-target">reservas@tudominio.com</a>
        </div>
    </footer>

</div>
@endif

@include('partials.footer') -->












































