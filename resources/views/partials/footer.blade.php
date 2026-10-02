{{-- resources/views/partials/footer.blade.php --}}
<footer class="bg-zinc-50 dark:bg-zinc-950 border-t border-zinc-200 dark:border-zinc-900 pt-20 pb-10 transition-colors duration-500 relative z-10 footer-section">
    <div class="max-w-[90rem] mx-auto px-6 md:px-12">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-12 lg:gap-8 mb-16 footer-content">

            {{-- COLUMNA 1: Branding y Descripción --}}
            <div class="lg:col-span-4 space-y-6">
                <a href="/" class="flex items-center gap-2 group inline-flex">
                    <div class="w-8 h-8 rounded-lg bg-zinc-900  flex items-center justify-center transition-transform group-hover:rotate-12">
                        <img width=50 height=50 src="favicon.ico" alt="The Ring">
                    </div>
                    <span class="text-2xl font-black tracking-tighter uppercase text-zinc-900 dark:text-white">
                        Eventos <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-amber-600">The Ring</span>
                    </span>
                </a>
                <p class="text-zinc-500 dark:text-zinc-400 font-light max-w-sm transition-colors">
                    En tus sueños cada detalle cuenta
                </p>
            </div>

            {{-- COLUMNA 2: Enlaces Rápidos --}}
            <div class="lg:col-span-2">
                <h4 class="text-zinc-900 dark:text-white font-bold uppercase tracking-widest text-sm mb-6 transition-colors">Explorar</h4>
                <ul class="space-y-4">
                    <li><a href="/salones" class="text-zinc-500 dark:text-zinc-400 hover:text-amber-500 dark:hover:text-amber-500 transition-colors text-sm">Salones Inteligentes</a></li>
                    
                    
                    <li><a href="/reservas" class="text-zinc-500 dark:text-zinc-400 hover:text-amber-500 dark:hover:text-amber-500 transition-colors text-sm">Motor de Reservas</a></li>
                </ul>
            </div>

            {{-- COLUMNA 3: Soporte --}}
            <div class="lg:col-span-2">
                <h4 class="text-zinc-900 dark:text-white font-bold uppercase tracking-widest text-sm mb-6 transition-colors">Soporte</h4>
                <ul class="space-y-4">
                    <li><a href="#" class="text-zinc-500 dark:text-zinc-400 hover:text-amber-500 dark:hover:text-amber-500 transition-colors text-sm">Centro de Ayuda</a></li>
                    <li><a href="#" class="text-zinc-500 dark:text-zinc-400 hover:text-amber-500 dark:hover:text-amber-500 transition-colors text-sm">Términos de Servicio</a></li>
                    <li><a href="#" class="text-zinc-500 dark:text-zinc-400 hover:text-amber-500 dark:hover:text-amber-500 transition-colors text-sm">Privacidad</a></li>
                </ul>
            </div>

            {{-- COLUMNA 4: Newsletter Interactivo --}}
            <div class="lg:col-span-4">
                <h4 class="text-zinc-900 dark:text-white font-bold uppercase tracking-widest text-sm mb-6 transition-colors">Acceso Exclusivo</h4>
                <p class="text-zinc-500 dark:text-zinc-400 font-light text-sm mb-4 transition-colors">
                    Suscríbete para recibir actualizaciones sobre nuevas capacidades del sistema y tendencias de producción.
                </p>
                <form @submit.prevent="alert('¡Gracias por suscribirte!')" class="relative flex items-center mt-2 group">
                    <input type="email" placeholder="eventosthering@gmail.com" required class="w-full bg-zinc-200/50 dark:bg-zinc-900/50 border border-zinc-300 dark:border-zinc-800 rounded-full px-6 py-3.5 text-zinc-900 dark:text-white focus:outline-none focus:border-amber-500 transition-colors text-sm placeholder-zinc-500 dark:placeholder-zinc-600">
                    <button type="submit" class="absolute right-1.5 p-2 bg-amber-500 text-zinc-950 rounded-full hover:scale-105 transition-transform shadow-md group-focus-within:bg-amber-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>

        {{-- BOTTOM FOOTER: Copyright y Redes Sociales --}}
        <div class="pt-8 border-t border-zinc-200 dark:border-zinc-900 flex flex-col md:flex-row justify-between items-center gap-6 transition-colors">

            {{-- Año Automático con Alpine.js --}}
            <p class="text-zinc-500 dark:text-zinc-500 text-sm font-light">
                &copy; <span x-text="new Date().getFullYear()"></span> Eventos The Ring. Todos los derechos reservados.
            </p>

            <div class="flex items-center space-x-6">
                <a href="https://www.instagram.com/eventosthering/" class="text-zinc-400 hover:text-pink-500 transition-colors transform hover:scale-110">
                    <span class="sr-only">Instagram</span>
                    <x-fab-instagram class="w-6 h-6" />
                </a>
                <a href="https://www.facebook.com/theringEventos" class="text-zinc-400 hover:text-blue-500 transition-colors transform hover:scale-110">
                    <span class="sr-only">Facebook</span>
                    <x-fab-facebook class="w-6 h-6" />
                </a>
                <a href="https://www.tiktok.com/@eventosthering02" class="text-zinc-400 hover:text-black dark:hover:text-white transition-colors transform hover:scale-110">
                    <span class="sr-only">TikTok</span>
                    <x-fab-tiktok class="w-6 h-6" />
                </a>
                
                <a href="https://www.youtube.com/@EventosTheRing" class="text-zinc-400 hover:text-red-500 transition-colors transform hover:scale-110">
                    <span class="sr-only">YouTube</span>
                    <x-fab-youtube class="w-6 h-6" />
                </a>
            </div>
        </div>
    </div>
</footer>


<div class="fixed bottom-8 right-8 z-50 flex flex-row-reverse items-center gap-3 pointer-events-none">

    <a href="https://wa.me/+573015717859" target="_blank" rel="noopener noreferrer" class="peer pointer-events-auto w-16 h-16 bg-green-500 hover:bg-green-400 rounded-full flex items-center justify-center shadow-[0_0_20px_rgba(34,197,94,0.4)] hover:scale-110 transition-all duration-300 relative cursor-pointer">
        <div class="absolute inset-0 rounded-full border border-green-400 animate-ping opacity-75"></div>
        <x-fab-whatsapp class="w-8 h-8 text-white relative z-10" />
    </a>

    <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 text-zinc-900 dark:text-white text-sm font-bold py-2 px-4 rounded-xl opacity-0 transform translate-x-4 peer-hover:opacity-100 peer-hover:translate-x-0 transition-all duration-300 shadow-xl backdrop-blur-md">
        Agenda tu evento
    </div>
</div>
</body>

</html>