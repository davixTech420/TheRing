
<!DOCTYPE html>
<html lang="es" data-bs-theme="light">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>TheRing — Salones y Eventos Premium</title>
  <meta name="description" content="Bodas, quince años, eventos empresariales y celebraciones exclusivas. Recorre nuestros salones en 360° y obtén tu cotización personalizada." />

  <!-- Aplica el tema guardado antes de pintar para evitar parpadeo -->
  <script>
    (function(){
      var saved = localStorage.getItem("ge-theme");
      var theme = saved || (window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light");
      document.documentElement.setAttribute("data-bs-theme", theme);
    })();
  </script>

  <!-- Bootstrap 5 + Bootstrap Icons (CDN) -->
    
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.7/build/pannellum.css"/>
  <style>
    :root{
      --ge-gold:#c9a34e;
      --ge-gold-soft:#e6cf94;
      --ge-ink:#181410;
      --ge-ink-2:#221d16;
      --ge-cream:#faf6ee;
      /* theme tokens (light) */
      --ge-bg:#faf6ee;
      --ge-surface:#ffffff;
      --ge-surface-2:#ffffff;
      --ge-text:#2a241c;
      --ge-muted:#7c7364;
      --ge-border:rgba(201,163,78,.22);
      --ge-shadow:rgba(90,70,20,.1);
    }
    [data-bs-theme="dark"]{
      --ge-bg:#100d09;
      --ge-surface:#1b1610;
      --ge-surface-2:#221c14;
      --ge-text:#ece3d2;
      --ge-muted:#a89c85;
      --ge-border:rgba(201,163,78,.28);
      --ge-shadow:rgba(0,0,0,.5);
    }
    *{scroll-behavior:smooth}
    body{
      font-family:'Inter',system-ui,sans-serif;
      color:var(--ge-text);
      background:var(--ge-bg);
      overflow-x:hidden;
      transition:background .4s ease,color .4s ease;
    }
    .text-muted{color:var(--ge-muted)!important}
    h1,h2,h3,.font-serif{font-family:'Playfair Display',Georgia,serif}
    .text-gold{color:var(--ge-gold)!important}
    .bg-ink{background:var(--ge-ink)!important;color:#f4ecd9}
    .section-title{font-size:clamp(1.8rem,4vw,2.9rem);font-weight:800;line-height:1.1}

    /* Buttons */
    .btn-gold{background:var(--ge-gold);border:none;color:#1a1509;font-weight:600;box-shadow:0 8px 22px rgba(201,163,78,.35)}
    .btn-gold:hover{background:var(--ge-gold-soft);color:#1a1509}
    .btn-outline-gold{border:1.5px solid var(--ge-gold);color:var(--ge-gold);font-weight:600;background:transparent}
    .btn-outline-gold:hover{background:var(--ge-gold);color:#1a1509}

    .badge-pill-gold{display:inline-flex;align-items:center;gap:.4rem;background:rgba(201,163,78,.14);color:#9a7b2e;border:1px solid rgba(201,163,78,.35);padding:.4rem .9rem;border-radius:999px;font-size:.8rem;font-weight:600}

    /* Navbar */
    .navbar{backdrop-filter:blur(12px);background:rgba(24,20,16,.82)!important;transition:.3s}
    .navbar .nav-link{color:#e9dfc9!important;font-weight:500}
    .navbar .nav-link:hover{color:var(--ge-gold)!important}
    .brand-mark{font-family:'Playfair Display',serif;font-weight:800;letter-spacing:.5px}

    /* Hero */
    .hero{
      position:relative;min-height:92vh;display:flex;align-items:center;color:#f6efe0;padding-top:100px;
      background:linear-gradient(rgba(18,14,10,.82),rgba(18,14,10,.7)),url('/images/hero.png') center/cover no-repeat;
    }
    .hero h1{font-size:clamp(2.2rem,6vw,4.2rem);font-weight:800;line-height:1.05}
    .why-card{background:rgba(30,25,19,.72);border:1px solid rgba(201,163,78,.28);border-radius:20px;color:#f2e9d6;backdrop-filter:blur(6px)}
    .why-card .list-item i{color:var(--ge-gold)}
    .floaty{animation:floaty 6s ease-in-out infinite}
    @keyframes floaty{0%,100%{transform:translateY(0)}50%{transform:translateY(-10px)}}

    /* Sections */
    .section-alt{background:var(--ge-surface);transition:background .4s ease}
    .stat-box{background:var(--ge-surface);border:1px solid var(--ge-border);border-radius:18px;padding:1.6rem 1rem;text-align:center;height:100%;box-shadow:0 10px 30px var(--ge-shadow)}
    .stat-num{font-family:'Playfair Display',serif;font-size:clamp(2rem,5vw,2.8rem);font-weight:800;color:var(--ge-gold)}

    /* Salon cards */
    .salon-card{border:none;border-radius:20px;overflow:hidden;background:var(--ge-surface);box-shadow:0 14px 40px var(--ge-shadow);transition:.35s}
    .salon-card:hover{transform:translateY(-8px);box-shadow:0 24px 60px var(--ge-shadow)}
    .salon-card .card-body{color:var(--ge-text)}
    .salon-card .ratio img{object-fit:cover;transition:.5s}
    .salon-card:hover .ratio img{transform:scale(1.07)}
    .salon-card .view360-tag{position:absolute;top:12px;left:12px;background:rgba(24,20,16,.78);color:#f4ecd9;border:1px solid rgba(201,163,78,.5);padding:.3rem .7rem;border-radius:999px;font-size:.72rem;font-weight:600;z-index:2}

    /* Services */
    .service-box{padding:2rem 1rem;border-radius:18px;transition:.3s;height:100%}
    .service-box:hover{background:var(--ge-surface-2);box-shadow:0 14px 40px var(--ge-shadow);transform:translateY(-6px)}
    .service-box i{color:var(--ge-gold)}

    /* 360 Viewer */
    .pano-frame{position:relative;border-radius:20px;overflow:hidden;height:min(70vh,520px);cursor:grab;background:#111;box-shadow:0 20px 60px rgba(0,0,0,.35);user-select:none}
    .pano-frame.dragging{cursor:grabbing}
    .pano-img{position:absolute;top:0;left:0;height:100%;width:260%;max-width:none;object-fit:cover;will-change:transform;pointer-events:none}
    @media(max-width:768px){.pano-img{width:420%}}
    .pano-hint{position:absolute;bottom:14px;left:50%;transform:translateX(-50%);background:rgba(20,16,12,.72);color:#f4ecd9;padding:.5rem 1rem;border-radius:999px;font-size:.82rem;display:flex;gap:.5rem;align-items:center;z-index:3;pointer-events:none}
    .pano-tabs .btn{border-radius:999px}
    .pano-hotspot{position:absolute;width:38px;height:38px;border-radius:50%;background:rgba(201,163,78,.9);color:#1a1509;display:flex;align-items:center;justify-content:center;border:2px solid #fff;box-shadow:0 4px 14px rgba(0,0,0,.4);cursor:pointer;z-index:4;animation:pulse 2s infinite}
    @keyframes pulse{0%{box-shadow:0 0 0 0 rgba(201,163,78,.6)}70%{box-shadow:0 0 0 14px rgba(201,163,78,0)}100%{box-shadow:0 0 0 0 rgba(201,163,78,0)}}

    /* Form / quote */
    .quote-wrap{background:var(--ge-surface);border-radius:24px;box-shadow:0 24px 70px var(--ge-shadow);overflow:hidden}
    .quote-side{background:linear-gradient(160deg,var(--ge-ink),var(--ge-ink-2));color:#f2e9d6}
    .form-control,.form-select{border-radius:12px;padding:.7rem .9rem}
    .form-control:focus,.form-select:focus{border-color:var(--ge-gold);box-shadow:0 0 0 .2rem rgba(201,163,78,.25)}
    .opt-card{border:1.5px solid var(--ge-border);border-radius:14px;padding:.85rem;cursor:pointer;transition:.2s;height:100%;color:var(--ge-text)}
    .opt-card:hover{border-color:var(--ge-gold)}
    .opt-card.active{border-color:var(--ge-gold);background:rgba(201,163,78,.1)}
    .opt-card i{font-size:1.4rem;color:var(--ge-gold)}
    .price-tag{font-family:'Playfair Display',serif;font-size:clamp(2rem,6vw,3rem);font-weight:800}
    input[type=range]{accent-color:var(--ge-gold)}

    /* WhatsApp floating */
    .wa-float{position:fixed;right:20px;bottom:20px;z-index:1080;width:60px;height:60px;border-radius:50%;background:#25D366;color:#fff;display:flex;align-items:center;justify-content:center;font-size:2rem;box-shadow:0 8px 24px rgba(37,211,102,.5);text-decoration:none;transition:.3s;animation:waPulse 2.5s infinite}
    .wa-float:hover{transform:scale(1.1);color:#fff}
    .wa-tip{position:fixed;right:90px;bottom:32px;z-index:1080;background:var(--ge-surface);padding:.55rem .9rem;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,.2);font-size:.85rem;font-weight:600;color:var(--ge-text)}
    @keyframes waPulse{0%{box-shadow:0 0 0 0 rgba(37,211,102,.5)}70%{box-shadow:0 0 0 18px rgba(37,211,102,0)}100%{box-shadow:0 0 0 0 rgba(37,211,102,0)}}
    @media(max-width:576px){.wa-tip{display:none}}

    /* Reveal on scroll */
    .reveal{opacity:0;transform:translateY(28px);transition:.7s cubic-bezier(.2,.7,.2,1)}
    .reveal.on{opacity:1;transform:none}
    .d-1{transition-delay:.12s}.d-2{transition-delay:.24s}.d-3{transition-delay:.36s}

    footer a{color:#cbb87f;text-decoration:none}
    footer a:hover{color:var(--ge-gold)}
  </style>
</head>
<body data-bs-spy="scroll" data-bs-target="#mainNav">

  <!-- ===== NAVBAR ===== -->
  <nav id="mainNav" class="navbar navbar-expand-lg fixed-top py-3">
    <div class="container">


      <a class="navbar-brand brand-mark text-gold fs-4" href="#inicio">
<img width=50 height=50 src="favicon.ico" alt="The Ring">  


      </a>
      
      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      
      <i class="bi bi-list text-gold fs-2"></i>
      </button>
      <div class="collapse navbar-collapse" id="nav">
        <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
          <li class="nav-item"><a class="nav-link" href="#inicio">Inicio</a></li>
          <li class="nav-item"><a class="nav-link" href="#salones">Salones</a></li>
          <li class="nav-item"><a class="nav-link" href="#tour">Tour 360°</a></li>
          <li class="nav-item"><a class="nav-link" href="#servicios">Servicios</a></li>
          <li class="nav-item"><a class="nav-link" href="#cotizar">Cotizar</a></li>
          <li class="nav-item ms-lg-2"><a class="btn btn-gold px-3" href="#cotizar"><i class="bi bi-calendar-check me-1"></i>Reservar</a></li>
          <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
            <button id="themeToggle" class="btn btn-outline-gold rounded-circle d-inline-flex align-items-center justify-content-center" style="width:42px;height:42px" type="button" aria-label="Cambiar tema claro u oscuro">
              <i class="bi bi-moon-stars-fill" id="themeIcon"></i>
            </button>
          </li>
        </ul>
      </div>
    </div>
  </nav>
