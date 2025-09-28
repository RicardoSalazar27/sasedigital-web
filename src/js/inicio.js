(() => {
  // --- Ejecutar SOLO en la ruta "/" ---
  const isHome = () => window.location.pathname === '/';
  if (!isHome()) return;

  // ========== SMOOTH SCROLL ==========
  document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', e => {
      const id = a.getAttribute('href');
      if (!id || id === '#') return;
      const el = document.querySelector(id);
      if (!el) return;
      e.preventDefault();
      el.scrollIntoView({ behavior: 'smooth' });
    });
  });
  // ========== NAV MÓVIL (BEM) ==========
  const navToggle = document.getElementById('navToggle');      // <button class="nav__toggle" id="navToggle">
  const navLinks  = document.getElementById('navLinks');       // <nav class="nav__links" id="navLinks">
  if (navToggle && navLinks) {
    navToggle.addEventListener('click', () => {
      const expanded = navToggle.getAttribute('aria-expanded') === 'true';
      navToggle.setAttribute('aria-expanded', String(!expanded));
      navLinks.classList.toggle('nav__links--open');
      navLinks.setAttribute('aria-hidden', String(expanded));
    });
  }

  // ========== DROPDOWN (Productos) BEM ==========
  // Estructura esperada:
  // <div class="nav__dropdown" aria-expanded="false">
  //   <button class="nav__btn" ...>...</button>
  //   <div class="nav__menu" role="menu">...</div>
  // </div>
  document.querySelectorAll('.nav__dropdown').forEach(dropdown => {
    const btn = dropdown.querySelector('.nav__btn');
    if (!btn) return;

    btn.addEventListener('click', (e) => {
      e.stopPropagation();
      const open = dropdown.getAttribute('aria-expanded') === 'true';
      dropdown.setAttribute('aria-expanded', String(!open));
    });
  });

  // Cerrar cualquier dropdown si se hace click fuera
  document.addEventListener('click', (e) => {
    document.querySelectorAll('.nav__dropdown[aria-expanded="true"]').forEach(dd => {
      if (!dd.contains(e.target)) dd.setAttribute('aria-expanded', 'false');
    });
  });

  // ========== HERO PARTICLES ==========
  const canvas = document.getElementById('hero-canvas');
  if (!canvas) return; // si por algo no está el hero en esta vista, no seguimos

  const ctx = canvas.getContext('2d');
  let width = (canvas.width = window.innerWidth);
  let height = (canvas.height = window.innerHeight);

  const colors = ['#2584f8', '#04ddb2', '#a4caff', '#f2f6fc'];
  const particles = [];
  const particleCount = 100;
  const maxDistance = 140;

  for (let i = 0; i < particleCount; i++) {
    particles.push({
      x: Math.random() * width,
      y: Math.random() * height,
      vx: (Math.random() - 0.5) * 0.7,
      vy: (Math.random() - 0.5) * 0.7,
      radius: Math.random() * 2 + 1,
      color: colors[Math.floor(Math.random() * colors.length)],
      alpha: Math.random(),
      delta: Math.random() * 0.02
    });
  }

  function hexToRgb(hex) {
    const bigint = parseInt(hex.replace('#', ''), 16);
    const r = (bigint >> 16) & 255, g = (bigint >> 8) & 255, b = bigint & 255;
    return `${r},${g},${b}`;
  }

  function animate() {
    ctx.clearRect(0, 0, width, height);

    particles.forEach(p => {
      p.x += p.vx; p.y += p.vy;
      if (p.x < 0 || p.x > width) p.vx *= -1;
      if (p.y < 0 || p.y > height) p.vy *= -1;

      p.alpha += p.delta;
      if (p.alpha <= 0 || p.alpha >= 1) p.delta *= -1;

      ctx.beginPath();
      ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
      ctx.fillStyle = `rgba(${hexToRgb(p.color)},${p.alpha})`;
      ctx.fill();
    });

    for (let i = 0; i < particleCount; i++) {
      for (let j = i + 1; j < particleCount; j++) {
        const dx = particles[i].x - particles[j].x;
        const dy = particles[i].y - particles[j].y;
        const dist = Math.hypot(dx, dy);
        if (dist < maxDistance) {
          ctx.beginPath();
          ctx.moveTo(particles[i].x, particles[i].y);
          ctx.lineTo(particles[j].x, particles[j].y);
          const alpha = 0.5 * (1 - dist / maxDistance);
          ctx.strokeStyle = `rgba(4,221,178,${alpha})`; // $secundario
          ctx.lineWidth = 0.7;
          ctx.stroke();
        }
      }
    }

    requestAnimationFrame(animate);
  }
  animate();

  window.addEventListener('resize', () => {
    width = canvas.width = window.innerWidth;
    height = canvas.height = window.innerHeight;
  });

    const nav   = document.getElementById('navLinks');
    const btn   = document.getElementById('navToggle');
    const media = window.matchMedia('(min-width: 768px)');

    function setOpen(open){
      nav.classList.toggle('is-open', open);
      btn.setAttribute('aria-expanded', String(open));
      nav.setAttribute('aria-hidden', String(!open));
      document.body.classList.toggle('no-scroll', open);
    }

    btn.addEventListener('click', () => setOpen(!nav.classList.contains('is-open')));

    // Cerrar al hacer click en un link (solo móvil)
    nav.querySelectorAll('a.nav__link').forEach(a => {
      a.addEventListener('click', () => { if (!media.matches) setOpen(false); });
    });

    // Dropdowns
    nav.querySelectorAll('.nav__dropdown > .nav__btn').forEach(b => {
      b.addEventListener('click', (e) => {
        const dd = e.currentTarget.closest('.nav__dropdown');
        const open = dd.getAttribute('aria-expanded') === 'true';
        // cerrar hermanos
        dd.parentElement.querySelectorAll('.nav__dropdown').forEach(x => x.setAttribute('aria-expanded','false'));
        dd.setAttribute('aria-expanded', String(!open));
      });
    });

    // Cerrar con ESC
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape') setOpen(false); });

    // Si vuelves a desktop, resetea estado
    media.addEventListener('change', () => { if (media.matches) setOpen(false); });

})();
