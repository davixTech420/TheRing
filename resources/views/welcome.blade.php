<!-- 
{{-- resources/views/events-ultimate-pro.blade.php --}}
<!DOCTYPE html>
<html lang="es" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Ring | Ecosistema Avanzado de Eventos</title>
    
    {{-- Dependencias CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    
    <style>
        /* Scrollbar Premium */
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #09090b; }
        ::-webkit-scrollbar-thumb { background: #3f3f46; border-radius: 4px; }
        
        /* Animación infinita para la cinta corporativa */
        @keyframes marquee {
            0% { transform: translateX(0%); }
            100% { transform: translateX(-100%); }
        }
        .animate-marquee {
            display: inline-block;
            white-space: nowrap;
            animation: marquee 20s linear infinite;
        }

        /* Utilidad para ocultar steps del form sin parpadeos */
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-zinc-950 text-zinc-100 font-sans antialiased overflow-x-hidden selection:bg-amber-500 selection:text-black relative">

    {{-- 1. HERO CON VIDEO DE FONDO Y CAPAS DE TEXTO --}}
    <section class="relative h-screen flex flex-col items-center justify-center overflow-hidden px-6 hero-section">
        <div class="absolute inset-0 z-0 hero-bg-container scale-110">
            <video autoplay loop muted playsinline class="w-full h-full object-cover opacity-50 hero-media">
                <source src="https://cdn.coverr.co/videos/coverr-a-beautiful-wedding-setup-2633/1080p.mp4" type="video/mp4">
            </video>
            <div class="absolute inset-0 bg-gradient-to-b from-zinc-950/30 via-zinc-950/70 to-zinc-950"></div>
        </div>
        
        <div class="relative z-10 text-center w-full max-w-6xl mx-auto flex flex-col items-center justify-center">
            <div class="overflow-hidden mb-6">
                <span class="text-amber-500 tracking-[0.8em] text-xs font-mono uppercase block translate-y-full hero-title-part">Ecosistema Centralizado</span>
            </div>
            <div class="overflow-hidden">
                <h1 class="text-7xl md:text-[10rem] font-black tracking-tighter uppercase leading-none translate-y-full hero-title-part">
                    THE <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-orange-500 to-amber-700">RING</span>
                </h1>
            </div>
            <div class="overflow-hidden mt-8 max-w-2xl">
                <p class="text-zinc-400 text-lg md:text-2xl font-light translate-y-full hero-title-part">
                    El motor definitivo para la creación, gestión y ejecución de eventos de alto calibre.
                </p>
            </div>
        </div>
        
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center scroll-indicator opacity-0">
            <span class="text-[10px] font-mono text-zinc-500 uppercase tracking-widest mb-2">Descubrir</span>
            <div class="w-[1px] h-12 bg-gradient-to-b from-amber-500 to-transparent"></div>
        </div>
    </section>

    {{-- 2. CINTA DE CAPACIDADES --}}
    <div class="w-full bg-amber-500 py-3 overflow-hidden border-y border-amber-600 relative z-20 flex whitespace-nowrap">
        <div class="animate-marquee flex items-center text-zinc-950 font-black uppercase text-sm tracking-widest">
            <span class="mx-8">• Sincronización JSON</span><span class="mx-8">• Gestión de Aforos en Tiempo Real</span>
            <span class="mx-8">• Control de Inventario Técnico</span><span class="mx-8">• Asignación de Staff Dinámica</span>
            <span class="mx-8">• Arquitectura Modular</span>
        </div>
        <div class="animate-marquee flex items-center text-zinc-950 font-black uppercase text-sm tracking-widest" aria-hidden="true">
            <span class="mx-8">• Sincronización JSON</span><span class="mx-8">• Gestión de Aforos en Tiempo Real</span>
            <span class="mx-8">• Control de Inventario Técnico</span><span class="mx-8">• Asignación de Staff Dinámica</span>
            <span class="mx-8">• Arquitectura Modular</span>
        </div>
    </div>

    {{-- 3. MISIÓN, VISIÓN Y MÉTRICAS (Bento Box) --}}
    <section class="py-32 px-6 max-w-7xl mx-auto relative corporate-section">
        <div class="text-center mb-20 corporate-header">
            <span class="text-amber-500 font-mono text-xs uppercase tracking-widest">Nuestra Filosofía</span>
            <h2 class="text-4xl md:text-6xl font-bold tracking-tight mt-2">Redefiniendo el Estándar</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
            <div class="md:col-span-7 bg-zinc-900/40 border border-zinc-800/80 rounded-[2.5rem] p-10 md:p-14 backdrop-blur-xl relative overflow-hidden group hover:border-amber-500/30 transition-colors duration-500 reveal-box">
                <div class="absolute top-0 right-0 w-64 h-64 bg-amber-500/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 group-hover:bg-amber-500/10 transition-all duration-700"></div>
                <div class="w-14 h-14 rounded-2xl bg-zinc-800 flex items-center justify-center mb-8 border border-zinc-700">
                    <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <h3 class="text-3xl font-black mb-4">Nuestra Misión</h3>
                <p class="text-zinc-400 text-lg leading-relaxed font-light">
                    Automatizar y perfeccionar la producción de eventos complejos, entregando a organizadores y clientes una plataforma centralizada que elimine el margen de error mediante tecnología en tiempo real.
                </p>
            </div>

            <div class="md:col-span-5 bg-zinc-900/40 border border-zinc-800/80 rounded-[2.5rem] p-10 md:p-14 backdrop-blur-xl relative overflow-hidden group hover:border-amber-500/30 transition-colors duration-500 reveal-box">
                <div class="w-14 h-14 rounded-2xl bg-zinc-800 flex items-center justify-center mb-8 border border-zinc-700">
                    <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                </div>
                <h3 class="text-3xl font-black mb-4">Visión 2030</h3>
                <p class="text-zinc-400 text-lg leading-relaxed font-light">
                    Consolidarnos como el sistema operativo líder para la gestión integral de recintos, staff e inventario tecnológico de alta gama.
                </p>
            </div>

            <div class="md:col-span-4 bg-amber-500 text-zinc-950 rounded-[2.5rem] p-10 flex flex-col justify-center reveal-box">
                <span class="text-5xl font-black tracking-tighter">0 ms</span>
                <span class="text-sm font-bold uppercase tracking-widest mt-2 opacity-80">Latencia JSON</span>
            </div>
            <div class="md:col-span-4 bg-zinc-900/40 border border-zinc-800/80 rounded-[2.5rem] p-10 flex flex-col justify-center reveal-box">
                <span class="text-5xl font-black text-white tracking-tighter">+50</span>
                <span class="text-sm font-bold uppercase tracking-widest mt-2 text-zinc-500">Salones Mapeados</span>
            </div>
            <div class="md:col-span-4 bg-zinc-900/40 border border-zinc-800/80 rounded-[2.5rem] p-10 flex flex-col justify-center reveal-box">
                <span class="text-5xl font-black text-white tracking-tighter">100%</span>
                <span class="text-sm font-bold uppercase tracking-widest mt-2 text-zinc-500">Personalización Modular</span>
            </div>
        </div>
    </section>

    {{-- 4. SCROLL HORIZONTAL ANCLADO --}}
    <section class="horizontal-scroll-container overflow-hidden bg-zinc-950 relative border-t border-zinc-900">
        <div class="horizontal-wrapper flex w-[400vw] h-screen">
            
            <div class="panel w-screen h-screen flex items-center justify-center px-6 md:px-20 relative">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 w-full max-w-7xl items-center">
                    <div class="space-y-6">
                        <span class="text-8xl font-black text-zinc-900 absolute -top-10 -left-10 select-none">01</span>
                        <h2 class="text-5xl md:text-7xl font-black">Salones<br>Inteligentes</h2>
                        <p class="text-zinc-400 text-xl font-light">Mapeo de espacios con capacidad dinámica. Asigna el recinto perfecto en milisegundos.</p>
                    </div>
                    <div class="reveal-img-container h-[60vh] rounded-[2rem] overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover" alt="Salones">
                    </div>
                </div>
            </div>

            <div class="panel w-screen h-screen flex items-center justify-center px-6 md:px-20 relative">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 w-full max-w-7xl items-center">
                    <div class="reveal-img-container h-[60vh] rounded-[2rem] overflow-hidden md:order-1 order-2">
                        <img src="https://images.unsplash.com/photo-1517457373958-b7bdd4587205?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover" alt="Staff">
                    </div>
                    <div class="space-y-6 md:order-2 order-1">
                        <span class="text-8xl font-black text-zinc-900 absolute -top-10 right-10 select-none">02</span>
                        <h2 class="text-5xl md:text-7xl font-black">Staff<br>Sincronizado</h2>
                        <p class="text-zinc-400 text-xl font-light">Asignación de roles en tiempo real. Desde seguridad hasta protocolo, todos conectados.</p>
                    </div>
                </div>
            </div>

            <div class="panel w-screen h-screen flex items-center justify-center px-6 md:px-20 relative">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 w-full max-w-7xl items-center">
                    <div class="space-y-6">
                        <span class="text-8xl font-black text-zinc-900 absolute -bottom-10 -left-10 select-none">03</span>
                        <h2 class="text-5xl md:text-7xl font-black">Inventario<br>Técnico</h2>
                        <p class="text-zinc-400 text-xl font-light">Control preciso de equipos, mobiliario y tecnología audiovisual para evitar fallos.</p>
                    </div>
                    <div class="reveal-img-container h-[60vh] rounded-[2rem] overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover" alt="Inventario">
                    </div>
                </div>
            </div>

            <div class="panel w-screen h-screen flex items-center justify-center px-6 md:px-20 relative bg-zinc-900/50">
                <div class="text-center max-w-4xl mx-auto space-y-8">
                    <h2 class="text-5xl md:text-8xl font-black text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-orange-600">Gestión a Medida</h2>
                    <p class="text-zinc-400 text-2xl font-light">Personaliza tu evento al 100% en el motor de reservas a continuación.</p>
                </div>
            </div>

        </div>
    </section>

    {{-- 5. MOTOR DE CONFIGURACIÓN 100% PERSONALIZABLE --}}
    <section class="py-32 px-6 max-w-[90rem] mx-auto relative builder-section border-t border-zinc-900">
        <div class="text-center mb-20 builder-header">
            <span class="text-amber-500 font-mono text-xs uppercase tracking-widest">Motor de Reservas</span>
            <h2 class="text-5xl md:text-7xl font-bold tracking-tight mt-2">Personalización Total</h2>
        </div>

        <div x-data="{ 
                step: 1, 
                eventData: { 
                    name: '', type: 'Boda', startDate: '', endDate: '', guests: 150, 
                    salons: [], services: [], customDetails: '' 
                },
                toggleArray(arr, item) {
                    if (this.eventData[arr].includes(item)) {
                        this.eventData[arr] = this.eventData[arr].filter(i => i !== item);
                    } else {
                        this.eventData[arr].push(item);
                    }
                },
                progress() { return (this.step / 4) * 100 } 
            }" 
            class="bg-zinc-900/40 border border-zinc-800/80 rounded-[3rem] p-8 md:p-12 backdrop-blur-2xl relative overflow-hidden form-interactive-container">
            
            <div class="absolute top-0 left-0 h-2 bg-zinc-800 w-full">
                <div class="h-full bg-amber-500 transition-all duration-700 ease-out" :style="'width: ' + progress() + '%'"></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 relative z-10">
                
                {{-- FORMULARIO MULTIPASO --}}
                <div class="lg:col-span-7 space-y-8 min-h-[500px] flex flex-col justify-center">
                    
                    {{-- PASO 1 --}}
                    <div x-show="step === 1" x-transition:enter="transition ease-out duration-500">
                        <span class="text-amber-500 font-mono text-xs mb-2 block">Paso 01 / 04</span>
                        <h3 class="text-4xl font-bold mb-8">Información General</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div><label class="block text-sm text-zinc-400 mb-2">Nombre del Evento</label><input type="text" placeholder="Ej. Lanzamiento Socotec" x-model="eventData.name" class="w-full bg-zinc-950 border border-zinc-800 rounded-2xl px-6 py-4 text-white focus:border-amber-500 transition outline-none"></div>
                            <div><label class="block text-sm text-zinc-400 mb-2">Categoría</label><select x-model="eventData.type" class="w-full bg-zinc-950 border border-zinc-800 rounded-2xl px-6 py-4 text-white focus:border-amber-500 transition outline-none"><option>Boda</option><option>Corporativo</option><option>Social</option></select></div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div><label class="block text-sm text-zinc-400 mb-2">Fecha y Hora de Inicio</label><input type="datetime-local" x-model="eventData.startDate" class="w-full bg-zinc-950 border border-zinc-800 rounded-2xl px-6 py-4 text-white focus:border-amber-500 transition outline-none [color-scheme:dark]"></div>
                            <div><label class="block text-sm text-zinc-400 mb-2">Fecha y Hora de Fin</label><input type="datetime-local" x-model="eventData.endDate" class="w-full bg-zinc-950 border border-zinc-800 rounded-2xl px-6 py-4 text-white focus:border-amber-500 transition outline-none [color-scheme:dark]"></div>
                        </div>
                        <button type="button" @click="step = 2" class="px-8 py-4 bg-white text-black font-bold rounded-full hover:scale-105 transition-transform shadow-[0_0_20px_rgba(255,255,255,0.2)]">Continuar a Espacios</button>
                    </div>

                    {{-- PASO 2 --}}
                    <div x-cloak x-show="step === 2" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0">
                        <span class="text-amber-500 font-mono text-xs mb-2 block">Paso 02 / 04</span>
                        <h3 class="text-4xl font-bold mb-8">Asignación de Salones</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                            <button type="button" @click="toggleArray('salons', 'Gran Salón Imperial')" :class="eventData.salons.includes('Gran Salón Imperial') ? 'border-amber-500 bg-amber-500/10 text-amber-500' : 'border-zinc-800 hover:border-zinc-600 text-zinc-400'" class="p-6 border rounded-2xl text-left transition-all"><span class="block font-bold text-lg mb-1">Gran Salón Imperial</span><span class="text-xs">Capacidad: 500 pax</span></button>
                            <button type="button" @click="toggleArray('salons', 'Terraza Garden')" :class="eventData.salons.includes('Terraza Garden') ? 'border-amber-500 bg-amber-500/10 text-amber-500' : 'border-zinc-800 hover:border-zinc-600 text-zinc-400'" class="p-6 border rounded-2xl text-left transition-all"><span class="block font-bold text-lg mb-1">Terraza Garden</span><span class="text-xs">Capacidad: 250 pax</span></button>
                            <button type="button" @click="toggleArray('salons', 'Auditorio Tech')" :class="eventData.salons.includes('Auditorio Tech') ? 'border-amber-500 bg-amber-500/10 text-amber-500' : 'border-zinc-800 hover:border-zinc-600 text-zinc-400'" class="p-6 border rounded-2xl text-left transition-all md:col-span-2"><span class="block font-bold text-lg mb-1">Auditorio Tech</span><span class="text-xs">Capacidad: 350 pax</span></button>
                        </div>
                        <div class="flex gap-4">
                            <button type="button" @click="step = 1" class="px-8 py-4 bg-zinc-800 text-white font-bold rounded-full hover:bg-zinc-700 transition">Atrás</button>
                            <button type="button" @click="step = 3" class="px-8 py-4 bg-white text-black font-bold rounded-full hover:scale-105 transition-transform shadow-[0_0_20px_rgba(255,255,255,0.2)]">Configurar Servicios</button>
                        </div>
                    </div>

                    {{-- PASO 3 --}}
                    <div x-cloak x-show="step === 3" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0">
                        <span class="text-amber-500 font-mono text-xs mb-2 block">Paso 03 / 04</span>
                        <h3 class="text-4xl font-bold mb-8">Servicios y Staff</h3>
                        <div class="mb-8">
                            <label class="block text-sm text-zinc-400 mb-2">Aforo Total Esperado: <span class="text-amber-500 font-bold" x-text="eventData.guests"></span> pax</label>
                            <input type="range" min="50" max="1000" step="10" x-model="eventData.guests" class="w-full accent-amber-500 bg-zinc-950 h-2 rounded-lg cursor-pointer">
                        </div>
                        <div class="grid grid-cols-2 gap-4 mb-8">
                            <label class="flex items-center space-x-3 p-4 border border-zinc-800 rounded-xl cursor-pointer hover:bg-zinc-900 transition"><input type="checkbox" @click="toggleArray('services', 'Catering Premium')" class="w-5 h-5 accent-amber-500"><span class="text-sm font-medium">Catering Premium</span></label>
                            <label class="flex items-center space-x-3 p-4 border border-zinc-800 rounded-xl cursor-pointer hover:bg-zinc-900 transition"><input type="checkbox" @click="toggleArray('services', 'Seguridad')" class="w-5 h-5 accent-amber-500"><span class="text-sm font-medium">Seguridad Privada</span></label>
                            <label class="flex items-center space-x-3 p-4 border border-zinc-800 rounded-xl cursor-pointer hover:bg-zinc-900 transition md:col-span-2"><input type="checkbox" @click="toggleArray('services', 'Producción Audiovisual')" class="w-5 h-5 accent-amber-500"><span class="text-sm font-medium">Producción Audiovisual (Avanzada)</span></label>
                        </div>
                        <div class="flex gap-4">
                            <button type="button" @click="step = 2" class="px-8 py-4 bg-zinc-800 text-white font-bold rounded-full hover:bg-zinc-700 transition">Atrás</button>
                            <button type="button" @click="step = 4" class="px-8 py-4 bg-white text-black font-bold rounded-full hover:scale-105 transition-transform shadow-[0_0_20px_rgba(255,255,255,0.2)]">Detalles Finales</button>
                        </div>
                    </div>

                    {{-- PASO 4 --}}
                    <div x-cloak x-show="step === 4" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                        <span class="text-amber-500 font-mono text-xs mb-2 block">Paso 04 / 04</span>
                        <h3 class="text-4xl font-bold mb-8">Detalles Estructurales</h3>
                        <p class="text-zinc-400 mb-6">Especificaciones técnicas para el campo `custom_details` JSON.</p>
                        <div class="mb-8">
                            <textarea x-model="eventData.customDetails" rows="4" placeholder="Requerimientos específicos..." class="w-full bg-zinc-950 border border-zinc-800 rounded-2xl px-6 py-4 text-white outline-none focus:border-amber-500 transition resize-none"></textarea>
                        </div>
                        <div class="flex gap-4">
                            <button type="button" @click="step = 3" class="px-8 py-4 bg-zinc-800 text-white font-bold rounded-full hover:bg-zinc-700 transition">Atrás</button>
                            <button type="button" class="px-8 py-4 bg-amber-500 text-zinc-950 font-black rounded-full shadow-[0_0_30px_rgba(245,158,11,0.4)] hover:scale-105 transition-transform w-full uppercase tracking-widest">Confirmar Proyecto</button>
                        </div>
                    </div>
                </div>

                {{-- TERMINAL DE DATOS --}}
                <div class="lg:col-span-5 bg-zinc-950/80 rounded-[2rem] p-8 border border-zinc-800 relative flex flex-col justify-between shadow-2xl overflow-hidden backdrop-blur-3xl">
                    <div class="relative z-10">
                        <div class="flex justify-between items-center mb-6 border-b border-zinc-800/80 pb-4">
                            <span class="text-zinc-500 font-mono text-xs uppercase tracking-widest">Payload.json // Live Sync</span>
                            <span class="flex h-3 w-3 relative"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span><span class="relative inline-flex rounded-full h-3 w-3 bg-amber-500"></span></span>
                        </div>
                        <div class="font-mono text-[13px] md:text-sm text-zinc-300 leading-relaxed overflow-x-auto">
                            <p><span class="text-zinc-500">{</span></p>
                            <p class="pl-4"><span class="text-blue-400">"event"</span>: <span class="text-zinc-500">{</span></p>
                            <p class="pl-8"><span class="text-amber-300">"name"</span>: <span class="text-green-400">"<span x-text="eventData.name || 'null'"></span>"</span>,</p>
                            <p class="pl-8"><span class="text-amber-300">"event_type"</span>: <span class="text-green-400">"<span x-text="eventData.type"></span>"</span>,</p>
                            <p class="pl-8"><span class="text-amber-300">"start_date"</span>: <span class="text-green-400">"<span x-text="eventData.startDate || 'null'"></span>"</span>,</p>
                            <p class="pl-8"><span class="text-amber-300">"end_date"</span>: <span class="text-green-400">"<span x-text="eventData.endDate || 'null'"></span>"</span>,</p>
                            <p class="pl-8"><span class="text-amber-300">"guests_capacity"</span>: <span class="text-orange-400" x-text="eventData.guests"></span></p>
                            <p class="pl-4"><span class="text-zinc-500">},</span></p>
                            
                            <p class="pl-4"><span class="text-blue-400">"relations"</span>: <span class="text-zinc-500">{</span></p>
                            <p class="pl-8"><span class="text-amber-300">"event_salons"</span>: <span class="text-purple-400" x-text="JSON.stringify(eventData.salons)"></span>,</p>
                            <p class="pl-8"><span class="text-amber-300">"event_services"</span>: <span class="text-purple-400" x-text="JSON.stringify(eventData.services)"></span></p>
                            <p class="pl-4"><span class="text-zinc-500">},</span></p>

                            <p class="pl-4"><span class="text-blue-400">"custom_details"</span>: <span class="text-green-400">"<span x-text="eventData.customDetails.substring(0, 30) + (eventData.customDetails.length > 30 ? '...' : '')"></span>"</span></p>
                            <p><span class="text-zinc-500">}</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 6. MAPA TÁCTICO DE OPERACIONES --}}
    <section class="py-32 px-6 max-w-7xl mx-auto relative map-section border-t border-zinc-900">
        <div class="text-center mb-16 map-header">
            <span class="text-amber-500 font-mono text-xs uppercase tracking-widest flex items-center justify-center gap-2">
                <span class="relative flex h-2 w-2">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                </span>
                Cobertura y Logística
            </span>
            <h2 class="text-4xl md:text-6xl font-black tracking-tight mt-4">Base de Operaciones</h2>
            <p class="text-zinc-400 mt-4 max-w-2xl mx-auto font-light">Estratégicamente ubicados en Bogotá, Colombia, coordinamos el despliegue de tecnología y staff para eventos de alto impacto.</p>
        </div>

        <div class="relative w-full h-[600px] md:h-[700px] rounded-[3rem] overflow-hidden border border-zinc-800 shadow-2xl map-container bg-zinc-900">
            <div class="absolute inset-0 z-20 pointer-events-none">
                <div class="absolute top-8 left-8 border-l-2 border-t-2 border-amber-500/50 w-16 h-16"></div>
                <div class="absolute top-8 right-8 border-r-2 border-t-2 border-amber-500/50 w-16 h-16"></div>
                <div class="absolute bottom-8 left-8 border-l-2 border-b-2 border-amber-500/50 w-16 h-16"></div>
                <div class="absolute bottom-8 right-8 border-r-2 border-b-2 border-amber-500/50 w-16 h-16"></div>
                
                <div class="absolute bottom-12 left-12 bg-zinc-950/80 backdrop-blur-md border border-zinc-800 p-6 rounded-2xl pointer-events-auto hover:border-amber-500/50 transition-colors cursor-pointer map-info-card">
                    <h3 class="text-white font-bold text-lg">The Ring HQ</h3>
                    <p class="text-zinc-400 text-sm mt-1 font-mono">LAT 4.6097° N | LON 74.0817° W</p>
                    <div class="mt-4 flex items-center gap-2">
                        <div class="h-2 w-2 bg-green-500 rounded-full animate-pulse"></div>
                        <span class="text-xs uppercase tracking-widest text-zinc-300">Sistemas en línea</span>
                    </div>
                </div>
            </div>

            <div class="absolute inset-0 z-10 scale-110 map-iframe-wrapper">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127255.10549449488!2d-74.16781292026543!3d4.648283717208886!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f9bfd2da6cb29%3A0x239d635520a33914!2sBogot%C3%A1%2C%20Bogota%2C%20Colombia!5e0!3m2!1sen!2sco!4v1700000000000!5m2!1sen!2sco" class="w-full h-full border-0 pointer-events-auto" style="filter: grayscale(100%) invert(92%) contrast(110%) hue-rotate(180deg);" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            
            <div class="absolute inset-0 z-15 bg-gradient-to-t from-zinc-950 via-transparent to-zinc-950 pointer-events-none opacity-80"></div>
        </div>
    </section>

    {{-- 7. BOTÓN FLOTANTE DE WHATSAPP --}}
    <div class="fixed bottom-8 right-8 z-50">
        <a href="https://wa.me/573000000000" target="_blank" rel="noopener noreferrer" class="group flex items-center gap-3">
            <div class="bg-zinc-900 border border-zinc-800 text-white text-sm font-bold py-2 px-4 rounded-xl opacity-0 group-hover:opacity-100 transform translate-x-4 group-hover:translate-x-0 transition-all duration-300 shadow-xl backdrop-blur-md">
                Agenda tu Demo
            </div>
            <div class="w-16 h-16 bg-green-500 hover:bg-green-400 rounded-full flex items-center justify-center shadow-[0_0_20px_rgba(34,197,94,0.4)] hover:scale-110 transition-all duration-300 relative cursor-pointer">
                <div class="absolute inset-0 rounded-full border border-green-400 animate-ping opacity-75"></div>
                <svg class="w-8 h-8 text-white relative z-10" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.098.824z"/></svg>
            </div>
        </a>
    </div>

    {{-- SCRIPTS PRINCIPALES DE ANIMACIÓN GSAP --}}
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            gsap.registerPlugin(ScrollTrigger);

            // 1. Hero Cinematic Reveal
            const heroTl = gsap.timeline();
            heroTl.to(".hero-media", { scale: 1, duration: 2.5, ease: "power4.out" })
                  .to(".hero-title-part", { y: 0, stagger: 0.15, duration: 1.2, ease: "power4.out" }, "-=2")
                  .to(".scroll-indicator", { opacity: 1, y: 10, duration: 1, repeat: -1, yoyo: true, ease: "sine.inOut" }, "-=0.5");

            gsap.to(".hero-bg-container", {
                scrollTrigger: { trigger: ".hero-section", start: "top top", end: "bottom top", scrub: 1 },
                y: 150, opacity: 0
            });

            // 2. Corporate Bento Box Reveal
            gsap.from(".corporate-header", {
                scrollTrigger: { trigger: ".corporate-section", start: "top 80%", end: "top 50%", scrub: 1 },
                y: 50, opacity: 0
            });
            gsap.from(".reveal-box", {
                scrollTrigger: { trigger: ".corporate-section", start: "top 70%", end: "top 30%", scrub: 1 },
                y: 80, opacity: 0, scale: 0.95, stagger: 0.2
            });

            // 3. Horizontal Scroll Magic
            const horizontalScroll = document.querySelector('.horizontal-wrapper');
            const panels = gsap.utils.toArray('.panel');

            gsap.to(panels, {
                xPercent: -100 * (panels.length - 1), 
                ease: "none",
                scrollTrigger: {
                    trigger: ".horizontal-scroll-container", pin: true, scrub: 1, 
                    snap: 1 / (panels.length - 1), end: () => "+=" + horizontalScroll.offsetWidth 
                }
            });

            gsap.utils.toArray('.reveal-img-container').forEach(container => {
                let img = container.querySelector('img');
                gsap.set(container, { clipPath: "inset(20% 20% 20% 20% round 30px)" });
                gsap.set(img, { scale: 1.4 });
                gsap.to(container, {
                    clipPath: "inset(0% 0% 0% 0% round 32px)",
                    scrollTrigger: {
                        trigger: container, containerAnimation: gsap.getById(horizontalScroll), start: "left center", end: "right center", scrub: 1
                    }
                });
                gsap.to(img, {
                    scale: 1, scrollTrigger: { trigger: container, containerAnimation: gsap.getById(horizontalScroll), start: "left center", end: "right center", scrub: 1 }
                });
            });

            // 4. Form Interactive Engine Reveal
            gsap.from(".builder-header", { scrollTrigger: { trigger: ".builder-section", start: "top 80%", end: "top 50%", scrub: 1 }, y: 100, opacity: 0 });
            gsap.from(".form-interactive-container", {
                scrollTrigger: { trigger: ".form-interactive-container", start: "top 90%", end: "top 40%", scrub: 1.5 },
                y: 100, scale: 0.95, opacity: 0, transformOrigin: "bottom center"
            });

            // 5. Tactical Map Animations
            gsap.from(".map-header", { scrollTrigger: { trigger: ".map-section", start: "top 80%", end: "top 50%", scrub: 1 }, y: 60, opacity: 0 });
            gsap.fromTo(".map-container", 
                { clipPath: "inset(40% 40% 40% 40% round 100px)", opacity: 0 },
                { clipPath: "inset(0% 0% 0% 0% round 48px)", opacity: 1, scrollTrigger: { trigger: ".map-section", start: "top 75%", end: "top 25%", scrub: 1.2 } }
            );
            gsap.from(".map-iframe-wrapper", {
                scrollTrigger: { trigger: ".map-section", start: "top 90%", end: "bottom top", scrub: true }, scale: 1.3, rotation: 1
            });
            gsap.from(".map-info-card", {
                scrollTrigger: { trigger: ".map-container", start: "top 50%", end: "top 30%", scrub: 1 }, x: -50, opacity: 0, backdropFilter: "blur(0px)"
            });
        });
    </script>
