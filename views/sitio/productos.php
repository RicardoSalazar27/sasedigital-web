<main class="prod">
    <!-- Hero / encabezado -->
    <section class="prod__hero">
        <div class="container">
            <p class="eyebrow"><?php echo $titulo; ?></p>
            <h1 class="prod__title">Sistema Gestor Hotelero (SGH)</h1>
            <p class="prod__lead">
                Reservas, habitaciones, limpieza y reportes en un solo lugar.
                Rápido, seguro y listo para hoteles pequeños y medianos.
            </p>
            <div class="prod__actions">
                <a class="btn btn--primary" href="#contacto"><i class="fa-solid fa-paper-plane"></i> Solicitar demo</a>
                <a class="btn btn--ghost" href="#capturas"><i class="fa-solid fa-image"></i> Ver capturas</a>
            </div>
        </div>

        <!-- Hero image -->
        <figure class="prod__hero-media">
            <picture>
                <source srcset="/build/img/sgh-hero2.avif" type="image/avif">
                <source srcset="/build/img/sgh-hero2.webp" type="image/webp">
                <img loading="eager" decoding="async" src="/build/img/sgh-hero2.jpg" alt="Panel principal del SGH con calendario y ocupación">
            </picture>
        </figure>
    </section>

    <!-- Beneficios -->
    <section class="container prod__bullets">
        <article class="bullet">
            <i class="fa-solid fa-calendar-check"></i>
            <h3>Reservas sin fricción</h3>
            <p>Reserva en 3 pasos, disponibilidad por fechas y asignación de habitaciones.</p>
        </article>
        <article class="bullet">
            <i class="fa-solid fa-broom"></i>
            <h3>Operación ordenada</h3>
            <p>Estados de habitación, limpieza y check-in/out manual con control de retrasos.</p>
        </article>
        <article class="bullet">
            <i class="fa-solid fa-boxes-stacked"></i>
            <h3>Catálogo y minibar</h3>
            <p>Productos con código de barras, categorías normalizadas y proveedor libre.</p>
        </article>
        <article class="bullet">
            <i class="fa-solid fa-chart-line"></i>
            <h3>Reportes al día</h3>
            <p>Ingresos, ocupación y cortes. Exportables y listos para contabilidad.</p>
        </article>
    </section>

    <!-- Módulos -->
    <section class="prod__features">
        <div class="container">
            <h2 class="section-title">¿Qué incluye?</h2>
            <div class="feat-grid">
                <div class="card">
                    <h4><i class="fa-solid fa-bed"></i> Habitaciones</h4>
                    <p>Niveles, categorías y estados. Vista rápida de ocupación.</p>
                </div>
                <div class="card">
                    <h4><i class="fa-solid fa-calendar-days"></i> Reservas</h4>
                    <p>Rango de fechas, múltiples habitaciones por reserva y observaciones.</p>
                </div>
                <div class="card">
                    <h4><i class="fa-solid fa-people-arrows"></i> Check-in/Check-out</h4>
                    <p>Control manual por recepcionista. Cobro por salida tardía.</p>
                </div>
                <div class="card">
                    <h4><i class="fa-solid fa-store"></i> Ventas/Minibar</h4>
                    <p>Catálogo con lector de <em>barcode</em> y precios por producto.</p>
                </div>
                <div class="card">
                    <h4><i class="fa-solid fa-user-shield"></i> Usuarios y roles</h4>
                    <p>Accesos por perfil para operación segura con roles.</p>
                </div>
                <div class="card">
                    <h4><i class="fa-solid fa-file-invoice-dollar"></i> Pagos y cobros</h4>
                    <p>Descuentos, adelantos y cobros extras por reservación.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Flujo -->
    <section class="container prod__flow">
        <h2 class="section-title">Así de simple</h2>
        <ol class="flow">
            <li><strong>Busca o crea cliente</strong> (correo, teléfono o nombre).</li>
            <li><strong>Elige fechas y habitación</strong>, el sistema muestra solo lo disponible.</li>
            <li><strong>Confirma y cobra</strong> con descuentos/adelantos, listo el voucher.</li>
        </ol>
    </section>

    <!-- Capturas -->
    <section id="capturas" class="prod__gallery">
        <div class="container">
            <h2 class="section-title">Capturas</h2>
            <div class="gal-grid">
                <a class="gal" href="/build/img/sgh-calendario.jpg" data-lg="true" aria-label="Calendario">
                    <picture>
                        <source srcset="/build/img/sgh-calendario.avif" type="image/avif">
                        <source srcset="/build/img/sgh-calendario.webp" type="image/webp">
                        <img loading="lazy" decoding="async" src="/build/img/sgh-calendario.jpg" alt="Calendario de disponibilidad">
                    </picture>
                    <span>Calendario</span>
                </a>

                <a class="gal" href="/build/img/sgh-reserva.jpg" data-lg="true" aria-label="Reserva (3 pasos)">
                    <picture>
                        <source srcset="/build/img/sgh-reserva.avif" type="image/avif">
                        <source srcset="/build/img/sgh-reserva.webp" type="image/webp">
                        <img loading="lazy" decoding="async" src="/build/img/sgh-reserva.jpg" alt="Wizard de reserva en 3 pasos">
                    </picture>
                    <span>Reserva (3 pasos)</span>
                </a>

                <a class="gal" href="/build/img/sgh-habitaciones.jpg" data-lg="true" aria-label="Habitaciones">
                    <picture>
                        <source srcset="/build/img/sgh-habitaciones.avif" type="image/avif">
                        <source srcset="/build/img/sgh-habitaciones.webp" type="image/webp">
                        <img loading="lazy" decoding="async" src="/build/img/sgh-habitaciones.jpg" alt="Listado de habitaciones con estados">
                    </picture>
                    <span>Habitaciones</span>
                </a>

                <a class="gal" href="/build/img/sgh-catalogo.jpg" data-lg="true" aria-label="Catálogo">
                    <picture>
                        <source srcset="/build/img/sgh-catalogo.avif" type="image/avif">
                        <source srcset="/build/img/sgh-catalogo.webp" type="image/webp">
                        <img loading="lazy" decoding="async" src="/build/img/sgh-catalogo.jpg" alt="Catálogo con lector de códigos">
                    </picture>
                    <span>Catálogo</span>
                </a>

                <a class="gal" href="/build/img/sgh-reportes.jpg" data-lg="true" aria-label="Reportes">
                    <picture>
                        <source srcset="/build/img/sgh-reportes.avif" type="image/avif">
                        <source srcset="/build/img/sgh-reportes.webp" type="image/webp">
                        <img loading="lazy" decoding="async" src="/build/img/sgh-reportes.jpg" alt="Reportes e ingresos">
                    </picture>
                    <span>Reportes</span>
                </a>

                <a class="gal" href="/build/img/sgh-movil.jpg" data-lg="true" aria-label="Vista móvil">
                    <picture>
                        <source srcset="/build/img/sgh-movil.avif" type="image/avif">
                        <source srcset="/build/img/sgh-movil.webp" type="image/webp">
                        <img loading="lazy" decoding="async" src="/build/img/sgh-movil.jpg" alt="Vista móvil del SGH">
                    </picture>
                    <span>Móvil</span>
                </a>
            </div>
        </div>
    </section>

    <!-- CTA final -->
    <section class="prod__cta">
        <div class="container">
            <h2>¿Listo para subir tu ocupación?</h2>
            <p>Te instalamos, migramos lo básico y capacitamos a tu equipo.</p>
            <!-- <a class="btn btn--primary" href="#contacto"><i class="fa-solid fa-handshake"></i> Hablemos</a> -->
            <a class="btn btn--primary"
                href="https://wa.me/525660532035?text=Hola,%20quiero%20recibir%20informaci%C3%B3n%20sobre%20el%20Sistema%20Gestor%20Hotelero"
                target="_blank" rel="noopener"
                aria-label="Contactar por WhatsApp">
                <i class="fa-brands fa-whatsapp"></i> Hablemos
            </a>

        </div>
    </section>

    <!-- Lightbox mínimo (sin dependencias) -->
    <div id="lg" hidden>
        <button type="button" id="lgClose" aria-label="Cerrar">×</button>
        <img id="lgImg" alt="">
    </div>

    <style>
        #lg {
            position: fixed;
            inset: 0;
            display: grid;
            place-items: center;
            background: rgba(2, 8, 23, .82);
            z-index: 1200;
        }

        #lg[hidden] {
            display: none;
        }

        #lgImg {
            max-width: 92vw;
            max-height: 88vh;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, .5);
        }

        #lgClose {
            position: absolute;
            top: 10px;
            right: 14px;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, .25);
            background: rgba(255, 255, 255, .08);
            color: #fff;
            font-size: 26px;
            cursor: pointer;
        }
    </style>

    <script>
        (() => {
            const dlg = document.getElementById('lg');
            const img = document.getElementById('lgImg');
            const btn = document.getElementById('lgClose');

            // abrir
            document.querySelectorAll('.gal[data-lg="true"]').forEach(a => {
                a.addEventListener('click', e => {
                    e.preventDefault();
                    const href = a.getAttribute('href');
                    img.src = href;
                    img.alt = a.getAttribute('aria-label') || '';
                    dlg.hidden = false;
                    document.body.classList.add('no-scroll');
                });
            });

            // cerrar
            function closeLg() {
                dlg.hidden = true;
                img.src = '';
                document.body.classList.remove('no-scroll');
            }
            btn.addEventListener('click', closeLg);
            dlg.addEventListener('click', (e) => {
                if (e.target === dlg) closeLg();
            });
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') closeLg();
            });
        })();
    </script>

    <!-- SEO: schema.org Product -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Product",
            "name": "Sistema Gestor Hotelero (SGH)",
            "brand": {
                "@type": "Brand",
                "name": "SASE Digital"
            },
            "description": "Gestión de reservas, habitaciones, limpieza, ventas y reportes para hoteles pequeños y medianos.",
            "url": "<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>",
            "image": ["/build/img/sgh-hero.jpg"],
            "offers": {
                "@type": "Offer",
                "price": "A cotizar",
                "priceCurrency": "MXN",
                "availability": "https://schema.org/PreOrder"
            }
        }
    </script>
</main>