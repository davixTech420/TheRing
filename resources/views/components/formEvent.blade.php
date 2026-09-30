<!-- {{-- ==========================================
     MOTOR DE COTIZACIÓN VIP "EVENT CANVAS"
     Diseño Ultra-Moderno / Bento Grid / Glassmorphism
=========================================== --}}
<style>
    /* Efectos de fondo y scrollbar para dar look premium */
    .bg-grid-pattern { background-image: radial-gradient(rgba(0, 0, 0, 0.05) 1px, transparent 1px); background-size: 30px 30px; }
    .dark .bg-grid-pattern { background-image: radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px); }
    
    .glass-panel { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(16px); border: 1px solid rgba(0, 0, 0, 0.05); box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05); }
    .dark .glass-panel { background: rgba(24, 24, 27, 0.65); border: 1px solid rgba(255, 255, 255, 0.08); box-shadow: 0 4px 30px rgba(0, 0, 0, 0.5); }
    
    .custom-scroll::-webkit-scrollbar { width: 6px; }
    .custom-scroll::-webkit-scrollbar-track { background: transparent; }
    .custom-scroll::-webkit-scrollbar-thumb { background: rgba(245, 158, 11, 0.5); border-radius: 10px; }
    
    .toggle-checkbox:checked + .toggle-label { background-color: #f59e0b; border-color: #f59e0b; }
    .toggle-checkbox:checked + .toggle-label div { transform: translateX(100%); }
</style>

<section class="min-h-screen bg-zinc-50 dark:bg-zinc-950 text-zinc-900 dark:text-white font-sans relative overflow-hidden flex flex-col bg-grid-pattern transition-colors duration-500"
    x-data="{
        step: 1,
        activeModal: null, modalTitle: '', activeCatalog: [], targetCategory: '', targetProp: '',
        
        // ==========================================
        // 1. ESTADO DEL EVENTO (Lo que se guarda en BD)
        // ==========================================
        event: {
            // Básicos
            type: 'Boda', clientName: '', phone: '', date: '', guests: 100, salon: null,
            // Texto / Selects
            food: '', carpet: '', gifts: '', invitations: '', reminders: '',
            // Elementos visuales (IDs u Objetos de BD)
            theme: null, chair: null, dress: null, backing: null, illumName: null, centerpiece: null,
            photo: null, video: null, portrait: null,
        },

        // ==========================================
        // 2. SWITCHES (Sí/No) DE LA INTERFAZ
        // ==========================================
        wants: {
            theme: false,
            // Medios
            photo: false, video: false, portrait: false, beam: false,
            // Decoración
            deco: false, backing: false, illumName: false, ceiling: false, 
            centerpieces: false, cylinders: false, pedestals: false,
            // Rituals / Extras
            guestbook: false, roses: false, decoratedGlasses: false, quinceanero: false, dress: false,
            reminders: false, invitations: false
        },

        // ==========================================
        // 3. CATÁLOGOS SIMULADOS DE TU BD (Tabla 'services')
        // ==========================================
        catalogs: {
            salons: [ { id: 's1', name: 'Gran Salón Imperial', desc: 'Capacidad 500 pax', img: 'https://images.unsplash.com/photo-1519167758481-83f550bb49b3?q=80&w=400' } ],
            themes: [ { id: 't1', name: 'Noche Estrellada', desc: 'Azul profundo y dorados', img: 'https://images.unsplash.com/photo-1512144804683-167817b1897e?q=80&w=400' }, { id: 't2', name: 'Gatsby', desc: 'Años 20, plumas y negro', img: 'https://images.unsplash.com/photo-1566737236500-c8ac43014a67?q=80&w=400' } ],
            chairs: [ { id: 'c1', name: 'Silla Trono', img: 'https://images.unsplash.com/photo-1505236858219-8359eb29e329?q=80&w=400' }, { id: 'c2', name: 'Isabelina', img: 'https://images.unsplash.com/photo-1532453288672-3a27e9be9efd?q=80&w=400' }, { id: 'c3', name: 'Columpio Floral', img: 'https://images.unsplash.com/photo-1517457373958-b7bdd4587205?q=80&w=400' }, { id: 'c4', name: 'Diván', img: 'https://images.unsplash.com/photo-1568822602701-a67bba8ba551?q=80&w=400' }, { id: 'c5', name: 'Tiffany', img: 'https://images.unsplash.com/photo-1505236858219-8359eb29e329?q=80&w=400' } ],
            dresses: [ { id: 'custom', name: 'Diseño Personalizado', desc: 'Confección a medida, color a elección', img: 'https://images.unsplash.com/photo-1595777457583-95e059d581b8?q=80&w=400' }, { id: 'd1', name: 'Corte Princesa', desc: 'Pedrería Swarovski', img: 'https://images.unsplash.com/photo-1566162331599-563b7e735492?q=80&w=400' } ],
            backings: [ { id: 'b1', name: 'Aro Floral Metálico', desc: 'Con luces neón', img: 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=400' }, { id: 'b2', name: 'Muro de Rosas', desc: 'Flores naturales o seda', img: 'https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?q=80&w=400' } ],
            illumNames: [ { id: 'n1', name: 'Letras Gigantes 3D', desc: '1.20m de altura, luz cálida', img: 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=400' }, { id: 'n2', name: 'Neón Flex LED', desc: 'Cursiva sobre panel acrílico', img: 'https://images.unsplash.com/photo-1563841930606-67e2bce48b78?q=80&w=400' } ],
            centerpieces: [ { id: 'cp1', name: 'Candelabro Cristal', desc: 'Con velas LED', img: 'https://images.unsplash.com/photo-1530103862676-de3c9a728f4d?q=80&w=400' }, { id: 'cp2', name: 'Búcaro Floral Alto', desc: 'Flores de temporada', img: 'https://images.unsplash.com/photo-1523688881335-e105eaf77014?q=80&w=400' } ]
        },

        openModal(title, catalog, prop) {
            this.modalTitle = title;
            this.activeCatalog = this.catalogs[catalog];
            this.targetProp = prop;
            this.activeModal = true;
        },
        selectItem(item) {
            this.event[this.targetProp] = item;
            this.activeModal = null;
        }
    }">

    {{-- ==========================================
         MODAL DE CATÁLOGOS (Visualización de BD)
    ========================================== --}}
    <div x-show="activeModal" x-cloak class="fixed inset-0 z-[100] bg-white/90 dark:bg-black/90 backdrop-blur-xl flex flex-col transition-colors" x-transition.opacity>
        <div class="p-6 flex justify-between items-center border-b border-zinc-200 dark:border-white/10">
            <h3 class="text-2xl font-black uppercase tracking-widest text-amber-500" x-text="modalTitle"></h3>
            <button @click="activeModal = null" class="w-10 h-10 bg-zinc-200 dark:bg-white/10 rounded-full hover:bg-amber-500 hover:text-white transition flex items-center justify-center text-zinc-900 dark:text-white">✕</button>
        </div>
        <div class="p-8 grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 overflow-y-auto custom-scroll flex-grow">
            <template x-for="item in activeCatalog" :key="item.id">
                <div @click="selectItem(item)" class="group cursor-pointer rounded-2xl overflow-hidden relative h-72 border border-zinc-300 dark:border-white/10 hover:border-amber-500 dark:hover:border-amber-500 transition-all">
                    <img :src="item.img" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-zinc-900/90 via-zinc-900/40 dark:from-black/90 dark:via-black/40 to-transparent flex flex-col justify-end p-5">
                        <h4 class="font-bold text-lg text-white" x-text="item.name"></h4>
                        <p class="text-white/80 dark:text-white/60 text-xs mt-1" x-text="item.desc"></p>
                    </div>
                    <div x-show="event[targetProp]?.id === item.id" class="absolute top-4 right-4 bg-amber-500 text-white dark:text-black text-[10px] font-bold px-3 py-1 rounded-full uppercase">Elegido</div>
                </div>
            </template>
        </div>
    </div>

    {{-- CABECERA --}}
    <header class="py-6 px-10 border-b border-zinc-200 dark:border-white/10 glass-panel relative z-10 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-black tracking-tighter text-zinc-900 dark:text-white">STUDIO<span class="text-amber-500">.CANVAS</span></h1>
            <p class="text-xs text-zinc-500 dark:text-zinc-400 font-mono tracking-widest uppercase mt-1">Configurador de Eventos v2.0</p>
        </div>
        <div class="flex gap-2">
            <template x-for="i in 5">
                <button @click="step = i" :class="step === i ? 'bg-amber-500 text-white dark:text-black w-8' : 'bg-zinc-200 dark:bg-zinc-800 text-zinc-500 hover:bg-zinc-300 dark:hover:bg-zinc-700 w-8'" class="h-8 rounded-full font-bold text-xs transition-all flex items-center justify-center" x-text="i"></button>
            </template>
        </div>
    </header>

    {{-- CONTENEDOR PRINCIPAL --}}
    <main class="flex-grow flex overflow-hidden">
        
        {{-- PANEL IZQUIERDO: FORMULARIO BENTO GRID --}}
        <div class="w-full lg:w-2/3 h-full overflow-y-auto custom-scroll p-6 md:p-10 pb-32">
            
            {{-- PASO 1: PROTAGONISTAS --}}
            <div x-show="step === 1" x-transition.opacity.duration.500ms>
                <h2 class="text-3xl font-bold mb-6 flex items-center gap-3 text-zinc-900 dark:text-white"><span class="text-amber-500">01.</span> Información Base</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div class="glass-panel p-5 rounded-2xl">
                        <label class="text-xs text-zinc-500 dark:text-zinc-400 uppercase tracking-widest font-bold mb-2 block">Nombre del Cliente</label>
                        <input type="text" x-model="event.clientName" class="w-full bg-white/50 dark:bg-black/50 border border-zinc-200 dark:border-white/10 rounded-xl px-4 py-3 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 outline-none transition text-zinc-900 dark:text-white" placeholder="Ej. Familia Rodríguez">
                    </div>
                    <div class="glass-panel p-5 rounded-2xl">
                        <label class="text-xs text-zinc-500 dark:text-zinc-400 uppercase tracking-widest font-bold mb-2 block">Teléfono / WhatsApp</label>
                        <input type="tel" x-model="event.phone" class="w-full bg-white/50 dark:bg-black/50 border border-zinc-200 dark:border-white/10 rounded-xl px-4 py-3 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 outline-none transition text-zinc-900 dark:text-white" placeholder="+57 300 000 0000">
                    </div>
                    <div class="glass-panel p-5 rounded-2xl">
                        <label class="text-xs text-zinc-500 dark:text-zinc-400 uppercase tracking-widest font-bold mb-2 block">Fecha del Evento</label>
                        <input type="date" x-model="event.date" class="w-full bg-white/50 dark:bg-black/50 border border-zinc-200 dark:border-white/10 rounded-xl px-4 py-3 focus:border-amber-500 outline-none transition text-zinc-900 dark:text-white">
                    </div>
                    <div class="glass-panel p-5 rounded-2xl">
                        <label class="text-xs text-zinc-500 dark:text-zinc-400 uppercase tracking-widest font-bold mb-2 flex justify-between"><span>Invitados</span> <span class="text-amber-500" x-text="event.guests"></span></label>
                        <input type="range" min="30" max="1000" step="10" x-model="event.guests" class="w-full accent-amber-500">
                    </div>
                </div>

                <h3 class="text-sm text-zinc-500 dark:text-zinc-400 uppercase tracking-widest font-bold mb-4">Tipo de Evento</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3 mb-8">
                    <template x-for="t in ['Boda', '15 Años', 'Bautizo', 'Baby Shower', 'Cumpleaños', 'Corporativo']">
                        <button @click="event.type = t" :class="event.type === t ? 'bg-amber-500 border-amber-500 text-white dark:text-black shadow-[0_0_20px_rgba(245,158,11,0.3)]' : 'glass-panel text-zinc-900 dark:text-white border border-zinc-200 dark:border-white/10 hover:border-amber-500 dark:hover:border-amber-500/50'" class="py-4 rounded-xl font-bold transition-all" x-text="t"></button>
                    </template>
                </div>
                
                <button @click="step = 2" class="w-full py-4 bg-zinc-900 dark:bg-white text-white dark:text-black font-black uppercase tracking-widest rounded-xl hover:bg-amber-500 dark:hover:bg-amber-500 transition-colors">Diseñar Atmósfera ➔</button>
            </div>

            {{-- PASO 2: ATMÓSFERA Y BANQUETE --}}
            <div x-show="step === 2" x-cloak x-transition.opacity.duration.500ms>
                <h2 class="text-3xl font-bold mb-6 flex items-center gap-3 text-zinc-900 dark:text-white"><span class="text-amber-500">02.</span> Atmósfera & Menú</h2>
                
                <div class="glass-panel p-6 rounded-3xl mb-4 border-l-4 border-l-amber-500">
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <h3 class="font-bold text-lg text-zinc-900 dark:text-white">Locación Principal</h3>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400">Selecciona el salón de tu preferencia</p>
                        </div>
                        <button @click="openModal('Salones', 'salons', 'salon')" class="bg-amber-500 text-white dark:text-black px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-wide hover:scale-105 transition"><span x-text="event.salon ? 'Cambiar Salón' : 'Elegir Salón'"></span></button>
                    </div>
                    <div x-show="event.salon" class="text-amber-600 dark:text-amber-400 text-sm font-bold flex items-center gap-2">✓ <span x-text="event.salon?.name"></span></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    {{-- Tarjeta Toggle Temática --}}
                    <div class="glass-panel p-5 rounded-2xl relative overflow-hidden group">
                        <div class="flex justify-between items-start mb-4">
                            <div><h3 class="font-bold text-lg text-zinc-900 dark:text-white">Temática</h3><p class="text-xs text-zinc-500 dark:text-zinc-400">Concepto visual unificado</p></div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" x-model="wants.theme" class="sr-only toggle-checkbox">
                                <div class="w-11 h-6 bg-zinc-300 dark:bg-zinc-800 rounded-full toggle-label border border-zinc-200 dark:border-white/10 transition-colors"><div class="absolute top-[2px] left-[2px] bg-white w-5 h-5 rounded-full transition-transform shadow-sm"></div></div>
                            </label>
                        </div>
                        <div x-show="wants.theme" x-transition>
                            <button @click="openModal('Temáticas', 'themes', 'theme')" class="w-full py-2 border border-amber-500 text-amber-600 dark:border-amber-500/50 dark:text-amber-500 rounded-lg text-xs font-bold uppercase hover:bg-amber-500 hover:text-white dark:hover:text-black transition"><span x-text="event.theme ? event.theme.name : 'Ver Catálogo de Temáticas'"></span></button>
                        </div>
                    </div>

                    {{-- Catering Select --}}
                    <div class="glass-panel p-5 rounded-2xl">
                        <h3 class="font-bold text-lg mb-1 text-zinc-900 dark:text-white">Banquete & Menú</h3>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 mb-4">Estilo de alimentación</p>
                        <select x-model="event.food" class="w-full bg-white/50 dark:bg-black/50 border border-zinc-200 dark:border-white/10 rounded-xl px-4 py-3 text-sm text-zinc-900 dark:text-white focus:border-amber-500 outline-none">
                            <option value="">No requerido / N/A</option>
                            <option value="Plato Típico">Plato Típico Servido</option>
                            <option value="Buffet 2 Tipos">Buffet Premium (2 tipos + Meseros + Cristalería)</option>
                            <option value="Solo Cristalería">Solo alquiler de cristalería</option>
                        </select>
                    </div>
                </div>
                
                <button @click="step = 3" class="w-full py-4 mt-6 bg-zinc-900 dark:bg-white text-white dark:text-black font-black uppercase tracking-widest rounded-xl hover:bg-amber-500 dark:hover:bg-amber-500 transition-colors">Personalizar Decoración ➔</button>
            </div>

            {{-- PASO 3: DECORACIÓN Y ESCENOGRAFÍA --}}
            <div x-show="step === 3" x-cloak x-transition.opacity.duration.500ms>
                <h2 class="text-3xl font-bold mb-6 flex items-center gap-3 text-zinc-900 dark:text-white"><span class="text-amber-500">03.</span> Escenografía</h2>

                <div class="glass-panel p-6 rounded-3xl mb-4">
                    <div class="flex justify-between items-center mb-4">
                        <div><h3 class="font-bold text-lg text-zinc-900 dark:text-white">Sillería Principal</h3><p class="text-xs text-zinc-500 dark:text-zinc-400">La joya de la corona del evento</p></div>
                        <button @click="openModal('Sillas Principales', 'chairs', 'chair')" class="bg-amber-500 text-white dark:text-black px-4 py-2 rounded-lg text-xs font-bold uppercase hover:scale-105 transition"><span x-text="event.chair ? 'Modificar' : 'Seleccionar'"></span></button>
                    </div>
                    <div x-show="event.chair" class="text-amber-600 dark:text-amber-400 text-sm font-bold">✓ Silla elegida: <span x-text="event.chair?.name"></span></div>
                </div>

                {{-- BENTO GRID: Toggles de Decoración --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    
                    {{-- Backing --}}
                    <div class="glass-panel p-5 rounded-2xl">
                        <div class="flex justify-between items-center mb-4">
                            <div><h3 class="font-bold text-sm text-zinc-900 dark:text-white">Backing de Fotos</h3><p class="text-[10px] text-zinc-500 dark:text-zinc-400">Estructuras traseras con diseño</p></div>
                            <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="wants.backing" class="sr-only toggle-checkbox"><div class="w-9 h-5 bg-zinc-300 dark:bg-zinc-800 rounded-full toggle-label transition-colors"><div class="absolute top-[2px] left-[2px] bg-white w-4 h-4 rounded-full transition-transform shadow-sm"></div></div></label>
                        </div>
                        <button x-show="wants.backing" @click="openModal('Backings', 'backings', 'backing')" class="w-full py-2 border border-amber-500/50 dark:border-amber-500/30 text-amber-600 dark:text-amber-500 text-[10px] font-bold rounded-lg uppercase hover:bg-amber-500 hover:text-white dark:hover:text-black transition" x-text="event.backing ? event.backing.name : 'Ver Modelos'"></button>
                    </div>

                    {{-- Nombre Iluminado --}}
                    <div class="glass-panel p-5 rounded-2xl">
                        <div class="flex justify-between items-center mb-4">
                            <div><h3 class="font-bold text-sm text-zinc-900 dark:text-white">Nombre Iluminado</h3><p class="text-[10px] text-zinc-500 dark:text-zinc-400">Letras 3D o Neón</p></div>
                            <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="wants.illumName" class="sr-only toggle-checkbox"><div class="w-9 h-5 bg-zinc-300 dark:bg-zinc-800 rounded-full toggle-label transition-colors"><div class="absolute top-[2px] left-[2px] bg-white w-4 h-4 rounded-full transition-transform shadow-sm"></div></div></label>
                        </div>
                        <button x-show="wants.illumName" @click="openModal('Letras y Neón', 'illumNames', 'illumName')" class="w-full py-2 border border-amber-500/50 dark:border-amber-500/30 text-amber-600 dark:text-amber-500 text-[10px] font-bold rounded-lg uppercase hover:bg-amber-500 hover:text-white dark:hover:text-black transition" x-text="event.illumName ? event.illumName.name : 'Ver Estilos'"></button>
                    </div>

                    {{-- Centros de Mesa --}}
                    <div class="glass-panel p-5 rounded-2xl">
                        <div class="flex justify-between items-center mb-4">
                            <div><h3 class="font-bold text-sm text-zinc-900 dark:text-white">Centros de Mesa</h3><p class="text-[10px] text-zinc-500 dark:text-zinc-400">Arreglos para invitados</p></div>
                            <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="wants.centerpieces" class="sr-only toggle-checkbox"><div class="w-9 h-5 bg-zinc-300 dark:bg-zinc-800 rounded-full toggle-label transition-colors"><div class="absolute top-[2px] left-[2px] bg-white w-4 h-4 rounded-full transition-transform shadow-sm"></div></div></label>
                        </div>
                        <button x-show="wants.centerpieces" @click="openModal('Centros de Mesa', 'centerpieces', 'centerpiece')" class="w-full py-2 border border-amber-500/50 dark:border-amber-500/30 text-amber-600 dark:text-amber-500 text-[10px] font-bold rounded-lg uppercase hover:bg-amber-500 hover:text-white dark:hover:text-black transition" x-text="event.centerpiece ? event.centerpiece.name : 'Elegir Arreglo'"></button>
                    </div>

                    {{-- Opciones Switch Simples --}}
                    <div class="glass-panel p-5 rounded-2xl flex justify-between items-center">
                        <div><h3 class="font-bold text-sm text-zinc-900 dark:text-white">Decoración de Techo</h3><p class="text-[10px] text-zinc-500 dark:text-zinc-400">Telas y luces colgantes</p></div>
                        <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="wants.ceiling" class="sr-only toggle-checkbox"><div class="w-9 h-5 bg-zinc-300 dark:bg-zinc-800 rounded-full toggle-label transition-colors"><div class="absolute top-[2px] left-[2px] bg-white w-4 h-4 rounded-full transition-transform shadow-sm"></div></div></label>
                    </div>
                    <div class="glass-panel p-5 rounded-2xl flex justify-between items-center">
                        <div><h3 class="font-bold text-sm text-zinc-900 dark:text-white">Cilindros Metálicos</h3><p class="text-[10px] text-zinc-500 dark:text-zinc-400">Bases decorativas</p></div>
                        <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="wants.cylinders" class="sr-only toggle-checkbox"><div class="w-9 h-5 bg-zinc-300 dark:bg-zinc-800 rounded-full toggle-label transition-colors"><div class="absolute top-[2px] left-[2px] bg-white w-4 h-4 rounded-full transition-transform shadow-sm"></div></div></label>
                    </div>
                    <div class="glass-panel p-5 rounded-2xl flex justify-between items-center">
                        <div><h3 class="font-bold text-sm text-zinc-900 dark:text-white">Pedestales</h3><p class="text-[10px] text-zinc-500 dark:text-zinc-400">Para flores o pasillo</p></div>
                        <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="wants.pedestals" class="sr-only toggle-checkbox"><div class="w-9 h-5 bg-zinc-300 dark:bg-zinc-800 rounded-full toggle-label transition-colors"><div class="absolute top-[2px] left-[2px] bg-white w-4 h-4 rounded-full transition-transform shadow-sm"></div></div></label>
                    </div>
                </div>

                {{-- Selects Directos --}}
                <div class="mt-4 glass-panel p-5 rounded-2xl">
                    <label class="text-sm font-bold block mb-2 text-zinc-900 dark:text-white">Camino principal</label>
                    <div class="grid grid-cols-3 gap-2">
                        <button @click="event.carpet = 'Alfombra'" :class="event.carpet === 'Alfombra' ? 'bg-amber-500 text-white dark:text-black' : 'bg-zinc-200 dark:bg-zinc-800/50 text-zinc-600 dark:text-zinc-400'" class="py-2 text-xs font-bold rounded-lg transition">Alfombra Roja/Blanca</button>
                        <button @click="event.carpet = 'Pétalos'" :class="event.carpet === 'Pétalos' ? 'bg-amber-500 text-white dark:text-black' : 'bg-zinc-200 dark:bg-zinc-800/50 text-zinc-600 dark:text-zinc-400'" class="py-2 text-xs font-bold rounded-lg transition">Camino en Pétalos</button>
                        <button @click="event.carpet = 'N/A'" :class="event.carpet === 'N/A' ? 'bg-zinc-400 dark:bg-zinc-600 text-zinc-900 dark:text-white' : 'bg-zinc-200 dark:bg-zinc-800/50 text-zinc-600 dark:text-zinc-400'" class="py-2 text-xs font-bold rounded-lg transition">No Aplica</button>
                    </div>
                </div>

                <button @click="step = 4" class="w-full py-4 mt-6 bg-zinc-900 dark:bg-white text-white dark:text-black font-black uppercase tracking-widest rounded-xl hover:bg-amber-500 dark:hover:bg-amber-500 transition-colors">Medios Audiovisuales ➔</button>
            </div>

            {{-- PASO 4: AUDIOVISUAL Y RECUERDOS --}}
            <div x-show="step === 4" x-cloak x-transition.opacity.duration.500ms>
                <h2 class="text-3xl font-bold mb-6 flex items-center gap-3 text-zinc-900 dark:text-white"><span class="text-amber-500">04.</span> Visuales & Recuerdos</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    {{-- Fotografía --}}
                    <div class="glass-panel p-5 rounded-2xl relative overflow-hidden group">
                        <div class="flex justify-between items-start mb-2">
                            <div><h3 class="font-bold text-lg text-zinc-900 dark:text-white group-hover:text-amber-600 dark:group-hover:text-amber-400 transition">Fotografía Pro</h3></div>
                            <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="wants.photo" class="sr-only toggle-checkbox"><div class="w-11 h-6 bg-zinc-300 dark:bg-zinc-800 rounded-full toggle-label border border-zinc-200 dark:border-white/10"><div class="absolute top-[2px] left-[2px] bg-white w-5 h-5 rounded-full transition-transform shadow-sm"></div></div></label>
                        </div>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400">50 impresas, fotógrafo, cámara pro y álbum.</p>
                    </div>

                    {{-- Video --}}
                    <div class="glass-panel p-5 rounded-2xl relative overflow-hidden group">
                        <div class="flex justify-between items-start mb-2">
                            <div><h3 class="font-bold text-lg text-zinc-900 dark:text-white group-hover:text-amber-600 dark:group-hover:text-amber-400 transition">Video Editado</h3></div>
                            <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="wants.video" class="sr-only toggle-checkbox"><div class="w-11 h-6 bg-zinc-300 dark:bg-zinc-800 rounded-full toggle-label border border-zinc-200 dark:border-white/10"><div class="absolute top-[2px] left-[2px] bg-white w-5 h-5 rounded-full transition-transform shadow-sm"></div></div></label>
                        </div>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400">Entrega en USB un mes después del evento.</p>
                    </div>

                    {{-- Retrato --}}
                    <div class="glass-panel p-5 rounded-2xl relative overflow-hidden group">
                        <div class="flex justify-between items-start mb-2">
                            <div><h3 class="font-bold text-lg text-zinc-900 dark:text-white group-hover:text-amber-600 dark:group-hover:text-amber-400 transition">Retrato Flotante</h3></div>
                            <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="wants.portrait" class="sr-only toggle-checkbox"><div class="w-11 h-6 bg-zinc-300 dark:bg-zinc-800 rounded-full toggle-label border border-zinc-200 dark:border-white/10"><div class="absolute top-[2px] left-[2px] bg-white w-5 h-5 rounded-full transition-transform shadow-sm"></div></div></label>
                        </div>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400">Cuadro 50x70 con marco elegante.</p>
                    </div>

                    {{-- Video Beam --}}
                    <div class="glass-panel p-5 rounded-2xl relative overflow-hidden group">
                        <div class="flex justify-between items-start mb-2">
                            <div><h3 class="font-bold text-lg text-zinc-900 dark:text-white group-hover:text-amber-600 dark:group-hover:text-amber-400 transition">Video Beam</h3></div>
                            <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="wants.beam" class="sr-only toggle-checkbox"><div class="w-11 h-6 bg-zinc-300 dark:bg-zinc-800 rounded-full toggle-label border border-zinc-200 dark:border-white/10"><div class="absolute top-[2px] left-[2px] bg-white w-5 h-5 rounded-full transition-transform shadow-sm"></div></div></label>
                        </div>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400">Proyección (cliente envía fotos y canción).</p>
                    </div>
                </div>

                {{-- Recordatorios e Invitaciones --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="glass-panel p-5 rounded-2xl">
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="font-bold text-sm text-zinc-900 dark:text-white">Recordatorios</h3>
                            <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="wants.reminders" class="sr-only toggle-checkbox"><div class="w-9 h-5 bg-zinc-300 dark:bg-zinc-800 rounded-full toggle-label transition-colors"><div class="absolute top-[2px] left-[2px] bg-white w-4 h-4 rounded-full transition-transform shadow-sm"></div></div></label>
                        </div>
                        <div x-show="wants.reminders" class="grid grid-cols-2 gap-2 mt-2">
                            <button @click="event.reminders = 'Transparente'" :class="event.reminders === 'Transparente' ? 'bg-amber-500 text-white dark:text-black' : 'bg-zinc-200 dark:bg-zinc-800/50 text-zinc-600 dark:text-zinc-400'" class="py-2 text-[10px] font-bold uppercase rounded-lg transition">Transparente</button>
                            <button @click="event.reminders = 'Madera'" :class="event.reminders === 'Madera' ? 'bg-amber-500 text-white dark:text-black' : 'bg-zinc-200 dark:bg-zinc-800/50 text-zinc-600 dark:text-zinc-400'" class="py-2 text-[10px] font-bold uppercase rounded-lg transition">Madera Dorada</button>
                        </div>
                    </div>
                    
                    <div class="glass-panel p-5 rounded-2xl">
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="font-bold text-sm text-zinc-900 dark:text-white">Invitaciones</h3>
                            <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="wants.invitations" class="sr-only toggle-checkbox"><div class="w-9 h-5 bg-zinc-300 dark:bg-zinc-800 rounded-full toggle-label transition-colors"><div class="absolute top-[2px] left-[2px] bg-white w-4 h-4 rounded-full transition-transform shadow-sm"></div></div></label>
                        </div>
                        <div x-show="wants.invitations" class="grid grid-cols-3 gap-1 mt-2">
                            <button @click="event.invitations = 'Virtual Foto'" :class="event.invitations === 'Virtual Foto' ? 'bg-amber-500 text-white dark:text-black' : 'bg-zinc-200 dark:bg-zinc-800/50 text-zinc-600 dark:text-zinc-400'" class="py-2 text-[9px] font-bold uppercase rounded-lg transition">Virtual Foto</button>
                            <button @click="event.invitations = 'Virtual Video'" :class="event.invitations === 'Virtual Video' ? 'bg-amber-500 text-white dark:text-black' : 'bg-zinc-200 dark:bg-zinc-800/50 text-zinc-600 dark:text-zinc-400'" class="py-2 text-[9px] font-bold uppercase rounded-lg transition">Virtual Video</button>
                            <button @click="event.invitations = 'Física'" :class="event.invitations === 'Física' ? 'bg-amber-500 text-white dark:text-black' : 'bg-zinc-200 dark:bg-zinc-800/50 text-zinc-600 dark:text-zinc-400'" class="py-2 text-[9px] font-bold uppercase rounded-lg transition">Físicas</button>
                        </div>
                    </div>
                </div>
                
                <div class="glass-panel p-5 rounded-2xl mt-4 flex justify-between items-center">
                    <div><h3 class="font-bold text-sm text-zinc-900 dark:text-white">Libro de Firmas</h3><p class="text-[10px] text-zinc-500 dark:text-zinc-400">Para recuerdos escritos de los invitados</p></div>
                    <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="wants.guestbook" class="sr-only toggle-checkbox"><div class="w-9 h-5 bg-zinc-300 dark:bg-zinc-800 rounded-full toggle-label transition-colors"><div class="absolute top-[2px] left-[2px] bg-white w-4 h-4 rounded-full transition-transform shadow-sm"></div></div></label>
                </div>

                <button @click="step = 5" class="w-full py-4 mt-6 bg-zinc-900 dark:bg-white text-white dark:text-black font-black uppercase tracking-widest rounded-xl hover:bg-amber-500 dark:hover:bg-amber-500 transition-colors">Extras Exclusivos ➔</button>
            </div>

            {{-- PASO 5: EXCLUSIVOS (Vestidos, Ramos, Quinceañero) --}}
            <div x-show="step === 5" x-cloak x-transition.opacity.duration.500ms>
                <h2 class="text-3xl font-bold mb-6 flex items-center gap-3 text-zinc-900 dark:text-white"><span class="text-amber-500">05.</span> Especiales <span x-text="event.type"></span></h2>

                {{-- Solo visible si es 15 Años --}}
                <template x-if="event.type === '15 Años'">
                    <div class="glass-panel p-6 rounded-2xl mb-4 border border-pink-200 dark:border-pink-500/30">
                        <div class="flex justify-between items-start mb-4">
                            <div><h3 class="font-bold text-xl text-pink-600 dark:text-pink-400">Diseño de Vestido</h3><p class="text-xs text-zinc-500 dark:text-zinc-400">De catálogo o 100% personalizado</p></div>
                            <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="wants.dress" class="sr-only toggle-checkbox"><div class="w-11 h-6 bg-zinc-300 dark:bg-zinc-800 rounded-full toggle-label border border-zinc-200 dark:border-white/10"><div class="absolute top-[2px] left-[2px] bg-white w-5 h-5 rounded-full transition-transform shadow-sm"></div></div></label>
                        </div>
                        <button x-show="wants.dress" @click="openModal('Alta Costura', 'dresses', 'dress')" class="w-full py-3 bg-pink-100 dark:bg-pink-500/20 text-pink-600 dark:text-pink-400 hover:bg-pink-500 hover:text-white font-bold uppercase text-xs rounded-xl transition" x-text="event.dress ? 'Modificar Elección' : 'Ver Colección o Solicitar Personalizado'"></button>
                        <div x-show="event.dress" class="mt-3 text-pink-500 dark:text-pink-300 text-xs text-center font-bold" x-text="'Elegido: ' + event.dress?.name"></div>
                    </div>
                </template>

                {{-- Regalos (Todos los eventos) --}}
                <div class="glass-panel p-5 rounded-2xl mb-4">
                    <label class="text-sm font-bold block mb-3 text-amber-600 dark:text-amber-500">Manejo de Obsequios</label>
                    <div class="grid grid-cols-3 gap-2">
                        <button @click="event.gifts = 'Lluvia de Sobres'" :class="event.gifts === 'Lluvia de Sobres' ? 'bg-amber-500 text-white dark:text-black' : 'bg-zinc-200 dark:bg-zinc-800/50 text-zinc-600 dark:text-zinc-400'" class="py-3 text-[10px] font-bold uppercase rounded-lg transition">Lluvia de Sobres</button>
                        <button @click="event.gifts = 'Mesa de Regalos'" :class="event.gifts === 'Mesa de Regalos' ? 'bg-amber-500 text-white dark:text-black' : 'bg-zinc-200 dark:bg-zinc-800/50 text-zinc-600 dark:text-zinc-400'" class="py-3 text-[10px] font-bold uppercase rounded-lg transition">Mesa de Regalos</button>
                        <button @click="event.gifts = 'N/A'" :class="event.gifts === 'N/A' ? 'bg-zinc-400 dark:bg-zinc-600 text-zinc-900 dark:text-white' : 'bg-zinc-200 dark:bg-zinc-800/50 text-zinc-600 dark:text-zinc-400'" class="py-3 text-[10px] font-bold uppercase rounded-lg transition">No Aplica</button>
                    </div>
                </div>

                {{-- Opciones mixtas --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Ramos (Boda o 15) --}}
                    <div x-show="event.type === '15 Años' || event.type === 'Boda'" class="glass-panel p-5 rounded-2xl flex justify-between items-center">
                        <div><h3 class="font-bold text-sm text-zinc-900 dark:text-white">Ramos / Rosas</h3><p class="text-[10px] text-zinc-500 dark:text-zinc-400">Naturales o preservadas</p></div>
                        <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="wants.roses" class="sr-only toggle-checkbox"><div class="w-9 h-5 bg-zinc-300 dark:bg-zinc-800 rounded-full toggle-label transition-colors"><div class="absolute top-[2px] left-[2px] bg-white w-4 h-4 rounded-full transition-transform shadow-sm"></div></div></label>
                    </div>

                    {{-- Copas --}}
                    <div x-show="event.type === '15 Años' || event.type === 'Boda'" class="glass-panel p-5 rounded-2xl flex justify-between items-center">
                        <div><h3 class="font-bold text-sm text-zinc-900 dark:text-white">Copas Decoradas</h3><p class="text-[10px] text-zinc-500 dark:text-zinc-400">Para el brindis principal</p></div>
                        <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="wants.decoratedGlasses" class="sr-only toggle-checkbox"><div class="w-9 h-5 bg-zinc-300 dark:bg-zinc-800 rounded-full toggle-label transition-colors"><div class="absolute top-[2px] left-[2px] bg-white w-4 h-4 rounded-full transition-transform shadow-sm"></div></div></label>
                    </div>

                    {{-- Quinceañero --}}
                    <div x-show="event.type === '15 Años' || event.type === 'Cumpleaños'" class="glass-panel p-5 rounded-2xl flex justify-between items-center">
                        <div><h3 class="font-bold text-sm text-zinc-900 dark:text-white">Quinceañero / Chambelán</h3><p class="text-[10px] text-zinc-500 dark:text-zinc-400">Acompañante de protocolo</p></div>
                        <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="wants.quinceanero" class="sr-only toggle-checkbox"><div class="w-9 h-5 bg-zinc-300 dark:bg-zinc-800 rounded-full toggle-label transition-colors"><div class="absolute top-[2px] left-[2px] bg-white w-4 h-4 rounded-full transition-transform shadow-sm"></div></div></label>
                    </div>
                </div>

                <button class="mt-10 w-full py-5 bg-gradient-to-r from-amber-400 to-amber-500 dark:from-amber-500 dark:to-yellow-400 text-white dark:text-black font-black text-lg uppercase tracking-widest rounded-xl hover:scale-[1.02] transition-transform shadow-[0_0_30px_rgba(245,158,11,0.3)] dark:shadow-[0_0_30px_rgba(245,158,11,0.5)]">Generar Cotización Oficial</button>
            </div>

        </div>

        {{-- PANEL DERECHO: TICKET DINÁMICO (Live Preview) --}}
        <div class="hidden lg:block w-1/3 bg-zinc-100/90 dark:bg-black/80 backdrop-blur-2xl border-l border-zinc-200 dark:border-white/10 p-8 h-full overflow-y-auto custom-scroll relative">
            
            <div class="sticky top-0 pb-4 border-b border-zinc-200 dark:border-white/10 bg-zinc-100/90 dark:bg-black/80 backdrop-blur-xl z-10">
                <h3 class="text-[10px] font-mono text-amber-600 dark:text-amber-500 uppercase tracking-widest mb-1">Resumen en Tiempo Real</h3>
                <h2 class="text-2xl font-bold leading-tight text-zinc-900 dark:text-white" x-text="event.clientName || 'Tu Evento VIP'"></h2>
                <div class="flex gap-2 mt-2">
                    <span class="bg-zinc-200 dark:bg-white/10 px-2 py-1 rounded text-[10px] uppercase font-bold text-zinc-900 dark:text-white" x-text="event.type"></span>
                    <span class="bg-zinc-200 dark:bg-white/10 px-2 py-1 rounded text-[10px] uppercase font-bold text-zinc-900 dark:text-white" x-text="event.guests + ' Pax'"></span>
                </div>
            </div>

            <div class="mt-6 space-y-6">
                {{-- Locación --}}
                <div x-show="event.salon || wants.theme">
                    <h4 class="text-xs uppercase font-bold tracking-widest text-zinc-500 mb-3 border-b border-zinc-200 dark:border-white/5 pb-1">Espacio</h4>
                    <ul class="space-y-3">
                        <li x-show="event.salon" class="flex items-center gap-3"><img :src="event.salon?.img" class="w-10 h-10 rounded object-cover"><span class="text-sm font-bold text-zinc-900 dark:text-white" x-text="event.salon?.name"></span></li>
                        <li x-show="wants.theme && event.theme" class="flex items-center gap-3"><img :src="event.theme?.img" class="w-10 h-10 rounded object-cover border border-amber-500"><span class="text-sm text-amber-600 dark:text-amber-400" x-text="'Tema: ' + event.theme?.name"></span></li>
                    </ul>
                </div>

                {{-- Estructuras --}}
                <div x-show="event.chair || (wants.backing && event.backing) || (wants.illumName && event.illumName)">
                    <h4 class="text-xs uppercase font-bold tracking-widest text-zinc-500 mb-3 border-b border-zinc-200 dark:border-white/5 pb-1">Escenografía</h4>
                    <ul class="space-y-3">
                        <li x-show="event.chair" class="flex items-center gap-3"><img :src="event.chair?.img" class="w-10 h-10 rounded object-cover"><span class="text-sm text-zinc-900 dark:text-white" x-text="event.chair?.name"></span></li>
                        <li x-show="wants.backing && event.backing" class="flex items-center gap-3"><img :src="event.backing?.img" class="w-10 h-10 rounded object-cover"><span class="text-sm text-zinc-700 dark:text-zinc-300" x-text="'Backing: ' + event.backing?.name"></span></li>
                        <li x-show="wants.illumName && event.illumName" class="flex items-center gap-3"><img :src="event.illumName?.img" class="w-10 h-10 rounded object-cover"><span class="text-sm text-zinc-700 dark:text-zinc-300" x-text="'Letras: ' + event.illumName?.name"></span></li>
                    </ul>
                </div>

                {{-- Items de lista (Sí/No rápidos) --}}
                <div>
                    <h4 class="text-xs uppercase font-bold tracking-widest text-zinc-500 mb-3 border-b border-zinc-200 dark:border-white/5 pb-1">Servicios Incluidos</h4>
                    <ul class="space-y-2 text-sm text-zinc-700 dark:text-zinc-300 font-medium">
                        <li x-show="event.food" class="flex items-center gap-2"><span class="text-amber-500">✓</span> <span x-text="'Alimentación: ' + event.food"></span></li>
                        <li x-show="wants.photo" class="flex items-center gap-2"><span class="text-amber-500">✓</span> Pack Fotografía Pro</li>
                        <li x-show="wants.video" class="flex items-center gap-2"><span class="text-amber-500">✓</span> Cinematografía (Video)</li>
                        <li x-show="wants.portrait" class="flex items-center gap-2"><span class="text-amber-500">✓</span> Retrato Principal 50x70</li>
                        <li x-show="wants.beam" class="flex items-center gap-2"><span class="text-amber-500">✓</span> Proyección Video Beam</li>
                        <li x-show="event.carpet && event.carpet !== 'N/A'" class="flex items-center gap-2"><span class="text-amber-500">✓</span> <span x-text="'Camino: ' + event.carpet"></span></li>
                        <li x-show="event.reminders" class="flex items-center gap-2"><span class="text-amber-500">✓</span> <span x-text="'Recordatorio ' + event.reminders"></span></li>
                        <li x-show="event.invitations" class="flex items-center gap-2"><span class="text-amber-500">✓</span> <span x-text="'Invitación ' + event.invitations"></span></li>
                    </ul>
                </div>

                {{-- Especiales --}}
                <div x-show="wants.dress || event.gifts || wants.quinceanero || wants.guestbook">
                    <h4 class="text-xs uppercase font-bold tracking-widest text-zinc-500 mb-3 border-b border-zinc-200 dark:border-white/5 pb-1">Exclusivos</h4>
                    <ul class="space-y-3 text-sm text-zinc-700 dark:text-zinc-300">
                        <li x-show="wants.dress && event.dress" class="flex items-center gap-3"><img :src="event.dress?.img" class="w-10 h-10 rounded object-cover border border-pink-500"><span class="text-pink-600 dark:text-pink-400 font-bold" x-text="event.dress?.name"></span></li>
                        <li x-show="event.gifts && event.gifts !== 'N/A'" class="flex items-center gap-2"><span class="text-amber-500">✓</span> <span x-text="event.gifts"></span></li>
                        <li x-show="wants.guestbook" class="flex items-center gap-2"><span class="text-amber-500">✓</span> Libro de firmas</li>
                        <li x-show="wants.quinceanero" class="flex items-center gap-2"><span class="text-amber-500">✓</span> Chambelán / Quinceañero</li>
                    </ul>
                </div>

            </div>
            
            {{-- Footer del Receipt --}}
            <div class="mt-10 pt-4 border-t border-zinc-200 dark:border-white/10 opacity-50 flex items-center justify-center text-zinc-900 dark:text-white">
                <svg class="w-6 h-6 animate-pulse text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                <span class="text-[10px] font-mono tracking-widest ml-2 uppercase">Renderizando en vivo</span>
            </div>
        </div>

    </main>
</section>
</section> -->






























































{{-- ==========================================
     MOTOR DE COTIZACIÓN VIP "EVENT CANVAS"
     Experiencia Inmersiva, Moodboard Dinámico & Glassmorphism
=========================================== --}}
<style>
    /* Efectos de fondo y animaciones premium */
    .bg-grid-pattern { background-image: radial-gradient(rgba(0, 0, 0, 0.05) 1px, transparent 1px); background-size: 40px 40px; }
    .dark .bg-grid-pattern { background-image: radial-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px); }
    
    .glass-panel { background: rgba(255, 255, 255, 0.6); backdrop-filter: blur(24px); border: 1px solid rgba(255, 255, 255, 0.8); box-shadow: 0 10px 40px rgba(0, 0, 0, 0.03); }
    .dark .glass-panel { background: rgba(24, 24, 27, 0.4); border: 1px solid rgba(255, 255, 255, 0.05); box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5); }
    
    .custom-scroll::-webkit-scrollbar { width: 4px; }
    .custom-scroll::-webkit-scrollbar-track { background: transparent; }
    .custom-scroll::-webkit-scrollbar-thumb { background: rgba(245, 158, 11, 0.3); border-radius: 10px; }
    .custom-scroll::-webkit-scrollbar-thumb:hover { background: rgba(245, 158, 11, 0.8); }

    .toggle-checkbox:checked + .toggle-label { background-color: #f59e0b; border-color: #f59e0b; box-shadow: 0 0 15px rgba(245,158,11,0.3); }
    .toggle-checkbox:checked + .toggle-label div { transform: translateX(100%); }

    /* Input minimalista de lujo */
    .input-luxury {
        background: transparent;
        border: none;
        border-bottom: 2px solid rgba(161, 161, 170, 0.3);
        border-radius: 0;
        padding: 0.75rem 0;
        font-size: 1.5rem;
        font-weight: 300;
        transition: all 0.4s ease;
        width: 100%;
        color: inherit;
    }
    .input-luxury:focus {
        outline: none;
        border-bottom-color: #f59e0b;
        box-shadow: 0 15px 15px -15px rgba(245,158,11,0.2);
    }
    .dark .input-luxury { border-bottom-color: rgba(255, 255, 255, 0.1); }
    .dark .input-luxury:focus { border-bottom-color: #f59e0b; }
    .input-luxury::placeholder { color: rgba(161, 161, 170, 0.5); font-weight: 300; }

    /* Animaciones */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up { animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    
    .moodboard-image {
        animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
</style>

<section class="min-h-screen bg-zinc-50 dark:bg-zinc-950 text-zinc-900 dark:text-white font-sans relative overflow-hidden flex flex-col bg-grid-pattern transition-colors duration-700"
    x-data="{
        step: 0, // 0 = Welcome Screen
        activeModal: null, modalTitle: '', activeCatalog: [], targetCategory: '', targetProp: '',
        
        event: {
            type: 'Boda', clientName: '', phone: '', date: '', guests: 100, salon: null,
            food: '', carpet: '', gifts: '', invitations: '', reminders: '',
            theme: null, chair: null, dress: null, backing: null, illumName: null, centerpiece: null,
            photo: null, video: null, portrait: null,
        },

        wants: {
            theme: false, photo: false, video: false, portrait: false, beam: false,
            deco: false, backing: false, illumName: false, ceiling: false, 
            centerpieces: false, cylinders: false, pedestals: false,
            guestbook: false, roses: false, decoratedGlasses: false, quinceanero: false, dress: false,
            reminders: false, invitations: false
        },

        catalogs: {
            salons: [ { id: 's1', name: 'Gran Salón Imperial', desc: 'Capacidad 500 pax', img: 'https://images.unsplash.com/photo-1519167758481-83f550bb49b3?q=80&w=400' } ],
            themes: [ { id: 't1', name: 'Noche Estrellada', desc: 'Azul profundo y dorados', img: 'https://images.unsplash.com/photo-1512144804683-167817b1897e?q=80&w=400' }, { id: 't2', name: 'Gatsby', desc: 'Años 20, plumas y negro', img: 'https://images.unsplash.com/photo-1566737236500-c8ac43014a67?q=80&w=400' } ],
            chairs: [ { id: 'c1', name: 'Silla Trono', img: 'https://images.unsplash.com/photo-1505236858219-8359eb29e329?q=80&w=400' }, { id: 'c2', name: 'Isabelina', img: 'https://images.unsplash.com/photo-1532453288672-3a27e9be9efd?q=80&w=400' }, { id: 'c3', name: 'Columpio Floral', img: 'https://images.unsplash.com/photo-1517457373958-b7bdd4587205?q=80&w=400' }, { id: 'c4', name: 'Diván', img: 'https://images.unsplash.com/photo-1568822602701-a67bba8ba551?q=80&w=400' }, { id: 'c5', name: 'Tiffany', img: 'https://images.unsplash.com/photo-1505236858219-8359eb29e329?q=80&w=400' } ],
            dresses: [ { id: 'custom', name: 'Diseño Personalizado', desc: 'Confección a medida, color a elección', img: 'https://images.unsplash.com/photo-1595777457583-95e059d581b8?q=80&w=400' }, { id: 'd1', name: 'Corte Princesa', desc: 'Pedrería Swarovski', img: 'https://images.unsplash.com/photo-1566162331599-563b7e735492?q=80&w=400' } ],
            backings: [ { id: 'b1', name: 'Aro Floral Metálico', desc: 'Con luces neón', img: 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=400' }, { id: 'b2', name: 'Muro de Rosas', desc: 'Flores naturales o seda', img: 'https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?q=80&w=400' } ],
            illumNames: [ { id: 'n1', name: 'Letras Gigantes 3D', desc: '1.20m de altura, luz cálida', img: 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=400' }, { id: 'n2', name: 'Neón Flex LED', desc: 'Cursiva sobre panel acrílico', img: 'https://images.unsplash.com/photo-1563841930606-67e2bce48b78?q=80&w=400' } ],
            centerpieces: [ { id: 'cp1', name: 'Candelabro Cristal', desc: 'Con velas LED', img: 'https://images.unsplash.com/photo-1530103862676-de3c9a728f4d?q=80&w=400' }, { id: 'cp2', name: 'Búcaro Floral Alto', desc: 'Flores de temporada', img: 'https://images.unsplash.com/photo-1523688881335-e105eaf77014?q=80&w=400' } ]
        },

        openModal(title, catalog, prop) {
            this.modalTitle = title;
            this.activeCatalog = this.catalogs[catalog];
            this.targetProp = prop;
            this.activeModal = true;
        },
        selectItem(item) {
            this.event[this.targetProp] = item;
            this.activeModal = null;
        }
    }">

    {{-- MODAL DE CATÁLOGOS (Visualización de BD) --}}
    <div x-show="activeModal" x-cloak class="fixed inset-0 z-[100] bg-white/95 dark:bg-black/95 backdrop-blur-2xl flex flex-col transition-colors" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
        <div class="p-6 md:p-10 flex justify-between items-center border-b border-zinc-200 dark:border-white/10">
            <div>
                <h3 class="text-3xl font-black uppercase tracking-widest text-amber-500" x-text="modalTitle"></h3>
                <p class="text-zinc-500 dark:text-zinc-400 text-sm mt-1">Selecciona una opción para tu moodboard</p>
            </div>
            <button @click="activeModal = null" class="w-12 h-12 bg-zinc-100 dark:bg-white/5 rounded-full hover:bg-amber-500 hover:text-white transition-all flex items-center justify-center text-zinc-900 dark:text-white group">
                <svg class="w-6 h-6 group-hover:rotate-90 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <div class="p-6 md:p-10 grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8 overflow-y-auto custom-scroll flex-grow">
            <template x-for="item in activeCatalog" :key="item.id">
                <div @click="selectItem(item)" class="group cursor-pointer rounded-3xl overflow-hidden relative h-80 border border-zinc-200 dark:border-white/5 hover:border-amber-500 dark:hover:border-amber-500 transition-all shadow-lg hover:shadow-amber-500/20">
                    <img :src="item.img" class="w-full h-full object-cover group-hover:scale-110 transition duration-1000 ease-out">
                    <div class="absolute inset-0 bg-gradient-to-t from-zinc-900/90 via-zinc-900/20 dark:from-black/90 dark:via-black/20 to-transparent flex flex-col justify-end p-6">
                        <h4 class="font-bold text-xl text-white transform group-hover:-translate-y-1 transition-transform" x-text="item.name"></h4>
                        <p class="text-white/80 dark:text-white/60 text-sm mt-1 opacity-0 group-hover:opacity-100 transform translate-y-4 group-hover:translate-y-0 transition-all" x-text="item.desc"></p>
                    </div>
                    <div x-show="event[targetProp]?.id === item.id" class="absolute top-5 right-5 bg-amber-500 text-white dark:text-black text-[10px] font-black px-4 py-1.5 rounded-full uppercase tracking-widest shadow-lg">Seleccionado</div>
                </div>
            </template>
        </div>
    </div>

    {{-- CABECERA MINIMALISTA --}}
    <header class="py-6 px-10 relative z-20 flex justify-between items-center" x-show="step > 0" x-transition.opacity>
        <div>
            <h1 class="text-xl font-black tracking-tighter text-zinc-900 dark:text-white">THE<span class="text-amber-500">RING</span></h1>
            <p class="text-[10px] text-zinc-500 dark:text-zinc-400 font-mono tracking-widest uppercase mt-0.5">Studio Canvas</p>
        </div>
        
        {{-- Indicador de progreso --}}
        <div class="hidden md:flex items-center gap-4">
            <div class="text-[10px] font-bold uppercase tracking-widest text-zinc-500"><span x-text="step"></span> / 5</div>
            <div class="w-32 h-1 bg-zinc-200 dark:bg-zinc-800 rounded-full overflow-hidden">
                <div class="h-full bg-amber-500 transition-all duration-500" :style="'width: ' + (step * 20) + '%'"></div>
            </div>
        </div>

        <button class="md:hidden text-zinc-900 dark:text-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
        </button>
    </header>

    {{-- CONTENEDOR PRINCIPAL --}}
    <main class="flex-grow flex overflow-hidden relative z-10">
        
        {{-- PANEL IZQUIERDO: FORMULARIO INTERACTIVO --}}
        <div class="w-full lg:w-3/5 h-full overflow-y-auto custom-scroll p-6 md:p-12 lg:pl-20 pb-40">
            
            {{-- PASO 0: WELCOME SCREEN --}}
            <div x-show="step === 0" class="h-full flex flex-col justify-center items-start animate-fade-in-up max-w-2xl">
                <div class="w-16 h-1 bg-amber-500 mb-8 rounded-full"></div>
                <h1 class="text-5xl md:text-7xl font-black tracking-tighter leading-tight mb-6 text-zinc-900 dark:text-white">
                    Diseña la<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-amber-600">Experiencia Perfecta.</span>
                </h1>
                <p class="text-lg md:text-xl text-zinc-600 dark:text-zinc-400 mb-10 font-light leading-relaxed">
                    Bienvenido a nuestro configurador exclusivo. Personaliza cada detalle de tu evento, visualiza tu moodboard en tiempo real y crea una obra maestra.
                </p>
                <button @click="step = 1" class="group relative px-8 py-4 bg-zinc-900 dark:bg-white text-white dark:text-black font-black uppercase tracking-widest text-sm rounded-2xl overflow-hidden hover:scale-105 transition-all shadow-2xl hover:shadow-amber-500/30">
                    <div class="absolute inset-0 bg-amber-500 transform scale-x-0 origin-left group-hover:scale-x-100 transition-transform duration-500 ease-out"></div>
                    <span class="relative z-10 flex items-center gap-3">Comenzar a Diseñar <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg></span>
                </button>
            </div>

            {{-- PASO 1: PROTAGONISTAS --}}
            <div x-show="step === 1" x-cloak x-transition:enter="transition ease-out duration-500 delay-100" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0" class="max-w-2xl">
                <h2 class="text-sm font-black tracking-widest text-amber-500 uppercase mb-8">Paso 01 — Fundamentos</h2>
                
                <div class="space-y-10 mb-12">
                    <div class="group">
                        <label class="text-xs text-zinc-500 dark:text-zinc-400 uppercase tracking-widest font-bold mb-2 block group-focus-within:text-amber-500 transition-colors">¿A nombre de quién reservamos?</label>
                        <input type="text" x-model="event.clientName" class="input-luxury" placeholder="Ej. Familia Rodríguez o Empresa S.A.">
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <div class="group">
                            <label class="text-xs text-zinc-500 dark:text-zinc-400 uppercase tracking-widest font-bold mb-2 block group-focus-within:text-amber-500 transition-colors">Número de Contacto</label>
                            <input type="tel" x-model="event.phone" class="input-luxury" placeholder="+57 300 000 0000">
                        </div>
                        <div class="group">
                            <label class="text-xs text-zinc-500 dark:text-zinc-400 uppercase tracking-widest font-bold mb-2 block group-focus-within:text-amber-500 transition-colors">Fecha Deseada</label>
                            <input type="date" x-model="event.date" class="input-luxury">
                        </div>
                    </div>

                    <div class="group">
                        <label class="text-xs text-zinc-500 dark:text-zinc-400 uppercase tracking-widest font-bold mb-4 flex justify-between items-end">
                            <span>Magnitud del Evento (Invitados)</span> 
                            <span class="text-3xl text-amber-500 font-black" x-text="event.guests"></span>
                        </label>
                        <input type="range" min="30" max="1000" step="10" x-model="event.guests" class="w-full accent-amber-500 h-2 bg-zinc-200 dark:bg-zinc-800 rounded-lg appearance-none cursor-pointer">
                    </div>
                </div>

                <h3 class="text-xs text-zinc-500 dark:text-zinc-400 uppercase tracking-widest font-bold mb-4">Naturaleza de la Celebración</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3 mb-12">
                    <template x-for="t in ['Boda', '15 Años', 'Bautizo', 'Baby Shower', 'Cumpleaños', 'Corporativo']">
                        <button @click="event.type = t" :class="event.type === t ? 'bg-amber-500 border-amber-500 text-white dark:text-black shadow-[0_5px_20px_rgba(245,158,11,0.4)] scale-105' : 'glass-panel text-zinc-900 dark:text-white border border-zinc-200 dark:border-white/5 hover:border-amber-500/50'" class="py-5 rounded-2xl font-bold transition-all text-sm" x-text="t"></button>
                    </template>
                </div>
            </div>

            {{-- PASO 2: ATMÓSFERA Y BANQUETE --}}
            <div x-show="step === 2" x-cloak x-transition:enter="transition ease-out duration-500 delay-100" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0" class="max-w-2xl">
                <h2 class="text-sm font-black tracking-widest text-amber-500 uppercase mb-8">Paso 02 — Escenario & Gastronomía</h2>
                
                <div class="glass-panel p-8 rounded-3xl mb-8 relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-r from-amber-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                        <div>
                            <h3 class="font-black text-2xl text-zinc-900 dark:text-white mb-2">La Locación Principal</h3>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">El lienzo donde ocurrirá la magia.</p>
                        </div>
                        <button @click="openModal('Salones Exclusivos', 'salons', 'salon')" class="shrink-0 px-6 py-3 bg-zinc-900 dark:bg-white text-white dark:text-black font-bold text-xs uppercase tracking-widest rounded-xl hover:bg-amber-500 dark:hover:bg-amber-500 transition-colors shadow-xl">
                            <span x-text="event.salon ? 'Cambiar Espacio' : 'Seleccionar'"></span>
                        </button>
                    </div>
                    <div x-show="event.salon" x-collapse>
                        <div class="mt-6 pt-6 border-t border-zinc-200 dark:border-white/10 flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-amber-500/20 flex items-center justify-center text-amber-500"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg></div>
                            <div>
                                <div class="text-xs text-zinc-500 uppercase font-bold tracking-widest">Espacio Confirmado</div>
                                <div class="text-lg font-bold text-zinc-900 dark:text-white" x-text="event.salon?.name"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    {{-- Tarjeta Toggle Temática --}}
                    <div class="glass-panel p-6 rounded-3xl flex flex-col justify-between">
                        <div class="flex justify-between items-start mb-6">
                            <div><h3 class="font-bold text-xl text-zinc-900 dark:text-white">Estilo Visual</h3><p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">Concepto temático unificado</p></div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" x-model="wants.theme" class="sr-only toggle-checkbox">
                                <div class="w-12 h-6 bg-zinc-300 dark:bg-zinc-800 rounded-full toggle-label border border-zinc-200 dark:border-white/10 transition-colors"><div class="absolute top-[2px] left-[2px] bg-white w-5 h-5 rounded-full transition-transform shadow-md"></div></div>
                            </label>
                        </div>
                        <div x-show="wants.theme" x-collapse>
                            <button @click="openModal('Conceptos Temáticos', 'themes', 'theme')" class="w-full py-3 border border-amber-500 text-amber-600 dark:text-amber-500 rounded-xl text-xs font-bold uppercase tracking-widest hover:bg-amber-500 hover:text-white dark:hover:text-black transition flex items-center justify-center gap-2">
                                <span x-text="event.theme ? event.theme.name : 'Explorar Colección'"></span>
                            </button>
                        </div>
                    </div>

                    {{-- Catering Select --}}
                    <div class="glass-panel p-6 rounded-3xl">
                        <h3 class="font-bold text-xl mb-1 text-zinc-900 dark:text-white">Banquete & Menú</h3>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 mb-6">Estilo de alimentación para tus invitados</p>
                        
                        <div class="relative">
                            <select x-model="event.food" class="w-full bg-zinc-100 dark:bg-black/50 border border-zinc-200 dark:border-white/10 rounded-xl px-4 py-4 text-sm font-medium text-zinc-900 dark:text-white focus:border-amber-500 outline-none appearance-none cursor-pointer">
                                <option value="">Sin servicio de banquete</option>
                                <option value="Plato Típico">Plato Servido a la Mesa</option>
                                <option value="Buffet 2 Tipos">Buffet Premium (2 Carnes + Guarniciones)</option>
                                <option value="Solo Cristalería">Solo alquiler de cristalería fina</option>
                            </select>
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-zinc-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- PASO 3: DECORACIÓN Y ESCENOGRAFÍA --}}
            <div x-show="step === 3" x-cloak x-transition:enter="transition ease-out duration-500 delay-100" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0" class="max-w-3xl">
                <h2 class="text-sm font-black tracking-widest text-amber-500 uppercase mb-8">Paso 03 — Diseño de Interiores</h2>

                <div class="glass-panel p-6 md:p-8 rounded-3xl mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div>
                        <h3 class="font-black text-2xl text-zinc-900 dark:text-white mb-2">Trono Principal</h3>
                        <p class="text-sm text-zinc-500 dark:text-zinc-400">La sillería protagonista del evento.</p>
                        <div x-show="event.chair" class="mt-2 inline-block bg-amber-500/20 text-amber-600 dark:text-amber-400 px-3 py-1 rounded-full text-xs font-bold" x-text="event.chair?.name"></div>
                    </div>
                    <button @click="openModal('Sillas de Lujo', 'chairs', 'chair')" class="px-6 py-3 border-2 border-zinc-900 dark:border-white text-zinc-900 dark:text-white rounded-xl text-xs font-bold uppercase tracking-widest hover:bg-zinc-900 hover:text-white dark:hover:bg-white dark:hover:text-black transition">
                        <span x-text="event.chair ? 'Cambiar Elección' : 'Ver Catálogo'"></span>
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">
                    {{-- Backing --}}
                    <div class="glass-panel p-6 rounded-2xl flex flex-col justify-between">
                        <div class="flex justify-between items-center mb-4">
                            <div><h3 class="font-bold text-lg text-zinc-900 dark:text-white">Backing Fotográfico</h3><p class="text-xs text-zinc-500 mt-1">Estructura para el fondo perfecto</p></div>
                            <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="wants.backing" class="sr-only toggle-checkbox"><div class="w-10 h-5 bg-zinc-300 dark:bg-zinc-800 rounded-full toggle-label transition-colors"><div class="absolute top-[2px] left-[2px] bg-white w-4 h-4 rounded-full transition-transform shadow"></div></div></label>
                        </div>
                        <div x-show="wants.backing" x-collapse><button @click="openModal('Backings Estructurales', 'backings', 'backing')" class="mt-2 w-full py-2.5 bg-zinc-100 dark:bg-white/5 rounded-lg text-xs font-bold uppercase hover:bg-amber-500 hover:text-white transition" x-text="event.backing ? event.backing.name : 'Elegir Diseño'"></button></div>
                    </div>

                    {{-- Letras --}}
                    <div class="glass-panel p-6 rounded-2xl flex flex-col justify-between">
                        <div class="flex justify-between items-center mb-4">
                            <div><h3 class="font-bold text-lg text-zinc-900 dark:text-white">Iluminación Nominal</h3><p class="text-xs text-zinc-500 mt-1">Letras 3D gigantes o Neón</p></div>
                            <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="wants.illumName" class="sr-only toggle-checkbox"><div class="w-10 h-5 bg-zinc-300 dark:bg-zinc-800 rounded-full toggle-label transition-colors"><div class="absolute top-[2px] left-[2px] bg-white w-4 h-4 rounded-full transition-transform shadow"></div></div></label>
                        </div>
                        <div x-show="wants.illumName" x-collapse><button @click="openModal('Letras y Neón', 'illumNames', 'illumName')" class="mt-2 w-full py-2.5 bg-zinc-100 dark:bg-white/5 rounded-lg text-xs font-bold uppercase hover:bg-amber-500 hover:text-white transition" x-text="event.illumName ? event.illumName.name : 'Personalizar'"></button></div>
                    </div>

                    {{-- Centros de Mesa --}}
                    <div class="glass-panel p-6 rounded-2xl flex flex-col justify-between">
                        <div class="flex justify-between items-center mb-4">
                            <div><h3 class="font-bold text-lg text-zinc-900 dark:text-white">Centros de Mesa</h3><p class="text-xs text-zinc-500 mt-1">Arte floral para invitados</p></div>
                            <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="wants.centerpieces" class="sr-only toggle-checkbox"><div class="w-10 h-5 bg-zinc-300 dark:bg-zinc-800 rounded-full toggle-label transition-colors"><div class="absolute top-[2px] left-[2px] bg-white w-4 h-4 rounded-full transition-transform shadow"></div></div></label>
                        </div>
                        <div x-show="wants.centerpieces" x-collapse><button @click="openModal('Centros de Mesa', 'centerpieces', 'centerpiece')" class="mt-2 w-full py-2.5 bg-zinc-100 dark:bg-white/5 rounded-lg text-xs font-bold uppercase hover:bg-amber-500 hover:text-white transition" x-text="event.centerpiece ? event.centerpiece.name : 'Explorar'"></button></div>
                    </div>
                    
                    {{-- Camino --}}
                    <div class="glass-panel p-6 rounded-2xl flex flex-col justify-between">
                        <h3 class="font-bold text-lg text-zinc-900 dark:text-white mb-4">Paseo Triunfal</h3>
                        <div class="grid grid-cols-2 gap-2">
                            <button @click="event.carpet = 'Alfombra'" :class="event.carpet === 'Alfombra' ? 'bg-amber-500 text-white dark:text-black' : 'bg-zinc-100 dark:bg-zinc-800/50 text-zinc-600 dark:text-zinc-400'" class="py-2.5 text-[10px] font-bold uppercase rounded-lg transition">Alfombra</button>
                            <button @click="event.carpet = 'Pétalos'" :class="event.carpet === 'Pétalos' ? 'bg-amber-500 text-white dark:text-black' : 'bg-zinc-100 dark:bg-zinc-800/50 text-zinc-600 dark:text-zinc-400'" class="py-2.5 text-[10px] font-bold uppercase rounded-lg transition">Pétalos</button>
                        </div>
                    </div>
                </div>

                {{-- Toggles rápidos --}}
                <h3 class="text-xs text-zinc-500 uppercase font-bold tracking-widest mb-4">Detalles Adicionales</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <label class="glass-panel p-4 rounded-xl flex justify-between items-center cursor-pointer hover:border-amber-500/50 transition">
                        <span class="text-sm font-bold text-zinc-900 dark:text-white">Telas de Techo</span>
                        <input type="checkbox" x-model="wants.ceiling" class="w-4 h-4 accent-amber-500">
                    </label>
                    <label class="glass-panel p-4 rounded-xl flex justify-between items-center cursor-pointer hover:border-amber-500/50 transition">
                        <span class="text-sm font-bold text-zinc-900 dark:text-white">Cilindros Bases</span>
                        <input type="checkbox" x-model="wants.cylinders" class="w-4 h-4 accent-amber-500">
                    </label>
                    <label class="glass-panel p-4 rounded-xl flex justify-between items-center cursor-pointer hover:border-amber-500/50 transition">
                        <span class="text-sm font-bold text-zinc-900 dark:text-white">Pedestales</span>
                        <input type="checkbox" x-model="wants.pedestals" class="w-4 h-4 accent-amber-500">
                    </label>
                </div>
            </div>

            {{-- PASO 4: AUDIOVISUAL Y RECUERDOS --}}
            <div x-show="step === 4" x-cloak x-transition:enter="transition ease-out duration-500 delay-100" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0" class="max-w-3xl">
                <h2 class="text-sm font-black tracking-widest text-amber-500 uppercase mb-8">Paso 04 — Captura de Memorias</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">
                    <label class="glass-panel p-6 rounded-2xl cursor-pointer group hover:border-amber-500/50 transition-colors relative overflow-hidden">
                        <div class="absolute inset-0 bg-amber-500/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <div class="flex justify-between items-center mb-2 relative z-10">
                            <h3 class="font-bold text-xl text-zinc-900 dark:text-white">Fotografía Pro</h3>
                            <input type="checkbox" x-model="wants.photo" class="w-5 h-5 accent-amber-500 rounded">
                        </div>
                        <p class="text-sm text-zinc-500 relative z-10">Cobertura total, cámara profesional y fotolibro impreso.</p>
                    </label>
                    
                    <label class="glass-panel p-6 rounded-2xl cursor-pointer group hover:border-amber-500/50 transition-colors relative overflow-hidden">
                        <div class="absolute inset-0 bg-amber-500/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <div class="flex justify-between items-center mb-2 relative z-10">
                            <h3 class="font-bold text-xl text-zinc-900 dark:text-white">Cinematografía</h3>
                            <input type="checkbox" x-model="wants.video" class="w-5 h-5 accent-amber-500 rounded">
                        </div>
                        <p class="text-sm text-zinc-500 relative z-10">Video editado estilo cine. Entregado en USB de lujo.</p>
                    </label>

                    <label class="glass-panel p-6 rounded-2xl cursor-pointer group hover:border-amber-500/50 transition-colors relative overflow-hidden">
                        <div class="flex justify-between items-center mb-2 relative z-10">
                            <h3 class="font-bold text-lg text-zinc-900 dark:text-white">Retrato de Autor</h3>
                            <input type="checkbox" x-model="wants.portrait" class="w-5 h-5 accent-amber-500 rounded">
                        </div>
                        <p class="text-xs text-zinc-500 relative z-10">Cuadro enmarcado 50x70cm para exhibición en la entrada.</p>
                    </label>

                    <label class="glass-panel p-6 rounded-2xl cursor-pointer group hover:border-amber-500/50 transition-colors relative overflow-hidden">
                        <div class="flex justify-between items-center mb-2 relative z-10">
                            <h3 class="font-bold text-lg text-zinc-900 dark:text-white">Proyección (Beam)</h3>
                            <input type="checkbox" x-model="wants.beam" class="w-5 h-5 accent-amber-500 rounded">
                        </div>
                        <p class="text-xs text-zinc-500 relative z-10">Video beam de alta definición para tu historia.</p>
                    </label>
                </div>

                <h3 class="text-xs text-zinc-500 uppercase font-bold tracking-widest mb-4">Protocolo de Invitados</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="glass-panel p-5 rounded-2xl">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-bold text-zinc-900 dark:text-white">Recordatorios</h3>
                            <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="wants.reminders" class="sr-only toggle-checkbox"><div class="w-9 h-5 bg-zinc-300 dark:bg-zinc-800 rounded-full toggle-label transition-colors"><div class="absolute top-[2px] left-[2px] bg-white w-4 h-4 rounded-full transition"></div></div></label>
                        </div>
                        <div x-show="wants.reminders" x-collapse class="grid grid-cols-2 gap-2 mt-2">
                            <button @click="event.reminders = 'Transparente'" :class="event.reminders === 'Transparente' ? 'bg-amber-500 text-white dark:text-black' : 'bg-zinc-100 dark:bg-zinc-800/50 text-zinc-600 dark:text-zinc-400'" class="py-2 text-[10px] font-bold uppercase rounded-lg transition">Acrílico</button>
                            <button @click="event.reminders = 'Madera'" :class="event.reminders === 'Madera' ? 'bg-amber-500 text-white dark:text-black' : 'bg-zinc-100 dark:bg-zinc-800/50 text-zinc-600 dark:text-zinc-400'" class="py-2 text-[10px] font-bold uppercase rounded-lg transition">Madera</button>
                        </div>
                    </div>
                    
                    <div class="glass-panel p-5 rounded-2xl">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-bold text-zinc-900 dark:text-white">Invitaciones</h3>
                            <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="wants.invitations" class="sr-only toggle-checkbox"><div class="w-9 h-5 bg-zinc-300 dark:bg-zinc-800 rounded-full toggle-label transition-colors"><div class="absolute top-[2px] left-[2px] bg-white w-4 h-4 rounded-full transition"></div></div></label>
                        </div>
                        <div x-show="wants.invitations" x-collapse class="grid grid-cols-3 gap-1 mt-2">
                            <button @click="event.invitations = 'Foto'" :class="event.invitations === 'Foto' ? 'bg-amber-500 text-white dark:text-black' : 'bg-zinc-100 dark:bg-zinc-800/50 text-zinc-600 dark:text-zinc-400'" class="py-2 text-[9px] font-bold uppercase rounded-lg transition">E-Card</button>
                            <button @click="event.invitations = 'Video'" :class="event.invitations === 'Video' ? 'bg-amber-500 text-white dark:text-black' : 'bg-zinc-100 dark:bg-zinc-800/50 text-zinc-600 dark:text-zinc-400'" class="py-2 text-[9px] font-bold uppercase rounded-lg transition">Clip Animado</button>
                            <button @click="event.invitations = 'Física'" :class="event.invitations === 'Física' ? 'bg-amber-500 text-white dark:text-black' : 'bg-zinc-100 dark:bg-zinc-800/50 text-zinc-600 dark:text-zinc-400'" class="py-2 text-[9px] font-bold uppercase rounded-lg transition">Papel Fino</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- PASO 5: EXCLUSIVOS (Vestidos, Ramos, Quinceañero) --}}
            <div x-show="step === 5" x-cloak x-transition:enter="transition ease-out duration-500 delay-100" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0" class="max-w-2xl">
                <h2 class="text-sm font-black tracking-widest text-amber-500 uppercase mb-8">Paso 05 — Toques Finales <span class="text-zinc-500" x-text="'- ' + event.type"></span></h2>

                {{-- Regalos (Todos los eventos) --}}
                <div class="glass-panel p-8 rounded-3xl mb-8">
                    <label class="text-sm font-bold block mb-4 text-zinc-900 dark:text-white uppercase tracking-widest">Recepción de Obsequios</label>
                    <div class="grid grid-cols-3 gap-3">
                        <button @click="event.gifts = 'Lluvia de Sobres'" :class="event.gifts === 'Lluvia de Sobres' ? 'bg-amber-500 text-white dark:text-black shadow-lg shadow-amber-500/30' : 'bg-zinc-100 dark:bg-zinc-800/50 text-zinc-600 dark:text-zinc-400'" class="py-4 text-[10px] font-bold uppercase rounded-xl transition-all">Lluvia de Sobres</button>
                        <button @click="event.gifts = 'Mesa de Regalos'" :class="event.gifts === 'Mesa de Regalos' ? 'bg-amber-500 text-white dark:text-black shadow-lg shadow-amber-500/30' : 'bg-zinc-100 dark:bg-zinc-800/50 text-zinc-600 dark:text-zinc-400'" class="py-4 text-[10px] font-bold uppercase rounded-xl transition-all">Mesa de Regalos</button>
                        <button @click="event.gifts = 'N/A'" :class="event.gifts === 'N/A' ? 'bg-zinc-400 dark:bg-zinc-600 text-white' : 'bg-zinc-100 dark:bg-zinc-800/50 text-zinc-600 dark:text-zinc-400'" class="py-4 text-[10px] font-bold uppercase rounded-xl transition-all">No Aplica</button>
                    </div>
                </div>

                {{-- Solo visible si es 15 Años --}}
                <template x-if="event.type === '15 Años'">
                    <div class="glass-panel p-8 rounded-3xl mb-8 border border-pink-200 dark:border-pink-500/30 bg-gradient-to-br from-transparent to-pink-500/5">
                        <div class="flex justify-between items-center mb-6">
                            <div><h3 class="font-black text-2xl text-pink-600 dark:text-pink-400">Haute Couture</h3><p class="text-sm text-zinc-500 dark:text-zinc-400">Vestido de diseñador</p></div>
                            <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="wants.dress" class="sr-only toggle-checkbox"><div class="w-12 h-6 bg-zinc-300 dark:bg-zinc-800 rounded-full toggle-label border border-zinc-200 dark:border-white/10"><div class="absolute top-[2px] left-[2px] bg-white w-5 h-5 rounded-full transition-transform"></div></div></label>
                        </div>
                        <div x-show="wants.dress" x-collapse>
                            <button @click="openModal('Colección de Alta Costura', 'dresses', 'dress')" class="w-full py-4 bg-pink-600 text-white font-bold uppercase tracking-widest text-xs rounded-xl shadow-lg hover:shadow-pink-500/40 transition-all hover:-translate-y-1" x-text="event.dress ? 'Modificar Elección' : 'Abrir Atelier Virtual'"></button>
                            <div x-show="event.dress" class="mt-4 text-pink-600 dark:text-pink-400 text-sm text-center font-bold" x-text="'Selección: ' + event.dress?.name"></div>
                        </div>
                    </div>
                </template>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <label x-show="event.type === '15 Años' || event.type === 'Boda'" class="glass-panel p-5 rounded-2xl flex justify-between items-center cursor-pointer hover:border-amber-500/50">
                        <span class="font-bold text-sm text-zinc-900 dark:text-white">Ramos de Rosas</span>
                        <input type="checkbox" x-model="wants.roses" class="w-5 h-5 accent-amber-500">
                    </label>
                    <label x-show="event.type === '15 Años' || event.type === 'Boda'" class="glass-panel p-5 rounded-2xl flex justify-between items-center cursor-pointer hover:border-amber-500/50">
                        <span class="font-bold text-sm text-zinc-900 dark:text-white">Copas Decoradas</span>
                        <input type="checkbox" x-model="wants.decoratedGlasses" class="w-5 h-5 accent-amber-500">
                    </label>
                    <label x-show="event.type === '15 Años' || event.type === 'Cumpleaños'" class="glass-panel p-5 rounded-2xl flex justify-between items-center cursor-pointer hover:border-amber-500/50">
                        <span class="font-bold text-sm text-zinc-900 dark:text-white">Acompañante Chambelán</span>
                        <input type="checkbox" x-model="wants.quinceanero" class="w-5 h-5 accent-amber-500">
                    </label>
                    <label class="glass-panel p-5 rounded-2xl flex justify-between items-center cursor-pointer hover:border-amber-500/50">
                        <span class="font-bold text-sm text-zinc-900 dark:text-white">Libro de Firmas Fino</span>
                        <input type="checkbox" x-model="wants.guestbook" class="w-5 h-5 accent-amber-500">
                    </label>
                </div>
            </div>

        </div>

        {{-- BARRA DE NAVEGACIÓN FLOTANTE (Inferior) --}}
        <div class="fixed bottom-0 left-0 w-full lg:w-3/5 p-6 md:p-10 pointer-events-none z-30" x-show="step > 0" x-transition:enter="transition ease-out duration-700 delay-300" x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0">
            <div class="glass-panel rounded-full p-2 flex justify-between items-center pointer-events-auto max-w-2xl mx-auto shadow-2xl border border-zinc-200/50 dark:border-white/10 bg-white/80 dark:bg-zinc-900/80">
                <button @click="if(step > 1) step--" :class="step === 1 ? 'opacity-30 cursor-not-allowed' : 'hover:bg-zinc-100 dark:hover:bg-white/10'" class="w-12 h-12 rounded-full flex items-center justify-center text-zinc-900 dark:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                
                <div class="text-xs font-bold uppercase tracking-widest text-zinc-500" x-show="step < 5">Continuar Diseño</div>
                
                <button x-show="step < 5" @click="step++" class="px-8 py-3 bg-zinc-900 dark:bg-white text-white dark:text-black rounded-full text-xs font-bold uppercase tracking-widest hover:bg-amber-500 dark:hover:bg-amber-500 transition-colors shadow-lg">
                    Siguiente
                </button>
                
                <button x-show="step === 5" class="px-8 py-3 bg-gradient-to-r from-amber-500 to-amber-600 text-white font-black rounded-full text-xs uppercase tracking-widest hover:scale-105 transition-transform shadow-[0_0_20px_rgba(245,158,11,0.4)] flex items-center gap-2">
                    Generar Cotización <svg class="w-4 h-4 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </button>
            </div>
        </div>

        {{-- PANEL DERECHO: MOODBOARD INTERACTIVO --}}
        <div class="hidden lg:flex w-2/5 h-full relative border-l border-zinc-200 dark:border-white/10 bg-zinc-100/50 dark:bg-black/40 flex-col z-20">
            
            <div class="p-10 pb-4 shrink-0 glass-panel border-x-0 border-t-0 rounded-none z-10 bg-white/50 dark:bg-black/50">
                <h3 class="text-[10px] font-mono text-amber-600 dark:text-amber-500 uppercase tracking-widest mb-2 flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-ping absolute"></span>
                    <span class="w-2 h-2 rounded-full bg-amber-500 relative"></span>
                    Moodboard en Vivo
                </h3>
                <h2 class="text-3xl font-black text-zinc-900 dark:text-white tracking-tight" x-text="event.clientName || 'Tu Evento VIP'"></h2>
                <div class="flex gap-2 mt-4">
                    <span class="border border-zinc-300 dark:border-white/20 text-zinc-600 dark:text-zinc-300 px-3 py-1 rounded-full text-[10px] uppercase font-bold" x-text="event.type"></span>
                    <span class="border border-zinc-300 dark:border-white/20 text-zinc-600 dark:text-zinc-300 px-3 py-1 rounded-full text-[10px] uppercase font-bold" x-text="event.guests + ' Invitados'"></span>
                </div>
            </div>

            <div class="flex-grow overflow-y-auto custom-scroll p-10 relative">
                
                <div x-show="!event.salon && !event.theme && !event.chair && !event.backing && !event.illumName && !event.dress" class="absolute inset-0 flex flex-col items-center justify-center opacity-30 pointer-events-none">
                    <svg class="w-16 h-16 text-zinc-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <p class="text-sm font-mono tracking-widest uppercase">El lienzo está en blanco</p>
                </div>

                {{-- Collage de imágenes (Estilo Masonry) --}}
                <div class="columns-1 xl:columns-2 gap-4 space-y-4">
                    
                    <template x-if="event.salon">
                        <div class="moodboard-image relative group rounded-2xl overflow-hidden break-inside-avoid shadow-lg">
                            <img :src="event.salon.img" class="w-full h-auto object-cover group-hover:scale-105 transition duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                                <span class="text-xs font-bold text-white uppercase tracking-widest" x-text="'Locación: ' + event.salon.name"></span>
                            </div>
                        </div>
                    </template>
                    
                    <template x-if="wants.theme && event.theme">
                        <div class="moodboard-image relative group rounded-2xl overflow-hidden break-inside-avoid shadow-lg border-2 border-amber-500">
                            <img :src="event.theme.img" class="w-full h-auto object-cover group-hover:scale-105 transition duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                                <span class="text-xs font-bold text-amber-400 uppercase tracking-widest" x-text="'Temática: ' + event.theme.name"></span>
                            </div>
                        </div>
                    </template>
                    
                    <template x-if="event.chair">
                        <div class="moodboard-image relative group rounded-2xl overflow-hidden break-inside-avoid shadow-lg">
                            <img :src="event.chair.img" class="w-full h-auto object-cover group-hover:scale-105 transition duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                                <span class="text-xs font-bold text-white uppercase tracking-widest" x-text="'Sillería: ' + event.chair.name"></span>
                            </div>
                        </div>
                    </template>

                    <template x-if="wants.backing && event.backing">
                        <div class="moodboard-image relative group rounded-2xl overflow-hidden break-inside-avoid shadow-lg">
                            <img :src="event.backing.img" class="w-full h-auto object-cover group-hover:scale-105 transition duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                                <span class="text-xs font-bold text-white uppercase tracking-widest" x-text="'Backing: ' + event.backing.name"></span>
                            </div>
                        </div>
                    </template>

                    <template x-if="wants.illumName && event.illumName">
                        <div class="moodboard-image relative group rounded-2xl overflow-hidden break-inside-avoid shadow-lg">
                            <img :src="event.illumName.img" class="w-full h-auto object-cover group-hover:scale-105 transition duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                                <span class="text-xs font-bold text-white uppercase tracking-widest" x-text="'Neón: ' + event.illumName.name"></span>
                            </div>
                        </div>
                    </template>

                    <template x-if="wants.centerpieces && event.centerpiece">
                        <div class="moodboard-image relative group rounded-2xl overflow-hidden break-inside-avoid shadow-lg">
                            <img :src="event.centerpiece.img" class="w-full h-auto object-cover group-hover:scale-105 transition duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                                <span class="text-xs font-bold text-white uppercase tracking-widest" x-text="'Centros: ' + event.centerpiece.name"></span>
                            </div>
                        </div>
                    </template>

                    <template x-if="event.type === '15 Años' && wants.dress && event.dress">
                        <div class="moodboard-image relative group rounded-2xl overflow-hidden break-inside-avoid shadow-lg border-2 border-pink-500">
                            <img :src="event.dress.img" class="w-full h-auto object-cover group-hover:scale-105 transition duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                                <span class="text-xs font-bold text-pink-400 uppercase tracking-widest" x-text="'Vestido: ' + event.dress.name"></span>
                            </div>
                        </div>
                    </template>

                </div>

                {{-- Resumen de Servicios (Texto) --}}
                <div class="mt-8 pt-8 border-t border-zinc-200 dark:border-white/10" x-show="event.food || wants.photo || wants.video || event.carpet">
                    <h4 class="text-[10px] uppercase font-bold tracking-widest text-zinc-500 mb-4">Servicios Adicionales Incluidos</h4>
                    <ul class="space-y-2 text-sm text-zinc-700 dark:text-zinc-300 font-medium">
                        <li x-show="event.food" class="flex items-center gap-2"><span class="text-amber-500">◆</span> <span x-text="'Banquete: ' + event.food"></span></li>
                        <li x-show="wants.photo" class="flex items-center gap-2"><span class="text-amber-500">◆</span> Fotografía Profesional</li>
                        <li x-show="wants.video" class="flex items-center gap-2"><span class="text-amber-500">◆</span> Cinematografía (Video)</li>
                        <li x-show="event.carpet && event.carpet !== 'N/A'" class="flex items-center gap-2"><span class="text-amber-500">◆</span> <span x-text="'Camino: ' + event.carpet"></span></li>
                    </ul>
                </div>

            </div>
        </div>
    </main>
</section>
</section>

































