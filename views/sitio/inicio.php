<!-- Hero -->
<section id="inicio" class="hero">
  <canvas id="hero-canvas" class="hero__bg"></canvas>

  <div class="container hero__inner">
    <div class="hero__logo">
      <!-- <picture>
        <source srcset="build/img/Monograma.avif" type="image/avif">
        <source srcset="build/img/Monograma.webp" type="image/webp">
        <img loading="lazy" src="build/img/Monograma.jpg" alt="Logo SASE Digital">
      </picture> -->
      <img src="build/img/Monograma.png" alt="monograma">
    </div>

    <h1 class="hero__title">Innovación sin límites</h1>
    <p class="hero__lead">
      Desarrollo de software a medida, infraestructura y seguridad para escalar tu negocio con confianza.
    </p>

    <div class="hero__actions">
      <a class="btn btn--primary" href="#contacto"><i class="fa-solid fa-paper-plane"></i> Contáctanos</a>
      <a class="btn btn--ghost" href="#servicios"><i class="fa-solid fa-arrow-down"></i> Ver servicios</a>
    </div>
  </div>
</section>

<!-- Quiénes somos -->
<section id="quienes-somos" class="about">
  <div class="container">
    <header class="section-head">
      <span class="section-head__eyebrow">Nosotros</span>
      <h2 class="section-head__title">Soluciones tecnológicas seguras, escalables y humanas</h2>
      <p class="section-head__lead">
        En <strong>SASE Digital</strong> combinamos ingeniería y diseño para entregar productos y servicios con impacto real en la operación de tu empresa.
      </p>
    </header>

    <section class="values">
      <h3 class="values__title"><i class="fa-solid fa-star"></i> Nuestros valores</h3>
      <div class="values__chips">
        <span class="chip"><i class="fa-solid fa-rocket"></i> Innovación constante</span>
        <span class="chip"><i class="fa-solid fa-scale-balanced"></i> Ética profesional</span>
        <span class="chip"><i class="fa-solid fa-medal"></i> Calidad en cada entrega</span>
        <span class="chip"><i class="fa-solid fa-headset"></i> Orientación al cliente</span>
        <span class="chip"><i class="fa-solid fa-microchip"></i> Pasión por la tecnología</span>
      </div>
    </section>

    <div class="about__grid">
      <div class="about__media">
        <picture>
          <source srcset="build/img/nosotros-2.avif" type="image/avif">
          <source srcset="build/img/nosotros-2.webp" type="image/webp">
          <img loading="lazy" decoding="async" src="build/img/nosotros-2.jpg" alt="Equipo de SASE Digital trabajando">
        </picture>
      </div>


      <div class="about__text">
        <div class="about-cards grid-2">
          <article class="card">
            <div class="card__icon"><i class="fa-solid fa-bullseye"></i></div>
            <h3 class="card__title">Misión</h3>
            <p class="card__text">Impulsar la eficiencia, seguridad y competitividad de nuestros clientes mediante soluciones confiables e innovadoras.</p>
          </article>

          <article class="card">
            <div class="card__icon"><i class="fa-solid fa-eye"></i></div>
            <h3 class="card__title">Visión</h3>
            <p class="card__text">Ser un referente en tecnología y desarrollo de software, reconocidos por calidad, innovación y compromiso.</p>
          </article>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Servicios -->
