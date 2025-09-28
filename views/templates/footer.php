<footer class="footer">
  <div class="container footer__grid">
    <!-- Marca + contacto -->
    <div class="footer__brand">
      <a class="footer__logo" href="#inicio" aria-label="Inicio">
        <picture>
          <img loading="lazy" decoding="async" src="/build/img/Monograma.png" alt="SASE Digital">
        </picture>
      </a>
      <p class="footer__tagline">Software que ordena tu operación y acelera tus ventas.</p>

      <address class="footer__contact">
        <a href="mailto:contacto@sasedigital.com" class="footer__link">
          <i class="fa-solid fa-envelope"></i> contacto@sasedigital.com
        </a>
        <a href="tel:+525660532035" class="footer__link">
          <i class="fa-solid fa-phone"></i> +52 56 6053 2035
        </a>
        <a class="footer__btn-wa"
           href="https://wa.me/525660532035?text=Hola,%20quiero%20recibir%20informaci%C3%B3n%20sobre%20el%20Sistema%20Gestor%20Hotelero"
           target="_blank" rel="noopener" aria-label="WhatsApp">
          <i class="fa-brands fa-whatsapp"></i> WhatsApp
        </a>
      </address>
    </div>

    <!-- Navegación -->
    <nav class="footer__nav" aria-label="Navegación del sitio">
      <h3 class="footer__heading">Sitio</h3>
      <ul class="footer__list">
        <li><a href="/" class="footer__link">Quiénes somos</a></li>
        <li><a href="/" class="footer__link">Servicios</a></li>
        <li><a href="/productos" class="footer__link">Productos</a></li>
        <li><a href="/" class="footer__link">Contacto</a></li>
      </ul>
    </nav>

    <!-- Redes -->
    <div class="footer__social">
      <h3 class="footer__heading">Síguenos</h3>
      <ul class="footer__social-list">
        <li><a href="https://wa.me/525660532035?text=Hola,%20me%20interesa%20SASE%20Digital" target="_blank" rel="noopener" aria-label="WhatsApp" class="soc"><i class="fa-brands fa-whatsapp"></i></a></li>
        <li><a href="https://www.facebook.com/profile.php?id=61581656424638" target="_blank" rel="noopener" aria-label="Facebook" class="soc"><i class="fa-brands fa-facebook-f"></i></a></li>
        <li><a href="https://www.instagram.com/sase.digital" target="_blank" rel="noopener" aria-label="Instagram" class="soc"><i class="fa-brands fa-instagram"></i></a></li>
        <li><a href="https://www.linkedin.com/company/sase-digitall/" target="_blank" rel="noopener" aria-label="LinkedIn" class="soc"><i class="fa-brands fa-linkedin-in"></i></a></li>
        <li><a href="#" target="_blank" rel="noopener" aria-label="YouTube" class="soc"><i class="fa-brands fa-youtube"></i></a></li>
      </ul>
    </div>
  </div>

  <!-- Legal -->
  <div class="footer__bottom">
    <div class="container footer__legal">
      <small>© <?php echo date('Y'); ?> SASE Digital. Todos los derechos reservados.</small>
      <ul class="footer__legal-links">
        <li><a href="/" class="footer__link">Aviso de privacidad</a></li>
        <li><a href="/" class="footer__link">Términos</a></li>
        <li><a href="/" class="footer__link">Cookies</a></li>
      </ul>
    </div>
  </div>

  <!-- Volver arriba -->
  <button class="footer__toTop" type="button" aria-label="Volver arriba">
    <i class="fa-solid fa-arrow-up"></i>
  </button>
</footer>

<script>
  // Botón "volver arriba"
  (function(){
    const btn = document.querySelector('.footer__toTop');
    if(!btn) return;
    btn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
  })();
</script>
