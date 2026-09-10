<!DOCTYPE html>
<html lang="es" x-data="{ theme: localStorage.getItem('theme') || 'dark', toggleTheme() { this.theme = this.theme === 'dark' ? 'light' : 'dark'; localStorage.setItem('theme', this.theme); } }" :class="theme">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos The Ring</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-zinc-50 dark:bg-zinc-950 text-zinc-900 dark:text-zinc-100 font-sans antialiased overflow-x-hidden selection:bg-amber-500 selection:text-black transition-colors duration-500 relative">






    <nav x-data="{ 
        scrolled: false, 
        mobileMenuOpen: false 
    }"
        @scroll.window="scrolled = (window.pageYOffset > 50)"
        :class="{ 
        'bg-white/70 dark:bg-zinc-950/70 backdrop-blur-2xl border-b border-zinc-200 dark:border-zinc-800/80 shadow-lg': scrolled,
        'bg-transparent border-b border-transparent': !scrolled 
    }"
        class="fixed top-0 left-0 w-full z-[100] transition-all duration-500">

        <div class="max-w-[90rem] mx-auto px-6 md:px-12">
            <div class="flex items-center justify-between h-24" :class="scrolled ? 'h-20' : 'h-24'" style="transition: height 0.5s ease;">

                {{-- LOGOTIPO --}}
                <div class="flex-shrink-0">
                    <a href="/" class="flex items-center gap-2 group">
                        <div class="w-8 h-8 rounded-lg   flex items-center justify-center transition-transform group-hover:rotate-12">
                            <img width=50 height=50 src="favicon.ico" alt="The Ring">
                        </div>
                        <span class="text-2xl font-black tracking-tighter uppercase text-zinc-900 dark:text-white">
                            Eventos <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-amber-600"> The Ring</span>
                        </span>
                    </a>
                </div>

                {{-- MENÚ DE ESCRITORIO --}}
                <div class="hidden lg:flex items-center space-x-10">
                    <a href="/salones" class="text-sm font-bold tracking-widest uppercase text-zinc-600 dark:text-zinc-300 hover:text-amber-500 dark:hover:text-amber-500 transition-colors">Salones</a>
                    <a href="/servicios" class="text-sm font-bold tracking-widest uppercase text-zinc-600 dark:text-zinc-300 hover:text-amber-500 dark:hover:text-amber-500 transition-colors">Servicios</a>
                    <a href="#experiencia" class="text-sm font-bold tracking-widest uppercase text-zinc-600 dark:text-zinc-300 hover:text-amber-500 dark:hover:text-amber-500 transition-colors">Experiencia</a>
                    <a href="#reservas" class="text-sm font-bold tracking-widest uppercase text-zinc-600 dark:text-zinc-300 hover:text-amber-500 dark:hover:text-amber-500 transition-colors">Reservas</a>
                </div>

                {{-- BOTONES Y ACCIONES DE ESCRITORIO --}}
                <div class="hidden lg:flex items-center space-x-6">

                    {{-- Toggle de Tema (Claro/Oscuro) integrado en el Navbar --}}
                    <button @click="toggleTheme()" class="p-2 rounded-full hover:bg-zinc-200 dark:hover:bg-zinc-800 transition-colors text-zinc-600 dark:text-zinc-400">
                        <svg x-show="theme === 'dark'" class="w-5 h-5 hover:text-amber-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <svg x-cloak x-show="theme === 'light'" class="w-5 h-5 hover:text-amber-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                    </button>

                    {{-- Botón de acceso al Dashboard Filament --}}
                    <a href="/admin" class="relative group px-6 py-2.5 rounded-full overflow-hidden bg-zinc-900 dark:bg-white text-white dark:text-zinc-900 font-bold tracking-widest text-xs uppercase transition-all hover:scale-105">
                        <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-amber-500 to-orange-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                        <span class="relative flex items-center gap-2">
                            Panel Cliente
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </span>
                    </a>
                </div>

                {{-- BOTÓN HAMBURGUESA (MÓVIL) --}}
                <div class="lg:hidden flex items-center gap-4">
                    {{-- Botón tema móvil --}}
                    <button @click="toggleTheme()" class="p-2 text-zinc-600 dark:text-zinc-400">
                        <svg x-show="theme === 'dark'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        <svg x-cloak x-show="theme === 'light'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                        </svg>
                    </button>

                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-zinc-900 dark:text-white focus:outline-none z-[110] relative">
                        {{-- Icono Menú / Cerrar Animado --}}
                        <div class="w-6 h-5 flex flex-col justify-between relative">
                            <span class="w-full h-0.5 bg-current transition-all duration-300" :class="mobileMenuOpen ? 'rotate-45 translate-y-2.5' : ''"></span>
                            <span class="w-full h-0.5 bg-current transition-all duration-300" :class="mobileMenuOpen ? 'opacity-0' : ''"></span>
                            <span class="w-full h-0.5 bg-current transition-all duration-300" :class="mobileMenuOpen ? '-rotate-45 -translate-y-2' : ''"></span>
                        </div>
                    </button>
                </div>
            </div>
        </div>

        {{-- MENÚ MÓVIL DESPLEGABLE (FULL SCREEN GLASS) --}}
        <div x-cloak
            x-show="mobileMenuOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-10"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-10"
            class="lg:hidden fixed inset-0 z-[90] bg-white/90 dark:bg-zinc-950/90 backdrop-blur-3xl h-screen flex flex-col justify-center px-6">

            <div class="flex flex-col space-y-8 items-center text-center">
                <a href="/salones" @click="mobileMenuOpen = false" class="text-3xl font-black uppercase text-zinc-900 dark:text-white hover:text-amber-500 transition-colors">Salones</a>
                <a href="/servicios" @click="mobileMenuOpen = false" class="text-3xl font-black uppercase text-zinc-900 dark:text-white hover:text-amber-500 transition-colors">Servicios</a>
                <a href="#experiencia" @click="mobileMenuOpen = false" class="text-3xl font-black uppercase text-zinc-900 dark:text-white hover:text-amber-500 transition-colors">Experiencia</a>
                <a href="#reservas" @click="mobileMenuOpen = false" class="text-3xl font-black uppercase text-zinc-900 dark:text-white hover:text-amber-500 transition-colors">Reservas</a>

                <div class="pt-8 w-full border-t border-zinc-200 dark:border-zinc-800">
                    <a href="/admin" class="block w-full py-4 bg-zinc-900 dark:bg-white text-white dark:text-zinc-900 font-bold uppercase tracking-widest rounded-2xl">
                        Panel Cliente
                    </a>
                </div>
            </div>
        </div>
    </nav>