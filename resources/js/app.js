import "./bootstrap";
import Alpine from "alpinejs";
import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";
import "pannellum/build/pannellum.css";
import "pannellum/build/pannellum.js";

// 1. Inicializar Alpine.js
window.Alpine = Alpine;
Alpine.start();

// 2. Registrar GSAP
gsap.registerPlugin(ScrollTrigger);

// 3. Un solo Event Listener maestro
document.addEventListener("DOMContentLoaded", () => {
    // ========================================================
    // VISTA: WELCOME (Inicio)
    // ========================================================
    if (
        document.querySelector(".hero-media") ||
        document.querySelector(".builder-section")
    ) {
        const heroTl = gsap.timeline();
        heroTl
            .to(".hero-media", { scale: 1, duration: 2.5, ease: "power4.out" })
            .to(
                ".hero-title-part",
                { y: 0, stagger: 0.15, duration: 1.2, ease: "power4.out" },
                "-=2",
            )
            .to(
                ".scroll-indicator",
                {
                    opacity: 1,
                    y: 10,
                    duration: 1,
                    repeat: -1,
                    yoyo: true,
                    ease: "sine.inOut",
                },
                "-=0.5",
            );

        gsap.to(".hero-bg-container", {
            scrollTrigger: {
                trigger: ".hero-section",
                start: "top top",
                end: "bottom top",
                scrub: 1,
            },
            y: 150,
            opacity: 0,
        });

        gsap.from(".corporate-header", {
            scrollTrigger: {
                trigger: ".corporate-section",
                start: "top 80%",
                end: "top 50%",
                scrub: 1,
            },
            y: 50,
            opacity: 0,
        });

        gsap.from(".reveal-box", {
            scrollTrigger: {
                trigger: ".corporate-section",
                start: "top 70%",
                end: "top 30%",
                scrub: 1,
            },
            y: 80,
            opacity: 0,
            scale: 0.95,
            stagger: 0.2,
        });

        // Scroll horizontal Welcome
        const horizontalScroll = document.querySelector(".horizontal-wrapper");
        if (horizontalScroll && !document.querySelector(".hero-bg-wrapper")) {
            // Evitar choque con Experiencias
            const panels = gsap.utils.toArray(".panel");

            gsap.to(panels, {
                xPercent: -100 * (panels.length - 1),
                ease: "none",
                scrollTrigger: {
                    trigger: ".horizontal-scroll-container",
                    pin: true,
                    scrub: 1,
                    snap: 1 / (panels.length - 1),
                    end: () => "+=" + horizontalScroll.offsetWidth,
                },
            });

            gsap.utils.toArray(".reveal-img-container").forEach((container) => {
                let img = container.querySelector("img");
                gsap.set(container, {
                    clipPath: "inset(20% 20% 20% 20% round 30px)",
                });
                gsap.set(img, { scale: 1.4 });

                gsap.to(container, {
                    clipPath: "inset(0% 0% 0% 0% round 32px)",
                    scrollTrigger: {
                        trigger: container,
                        containerAnimation: gsap.getById(horizontalScroll),
                        start: "left center",
                        end: "right center",
                        scrub: 1,
                    },
                });
                gsap.to(img, {
                    scale: 1,
                    scrollTrigger: {
                        trigger: container,
                        containerAnimation: gsap.getById(horizontalScroll),
                        start: "left center",
                        end: "right center",
                        scrub: 1,
                    },
                });
            });
        }

        gsap.from(".builder-header", {
            scrollTrigger: {
                trigger: ".builder-section",
                start: "top 80%",
                end: "top 50%",
                scrub: 1,
            },
            y: 100,
            opacity: 0,
        });

        gsap.from(".form-interactive-container", {
            scrollTrigger: {
                trigger: ".form-interactive-container",
                start: "top 90%",
                end: "top 40%",
                scrub: 1.5,
            },
            y: 100,
            scale: 0.95,
            opacity: 0,
            transformOrigin: "bottom center",
        });

        gsap.from(".map-header", {
            scrollTrigger: {
                trigger: ".map-section",
                start: "top 80%",
                end: "top 50%",
                scrub: 1,
            },
            y: 60,
            opacity: 0,
        });

        gsap.fromTo(
            ".map-container",
            { clipPath: "inset(40% 40% 40% 40% round 100px)", opacity: 0 },
            {
                clipPath: "inset(0% 0% 0% 0% round 48px)",
                opacity: 1,
                scrollTrigger: {
                    trigger: ".map-section",
                    start: "top 75%",
                    end: "top 25%",
                    scrub: 1.2,
                },
            },
        );

        gsap.from(".map-iframe-wrapper", {
            scrollTrigger: {
                trigger: ".map-section",
                start: "top 90%",
                end: "bottom top",
                scrub: true,
            },
            scale: 1.3,
            rotation: 1,
        });

        gsap.from(".map-info-card", {
            scrollTrigger: {
                trigger: ".map-container",
                start: "top 50%",
                end: "top 30%",
                scrub: 1,
            },
            x: -50,
            opacity: 0,
        });

        gsap.from(".footer-content > div", {
            scrollTrigger: {
                trigger: ".footer-section",
                start: "top 90%",
                end: "top 60%",
                scrub: 1,
            },
            y: 50,
            opacity: 0,
            stagger: 0.1,
        });
    }

    // ========================================================
    // VISTA: SALONES
    // ========================================================
    window.addEventListener("load", () => {
        // Validar que estamos en la vista del recorrido
        if (document.getElementById("panorama")) {
            window.pannellum.viewer("panorama", {
                // Configuración Global
                default: {
                    firstScene: "entrada",
                    author: "Eventos The Ring",
                    sceneFadeDuration: 1000, // Transición suave entre cuartos (1 segundo)
                    autoLoad: true,
                    compass: false,
                    // "hotSpotDebug": true // HABILITA ESTO para ver las coordenadas al hacer clic
                },

                // Definición de Cuartos y Conexiones
                scenes: {
                    entrada: {
                        title: "Entrada Principal",
                        type: "equirectangular",
                        panorama: "/tour360/entrada.jpg", // Ruta de tu foto en public/storage
                        pitch: 3, // Inclinación inicial de la cámara
                        yaw: 1, // Rotación inicial de la cámara
                        hfov: 200,
                        hotSpots: [
                            {
                                pitch: -180.1, // Eje vertical (arriba/abajo)
                                yaw: 180, // Eje horizontal (izquierda/derecha)
                                type: "scene",
                                text: "Ingresar Eventos The Ring",
                                sceneId: "recepcion", // Hacia dónde te lleva este clic
                            },
                        ],
                    },

                    recepcion: {
                        title: "Recepcion",
                        type: "equirectangular",
                        panorama: "/tour360/recepcion.jpg",
                        yaw: 150,
                        hfov: 200,
                        hotSpots: [
                            {
                                pitch: -2,
                                yaw: 10.1,
                                type: "scene",
                                text: "Volver a la Entrada",
                                sceneId: "entrada",
                            },
                            {
                                pitch: -180,
                                yaw: 355.1,
                                type: "scene",
                                text: "Subir escaleras",
                                sceneId: "escalerasprimer",
                            },
                        ],
                    },

                    escalerasprimer: {
                        title: "Escaleras",
                        type: "equirectangular",

                        panorama: "/tour360/escalerasprimer.jpg",
                        pitch: -3,
                        yaw: 260,
                        hfov: 200,
                        hotSpots: [
                            {
                                pitch: -35,
                                yaw: -8.1,
                                type: "scene",
                                text: "Recepcion",
                                sceneId: "recepcion",
                            },
                            {
                                pitch: -190,
                                yaw: 410,
                                type: "scene",
                                text: "Segundo Piso",
                                sceneId: "segundopiso",
                            },
                        ],
                    },

                    segundopiso: {
                        title: "Segundo piso",
                        type: "equirectangular",

                        panorama: "/tour360/segundo.jpeg",
                        yaw: 87,
                        pitch: -7,
                        hfov: 200,
                        hotSpots: [
                            {
                                pitch: -12,
                                yaw: 40,
                                type: "scene",
                                text: "Subir escaleras",
                                sceneId: "escalerastercer",
                            },
                            {
                                pitch: -30,
                                yaw: 500,
                                type: "scene",
                                text: "Bajar escaleras",
                                sceneId: "escalerasprimer",
                            },
                        ],
                    },
                    escalerastercer: {
                        title: "Escaleras",
                        type: "equirectangular",

                        panorama: "/tour360/escalerastercer.jpg",
                        yaw: 270,
                        pitch: -12,
                        hfov: 200,
                        hotSpots: [
                            {
                                pitch: -185,
                                yaw: 400,
                                type: "scene",
                                text: "Tercer piso",
                                sceneId: "tercerpiso",
                            },
                            {
                                pitch: -53,
                                yaw: -742,
                                type: "scene",
                                text: "Segundo piso",
                                sceneId: "segundopiso",
                            },
                        ],
                    },

                    tercerpiso: {
                        title: "Salon",
                        type: "equirectangular",

                        panorama: "/tour360/tercer.jpg",
                        yaw: 290,
                        pitch: -8,
                        hfov: 200,
                        hotSpots: [
                            {
                                pitch: -18,
                                yaw: 50,
                                type: "scene",
                                text: "Subir escaleras",
                                sceneId: "escalerascuarto",
                            },
                            {
                                pitch: -145,
                                yaw: 320,
                                type: "scene",
                                text: "Bajar escaleras",
                                sceneId: "escalerastercer",
                            },
                            {
                                pitch: -12,
                                yaw: 16.1,
                                type: "scene",
                                text: "Baño mujeres",
                                sceneId: "bañosmujeres",
                            },
                            {
                                pitch: -158,
                                yaw: 355,
                                type: "scene",
                                text: "Baño hombres",
                                sceneId: "bañoshombres",
                            },
                            {
                                pitch: -170,
                                yaw: 470,
                                type: "scene",
                                text: "Salon nubes",
                                sceneId: "primersalon",
                            },
                        ],
                    },

                    bañoshombres: {
                        title: "Baño hombres",
                        type: "equirectangular",
                        panorama: "/tour360/bañohombre.jpg",
                        yaw: 170,
                        pitch: -8,
                        hfov: 200,
                        hotSpots: [
                            {
                                pitch: -8,
                                yaw: 180,
                                type: "scene",
                                text: "Tercer piso",
                                sceneId: "tercerpiso",
                            },
                        ],
                    },

                    bañosmujeres: {
                        title: "Baño mujeres",
                        type: "equirectangular",

                        panorama: "/tour360/bañomujer.jpg",
                        yaw: 115,
                        pitch: -8,
                        hfov: 200,
                        hotSpots: [
                            {
                                pitch: -12,
                                yaw: 110,
                                type: "scene",
                                text: "Salon",
                                sceneId: "tercerpiso",
                            },
                        ],
                    },

                    primersalon: {
                        title: "Salon nubes",
                        type: "equirectangular",

                        panorama: "/tour360/primersalon.jpg",
                        yaw: 5,
                        pitch: 1,
                        hfov: 200,
                        hotSpots: [
                            {
                                pitch: -5,
                                yaw: 98,
                                type: "scene",
                                text: "Vista lateral derecha",
                                sceneId: "ladoderecho",
                            },
                            {
                                pitch: -15,
                                yaw: -90,
                                type: "scene",
                                text: "Vista lateral izquierda",
                                sceneId: "ladoizquierdo",
                            },
                            {
                                pitch: -12,
                                yaw: 182,
                                type: "scene",
                                text: "Salir del salon",
                                sceneId: "tercerpiso",
                            },
                            {
                                pitch: -5,
                                yaw: 245,
                                type: "scene",
                                text: "Cocina",
                                sceneId: "cocinasegundo",
                            },
                        ],
                    },

                    ladoderecho: {
                        title: "Vista lateral derecha",
                        type: "equirectangular",
                        panorama: "/tour360/ladoderecho.jpg",
                        yaw: 120,
                        pitch: 1,
                        hfov: 200,
                        hotSpots: [
                            {
                                pitch: -3,
                                yaw: 68,
                                type: "scene",
                                text: "Salir del salon",
                                sceneId: "tercerpiso",
                            },
                            {
                                pitch: -2,
                                yaw: 100,
                                type: "scene",
                                text: "Centro del salon",
                                sceneId: "primersalon",
                            },
                        ],
                    },

                    ladoizquierdo: {
                        title: "Vista lateral izquierda",
                        type: "equirectangular",
                        panorama: "/tour360/ladoizquierdo.jpg",
                        yaw: 5,
                        hotSpots: [
                            {
                                pitch: -2,
                                yaw: 10.1,
                                type: "scene",
                                text: "Salir del salon",
                                sceneId: "tercerpiso",
                            },
                             {
                                pitch: -2,
                                yaw: 10.1,
                                type: "scene",
                                text: "Centro del salon",
                                sceneId: "primersalon",
                            },
                            {
                                pitch: -2,
                                yaw: -150,
                                type: "scene",
                                text: "Cocina",
                                sceneId: "cocinasegundo",
                            },
                        ],
                    },

                    cocinasegundo: {
                        title: "Gran Salón Imperial",
                        type: "equirectangular",
                        panorama: "/tour360/cocinasegundo.jpg",
                        yaw: 5,
                        hotSpots: [
                            {
                                pitch: -2,
                                yaw: 85,
                                type: "scene",
                                text: "Volver al salon",
                                sceneId: "primersalon",
                            },
                        ],
                    },

                    escalerascuarto: {
                        title: "Gran Salón Imperial",
                        type: "equirectangular",
                        panorama: "/tour360/escalerascuarto.jpg",
                        yaw: 5,
                        hotSpots: [
                            {
                                pitch: -2,
                                yaw: 10.1,
                                type: "scene",
                                text: "Cuarto piso",
                                sceneId: "tercerpiso",
                            },
                            {
                                pitch: -2,
                                yaw: 10.1,
                                type: "scene",
                                text: "Tercer piso",
                                sceneId: "tercerpiso",
                            },
                        ],
                    },
                },
            });
        }

        const horizontalWrapper = document.querySelector(
            ".venues-horizontal-wrapper",
        );

        if (horizontalWrapper) {
            gsap.registerPlugin(ScrollTrigger);

            // ==========================================
            // 1. CURSOR FLUIDO Y DINÁMICO
            // ==========================================
            const cursor = document.querySelector(".custom-cursor");
            const cursorDot = document.querySelector(".custom-cursor-dot");

            // ==========================================
            // 2. ANIMACIÓN DE ENTRADA (INTRO)
            // ==========================================
            const tlIntro = gsap.timeline();
            tlIntro
                .from(".intro-badge", {
                    y: "150%",
                    opacity: 0,
                    duration: 1,
                    ease: "expo.out",
                    delay: 0.3,
                })
                .from(
                    ".intro-title-line",
                    {
                        y: "120%",
                        rotation: 2,
                        opacity: 0,
                        duration: 1.2,
                        stagger: 0.15,
                        ease: "power4.out",
                    },
                    "-=0.7",
                )
                .from(
                    ".intro-scroll-indicator",
                    { opacity: 0, y: -20, duration: 1.5, ease: "sine.inOut" },
                    "-=0.4",
                );

            // ==========================================
            // 3. LÓGICA CORE: SCROLL HORIZONTAL
            // ==========================================
            const scrollContainer = document.querySelector(
                ".venues-horizontal-container",
            );
            const slides = gsap.utils.toArray(".venue-slide");
            const progressBar = document.querySelector(".scroll-progress-bar");

            function getScrollWidth() {
                return -(scrollContainer.scrollWidth - window.innerWidth);
            }

            const horizontalTween = gsap.to(scrollContainer, {
                x: getScrollWidth,
                ease: "none",
            });

            ScrollTrigger.create({
                trigger: horizontalWrapper,
                start: "top top",
                end: () =>
                    `+=${scrollContainer.scrollWidth - window.innerWidth}`,
                pin: true,
                animation: horizontalTween,
                scrub: 1.2, // Aumentado ligeramente para mayor inercia y suavidad
                invalidateOnRefresh: true,
                onUpdate: (self) => {
                    if (progressBar) {
                        // Actualización progresiva más fluida de la barra
                        gsap.to(progressBar, {
                            width: `${self.progress * 100}%`,
                            duration: 0.15,
                            ease: "power1.out",
                        });
                    }
                },
            });

            // ==========================================
            // 4. ANIMACIONES INTERNAS POR SLIDE (SALONES)
            // ==========================================
            slides.forEach((slide) => {
                // Efecto cinemático de revelado de imagen (Cortina)
                const mainMask = slide.querySelector(".venue-main-img-mask");
                if (mainMask) {
                    gsap.fromTo(
                        mainMask,
                        {
                            clipPath:
                                "polygon(10% 0, 90% 0, 90% 100%, 10% 100%)",
                            scale: 1.1,
                        },
                        {
                            clipPath:
                                "polygon(0% 0, 100% 0, 100% 100%, 0% 100%)",
                            scale: 1,
                            ease: "power2.inOut",
                            scrollTrigger: {
                                trigger: slide,
                                containerAnimation: horizontalTween,
                                start: "left 85%",
                                end: "center center",
                                scrub: 1.5,
                            },
                        },
                    );
                }

                // Parallax del fondo del salón (Profundidad)
                const bgImage = slide.querySelector(".venue-parallax-bg");
                if (bgImage) {
                    gsap.to(bgImage, {
                        xPercent: 25,
                        scale: 1.1, // Escala ligeramente para evitar bordes blancos
                        ease: "none",
                        scrollTrigger: {
                            trigger: slide,
                            containerAnimation: horizontalTween,
                            start: "left right",
                            end: "right left",
                            scrub: true,
                        },
                    });
                }

                // Elementos flotantes: Revelado + Animación "Viva" Infinita
                const float1 = slide.querySelector(".venue-float-1");
                const float2 = slide.querySelector(".venue-float-2");

                if (float1) {
                    gsap.from(float1, {
                        y: 200,
                        x: -100,
                        rotation: -15,
                        opacity: 0,
                        scrollTrigger: {
                            trigger: slide,
                            containerAnimation: horizontalTween,
                            start: "left 80%",
                            end: "center center",
                            scrub: 1.5,
                        },
                        onComplete: () => {
                            // Animación continua de "respiración" para dar vida
                            gsap.to(float1, {
                                y: "-=15",
                                rotation: "-=2",
                                duration: 3,
                                yoyo: true,
                                repeat: -1,
                                ease: "sine.inOut",
                            });
                        },
                    });
                }

                if (float2) {
                    gsap.from(float2, {
                        y: -200,
                        x: 100,
                        rotation: 15,
                        opacity: 0,
                        scrollTrigger: {
                            trigger: slide,
                            containerAnimation: horizontalTween,
                            start: "left 70%",
                            end: "center center",
                            scrub: 1.5,
                        },
                        onComplete: () => {
                            // Animación continua, desfasada de la anterior
                            gsap.to(float2, {
                                y: "+=20",
                                rotation: "+=3",
                                duration: 3.5,
                                yoyo: true,
                                repeat: -1,
                                ease: "sine.inOut",
                                delay: 0.5,
                            });
                        },
                    });
                }

                // Revelado de textos de información del salón
                const textLines = slide.querySelectorAll(".text-line");
                if (textLines.length > 0) {
                    // Asume que los textos tienen 'overflow: hidden' en CSS para este efecto
                    gsap.from(textLines, {
                        y: "110%",
                        rotation: 3,
                        opacity: 0,
                        duration: 1.2,
                        stagger: 0.1,
                        ease: "expo.out",
                        scrollTrigger: {
                            trigger: slide,
                            containerAnimation: horizontalTween,
                            start: "left 65%",
                            toggleActions: "play none none reverse",
                        },
                    });
                }
            });

            // ==========================================
            // 5. BOTONES MAGNÉTICOS AVANZADOS (3D / Parallax Interno)
            // ==========================================
            document
                .querySelectorAll(".magnetic-wrapper")
                .forEach((wrapper) => {
                    const btn = wrapper.querySelector(".magnetic-button");
                    const btnText = btn?.querySelector(".magnetic-text"); // Si tienes un span de texto adentro

                    if (btn) {
                        wrapper.addEventListener("mousemove", (e) => {
                            const rect = wrapper.getBoundingClientRect();
                            // Multiplicadores determinan la fuerza magnética
                            const x =
                                (e.clientX - rect.left - rect.width / 2) * 0.4;
                            const y =
                                (e.clientY - rect.top - rect.height / 2) * 0.4;

                            gsap.to(btn, {
                                x: x,
                                y: y,
                                duration: 0.6,
                                ease: "power3.out",
                            });

                            // Si el botón tiene texto, lo mueve un poco menos creando un efecto 3D
                            if (btnText) {
                                gsap.to(btnText, {
                                    x: x * 0.5,
                                    y: y * 0.5,
                                    duration: 0.6,
                                    ease: "power3.out",
                                });
                            }
                        });

                        wrapper.addEventListener("mouseleave", () => {
                            // Elastic.out le da ese "latigazo" satisfactorio al soltarlo
                            gsap.to(btn, {
                                x: 0,
                                y: 0,
                                duration: 1.2,
                                ease: "elastic.out(1, 0.3)",
                            });
                            if (btnText) {
                                gsap.to(btnText, {
                                    x: 0,
                                    y: 0,
                                    duration: 1.2,
                                    ease: "elastic.out(1, 0.3)",
                                });
                            }
                        });
                    }
                });
        }
    });

    // ========================================================
    // VISTA: SERVICIOS
    // ========================================================
    if (document.querySelector(".customizer-track")) {
        const track = document.querySelector(".customizer-track");

        const tlMaster = gsap.timeline({
            scrollTrigger: {
                trigger: track,
                start: "top top",
                end: "bottom bottom",
                scrub: 0.5,
                pin: ".customizer-visualizer",
            },
        });

        tlMaster
            .to(".scanner-line", { left: "100%", ease: "none", duration: 3 }, 0)
            .to(
                ".layer-layout",
                { clipPath: "inset(0 0% 0 0)", ease: "none", duration: 3 },
                0,
            )
            .to(
                ".layer-arch",
                { scale: 0.9, z: -200, filter: "blur(4px)", duration: 3 },
                0,
            );

        tlMaster.to(".scanner-line", { opacity: 0, duration: 0.1 }, 3);

        tlMaster
            .to(
                ".layer-lighting",
                {
                    clipPath: "circle(150% at 50% 50%)",
                    ease: "power2.inOut",
                    duration: 3,
                },
                3,
            )
            .to(".layer-layout", { scale: 1.05, duration: 3 }, 3);

        tlMaster.fromTo(
            ".layer-fx",
            { opacity: 0, scale: 1.2, rotationZ: 5 },
            {
                opacity: 1,
                scale: 1,
                rotationZ: 0,
                ease: "back.out(1.5)",
                duration: 3,
            },
            6,
        );

        gsap.utils.toArray(".step-card").forEach((card) => {
            gsap.fromTo(
                card,
                { y: 150, opacity: 0, rotationX: -15 },
                {
                    y: 0,
                    opacity: 1,
                    rotationX: 0,
                    ease: "power2.out",
                    scrollTrigger: {
                        trigger: card,
                        start: "top 80%",
                        end: "top 40%",
                        scrub: 1,
                    },
                },
            );
        });
    }

    // ========================================================
    // VISTA: EXPERIENCIAS (La más reciente)
    // ========================================================
    if (
        document.querySelector(".hero-bg-wrapper") &&
        document.querySelector(".marquee-track")
    ) {
        const cursorExp = document.getElementById("custom-cursor");

        if (cursorExp) {
            window.addEventListener("mousemove", (e) => {
                gsap.to(cursorExp, {
                    x: e.clientX,
                    y: e.clientY,
                    duration: 0.1,
                    ease: "power2.out",
                });
            });

            document.querySelectorAll(".cursor-hover-target").forEach((el) => {
                el.addEventListener("mouseenter", () => {
                    gsap.to(cursorExp, {
                        scale: 4,
                        duration: 0.3,
                        ease: "back.out(2)",
                    });
                });
                el.addEventListener("mouseleave", () => {
                    gsap.to(cursorExp, {
                        scale: 1,
                        duration: 0.3,
                        ease: "power2.out",
                    });
                });
            });
        }

        const heroBgExp = document.querySelector(".hero-img");
        if (heroBgExp) {
            window.addEventListener("mousemove", (e) => {
                const xPos = (e.clientX / window.innerWidth - 0.5) * 40;
                const yPos = (e.clientY / window.innerHeight - 0.5) * 40;
                gsap.to(heroBgExp, {
                    x: xPos,
                    y: yPos,
                    duration: 1.5,
                    ease: "power2.out",
                });
            });
        }

        const tlHeroExp = gsap.timeline();
        tlHeroExp.fromTo(
            ".hero-img",
            { scale: 1.2 },
            { scale: 1, duration: 3, ease: "power3.out" },
            0,
        );
        tlHeroExp.to(
            [".hero-label", ".hero-title-line"],
            {
                clipPath: "polygon(0 0%, 100% 0%, 100% 100%, 0 100%)",
                duration: 1.8,
                stagger: 0.15,
                ease: "expo.out",
            },
            0.2,
        );
        tlHeroExp.to(".scroll-indicator", { opacity: 1, duration: 1 }, 1.5);

        gsap.fromTo(
            ".scroll-line",
            { yPercent: -100 },
            { yPercent: 100, duration: 1.5, ease: "power2.inOut", repeat: -1 },
        );
        gsap.to(".marquee-track", {
            xPercent: -33.33,
            ease: "none",
            duration: 10,
            repeat: -1,
        });

        gsap.to([".grid-title", ".grid-desc"], {
            scrollTrigger: { trigger: ".grid-title", start: "top 85%" },
            clipPath: "polygon(0 0%, 100% 0%, 100% 100%, 0 100%)",
            duration: 1.5,
            stagger: 0.2,
            ease: "expo.out",
        });

        gsap.utils.toArray(".grid-card").forEach((card) => {
            let img = card.querySelector(".grid-img");
            let tlCard = gsap.timeline({
                scrollTrigger: { trigger: card, start: "top 90%" },
            });
            tlCard
                .to(card, {
                    clipPath: "inset(0% 0 0 0)",
                    duration: 2,
                    ease: "expo.inOut",
                })
                .fromTo(
                    img,
                    { scale: 1.5 },
                    { scale: 1.25, duration: 2, ease: "expo.inOut" },
                    "<",
                );
        });

        const horizontalContainerExp = document.querySelector(
            ".horizontal-container",
        );
        const skewPanels = gsap.utils.toArray(".panel-skew");

        if (horizontalContainerExp && skewPanels.length > 0) {
            let scrollTweenExp = gsap.to(horizontalContainerExp, {
                xPercent: (-100 * (skewPanels.length - 1)) / skewPanels.length,
                ease: "none",
                scrollTrigger: {
                    trigger: ".horizontal-wrapper",
                    pin: true,
                    scrub: 1.5,
                    end: () => "+=" + horizontalContainerExp.scrollWidth,
                },
            });

            let proxy = { skew: 0 };
            let skewSetter = gsap.quickSetter(skewPanels, "skewX", "deg");
            let clamp = gsap.utils.clamp(-10, 10);

            ScrollTrigger.create({
                onUpdate: (self) => {
                    let skew = clamp(self.getVelocity() / -150);
                    if (Math.abs(skew) > Math.abs(proxy.skew)) {
                        proxy.skew = skew;
                        gsap.to(proxy, {
                            skew: 0,
                            duration: 0.8,
                            ease: "power3",
                            overwrite: true,
                            onUpdate: () => skewSetter(proxy.skew),
                        });
                    }
                },
            });

            gsap.utils.toArray(".panel-img").forEach((img) => {
                gsap.to(img, {
                    xPercent: 30,
                    ease: "none",
                    scrollTrigger: {
                        trigger: ".horizontal-wrapper",
                        containerAnimation: scrollTweenExp,
                        start: "left right",
                        end: "right left",
                        scrub: true,
                    },
                });
            });
        }
    }
});
