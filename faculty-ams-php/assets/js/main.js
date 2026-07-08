/**
 * main.js — Panimalar Engineering College portal
 * Handles: mobile nav toggle, animated stat counters, scroll reveal,
 * client-side login validation, and small UX touches.
 */
document.addEventListener('DOMContentLoaded', () => {

  /* ---------- Mobile nav toggle ---------- */
  const navToggle = document.getElementById('navToggle');
  const mainNav = document.getElementById('mainNav');
  if (navToggle && mainNav) {
    navToggle.addEventListener('click', () => {
      const isOpen = mainNav.classList.toggle('is-open');
      navToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
      navToggle.classList.toggle('is-active', isOpen);
    });
    mainNav.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', () => {
        mainNav.classList.remove('is-open');
        navToggle.setAttribute('aria-expanded', 'false');
      });
    });
  }

  /* ---------- Animated stat counters ---------- */
  const counters = document.querySelectorAll('[data-count]');
  if (counters.length) {
    const animateCounter = (el) => {
      const target = parseInt(el.dataset.count, 10);
      const duration = 1400;
      const start = performance.now();
      const suffix = el.dataset.suffix || '';

      const step = (now) => {
        const progress = Math.min((now - start) / duration, 1);
        const eased = 1 - Math.pow(1 - progress, 3); // ease-out-cubic
        el.textContent = Math.floor(eased * target).toLocaleString() + suffix;
        if (progress < 1) requestAnimationFrame(step);
        else el.textContent = target.toLocaleString() + suffix;
      };
      requestAnimationFrame(step);
    };

    const counterObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          animateCounter(entry.target);
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.4 });

    counters.forEach(c => counterObserver.observe(c));
  }

  /* ---------- Scroll reveal ---------- */
  const revealEls = document.querySelectorAll('.reveal');
  if (revealEls.length) {
    const revealObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.15 });
    revealEls.forEach(el => revealObserver.observe(el));
  }

  /* ---------- Sticky header shrink on scroll ---------- */
  const header = document.querySelector('.site-header');
  if (header) {
    window.addEventListener('scroll', () => {
      header.classList.toggle('is-scrolled', window.scrollY > 40);
    }, { passive: true });
  }

  /* ---------- Login form validation (all portals) ---------- */
  document.querySelectorAll('form[data-validate="login"]').forEach(form => {
    form.addEventListener('submit', (e) => {
      const idField = form.querySelector('[name="identifier"]');
      const passField = form.querySelector('[name="password"]');
      let valid = true;
      let message = '';

      form.querySelectorAll('.field-error').forEach(el => el.remove());

      const flagError = (field, msg) => {
        valid = false;
        const err = document.createElement('span');
        err.className = 'field-error';
        err.style.cssText = 'color:#8B2F1F;font-size:.78rem;display:block;margin-top:4px;';
        err.textContent = msg;
        field.closest('.field').appendChild(err);
      };

      if (!idField.value.trim()) flagError(idField, 'This field is required.');
      if (!passField.value.trim()) {
        flagError(passField, 'Password is required.');
      } else if (passField.value.trim().length < 4) {
        flagError(passField, 'Password looks too short.');
      }

      if (!valid) e.preventDefault();
    });
  });

  /* ---------- Notice board hover pause (decorative pins) ---------- */
  document.querySelectorAll('.pin-note').forEach((note, i) => {
    note.addEventListener('mouseenter', () => { note.style.transform = 'rotate(0deg) scale(1.03)'; });
    note.addEventListener('mouseleave', () => { note.style.transform = ''; });
  });

  /* ---------- Simple accessible tab switcher (used on dashboards) ---------- */
  document.querySelectorAll('[data-tabs]').forEach(tabGroup => {
    const buttons = tabGroup.querySelectorAll('[data-tab-target]');
    buttons.forEach(btn => {
      btn.addEventListener('click', () => {
        const targetId = btn.dataset.tabTarget;
        tabGroup.querySelectorAll('[data-tab-target]').forEach(b => b.classList.remove('is-active'));
        tabGroup.querySelectorAll('[data-tab-panel]').forEach(p => p.style.display = 'none');
        btn.classList.add('is-active');
        const panel = tabGroup.querySelector(`[data-tab-panel="${targetId}"]`);
        if (panel) panel.style.display = 'block';
      });
    });
  });

});
