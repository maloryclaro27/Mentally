// public/js/navbar.js
(function () {
  'use strict';

  // =========================
  // 1) Smooth scrolling (SAFE)
  // - Solo aplica a anchors reales (#algo)
  // - Ignora links con clase .require-auth (ellos tienen su propia lógica)
  // =========================
  function initSmoothScroll() {
    const anchors = document.querySelectorAll('a[href^="#"]:not(.require-auth)');

    anchors.forEach((anchor) => {
      anchor.addEventListener('click', function (e) {
        const href = this.getAttribute('href');

        // Ignora "#" vacío o inválido
        if (!href || href === '#' || href.length < 2) return;

        const target = document.querySelector(href);
        if (!target) return;

        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      });
    });
  }

  // =========================
  // 2) Navbar scroll effect (safe)
  // =========================
  function initNavbarScrollEffect() {
    const nav = document.querySelector('nav');
    if (!nav) return;

    function onScroll() {
      const currentScroll = window.pageYOffset || 0;
      nav.style.padding = currentScroll > 50 ? '0.7rem 3rem' : '1rem 3rem';
    }

    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll(); // estado inicial
  }

  // =========================
  // 3) Sistema de verificación de autenticación (SAFE)
  // =========================
  function initAuthSystem() {
    function isUserAuthenticated() {
      return !!(window.MENTALLY_AUTH && window.MENTALLY_AUTH.isAuthenticated);
    }

    function redirectToLogin(redirectTo = '') {
      if (redirectTo) {
        sessionStorage.setItem('redirectAfterLogin', redirectTo);
      }

      const loginUrl =
        (window.MENTALLY_AUTH && window.MENTALLY_AUTH.loginUrl)
          ? window.MENTALLY_AUTH.loginUrl
          : '/login';

      const url = new URL(loginUrl, window.location.origin);

      if (redirectTo) {
        url.searchParams.set('redirect', redirectTo);
      }

      window.location.href = url.toString();
    }

    function handleAuthRequiredClick(e) {
      const dataUrl = this.getAttribute('data-url');
      const href = this.getAttribute('href');

      // Si NO está autenticada → ahí sí interceptamos y redirigimos a login
      if (!isUserAuthenticated()) {
        e.preventDefault();
        e.stopPropagation();

        const urlToGo = dataUrl || href || '/';
        redirectToLogin(urlToGo);
        return;
      }

      // Si SÍ está autenticada:
      // - Si es un link normal (href real, no "#") -> NO interceptamos, dejamos navegar normal
      if (href && href !== '#') {
        return;
      }

      // - Si es href="#" pero tiene data-url -> navegamos por JS
      if (dataUrl) {
        e.preventDefault();
        e.stopPropagation();
        window.location.href = dataUrl;
      }
    }

    const protectedLinks = document.querySelectorAll('.require-auth:not([data-test-link="1"])');
    if (!protectedLinks.length) return;

    protectedLinks.forEach((link) => {
      link.addEventListener('click', handleAuthRequiredClick);
    });
  }

  // =========================
  // 4) User profile dropdown (AUTH) — click toggle
  // =========================
  function initUserProfileDropdown() {
    const userProfile = document.querySelector('.user-profile');
    const userDropdown = document.querySelector('.user-profile .user-dropdown');

    if (!userProfile || !userDropdown) return;

    // Toggle al hacer click
    userProfile.addEventListener('click', (e) => {
      e.stopPropagation();
      userProfile.classList.toggle('active');
    });

    // Cerrar al hacer click fuera
    document.addEventListener('click', () => {
      userProfile.classList.remove('active');
    });

    // Cerrar con ESC
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        userProfile.classList.remove('active');
      }
    });
  }


  // =========================
  // Init (DOM ready safe)
  // =========================
  function initNavbar() {
    initSmoothScroll();
    initNavbarScrollEffect();
    initAuthSystem();
    initUserProfileDropdown();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initNavbar);
  } else {
    initNavbar();
  }
})();