</body>
</html> -->














{{-- resources/views/events-ultimate-pro.blade.php --}}
<!DOCTYPE html>
{{-- Alpine.js controla la clase 'dark' basándose en localStorage o el estado actual --}}
<html lang="es" x-data="{ 
    theme: localStorage.getItem('theme') || 'dark',
    toggleTheme() {
        this.theme = this.theme === 'dark' ? 'light' : 'dark';
        localStorage.setItem('theme', this.theme);
    }
}" :class="theme">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Ring | Ecosistema Avanzado de Eventos</title>
    
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    
    <style type="text/tailwindcss">
        /* Habilitar dark mode por clase en Tailwind v4 CDN */
        @custom-variant dark (&:is(.dark *));
        
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { @apply bg-zinc-100 dark:bg-zinc-950; }
        ::-webkit-scrollbar-thumb { @apply bg-zinc-300 dark:bg-zinc-700 rounded-md; }
        
        @keyframes marquee {
            0% { transform: translateX(0%); }
            100% { transform: translateX(-100%); }
        }
        .animate-marquee { display: inline-block; white-space: nowrap; animation: marquee 20s linear infinite; }
        [x-cloak] { display: none !important; }

        /* Magia CSS para el Mapa: Transición suave entre claro y oscuro */
        .map-iframe-wrapper iframe {
            filter: grayscale(100%) contrast(110%);
            transition: filter 0.7s ease;
        }
        .dark .map-iframe-wrapper iframe {
            filter: grayscale(100%) invert(92%) contrast(110%) hue-rotate(180deg);
        }
    </style>
