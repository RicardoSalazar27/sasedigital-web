if(window.location.pathname === '/productos'){

  const prefiereReducir = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // Marca elementos para animar (sin tocar tu HTML original)
  function prepararAnimaciones(){
    // Hero (texto)
    const heroTexto = document.querySelector('.prod__hero .container');
    if (heroTexto){
      heroTexto.classList.add('animable','anim--arriba');
      heroTexto.style.setProperty('--anim-retardo','80ms');
    }

    // Beneficios (stagger)
    document.querySelectorAll('.prod__bullets .bullet').forEach((el, i) => {
      el.classList.add('animable','anim--arriba');
      el.style.setProperty('--i', i);
    });

    // Módulos (stagger)
    document.querySelectorAll('.prod__features .card').forEach((el, i) => {
      el.classList.add('animable','anim--escala');
      el.style.setProperty('--i', i);
    });

    // Flujo (stagger)
    document.querySelectorAll('.prod__flow .flow li').forEach((el, i) => {
      el.classList.add('animable','anim--arriba');
      el.style.setProperty('--i', i);
    });

    // Galería (stagger)
    document.querySelectorAll('.prod__gallery .gal').forEach((el, i) => {
      el.classList.add('animable','anim--escala');
      el.style.setProperty('--i', i);
    });

    // CTA
    const cta = document.querySelector('.prod__cta .container');
    if (cta){
      cta.classList.add('animable','anim--arriba');
      cta.style.setProperty('--anim-retardo','100ms');
    }
  }

  function observarYRevelar(){
    if (prefiereReducir || !('IntersectionObserver' in window)){
      // Sin animaciones o sin soporte: todo visible
      document.querySelectorAll('.animable').forEach(el => el.classList.add('esta-visible'));
      return;
    }

    const observador = new IntersectionObserver((entradas) => {
      for (const ent of entradas){
        if (ent.isIntersecting){
          ent.target.classList.add('esta-visible');
          observador.unobserve(ent.target);
        }
      }
    }, { rootMargin: '0px 0px -10% 0px', threshold: 0.1 });

    document.querySelectorAll('.animable').forEach(el => observador.observe(el));
  }

  // Parallax sutil para la imagen del hero
  function parallaxHero(){
    if (prefiereReducir) return;
    const media = document.querySelector('.prod__hero-media');
    if (!media) return;

    let rafId = null;
    const maxDesplazamiento = 180; // px máximos a considerar

    function actualizar(){
      rafId = null;
      const y = window.scrollY || window.pageYOffset || 0;
      const t = Math.max(0, Math.min(maxDesplazamiento, y));
      // 0.12 = factor sutil; súbelo si quieres más efecto
      media.style.setProperty('--parallax', (t * 0.12) + 'px');
    }

    window.addEventListener('scroll', () => {
      if (rafId) return;
      rafId = requestAnimationFrame(actualizar);
    }, { passive: true });

    // inicial
    actualizar();
  }

  // Inicialización
  prepararAnimaciones();
  observarYRevelar();

  // Forzar mostrar el hero rápido al cargar
  window.addEventListener('load', () => {
    document.querySelectorAll('.prod__hero .container, .prod__hero-media')
      .forEach(el => el.classList.add('esta-visible'));
  });

  parallaxHero();
}