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
                    El motor definitivo para la creación, gestión y ejecución de eventos de alto calibre. Diseño absoluto, control total.
                </p>
            </div>

            {{-- COLUMNA 2: Enlaces Rápidos --}}
            <div class="lg:col-span-2">
                <h4 class="text-zinc-900 dark:text-white font-bold uppercase tracking-widest text-sm mb-6 transition-colors">Explorar</h4>
                <ul class="space-y-4">
                    <li><a href="#salones" class="text-zinc-500 dark:text-zinc-400 hover:text-amber-500 dark:hover:text-amber-500 transition-colors text-sm">Salones Inteligentes</a></li>
                    <li><a href="#staff" class="text-zinc-500 dark:text-zinc-400 hover:text-amber-500 dark:hover:text-amber-500 transition-colors text-sm">Staff y Operaciones</a></li>
                    <li><a href="#inventario" class="text-zinc-500 dark:text-zinc-400 hover:text-amber-500 dark:hover:text-amber-500 transition-colors text-sm">Inventario Técnico</a></li>
                    <li><a href="#reservas" class="text-zinc-500 dark:text-zinc-400 hover:text-amber-500 dark:hover:text-amber-500 transition-colors text-sm">Motor de Reservas</a></li>
                </ul>
            </div>

            {{-- COLUMNA 3: Soporte --}}
            <div class="lg:col-span-2">
                <h4 class="text-zinc-900 dark:text-white font-bold uppercase tracking-widest text-sm mb-6 transition-colors">Soporte</h4>
                <ul class="space-y-4">
                    <li><a href="#" class="text-zinc-500 dark:text-zinc-400 hover:text-amber-500 dark:hover:text-amber-500 transition-colors text-sm">Centro de Ayuda</a></li>
                    <li><a href="#" class="text-zinc-500 dark:text-zinc-400 hover:text-amber-500 dark:hover:text-amber-500 transition-colors text-sm">Documentación API</a></li>
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
                    <input type="email" placeholder="tu@correo.com" required class="w-full bg-zinc-200/50 dark:bg-zinc-900/50 border border-zinc-300 dark:border-zinc-800 rounded-full px-6 py-3.5 text-zinc-900 dark:text-white focus:outline-none focus:border-amber-500 transition-colors text-sm placeholder-zinc-500 dark:placeholder-zinc-600">
                    <button type="submit" class="absolute right-1.5 p-2 bg-amber-500 text-zinc-950 rounded-full hover:scale-105 transition-transform shadow-md group-focus-within:bg-amber-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </form>
            </div>
        </div>

        {{-- BOTTOM FOOTER: Copyright y Redes Sociales --}}
        <div class="pt-8 border-t border-zinc-200 dark:border-zinc-900 flex flex-col md:flex-row justify-between items-center gap-6 transition-colors">
            
            {{-- Año Automático con Alpine.js --}}
            <p class="text-zinc-500 dark:text-zinc-500 text-sm font-light">
                &copy; <span x-text="new Date().getFullYear()"></span> The Ring Ecosystem. Todos los derechos reservados.
            </p>
            
            <div class="flex items-center space-x-6">
                {{-- Iconos SVG de Redes Sociales --}}
                <a href="#" class="text-zinc-400 hover:text-amber-500 transition-colors transform hover:scale-110">
                    <span class="sr-only">Instagram</span>
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" /></svg>
                </a>
                <a href="#" class="text-zinc-400 hover:text-amber-500 transition-colors transform hover:scale-110">
                    <span class="sr-only">LinkedIn</span>
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" clip-rule="evenodd" /></svg>
                </a>
            </div>
        </div>
    </div>
</footer>







    {{-- 7. WHATSAPP --}}
    <div class="fixed bottom-8 right-8 z-50"><a href="https://wa.me/+573015717859" target="_blank" rel="noopener noreferrer" class="group flex items-center gap-3">
            <div class="bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 text-zinc-900 dark:text-white text-sm font-bold py-2 px-4 rounded-xl opacity-0 group-hover:opacity-100 transform translate-x-4 group-hover:translate-x-0 transition-all duration-300 shadow-xl backdrop-blur-md">Agenda tu Demo</div>
            <div class="w-16 h-16 bg-green-500 hover:bg-green-400 rounded-full flex items-center justify-center shadow-[0_0_20px_rgba(34,197,94,0.4)] hover:scale-110 transition-all duration-300 relative cursor-pointer">
                <div class="absolute inset-0 rounded-full border border-green-400 animate-ping opacity-75"></div><svg class="w-8 h-8 text-white relative z-10" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.098.824z" />
                </svg>
            </div>
        </a></div>
</body>

</html>