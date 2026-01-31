/**
 * FrameworkUpsites Main JavaScript
 *
 * @package FrameworkUpsites
 */

(function () {
  "use strict";

  // Mobile Menu Toggle (Dropdown)
  function initMobileMenu() {
    const toggleButton = document.getElementById("mobile-menu-toggle");
    const mobileMenu = document.getElementById("mobile-menu");
    const header = document.getElementById("main-header");

    if (!toggleButton || !mobileMenu) return;

    function openMenu() {
      mobileMenu.style.maxHeight = "80vh";
      mobileMenu.style.opacity = "1";
      toggleButton.classList.add("active");
      toggleButton.setAttribute("aria-expanded", "true");

      // Bloqueia scroll da página
      document.body.style.overflow = "hidden";
    }

    function closeMenu() {
      mobileMenu.style.maxHeight = "0";
      mobileMenu.style.opacity = "0";
      toggleButton.classList.remove("active");
      toggleButton.setAttribute("aria-expanded", "false");

      // Libera scroll da página
      document.body.style.overflow = "";
    }

    // Toggle ao clicar no botão
    toggleButton.addEventListener("click", function (e) {
      e.stopPropagation();
      const isOpen = toggleButton.classList.contains("active");
      if (isOpen) {
        closeMenu();
      } else {
        openMenu();
      }
    });

    // Previne que cliques dentro do menu fechem ele
    mobileMenu.addEventListener("click", function (e) {
      e.stopPropagation();
    });

    // Fechar ao clicar fora do menu
    document.addEventListener("click", function (e) {
      const isOpen = toggleButton.classList.contains("active");
      if (
        isOpen &&
        !mobileMenu.contains(e.target) &&
        !toggleButton.contains(e.target)
      ) {
        closeMenu();
      }
    });

    // Fechar ao clicar em um link do menu
    const menuLinks = mobileMenu.querySelectorAll("a");
    menuLinks.forEach(function (link) {
      link.addEventListener("click", closeMenu);
    });
  }

  // Smooth Scroll para âncoras
  function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
      anchor.addEventListener("click", function (e) {
        const href = this.getAttribute("href");

        if (href === "#") return;

        const target = document.querySelector(href);

        if (target) {
          e.preventDefault();

          target.scrollIntoView({
            behavior: "smooth",
            block: "start",
          });

          // Atualiza URL sem scroll jump
          if (history.pushState) {
            history.pushState(null, null, href);
          }
        }
      });
    });
  }

  // Adiciona classe ao header quando scroll - Fixo com altura reduzida (apenas desktop)
  function initStickyHeader() {
    const header = document.getElementById("main-header");
    const servicosSection = document.getElementById("servicos");

    if (!header) return;

    let lastScroll = 0;

    function updateHeader() {
      const currentScroll = window.pageYOffset;
      const isMobile = window.innerWidth < 1024; // lg breakpoint

      // Verifica se está sobre a seção de serviços
      let isOverServicos = false;
      if (servicosSection) {
        const servicosRect = servicosSection.getBoundingClientRect();
        const headerHeight = header.offsetHeight;
        // Verifica se o header está sobre a seção de serviços
        isOverServicos =
          servicosRect.top <= headerHeight && servicosRect.bottom > 0;
      }

      if (currentScroll > 100) {
        // Torna fixo
        header.classList.add("header-fixed");

        // Adiciona classe para reduzir altura apenas no desktop
        if (!isMobile) {
          header.classList.add("header-compact");
        }

        // Adiciona classe quando estiver sobre a seção de serviços
        if (isOverServicos) {
          header.classList.add("header-over-servicos");
        } else {
          header.classList.remove("header-over-servicos");
        }
      } else {
        header.classList.remove("header-fixed");
        header.classList.remove("header-compact");
        header.classList.remove("header-over-servicos");
      }

      lastScroll = currentScroll;
    }

    window.addEventListener("scroll", updateHeader);

    // Verifica no resize para ajustar comportamento mobile/desktop
    window.addEventListener("resize", function () {
      updateHeader();
    });

    // Verifica uma vez ao carregar
    updateHeader();
  }

  // Lazy Loading de imagens
  function initLazyLoading() {
    if ("IntersectionObserver" in window) {
      const imageObserver = new IntersectionObserver(function (
        entries,
        observer
      ) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            const img = entry.target;
            img.src = img.dataset.src;
            img.classList.remove("lazy");
            imageObserver.unobserve(img);
          }
        });
      });

      document.querySelectorAll("img.lazy").forEach(function (img) {
        imageObserver.observe(img);
      });
    }
  }

  // Back to Top Button
  function initBackToTop() {
    // Cria o botão se não existir
    let backToTopBtn = document.getElementById("back-to-top");

    if (!backToTopBtn) {
      backToTopBtn = document.createElement("button");
      backToTopBtn.id = "back-to-top";
      backToTopBtn.className =
        "fixed bottom-8 right-8 bg-blue-600 text-white w-12 h-12 rounded-full shadow-lg hover:bg-blue-700 transition-all duration-300 opacity-0 pointer-events-none z-50";
      backToTopBtn.innerHTML =
        '<svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>';
      backToTopBtn.setAttribute("aria-label", "Voltar ao topo");
      document.body.appendChild(backToTopBtn);
    }

    // Show/Hide button on scroll
    window.addEventListener("scroll", function () {
      if (window.pageYOffset > 300) {
        backToTopBtn.classList.remove("opacity-0", "pointer-events-none");
        backToTopBtn.classList.add("opacity-100");
      } else {
        backToTopBtn.classList.add("opacity-0", "pointer-events-none");
        backToTopBtn.classList.remove("opacity-100");
      }
    });

    // Scroll to top on click
    backToTopBtn.addEventListener("click", function () {
      window.scrollTo({
        top: 0,
        behavior: "smooth",
      });
    });
  }

  // Rotação do ícone baseado no scroll
  function initRotatingIcon() {
    const icon = document.querySelector(".rotating-icon");
    const section = document.getElementById("servicos");

    if (!icon || !section) {
      console.log("Ícone ou seção não encontrados!");
      console.log("Icon:", icon);
      console.log("Section:", section);
      return;
    }

    console.log("Rotação do ícone inicializada!");

    function rotateIcon() {
      const sectionRect = section.getBoundingClientRect();
      const windowHeight = window.innerHeight;
      const sectionHeight = sectionRect.height;

      // Começa quando o topo da seção chega no topo da tela
      // Termina quando o fundo da seção chega no topo da tela
      const scrollStart = 0; // Topo da seção no topo da tela
      const scrollEnd = -(sectionHeight - windowHeight); // Fundo da seção no topo da tela
      const scrollRange = Math.abs(scrollEnd - scrollStart);

      // Calcula o progresso (0 a 1)
      let progress = 0;

      if (sectionRect.top <= scrollStart && sectionRect.top >= scrollEnd) {
        progress = (scrollStart - sectionRect.top) / scrollRange;
      } else if (sectionRect.top < scrollEnd) {
        progress = 1;
      }

      // Rotaciona o ícone (360 graus = 1 volta completa)
      const rotation = progress * 360;
      icon.style.transform = `rotate(${rotation}deg)`;
    }

    // Executa na rolagem
    window.addEventListener("scroll", rotateIcon);

    // Executa uma vez ao carregar
    rotateIcon();
  }

  // Banner Fixo com Fade-in no Scroll
  function initFixedBanner() {
    const banner = document.getElementById("fixed-banner");
    const footer = document.querySelector("footer");

    if (!banner) return;

    let hasScrolled = false;

    function checkScroll() {
      const scrollY = window.pageYOffset || document.documentElement.scrollTop;
      const windowHeight = window.innerHeight;

      // Mostra o banner quando o usuário scrollar mais de 200px
      if (scrollY > 200 && !hasScrolled) {
        banner.classList.add("visible");
        hasScrolled = true;
      } else if (scrollY <= 200 && hasScrolled) {
        banner.classList.remove("visible");
        hasScrolled = false;
      }

      // Verifica se o footer está visível na tela
      if (footer) {
        const footerRect = footer.getBoundingClientRect();
        const footerTop = footerRect.top;

        // Se o footer está visível na tela (topo do footer está acima do bottom da tela)
        if (footerTop < windowHeight) {
          // Esconde o banner
          banner.classList.add("near-footer");
        } else {
          // Mostra o banner se não estiver próximo do footer
          banner.classList.remove("near-footer");
        }
      }
    }

    // Verifica no scroll
    window.addEventListener("scroll", checkScroll, { passive: true });

    // Verifica no resize
    window.addEventListener("resize", checkScroll);

    // Verifica uma vez ao carregar
    checkScroll();
  }

  // Inicializa tudo quando o DOM estiver pronto
  // Controle personalizado de submenu DESKTOP
  function initCustomSubmenu() {
    const menuItems = document.querySelectorAll(".menu-item.has-children");

    if (!menuItems.length) return;

    menuItems.forEach(function (menuItem) {
      const submenu = menuItem.querySelector(".sub-menu");
      if (!submenu) return;

      // Verifica quantos itens tem no submenu
      const submenuItems = submenu.querySelectorAll("li");
      if (submenuItems.length > 6) {
        submenu.classList.add("submenu-multicolumn");
      }

      let submenuTimeout = null;

      // Mouse entra no item do menu
      menuItem.addEventListener("mouseenter", function () {
        // Limpa qualquer timeout pendente
        if (submenuTimeout) {
          clearTimeout(submenuTimeout);
          submenuTimeout = null;
        }

        // Ativa o submenu imediatamente
        menuItem.classList.add("submenu-active");
      });

      // Mouse sai do item do menu
      menuItem.addEventListener("mouseleave", function () {
        // Aguarda 800ms antes de fechar
        submenuTimeout = setTimeout(function () {
          menuItem.classList.remove("submenu-active");
        }, 800);
      });

      // Se o mouse entrar no submenu, cancela o fechamento
      submenu.addEventListener("mouseenter", function () {
        if (submenuTimeout) {
          clearTimeout(submenuTimeout);
          submenuTimeout = null;
        }
      });

      // Se o mouse sair do submenu, inicia o fechamento
      submenu.addEventListener("mouseleave", function () {
        submenuTimeout = setTimeout(function () {
          menuItem.classList.remove("submenu-active");
        }, 800);
      });
    });
  }

  // Controle de submenu MOBILE (accordion)
  function initMobileSubmenu() {
    const mobileSubmenuToggles = document.querySelectorAll(
      ".mobile-submenu-toggle"
    );

    if (!mobileSubmenuToggles.length) return;

    mobileSubmenuToggles.forEach(function (toggle) {
      toggle.addEventListener("click", function (e) {
        e.preventDefault();

        const parent = this.parentElement;
        const submenu = parent.querySelector(".mobile-submenu");
        const icon = this.querySelector("svg");

        if (!submenu) return;

        // Toggle do submenu
        if (submenu.style.maxHeight && submenu.style.maxHeight !== "0px") {
          // Fechar
          submenu.style.maxHeight = "0";
          icon.style.transform = "rotate(0deg)";
        } else {
          // Abrir
          submenu.style.maxHeight = submenu.scrollHeight + "px";
          icon.style.transform = "rotate(180deg)";
        }
      });
    });
  }

  document.addEventListener("DOMContentLoaded", function () {
    initMobileMenu();
    initSmoothScroll();
    initStickyHeader();
    initLazyLoading();
    initBackToTop();
    initRotatingIcon();
    initFixedBanner();
    initCustomSubmenu(); // Inicializa controle de submenu desktop
    initMobileSubmenu(); // Inicializa controle de submenu mobile

    console.log("FrameworkUpsites initialized successfully!");
  });
})();