</head>
<body class="bg-zinc-50 dark:bg-zinc-950 text-zinc-900 dark:text-zinc-100 font-sans antialiased overflow-x-hidden selection:bg-amber-500 selection:text-black transition-colors duration-500 relative">

@include('partials.header')


    {{-- BOTÓN TOGGLE DE TEMA (CLARO/OSCURO) --}}
   /*  <button @click="toggleTheme()" class="fixed top-6 right-6 z-50 p-3 rounded-2xl bg-white/60 dark:bg-zinc-900/60 backdrop-blur-xl border border-zinc-200 dark:border-zinc-800 shadow-xl hover:scale-110 transition-all duration-300 group">
        {{-- Icono Sol (Visible en modo Oscuro para cambiar a Claro) --}}
        <svg x-show="theme === 'dark'" class="w-6 h-6 text-amber-500 group-hover:rotate-90 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
        {{-- Icono Luna (Visible en modo Claro para cambiar a Oscuro) --}}
        <svg x-show="theme === 'light'" class="w-6 h-6 text-zinc-600 group-hover:-rotate-12 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
    </button> */

    {{-- 1. HERO --}}
    <section class="relative h-screen flex flex-col items-center justify-center overflow-hidden px-6 hero-section">
        <div class="absolute inset-0 z-0 hero-bg-container scale-110">
            <video autoplay loop muted playsinline class="w-full h-full object-cover opacity-60 dark:opacity-40 hero-media">
                <source src="https://cdn.coverr.co/videos/coverr-a-beautiful-wedding-setup-2633/1080p.mp4" type="video/mp4">
            </video>
            {{-- Gradiente que se adapta al modo --}}
            <div class="absolute inset-0 bg-gradient-to-b from-white/30 via-zinc-50/70 to-zinc-50 dark:from-zinc-950/30 dark:via-zinc-950/70 dark:to-zinc-950 transition-colors duration-500"></div>
        </div>
        
        <div class="relative z-10 text-center w-full max-w-6xl mx-auto flex flex-col items-center justify-center">
            <div class="overflow-hidden mb-6">
                <span class="text-amber-500 tracking-[0.8em] text-xs font-mono uppercase block translate-y-full hero-title-part">Ecosistema Centralizado</span>
            </div>
            <div class="overflow-hidden">
                <h1 class="text-7xl md:text-[10rem] font-black tracking-tighter uppercase leading-none translate-y-full hero-title-part text-zinc-900 dark:text-white transition-colors duration-500">
                    THE <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-orange-500 to-amber-700">RING</span>
                </h1>
            </div>
            <div class="overflow-hidden mt-8 max-w-2xl">
                <p class="text-zinc-600 dark:text-zinc-400 text-lg md:text-2xl font-light translate-y-full hero-title-part transition-colors duration-500">
                    El motor definitivo para la creación, gestión y ejecución de eventos de alto calibre.
                </p>
            </div>
        </div>
        
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center scroll-indicator opacity-0">
            <span class="text-[10px] font-mono text-zinc-400 dark:text-zinc-500 uppercase tracking-widest mb-2">Descubrir</span>
            <div class="w-[1px] h-12 bg-gradient-to-b from-amber-500 to-transparent"></div>
        </div>
    </section>

    {{-- 2. CINTA DE CAPACIDADES --}}
    <div class="w-full bg-amber-500 py-3 overflow-hidden border-y border-amber-600 relative z-20 flex whitespace-nowrap">
        <div class="animate-marquee flex items-center text-zinc-950 font-black uppercase text-sm tracking-widest">
            <span class="mx-8">• Sincronización JSON</span><span class="mx-8">• Gestión de Aforos en Tiempo Real</span>
            <span class="mx-8">• Control de Inventario</span><span class="mx-8">• Asignación de Staff Dinámica</span>
            <span class="mx-8">• Arquitectura Modular</span>
        </div>
        <div class="animate-marquee flex items-center text-zinc-950 font-black uppercase text-sm tracking-widest" aria-hidden="true">
            <span class="mx-8">• Sincronización JSON</span><span class="mx-8">• Gestión de Aforos en Tiempo Real</span>
            <span class="mx-8">• Control de Inventario</span><span class="mx-8">• Asignación de Staff Dinámica</span>
            <span class="mx-8">• Arquitectura Modular</span>
        </div>
    </div>

    {{-- 3. MISIÓN, VISIÓN Y MÉTRICAS (Bento Box Adaptativo) --}}
    <section class="py-32 px-6 max-w-7xl mx-auto relative corporate-section">
        <div class="text-center mb-20 corporate-header">
            <span class="text-amber-500 font-mono text-xs uppercase tracking-widest">Nuestra Filosofía</span>
            <h2 class="text-4xl md:text-6xl font-bold tracking-tight mt-2 text-zinc-900 dark:text-white">Redefiniendo el Estándar</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
            <div class="md:col-span-7 bg-white/60 dark:bg-zinc-900/40 border border-zinc-200 dark:border-zinc-800/80 rounded-[2.5rem] p-10 md:p-14 backdrop-blur-xl relative overflow-hidden group hover:border-amber-500/50 dark:hover:border-amber-500/30 transition-colors duration-500 reveal-box">
                <div class="absolute top-0 right-0 w-64 h-64 bg-amber-500/10 dark:bg-amber-500/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 group-hover:bg-amber-500/20 dark:group-hover:bg-amber-500/10 transition-all duration-700"></div>
                <div class="w-14 h-14 rounded-2xl bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center mb-8 border border-zinc-200 dark:border-zinc-700 transition-colors duration-500">
                    <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <h3 class="text-3xl font-black mb-4">Nuestra Misión</h3>
                <p class="text-zinc-600 dark:text-zinc-400 text-lg leading-relaxed font-light transition-colors duration-500">
                    Automatizar y perfeccionar la producción de eventos complejos, entregando a organizadores y clientes una plataforma centralizada que elimine el margen de error mediante tecnología en tiempo real.
                </p>
            </div>

            <div class="md:col-span-5 bg-white/60 dark:bg-zinc-900/40 border border-zinc-200 dark:border-zinc-800/80 rounded-[2.5rem] p-10 md:p-14 backdrop-blur-xl relative overflow-hidden group hover:border-amber-500/50 dark:hover:border-amber-500/30 transition-colors duration-500 reveal-box">
                <div class="w-14 h-14 rounded-2xl bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center mb-8 border border-zinc-200 dark:border-zinc-700 transition-colors duration-500">
                    <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                </div>
                <h3 class="text-3xl font-black mb-4">Visión 2030</h3>
                <p class="text-zinc-600 dark:text-zinc-400 text-lg leading-relaxed font-light transition-colors duration-500">
                    Consolidarnos como el sistema operativo líder para la gestión integral de recintos, staff e inventario tecnológico de alta gama.
                </p>
            </div>

            <div class="md:col-span-4 bg-amber-500 text-zinc-950 rounded-[2.5rem] p-10 flex flex-col justify-center reveal-box shadow-lg">
                <span class="text-5xl font-black tracking-tighter">0 ms</span>
                <span class="text-sm font-bold uppercase tracking-widest mt-2 opacity-80">Latencia JSON</span>
            </div>
            <div class="md:col-span-4 bg-white/60 dark:bg-zinc-900/40 border border-zinc-200 dark:border-zinc-800/80 rounded-[2.5rem] p-10 flex flex-col justify-center reveal-box">
                <span class="text-5xl font-black tracking-tighter text-zinc-900 dark:text-white transition-colors duration-500">+50</span>
                <span class="text-sm font-bold uppercase tracking-widest mt-2 text-zinc-500">Salones Mapeados</span>
            </div>
            <div class="md:col-span-4 bg-white/60 dark:bg-zinc-900/40 border border-zinc-200 dark:border-zinc-800/80 rounded-[2.5rem] p-10 flex flex-col justify-center reveal-box">
                <span class="text-5xl font-black tracking-tighter text-zinc-900 dark:text-white transition-colors duration-500">100%</span>
                <span class="text-sm font-bold uppercase tracking-widest mt-2 text-zinc-500">Personalización Modular</span>
            </div>
        </div>
    </section>

    {{-- 4. SCROLL HORIZONTAL ANCLADO --}}
    <section class="horizontal-scroll-container overflow-hidden bg-zinc-100 dark:bg-zinc-950 relative border-t border-zinc-200 dark:border-zinc-900 transition-colors duration-500">
        <div class="horizontal-wrapper flex w-[400vw] h-screen">
            
            <div class="panel w-screen h-screen flex items-center justify-center px-6 md:px-20 relative">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 w-full max-w-7xl items-center">
                    <div class="space-y-6">
                        <span class="text-8xl font-black text-zinc-200 dark:text-zinc-900 absolute -top-10 -left-10 select-none transition-colors duration-500">01</span>
                        <h2 class="text-5xl md:text-7xl font-black text-zinc-900 dark:text-white relative z-10">Salones<br>Inteligentes</h2>
                        <p class="text-zinc-600 dark:text-zinc-400 text-xl font-light">Mapeo de espacios con capacidad dinámica. Asigna el recinto perfecto en milisegundos.</p>
                    </div>
                    <div class="reveal-img-container h-[60vh] rounded-[2rem] overflow-hidden shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1511795409834-ef04bbd61622?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover" alt="Salones">
                    </div>
                </div>
            </div>

            <div class="panel w-screen h-screen flex items-center justify-center px-6 md:px-20 relative">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 w-full max-w-7xl items-center">
                    <div class="reveal-img-container h-[60vh] rounded-[2rem] overflow-hidden md:order-1 order-2 shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1517457373958-b7bdd4587205?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover" alt="Staff">
                    </div>
                    <div class="space-y-6 md:order-2 order-1">
                        <span class="text-8xl font-black text-zinc-200 dark:text-zinc-900 absolute -top-10 right-10 select-none transition-colors duration-500">02</span>
                        <h2 class="text-5xl md:text-7xl font-black text-zinc-900 dark:text-white relative z-10">Staff<br>Sincronizado</h2>
                        <p class="text-zinc-600 dark:text-zinc-400 text-xl font-light">Asignación de roles en tiempo real. Desde seguridad hasta protocolo, todos conectados.</p>
                    </div>
                </div>
            </div>

            <div class="panel w-screen h-screen flex items-center justify-center px-6 md:px-20 relative">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 w-full max-w-7xl items-center">
                    <div class="space-y-6">
                        <span class="text-8xl font-black text-zinc-200 dark:text-zinc-900 absolute -bottom-10 -left-10 select-none transition-colors duration-500">03</span>
                        <h2 class="text-5xl md:text-7xl font-black text-zinc-900 dark:text-white relative z-10">Inventario<br>Técnico</h2>
                        <p class="text-zinc-600 dark:text-zinc-400 text-xl font-light">Control preciso de equipos, mobiliario y tecnología audiovisual para evitar fallos.</p>
                    </div>
                    <div class="reveal-img-container h-[60vh] rounded-[2rem] overflow-hidden shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?q=80&w=1000&auto=format&fit=crop" class="w-full h-full object-cover" alt="Inventario">
                    </div>
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

    {{-- 5. MOTOR DE CONFIGURACIÓN 100% PERSONALIZABLE --}}
    <section class="py-32 px-6 max-w-[90rem] mx-auto relative builder-section border-t border-zinc-200 dark:border-zinc-900 transition-colors duration-500">
        <div class="text-center mb-20 builder-header">
            <span class="text-amber-500 font-mono text-xs uppercase tracking-widest">Motor de Reservas</span>
            <h2 class="text-5xl md:text-7xl font-bold tracking-tight mt-2 text-zinc-900 dark:text-white">Personalización Total</h2>
        </div>

        <div x-data="{ 
                step: 1, 
                eventData: { name: '', type: 'Boda', startDate: '', endDate: '', guests: 150, salons: [], services: [], customDetails: '' },
                toggleArray(arr, item) {
                    if (this.eventData[arr].includes(item)) { this.eventData[arr] = this.eventData[arr].filter(i => i !== item); } 
                    else { this.eventData[arr].push(item); }
                },
                progress() { return (this.step / 4) * 100 } 
            }" 
            class="bg-white/60 dark:bg-zinc-900/40 border border-zinc-200 dark:border-zinc-800/80 rounded-[3rem] p-8 md:p-12 backdrop-blur-2xl relative overflow-hidden form-interactive-container shadow-2xl transition-colors duration-500">
            
            <div class="absolute top-0 left-0 h-2 bg-zinc-200 dark:bg-zinc-800 w-full transition-colors duration-500">
                <div class="h-full bg-amber-500 transition-all duration-700 ease-out" :style="'width: ' + progress() + '%'"></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 relative z-10">
                
                {{-- COLUMNA IZQUIERDA: FORMULARIO MULTIPASO --}}
                <div class="lg:col-span-7 space-y-8 min-h-[500px] flex flex-col justify-center">
                    
                    {{-- PASO 1 --}}
                    <div x-show="step === 1" x-transition:enter="transition ease-out duration-500">
                        <span class="text-amber-500 font-mono text-xs mb-2 block">Paso 01 / 04</span>
                        <h3 class="text-4xl font-bold mb-8 text-zinc-900 dark:text-white">Información General</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div><label class="block text-sm text-zinc-600 dark:text-zinc-400 mb-2">Nombre del Evento</label><input type="text" x-model="eventData.name" class="w-full bg-zinc-50 dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 rounded-2xl px-6 py-4 text-zinc-900 dark:text-white focus:border-amber-500 transition outline-none"></div>
                            <div><label class="block text-sm text-zinc-600 dark:text-zinc-400 mb-2">Categoría</label><select x-model="eventData.type" class="w-full bg-zinc-50 dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 rounded-2xl px-6 py-4 text-zinc-900 dark:text-white focus:border-amber-500 transition outline-none"><option>Boda</option><option>Corporativo</option><option>Social</option></select></div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div><label class="block text-sm text-zinc-600 dark:text-zinc-400 mb-2">Inicio</label><input type="datetime-local" x-model="eventData.startDate" class="w-full bg-zinc-50 dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 rounded-2xl px-6 py-4 text-zinc-900 dark:text-white focus:border-amber-500 transition outline-none"></div>
                            <div><label class="block text-sm text-zinc-600 dark:text-zinc-400 mb-2">Fin</label><input type="datetime-local" x-model="eventData.endDate" class="w-full bg-zinc-50 dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 rounded-2xl px-6 py-4 text-zinc-900 dark:text-white focus:border-amber-500 transition outline-none"></div>
                        </div>
                        <button type="button" @click="step = 2" class="px-8 py-4 bg-zinc-900 dark:bg-white text-white dark:text-black font-bold rounded-full hover:scale-105 transition-transform shadow-lg">Continuar</button>
                    </div>

                    {{-- PASO 2 --}}
                    <div x-cloak x-show="step === 2" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0">
                        <span class="text-amber-500 font-mono text-xs mb-2 block">Paso 02 / 04</span>
                        <h3 class="text-4xl font-bold mb-8 text-zinc-900 dark:text-white">Asignación de Salones</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                            <button type="button" @click="toggleArray('salons', 'Gran Salón Imperial')" :class="eventData.salons.includes('Gran Salón Imperial') ? 'border-amber-500 bg-amber-500/10 text-amber-600 dark:text-amber-500' : 'border-zinc-200 dark:border-zinc-800 text-zinc-600 dark:text-zinc-400 hover:border-zinc-400 dark:hover:border-zinc-600'" class="p-6 border rounded-2xl text-left transition-all"><span class="block font-bold text-lg mb-1">Gran Salón Imperial</span><span class="text-xs">Capacidad: 500 pax</span></button>
                            <button type="button" @click="toggleArray('salons', 'Terraza Garden')" :class="eventData.salons.includes('Terraza Garden') ? 'border-amber-500 bg-amber-500/10 text-amber-600 dark:text-amber-500' : 'border-zinc-200 dark:border-zinc-800 text-zinc-600 dark:text-zinc-400 hover:border-zinc-400 dark:hover:border-zinc-600'" class="p-6 border rounded-2xl text-left transition-all"><span class="block font-bold text-lg mb-1">Terraza Garden</span><span class="text-xs">Capacidad: 250 pax</span></button>
                        </div>
                        <div class="flex gap-4">
                            <button type="button" @click="step = 1" class="px-8 py-4 bg-zinc-200 dark:bg-zinc-800 text-zinc-900 dark:text-white font-bold rounded-full hover:bg-zinc-300 dark:hover:bg-zinc-700 transition">Atrás</button>
                            <button type="button" @click="step = 3" class="px-8 py-4 bg-zinc-900 dark:bg-white text-white dark:text-black font-bold rounded-full hover:scale-105 transition-transform shadow-lg">Servicios</button>
                        </div>
                    </div>

                    {{-- PASO 3 --}}
                    <div x-cloak x-show="step === 3" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0">
                        <span class="text-amber-500 font-mono text-xs mb-2 block">Paso 03 / 04</span>
                        <h3 class="text-4xl font-bold mb-8 text-zinc-900 dark:text-white">Servicios y Staff</h3>
                        <div class="mb-8">
                            <label class="block text-sm text-zinc-600 dark:text-zinc-400 mb-2">Aforo Total: <span class="text-amber-500 font-bold" x-text="eventData.guests"></span> pax</label>
                            <input type="range" min="50" max="1000" step="10" x-model="eventData.guests" class="w-full accent-amber-500 bg-zinc-200 dark:bg-zinc-950 h-2 rounded-lg cursor-pointer">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                            <label class="flex items-center space-x-3 p-4 border border-zinc-200 dark:border-zinc-800 rounded-xl cursor-pointer hover:bg-zinc-50 dark:hover:bg-zinc-900 transition"><input type="checkbox" @click="toggleArray('services', 'Catering Premium')" class="w-5 h-5 accent-amber-500"><span class="text-sm font-medium text-zinc-900 dark:text-white">Catering Premium</span></label>
                            <label class="flex items-center space-x-3 p-4 border border-zinc-200 dark:border-zinc-800 rounded-xl cursor-pointer hover:bg-zinc-50 dark:hover:bg-zinc-900 transition"><input type="checkbox" @click="toggleArray('services', 'Seguridad')" class="w-5 h-5 accent-amber-500"><span class="text-sm font-medium text-zinc-900 dark:text-white">Seguridad Privada</span></label>
                        </div>
                        <div class="flex gap-4">
                            <button type="button" @click="step = 2" class="px-8 py-4 bg-zinc-200 dark:bg-zinc-800 text-zinc-900 dark:text-white font-bold rounded-full transition">Atrás</button>
                            <button type="button" @click="step = 4" class="px-8 py-4 bg-zinc-900 dark:bg-white text-white dark:text-black font-bold rounded-full hover:scale-105 transition-transform shadow-lg">Finalizar</button>
                        </div>
                    </div>

                    {{-- PASO 4 --}}
                    <div x-cloak x-show="step === 4" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                        <span class="text-amber-500 font-mono text-xs mb-2 block">Paso 04 / 04</span>
                        <h3 class="text-4xl font-bold mb-8 text-zinc-900 dark:text-white">Detalles JSON Estructurales</h3>
                        <div class="mb-8">
                            <textarea x-model="eventData.customDetails" rows="4" placeholder="Requerimientos específicos..." class="w-full bg-zinc-50 dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 rounded-2xl px-6 py-4 text-zinc-900 dark:text-white outline-none focus:border-amber-500 transition resize-none"></textarea>
                        </div>
                        <div class="flex gap-4">
                            <button type="button" @click="step = 3" class="px-8 py-4 bg-zinc-200 dark:bg-zinc-800 text-zinc-900 dark:text-white font-bold rounded-full transition">Atrás</button>
                            <button type="button" class="px-8 py-4 bg-amber-500 text-zinc-950 font-black rounded-full shadow-lg hover:scale-105 transition-transform w-full uppercase tracking-widest">Confirmar Proyecto</button>
                        </div>
                    </div>
                </div>

                {{-- COLUMNA DERECHA: TERMINAL DE DATOS (Se mantiene oscura intencionalmente en ambos temas por estética developer) --}}
                <div class="lg:col-span-5 bg-zinc-950 rounded-[2rem] p-8 border border-zinc-800 relative flex flex-col justify-between shadow-2xl overflow-hidden">
                    <div class="relative z-10">
                        <div class="flex justify-between items-center mb-6 border-b border-zinc-800 pb-4">
                            <span class="text-zinc-500 font-mono text-xs uppercase tracking-widest">Payload.json // Live Sync</span>
                            <span class="flex h-3 w-3 relative"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span><span class="relative inline-flex rounded-full h-3 w-3 bg-amber-500"></span></span>
                        </div>
                        <div class="font-mono text-[13px] md:text-sm text-zinc-300 leading-relaxed overflow-x-auto">
                            <p><span class="text-zinc-500">{</span></p>
                            <p class="pl-4"><span class="text-blue-400">"event"</span>: <span class="text-zinc-500">{</span></p>
                            <p class="pl-8"><span class="text-amber-300">"name"</span>: <span class="text-green-400">"<span x-text="eventData.name || 'null'"></span>"</span>,</p>
                            <p class="pl-8"><span class="text-amber-300">"event_type"</span>: <span class="text-green-400">"<span x-text="eventData.type"></span>"</span>,</p>
                            <p class="pl-8"><span class="text-amber-300">"start_date"</span>: <span class="text-green-400">"<span x-text="eventData.startDate || 'null'"></span>"</span>,</p>
                            <p class="pl-8"><span class="text-amber-300">"end_date"</span>: <span class="text-green-400">"<span x-text="eventData.endDate || 'null'"></span>"</span>,</p>
                            <p class="pl-8"><span class="text-amber-300">"guests_capacity"</span>: <span class="text-orange-400" x-text="eventData.guests"></span></p>
                            <p class="pl-4"><span class="text-zinc-500">},</span></p>
                            
                            <p class="pl-4"><span class="text-blue-400">"relations"</span>: <span class="text-zinc-500">{</span></p>
                            <p class="pl-8"><span class="text-amber-300">"event_salons"</span>: <span class="text-purple-400" x-text="JSON.stringify(eventData.salons)"></span>,</p>
                            <p class="pl-8"><span class="text-amber-300">"event_services"</span>: <span class="text-purple-400" x-text="JSON.stringify(eventData.services)"></span></p>
                            <p class="pl-4"><span class="text-zinc-500">},</span></p>

                            <p class="pl-4"><span class="text-blue-400">"custom_details"</span>: <span class="text-green-400">"<span x-text="eventData.customDetails.substring(0, 30) + (eventData.customDetails.length > 30 ? '...' : '')"></span>"</span></p>
                            <p><span class="text-zinc-500">}</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 6. MAPA TÁCTICO DE OPERACIONES --}}
    <section class="py-32 px-6 max-w-7xl mx-auto relative map-section border-t border-zinc-200 dark:border-zinc-900 transition-colors duration-500">
        <div class="text-center mb-16 map-header">
            <span class="text-amber-500 font-mono text-xs uppercase tracking-widest flex items-center justify-center gap-2">
                <span class="relative flex h-2 w-2"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span><span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span></span>
                Cobertura y Logística
            </span>
            <h2 class="text-4xl md:text-6xl font-black tracking-tight mt-4 text-zinc-900 dark:text-white">Base de Operaciones</h2>
            <p class="text-zinc-600 dark:text-zinc-400 mt-4 max-w-2xl mx-auto font-light">Estratégicamente ubicados en Bogotá, Colombia, coordinamos el despliegue de tecnología y staff para eventos de alto impacto.</p>
        </div>

        <div class="relative w-full h-[600px] md:h-[700px] rounded-[3rem] overflow-hidden border border-zinc-200 dark:border-zinc-800 shadow-2xl map-container bg-white dark:bg-zinc-900 transition-colors duration-500">
            <div class="absolute inset-0 z-20 pointer-events-none">
                <div class="absolute top-8 left-8 border-l-2 border-t-2 border-amber-500/50 w-16 h-16"></div>
                <div class="absolute top-8 right-8 border-r-2 border-t-2 border-amber-500/50 w-16 h-16"></div>
                <div class="absolute bottom-8 left-8 border-l-2 border-b-2 border-amber-500/50 w-16 h-16"></div>
                <div class="absolute bottom-8 right-8 border-r-2 border-b-2 border-amber-500/50 w-16 h-16"></div>
                
                {{-- Tarjeta UI del Mapa adaptable --}}
                <div class="absolute bottom-12 left-12 bg-white/90 dark:bg-zinc-950/80 backdrop-blur-md border border-zinc-200 dark:border-zinc-800 p-6 rounded-2xl pointer-events-auto hover:border-amber-500/50 transition-colors cursor-pointer map-info-card shadow-xl">
                    <h3 class="text-zinc-900 dark:text-white font-bold text-lg">The Ring HQ</h3>
                    <p class="text-zinc-500 dark:text-zinc-400 text-sm mt-1 font-mono">LAT 4.6097° N | LON 74.0817° W</p>
                    <div class="mt-4 flex items-center gap-2">
                        <div class="h-2 w-2 bg-green-500 rounded-full animate-pulse"></div>
                        <span class="text-xs uppercase tracking-widest text-zinc-600 dark:text-zinc-300">Sistemas en línea</span>
                    </div>
                </div>
            </div>

            <div class="absolute inset-0 z-10 scale-110 map-iframe-wrapper">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127255.10549449488!2d-74.16781292026543!3d4.648283717208886!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f9bfd2da6cb29%3A0x239d635520a33914!2sBogot%C3%A1%2C%20Bogota%2C%20Colombia!5e0!3m2!1sen!2sco!4v1700000000000!5m2!1sen!2sco" class="w-full h-full border-0 pointer-events-auto" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            
            <div class="absolute inset-0 z-15 bg-gradient-to-t from-zinc-50 via-transparent to-zinc-50 dark:from-zinc-950 dark:via-transparent dark:to-zinc-950 pointer-events-none opacity-80 transition-colors duration-500"></div>
        </div>
    </section>



    @include('partials.footer')




    {{-- 7. BOTÓN FLOTANTE DE WHATSAPP --}}
    <div class="fixed bottom-8 right-8 z-50">
        <a href="https://wa.me/573000000000" target="_blank" rel="noopener noreferrer" class="group flex items-center gap-3">
            <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 text-zinc-900 dark:text-white text-sm font-bold py-2 px-4 rounded-xl opacity-0 group-hover:opacity-100 transform translate-x-4 group-hover:translate-x-0 transition-all duration-300 shadow-xl backdrop-blur-md">
                Agenda tu Demo
            </div>
            <div class="w-16 h-16 bg-green-500 hover:bg-green-400 rounded-full flex items-center justify-center shadow-[0_0_20px_rgba(34,197,94,0.4)] hover:scale-110 transition-all duration-300 relative cursor-pointer">
                <div class="absolute inset-0 rounded-full border border-green-400 animate-ping opacity-75"></div>
                <svg class="w-8 h-8 text-white relative z-10" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.098.824z"/></svg>
            </div>
        </a>
    </div>

    {{-- SCRIPTS PRINCIPALES DE ANIMACIÓN GSAP --}}
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            gsap.registerPlugin(ScrollTrigger);

            // 1. Hero Cinematic Reveal
            const heroTl = gsap.timeline();
            heroTl.to(".hero-media", { scale: 1, duration: 2.5, ease: "power4.out" })
                  .to(".hero-title-part", { y: 0, stagger: 0.15, duration: 1.2, ease: "power4.out" }, "-=2")
                  .to(".scroll-indicator", { opacity: 1, y: 10, duration: 1, repeat: -1, yoyo: true, ease: "sine.inOut" }, "-=0.5");

            gsap.to(".hero-bg-container", {
                scrollTrigger: { trigger: ".hero-section", start: "top top", end: "bottom top", scrub: 1 },
                y: 150, opacity: 0
            });

            // 2. Corporate Bento Box Reveal
            gsap.from(".corporate-header", {
                scrollTrigger: { trigger: ".corporate-section", start: "top 80%", end: "top 50%", scrub: 1 },
                y: 50, opacity: 0
            });
            gsap.from(".reveal-box", {
                scrollTrigger: { trigger: ".corporate-section", start: "top 70%", end: "top 30%", scrub: 1 },
                y: 80, opacity: 0, scale: 0.95, stagger: 0.2
            });

            // 3. Horizontal Scroll Magic
            const horizontalScroll = document.querySelector('.horizontal-wrapper');
            const panels = gsap.utils.toArray('.panel');

            gsap.to(panels, {
                xPercent: -100 * (panels.length - 1), 
                ease: "none",
                scrollTrigger: {
                    trigger: ".horizontal-scroll-container", pin: true, scrub: 1, 
                    snap: 1 / (panels.length - 1), end: () => "+=" + horizontalScroll.offsetWidth 
                }
            });

            gsap.utils.toArray('.reveal-img-container').forEach(container => {
                let img = container.querySelector('img');
                gsap.set(container, { clipPath: "inset(20% 20% 20% 20% round 30px)" });
                gsap.set(img, { scale: 1.4 });
                gsap.to(container, {
                    clipPath: "inset(0% 0% 0% 0% round 32px)",
                    scrollTrigger: { trigger: container, containerAnimation: gsap.getById(horizontalScroll), start: "left center", end: "right center", scrub: 1 }
                });
                gsap.to(img, {
                    scale: 1, scrollTrigger: { trigger: container, containerAnimation: gsap.getById(horizontalScroll), start: "left center", end: "right center", scrub: 1 }
                });
            });

            // 4. Form Interactive Engine Reveal
            gsap.from(".builder-header", { scrollTrigger: { trigger: ".builder-section", start: "top 80%", end: "top 50%", scrub: 1 }, y: 100, opacity: 0 });
            gsap.from(".form-interactive-container", {
                scrollTrigger: { trigger: ".form-interactive-container", start: "top 90%", end: "top 40%", scrub: 1.5 },
                y: 100, scale: 0.95, opacity: 0, transformOrigin: "bottom center"
            });

            // 5. Tactical Map Animations
            gsap.from(".map-header", { scrollTrigger: { trigger: ".map-section", start: "top 80%", end: "top 50%", scrub: 1 }, y: 60, opacity: 0 });
            gsap.fromTo(".map-container", 
                { clipPath: "inset(40% 40% 40% 40% round 100px)", opacity: 0 },
                { clipPath: "inset(0% 0% 0% 0% round 48px)", opacity: 1, scrollTrigger: { trigger: ".map-section", start: "top 75%", end: "top 25%", scrub: 1.2 } }
            );
            gsap.from(".map-iframe-wrapper", { scrollTrigger: { trigger: ".map-section", start: "top 90%", end: "bottom top", scrub: true }, scale: 1.3, rotation: 1 });
            gsap.from(".map-info-card", { scrollTrigger: { trigger: ".map-container", start: "top 50%", end: "top 30%", scrub: 1 }, x: -50, opacity: 0, backdropFilter: "blur(0px)" });
            gsap.from(".footer-content > div", {
    scrollTrigger: {
        trigger: ".footer-section",
        start: "top 90%",
        end: "top 60%",
        scrub: 1
    },
    y: 50,
    opacity: 0,
    stagger: 0.1
});
        });
    </script>
</body>
</html>