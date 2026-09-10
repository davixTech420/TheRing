import './bootstrap';
import Alpine from 'alpinejs';
import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';

// 1. Inicializar Alpine.js
window.Alpine = Alpine;
Alpine.start();

// 2. Registrar GSAP
gsap.registerPlugin(ScrollTrigger);

// 3. Ejecutar animaciones solo cuando el DOM esté listo
document.addEventListener("DOMContentLoaded", () => {
    
    // --- HERO REVEAL ---
    const heroTl = gsap.timeline();
    heroTl.to(".hero-media", { scale: 1, duration: 2.5, ease: "power4.out" })
          .to(".hero-title-part", { y: 0, stagger: 0.15, duration: 1.2, ease: "power4.out" }, "-=2")
          .to(".scroll-indicator", { opacity: 1, y: 10, duration: 1, repeat: -1, yoyo: true, ease: "sine.inOut" }, "-=0.5");

    gsap.to(".hero-bg-container", {
        scrollTrigger: { trigger: ".hero-section", start: "top top", end: "bottom top", scrub: 1 },
        y: 150, opacity: 0
    });

    // --- BENTO BOX (Misión/Visión) ---
    gsap.from(".corporate-header", {
        scrollTrigger: { trigger: ".corporate-section", start: "top 80%", end: "top 50%", scrub: 1 },
        y: 50, opacity: 0
    });
    
    gsap.from(".reveal-box", {
        scrollTrigger: { trigger: ".corporate-section", start: "top 70%", end: "top 30%", scrub: 1 },
        y: 80, opacity: 0, scale: 0.95, stagger: 0.2
    });

    // --- SCROLL HORIZONTAL (LA MAGIA APPLE) ---
    const horizontalScroll = document.querySelector('.horizontal-wrapper');
    if (horizontalScroll) {
        const panels = gsap.utils.toArray('.panel');

        gsap.to(panels, {
            xPercent: -100 * (panels.length - 1), 
            ease: "none",
            scrollTrigger: {
                trigger: ".horizontal-scroll-container", 
                pin: true, 
                scrub: 1, 
                snap: 1 / (panels.length - 1), 
                end: () => "+=" + horizontalScroll.offsetWidth 
            }
        });

        gsap.utils.toArray('.reveal-img-container').forEach(container => {
            let img = container.querySelector('img');
            gsap.set(container, { clipPath: "inset(20% 20% 20% 20% round 30px)" });
            gsap.set(img, { scale: 1.4 });
            
            gsap.to(container, {
                clipPath: "inset(0% 0% 0% 0% round 32px)",
                scrollTrigger: { trigger: container, containerAnimation: gsap.getById(horizontalScroll), start: "left center", end: "right center", scrub: 1 }
            });
            gsap.to(img, {
                scale: 1, 
                scrollTrigger: { trigger: container, containerAnimation: gsap.getById(horizontalScroll), start: "left center", end: "right center", scrub: 1 }
            });
        });
    }

    // --- MOTOR DE RESERVAS (FORMULARIO) ---
    gsap.from(".builder-header", { 
        scrollTrigger: { trigger: ".builder-section", start: "top 80%", end: "top 50%", scrub: 1 }, 
        y: 100, opacity: 0 
    });
    
    gsap.from(".form-interactive-container", {
        scrollTrigger: { trigger: ".form-interactive-container", start: "top 90%", end: "top 40%", scrub: 1.5 },
        y: 100, scale: 0.95, opacity: 0, transformOrigin: "bottom center"
    });

    // --- MAPA TÁCTICO ---
    gsap.from(".map-header", { 
        scrollTrigger: { trigger: ".map-section", start: "top 80%", end: "top 50%", scrub: 1 }, 
        y: 60, opacity: 0 
    });
    
    gsap.fromTo(".map-container", 
        { clipPath: "inset(40% 40% 40% 40% round 100px)", opacity: 0 },
        { clipPath: "inset(0% 0% 0% 0% round 48px)", opacity: 1, scrollTrigger: { trigger: ".map-section", start: "top 75%", end: "top 25%", scrub: 1.2 } }
    );
    
    gsap.from(".map-iframe-wrapper", { 
        scrollTrigger: { trigger: ".map-section", start: "top 90%", end: "bottom top", scrub: true }, 
        scale: 1.3, rotation: 1 
    });
    
    gsap.from(".map-info-card", { 
        scrollTrigger: { trigger: ".map-container", start: "top 50%", end: "top 30%", scrub: 1 }, 
        x: -50, opacity: 0 
    });

    // --- FOOTER REVEAL ---
    gsap.from(".footer-content > div", {
        scrollTrigger: { trigger: ".footer-section", start: "top 90%", end: "top 60%", scrub: 1 },
        y: 50, opacity: 0, stagger: 0.1
    });
});