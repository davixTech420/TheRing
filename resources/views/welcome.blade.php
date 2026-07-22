
<?php
include(resource_path('views/partials/header.blade.php'));
?>
@vite(['resources/js/app.js'])
 <!-- ===== HERO ===== -->
  <header id="inicio" class="hero">
    <div class="container">
      <div class="row  align-items-center g-5">
        <div class="col-lg-7">
          <span class="badge-pill-gold reveal"><i class="bi bi-star-fill"></i> Más de 850 eventos realizados</span>
          <h1 class="mt-4 reveal">Creamos momentos que permanecerán <span class="text-gold">para siempre.</span></h1>
          <p class="lead mt-3 reveal d-1 opacity-75">Descubre bodas, eventos empresariales, quince años, cumpleaños y celebraciones exclusivas con una experiencia premium.</p>
          <div class="d-flex flex-wrap gap-3 mt-4 reveal d-2">
            <a href="#cotizar" class="btn btn-gold btn-lg px-4"><i class="bi bi-calendar-check me-2"></i>Cotizar Evento</a>
            <a href="#tour" class="btn btn-outline-gold btn-lg px-4"><i class="bi bi-badge-vr me-2"></i>Tour 360°</a>
          </div>
        </div>
        <div class="col-lg-5 reveal d-2">
          <div class="why-card p-4 p-md-5 floaty">
            <h3 class="mb-4 text-gold">¿Por qué elegirnos?</h3>
            <ul class="list-unstyled m-0">
              <li class="list-item py-2 d-flex align-items-center"><i class="bi bi-check-circle-fill me-3 fs-5"></i> Salones para 10 a 500 personas</li>
              <li class="list-item py-2 d-flex align-items-center"><i class="bi bi-check-circle-fill me-3 fs-5"></i> Catering Premium</li>
              <li class="list-item py-2 d-flex align-items-center"><i class="bi bi-check-circle-fill me-3 fs-5"></i> Decoración Personalizada</li>
              <li class="list-item py-2 d-flex align-items-center"><i class="bi bi-check-circle-fill me-3 fs-5"></i> Fotografía y Video</li>
              <li class="list-item py-2 d-flex align-items-center"><i class="bi bi-check-circle-fill me-3 fs-5"></i> DJ y Orquesta</li>
              <li class="list-item py-2 d-flex align-items-center"><i class="bi bi-check-circle-fill me-3 fs-5"></i> Cotización instantánea online</li>
            </ul>
            <a href="#cotizar" class="btn btn-gold w-100 mt-4 py-2 fw-semibold">Comienza tu Cotización <i class="bi bi-arrow-right ms-1"></i></a>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- ===== STATS ===== -->
  <section class="py-5">
    <div class="container py-3">
      <div class="row g-3 g-md-4">
        <div class="col-6 col-lg-3 reveal"><div class="stat-box"><div class="stat-num" data-count="850" data-suffix="+">0</div><div class="text-uppercase small text-muted mt-1">Eventos</div></div></div>
        <div class="col-6 col-lg-3 reveal d-1"><div class="stat-box"><div class="stat-num" data-count="15">0</div><div class="text-uppercase small text-muted mt-1">Años</div></div></div>
        <div class="col-6 col-lg-3 reveal d-2"><div class="stat-box"><div class="stat-num" data-count="120" data-suffix="K">0</div><div class="text-uppercase small text-muted mt-1">Invitados</div></div></div>
        <div class="col-6 col-lg-3 reveal d-3"><div class="stat-box"><div class="stat-num" data-count="4.9" data-decimals="1">0</div><div class="text-uppercase small text-muted mt-1"><i class="bi bi-star-fill text-gold"></i> Valoración</div></div></div>
      </div>
    </div>
  </section>





  <!-- ===== SALONES ===== -->
  <section id="salones" class="section-alt py-5">
    <div class="container py-4">
      <div class="text-center mb-5 reveal">
        <span class="badge-pill-gold">Espacios exclusivos</span>
        <h2 class="section-title mt-3">Encuentra el salón perfecto</h2>
        <p class="text-muted mx-auto" style="max-width:42rem">Cada momento merece su espacio único. Explora cada salón en 360°, como si estuvieras ahí.</p>
      </div>
      <div class="row g-4" id="salonGrid"></div>
    </div>
  </section>

  <!-- ===== TOUR 360 (STREET VIEW STYLE) ===== -->
  <section id="tour" class="py-5 bg-ink">
    <div class="container py-4">
      <div class="text-center mb-4 reveal">
        <span class="badge-pill-gold">Recorrido inmersivo</span>
        <h2 class="section-title mt-3 text-white">Tour Virtual 360°</h2>
        <p class="text-white-50 mx-auto" style="max-width:42rem">Arrastra con el dedo o el mouse para mirar alrededor de cada salón. Cambia de espacio con los botones.</p>
      </div>

      <div id="streetView" class="pano-tabs d-flex flex-wrap justify-content-center gap-2 mb-3 reveal" id="panoTabs"></div>

      <div class="pano-frame reveal d-1" id="panoFrame">
        <img class="pano-img" id="panoImg" src="/images/pano-gran.png" alt="Vista panorámica 360 del salón" draggable="false" />
        <div class="pano-hint"><i class="bi bi-arrows-move"></i> Arrastra para mirar alrededor</div>
      </div>
      <div class="text-center mt-3 reveal d-2">
        <span class="text-white-50 small" id="panoTitle">Gran Salón Imperial · capacidad 500 personas</span>
      </div>
    </div>
  </section>

  <!-- ===== SERVICIOS ===== -->
  <section id="servicios" class="py-5">
    <div class="container py-4">
      <div class="text-center mb-5 reveal">
        <span class="badge-pill-gold">Todo en un solo lugar</span>
        <h2 class="section-title mt-3">Nuestros servicios</h2>
      </div>
      <div class="row g-4 text-center">
        <div class="col-6 col-lg-3 reveal"><div class="service-box"><i class="bi bi-cup-hot fs-1"></i><h3 class="h6 mt-3">Catering Premium</h3><p class="small text-muted">Menús gourmet a la medida.</p></div></div>
        <div class="col-6 col-lg-3 reveal d-1"><div class="service-box"><i class="bi bi-flower1 fs-1"></i><h3 class="h6 mt-3">Decoración</h3><p class="small text-muted">Ambientaciones personalizadas.</p></div></div>
        <div class="col-6 col-lg-3 reveal d-2"><div class="service-box"><i class="bi bi-camera-reels fs-1"></i><h3 class="h6 mt-3">Foto y Video</h3><p class="small text-muted">Recuerdos profesionales.</p></div></div>
        <div class="col-6 col-lg-3 reveal d-3"><div class="service-box"><i class="bi bi-music-note-beamed fs-1"></i><h3 class="h6 mt-3">DJ y Orquesta</h3><p class="small text-muted">La mejor música en vivo.</p></div></div>
      </div>
    </div>
  </section>

  <!-- ===== COTIZADOR DINAMICO ===== -->
  <section id="cotizar" class="section-alt py-5">
    <div class="container py-4">
      <div class="text-center mb-5 reveal">
        <span class="badge-pill-gold">Cotización personalizada</span>
        <h2 class="section-title mt-3">Diseña y cotiza tu evento</h2>
        <p class="text-muted">Ajusta las opciones y mira el estimado actualizarse en tiempo real.</p>
      </div>

      <div class="quote-wrap reveal d-1">
        <div class="row g-0">
          <!-- Configurador -->
          <div class="col-lg-7 p-4 p-md-5">
            <form id="quoteForm" onsubmit="return handleSubmit(event)">
              <!-- Tipo de evento -->
              <label class="fw-semibold mb-2 d-block">Tipo de evento</label>
              <div class="row g-2 mb-4" id="eventTypes"></div>

              <!-- Salón -->
              <label class="fw-semibold mb-2 d-block">Salón</label>
              <select class="form-select form-select-lg mb-4" id="fSalon"></select>

              <!-- Invitados -->
              <div class="d-flex justify-content-between">
                <label class="fw-semibold mb-2">Número de invitados</label>
                <span class="fw-bold text-gold" id="guestsLabel">150</span>
              </div>
              <input type="range" class="form-range mb-4" id="fGuests" min="20" max="500" step="10" value="150" />

              <!-- Nivel catering -->
              <label class="fw-semibold mb-2 d-block">Nivel de catering</label>
              <div class="row g-2 mb-4" id="cateringLevels"></div>  

              <!-- Extras -->
              <label class="fw-semibold mb-2 d-block">Servicios adicionales</label>
              <div class="row g-2 mb-4" id="extrasGrid"></div>

              <!-- Fecha y datos -->
              <div class="row g-3">
                <div class="col-md-6"><label class="form-label small text-muted">Fecha del evento</label><input type="date" class="form-control" id="fDate" required /></div>
                <div class="col-md-6"><label class="form-label small text-muted">Franja horaria</label>
                  <select class="form-select" id="fTime"><option>Matutino</option><option selected>Vespertino</option><option>Nocturno (+10%)</option></select>
                </div>
                <div class="col-md-6"><input type="text" class="form-control" placeholder="Nombre completo" required /></div>
                <div class="col-md-6"><input type="tel" class="form-control" placeholder="Teléfono / WhatsApp" required /></div>
                <div class="col-12"><input type="email" class="form-control" placeholder="Correo electrónico" required /></div>
                <div class="col-12"><textarea class="form-control" rows="2" placeholder="Cuéntanos algún detalle especial..."></textarea></div>
              </div>
            </form>
          </div>

          <!-- Resumen precio -->
          <div class="col-lg-5 quote-side p-4 p-md-5 d-flex flex-column">
            <h3 class="text-gold">Tu estimado</h3>
            <p class="text-white-50 small">Precio referencial. Un asesor confirmará la cotización final.</p>
            <div class="price-tag text-gold my-2" id="priceTag">$0</div>
            <div class="small text-white-50 mb-3" id="perGuest">—</div>
            <ul class="list-unstyled small flex-grow-1" id="summaryList"></ul>
            <button type="submit" form="quoteForm" class="btn btn-gold btn-lg w-100 mt-3"><i class="bi bi-send me-1"></i> Enviar solicitud</button>
            <a href="#" id="waQuote" target="_blank" class="btn btn-outline-light w-100 mt-2"><i class="bi bi-whatsapp me-1"></i> Cotizar por WhatsApp</a>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php
include(resource_path('views/partials/footer.blade.php'));
?>