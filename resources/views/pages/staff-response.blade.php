<!DOCTYPE html>
<html lang="es" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} — The Ring</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-zinc-950 text-white min-h-screen flex items-center justify-center p-6 font-sans relative overflow-hidden">
    {{-- Background Glow --}}
    <div class="absolute w-[500px] h-[500px] {{ $status === 'confirmed' ? 'bg-emerald-500/10' : ($status === 'declined' ? 'bg-rose-500/10' : 'bg-amber-500/10') }} rounded-full blur-[120px] pointer-events-none -top-20 -left-20"></div>

    <div class="relative z-10 max-w-lg w-full bg-zinc-900/90 border border-zinc-800 backdrop-blur-2xl p-8 md:p-12 rounded-[2.5rem] shadow-2xl text-center">
        
        {{-- Icon --}}
        @if($status === 'confirmed')
            <div class="w-20 h-20 mx-auto rounded-full bg-emerald-500/20 border-2 border-emerald-500 flex items-center justify-center text-emerald-400 mb-6 shadow-[0_0_30px_rgba(16,185,129,0.3)] animate-pulse">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
            </div>
        @elseif($status === 'declined')
            <div class="w-20 h-20 mx-auto rounded-full bg-rose-500/20 border-2 border-rose-500 flex items-center justify-center text-rose-400 mb-6 shadow-[0_0_30px_rgba(244,63,94,0.3)]">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
            </div>
        @else
            <div class="w-20 h-20 mx-auto rounded-full bg-amber-500/20 border-2 border-amber-500 flex items-center justify-center text-amber-400 mb-6">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            </div>
        @endif

        <span class="text-[10px] font-mono uppercase tracking-[0.4em] text-amber-500 font-bold block mb-2">The Ring // Logística</span>
        <h1 class="text-3xl md:text-4xl font-black uppercase tracking-tight text-white mb-4">{{ $title }}</h1>
        <p class="text-zinc-400 text-sm md:text-base font-light leading-relaxed mb-8">{{ $message }}</p>

        @if(isset($event) && isset($staff))
            <div class="bg-zinc-800/60 border border-white/5 rounded-2xl p-6 text-left space-y-3 mb-8 font-mono text-xs">
                <div class="flex justify-between text-zinc-400">
                    <span>Evento:</span>
                    <span class="text-white font-bold">{{ $event->name }}</span>
                </div>
                <div class="flex justify-between text-zinc-400">
                    <span>Fecha:</span>
                    <span class="text-amber-400">{{ \Carbon\Carbon::parse($event->start_date)->format('d/m/Y - h:i A') }}</span>
                </div>
                <div class="flex justify-between text-zinc-400">
                    <span>Rol Asignado:</span>
                    <span class="text-white">{{ $staff->role }}</span>
                </div>
                <div class="flex justify-between text-zinc-400">
                    <span>Estado en Sistema:</span>
                    <span class="{{ $status === 'confirmed' ? 'text-emerald-400 font-bold' : 'text-rose-400 font-bold' }}">
                        {{ $status === 'confirmed' ? 'CONFIRMADO' : 'DECLINADO' }}
                    </span>
                </div>
            </div>
        @endif

        <a href="/" class="inline-block px-8 py-3.5 bg-zinc-800 hover:bg-zinc-700 text-zinc-300 font-bold rounded-full text-xs uppercase tracking-widest transition-colors">
            Volver a The Ring
        </a>
    </div>
</body>
</html>

