@include('partials.header')



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

@include('partials.footer')