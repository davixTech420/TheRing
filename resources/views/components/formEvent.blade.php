{{-- ==========================================
         5. MOTOR DE DISEÑO PARAMÉTRICO (NIVEL EXPERTO)
    =========================================== --}}
    <section class="py-32 px-6 max-w-[95rem] mx-auto relative builder-section border-t border-zinc-200 dark:border-zinc-900 transition-colors duration-500">
        
        <div class="text-center mb-16 builder-header">
            <span class="text-amber-500 font-mono text-xs uppercase tracking-widest">The Ring / Studio</span>
            <h2 class="text-5xl md:text-7xl font-bold tracking-tight mt-2 text-zinc-900 dark:text-white">Diseño Sensorial</h2>
            <p class="text-zinc-600 dark:text-zinc-500 mt-4 max-w-2xl mx-auto font-light transition-colors duration-500">Renderiza la atmósfera de tu evento en tiempo real. Alta costura, arquitectura y tecnología integradas.</p>
        </div>
        
        <div x-data="{ 
                step: 1, 
                activeModal: null,
                modalTitle: '',
                activeCatalog: [],
                targetProp: '', 
                targetCategory: '',
                
                data: { 
                    type: 'Boda', title: '', guests: 150, 
                    salon: { name: 'Gran Salón Imperial', img: 'https://images.unsplash.com/photo-1519167758481-83f550bb49b3?q=80&w=1000' },
                    base: { chair: null, lighting: null },
                    quince: { dress: null, show: null, cake: null },
                    wedding: { ceremony: null, floral: null, music: null },
                    corp: { stage: null, mapping: null, catering: null }
                },
                
                openModal(title, catalogName, category, prop) {
                    this.modalTitle = title;
                    this.activeCatalog = this.catalogs[catalogName];
                    this.targetCategory = category;
                    this.targetProp = prop;
                    this.activeModal = true;
                },
                
                selectItem(item) {
                    this.data[this.targetCategory][this.targetProp] = item;
                    this.activeModal = null;
                },

                catalogs: {
                    chairs: [ { id: 'c1', name: 'Tiffany Oro', img: 'https://images.unsplash.com/photo-1532453288672-3a27e9be9efd?q=80&w=400' }, { id: 'c2', name: 'Imperial Velvet', img: 'https://images.unsplash.com/photo-1505236858219-8359eb29e329?q=80&w=400' }, { id: 'c3', name: 'Acrílica Ghost', img: 'https://images.unsplash.com/photo-1517457373958-b7bdd4587205?q=80&w=400' } ],
                    lighting: [ { id: 'l1', name: 'Cielo Estrellado', img: 'https://images.unsplash.com/photo-1512144804683-167817b1897e?q=80&w=600' }, { id: 'l2', name: 'Neón Club', img: 'https://images.unsplash.com/photo-1563841930606-67e2bce48b78?q=80&w=600' }, { id: 'l3', name: 'Lámparas Cristal', img: 'https://images.unsplash.com/photo-1572097963249-166c4295dcfa?q=80&w=600' } ],
                    
                    dresses: [ { id: 'd1', name: 'Princesa Rosa', img: 'https://images.unsplash.com/photo-1566162331599-563b7e735492?q=80&w=600' }, { id: 'd2', name: 'Esmeralda', img: 'https://images.unsplash.com/photo-1595777457583-95e059d581b8?q=80&w=600' }, { id: 'd3', name: 'Zafiro Estelar', img: 'https://images.unsplash.com/photo-1568252542512-9fe8df9c64fa?q=80&w=600' } ],
                    shows: [ { id: 'sh1', name: 'Coreografía Urbana', img: 'https://images.unsplash.com/photo-1547153760-18fc86324498?q=80&w=600' }, { id: 'sh2', name: 'Vals Clásico', img: 'https://images.unsplash.com/photo-1509660933844-6910e12f5ea6?q=80&w=600' } ],
                    cakes: [ { id: 'ck1', name: 'Torre Floral', img: 'https://images.unsplash.com/photo-1535254973040-607b474cb50d?q=80&w=600' }, { id: 'ck2', name: 'Glow en Oscuridad', img: 'https://images.unsplash.com/photo-1557925923-33b251dc3296?q=80&w=600' } ],
                    
                    ceremonies: [ { id: 'ce1', name: 'Altar Floral Blanco', img: 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?q=80&w=600' }, { id: 'ce2', name: 'Arco Rústico Boho', img: 'https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?q=80&w=600' } ],
                    florals: [ { id: 'fl1', name: 'Jardín Suspendido', img: 'https://images.unsplash.com/photo-1530103862676-de3c9a728f4d?q=80&w=600' }, { id: 'fl2', name: 'Rosas Rojas Clásicas', img: 'https://images.unsplash.com/photo-1523688881335-e105eaf77014?q=80&w=600' } ],
                    
                    stages: [ { id: 'st1', name: 'Pantalla LED 360', img: 'https://images.unsplash.com/photo-1505373877841-8d25f7d46678?q=80&w=600' }, { id: 'st2', name: 'Tarima Ejecutiva', img: 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=600' } ],
                    mapping: [ { id: 'mp1', name: 'Video Mapping 3D', img: 'https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?q=80&w=600' }, { id: 'mp2', name: 'Túnel Láser', img: 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=600' } ]
                }
            }" 
            class="relative w-full">
            
            {{-- MODAL A PANTALLA COMPLETA --}}
            <div x-show="activeModal" x-cloak 
                 x-transition:enter="transition ease-[cubic-bezier(0.16,1,0.3,1)] duration-700" 
                 x-transition:enter-start="opacity-0 backdrop-blur-none" 
                 x-transition:enter-end="opacity-100 backdrop-blur-2xl" 
                 x-transition:leave="transition ease-in duration-300" 
                 x-transition:leave-start="opacity-100" 
                 x-transition:leave-end="opacity-0" 
                 class="fixed inset-0 z-[100] bg-zinc-950/90 flex flex-col overflow-y-auto">
                
                <div class="p-8 flex justify-between items-center sticky top-0 bg-zinc-950/50 backdrop-blur-md border-b border-white/10 z-10">
                    <h3 class="text-3xl font-black text-white uppercase tracking-widest" x-text="modalTitle"></h3>
                    <button @click="activeModal = null" class="w-12 h-12 bg-white/10 hover:bg-white/20 hover:scale-110 rounded-full flex items-center justify-center text-white transition-all"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                </div>
                
                <div class="p-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto w-full">
                    <template x-for="(item, index) in activeCatalog" :key="item.id">
                        <div @click="selectItem(item)" 
                             class="cursor-pointer group relative rounded-[2rem] overflow-hidden ring-1 ring-white/10 hover:ring-amber-500 transition-all duration-500 h-[450px]"
                             :style="`animation: slideUp 0.6s cubic-bezier(0.16,1,0.3,1) forwards ${index * 0.1}s; opacity: 0; transform: translateY(30px);`">
                            <img :src="item.img" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-[1.5s] ease-[cubic-bezier(0.16,1,0.3,1)]">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent flex items-end p-8">
                                <h4 class="text-white font-bold text-2xl uppercase tracking-widest transform group-hover:-translate-y-2 transition-transform duration-500" x-text="item.name"></h4>
                            </div>
                            <div x-show="data[targetCategory][targetProp]?.id === item.id" class="absolute top-6 right-6 bg-amber-500 text-black text-xs font-black px-4 py-2 rounded-full uppercase tracking-widest shadow-lg">Seleccionado</div>
                        </div>
                    </template>
                </div>
            </div>

            <style>
                @keyframes slideUp { to { opacity: 1; transform: translateY(0); } }
            </style>

            {{-- INTERFAZ PRINCIPAL DEL CONFIGURADOR (AQUÍ ESTÁ LA CLASE DE GSAP form-interactive-container) --}}
            <div class="bg-white/80 dark:bg-zinc-950/80 border border-zinc-200 dark:border-zinc-800 rounded-[3rem] p-4 md:p-6 backdrop-blur-2xl shadow-2xl overflow-hidden relative transition-colors duration-500 form-interactive-container">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 relative z-10 h-[850px]">
                    
                    {{-- ============================================== --}}
                    {{-- COLUMNA IZQUIERDA: PANEL DE CONTROL MULTI-FASE --}}
                    {{-- ============================================== --}}
                    <div class="lg:col-span-6 relative h-full flex flex-col bg-zinc-50 dark:bg-zinc-900/50 rounded-[2rem] border border-zinc-200 dark:border-zinc-800 p-6 overflow-hidden transition-colors duration-500">
                        
                        {{-- MENÚ SUPERIOR DE PASOS --}}
                        <div class="flex gap-2 mb-8 bg-white dark:bg-zinc-950 p-2 rounded-full border border-zinc-200 dark:border-zinc-800 transition-colors duration-500">
                            <button @click="step = 1" :class="step === 1 ? 'bg-amber-500 text-zinc-950 shadow-lg' : 'text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white'" class="flex-1 py-2 text-xs font-bold uppercase tracking-widest rounded-full transition-all duration-500">1. Perfil</button>
                            <button @click="step = 2" :class="step === 2 ? 'bg-amber-500 text-zinc-950 shadow-lg' : 'text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white'" class="flex-1 py-2 text-xs font-bold uppercase tracking-widest rounded-full transition-all duration-500">2. Espacio</button>
                            <button @click="step = 3" :class="step === 3 ? 'bg-amber-500 text-zinc-950 shadow-lg' : 'text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white'" class="flex-1 py-2 text-xs font-bold uppercase tracking-widest rounded-full transition-all duration-500">3. Diseño</button>
                        </div>

                        <div class="relative flex-grow overflow-hidden">
                            {{-- FASE 1: PERFIL --}}
                            <div x-show="step === 1" x-transition:enter="transition ease-[cubic-bezier(0.16,1,0.3,1)] duration-700" x-transition:enter-start="opacity-0 -translate-x-12" x-transition:enter-end="opacity-100 translate-x-0" class="absolute inset-0 flex flex-col">
                                <h3 class="text-3xl font-bold mb-6 text-zinc-900 dark:text-white transition-colors duration-500">¿Qué celebramos?</h3>
                                <div class="grid grid-cols-3 gap-3 mb-6">
                                    <template x-for="type in ['15 Años', 'Boda', 'Corporativo']">
                                        <button @click="data.type = type" :class="data.type === type ? 'bg-amber-500 text-zinc-950 border-amber-500 shadow-[0_0_15px_rgba(245,158,11,0.3)]' : 'bg-white dark:bg-zinc-950 text-zinc-600 dark:text-zinc-400 border-zinc-200 dark:border-zinc-800 hover:border-amber-500'" class="py-4 border rounded-2xl text-xs font-bold uppercase tracking-widest transition-all duration-300" x-text="type"></button>
                                    </template>
                                </div>
                                <div class="space-y-4">
                                    <div><label class="block text-xs font-bold uppercase tracking-widest text-zinc-500 mb-2">Nombre del Evento</label><input type="text" x-model="data.title" class="w-full bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 rounded-xl px-5 py-4 text-zinc-900 dark:text-white focus:border-amber-500 transition-colors outline-none"></div>
                                    <div><label class="flex justify-between text-xs font-bold uppercase tracking-widest text-zinc-500 mb-2"><span>Aforo</span><span class="text-amber-500" x-text="data.guests + ' Pax'"></span></label><input type="range" min="50" max="1000" step="10" x-model="data.guests" class="w-full accent-amber-500 bg-zinc-200 dark:bg-zinc-800 h-1.5 rounded-lg cursor-pointer"></div>
                                </div>
                                <button @click="step = 2" class="mt-auto w-full py-4 bg-zinc-900 dark:bg-white text-white dark:text-zinc-950 font-bold uppercase tracking-widest text-sm rounded-xl hover:scale-[1.02] transition-all">Siguiente Fase ➔</button>
                            </div>

                            {{-- FASE 2: ARQUITECTURA --}}
                            <div x-show="step === 2" x-cloak x-transition:enter="transition ease-[cubic-bezier(0.16,1,0.3,1)] duration-700" x-transition:enter-start="opacity-0 translate-x-12" x-transition:enter-end="opacity-100 translate-x-0" class="absolute inset-0 flex flex-col space-y-6 overflow-y-auto custom-scrollbar pr-2">
                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-widest text-zinc-500 mb-3">Ambiente de Iluminación</label>
                                    <div class="grid grid-cols-3 gap-3">
                                        <template x-for="item in catalogs.lighting">
                                            <div @click="data.base.lighting = item" :class="data.base.lighting?.id === item.id ? 'ring-2 ring-amber-500' : 'opacity-70 hover:opacity-100'" class="cursor-pointer rounded-xl overflow-hidden relative h-20 transition-all"><img :src="item.img" class="w-full h-full object-cover"><div class="absolute inset-0 bg-black/40 flex items-center justify-center p-1"><span class="text-[9px] font-bold text-white uppercase text-center drop-shadow-md" x-text="item.name"></span></div></div>
                                        </template>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-widest text-zinc-500 mb-3">Sillería Principal</label>
                                    <div class="grid grid-cols-3 gap-3">
                                        <template x-for="item in catalogs.chairs">
                                            <div @click="data.base.chair = item" :class="data.base.chair?.id === item.id ? 'ring-2 ring-amber-500' : 'opacity-70 hover:opacity-100'" class="cursor-pointer rounded-xl overflow-hidden relative h-20 transition-all"><img :src="item.img" class="w-full h-full object-cover"><div class="absolute inset-0 bg-black/40 flex items-center justify-center p-1"><span class="text-[9px] font-bold text-white uppercase text-center drop-shadow-md" x-text="item.name"></span></div></div>
                                        </template>
                                    </div>
                                </div>
                                <button @click="step = 3" class="mt-auto w-full py-4 bg-zinc-900 dark:bg-white text-white dark:text-zinc-950 font-bold uppercase tracking-widest text-sm rounded-xl hover:scale-[1.02] transition-all">Ir a Personalización Avanzada ➔</button>
                            </div>

                            {{-- FASE 3: HIPER-PERSONALIZACIÓN POR EVENTO --}}
                            <div x-show="step === 3" x-cloak x-transition:enter="transition ease-[cubic-bezier(0.16,1,0.3,1)] duration-700" x-transition:enter-start="opacity-0 translate-x-12" x-transition:enter-end="opacity-100 translate-x-0" class="absolute inset-0 flex flex-col space-y-4 overflow-y-auto custom-scrollbar pr-2 pb-10">
                                <h3 class="text-2xl font-bold mb-2 text-zinc-900 dark:text-white transition-colors duration-500">Curaduría <span class="text-amber-500" x-text="data.type"></span></h3>
                                <p class="text-xs text-zinc-500 mb-6">Abre los catálogos para inyectar elementos al Moodboard visual.</p>
                                
                                {{-- BLOQUE 15 AÑOS --}}
                                <div x-show="data.type === '15 Años'" class="space-y-4">
                                    <button @click="openModal('Alta Costura', 'dresses', 'quince', 'dress')" class="w-full p-5 bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 hover:border-pink-500 rounded-2xl flex justify-between items-center group transition-colors">
                                        <div class="text-left"><span class="block text-xs font-mono text-zinc-500 mb-1">Módulo 01</span><span class="font-bold text-zinc-900 dark:text-white group-hover:text-pink-500 transition-colors">Diseño de Vestido</span></div>
                                        <div class="w-10 h-10 rounded-full bg-zinc-100 dark:bg-zinc-900 group-hover:bg-pink-500/20 flex items-center justify-center text-zinc-400 group-hover:text-pink-500"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg></div>
                                    </button>
                                    <button @click="openModal('Entretenimiento', 'shows', 'quince', 'show')" class="w-full p-5 bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 hover:border-pink-500 rounded-2xl flex justify-between items-center group transition-colors">
                                        <div class="text-left"><span class="block text-xs font-mono text-zinc-500 mb-1">Módulo 02</span><span class="font-bold text-zinc-900 dark:text-white group-hover:text-pink-500 transition-colors">Show Coreográfico</span></div>
                                        <div class="w-10 h-10 rounded-full bg-zinc-100 dark:bg-zinc-900 flex items-center justify-center text-zinc-400 group-hover:text-pink-500"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg></div>
                                    </button>
                                    <button @click="openModal('Repostería', 'cakes', 'quince', 'cake')" class="w-full p-5 bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 hover:border-pink-500 rounded-2xl flex justify-between items-center group transition-colors">
                                        <div class="text-left"><span class="block text-xs font-mono text-zinc-500 mb-1">Módulo 03</span><span class="font-bold text-zinc-900 dark:text-white group-hover:text-pink-500 transition-colors">Pastel Estructural</span></div>
                                        <div class="w-10 h-10 rounded-full bg-zinc-100 dark:bg-zinc-900 flex items-center justify-center text-zinc-400 group-hover:text-pink-500"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg></div>
                                    </button>
                                </div>

                                {{-- BLOQUE BODA --}}
                                <div x-show="data.type === 'Boda'" class="space-y-4">
                                    <button @click="openModal('Arquitectura Efímera', 'ceremonies', 'wedding', 'ceremony')" class="w-full p-5 bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 hover:border-amber-500 rounded-2xl flex justify-between items-center group transition-colors">
                                        <div class="text-left"><span class="block text-xs font-mono text-zinc-500 mb-1">Módulo 01</span><span class="font-bold text-zinc-900 dark:text-white group-hover:text-amber-500 transition-colors">Altar / Ceremonia</span></div>
                                        <div class="w-10 h-10 rounded-full bg-zinc-100 dark:bg-zinc-900 flex items-center justify-center text-zinc-400 group-hover:text-amber-500"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg></div>
                                    </button>
                                    <button @click="openModal('Diseño Botánico', 'florals', 'wedding', 'floral')" class="w-full p-5 bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 hover:border-amber-500 rounded-2xl flex justify-between items-center group transition-colors">
                                        <div class="text-left"><span class="block text-xs font-mono text-zinc-500 mb-1">Módulo 02</span><span class="font-bold text-zinc-900 dark:text-white group-hover:text-amber-500 transition-colors">Concepto Floral</span></div>
                                        <div class="w-10 h-10 rounded-full bg-zinc-100 dark:bg-zinc-900 flex items-center justify-center text-zinc-400 group-hover:text-amber-500"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg></div>
                                    </button>
                                </div>

                                {{-- BLOQUE CORPORATIVO --}}
                                <div x-show="data.type === 'Corporativo'" class="space-y-4">
                                    <button @click="openModal('Estructuras', 'stages', 'corp', 'stage')" class="w-full p-5 bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 hover:border-blue-500 rounded-2xl flex justify-between items-center group transition-colors">
                                        <div class="text-left"><span class="block text-xs font-mono text-zinc-500 mb-1">Módulo 01</span><span class="font-bold text-zinc-900 dark:text-white group-hover:text-blue-500 transition-colors">Tarima y Pantallas</span></div>
                                        <div class="w-10 h-10 rounded-full bg-zinc-100 dark:bg-zinc-900 flex items-center justify-center text-zinc-400 group-hover:text-blue-500"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg></div>
                                    </button>
                                    <button @click="openModal('Inmersión', 'mapping', 'corp', 'mapping')" class="w-full p-5 bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 hover:border-blue-500 rounded-2xl flex justify-between items-center group transition-colors">
                                        <div class="text-left"><span class="block text-xs font-mono text-zinc-500 mb-1">Módulo 02</span><span class="font-bold text-zinc-900 dark:text-white group-hover:text-blue-500 transition-colors">Video Mapping 3D</span></div>
                                        <div class="w-10 h-10 rounded-full bg-zinc-100 dark:bg-zinc-900 flex items-center justify-center text-zinc-400 group-hover:text-blue-500"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg></div>
                                    </button>
                                </div>
                                
                                <button class="mt-8 w-full py-5 bg-gradient-to-r from-amber-500 to-orange-500 text-zinc-950 font-black uppercase tracking-widest text-sm rounded-xl hover:scale-[1.02] transition-transform shadow-[0_0_20px_rgba(245,158,11,0.3)]">Finalizar y Cotizar</button>
                            </div>
                        </div>
                    </div>

                    {{-- ============================================== --}}
                    {{-- COLUMNA DERECHA: EL LIENZO DE RENDERIZADO VISUAL (SIEMPRE FONDO NEGRO POR LAS LUCES) --}}
                    {{-- ============================================== --}}
                    <div class="lg:col-span-6 relative rounded-[2rem] overflow-hidden border border-zinc-200 dark:border-zinc-800 bg-black flex flex-col shadow-2xl transition-colors duration-500">
                        
                        {{-- Capa 0: Fondo Salón --}}
                        <div class="absolute inset-0 bg-cover bg-center transition-all duration-[2s] ease-[cubic-bezier(0.16,1,0.3,1)] opacity-50 blur-[2px]" :style="`background-image: url('${data.salon.img}');`"></div>
                        
                        {{-- Capa 1: Iluminación Global (Mix Blend Screen) --}}
                        <div x-show="data.base.lighting" x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="absolute inset-0 mix-blend-screen z-10">
                            <img :src="data.base.lighting?.img" class="w-full h-full object-cover opacity-80" alt="Light">
                        </div>

                        {{-- Capa 2: Elementos Inyectados (GSAP Feel Animations) --}}
                        
                        {{-- Vestido (15 Años) --}}
                        <div x-show="data.type === '15 Años' && data.quince.dress" x-transition:enter="transition ease-[cubic-bezier(0.16,1,0.3,1)] duration-[1.5s]" x-transition:enter-start="opacity-0 -translate-x-20 scale-90" x-transition:enter-end="opacity-100 translate-x-0 scale-100" class="absolute left-6 bottom-6 top-24 w-[45%] rounded-2xl overflow-hidden shadow-2xl border border-white/10 z-20">
                            <img :src="data.quince.dress?.img" class="w-full h-full object-cover">
                            <div class="absolute bottom-0 w-full bg-black/50 backdrop-blur-md p-3"><span class="text-white text-[10px] uppercase font-bold tracking-widest block text-center" x-text="data.quince.dress?.name"></span></div>
                        </div>

                        {{-- Altar (Boda) --}}
                        <div x-show="data.type === 'Boda' && data.wedding.ceremony" x-transition:enter="transition ease-[cubic-bezier(0.16,1,0.3,1)] duration-[1.5s]" x-transition:enter-start="opacity-0 scale-75" x-transition:enter-end="opacity-100 scale-100" class="absolute inset-x-6 top-24 bottom-32 rounded-2xl overflow-hidden shadow-2xl border border-white/10 z-20">
                            <img :src="data.wedding.ceremony?.img" class="w-full h-full object-cover opacity-90">
                            <div class="absolute top-4 left-4 bg-black/80 px-4 py-2 rounded-full backdrop-blur-md"><span class="text-white text-[10px] uppercase font-bold tracking-widest">Ceremonia</span></div>
                        </div>

                        {{-- Tarima (Corp) --}}
                        <div x-show="data.type === 'Corporativo' && data.corp.stage" x-transition:enter="transition ease-[cubic-bezier(0.16,1,0.3,1)] duration-[1.5s]" x-transition:enter-start="opacity-0 translate-y-32" x-transition:enter-end="opacity-100 translate-y-0" class="absolute inset-x-6 bottom-6 h-1/2 rounded-2xl overflow-hidden shadow-2xl border border-blue-500/30 z-20">
                            <img :src="data.corp.stage?.img" class="w-full h-full object-cover">
                        </div>

                        {{-- Capa 3: Silla Flotante (Polaroid) --}}
                        <div x-show="data.base.chair" x-transition:enter="transition ease-[cubic-bezier(0.34,1.56,0.64,1)] duration-1000" x-transition:enter-start="opacity-0 rotate-[20deg] scale-50 translate-x-32" x-transition:enter-end="opacity-100 rotate-[-6deg] scale-100 translate-x-0" class="absolute right-6 bottom-16 w-32 h-40 bg-white p-2 pb-8 shadow-[0_20px_50px_rgba(0,0,0,0.5)] rounded-sm z-30">
                            <img :src="data.base.chair?.img" class="w-full h-full object-cover bg-zinc-100">
                            <span class="text-[9px] font-bold text-black uppercase tracking-widest absolute bottom-2.5 left-0 w-full text-center" x-text="data.base.chair?.name"></span>
                        </div>

                        {{-- HUD Superior (UI superpuesta) --}}
                        <div class="absolute top-0 left-0 w-full p-6 z-40 bg-gradient-to-b from-black/80 to-transparent flex justify-between items-start pointer-events-none">
                            <div>
                                <span class="bg-amber-500 text-black text-[9px] font-bold px-3 py-1 rounded-full uppercase tracking-widest inline-block mb-2 shadow-[0_0_15px_rgba(245,158,11,0.5)]" x-text="data.type"></span>
                                <h4 class="text-white text-3xl font-bold leading-none drop-shadow-lg" x-text="data.title || 'Lienzo en Blanco'"></h4>
                            </div>
                            <div class="flex items-center gap-2 bg-black/50 backdrop-blur-md border border-white/10 px-3 py-1.5 rounded-full">
                                <div class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></div><span class="text-white text-[10px] font-mono uppercase tracking-widest">Render Activo</span>
                            </div>
                        </div>
                        
                        {{-- Estado Vacío --}}
                        <div x-show="!data.base.chair && !data.base.lighting && !data.quince.dress && !data.wedding.ceremony && !data.corp.stage" class="absolute inset-0 flex flex-col items-center justify-center text-zinc-400 z-0">
                            <svg class="w-16 h-16 mb-4 opacity-30 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path></svg>
                            <p class="text-sm font-mono tracking-widest uppercase text-white/50">Esperando instrucciones...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>