<section id="servicios" class="services">
  <div class="container">
    <header class="section-head">
      <span class="section-head__eyebrow">Servicios</span>
      <h2 class="section-head__title">Desarrollo, infraestructura y seguridad end-to-end</h2>
      <p class="section-head__lead">Acompañamos todo el ciclo: desde el levantamiento de requerimientos hasta el monitoreo en producción.</p>
    </header>

    <div class="services__grid">
      <article class="service">
        <div class="service__icon"><i class="fa-solid fa-code"></i></div>
        <h3 class="service__title">Software a medida</h3>
        <p class="service__text">Sistemas de gestión (ERP/PMS), APIs y paneles administrativos. Arquitecturas modulares y escalables.</p>
      </article>

      <article class="service">
        <div class="service__icon"><i class="fa-solid fa-server"></i></div>
        <h3 class="service__title">Servidores y redes</h3>
        <p class="service__text">Instalación y hardening de servidores Linux/Windows, backups, alta disponibilidad y networking seguro.</p>
      </article>

      <article class="service">
        <div class="service__icon"><i class="fa-solid fa-camera"></i></div>
        <h3 class="service__title">Videovigilancia y alarmas</h3>
        <p class="service__text">CCTV profesional con monitoreo, grabación redundante y control de accesos.</p>
      </article>

      <article class="service">
        <div class="service__icon"><i class="fa-solid fa-computer"></i></div>
        <h3 class="service__title">Mantenimiento de equipos</h3>
        <p class="service__text">Limpieza, optimización, actualización de hardware y prevención de fallas.</p>
      </article>
    </div>
  </div>
</section>

<!-- Contacto -->
<section id="contacto" class="contact">
  <div class="container">
    <header class="section-head">
      <span class="section-head__eyebrow">Contacto</span>
      <h2 class="section-head__title">Hablemos de tu proyecto</h2>
      <p class="section-head__lead">Basados en Coatzintla, Veracruz, México. Atendemos de forma remota y presencial.</p>
    </header>

    <form class="form" id="contact-form" action="https://formspree.io/f/your-id" method="POST" novalidate>
      <h3 class="form__title"><i class="fa-solid fa-paper-plane"></i> Envíanos un mensaje</h3>

      <div class="form__grid">
        <div class="form__group">
          <label for="c-name" class="form__label">Nombre <span aria-hidden="true">*</span></label>
          <input id="c-name" name="name" type="text" class="form__control" placeholder="Tu nombre" required />
          <small class="form__error">Este campo es obligatorio.</small>
        </div>

        <div class="form__group">
          <label for="c-email" class="form__label">Correo electrónico <span aria-hidden="true">*</span></label>
          <input id="c-email" name="email" type="email" class="form__control" placeholder="tucorreo@ejemplo.com" required />
          <small class="form__error">Ingresa un correo válido.</small>
        </div>

        <div class="form__group">
          <label for="c-phone" class="form__label">Teléfono</label>
          <input id="c-phone" name="phone" type="tel" class="form__control" placeholder="+52 ..." />
        </div>

        <div class="form__group">
          <label for="c-company" class="form__label">Empresa</label>
          <input id="c-company" name="company" type="text" class="form__control" placeholder="Nombre de la empresa" />
        </div>

        <div class="form__group form__group--full">
          <label for="c-service" class="form__label">Interés principal</label>
          <select id="c-service" name="service" class="form__control">
            <option value="0">Selecciona una opción</option>
            <option value="1">Sistema Gestor Hotelero</option>
            <option value="2">Software a medida</option>
            <option value="3">Servidores y redes</option>
            <option value="4">Videovigilancia y alarmas</option>
            <option value="5">Mantenimiento de equipos</option>
          </select>
        </div>

        <div class="form__group form__group--full">
          <label for="c-message" class="form__label">Mensaje <span aria-hidden="true">*</span></label>
          <textarea id="c-message" name="message" rows="3" class="form__control" placeholder="Cuéntanos sobre tu proyecto" required></textarea>
          <small class="form__error">Agrega un mensaje.</small>
        </div>

        <input type="text" name="_gotcha" class="form__hp" autocomplete="off" tabindex="-1" aria-hidden="true" />
      </div>

      <div class="form__footer">
        <label class="check">
          <input class="check__input" type="checkbox" required />
          <span class="check__label">Acepto ser contactad@ para fines relacionados a mi solicitud.</span>
        </label>

        <button class="btn btn--primary" type="submit">
          <i class="fa-solid fa-paper-plane"></i> Enviar
        </button>
      </div>

      <p class="form__note" id="form-note" hidden>Gracias, recibimos tu mensaje.</p>
    </form>
  </div>
</section>
