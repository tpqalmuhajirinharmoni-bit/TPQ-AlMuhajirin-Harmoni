document.addEventListener('DOMContentLoaded', function () {
  const buttons = document.querySelectorAll('.button');
  buttons.forEach((button) => {
    button.addEventListener('mouseenter', () => {
      button.style.transform = 'translateY(-1px)';
    });
    button.addEventListener('mouseleave', () => {
      button.style.transform = 'translateY(0)';
    });
  });

  const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
  const mainNav = document.querySelector('.main-nav');

  const closeMobileMenu = () => {
    if (mainNav && mainNav.classList.contains('open')) {
      mainNav.classList.remove('open');
      mobileMenuToggle?.setAttribute('aria-expanded', 'false');
    }
  };

  const toggleMobileMenu = () => {
    if (!mainNav || !mobileMenuToggle) return;
    const isOpen = !mainNav.classList.contains('open');
    mainNav.classList.toggle('open');
    mobileMenuToggle.classList.toggle('open', isOpen);
    mobileMenuToggle.setAttribute('aria-expanded', String(isOpen));
  };

  if (mobileMenuToggle && mainNav) {
    mobileMenuToggle.addEventListener('click', function (e) {
      e.stopPropagation();
      toggleMobileMenu();
    });

    mainNav.querySelectorAll('a').forEach((link) => {
      link.addEventListener('click', function () {
        if (window.innerWidth <= 820) {
          closeMobileMenu();
        }
      });
    });
  }

  // Dropdown behavior for profile, notifications, and menu toggles
  const dropdownConfigs = [];

  document.querySelectorAll('.nav-dropdown').forEach((container) => {
    const toggle = container.querySelector('.dropdown-toggle');
    const menu = container.querySelector('.dropdown-menu');
    if (container && toggle && menu) {
      dropdownConfigs.push({ container, toggle, menu });
    }
  });

  const profileDropdown = document.querySelector('.profile-dropdown');
  if (profileDropdown) {
    const profileToggle = profileDropdown.querySelector('.profile-toggle');
    const profileMenu = profileDropdown.querySelector('.profile-menu');
    if (profileToggle && profileMenu) {
      dropdownConfigs.push({ container: profileDropdown, toggle: profileToggle, menu: profileMenu });
    }
  }

  const notificationDropdown = document.querySelector('.notification-dropdown');
  if (notificationDropdown) {
    const notificationToggle = notificationDropdown.querySelector('.notification-toggle');
    const notificationMenu = notificationDropdown.querySelector('.notification-menu');
    if (notificationToggle && notificationMenu) {
      dropdownConfigs.push({ container: notificationDropdown, toggle: notificationToggle, menu: notificationMenu });
    }
  }

  dropdownConfigs.forEach(({ container, toggle, menu }) => {
    if (!container || !toggle || !menu) {
      return;
    }

    toggle.setAttribute('aria-haspopup', 'true');
    toggle.setAttribute('aria-expanded', 'false');

    const openDropdown = () => {
      container.classList.add('active');
      toggle.setAttribute('aria-expanded', 'true');
    };

    const closeDropdown = () => {
      container.classList.remove('active');
      toggle.setAttribute('aria-expanded', 'false');
    };

    toggle.addEventListener('click', function (e) {
      e.stopPropagation();
      if (container.classList.contains('active')) {
        closeDropdown();
      } else {
        dropdownConfigs.forEach(({ container: other }) => {
          if (other && other !== container) {
            other.classList.remove('active');
            other.querySelector('[aria-expanded]')?.setAttribute('aria-expanded', 'false');
          }
        });
        openDropdown();
        menu.querySelector('a,button,input,textarea')?.focus();
      }
    });

    toggle.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        toggle.click();
      }
    });

    container.addEventListener('focusin', openDropdown);
    container.addEventListener('focusout', function (e) {
      if (!container.contains(e.relatedTarget)) {
        closeDropdown();
      }
    });
  });

  // Close any open dropdowns when clicking outside
  document.addEventListener('click', function (e) {
    dropdownConfigs.forEach(({ container, toggle }) => {
      if (container && toggle && !container.contains(e.target)) {
        container.classList.remove('active');
        toggle.setAttribute('aria-expanded', 'false');
      }
    });

    if (mainNav && mainNav.classList.contains('open') && e.target !== mobileMenuToggle && !mainNav.contains(e.target)) {
      closeMobileMenu();
    }
  });

  // Close on Escape globally
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      dropdownConfigs.forEach(({ container, toggle }) => {
        if (container && toggle) {
          container.classList.remove('active');
          toggle.setAttribute('aria-expanded', 'false');
        }
      });
      closeMobileMenu();
      // close login modal if open
      const loginModal = document.getElementById('login-modal');
      if (loginModal && loginModal.getAttribute('aria-hidden') === 'false') {
        closeModal(loginModal);
      }
    }
  });

  // Simple modal open/close logic for login modal
  const openLoginBtn = document.getElementById('open-login');
  const loginModal = document.getElementById('login-modal');
  const focusableSelectors = 'a[href], area[href], input:not([disabled]):not([type="hidden"]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), [tabindex]:not([tabindex="-1"])';
  let lastFocusedElement = null;
  let boundModalKeydown = null;

  function getFocusableElements(modal) {
    return Array.from(modal.querySelectorAll(focusableSelectors)).filter(el => el.offsetWidth > 0 || el.offsetHeight > 0 || el.getClientRects().length);
  }

  function trapModalFocus(event, modal) {
    if (event.key !== 'Tab') return;

    const focusable = getFocusableElements(modal);
    if (!focusable.length) return;

    const first = focusable[0];
    const last = focusable[focusable.length - 1];

    if (event.shiftKey) {
      if (document.activeElement === first || document.activeElement === modal) {
        event.preventDefault();
        last.focus();
      }
    } else {
      if (document.activeElement === last) {
        event.preventDefault();
        first.focus();
      }
    }
  }

  function openModal(modal) {
    if (!modal || modal.getAttribute('aria-hidden') === 'false') return;
    lastFocusedElement = document.activeElement;
    modal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';
    boundModalKeydown = function (event) {
      if (event.key === 'Escape') {
        closeModal(modal);
      }
      trapModalFocus(event, modal);
    };
    modal.addEventListener('keydown', boundModalKeydown);
    setTimeout(() => {
      const firstInput = modal.querySelector('input[name="username"]');
      const focusable = getFocusableElements(modal);
      (firstInput || focusable[0] || modal).focus();
    }, 120);
  }

  function closeModal(modal) {
    if (!modal || modal.getAttribute('aria-hidden') === 'true') return;
    modal.setAttribute('aria-hidden', 'true');
    document.body.style.overflow = '';
    if (boundModalKeydown) {
      modal.removeEventListener('keydown', boundModalKeydown);
      boundModalKeydown = null;
    }
    if (lastFocusedElement instanceof HTMLElement) {
      lastFocusedElement.focus();
      lastFocusedElement = null;
    }
  }

  if (openLoginBtn && loginModal) {
    openLoginBtn.addEventListener('click', function (e) {
      e.preventDefault();
      openModal(loginModal);
    });

    loginModal.addEventListener('click', function (e) {
      const action = e.target.closest('[data-action]')?.getAttribute('data-action');
      if (action === 'close') {
        closeModal(loginModal);
      }
    });
  }

  // Auto-open login modal if URL contains show_login=1 or hash #login
  try {
    const params = new URLSearchParams(window.location.search);
    if ((params.get('show_login') === '1' || window.location.hash === '#login') && loginModal) {
      openModal(loginModal);
      // remove the query param to avoid re-opening on refresh
      if (params.has('show_login')) {
        params.delete('show_login');
        const newSearch = params.toString();
        const newUrl = window.location.pathname + (newSearch ? ('?' + newSearch) : '') + window.location.hash;
        history.replaceState(null, '', newUrl);
      }
    }
  } catch (e) {
    // ignore URL parsing errors
  }
});
