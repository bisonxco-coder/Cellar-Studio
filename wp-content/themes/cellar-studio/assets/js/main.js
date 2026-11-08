// JS per hero slider me Swiper

document.addEventListener("DOMContentLoaded", () => {
  // Navbar: become fixed after scrolling ~50vh
  const navStrip = document.querySelector(".site-nav-strip");
  if (navStrip) {
    const toggleFixedNav = () => {
      const threshold = window.innerHeight * 0.5;
      const shouldFix = window.scrollY >= threshold;
      document.body.classList.toggle("nav-is-fixed", shouldFix);
    };

    window.addEventListener("scroll", toggleFixedNav, { passive: true });
    window.addEventListener("resize", toggleFixedNav);
    toggleFixedNav();
  }

  // Hero background video: fallback to poster if codec/autoplay/data-saver fails.
  const heroVideos = document.querySelectorAll(".js-hero-bg-video, video.hero-slide-video, video.page-hero-video");
  if (heroVideos.length) {
    const prefersReducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
    const saveData = !!(navigator.connection && navigator.connection.saveData);

    const showHeroPosterFallback = (video) => {
      if (!video || video.dataset.heroFallback === "1") return;
      video.dataset.heroFallback = "1";
      const section = video.closest(".page-hero, .hero-slider");
      const poster = video.getAttribute("poster");
      if (section) {
        section.classList.add("is-video-fallback");
        if (poster) {
          section.style.setProperty("--hero-poster", `url("${poster}")`);
        }
      }
      try {
        video.pause();
      } catch (_) {}
      video.style.display = "none";
    };

    heroVideos.forEach((video) => {
      if (prefersReducedMotion || saveData) {
        showHeroPosterFallback(video);
        return;
      }

      video.addEventListener("error", () => showHeroPosterFallback(video), { once: true });
      video.querySelectorAll("source").forEach((source) => {
        source.addEventListener("error", () => showHeroPosterFallback(video), { once: true });
      });

      let stallTimer = 0;
      video.addEventListener("stalled", () => {
        window.clearTimeout(stallTimer);
        stallTimer = window.setTimeout(() => showHeroPosterFallback(video), 2500);
      });
      ["playing", "canplay", "timeupdate"].forEach((evt) => {
        video.addEventListener(evt, () => window.clearTimeout(stallTimer));
      });

      const tryPlay = () => {
        const playResult = video.play?.();
        if (playResult && typeof playResult.catch === "function") {
          playResult.catch(() => showHeroPosterFallback(video));
        }
      };

      if (video.readyState >= 2) {
        tryPlay();
      } else {
        video.addEventListener("canplay", tryPlay, { once: true });
      }
    });
  }

  // AOS (Animate On Scroll): auto-map existing `.reveal` classes to AOS attributes
  const hasAOS = typeof window.AOS !== "undefined";
  if (hasAOS) {
    // Translate existing stagger groups into AOS delays
    document.querySelectorAll(".reveal-stagger").forEach((group) => {
      const children = Array.from(group.querySelectorAll(".reveal"));
      children.forEach((el, i) => {
        if (!el.getAttribute("data-aos-delay")) {
          el.setAttribute("data-aos-delay", String(i * 90));
        }
      });
    });

    document.querySelectorAll(".reveal").forEach((el) => {
      // Map variations
      const isFade = el.classList.contains("reveal--fade");
      const isUpLg = el.classList.contains("reveal--up-lg");
      const aosType = isFade ? "fade" : isUpLg ? "fade-up" : "fade-up";
      el.setAttribute("data-aos", aosType);
      if (!el.getAttribute("data-aos-duration")) el.setAttribute("data-aos-duration", "700");
      if (!el.getAttribute("data-aos-easing")) el.setAttribute("data-aos-easing", "ease-out-cubic");

      // Remove custom reveal classes to avoid style conflicts
      el.classList.remove("reveal", "reveal--fade", "reveal--up-lg", "is-visible");
    });

    AOS.init({
      once: true,
      offset: 120,
      duration: 700,
      easing: "ease-out-cubic",
    });
  } else {
    // Fallback: Scroll reveal animations (no library)
    const revealItems = Array.from(document.querySelectorAll(".reveal"));

    document.querySelectorAll(".reveal-stagger").forEach((group) => {
      const children = Array.from(group.querySelectorAll(".reveal"));
      children.forEach((el, i) => {
        if (!el.style.getPropertyValue("--reveal-delay")) {
          el.style.setProperty("--reveal-delay", `${i * 90}ms`);
        }
      });
    });

    const io = new IntersectionObserver(
      (entries, observer) => {
        entries.forEach((entry) => {
          if (!entry.isIntersecting) return;
          entry.target.classList.add("is-visible");
          observer.unobserve(entry.target);
        });
      },
      { root: null, threshold: 0.12, rootMargin: "0px 0px -10% 0px" }
    );

    revealItems.forEach((el) => io.observe(el));
  }

  // WhatsApp fixed button: show after first section scrolls out
  const whatsappFab = document.getElementById("whatsappFab");
  if (whatsappFab) {
    const firstSection = document.querySelector("body > section");
    if (firstSection && "IntersectionObserver" in window) {
      const heroOutObserver = new IntersectionObserver(
        (entries) => {
          const entry = entries[0];
          if (!entry) return;
          const outOfView = entry.isIntersecting === false;
          whatsappFab.classList.toggle("is-visible", outOfView);
        },
        { root: null, threshold: 0.01 }
      );

      heroOutObserver.observe(firstSection);
    } else {
      // Fallback: show after one viewport height
      const onScroll = () => {
        const show = window.scrollY > Math.min(520, window.innerHeight * 0.9);
        whatsappFab.classList.toggle("is-visible", show);
      };
      window.addEventListener("scroll", onScroll, { passive: true });
      onScroll();
    }
  }

  // In-page enquiry hashes: smooth-scroll when the section is on this page.
  // Real URLs (e.g. /bespoke/#bespoke-enquiry) must navigate — never open the old popup.
  function cellarHrefIsSamePage(href) {
    try {
      const url = new URL(href, window.location.href);
      return url.origin === window.location.origin && url.pathname === window.location.pathname;
    } catch (_) {
      return href.charAt(0) === "#";
    }
  }

  document.addEventListener("click", (e) => {
    const target = e.target;
    if (!target) return;

    const trigger = target.closest ? target.closest("a, button") : null;
    if (!trigger) return;
    if (trigger.closest && trigger.closest("#consultationModal")) return;

    const text = (trigger.textContent || "").trim();
    const href = trigger.getAttribute ? trigger.getAttribute("href") || "" : "";
    const hashIndex = href.indexOf("#");

    if (hashIndex !== -1) {
      const hash = href.slice(hashIndex);
      if (hash.length > 1) {
        if (cellarHrefIsSamePage(href)) {
          const section = document.querySelector(hash);
          if (section) {
            e.preventDefault();
            section.scrollIntoView({ behavior: "smooth", block: "start" });
          }
        }
        return;
      }
    }

    const isDummyHref = !href || href === "#" || href === "#/" || /^javascript:/i.test(href);
    if (!isDummyHref) return;

    const isConsultation =
      /request a consultation/i.test(text) ||
      /start your project/i.test(text);

    if (!isConsultation) return;

    e.preventDefault();
    window.location.href = window.cellarStudioBespokeEnquiryUrl || "/bespoke/#bespoke-enquiry";
  });

  const heroThumbsEl = document.querySelector(".heroThumbs");
  const heroSwiperEl = document.querySelector(".heroSwiper");
  if (heroThumbsEl && heroSwiperEl) {
    const heroThumbs = new Swiper(".heroThumbs", {
      spaceBetween: 16,
      slidesPerView: 3,
      watchSlidesProgress: true,
      centeredSlides: false,
      loop: true,
    });

    function pauseAllHeroVideos() {
      heroSwiperEl.querySelectorAll("video.hero-slide-video").forEach((v) => {
        try {
          v.pause();
          v.currentTime = 0;
        } catch (_) {}
      });
    }

    function playActiveHeroVideo(swiper) {
      const active = swiper?.slides?.[swiper.activeIndex];
      if (!active) return;

      const video = active.querySelector("video.hero-slide-video");
      if (!video) return;

      // Ensure attribute state for mobile autoplay policies.
      video.muted = true;
      video.playsInline = true;

      const tryPlay = () => {
        const p = video.play?.();
        if (p && typeof p.catch === "function") p.catch(() => {});
      };

      // Some browsers need a tick after slide activation.
      requestAnimationFrame(() => requestAnimationFrame(tryPlay));
    }

    const heroSwiper = new Swiper(".heroSwiper", {
      loop: true,
      effect: "fade",
      speed: 900,
      autoplay: {
        delay: 6000,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      thumbs: {
        swiper: heroThumbs,
      },
      on: {
        init(swiper) {
          pauseAllHeroVideos();
          playActiveHeroVideo(swiper);
        },
        slideChangeTransitionStart(swiper) {
          pauseAllHeroVideos();
        },
        slideChangeTransitionEnd(swiper) {
          playActiveHeroVideo(swiper);
        },
      },
    });

    // If tab becomes visible again, try resuming the active video.
    document.addEventListener("visibilitychange", () => {
      if (document.visibilityState === "visible") {
        playActiveHeroVideo(heroSwiper);
      }
    });
  }

  // Logo strip slider (under hero) – 5 logos per view on desktop
  if (document.querySelector(".logoSwiper")) {
    new Swiper(".logoSwiper", {
      loop: true,
      grabCursor: true,
      speed: 600,
      slidesPerView: 2.2,
      spaceBetween: 24,
      autoplay: {
        delay: 3500,
        disableOnInteraction: false,
      },
      breakpoints: {
        576: {
          slidesPerView: 3,
        },
        768: {
          slidesPerView: 4,
        },
        1200: {
          slidesPerView: 5,
        },
      },
    });
  }

  // Product details gallery + swatches
  const productGalleryEl = document.querySelector(".productGallerySwiper");
  if (productGalleryEl) {
    const productGallery = new Swiper(productGalleryEl, {
      loop: true,
      centeredSlides: true,
      autoHeight: false,
      slidesPerView: 1.18,
      spaceBetween: 24,
      speed: 500,
      navigation: {
        nextEl: ".product-gallery-next",
        prevEl: ".product-gallery-prev",
      },
      pagination: {
        el: ".product-gallery-pagination",
        clickable: true,
      },
      breakpoints: {
        768: {
          slidesPerView: 1.82,
          spaceBetween: 28,
        },
        1200: {
          slidesPerView: 2.08,
          spaceBetween: 32,
        },
      },
    });

    // WooCommerce variations → custom swatches
    const variationForm = document.querySelector(".variations_form");
    const swatchButtons = Array.from(document.querySelectorAll(".js-wc-swatch"));
    const priceEl = document.querySelector(".product-summary-price");
    if (priceEl && !priceEl.dataset.originalHtml) {
      priceEl.dataset.originalHtml = priceEl.innerHTML;
    }

    const galleryImgs = Array.from(productGalleryEl.querySelectorAll(".product-main-image"));
    galleryImgs.forEach((img) => {
      if (!img.dataset.originalSrc) {
        img.dataset.originalSrc = img.getAttribute("src") || "";
      }
    });

    function setActiveSwatch(attr, value) {
      swatchButtons.forEach((b) => {
        if (b.dataset.attr !== attr) return;
        b.classList.toggle("is-active", b.dataset.value === value);
      });
    }

    function setVariationSelect(attr, value) {
      if (!variationForm) return;
      const select = variationForm.querySelector(`select[name="${CSS.escape(attr)}"]`);
      if (!select) return;
      select.value = value;
      select.dispatchEvent(new Event("change", { bubbles: true }));
      if (window.jQuery) {
        const $form = window.jQuery(variationForm);
        window.jQuery(select).trigger("change");
        // Force WooCommerce to re-check available variations.
        $form.trigger("check_variations");
      }
    }

    swatchButtons.forEach((btn) => {
      btn.addEventListener("click", () => {
        const attr = btn.dataset.attr;
        const value = btn.dataset.value;
        if (!attr || !value) return;
        setActiveSwatch(attr, value);
        setVariationSelect(attr, value);
      });
    });

    // Keep swatch state + gallery in sync when Woo updates variation.
    if (variationForm && window.jQuery) {
      const $form = window.jQuery(variationForm);

      $form.on("found_variation", (e, variation) => {
        if (!variation) return;

        // Sync swatch active state from variation attrs.
        if (variation.attributes) {
          Object.entries(variation.attributes).forEach(([k, v]) => {
            if (!k || !v) return;
            setActiveSwatch(k, v);
          });
        }

        // Update the first gallery image to the variation image.
        const src = variation?.image?.full_src || variation?.image?.src;
        if (src && galleryImgs.length) {
          galleryImgs.forEach((img) => (img.src = src));
          // ensure the user sees the updated slide immediately
          productGallery.slideToLoop(0, 0);
          productGallery.update();
        }

        // Update summary price.
        if (priceEl) {
          const html = variation?.price_html || variation?.priceHtml;
          if (html) priceEl.innerHTML = html;
        }
      });

      $form.on("reset_data", () => {
        // Reset swatches to first option per attribute.
        const byAttr = new Map();
        swatchButtons.forEach((b) => {
          if (!b.dataset.attr) return;
          if (!byAttr.has(b.dataset.attr)) byAttr.set(b.dataset.attr, b);
        });
        byAttr.forEach((btn) => btn.click());

        if (galleryImgs.length) {
          galleryImgs.forEach((img) => {
            if (img.dataset.originalSrc) img.src = img.dataset.originalSrc;
          });
          productGallery.slideToLoop(0, 0);
          productGallery.update();
        }

        if (priceEl && priceEl.dataset.originalHtml) {
          priceEl.innerHTML = priceEl.dataset.originalHtml;
        }
      });
    }
  }

  const similarProductsEl = document.querySelector(".similarProductsSwiper");
  if (similarProductsEl) {
    new Swiper(similarProductsEl, {
      loop: false,
      speed: 500,
      slidesPerView: 1.15,
      spaceBetween: 18,
      navigation: {
        nextEl: ".similar-products-next",
        prevEl: ".similar-products-prev",
      },
      breakpoints: {
        576: {
          slidesPerView: 1.6,
          spaceBetween: 20,
        },
        992: {
          slidesPerView: 3,
          spaceBetween: 24,
        },
        1400: {
          slidesPerView: 4,
          spaceBetween: 24,
        },
      },
    });
  }

  // Portfolio sliders (Section 1) – infinite loop with tabs
  const portfolioSwipers = {};

  document.querySelectorAll(".section-portfolio .portfolioSwiper").forEach((el, index) => {
    const key = el.closest(".portfolio-slider-wrapper")?.dataset.portfolio || `portfolio-${index}`;
    portfolioSwipers[key] = new Swiper(el, {
      loop: true,
      grabCursor: true,
      speed: 700,
      slidesPerView: 1.15,
      spaceBetween: 24,
      centeredSlides: false,
      autoplay: {
        delay: 4500,
        disableOnInteraction: false,
      },
      breakpoints: {
        768: {
          slidesPerView: 2.2,
        },
        1200: {
          slidesPerView: 3,
        },
      },
    });
  });

  // Portfolio modal
  const portfolioModalEl = document.getElementById("portfolioModal");
  if (portfolioModalEl && window.bootstrap?.Modal) {
    const portfolioModal = bootstrap.Modal.getOrCreateInstance(portfolioModalEl);
    const modalTitleEl = document.getElementById("portfolioModalLabel");
    const modalLocationEl = document.getElementById("portfolioModalLocation");
    const modalTextEl = document.getElementById("portfolioModalText");
    const modalMainImageEl = document.getElementById("portfolioModalMainImage");
    const modalThumbsEl = document.getElementById("portfolioModalThumbs");

    function resolveLegacyImgPath(candidate, baseImgSrc) {
      if (!candidate) return "";
      // If legacy HTML provides "img/..." paths, rewrite them to the same base as the card image src.
      if (candidate.startsWith("img/") && baseImgSrc) {
        const marker = "/img/";
        const idx = baseImgSrc.indexOf(marker);
        if (idx !== -1) {
          const base = baseImgSrc.slice(0, idx + marker.length);
          return base + candidate.slice("img/".length);
        }
      }
      return candidate;
    }

    function setActiveThumb(btn) {
      if (!modalThumbsEl) return;
      modalThumbsEl.querySelectorAll(".portfolio-modal-thumb").forEach((b) => b.classList.remove("is-active"));
      btn?.classList?.add("is-active");
    }

    modalThumbsEl?.addEventListener("click", (e) => {
      const btn = e.target.closest?.(".portfolio-modal-thumb");
      if (!btn || !modalMainImageEl) return;
      const src = btn.getAttribute("data-thumb-src");
      if (!src) return;
      modalMainImageEl.src = src;
      setActiveThumb(btn);
    });

    document.querySelectorAll(".portfolio-card-cta").forEach((btn) => {
      btn.addEventListener("click", () => {
        const card = btn.closest?.(".portfolio-card");
        if (!card) return;

        const title = card.querySelector(".portfolio-card-title")?.textContent?.trim() || "Project";
        const location = card.querySelector(".portfolio-card-location")?.textContent?.trim() || "";
        const description =
          card.querySelector(".portfolio-card-description")?.textContent?.trim() ||
          card.getAttribute("data-portfolio-description")?.trim() ||
          "";
        const imgSrc = card.querySelector(".portfolio-card-image img")?.getAttribute("src") || "";
        const imagesRaw = card.getAttribute("data-portfolio-images") || "";

        if (modalTitleEl) modalTitleEl.textContent = title;
        if (modalLocationEl) modalLocationEl.textContent = location;
        if (modalTextEl && description) modalTextEl.textContent = description;

        const imagesList = imagesRaw
          ? imagesRaw.split("|").map((s) => s.trim()).filter(Boolean).map((p) => resolveLegacyImgPath(p, imgSrc))
          : [];

        const mainSrc = imagesList[0] || imgSrc;
        if (modalMainImageEl && mainSrc) {
          modalMainImageEl.src = mainSrc;
        }

        if (modalThumbsEl) {
          const thumbs = Array.from(modalThumbsEl.querySelectorAll(".portfolio-modal-thumb"));
          const sources = imagesList.length ? imagesList : (imgSrc ? [imgSrc] : []);
          // If we have 1 main + extra images, use the next images for thumbnails.
          const thumbSources =
            sources.length > thumbs.length ? sources.slice(1, thumbs.length + 1) : sources.slice(0, thumbs.length);

          thumbs.forEach((t, i) => {
            const src = thumbSources[i] || thumbSources[0] || "";
            if (!src) {
              t.classList.add("d-none");
              return;
            }

            t.classList.remove("d-none");
            t.setAttribute("data-thumb-src", src);
            const img = t.querySelector("img");
            if (img) img.src = src;
            if (i === 0) t.classList.add("is-active");
            else t.classList.remove("is-active");
          });
        }

        portfolioModal.show();
      });
    });
  }

  document.querySelectorAll(".portfolio-tab").forEach((btn) => {
    btn.addEventListener("click", () => {
      const target = btn.dataset.target;

      document.querySelectorAll(".portfolio-tab").forEach((b) => b.classList.remove("active"));
      btn.classList.add("active");

      document.querySelectorAll(".portfolio-slider-wrapper").forEach((wrapper) => {
        if (wrapper.dataset.portfolio === target) {
          wrapper.classList.remove("d-none");
          const key = wrapper.dataset.portfolio;
          const swiper = portfolioSwipers[key];
          if (swiper) {
            swiper.update();
          }
        } else {
          wrapper.classList.add("d-none");
        }
      });
    });
  });

  // Product Collections sliders (Section 4)
  document.querySelectorAll(".section-collections .collectionSwiper").forEach((el) => {
    new Swiper(el, {
      loop: true,
      grabCursor: true,
      speed: 700,
      slidesPerView: 1.1,
      spaceBetween: 24,
      centeredSlides: false,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      breakpoints: {
        768: {
          slidesPerView: 4.1,
        },
        1200: {
          slidesPerView: 4.1,
        },
      },
    });
  });

  // What We Do hotspots (supports multiple pages/sections)
  const wwdCards = Array.from(document.querySelectorAll(".what-we-do-card"));
  const isMobileWwd = () => window.matchMedia && window.matchMedia("(max-width: 991.98px)").matches;

  wwdCards.forEach((card) => {
    const visual = card.querySelector(".what-we-do-visual") || card;
    const detail = card.querySelector(".what-we-do-detail");
    const hotspots = Array.from(card.querySelectorAll(".wwd-hotspot"));
    const texts = Array.from(card.querySelectorAll("[data-hotspot-text]"));
    const bgImg = card.querySelector(".what-we-do-bg");

    if (!detail || hotspots.length === 0 || texts.length === 0) return;

    let mobileSwiper = null;

    function ensureMobileSwiper() {
      if (card.querySelector(".wwd-mobile-swiper")) return;

      const slider = document.createElement("div");
      slider.className = "wwd-mobile-swiper swiper";
      slider.setAttribute("aria-label", "Swipe options");

      const hint = document.createElement("div");
      hint.className = "wwd-swipe-hint";
      hint.textContent = "SWIPE";
      slider.appendChild(hint);

      const wrapper = document.createElement("div");
      wrapper.className = "swiper-wrapper";

      texts.forEach((panel) => {
        const slide = document.createElement("div");
        slide.className = "swiper-slide";

        const cardEl = document.createElement("div");
        cardEl.className = "wwd-mobile-slide-card";
        cardEl.innerHTML = panel.innerHTML;

        slide.appendChild(cardEl);
        wrapper.appendChild(slide);
      });

      slider.appendChild(wrapper);
      visual.appendChild(slider);
    }

    function applyMobileSwiper() {
      card.classList.add("wwd-mobile-swiper-mode");
      ensureMobileSwiper();

      const sliderEl = card.querySelector(".wwd-mobile-swiper");
      if (sliderEl && window.Swiper && !mobileSwiper) {
        mobileSwiper = new Swiper(sliderEl, {
          loop: false,
          speed: 420,
          slidesPerView: 1.08,
          spaceBetween: 14,
          centeredSlides: false,
          grabCursor: true,
        });
      }
    }

    function applyDesktopInteractive() {
      card.classList.remove("wwd-mobile-swiper-mode");
      if (mobileSwiper) {
        try {
          mobileSwiper.destroy(true, true);
        } catch (_) {}
        mobileSwiper = null;
      }
      card.querySelector(".wwd-mobile-swiper")?.remove();
    }

    function moveDetailToHotspot(btn) {
      const anchor = visual || card;
      if (!anchor || !detail) return;

      const cardRect = anchor.getBoundingClientRect();
      const btnRect = btn.getBoundingClientRect();
      const centerX = btnRect.left + btnRect.width / 2 - cardRect.left;
      const centerY = btnRect.top + btnRect.height / 2 - cardRect.top;

      const topPercent = (centerY / cardRect.height) * 100;
      const leftPercent = (centerX / cardRect.width) * 100;

      let bubbleTop = Math.max(10, topPercent - 8);
      const bubbleLeft = Math.min(80, Math.max(20, leftPercent - 8));

      detail.style.setProperty("--wwd-bubble-top", `${bubbleTop}%`);
      detail.style.setProperty("--wwd-bubble-left", `${bubbleLeft}%`);

      requestAnimationFrame(() => {
        requestAnimationFrame(() => {
          const rect = anchor.getBoundingClientRect();
          if (rect.height < 1) return;
          const detailH = detail.offsetHeight;
          const topMargin = 18;
          const minTopPct = Math.min(94, ((detailH + topMargin) / rect.height) * 100);
          if (bubbleTop < minTopPct) {
            detail.style.setProperty("--wwd-bubble-top", `${minTopPct}%`);
          }
        });
      });
    }

    function setActive(key, btn) {
      hotspots.forEach((b) => b.classList.remove("wwd-hotspot-active"));
      btn.classList.add("wwd-hotspot-active");

      texts.forEach((p) => {
        if (p.dataset.hotspotText === key) {
          p.classList.remove("d-none");
          p.classList.add("wwd-text-active");
        } else {
          p.classList.add("d-none");
          p.classList.remove("wwd-text-active");
        }
      });

      if (isMobileWwd()) {
        applyMobileSwiper();
        return;
      }

      moveDetailToHotspot(btn);
    }

    hotspots.forEach((btn) => {
      btn.addEventListener("click", () => {
        const key = btn.dataset.hotspot;
        if (!key) return;
        setActive(key, btn);
      });
    });

    // Init
    const initial = card.querySelector(".wwd-hotspot-active") || hotspots[0];
    if (initial) {
      const key = initial.dataset.hotspot;
      if (key) setActive(key, initial);
    }

    // Recalc once everything is fully loaded (fonts/images can shift layout)
    const recalcActive = () => {
      if (isMobileWwd()) return;
      const active = card.querySelector(".wwd-hotspot-active");
      if (active) moveDetailToHotspot(active);
    };

    // After full page load
    window.addEventListener("load", recalcActive, { once: true });

    // After the background image loads (or if it was already cached)
    if (bgImg && bgImg.complete) {
      requestAnimationFrame(recalcActive);
    } else if (bgImg) {
      bgImg.addEventListener("load", recalcActive, { once: true });
    }

    // Resize: keep desktop bubble pinned to active hotspot
    let resizeTimer;
    window.addEventListener("resize", () => {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(() => {
        if (isMobileWwd()) {
          applyMobileSwiper();
        } else {
          applyDesktopInteractive();
          const active = card.querySelector(".wwd-hotspot-active");
          if (active) moveDetailToHotspot(active);
        }
      }, 120);
    });
  });

  // Blog detail: recommended blogs carousel
  if (document.querySelector(".recommendedBlogsSwiper")) {
    new Swiper(".recommendedBlogsSwiper", {
      loop: true,
      speed: 520,
      grabCursor: true,
      spaceBetween: 20,
      slidesPerView: 1.12,
      navigation: {
        nextEl: ".recommended-blogs-next",
        prevEl: ".recommended-blogs-prev",
      },
      breakpoints: {
        576: {
          slidesPerView: 2,
          spaceBetween: 20,
        },
        992: {
          slidesPerView: 3,
          spaceBetween: 22,
        },
        1200: {
          slidesPerView: 4,
          spaceBetween: 24,
        },
      },
    });
  }
});

