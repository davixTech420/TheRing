@php
    $event = $this->activeEvent;
    $totalEvents = $this->totalEvents;
    $user = auth()->user();

    $etapa = 1;
    if ($event) {
        if ($event->status === 'confirmed') {
            $etapa = 4;
        } elseif ($event->staff()->count() > 0) {
            $etapa = 3;
        } elseif ($event->salons()->count() > 0) {
            $etapa = 2;
        }
    }

    $daysLeft = null;
    if ($event && $event->start_date) {
        $daysLeft = max(0, (int) now()->diffInDays(\Carbon\Carbon::parse($event->start_date), false));
    }
@endphp

<div class="rounded-3xl bg-gradient-to-br from-zinc-900 via-zinc-900 to-zinc-950 border border-white/10 p-6 md:p-10 shadow-2xl relative overflow-hidden text-white">
    
    {{-- Glow background --}}
    <div class="absolute -top-24 -right-24 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>

    {{-- GREETING & HEADER --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 pb-8 border-b border-white/10 relative z-10">
        <div>
            <span class="text-amber-500 font-mono text-[10px] md:text-xs uppercase tracking-[0.4em] font-bold block mb-2">Panel del Anfitrión // The Ring VIP</span>
            <h1 class="text-3xl md:text-5xl font-black tracking-tight text-white">
                ¡Hola, <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-amber-600">{{ $user->name }}</span>!
            </h1>
            <p class="text-zinc-400 text-sm mt-1 font-light">
                Bienvenido al centro de control de tu celebración. Aquí puedes supervisar cada detalle de tu evento en tiempo real.
            </p>
        </div>

        <div class="flex items-center gap-3">
            <a href="/reservas" class="px-6 py-3 bg-amber-500 hover:bg-amber-600 text-black font-black text-xs uppercase tracking-widest rounded-2xl transition-all shadow-lg shadow-amber-500/20 hover:scale-105 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Nueva Cotización
            </a>
        </div>
    </div>

    @if($event)
        {{-- PROGRESO DEL EVENTO ACTIVO --}}
        <div class="mt-8 relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 mb-6">
                <div>
                    <div class="flex items-center gap-3">
                        <span class="px-3 py-1 bg-amber-500/20 text-amber-400 border border-amber-500/30 text-[10px] font-bold uppercase tracking-widest rounded-full">
                            {{ $event->event_type }}
                        </span>
                        @if($daysLeft !== null)
                            <span class="text-xs text-zinc-400 font-mono">
                                ⏳ Faltan <strong class="text-white">{{ $daysLeft }} días</strong> para tu evento
                            </span>
                        @endif
                    </div>
                    <h2 class="text-2xl md:text-4xl font-black text-white mt-2">{{ $event->name }}</h2>
                    <p class="text-zinc-400 text-xs md:text-sm mt-1">
                        Fecha: <strong class="text-white">{{ \Carbon\Carbon::parse($event->start_date)->format('d \d\e F, Y - h:i A') }}</strong>
                        @if($event->salons->isNotEmpty())
                            • Locación: <strong class="text-amber-400">{{ $event->salons->pluck('name')->join(', ') }}</strong>
                        @endif
                    </p>
                </div>

                <div class="text-right">
                    <span class="text-[10px] font-mono text-zinc-500 uppercase tracking-widest block mb-1">Estado Oficial</span>
                    <span class="px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-widest {{ $event->status === 'confirmed' ? 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/40' : 'bg-amber-500/20 text-amber-400 border border-amber-500/40' }}">
                        {{ $event->status === 'confirmed' ? '✅ Confirmado' : '⏳ En Revisión y Logística' }}
                    </span>
                </div>
            </div>

            {{-- STEPPER DE PROCESO (4 ETAPAS) --}}
            <div class="bg-zinc-950/70 border border-white/5 rounded-2xl p-6 md:p-8 mb-8">
                <span class="text-[10px] font-mono uppercase tracking-[0.3em] text-zinc-500 font-bold block mb-6">Línea de Tiempo del Evento</span>
                
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 relative">
                    
                    {{-- Etapa 1 --}}
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 font-black text-xs {{ $etapa >= 1 ? 'bg-amber-500 text-black shadow-[0_0_15px_rgba(245,158,11,0.5)]' : 'bg-zinc-800 text-zinc-500' }}">
                            01
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-white">Solicitud Recibida</h4>
                            <p class="text-[11px] text-zinc-400 mt-0.5">Diseño inicial y requerimientos guardados en plataforma.</p>
                        </div>
                    </div>

                    {{-- Etapa 2 --}}
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 font-black text-xs {{ $etapa >= 2 ? 'bg-amber-500 text-black shadow-[0_0_15px_rgba(245,158,11,0.5)]' : 'bg-zinc-800 text-zinc-500' }}">
                            02
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-white">Locación & Menú</h4>
                            <p class="text-[11px] text-zinc-400 mt-0.5">Salón bloqueado y propuesta gastronómica asignada.</p>
                        </div>
                    </div>

                    {{-- Etapa 3 --}}
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 font-black text-xs {{ $etapa >= 3 ? 'bg-amber-500 text-black shadow-[0_0_15px_rgba(245,158,11,0.5)]' : 'bg-zinc-800 text-zinc-500' }}">
                            03
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-white">Staff Convocado</h4>
                            <p class="text-[11px] text-zinc-400 mt-0.5">
                                @if($event->staff->isNotEmpty())
                                    {{ $event->staff->count() }} especialistas asignados y confirmando asistencia.
                                @else
                                    Coordinación asignando el equipo técnico.
                                @endif
                            </p>
                        </div>
                    </div>

                    {{-- Etapa 4 --}}
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0 font-black text-xs {{ $etapa >= 4 ? 'bg-emerald-500 text-white shadow-[0_0_15px_rgba(16,185,129,0.5)]' : 'bg-zinc-800 text-zinc-500' }}">
                            04
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-white">¡Listo para Brillar!</h4>
                            <p class="text-[11px] text-zinc-400 mt-0.5">Confirmación definitiva, todo preparado para el gran día.</p>
                        </div>
                    </div>

                </div>
            </div>

            {{-- SUMMARY GRID CARDS --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-zinc-800/40 border border-white/5 rounded-2xl p-5">
                    <span class="text-[10px] font-mono text-zinc-500 uppercase tracking-widest block mb-1">Aforo Total</span>
                    <span class="text-2xl font-black text-white">{{ $event->guest_count }} <span class="text-xs text-zinc-400 font-normal">invitados</span></span>
                </div>
                <div class="bg-zinc-800/40 border border-white/5 rounded-2xl p-5">
                    <span class="text-[10px] font-mono text-zinc-500 uppercase tracking-widest block mb-1">Salón</span>
                    <span class="text-lg font-black text-amber-400 truncate block">{{ $event->salons->first()?->name ?? 'Por Confirmar' }}</span>
                </div>
                <div class="bg-zinc-800/40 border border-white/5 rounded-2xl p-5">
                    <span class="text-[10px] font-mono text-zinc-500 uppercase tracking-widest block mb-1">Staff Activo</span>
                    <span class="text-2xl font-black text-white">{{ $event->staff->count() }} <span class="text-xs text-zinc-400 font-normal">profesionales</span></span>
                </div>
                <div class="bg-zinc-800/40 border border-white/5 rounded-2xl p-5 flex flex-col justify-between">
                    <span class="text-[10px] font-mono text-zinc-500 uppercase tracking-widest block mb-1">Atención VIP</span>
                    <a href="https://wa.me/573000000000?text={{ urlencode('Hola The Ring Concierge, tengo una consulta sobre mi evento: ' . $event->name) }}" target="_blank" class="text-xs font-bold text-emerald-400 hover:text-emerald-300 flex items-center gap-1.5 transition-colors">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.007c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.275.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.043.073.043.419-.101.824z"/></svg>
                        Hablar con Concierge
                    </a>
                </div>
            </div>
        </div>
    @else
        {{-- EMPTY STATE SI NO TIENE EVENTOS --}}
        <div class="mt-12 text-center max-w-xl mx-auto py-10">
            <div class="w-16 h-16 rounded-full bg-amber-500/10 border border-amber-500/30 flex items-center justify-center text-amber-500 mx-auto mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            </div>
            <h3 class="text-2xl font-bold text-white mb-2">Aún no tienes cotizaciones activas</h3>
            <p class="text-zinc-400 text-sm mb-6">
                Comienza a dar vida a tu próximo evento. Nuestro diseñador visual te permite seleccionar locación, mobiliario, banquete y efectos.
            </p>
            <a href="/reservas" class="inline-block px-8 py-4 bg-gradient-to-r from-amber-500 to-amber-600 text-black font-black uppercase text-xs tracking-widest rounded-2xl shadow-xl hover:scale-105 transition-transform">
                Comenzar a Diseñar mi Evento
            </a>
        </div>
    @endif
</div>

