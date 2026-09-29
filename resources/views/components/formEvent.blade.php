<!-- 
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
            
            // 1. ESTRUCTURA DE DATOS (Mapea con la Base de Datos)
            data: { 
                // Tabla Events & Users
                type: 'Boda', title: '', phone: '', date: '', guests: 150, 
                // Relaciones Event_Salons
                salon: { name: 'Gran Salón Imperial', img: 'https://images.unsplash.com/photo-1519167758481-83f550bb49b3?q=80&w=1000' },
                // JSON Custom Details (Opciones de texto/selects)
                details: { reminder: null, invitation: null, food: null },
                // Relaciones Event_Services (Servicios visuales y físicos)
                base: { chair: null, lighting: null, theme: null },
                media: { photo: null, video: null, portrait: null, beam: null },
                quince: { dress: null, show: null, cake: null },
                wedding: { ceremony: null, floral: null, music: null },
                corp: { stage: null, mapping: null, catering: null }
            },

            // 2. TOGGLES SÍ/NO (Controlan la visibilidad de las opciones)
            toggles: {
                wantsTheme: false,
                wantsPhoto: false,
                wantsVideo: false,
                wantsPortrait: false,
                wantsBeam: false,
                wantsReminders: false,
                wantsInvitations: false,
                wantsFood: false,
                wantsDress: false
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

            // 3. CATÁLOGOS CON FOTOS Y DESCRIPCIONES (Esto vendrá de tu tabla 'services')
            catalogs: {
                themes: [ { id: 'th1', name: 'Neón Party', desc: 'Luces UV y colores vibrantes', img: 'https://images.unsplash.com/photo-1563841930606-67e2bce48b78?q=80&w=600' }, { id: 'th2', name: 'Gatsby Años 20', desc: 'Elegancia, dorado y negro', img: 'https://images.unsplash.com/photo-1566737236500-c8ac43014a67?q=80&w=600' } ],
                photos: [ { id: 'ph1', name: 'Paquete Premium', desc: '50 fotos impresas, fotógrafo profesional y álbum de lujo.', img: 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?q=80&w=600' } ],
                videos: [ { id: 'vi1', name: 'Cinematografía', desc: 'USB con video editado tipo cine, entrega 1 mes después.', img: 'https://images.unsplash.com/photo-1601506521937-0121a7fc2a6b?q=80&w=600' } ],
                portraits: [ { id: 'po1', name: 'Retrato Imperial', desc: 'Cuadro 50x70 con marco flotante elegante.', img: 'https://images.unsplash.com/photo-1579546929518-9e396f3cc809?q=80&w=600' } ],
                beams: [ { id: 'bm1', name: 'Proyección Emotiva', desc: 'Video Beam HD. El cliente envía las fotos y la canción.', img: 'https://images.unsplash.com/photo-1505373877841-8d25f7d46678?q=80&w=600' } ],
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
                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent flex flex-col justify-end p-8">
                            <h4 class="text-white font-bold text-2xl uppercase tracking-widest transform group-hover:-translate-y-2 transition-transform duration-500" x-text="item.name"></h4>
                            {{-- Descripción extraída de la BD --}}
                            <p x-show="item.desc" class="text-white/70 text-sm mt-2 transform opacity-0 group-hover:opacity-100 group-hover:-translate-y-2 transition-all duration-500 delay-100" x-text="item.desc"></p>
                        </div>
                        <div x-show="data[targetCategory][targetProp]?.id === item.id" class="absolute top-6 right-6 bg-amber-500 text-black text-xs font-black px-4 py-2 rounded-full uppercase tracking-widest shadow-lg">Seleccionado</div>
                    </div>
                </template>
            </div>
        </div>

        <style>
            @keyframes slideUp { to { opacity: 1; transform: translateY(0); } }
            /* Estilo para el Toggle Switch personalizado */
            .toggle-checkbox:checked { right: 0; border-color: #f59e0b; }
            .toggle-checkbox:checked + .toggle-label { background-color: #f59e0b; }
        </style>

        {{-- INTERFAZ PRINCIPAL DEL CONFIGURADOR --}}
        <div class="bg-white/80 dark:bg-zinc-950/80 border border-zinc-200 dark:border-zinc-800 rounded-[3rem] p-4 md:p-6 backdrop-blur-2xl shadow-2xl overflow-hidden relative transition-colors duration-500 form-interactive-container">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 relative z-10 h-[850px]">
                
                {{-- ============================================== --}}
                {{-- COLUMNA IZQUIERDA: PANEL DE CONTROL MULTI-FASE --}}
                {{-- ============================================== --}}
                <div class="lg:col-span-6 relative h-full flex flex-col bg-zinc-50 dark:bg-zinc-900/50 rounded-[2rem] border border-zinc-200 dark:border-zinc-800 p-6 overflow-hidden transition-colors duration-500">
                    
                    {{-- MENÚ SUPERIOR DE 4 PASOS --}}
                    <div class="flex gap-1 mb-8 bg-white dark:bg-zinc-950 p-1.5 rounded-full border border-zinc-200 dark:border-zinc-800 transition-colors duration-500 overflow-x-auto">
                        <button @click="step = 1" :class="step === 1 ? 'bg-amber-500 text-zinc-950 shadow-lg' : 'text-zinc-500 hover:text-zinc-900 dark:hover:text-white'" class="flex-1 py-2 px-3 text-[10px] md:text-xs font-bold uppercase tracking-widest rounded-full transition-all duration-500 whitespace-nowrap">1. Perfil</button>
                        <button @click="step = 2" :class="step === 2 ? 'bg-amber-500 text-zinc-950 shadow-lg' : 'text-zinc-500 hover:text-zinc-900 dark:hover:text-white'" class="flex-1 py-2 px-3 text-[10px] md:text-xs font-bold uppercase tracking-widest rounded-full transition-all duration-500 whitespace-nowrap">2. Espacio</button>
                        <button @click="step = 3" :class="step === 3 ? 'bg-amber-500 text-zinc-950 shadow-lg' : 'text-zinc-500 hover:text-zinc-900 dark:hover:text-white'" class="flex-1 py-2 px-3 text-[10px] md:text-xs font-bold uppercase tracking-widest rounded-full transition-all duration-500 whitespace-nowrap">3. Servicios</button>
                        <button @click="step = 4" :class="step === 4 ? 'bg-amber-500 text-zinc-950 shadow-lg' : 'text-zinc-500 hover:text-zinc-900 dark:hover:text-white'" class="flex-1 py-2 px-3 text-[10px] md:text-xs font-bold uppercase tracking-widest rounded-full transition-all duration-500 whitespace-nowrap">4. Diseño</button>
                    </div>

                    <div class="relative flex-grow overflow-hidden">
                        {{-- FASE 1: PERFIL (Campos BD: Name, Phone, Date, Guests, Type) --}}
                        <div x-show="step === 1" x-transition:enter="transition ease-[cubic-bezier(0.16,1,0.3,1)] duration-700" x-transition:enter-start="opacity-0 -translate-x-12" x-transition:enter-end="opacity-100 translate-x-0" class="absolute inset-0 flex flex-col overflow-y-auto custom-scrollbar pr-2 pb-6">
                            <h3 class="text-3xl font-bold mb-6 text-zinc-900 dark:text-white transition-colors duration-500">¿Qué celebramos?</h3>
                            
                            <div class="grid grid-cols-3 gap-3 mb-6">
                                <template x-for="type in ['15 Años', 'Boda', 'Corporativo', 'Bautizo']">
                                    <button @click="data.type = type" :class="data.type === type ? 'bg-amber-500 text-zinc-950 border-amber-500 shadow-[0_0_15px_rgba(245,158,11,0.3)]' : 'bg-white dark:bg-zinc-950 text-zinc-600 dark:text-zinc-400 border-zinc-200 dark:border-zinc-800 hover:border-amber-500'" class="py-4 border rounded-2xl text-xs font-bold uppercase tracking-widest transition-all duration-300" x-text="type"></button>
                                </template>
                            </div>
                            
                            <div class="space-y-4">
                                <div><label class="block text-xs font-bold uppercase tracking-widest text-zinc-500 mb-2">Nombre del Evento</label><input type="text" x-model="data.title" class="w-full bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 rounded-xl px-5 py-4 text-zinc-900 dark:text-white focus:border-amber-500 transition-colors outline-none"></div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div><label class="block text-xs font-bold uppercase tracking-widest text-zinc-500 mb-2">Teléfono Cliente</label><input type="tel" x-model="data.phone" class="w-full bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 rounded-xl px-5 py-4 text-zinc-900 dark:text-white focus:border-amber-500 transition-colors outline-none"></div>
                                    <div><label class="block text-xs font-bold uppercase tracking-widest text-zinc-500 mb-2">Fecha Evento</label><input type="date" x-model="data.date" class="w-full bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 rounded-xl px-5 py-4 text-zinc-900 dark:text-white focus:border-amber-500 transition-colors outline-none"></div>
                                </div>
                                <div><label class="flex justify-between text-xs font-bold uppercase tracking-widest text-zinc-500 mb-2"><span>Aforo</span><span class="text-amber-500" x-text="data.guests + ' Invitados'"></span></label><input type="range" min="50" max="1000" step="10" x-model="data.guests" class="w-full accent-amber-500 bg-zinc-200 dark:bg-zinc-800 h-1.5 rounded-lg cursor-pointer"></div>
                            </div>
                            <button @click="step = 2" class="mt-8 w-full py-4 bg-zinc-900 dark:bg-white text-white dark:text-zinc-950 font-bold uppercase tracking-widest text-sm rounded-xl hover:scale-[1.02] transition-all">Siguiente Fase ➔</button>
                        </div>

                        {{-- FASE 2: ARQUITECTURA / SALÓN --}}
                        <div x-show="step === 2" x-cloak x-transition:enter="transition ease-[cubic-bezier(0.16,1,0.3,1)] duration-700" x-transition:enter-start="opacity-0 translate-x-12" x-transition:enter-end="opacity-100 translate-x-0" class="absolute inset-0 flex flex-col space-y-6 overflow-y-auto custom-scrollbar pr-2 pb-6">
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
                            <button @click="step = 3" class="mt-auto w-full py-4 bg-zinc-900 dark:bg-white text-white dark:text-zinc-950 font-bold uppercase tracking-widest text-sm rounded-xl hover:scale-[1.02] transition-all">Ir a Servicios y Extras ➔</button>
                        </div>

                        {{-- FASE 3: SERVICIOS Y MEDIOS VISUALES (La lógica Sí/No requerida) --}}
                        <div x-show="step === 3" x-cloak x-transition:enter="transition ease-[cubic-bezier(0.16,1,0.3,1)] duration-700" x-transition:enter-start="opacity-0 translate-x-12" x-transition:enter-end="opacity-100 translate-x-0" class="absolute inset-0 flex flex-col space-y-6 overflow-y-auto custom-scrollbar pr-2 pb-10">
                            <h3 class="text-2xl font-bold mb-2 text-zinc-900 dark:text-white transition-colors duration-500">Medios y Extras</h3>
                            
                            {{-- SERVICIOS VISUALES (Foto, Video, Retrato, Video Beam) --}}
                            <div class="space-y-4">
                                {{-- FOTOGRAFÍA --}}
                                <div class="p-4 bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 rounded-2xl">
                                    <div class="flex justify-between items-center">
                                        <div><span class="font-bold text-zinc-900 dark:text-white block">Servicio de Fotografía</span><span class="text-xs text-zinc-500">Cámara pro, fotos impresas y álbum</span></div>
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" x-model="toggles.wantsPhoto" class="sr-only peer">
                                            <div class="w-11 h-6 bg-zinc-200 peer-focus:outline-none rounded-full peer dark:bg-zinc-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500"></div>
                                        </label>
                                    </div>
                                    <div x-show="toggles.wantsPhoto" x-transition class="mt-4 pt-4 border-t border-zinc-100 dark:border-zinc-800">
                                        <button @click="openModal('Fotografía', 'photos', 'media', 'photo')" class="w-full py-3 border border-amber-500/50 text-amber-500 hover:bg-amber-500 hover:text-black text-xs font-bold uppercase tracking-widest rounded-xl transition-all">
                                            <span x-text="data.media.photo ? '✓ ' + data.media.photo.name : 'Seleccionar Paquete Visual'"></span>
                                        </button>
                                    </div>
                                </div>

                                {{-- VIDEO --}}
                                <div class="p-4 bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 rounded-2xl">
                                    <div class="flex justify-between items-center">
                                        <div><span class="font-bold text-zinc-900 dark:text-white block">Cinematografía (Video)</span><span class="text-xs text-zinc-500">USB editada (1 mes después)</span></div>
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" x-model="toggles.wantsVideo" class="sr-only peer">
                                            <div class="w-11 h-6 bg-zinc-200 peer-focus:outline-none rounded-full peer dark:bg-zinc-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500"></div>
                                        </label>
                                    </div>
                                    <div x-show="toggles.wantsVideo" x-transition class="mt-4 pt-4 border-t border-zinc-100 dark:border-zinc-800">
                                        <button @click="openModal('Cinematografía', 'videos', 'media', 'video')" class="w-full py-3 border border-amber-500/50 text-amber-500 hover:bg-amber-500 hover:text-black text-xs font-bold uppercase tracking-widest rounded-xl transition-all">
                                            <span x-text="data.media.video ? '✓ ' + data.media.video.name : 'Seleccionar Paquete de Video'"></span>
                                        </button>
                                    </div>
                                </div>

                                {{-- RETRATO --}}
                                <div class="p-4 bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 rounded-2xl">
                                    <div class="flex justify-between items-center">
                                        <div><span class="font-bold text-zinc-900 dark:text-white block">Retrato Principal</span><span class="text-xs text-zinc-500">Cuadro 50x70 marco flotante</span></div>
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" x-model="toggles.wantsPortrait" class="sr-only peer">
                                            <div class="w-11 h-6 bg-zinc-200 peer-focus:outline-none rounded-full peer dark:bg-zinc-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500"></div>
                                        </label>
                                    </div>
                                    <div x-show="toggles.wantsPortrait" x-transition class="mt-4 pt-4 border-t border-zinc-100 dark:border-zinc-800">
                                        <button @click="openModal('Retratos', 'portraits', 'media', 'portrait')" class="w-full py-3 border border-amber-500/50 text-amber-500 hover:bg-amber-500 hover:text-black text-xs font-bold uppercase tracking-widest rounded-xl transition-all">
                                            <span x-text="data.media.portrait ? '✓ ' + data.media.portrait.name : 'Elegir Estilo de Cuadro'"></span>
                                        </button>
                                    </div>
                                </div>
                                
                                {{-- VIDEO BEAM --}}
                                <div class="p-4 bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 rounded-2xl">
                                    <div class="flex justify-between items-center">
                                        <div><span class="font-bold text-zinc-900 dark:text-white block">Video Beam</span><span class="text-xs text-zinc-500">Cliente envía fotos y canción</span></div>
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" x-model="toggles.wantsBeam" class="sr-only peer">
                                            <div class="w-11 h-6 bg-zinc-200 peer-focus:outline-none rounded-full peer dark:bg-zinc-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500"></div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full h-px bg-zinc-200 dark:bg-zinc-800 my-4"></div>

                            {{-- SELECCIONES RÁPIDAS (JSON Details) --}}
                            <div class="space-y-4">
                                {{-- RECORDATORIOS --}}
                                <div>
                                    <div class="flex justify-between items-center mb-3">
                                        <span class="font-bold text-zinc-900 dark:text-white text-sm">¿Recordatorios?</span>
                                        <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="toggles.wantsReminders" class="sr-only peer"><div class="w-9 h-5 bg-zinc-200 rounded-full peer dark:bg-zinc-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-amber-500"></div></label>
                                    </div>
                                    <div x-show="toggles.wantsReminders" x-transition class="grid grid-cols-2 gap-2">
                                        <button @click="data.details.reminder = 'Transparente'" :class="data.details.reminder === 'Transparente' ? 'bg-amber-500 text-black' : 'bg-white dark:bg-zinc-900 text-zinc-500'" class="py-2 text-xs font-bold rounded-lg border border-zinc-200 dark:border-zinc-800 transition-colors">Acrílico Transparente</button>
                                        <button @click="data.details.reminder = 'Madera'" :class="data.details.reminder === 'Madera' ? 'bg-amber-500 text-black' : 'bg-white dark:bg-zinc-900 text-zinc-500'" class="py-2 text-xs font-bold rounded-lg border border-zinc-200 dark:border-zinc-800 transition-colors">Madera Dorada</button>
                                    </div>
                                </div>

                                {{-- INVITACIONES --}}
                                <div>
                                    <div class="flex justify-between items-center mb-3">
                                        <span class="font-bold text-zinc-900 dark:text-white text-sm">¿Invitaciones?</span>
                                        <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="toggles.wantsInvitations" class="sr-only peer"><div class="w-9 h-5 bg-zinc-200 rounded-full peer dark:bg-zinc-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-amber-500"></div></label>
                                    </div>
                                    <div x-show="toggles.wantsInvitations" x-transition class="grid grid-cols-3 gap-2">
                                        <button @click="data.details.invitation = 'Foto Virtual'" :class="data.details.invitation === 'Foto Virtual' ? 'bg-amber-500 text-black' : 'bg-white dark:bg-zinc-900 text-zinc-500'" class="py-2 text-[10px] font-bold uppercase rounded-lg border border-zinc-200 dark:border-zinc-800 transition-colors">Foto Virtual</button>
                                        <button @click="data.details.invitation = 'Video Virtual'" :class="data.details.invitation === 'Video Virtual' ? 'bg-amber-500 text-black' : 'bg-white dark:bg-zinc-900 text-zinc-500'" class="py-2 text-[10px] font-bold uppercase rounded-lg border border-zinc-200 dark:border-zinc-800 transition-colors">Video Virtual</button>
                                        <button @click="data.details.invitation = 'Física'" :class="data.details.invitation === 'Física' ? 'bg-amber-500 text-black' : 'bg-white dark:bg-zinc-900 text-zinc-500'" class="py-2 text-[10px] font-bold uppercase rounded-lg border border-zinc-200 dark:border-zinc-800 transition-colors">Física</button>
                                    </div>
                                </div>

                                {{-- COMIDA --}}
                                <div>
                                    <label class="block text-sm font-bold text-zinc-900 dark:text-white mb-3">Estilo de Alimentación</label>
                                    <select x-model="data.details.food" class="w-full bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 rounded-xl px-4 py-3 text-sm text-zinc-900 dark:text-white focus:border-amber-500 outline-none appearance-none">
                                        <option value="" disabled selected>Selecciona una opción...</option>
                                        <option value="Plato Típico">Plato Típico</option>
                                        <option value="Buffet (2 tipos, meseros, cristalería)">Buffet Premium (Incluye meseros y cristalería)</option>
                                        <option value="Solo alquiler cristalería">Solo Alquiler de Cristalería</option>
                                    </select>
                                </div>
                            </div>

                            <button @click="step = 4" class="mt-8 w-full py-4 bg-zinc-900 dark:bg-white text-white dark:text-zinc-950 font-bold uppercase tracking-widest text-sm rounded-xl hover:scale-[1.02] transition-all">Ir a Personalización Avanzada ➔</button>
                        </div>

                        {{-- FASE 4: HIPER-PERSONALIZACIÓN POR EVENTO Y TEMÁTICAS --}}
                        <div x-show="step === 4" x-cloak x-transition:enter="transition ease-[cubic-bezier(0.16,1,0.3,1)] duration-700" x-transition:enter-start="opacity-0 translate-x-12" x-transition:enter-end="opacity-100 translate-x-0" class="absolute inset-0 flex flex-col space-y-4 overflow-y-auto custom-scrollbar pr-2 pb-10">
                            <h3 class="text-2xl font-bold mb-2 text-zinc-900 dark:text-white transition-colors duration-500">Curaduría <span class="text-amber-500" x-text="data.type"></span></h3>
                            
                            {{-- BLOQUE GLOBAL: TEMÁTICAS --}}
                            <div class="mb-6 p-5 bg-gradient-to-br from-amber-500/10 to-transparent border border-amber-500/30 rounded-2xl">
                                <div class="flex justify-between items-center mb-4">
                                    <div><span class="font-bold text-amber-600 dark:text-amber-500 block text-lg">¿Deseas Temática?</span><span class="text-xs text-zinc-500">Transforma el espacio visualmente</span></div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" x-model="toggles.wantsTheme" class="sr-only peer">
                                        <div class="w-11 h-6 bg-zinc-200 peer-focus:outline-none rounded-full peer dark:bg-zinc-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500"></div>
                                    </label>
                                </div>
                                <button x-show="toggles.wantsTheme" x-transition @click="openModal('Temáticas', 'themes', 'base', 'theme')" class="w-full py-4 bg-amber-500 text-zinc-950 font-black uppercase tracking-widest text-xs rounded-xl shadow-[0_0_15px_rgba(245,158,11,0.4)] hover:scale-[1.02] transition-transform">
                                    <span x-text="data.base.theme ? 'Cambiar: ' + data.base.theme.name : 'Explorar Temáticas'"></span>
                                </button>
                            </div>

                            {{-- BLOQUE 15 AÑOS --}}
                            <div x-show="data.type === '15 Años'" class="space-y-4">
                                {{-- Opción Vestido con Toggle --}}
                                <div class="border border-zinc-200 dark:border-zinc-800 rounded-2xl overflow-hidden">
                                    <div class="p-4 bg-white dark:bg-zinc-950 flex justify-between items-center">
                                        <span class="font-bold text-zinc-900 dark:text-white">Diseño de Vestido</span>
                                        <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="toggles.wantsDress" class="sr-only peer"><div class="w-9 h-5 bg-zinc-200 rounded-full peer dark:bg-zinc-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-pink-500"></div></label>
                                    </div>
                                    <div x-show="toggles.wantsDress" class="p-4 pt-0 bg-white dark:bg-zinc-950">
                                        <button @click="openModal('Alta Costura', 'dresses', 'quince', 'dress')" class="w-full py-3 border border-pink-500/50 text-pink-500 hover:bg-pink-500 hover:text-white text-xs font-bold uppercase tracking-widest rounded-xl transition-all"><span x-text="data.quince.dress ? '✓ Seleccionado' : 'Abrir Catálogo'"></span></button>
                                    </div>
                                </div>

                                <button @click="openModal('Entretenimiento', 'shows', 'quince', 'show')" class="w-full p-5 bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 hover:border-pink-500 rounded-2xl flex justify-between items-center group transition-colors">
                                    <div class="text-left"><span class="block text-xs font-mono text-zinc-500 mb-1">Módulo 02</span><span class="font-bold text-zinc-900 dark:text-white group-hover:text-pink-500 transition-colors">Show Coreográfico</span></div>
                                    <div class="w-10 h-10 rounded-full bg-zinc-100 dark:bg-zinc-900 flex items-center justify-center text-zinc-400 group-hover:text-pink-500"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg></div>
                                </button>
                            </div>

                            {{-- BLOQUE BODA --}}
                            <div x-show="data.type === 'Boda'" class="space-y-4">
                                <button @click="openModal('Arquitectura Efímera', 'ceremonies', 'wedding', 'ceremony')" class="w-full p-5 bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 hover:border-amber-500 rounded-2xl flex justify-between items-center group transition-colors">
                                    <div class="text-left"><span class="block text-xs font-mono text-zinc-500 mb-1">Módulo 01</span><span class="font-bold text-zinc-900 dark:text-white group-hover:text-amber-500 transition-colors">Altar / Ceremonia</span></div>
                                    <div class="w-10 h-10 rounded-full bg-zinc-100 dark:bg-zinc-900 flex items-center justify-center text-zinc-400 group-hover:text-amber-500"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg></div>
                                </button>
                            </div>

                            {{-- BLOQUE CORPORATIVO --}}
                            <div x-show="data.type === 'Corporativo'" class="space-y-4">
                                <button @click="openModal('Estructuras', 'stages', 'corp', 'stage')" class="w-full p-5 bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 hover:border-blue-500 rounded-2xl flex justify-between items-center group transition-colors">
                                    <div class="text-left"><span class="block text-xs font-mono text-zinc-500 mb-1">Módulo 01</span><span class="font-bold text-zinc-900 dark:text-white group-hover:text-blue-500 transition-colors">Tarima y Pantallas</span></div>
                                    <div class="w-10 h-10 rounded-full bg-zinc-100 dark:bg-zinc-900 flex items-center justify-center text-zinc-400 group-hover:text-blue-500"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg></div>
                                </button>
                            </div>
                            
                            <button class="mt-8 w-full py-5 bg-gradient-to-r from-amber-500 to-orange-500 text-zinc-950 font-black uppercase tracking-widest text-sm rounded-xl hover:scale-[1.02] transition-transform shadow-[0_0_20px_rgba(245,158,11,0.3)]">Finalizar y Cotizar</button>
                        </div>
                    </div>
                </div>

                {{-- ============================================== --}}
                {{-- COLUMNA DERECHA: EL LIENZO DE RENDERIZADO VISUAL --}}
                {{-- ============================================== --}}
                <div class="lg:col-span-6 relative rounded-[2rem] overflow-hidden border border-zinc-200 dark:border-zinc-800 bg-black flex flex-col shadow-2xl transition-colors duration-500">
                    
                    {{-- Capa 0: Fondo Salón --}}
                    <div class="absolute inset-0 bg-cover bg-center transition-all duration-[2s] ease-[cubic-bezier(0.16,1,0.3,1)] opacity-50 blur-[2px]" :style="`background-image: url('${data.base.theme ? data.base.theme.img : data.salon.img}');`"></div>
                    
                    {{-- Capa 1: Iluminación Global (Mix Blend Screen) --}}
                    <div x-show="data.base.lighting" x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="absolute inset-0 mix-blend-screen z-10 pointer-events-none">
                        <img :src="data.base.lighting?.img" class="w-full h-full object-cover opacity-80" alt="Light">
                    </div>

                    {{-- Capa Temática Activa HUD --}}
                    <div x-show="data.base.theme" x-transition class="absolute top-24 right-6 bg-black/60 backdrop-blur-md border border-amber-500/50 p-3 rounded-xl z-30 max-w-[150px]">
                        <span class="text-[8px] text-amber-500 font-mono uppercase block mb-1">Temática Activa</span>
                        <h5 class="text-white text-xs font-bold leading-tight" x-text="data.base.theme?.name"></h5>
                    </div>

                    {{-- Capa 2: Elementos Inyectados (GSAP Feel Animations) --}}
                    
                    {{-- Retrato Flotante --}}
                    <div x-show="toggles.wantsPortrait && data.media.portrait" x-transition:enter="transition ease-[cubic-bezier(0.16,1,0.3,1)] duration-[1.5s]" x-transition:enter-start="opacity-0 -translate-y-20 scale-90" x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="absolute left-1/2 top-1/4 -translate-x-1/2 w-48 h-64 border-[8px] border-zinc-800 shadow-[0_20px_50px_rgba(0,0,0,0.8)] z-20">
                        <img :src="data.media.portrait?.img" class="w-full h-full object-cover">
                    </div>

                    {{-- Paquete Fotografía (Polaroids Flotantes) --}}
                    <div x-show="toggles.wantsPhoto && data.media.photo" x-transition:enter="transition ease-[cubic-bezier(0.16,1,0.3,1)] duration-[1.5s]" x-transition:enter-start="opacity-0 translate-x-20 rotate-12" x-transition:enter-end="opacity-100 translate-x-0 -rotate-6" class="absolute left-8 bottom-32 w-28 h-32 bg-white p-2 pb-8 shadow-2xl rounded-sm z-30">
                        <img :src="data.media.photo?.img" class="w-full h-full object-cover bg-zinc-100">
                        <span class="text-[8px] font-bold text-black uppercase absolute bottom-2 left-0 w-full text-center">Foto Pack</span>
                    </div>

                    {{-- Vestido (15 Años) --}}
                    <div x-show="data.type === '15 Años' && data.quince.dress && toggles.wantsDress" x-transition:enter="transition ease-[cubic-bezier(0.16,1,0.3,1)] duration-[1.5s]" x-transition:enter-start="opacity-0 -translate-x-20 scale-90" x-transition:enter-end="opacity-100 translate-x-0 scale-100" class="absolute right-6 bottom-6 top-32 w-[40%] rounded-2xl overflow-hidden shadow-2xl border border-white/10 z-20">
                        <img :src="data.quince.dress?.img" class="w-full h-full object-cover">
                        <div class="absolute bottom-0 w-full bg-black/50 backdrop-blur-md p-3"><span class="text-white text-[10px] uppercase font-bold tracking-widest block text-center" x-text="data.quince.dress?.name"></span></div>
                    </div>

                    {{-- Altar (Boda) --}}
                    <div x-show="data.type === 'Boda' && data.wedding.ceremony" x-transition:enter="transition ease-[cubic-bezier(0.16,1,0.3,1)] duration-[1.5s]" x-transition:enter-start="opacity-0 scale-75" x-transition:enter-end="opacity-100 scale-100" class="absolute inset-x-6 top-24 bottom-32 rounded-2xl overflow-hidden shadow-2xl border border-white/10 z-20">
                        <img :src="data.wedding.ceremony?.img" class="w-full h-full object-cover opacity-90">
                    </div>

                    {{-- Capa 3: Silla Flotante --}}
                    <div x-show="data.base.chair" x-transition:enter="transition ease-[cubic-bezier(0.34,1.56,0.64,1)] duration-1000" x-transition:enter-start="opacity-0 rotate-[20deg] scale-50 translate-x-32" x-transition:enter-end="opacity-100 rotate-[6deg] scale-100 translate-x-0" class="absolute right-6 bottom-16 w-24 h-32 bg-white p-1.5 pb-6 shadow-[0_20px_50px_rgba(0,0,0,0.5)] rounded-sm z-30">
                        <img :src="data.base.chair?.img" class="w-full h-full object-cover bg-zinc-100">
                        <span class="text-[8px] font-bold text-black uppercase tracking-widest absolute bottom-1.5 left-0 w-full text-center" x-text="data.base.chair?.name"></span>
                    </div>

                    {{-- HUD Superior (UI superpuesta) --}}
                    <div class="absolute top-0 left-0 w-full p-6 z-40 bg-gradient-to-b from-black/80 to-transparent flex justify-between items-start pointer-events-none">
                        <div>
                            <span class="bg-amber-500 text-black text-[9px] font-bold px-3 py-1 rounded-full uppercase tracking-widest inline-block mb-2 shadow-[0_0_15px_rgba(245,158,11,0.5)]" x-text="data.type"></span>
                            <h4 class="text-white text-3xl font-bold leading-none drop-shadow-lg" x-text="data.title || 'Lienzo en Blanco'"></h4>
                            <p class="text-white/70 text-xs mt-2" x-show="data.date"><span x-text="data.date"></span> | <span x-text="data.guests + ' Pax'"></span></p>
                        </div>
                        <div class="flex items-center gap-2 bg-black/50 backdrop-blur-md border border-white/10 px-3 py-1.5 rounded-full">
                            <div class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></div><span class="text-white text-[10px] font-mono uppercase tracking-widest">Render Activo</span>
                        </div>
                    </div>
                    
                    {{-- Estado Vacío --}}
                    <div x-show="!data.base.chair && !data.base.lighting && !data.quince.dress && !data.wedding.ceremony && !data.media.portrait && !data.base.theme" class="absolute inset-0 flex flex-col items-center justify-center text-zinc-400 z-0 pointer-events-none">
                        <svg class="w-16 h-16 mb-4 opacity-30 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path></svg>
                        <p class="text-sm font-mono tracking-widest uppercase text-white/50">Esperando instrucciones...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->















{{-- ==========================================
     MOTOR DE COTIZACIÓN VIP "EVENT CANVAS"
     Diseño Ultra-Moderno / Bento Grid / Glassmorphism
=========================================== --}}
<style>
    /* Efectos de fondo y scrollbar para dar look premium */
    .bg-grid-pattern { background-image: radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px); background-size: 30px 30px; }
    .glass-panel { background: rgba(24, 24, 27, 0.65); backdrop-filter: blur(16px); border: 1px solid rgba(255, 255, 255, 0.08); box-shadow: 0 4px 30px rgba(0, 0, 0, 0.5); }
    .custom-scroll::-webkit-scrollbar { width: 6px; }
    .custom-scroll::-webkit-scrollbar-track { background: transparent; }
    .custom-scroll::-webkit-scrollbar-thumb { background: rgba(245, 158, 11, 0.5); border-radius: 10px; }
    .toggle-checkbox:checked + .toggle-label { background-color: #f59e0b; border-color: #f59e0b; }
    .toggle-checkbox:checked + .toggle-label div { transform: translateX(100%); }
</style>

<section class="min-h-screen bg-zinc-950 text-white font-sans relative overflow-hidden flex flex-col bg-grid-pattern"
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
    <div x-show="activeModal" x-cloak class="fixed inset-0 z-[100] bg-black/90 backdrop-blur-xl flex flex-col" x-transition.opacity>
        <div class="p-6 flex justify-between items-center border-b border-white/10">
            <h3 class="text-2xl font-black uppercase tracking-widest text-amber-500" x-text="modalTitle"></h3>
            <button @click="activeModal = null" class="w-10 h-10 bg-white/10 rounded-full hover:bg-amber-500 hover:text-black transition flex items-center justify-center">✕</button>
        </div>
        <div class="p-8 grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 overflow-y-auto custom-scroll flex-grow">
            <template x-for="item in activeCatalog" :key="item.id">
                <div @click="selectItem(item)" class="group cursor-pointer rounded-2xl overflow-hidden relative h-72 border border-white/10 hover:border-amber-500 transition-all">
                    <img :src="item.img" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent flex flex-col justify-end p-5">
                        <h4 class="font-bold text-lg text-white" x-text="item.name"></h4>
                        <p class="text-white/60 text-xs mt-1" x-text="item.desc"></p>
                    </div>
                    <div x-show="event[targetProp]?.id === item.id" class="absolute top-4 right-4 bg-amber-500 text-black text-[10px] font-bold px-3 py-1 rounded-full uppercase">Elegido</div>
                </div>
            </template>
        </div>
    </div>

    {{-- CABECERA --}}
    <header class="py-6 px-10 border-b border-white/10 glass-panel relative z-10 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-black tracking-tighter">STUDIO<span class="text-amber-500">.CANVAS</span></h1>
            <p class="text-xs text-zinc-400 font-mono tracking-widest uppercase mt-1">Configurador de Eventos v2.0</p>
        </div>
        <div class="flex gap-2">
            <template x-for="i in 5">
                <button @click="step = i" :class="step === i ? 'bg-amber-500 text-black w-8' : 'bg-zinc-800 text-zinc-500 w-8 hover:bg-zinc-700'" class="h-8 rounded-full font-bold text-xs transition-all flex items-center justify-center" x-text="i"></button>
            </template>
        </div>
    </header>

    {{-- CONTENEDOR PRINCIPAL --}}
    <main class="flex-grow flex overflow-hidden">
        
        {{-- PANEL IZQUIERDO: FORMULARIO BENTO GRID --}}
        <div class="w-full lg:w-2/3 h-full overflow-y-auto custom-scroll p-6 md:p-10 pb-32">
            
            {{-- PASO 1: PROTAGONISTAS --}}
            <div x-show="step === 1" x-transition.opacity.duration.500ms>
                <h2 class="text-3xl font-bold mb-6 flex items-center gap-3"><span class="text-amber-500">01.</span> Información Base</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    <div class="glass-panel p-5 rounded-2xl">
                        <label class="text-xs text-zinc-400 uppercase tracking-widest font-bold mb-2 block">Nombre del Cliente</label>
                        <input type="text" x-model="event.clientName" class="w-full bg-black/50 border border-white/10 rounded-xl px-4 py-3 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 outline-none transition text-white" placeholder="Ej. Familia Rodríguez">
                    </div>
                    <div class="glass-panel p-5 rounded-2xl">
                        <label class="text-xs text-zinc-400 uppercase tracking-widest font-bold mb-2 block">Teléfono / WhatsApp</label>
                        <input type="tel" x-model="event.phone" class="w-full bg-black/50 border border-white/10 rounded-xl px-4 py-3 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 outline-none transition text-white" placeholder="+57 300 000 0000">
                    </div>
                    <div class="glass-panel p-5 rounded-2xl">
                        <label class="text-xs text-zinc-400 uppercase tracking-widest font-bold mb-2 block">Fecha del Evento</label>
                        <input type="date" x-model="event.date" class="w-full bg-black/50 border border-white/10 rounded-xl px-4 py-3 focus:border-amber-500 outline-none transition text-white style-color-scheme-dark">
                    </div>
                    <div class="glass-panel p-5 rounded-2xl">
                        <label class="text-xs text-zinc-400 uppercase tracking-widest font-bold mb-2 flex justify-between"><span>Invitados</span> <span class="text-amber-500" x-text="event.guests"></span></label>
                        <input type="range" min="30" max="1000" step="10" x-model="event.guests" class="w-full accent-amber-500">
                    </div>
                </div>

                <h3 class="text-sm text-zinc-400 uppercase tracking-widest font-bold mb-4">Tipo de Evento</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3 mb-8">
                    <template x-for="t in ['Boda', '15 Años', 'Bautizo', 'Baby Shower', 'Cumpleaños', 'Corporativo']">
                        <button @click="event.type = t" :class="event.type === t ? 'bg-amber-500 border-amber-500 text-black shadow-[0_0_20px_rgba(245,158,11,0.3)]' : 'glass-panel text-white hover:border-amber-500/50'" class="py-4 rounded-xl border border-white/10 font-bold transition-all" x-text="t"></button>
                    </template>
                </div>
                
                <button @click="step = 2" class="w-full py-4 bg-white text-black font-black uppercase tracking-widest rounded-xl hover:bg-amber-500 transition-colors">Diseñar Atmósfera ➔</button>
            </div>

            {{-- PASO 2: ATMÓSFERA Y BANQUETE --}}
            <div x-show="step === 2" x-cloak x-transition.opacity.duration.500ms>
                <h2 class="text-3xl font-bold mb-6 flex items-center gap-3"><span class="text-amber-500">02.</span> Atmósfera & Menú</h2>
                
                <div class="glass-panel p-6 rounded-3xl mb-4 border-l-4 border-l-amber-500">
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <h3 class="font-bold text-lg">Locación Principal</h3>
                            <p class="text-xs text-zinc-400">Selecciona el salón de tu preferencia</p>
                        </div>
                        <button @click="openModal('Salones', 'salons', 'salon')" class="bg-amber-500 text-black px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-wide hover:scale-105 transition"><span x-text="event.salon ? 'Cambiar Salón' : 'Elegir Salón'"></span></button>
                    </div>
                    <div x-show="event.salon" class="text-amber-400 text-sm font-bold flex items-center gap-2">✓ <span x-text="event.salon?.name"></span></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    {{-- Tarjeta Toggle Temática --}}
                    <div class="glass-panel p-5 rounded-2xl relative overflow-hidden group">
                        <div class="flex justify-between items-start mb-4">
                            <div><h3 class="font-bold text-lg">Temática</h3><p class="text-xs text-zinc-400">Concepto visual unificado</p></div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" x-model="wants.theme" class="sr-only toggle-checkbox">
                                <div class="w-11 h-6 bg-zinc-800 rounded-full toggle-label border border-white/10 transition-colors"><div class="absolute top-[2px] left-[2px] bg-white w-5 h-5 rounded-full transition-transform"></div></div>
                            </label>
                        </div>
                        <div x-show="wants.theme" x-transition>
                            <button @click="openModal('Temáticas', 'themes', 'theme')" class="w-full py-2 border border-amber-500/50 text-amber-500 rounded-lg text-xs font-bold uppercase hover:bg-amber-500 hover:text-black transition"><span x-text="event.theme ? event.theme.name : 'Ver Catálogo de Temáticas'"></span></button>
                        </div>
                    </div>

                    {{-- Catering Select --}}
                    <div class="glass-panel p-5 rounded-2xl">
                        <h3 class="font-bold text-lg mb-1">Banquete & Menú</h3>
                        <p class="text-xs text-zinc-400 mb-4">Estilo de alimentación</p>
                        <select x-model="event.food" class="w-full bg-black/50 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:border-amber-500 outline-none">
                            <option value="">No requerido / N/A</option>
                            <option value="Plato Típico">Plato Típico Servido</option>
                            <option value="Buffet 2 Tipos">Buffet Premium (2 tipos + Meseros + Cristalería)</option>
                            <option value="Solo Cristalería">Solo alquiler de cristalería</option>
                        </select>
                    </div>
                </div>
                
                <button @click="step = 3" class="w-full py-4 mt-6 bg-white text-black font-black uppercase tracking-widest rounded-xl hover:bg-amber-500 transition-colors">Personalizar Decoración ➔</button>
            </div>

            {{-- PASO 3: DECORACIÓN Y ESCENOGRAFÍA --}}
            <div x-show="step === 3" x-cloak x-transition.opacity.duration.500ms>
                <h2 class="text-3xl font-bold mb-6 flex items-center gap-3"><span class="text-amber-500">03.</span> Escenografía</h2>

                <div class="glass-panel p-6 rounded-3xl mb-4">
                    <div class="flex justify-between items-center mb-4">
                        <div><h3 class="font-bold text-lg">Sillería Principal</h3><p class="text-xs text-zinc-400">La joya de la corona del evento</p></div>
                        <button @click="openModal('Sillas Principales', 'chairs', 'chair')" class="bg-amber-500 text-black px-4 py-2 rounded-lg text-xs font-bold uppercase hover:scale-105 transition"><span x-text="event.chair ? 'Modificar' : 'Seleccionar'"></span></button>
                    </div>
                    <div x-show="event.chair" class="text-amber-400 text-sm font-bold">✓ Silla elegida: <span x-text="event.chair?.name"></span></div>
                </div>

                {{-- BENTO GRID: Toggles de Decoración --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    
                    {{-- Backing --}}
                    <div class="glass-panel p-5 rounded-2xl">
                        <div class="flex justify-between items-center mb-4">
                            <div><h3 class="font-bold text-sm">Backing de Fotos</h3><p class="text-[10px] text-zinc-400">Estructuras traseras con diseño</p></div>
                            <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="wants.backing" class="sr-only toggle-checkbox"><div class="w-9 h-5 bg-zinc-800 rounded-full toggle-label transition-colors"><div class="absolute top-[2px] left-[2px] bg-white w-4 h-4 rounded-full transition-transform"></div></div></label>
                        </div>
                        <button x-show="wants.backing" @click="openModal('Backings', 'backings', 'backing')" class="w-full py-2 border border-amber-500/30 text-amber-500 text-[10px] font-bold rounded-lg uppercase hover:bg-amber-500 hover:text-black transition" x-text="event.backing ? event.backing.name : 'Ver Modelos'"></button>
                    </div>

                    {{-- Nombre Iluminado --}}
                    <div class="glass-panel p-5 rounded-2xl">
                        <div class="flex justify-between items-center mb-4">
                            <div><h3 class="font-bold text-sm">Nombre Iluminado</h3><p class="text-[10px] text-zinc-400">Letras 3D o Neón</p></div>
                            <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="wants.illumName" class="sr-only toggle-checkbox"><div class="w-9 h-5 bg-zinc-800 rounded-full toggle-label transition-colors"><div class="absolute top-[2px] left-[2px] bg-white w-4 h-4 rounded-full transition-transform"></div></div></label>
                        </div>
                        <button x-show="wants.illumName" @click="openModal('Letras y Neón', 'illumNames', 'illumName')" class="w-full py-2 border border-amber-500/30 text-amber-500 text-[10px] font-bold rounded-lg uppercase hover:bg-amber-500 hover:text-black transition" x-text="event.illumName ? event.illumName.name : 'Ver Estilos'"></button>
                    </div>

                    {{-- Centros de Mesa --}}
                    <div class="glass-panel p-5 rounded-2xl">
                        <div class="flex justify-between items-center mb-4">
                            <div><h3 class="font-bold text-sm">Centros de Mesa</h3><p class="text-[10px] text-zinc-400">Arreglos para invitados</p></div>
                            <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="wants.centerpieces" class="sr-only toggle-checkbox"><div class="w-9 h-5 bg-zinc-800 rounded-full toggle-label transition-colors"><div class="absolute top-[2px] left-[2px] bg-white w-4 h-4 rounded-full transition-transform"></div></div></label>
                        </div>
                        <button x-show="wants.centerpieces" @click="openModal('Centros de Mesa', 'centerpieces', 'centerpiece')" class="w-full py-2 border border-amber-500/30 text-amber-500 text-[10px] font-bold rounded-lg uppercase hover:bg-amber-500 hover:text-black transition" x-text="event.centerpiece ? event.centerpiece.name : 'Elegir Arreglo'"></button>
                    </div>

                    {{-- Opciones Switch Simples --}}
                    <div class="glass-panel p-5 rounded-2xl flex justify-between items-center">
                        <div><h3 class="font-bold text-sm">Decoración de Techo</h3><p class="text-[10px] text-zinc-400">Telas y luces colgantes</p></div>
                        <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="wants.ceiling" class="sr-only toggle-checkbox"><div class="w-9 h-5 bg-zinc-800 rounded-full toggle-label transition-colors"><div class="absolute top-[2px] left-[2px] bg-white w-4 h-4 rounded-full transition-transform"></div></div></label>
                    </div>
                    <div class="glass-panel p-5 rounded-2xl flex justify-between items-center">
                        <div><h3 class="font-bold text-sm">Cilindros Metálicos</h3><p class="text-[10px] text-zinc-400">Bases decorativas</p></div>
                        <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="wants.cylinders" class="sr-only toggle-checkbox"><div class="w-9 h-5 bg-zinc-800 rounded-full toggle-label transition-colors"><div class="absolute top-[2px] left-[2px] bg-white w-4 h-4 rounded-full transition-transform"></div></div></label>
                    </div>
                    <div class="glass-panel p-5 rounded-2xl flex justify-between items-center">
                        <div><h3 class="font-bold text-sm">Pedestales</h3><p class="text-[10px] text-zinc-400">Para flores o pasillo</p></div>
                        <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="wants.pedestals" class="sr-only toggle-checkbox"><div class="w-9 h-5 bg-zinc-800 rounded-full toggle-label transition-colors"><div class="absolute top-[2px] left-[2px] bg-white w-4 h-4 rounded-full transition-transform"></div></div></label>
                    </div>
                </div>

                {{-- Selects Directos --}}
                <div class="mt-4 glass-panel p-5 rounded-2xl">
                    <label class="text-sm font-bold block mb-2">Camino principal</label>
                    <div class="grid grid-cols-3 gap-2">
                        <button @click="event.carpet = 'Alfombra'" :class="event.carpet === 'Alfombra' ? 'bg-amber-500 text-black' : 'bg-zinc-800/50 text-zinc-400'" class="py-2 text-xs font-bold rounded-lg transition">Alfombra Roja/Blanca</button>
                        <button @click="event.carpet = 'Pétalos'" :class="event.carpet === 'Pétalos' ? 'bg-amber-500 text-black' : 'bg-zinc-800/50 text-zinc-400'" class="py-2 text-xs font-bold rounded-lg transition">Camino en Pétalos</button>
                        <button @click="event.carpet = 'N/A'" :class="event.carpet === 'N/A' ? 'bg-zinc-600 text-white' : 'bg-zinc-800/50 text-zinc-400'" class="py-2 text-xs font-bold rounded-lg transition">No Aplica</button>
                    </div>
                </div>

                <button @click="step = 4" class="w-full py-4 mt-6 bg-white text-black font-black uppercase tracking-widest rounded-xl hover:bg-amber-500 transition-colors">Medios Audiovisuales ➔</button>
            </div>

            {{-- PASO 4: AUDIOVISUAL Y RECUERDOS --}}
            <div x-show="step === 4" x-cloak x-transition.opacity.duration.500ms>
                <h2 class="text-3xl font-bold mb-6 flex items-center gap-3"><span class="text-amber-500">04.</span> Visuales & Recuerdos</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                    {{-- Fotografía --}}
                    <div class="glass-panel p-5 rounded-2xl relative overflow-hidden group">
                        <div class="flex justify-between items-start mb-2">
                            <div><h3 class="font-bold text-lg text-white group-hover:text-amber-400 transition">Fotografía Pro</h3></div>
                            <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="wants.photo" class="sr-only toggle-checkbox"><div class="w-11 h-6 bg-zinc-800 rounded-full toggle-label border border-white/10"><div class="absolute top-[2px] left-[2px] bg-white w-5 h-5 rounded-full transition-transform"></div></div></label>
                        </div>
                        <p class="text-xs text-zinc-400">50 impresas, fotógrafo, cámara pro y álbum.</p>
                    </div>

                    {{-- Video --}}
                    <div class="glass-panel p-5 rounded-2xl relative overflow-hidden group">
                        <div class="flex justify-between items-start mb-2">
                            <div><h3 class="font-bold text-lg text-white group-hover:text-amber-400 transition">Video Editado</h3></div>
                            <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="wants.video" class="sr-only toggle-checkbox"><div class="w-11 h-6 bg-zinc-800 rounded-full toggle-label border border-white/10"><div class="absolute top-[2px] left-[2px] bg-white w-5 h-5 rounded-full transition-transform"></div></div></label>
                        </div>
                        <p class="text-xs text-zinc-400">Entrega en USB un mes después del evento.</p>
                    </div>

                    {{-- Retrato --}}
                    <div class="glass-panel p-5 rounded-2xl relative overflow-hidden group">
                        <div class="flex justify-between items-start mb-2">
                            <div><h3 class="font-bold text-lg text-white group-hover:text-amber-400 transition">Retrato Flotante</h3></div>
                            <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="wants.portrait" class="sr-only toggle-checkbox"><div class="w-11 h-6 bg-zinc-800 rounded-full toggle-label border border-white/10"><div class="absolute top-[2px] left-[2px] bg-white w-5 h-5 rounded-full transition-transform"></div></div></label>
                        </div>
                        <p class="text-xs text-zinc-400">Cuadro 50x70 con marco elegante.</p>
                    </div>

                    {{-- Video Beam --}}
                    <div class="glass-panel p-5 rounded-2xl relative overflow-hidden group">
                        <div class="flex justify-between items-start mb-2">
                            <div><h3 class="font-bold text-lg text-white group-hover:text-amber-400 transition">Video Beam</h3></div>
                            <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="wants.beam" class="sr-only toggle-checkbox"><div class="w-11 h-6 bg-zinc-800 rounded-full toggle-label border border-white/10"><div class="absolute top-[2px] left-[2px] bg-white w-5 h-5 rounded-full transition-transform"></div></div></label>
                        </div>
                        <p class="text-xs text-zinc-400">Proyección (cliente envía fotos y canción).</p>
                    </div>
                </div>

                {{-- Recordatorios e Invitaciones --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="glass-panel p-5 rounded-2xl">
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="font-bold text-sm">Recordatorios</h3>
                            <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="wants.reminders" class="sr-only toggle-checkbox"><div class="w-9 h-5 bg-zinc-800 rounded-full toggle-label transition-colors"><div class="absolute top-[2px] left-[2px] bg-white w-4 h-4 rounded-full transition-transform"></div></div></label>
                        </div>
                        <div x-show="wants.reminders" class="grid grid-cols-2 gap-2 mt-2">
                            <button @click="event.reminders = 'Transparente'" :class="event.reminders === 'Transparente' ? 'bg-amber-500 text-black' : 'bg-zinc-800/50 text-zinc-400'" class="py-2 text-[10px] font-bold uppercase rounded-lg transition">Transparente</button>
                            <button @click="event.reminders = 'Madera'" :class="event.reminders === 'Madera' ? 'bg-amber-500 text-black' : 'bg-zinc-800/50 text-zinc-400'" class="py-2 text-[10px] font-bold uppercase rounded-lg transition">Madera Dorada</button>
                        </div>
                    </div>
                    
                    <div class="glass-panel p-5 rounded-2xl">
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="font-bold text-sm">Invitaciones</h3>
                            <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="wants.invitations" class="sr-only toggle-checkbox"><div class="w-9 h-5 bg-zinc-800 rounded-full toggle-label transition-colors"><div class="absolute top-[2px] left-[2px] bg-white w-4 h-4 rounded-full transition-transform"></div></div></label>
                        </div>
                        <div x-show="wants.invitations" class="grid grid-cols-3 gap-1 mt-2">
                            <button @click="event.invitations = 'Virtual Foto'" :class="event.invitations === 'Virtual Foto' ? 'bg-amber-500 text-black' : 'bg-zinc-800/50 text-zinc-400'" class="py-2 text-[9px] font-bold uppercase rounded-lg transition">Virtual Foto</button>
                            <button @click="event.invitations = 'Virtual Video'" :class="event.invitations === 'Virtual Video' ? 'bg-amber-500 text-black' : 'bg-zinc-800/50 text-zinc-400'" class="py-2 text-[9px] font-bold uppercase rounded-lg transition">Virtual Video</button>
                            <button @click="event.invitations = 'Física'" :class="event.invitations === 'Física' ? 'bg-amber-500 text-black' : 'bg-zinc-800/50 text-zinc-400'" class="py-2 text-[9px] font-bold uppercase rounded-lg transition">Físicas</button>
                        </div>
                    </div>
                </div>
                
                <div class="glass-panel p-5 rounded-2xl mt-4 flex justify-between items-center">
                    <div><h3 class="font-bold text-sm">Libro de Firmas</h3><p class="text-[10px] text-zinc-400">Para recuerdos escritos de los invitados</p></div>
                    <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="wants.guestbook" class="sr-only toggle-checkbox"><div class="w-9 h-5 bg-zinc-800 rounded-full toggle-label transition-colors"><div class="absolute top-[2px] left-[2px] bg-white w-4 h-4 rounded-full transition-transform"></div></div></label>
                </div>

                <button @click="step = 5" class="w-full py-4 mt-6 bg-white text-black font-black uppercase tracking-widest rounded-xl hover:bg-amber-500 transition-colors">Extras Exclusivos ➔</button>
            </div>

            {{-- PASO 5: EXCLUSIVOS (Vestidos, Ramos, Quinceañero) --}}
            <div x-show="step === 5" x-cloak x-transition.opacity.duration.500ms>
                <h2 class="text-3xl font-bold mb-6 flex items-center gap-3"><span class="text-amber-500">05.</span> Especiales <span x-text="event.type"></span></h2>

                {{-- Solo visible si es 15 Años --}}
                <template x-if="event.type === '15 Años'">
                    <div class="glass-panel p-6 rounded-2xl mb-4 border border-pink-500/30">
                        <div class="flex justify-between items-start mb-4">
                            <div><h3 class="font-bold text-xl text-pink-400">Diseño de Vestido</h3><p class="text-xs text-zinc-400">De catálogo o 100% personalizado</p></div>
                            <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="wants.dress" class="sr-only toggle-checkbox"><div class="w-11 h-6 bg-zinc-800 rounded-full toggle-label border border-white/10"><div class="absolute top-[2px] left-[2px] bg-white w-5 h-5 rounded-full transition-transform"></div></div></label>
                        </div>
                        <button x-show="wants.dress" @click="openModal('Alta Costura', 'dresses', 'dress')" class="w-full py-3 bg-pink-500/20 text-pink-400 hover:bg-pink-500 hover:text-white font-bold uppercase text-xs rounded-xl transition" x-text="event.dress ? 'Modificar Elección' : 'Ver Colección o Solicitar Personalizado'"></button>
                        <div x-show="event.dress" class="mt-3 text-pink-300 text-xs text-center font-bold" x-text="'Elegido: ' + event.dress?.name"></div>
                    </div>
                </template>

                {{-- Regalos (Todos los eventos) --}}
                <div class="glass-panel p-5 rounded-2xl mb-4">
                    <label class="text-sm font-bold block mb-3 text-amber-500">Manejo de Obsequios</label>
                    <div class="grid grid-cols-3 gap-2">
                        <button @click="event.gifts = 'Lluvia de Sobres'" :class="event.gifts === 'Lluvia de Sobres' ? 'bg-amber-500 text-black' : 'bg-zinc-800/50 text-zinc-400'" class="py-3 text-[10px] font-bold uppercase rounded-lg transition">Lluvia de Sobres</button>
                        <button @click="event.gifts = 'Mesa de Regalos'" :class="event.gifts === 'Mesa de Regalos' ? 'bg-amber-500 text-black' : 'bg-zinc-800/50 text-zinc-400'" class="py-3 text-[10px] font-bold uppercase rounded-lg transition">Mesa de Regalos</button>
                        <button @click="event.gifts = 'N/A'" :class="event.gifts === 'N/A' ? 'bg-zinc-600 text-white' : 'bg-zinc-800/50 text-zinc-400'" class="py-3 text-[10px] font-bold uppercase rounded-lg transition">No Aplica</button>
                    </div>
                </div>

                {{-- Opciones mixtas --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Ramos (Boda o 15) --}}
                    <div x-show="event.type === '15 Años' || event.type === 'Boda'" class="glass-panel p-5 rounded-2xl flex justify-between items-center">
                        <div><h3 class="font-bold text-sm">Ramos / Rosas</h3><p class="text-[10px] text-zinc-400">Naturales o preservadas</p></div>
                        <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="wants.roses" class="sr-only toggle-checkbox"><div class="w-9 h-5 bg-zinc-800 rounded-full toggle-label transition-colors"><div class="absolute top-[2px] left-[2px] bg-white w-4 h-4 rounded-full transition-transform"></div></div></label>
                    </div>

                    {{-- Copas --}}
                    <div x-show="event.type === '15 Años' || event.type === 'Boda'" class="glass-panel p-5 rounded-2xl flex justify-between items-center">
                        <div><h3 class="font-bold text-sm">Copas Decoradas</h3><p class="text-[10px] text-zinc-400">Para el brindis principal</p></div>
                        <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="wants.decoratedGlasses" class="sr-only toggle-checkbox"><div class="w-9 h-5 bg-zinc-800 rounded-full toggle-label transition-colors"><div class="absolute top-[2px] left-[2px] bg-white w-4 h-4 rounded-full transition-transform"></div></div></label>
                    </div>

                    {{-- Quinceañero --}}
                    <div x-show="event.type === '15 Años' || event.type === 'Cumpleaños'" class="glass-panel p-5 rounded-2xl flex justify-between items-center">
                        <div><h3 class="font-bold text-sm">Quinceañero / Chambelán</h3><p class="text-[10px] text-zinc-400">Acompañante de protocolo</p></div>
                        <label class="relative inline-flex items-center cursor-pointer"><input type="checkbox" x-model="wants.quinceanero" class="sr-only toggle-checkbox"><div class="w-9 h-5 bg-zinc-800 rounded-full toggle-label transition-colors"><div class="absolute top-[2px] left-[2px] bg-white w-4 h-4 rounded-full transition-transform"></div></div></label>
                    </div>
                </div>

                <button class="mt-10 w-full py-5 bg-gradient-to-r from-amber-500 to-yellow-400 text-black font-black text-lg uppercase tracking-widest rounded-xl hover:scale-[1.02] transition-transform shadow-[0_0_30px_rgba(245,158,11,0.5)]">Generar Cotización Oficial</button>
            </div>

        </div>

        {{-- PANEL DERECHO: TICKET DINÁMICO (Live Preview) --}}
        <div class="hidden lg:block w-1/3 bg-black/80 backdrop-blur-2xl border-l border-white/10 p-8 h-full overflow-y-auto custom-scroll relative">
            
            <div class="sticky top-0 pb-4 border-b border-white/10 bg-black/80 backdrop-blur-xl z-10">
                <h3 class="text-[10px] font-mono text-amber-500 uppercase tracking-widest mb-1">Resumen en Tiempo Real</h3>
                <h2 class="text-2xl font-bold leading-tight" x-text="event.clientName || 'Tu Evento VIP'"></h2>
                <div class="flex gap-2 mt-2">
                    <span class="bg-white/10 px-2 py-1 rounded text-[10px] uppercase font-bold" x-text="event.type"></span>
                    <span class="bg-white/10 px-2 py-1 rounded text-[10px] uppercase font-bold" x-text="event.guests + ' Pax'"></span>
                </div>
            </div>

            <div class="mt-6 space-y-6">
                {{-- Locación --}}
                <div x-show="event.salon || wants.theme">
                    <h4 class="text-xs uppercase font-bold tracking-widest text-zinc-500 mb-3 border-b border-white/5 pb-1">Espacio</h4>
                    <ul class="space-y-3">
                        <li x-show="event.salon" class="flex items-center gap-3"><img :src="event.salon?.img" class="w-10 h-10 rounded object-cover"><span class="text-sm font-bold" x-text="event.salon?.name"></span></li>
                        <li x-show="wants.theme && event.theme" class="flex items-center gap-3"><img :src="event.theme?.img" class="w-10 h-10 rounded object-cover border border-amber-500"><span class="text-sm text-amber-400" x-text="'Tema: ' + event.theme?.name"></span></li>
                    </ul>
                </div>

                {{-- Estructuras --}}
                <div x-show="event.chair || (wants.backing && event.backing) || (wants.illumName && event.illumName)">
                    <h4 class="text-xs uppercase font-bold tracking-widest text-zinc-500 mb-3 border-b border-white/5 pb-1">Escenografía</h4>
                    <ul class="space-y-3">
                        <li x-show="event.chair" class="flex items-center gap-3"><img :src="event.chair?.img" class="w-10 h-10 rounded object-cover"><span class="text-sm" x-text="event.chair?.name"></span></li>
                        <li x-show="wants.backing && event.backing" class="flex items-center gap-3"><img :src="event.backing?.img" class="w-10 h-10 rounded object-cover"><span class="text-sm text-zinc-300" x-text="'Backing: ' + event.backing?.name"></span></li>
                        <li x-show="wants.illumName && event.illumName" class="flex items-center gap-3"><img :src="event.illumName?.img" class="w-10 h-10 rounded object-cover"><span class="text-sm text-zinc-300" x-text="'Letras: ' + event.illumName?.name"></span></li>
                    </ul>
                </div>

                {{-- Items de lista (Sí/No rápidos) --}}
                <div>
                    <h4 class="text-xs uppercase font-bold tracking-widest text-zinc-500 mb-3 border-b border-white/5 pb-1">Servicios Incluidos</h4>
                    <ul class="space-y-2 text-sm text-zinc-300 font-medium">
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
                    <h4 class="text-xs uppercase font-bold tracking-widest text-zinc-500 mb-3 border-b border-white/5 pb-1">Exclusivos</h4>
                    <ul class="space-y-3 text-sm text-zinc-300">
                        <li x-show="wants.dress && event.dress" class="flex items-center gap-3"><img :src="event.dress?.img" class="w-10 h-10 rounded object-cover border border-pink-500"><span class="text-pink-400 font-bold" x-text="event.dress?.name"></span></li>
                        <li x-show="event.gifts && event.gifts !== 'N/A'" class="flex items-center gap-2"><span class="text-amber-500">✓</span> <span x-text="event.gifts"></span></li>
                        <li x-show="wants.guestbook" class="flex items-center gap-2"><span class="text-amber-500">✓</span> Libro de firmas</li>
                        <li x-show="wants.quinceanero" class="flex items-center gap-2"><span class="text-amber-500">✓</span> Chambelán / Quinceañero</li>
                    </ul>
                </div>

            </div>
            
            {{-- Footer del Receipt --}}
            <div class="mt-10 pt-4 border-t border-white/10 opacity-50 flex items-center justify-center">
                <svg class="w-6 h-6 animate-pulse text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                <span class="text-[10px] font-mono tracking-widest ml-2 uppercase">Renderizando en vivo</span>
            </div>
        </div>

    </main>
</section>