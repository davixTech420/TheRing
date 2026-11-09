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
    // VISTA: SALONES & TOUR VIRTUAL 360°
    // ========================================================
    if (document.getElementById("panorama") || document.querySelector(".salones-page")) {
        // Objeto global de control del tour 360
        window.ringTourController = {
            viewer: null,
            currentScene: "entrada",
            autoRotating: false,

            init() {
                const panoEl = document.getElementById("panorama");
                if (!panoEl || !window.pannellum) return;

                try {
                    this.viewer = window.pannellum.viewer("panorama", {
                        default: {
                            firstScene: "entrada",
                            author: "Eventos The Ring",
                            sceneFadeDuration: 150, // Transición suave ultra rápida sin oscurecer ni bloquear clics
                            autoLoad: true,
                            preload: true,
                            compass: false,
                            mouseZoom: false, // Evita atrapar el scroll suave de la página
                            showZoomCtrl: false,
                            showFullscreenCtrl: false,
                        },
                        scenes: {
                            entrada: {
                                title: "Entrada Principal",
                                type: "equirectangular",
                                panorama: "/tour360/entrada.webp",
                                pitch: 3,
                                yaw: 1,
                                hfov: 200,
                                hotSpots: [
                                    {
                                        pitch: -180.1,
                                        yaw: 180,
                                        type: "scene",
                                        text: "Ingresar Eventos The Ring",
                                        sceneId: "recepcion",
                                    },
                                ],
                            },

                            recepcion: {
                                title: "Recepción",
                                type: "equirectangular",
                                panorama: "/tour360/recepcion.webp",
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
                                title: "Escaleras al Piso 2",
                                type: "equirectangular",
                                panorama: "/tour360/escalerasprimer.webp",
                                pitch: -3,
                                yaw: 260,
                                hfov: 200,
                                hotSpots: [
                                    {
                                        pitch: -35,
                                        yaw: -8.1,
                                        type: "scene",
                                        text: "Recepción",
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
                                panorama: "/tour360/segundo.webp",
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
                                title: "Escaleras al Piso 3",
                                type: "equirectangular",
                                panorama: "/tour360/escalerastercer.webp",
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
                                title: "Hall Piso 3",
                                type: "equirectangular",
                                panorama: "/tour360/tercer.webp",
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
                                        text: "Salón nubes",
                                        sceneId: "primersalon",
                                    },
                                ],
                            },

                            bañoshombres: {
                                title: "Baño hombres",
                                type: "equirectangular",
                                panorama: "/tour360/bañohombre.webp",
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
                                panorama: "/tour360/bañomujer.webp",
                                yaw: 115,
                                pitch: -8,
                                hfov: 200,
                                hotSpots: [
                                    {
                                        pitch: -12,
                                        yaw: 110,
                                        type: "scene",
                                        text: "Salón",
                                        sceneId: "tercerpiso",
                                    },
                                ],
                            },

                            primersalon: {
                                title: "Salón nubes",
                                type: "equirectangular",
                                panorama: "/tour360/primersalon.webp",
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
                                        text: "Salir del salón",
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
                                panorama: "/tour360/ladoderecho.webp",
                                yaw: 120,
                                pitch: 1,
                                hfov: 200,
                                hotSpots: [
                                    {
                                        pitch: -3,
                                        yaw: 68,
                                        type: "scene",
                                        text: "Salir del salón",
                                        sceneId: "tercerpiso",
                                    },
                                    {
                                        pitch: -2,
                                        yaw: 100,
                                        type: "scene",
                                        text: "Centro del salón",
                                        sceneId: "primersalon",
                                    },
                                ],
                            },

                            ladoizquierdo: {
                                title: "Vista lateral izquierda",
                                type: "equirectangular",
                                panorama: "/tour360/ladoizquierdo.webp",
                                yaw: 5,
                                hfov: 200,
                                hotSpots: [
                                    {
                                        pitch: -2,
                                        yaw: 140,
                                        type: "scene",
                                        text: "Salir del salón",
                                        sceneId: "tercerpiso",
                                    },
                                    {
                                        pitch: -2,
                                        yaw: 105,
                                        type: "scene",
                                        text: "Centro del salón",
                                        sceneId: "primersalon",
                                    },
                                    {
                                        pitch: -8,
                                        yaw: -130,
                                        type: "scene",
                                        text: "Cocina",
                                        sceneId: "cocinasegundo",
                                    },
                                ],
                            },

                            cocinasegundo: {
                                title: "Cocina",
                                type: "equirectangular",
                                panorama: "/tour360/cocinasegundo.webp",
                                yaw: 5,
                                hotSpots: [
                                    {
                                        pitch: -2,
                                        yaw: 85,
                                        type: "scene",
                                        text: "Volver al salón",
                                        sceneId: "primersalon",
                                    },
                                ],
                            },

                            escalerascuarto: {
                                title: "Escaleras",
                                type: "equirectangular",
                                panorama: "/tour360/escalerascuarto.webp",
                                yaw: 5,
                                hfov: 200,
                                hotSpots: [
                                    {
                                        pitch: 20,
                                        yaw: 222,
                                        type: "scene",
                                        text: "Cuarto piso",
                                        sceneId: "cuartopiso",
                                    },
                                    {
                                        pitch: -60,
                                        yaw: -24,
                                        type: "scene",
                                        text: "Tercer piso",
                                        sceneId: "tercerpiso",
                                    },
                                ],
                            },

                            cuartopiso: {
                                title: "Gran Salón Imperial",
                                type: "equirectangular",
                                panorama: "/tour360/cuartopiso.webp",
                                yaw: 5,
                                hfov: 200,
                                hotSpots: [
                                    {
                                        pitch: -10,
                                        yaw: -100,
                                        type: "scene",
                                        text: "Vista lateral izquierda",
                                        sceneId: "vistaizquierdacuarto",
                                    },
                                    {
                                        pitch: -8,
                                        yaw: -175,
                                        type: "scene",
                                        text: "Bajar escaleras",
                                        sceneId: "escalerascuarto",
                                    },
                                    {
                                        pitch: 2,
                                        yaw: 120,
                                        type: "scene",
                                        text: "Vista lateral derecha",
                                        sceneId: "vistaderechacuarto",
                                    },
                                    {
                                        pitch: 2,
                                        yaw: 90,
                                        type: "scene",
                                        text: "Vista lateral derecha",
                                        sceneId: "vistaderecuarto",
                                    },
                                    {
                                        pitch: -5,
                                        yaw: -125,
                                        type: "scene",
                                        text: "Cocina",
                                        sceneId: "cocinacuarto",
                                    },
                                    {
                                        pitch: -5,
                                        yaw: -165,
                                        type: "scene",
                                        text: "Baño mujeres",
                                        sceneId: "bañomujerescuarto",
                                    },
                                    {
                                        pitch: -5,
                                        yaw: 150,
                                        type: "scene",
                                        text: "Baño Hombres",
                                        sceneId: "bañohombrescuarto",
                                    },
                                ],
                            },

                            vistaizquierdacuarto: {
                                title: "Gran Salón Imperial",
                                type: "equirectangular",
                                panorama: "/tour360/vistaizquierdacuarto.webp",
                                yaw: 5,
                                hfov: 200,
                                hotSpots: [
                                    {
                                        pitch: -4,
                                        yaw: -140,
                                        type: "scene",
                                        text: "Cocina",
                                        sceneId: "cocinacuarto",
                                    },
                                    {
                                        pitch: -4,
                                        yaw: -180,
                                        type: "scene",
                                        text: "Baño mujeres",
                                        sceneId: "bañomujerescuarto",
                                    },
                                    {
                                        pitch: -4,
                                        yaw: -195,
                                        type: "scene",
                                        text: "Bajar escaleras",
                                        sceneId: "escalerascuarto",
                                    },
                                    {
                                        pitch: -4,
                                        yaw: 120,
                                        type: "scene",
                                        text: "Centro del salón",
                                        sceneId: "cuartopiso",
                                    },
                                ],
                            },

                            vistaderechacuarto: {
                                title: "Gran Salón Imperial",
                                type: "equirectangular",
                                panorama: "/tour360/vistaderechacuarto.webp",
                                yaw: 5,
                                hfov: 200,
                                hotSpots: [
                                    {
                                        pitch: -2,
                                        yaw: -10,
                                        type: "scene",
                                        text: "Vista lateral",
                                        sceneId: "vistaderecuarto",
                                    },
                                    {
                                        pitch: -4,
                                        yaw: -60,
                                        type: "scene",
                                        text: "Centro del salón",
                                        sceneId: "cuartopiso",
                                    },
                                ],
                            },

                            vistaderecuarto: {
                                title: "Gran Salón Imperial",
                                type: "equirectangular",
                                panorama: "/tour360/vistaderecuarto.webp",
                                yaw: 5,
                                hfov: 200,
                                hotSpots: [
                                    {
                                        pitch: -5,
                                        yaw: 170,
                                        type: "scene",
                                        text: "Vista lateral",
                                        sceneId: "vistaderechacuarto",
                                    },
                                    {
                                        pitch: -5,
                                        yaw: 230,
                                        type: "scene",
                                        text: "Bajar escaleras",
                                        sceneId: "escalerascuarto",
                                    },
                                    {
                                        pitch: -5,
                                        yaw: 205,
                                        type: "scene",
                                        text: "Baño hombres",
                                        sceneId: "bañohombrescuarto",
                                    },
                                    {
                                        pitch: -7,
                                        yaw: 250,
                                        type: "scene",
                                        text: "Centro del salón",
                                        sceneId: "cuartopiso",
                                    },
                                ],
                            },

                            cocinacuarto: {
                                title: "Cocina",
                                type: "equirectangular",
                                panorama: "/tour360/cocinacuarto.webp",
                                yaw: 5,
                                hfov: 200,
                                hotSpots: [
                                    {
                                        pitch: -2,
                                        yaw: -20,
                                        type: "scene",
                                        text: "Centro salón",
                                        sceneId: "cuartopiso",
                                    },
                                ],
                            },

                            bañomujerescuarto: {
                                title: "Baño mujeres",
                                type: "equirectangular",
                                panorama: "/tour360/bañomujerescuarto.webp",
                                yaw: 5,
                                hfov: 200,
                                hotSpots: [
                                    {
                                        pitch: 2,
                                        yaw: 100,
                                        type: "scene",
                                        text: "Centro salón",
                                        sceneId: "cuartopiso",
                                    },
                                ],
                            },

                            bañohombrescuarto: {
                                title: "Baño hombres",
                                type: "equirectangular",
                                panorama: "/tour360/bañohombrescuarto.webp",
                                yaw: 5,
                                hfov: 200,
                                hotSpots: [
                                    {
                                        pitch: -6,
                                        yaw: 260,
                                        type: "scene",
                                        text: "Centro salón",
                                        sceneId: "cuartopiso",
                                    },
                                ],
                            },
                        },
                    });

                    // Sincronizar eventos de escena
                    this.viewer.on("load", () => {
                        const sceneId = this.viewer.getScene();
                        this.currentScene = sceneId;
                        const sceneConfig = this.viewer.getConfig()?.scenes?.[sceneId];
                        const title = sceneConfig?.title || "Ambiente The Ring";
                        window.dispatchEvent(
                            new CustomEvent("ring-scene-changed", {
                                detail: { sceneId, title },
                            }),
                        );
                    });
                } catch (e) {
                    console.error("Error al inicializar Pannellum:", e);
                }
            },

            loadScene(sceneId) {
                if (this.viewer) {
                    this.viewer.loadScene(sceneId);
                    this.currentScene = sceneId;
                }
            },

            toggleAutoRotate() {
                if (!this.viewer) return false;
                if (this.autoRotating) {
                    this.viewer.stopAutoRotate();
                    this.autoRotating = false;
                } else {
                    this.viewer.startAutoRotate(-2);
                    this.autoRotating = true;
                }
                return this.autoRotating;
            },

            zoomIn() {
                if (!this.viewer) return;
                const hfov = this.viewer.getHfov();
                this.viewer.setHfov(Math.max(60, hfov - 25));
            },

            zoomOut() {
                if (!this.viewer) return;
                const hfov = this.viewer.getHfov();
                this.viewer.setHfov(Math.min(220, hfov + 25));
            },

            toggleFullscreen() {
                if (!this.viewer) return;
                this.viewer.toggleFullscreen();
            },
        };

        // Inicializar controlador inmediatamente si el contenedor panorama existe
        if (document.getElementById("panorama")) {
            window.ringTourController.init();
        } else {
            document.addEventListener("DOMContentLoaded", () => {
                if (document.getElementById("panorama")) {
                    window.ringTourController.init();
                }
            });
        }

        // ==========================================
        // ANIMACIONES GSAP PARA LA PÁGINA SALONES
        // ==========================================
        const salonesHero = document.querySelector(".salones-hero");
        if (salonesHero) {
            const heroTl = gsap.timeline({ defaults: { ease: "power4.out" } });

            heroTl
                .from(".salones-hero-badge", {
                    y: 30,
                    opacity: 0,
                    duration: 0.9,
                    delay: 0.2,
                })
                .from(
                    ".salones-hero-title-line",
                    {
                        y: 80,
                        opacity: 0,
                        stagger: 0.15,
                        duration: 1.2,
                    },
                    "-=0.6",
                )
                .from(
                    ".salones-hero-desc",
                    {
                        y: 30,
                        opacity: 0,
                        duration: 1,
                    },
                    "-=0.8",
                )
                .from(
                    ".salones-hero-btn",
                    {
                        y: 20,
                        opacity: 0,
                        stagger: 0.1,
                        duration: 0.8,
                    },
                    "-=0.7",
                )
                .from(
                    ".salones-stat-pill",
                    {
                        scale: 0.9,
                        opacity: 0,
                        stagger: 0.08,
                        duration: 0.7,
                    },
                    "-=0.5",
                );
        }

        // Animación de entrada marco del Tour 360
        const tourWrapper = document.querySelector(".tour-visual-wrapper");
        if (tourWrapper) {
            gsap.from(tourWrapper, {
                scrollTrigger: {
                    trigger: tourWrapper,
                    start: "top 80%",
                    end: "top 45%",
                    scrub: 1,
                },
                y: 50,
                scale: 0.96,
                opacity: 0.3,
                duration: 1,
            });
        }

        // Animación cinemática por salón en la colección
        gsap.utils.toArray(".salon-card-section").forEach((section) => {
            const imgMask = section.querySelector(".salon-img-showcase");
            const contentBox = section.querySelector(".salon-content-showcase");

            if (imgMask) {
                gsap.from(imgMask, {
                    scrollTrigger: {
                        trigger: section,
                        start: "top 85%",
                        end: "top 50%",
                        scrub: 1.2,
                    },
                    y: 60,
                    opacity: 0.3,
                    scale: 0.95,
                });
            }

            if (contentBox) {
                gsap.from(contentBox, {
                    scrollTrigger: {
                        trigger: section,
                        start: "top 80%",
                        end: "top 45%",
                        scrub: 1.2,
                    },
                    y: 40,
                    opacity: 0,
                });
            }
        });

        // Animación tabla de especificaciones
        const matrixSection = document.querySelector(".specs-matrix-section");
        if (matrixSection) {
            gsap.from(".specs-matrix-card", {
                scrollTrigger: {
                    trigger: matrixSection,
                    start: "top 85%",
                    end: "top 50%",
                    scrub: 1,
                },
                y: 40,
                opacity: 0,
                stagger: 0.12,
            });
        }

        // Animación CTA final
        const ctaSection = document.querySelector(".salones-cta-section");
        if (ctaSection) {
            gsap.from(ctaSection, {
                scrollTrigger: {
                    trigger: ctaSection,
                    start: "top 85%",
                    end: "top 60%",
                    scrub: 1,
                },
                scale: 0.96,
                opacity: 0,
            });
        }
    }

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
