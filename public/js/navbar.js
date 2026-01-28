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
      e.preventDefault();
      e.stopPropagation();

      const urlToGo = this.getAttribute('data-url') || '/';

      if (!isUserAuthenticated()) {
        redirectToLogin(urlToGo);
      } else {
        window.location.href = urlToGo;
      }
    }

    const protectedLinks = document.querySelectorAll('.require-auth');
    if (!protectedLinks.length) return;

    protectedLinks.forEach((link) => {
      link.addEventListener('click', handleAuthRequiredClick);
    });
  }

  // =========================
  // Init (DOM ready safe)
  // =========================
  function initNavbar() {
    initSmoothScroll();
    initNavbarScrollEffect();
    initAuthSystem();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initNavbar);
  } else {
    initNavbar();
  }
})();
