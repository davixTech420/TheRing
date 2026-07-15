
  <!-- ===== FOOTER ===== -->
  <footer class="bg-ink pt-5 pb-4">
    <div class="container">
      <div class="row g-4">
        <div class="col-lg-4">
          <span class="brand-mark text-gold fs-4">Gold<span class="text-white">Events</span></span>
          <p class="text-white-50 mt-3 small">Creamos experiencias inolvidables en los salones más exclusivos de la ciudad.</p>
        </div>
        <div class="col-6 col-lg-3">
          <h6 class="text-white">Enlaces</h6>
          <ul class="list-unstyled small mt-3">
            <li class="mb-2"><a href="#salones">Salones</a></li>
            <li class="mb-2"><a href="#tour">Tour 360°</a></li>
            <li class="mb-2"><a href="#servicios">Servicios</a></li>
            <li class="mb-2"><a href="#cotizar">Cotizar</a></li>
          </ul>
        </div>
        <div class="col-6 col-lg-5">
          <h6 class="text-white">Contacto</h6>
          <ul class="list-unstyled small mt-3 text-white-50">
            <li class="mb-2"><i class="bi bi-geo-alt text-gold me-2"></i>Cl. 40 Sur #411, Bogota</li>
            <li class="mb-2"><i class="bi bi-telephone text-gold me-2"></i>+57 301 5717859</li>
            <li class="mb-2"><i class="bi bi-envelope text-gold me-2"></i>hola@thering.com</li>
          </ul>
        </div>
      </div>
      <hr class="border-secondary mt-4" />
      <p class="text-center text-white-50 small m-0">© <span id="year"></span> The Ring. Todos los derechos reservados.</p>
    </div>
  </footer>

  <!-- ===== WHATSAPP FLOTANTE ===== -->
  <div class="wa-tip">¿Dudas? ¡Escríbenos!</div>  
  <a href="https://wa.me/573015717859?text=Hola%TheRing,%20quiero%20información%20sobre%20un%20evento" target="_blank" class="wa-float" aria-label="Escríbenos por WhatsApp">
    <i class="bi bi-whatsapp"></i>
  </a>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/pannellum@2.5.7/build/pannellum.js"></script>
  <script>

    // ===== DATA =====
    const WA_NUMBER = "525551234567";
    const salones = [
      { id:"gran",   name:"Gran Salón Imperial", cap:500, base:45000, pano:"/images/pano-gran.png",
        desc:"Elegancia clásica con candelabros de cristal, ideal para bodas de gran formato." },
      { id:"jardin", name:"Terraza Jardín",      cap:250, base:32000, pano:"/images/pano-jardin.png",
        desc:"Espacio al aire libre con luces cálidas, perfecto para recepciones al atardecer." },
      { id:"intimo", name:"Salón Íntimo",        cap:80,  base:18000, pano:"/images/pano-intimo.png",
        desc:"Ambiente acogedor y sofisticado para celebraciones privadas y exclusivas." },
    ];
    const eventTypes = [
      {v:"Boda", i:"bi-heart"}, {v:"Quince años", i:"bi-gem"},
      {v:"Empresarial", i:"bi-briefcase"}, {v:"Cumpleaños", i:"bi-balloon"},
    ];
    const cateringLevels = [
      {v:"Básico",   i:"bi-cup", price:350, desc:"Bocadillos + bebida"},
      {v:"Premium",  i:"bi-cup-hot", price:650, desc:"Menú 3 tiempos"},
      {v:"Gourmet",  i:"bi-award", price:980, desc:"Chef + maridaje"},
    ];
    const extras = [
      {v:"Decoración", i:"bi-flower1", price:8000},
      {v:"Foto y Video", i:"bi-camera-reels", price:12000},
      {v:"DJ", i:"bi-disc", price:6000},
      {v:"Orquesta", i:"bi-music-note-beamed", price:18000},
      {v:"Barra libre", i:"bi-cup-straw", price:15000},
      {v:"Transporte", i:"bi-car-front", price:5000},
    ];

    // ===== RENDER SALONES =====
    const salonGrid = document.getElementById("salonGrid");
    salones.forEach((s,idx)=>{
      salonGrid.insertAdjacentHTML("beforeend", `
        <div class="col-md-6 col-lg-4 reveal ${idx===1?'d-1':idx===2?'d-2':''}">
          <div class="card salon-card h-100 position-relative">
            <span class="view360-tag"><i class="bi bi-badge-vr me-1"></i>360°</span>
            <div class="ratio ratio-4x3"><img src="${s.pano}" alt="${s.name}" /></div>
            <div class="card-body p-4">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <h3 class="h5 m-0">${s.name}</h3>
                <span class="badge-pill-gold small">${s.cap} pers.</span>
              </div>
              <p class="text-muted small mb-3">${s.desc}</p>
              <button class="btn btn-outline-gold btn-sm w-100" onclick="openPano('${s.id}')">
                <i class="bi bi-badge-vr me-1"></i> Ver en 360°
              </button>
            </div>
          </div>
        </div>`);
    });

    // ===== PANO TABS =====
    const panoTabs = document.getElementById("panoTabs");
    salones.forEach((s,idx)=>{
      panoTabs.insertAdjacentHTML("beforeend",
        `<button class="btn btn-sm ${idx===0?'btn-gold':'btn-outline-gold'}" data-pano="${s.id}" onclick="openPano('${s.id}')">${s.name}</button>`);
    });

    // ===== 360 STREET-VIEW STYLE VIEWER =====
    const frame = document.getElementById("panoFrame");
    const img = document.getElementById("panoImg");
    const panoTitle = document.getElementById("panoTitle");
    let offset=0, dragging=false, startX=0, startOffset=0, maxOffset=0, auto=true;

    function fitPano(){
      // image height = frame height (set via CSS), width scales; compute max horizontal offset
      maxOffset = Math.max(0, img.offsetWidth - frame.offsetWidth);
      offset = Math.min(Math.max(offset,-maxOffset),0);
      img.style.transform = `translateX(${offset}px)`;
    }
    img.addEventListener("load", ()=>{ offset = -maxOffset/2; fitPano(); });
    window.addEventListener("resize", fitPano);

    function openPano(id){
      const s = salones.find(x=>x.id===id);
      img.src = s.pano;
      panoTitle.textContent = `${s.name} · capacidad ${s.cap} personas`;
      document.querySelectorAll("#panoTabs button").forEach(b=>{
        b.className = "btn btn-sm " + (b.dataset.pano===id ? "btn-gold":"btn-outline-gold");
      });
      document.getElementById("tour").scrollIntoView({behavior:"smooth"});
    }

    function pointerDown(x){ dragging=true; auto=false; startX=x; startOffset=offset; frame.classList.add("dragging"); }
    function pointerMove(x){ if(!dragging)return; offset = startOffset + (x-startX);
      offset = Math.min(Math.max(offset,-maxOffset),0); img.style.transform=`translateX(${offset}px)`; }
    function pointerUp(){ dragging=false; frame.classList.remove("dragging"); }

    frame.addEventListener("mousedown", e=>pointerDown(e.clientX));
    window.addEventListener("mousemove", e=>pointerMove(e.clientX));
    window.addEventListener("mouseup", pointerUp);
    frame.addEventListener("touchstart", e=>pointerDown(e.touches[0].clientX), {passive:true});
    frame.addEventListener("touchmove", e=>pointerMove(e.touches[0].clientX), {passive:true});
    frame.addEventListener("touchend", pointerUp);

    // gentle auto-pan until user interacts
    let dir=1;
    setInterval(()=>{
      if(auto && maxOffset>0 && !dragging){
        offset += dir*0.4;
        if(offset<=-maxOffset || offset>=0) dir*=-1;
        img.style.transform=`translateX(${offset}px)`;
      }
    },30);

    // ===== QUOTE CONFIGURATOR =====
    let sel = { type:"Boda", salon:"gran", guests:150, catering:"Premium", extras:new Set(["Decoración","Foto y Video"]) };

    const etWrap=document.getElementById("eventTypes");
    eventTypes.forEach(t=>etWrap.insertAdjacentHTML("beforeend",
      `<div class="col-6 col-md-3"><div class="opt-card text-center ${t.v===sel.type?'active':''}" data-type="${t.v}" onclick="pickType('${t.v}')">
        <i class="bi ${t.i}"></i><div class="small fw-semibold mt-1">${t.v}</div></div></div>`));

    const salonSel=document.getElementById("fSalon");
    salones.forEach(s=>salonSel.insertAdjacentHTML("beforeend",`<option value="${s.id}">${s.name} (hasta ${s.cap})</option>`));

    const clWrap=document.getElementById("cateringLevels");
    cateringLevels.forEach(c=>clWrap.insertAdjacentHTML("beforeend",
      `<div class="col-md-4"><div class="opt-card text-center ${c.v===sel.catering?'active':''}" data-cat="${c.v}" onclick="pickCatering('${c.v}')">
        <i class="bi ${c.i}"></i><div class="small fw-semibold mt-1">${c.v}</div><div class="text-muted" style="font-size:.72rem">$${c.price}/pers · ${c.desc}</div></div></div>`));

    const exWrap=document.getElementById("extrasGrid");
    extras.forEach(x=>exWrap.insertAdjacentHTML("beforeend",
      `<div class="col-6 col-md-4"><div class="opt-card ${sel.extras.has(x.v)?'active':''}" data-extra="${x.v}" onclick="toggleExtra('${x.v}')">
        <div class="d-flex align-items-center gap-2"><i class="bi ${x.i}"></i><span class="small fw-semibold">${x.v}</span></div>
        <div class="text-muted" style="font-size:.72rem">+$${x.price.toLocaleString()}</div></div></div>`));

    function pickType(v){ sel.type=v; document.querySelectorAll('[data-type]').forEach(e=>e.classList.toggle('active',e.dataset.type===v)); calc(); }
    function pickCatering(v){ sel.catering=v; document.querySelectorAll('[data-cat]').forEach(e=>e.classList.toggle('active',e.dataset.cat===v)); calc(); }
    function toggleExtra(v){ sel.extras.has(v)?sel.extras.delete(v):sel.extras.add(v);
      document.querySelector(`[data-extra="${v}"]`).classList.toggle('active'); calc(); }

    const guests=document.getElementById("fGuests"), guestsLabel=document.getElementById("guestsLabel");
    guests.addEventListener("input",()=>{ sel.guests=+guests.value; guestsLabel.textContent=guests.value; calc(); });
    salonSel.addEventListener("change",()=>{ sel.salon=salonSel.value; calc(); });
    document.getElementById("fTime").addEventListener("change", calc);

    function calc(){
      const s = salones.find(x=>x.id===sel.salon);
      const cat = cateringLevels.find(c=>c.v===sel.catering);
      let total = s.base + (cat.price*sel.guests);
      let extrasTotal=0; sel.extras.forEach(v=>extrasTotal += extras.find(x=>x.v===v).price);
      total += extrasTotal;
      if(document.getElementById("fTime").value.includes("Nocturno")) total*=1.10;

      document.getElementById("priceTag").textContent = "$"+Math.round(total).toLocaleString();
      document.getElementById("perGuest").textContent = "≈ $"+Math.round(total/sel.guests).toLocaleString()+" por invitado";

      document.getElementById("summaryList").innerHTML = `
        <li class="d-flex justify-content-between py-1 border-bottom border-secondary"><span>Evento</span><b>${sel.type}</b></li>
        <li class="d-flex justify-content-between py-1 border-bottom border-secondary"><span>Salón</span><b>${s.name}</b></li>
        <li class="d-flex justify-content-between py-1 border-bottom border-secondary"><span>Invitados</span><b>${sel.guests}</b></li>
        <li class="d-flex justify-content-between py-1 border-bottom border-secondary"><span>Catering ${sel.catering}</span><b>$${(cat.price*sel.guests).toLocaleString()}</b></li>
        <li class="d-flex justify-content-between py-1"><span>Extras (${sel.extras.size})</span><b>$${extrasTotal.toLocaleString()}</b></li>`;

      // update whatsapp quote link
      const msg = `Hola GoldEvents! Quiero cotizar un evento:%0A- Tipo: ${sel.type}%0A- Salón: ${s.name}%0A- Invitados: ${sel.guests}%0A- Catering: ${sel.catering}%0A- Extras: ${[...sel.extras].join(", ")||"ninguno"}%0A- Estimado: $${Math.round(total).toLocaleString()}`;
      document.getElementById("waQuote").href = `https://wa.me/${WA_NUMBER}?text=${msg}`;
    }
    calc();

    function handleSubmit(e){
      e.preventDefault();
      alert("¡Gracias! Recibimos tu solicitud. Un asesor te contactará muy pronto.");
      return false;
    }

    // ===== COUNTERS =====
    function runCounter(el){
      const target=+el.dataset.count, dec=+el.dataset.decimals||0, suf=el.dataset.suffix||"";
      let start=0; const dur=1400, t0=performance.now();
      (function step(t){ const p=Math.min((t-t0)/dur,1);
        el.textContent=(target*p).toFixed(dec)+suf;
        if(p<1) requestAnimationFrame(step); else el.textContent=target.toFixed(dec)+suf;
      })(t0);
    }

    // ===== REVEAL + counters via IntersectionObserver =====
    const io=new IntersectionObserver((entries)=>{
      entries.forEach(en=>{ if(en.isIntersecting){ en.target.classList.add("on");
        en.target.querySelectorAll?.("[data-count]").forEach(runCounter);
        if(en.target.dataset.count) runCounter(en.target);
        io.unobserve(en.target); } });
    },{threshold:.15});
    document.querySelectorAll(".reveal").forEach(el=>io.observe(el));
    document.querySelectorAll("[data-count]").forEach(el=>io.observe(el));

    // navbar shadow on scroll
    window.addEventListener("scroll",()=>{ document.getElementById("mainNav").style.boxShadow = window.scrollY>40 ? "0 6px 24px rgba(0,0,0,.25)":"none"; });

    document.getElementById("year").textContent=new Date().getFullYear();
    fitPano();

    // ===== THEME TOGGLE (claro / oscuro) =====
    const themeToggle=document.getElementById("themeToggle");
    const themeIcon=document.getElementById("themeIcon");
    function syncThemeIcon(){
      const isDark=document.documentElement.getAttribute("data-bs-theme")==="dark";
      themeIcon.className = isDark ? "bi bi-sun-fill" : "bi bi-moon-stars-fill";
      themeToggle.setAttribute("aria-label", isDark ? "Activar modo claro" : "Activar modo oscuro");
    }
    themeToggle.addEventListener("click",()=>{
      const next=document.documentElement.getAttribute("data-bs-theme")==="dark" ? "light":"dark";
      document.documentElement.setAttribute("data-bs-theme",next);
      localStorage.setItem("ge-theme",next);
      syncThemeIcon();
    });
    syncThemeIcon();
  </script>
</body>
</html>
