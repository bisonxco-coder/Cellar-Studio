<?php
$navActive = "wine-racking";
/**
 * Wine Racking Solutions — faqe statike (prototip).
 * Hero me imazh, intro + slider, Materials & Finishes, hotspots, collections, CTA, etj.
 */
?>
<!DOCTYPE html>
<html lang="sq">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Wine Racking Solutions | Cellar Studio</title>
  <link rel="icon" type="image/png" href="img/favicon.png">

  <!-- Inter (body) — përputhet me style.css -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

  <!-- Bootstrap 5 -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous"
  >

  <!-- Swiper (ngarkohet nga footer.php — lidhje këtu për konsistencë me faqet e tjera) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

  <!-- AOS (Animate On Scroll) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/responsive.css">
</head>
<body>

  <!-- ========= Hero: imazh + navbar (i përbashkët: includes/navbar.php) ========= -->
  <section class="page-hero" aria-label="Wine racking solutions hero">
    <div class="hero-nav-layer">
      <?php include __DIR__ . '/includes/navbar.php'; ?>
    </div>

    <img
      class="page-hero-bg-img"
      src="img/wine-racking-solutions_hero.png"
      alt=""
      decoding="async"
      fetchpriority="high"
    >

    <div class="page-hero-overlay">
      <div class="container h-100 d-flex flex-column justify-content-center align-items-center text-center">
        <div class="hero-content reveal reveal--fade">
          <h1 class="hero-title">Racking Solutions</h1>
          <p class="hero-subtitle">
          Modular and semi-custom wine racking solutions designed for efficiency,<br>scalability, and refined presentation.
          </p>
          <div class="mt-4">
            <a href="contact.php#contact-form" class="btn btn-light btn-lg hero-cta-main">Explore Models</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ========= Intro: titull + përshkrim (pa slider — vetëm tipografi) ========= -->
  <section class="section-portfolio reveal reveal--fade" aria-labelledby="cigar-intro-heading">
    <div class="container-fluid">
      <div class="row justify-content-center text-center reveal-stagger">
        <div class="col-lg-8">
          <h2 id="cigar-intro-heading" class="section-title reveal">
          Structured Storage, Designed with Precision
          </h2>
          <p class="section-subtitle mt-3 reveal">
          Our wine racking systems provide smart, scalable solutions for residential and commercial applications.
          </p>
          <p class="section-subtitle reveal">
          Whether for a dedicated cellar or integrated cabinetry, we offer modular systems that adapt to your space.
          </p>
        </div>
      </div>
      
      <!-- Wine slider -->
      <div class="portfolio-slider-wrapper mt-5 portfolio-slider-active" data-portfolio="wine">
        <div class="swiper portfolioSwiper">
          <div class="swiper-wrapper">
            <!-- Card 1 -->
            <div class="swiper-slide">
              <article class="portfolio-card" data-portfolio-description="An under-stair wine racking installation in Al Barari, using the leftover volume beneath the stair to store bottles in a precise, architectural display. Modular bays, warm lighting, and clean joinery keep the collection ordered while remaining part of the home.">
                <div class="portfolio-card-image">
                  <img src="img/11111.png" alt="Under-Stair Wine">
                </div>
                <div class="portfolio-card-body">
                  <h3 class="portfolio-card-title">Under-Stair Wine</h3>
                  <p class="portfolio-card-location">Al Barari, Dubai, UAE</p>
                </div>
                <button class="portfolio-card-cta" type="button">+</button>
              </article>
            </div>
            <!-- Card 2 -->
            <div class="swiper-slide">
              <article class="portfolio-card" data-portfolio-description="Architectural wine racking in Emirates Hills, designed as a full-height feature wall. Slim profiles, balanced spacing, and layered lighting turn several hundred bottles into a calm, gallery-like composition.">
                <div class="portfolio-card-image">
                  <img src="img/22222.png" alt="Architectural Wine">
                </div>
                <div class="portfolio-card-body">
                  <h3 class="portfolio-card-title">Architectural Wine</h3>
                  <p class="portfolio-card-location">Emirates Hills, Dubai, UAE</p>
                </div>
                <button class="portfolio-card-cta" type="button">+</button>
              </article>
            </div>
            <!-- Card 3 -->
            <div class="swiper-slide">
              <article class="portfolio-card" data-portfolio-description="Wine storage integrated into a private dining room in Dubai Hills Estate, so the collection sits within the architecture rather than a separate cellar. The racking is specified for capacity, climate compatibility, and a refined presence at the table.">
                <div class="portfolio-card-image">
                  <img src="img/33333.png" alt="Private Dining">
                </div>
                <div class="portfolio-card-body">
                  <h3 class="portfolio-card-title">Private Dining</h3>
                  <p class="portfolio-card-location">Dubai Hills Estate, Dubai, UAE</p>
                </div>
                <button class="portfolio-card-cta" type="button">+</button>
              </article>
            </div>
            <!-- Card 4 -->
            <div class="swiper-slide">
              <article class="portfolio-card" data-portfolio-description="A contemporary cellar in Zurich with modular racking engineered for density and visual order. Premium finishes and tailored proportions keep a large collection perfectly aligned and easy to live with.">
                <div class="portfolio-card-image">
                  <img src="img/image 34.png" alt="Contemporary Cellar">
                </div>
                <div class="portfolio-card-body">
                  <h3 class="portfolio-card-title">Contemporary Cellar</h3>
                  <p class="portfolio-card-location">Zurich, Switzerland</p>
                </div>
                <button class="portfolio-card-cta" type="button">+</button>
              </article>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- ========= Hotspots: data-hotspot / data-hotspot-text duhet të përputhen (main.js) ========= -->
  <section class="section-what-we-do py-5 py-lg-6 reveal reveal--fade" aria-label="Features overview">
    <div class="container-fluid">
      <div class="what-we-do-card">
        <div class="what-we-do-visual">
        <img src="img/Frame 2147223442123113.png" alt="" class="what-we-do-bg" role="presentation">

        <div class="bespoke-deliver-title" aria-hidden="true">
        Available<br>Configurations
        </div>

        <div class="what-we-do-detail">
          <h3 class="wwd-title">Key<br>Features</h3>

          <div class="wwd-panel wwd-text-active" data-hotspot-text="deliver-1">
            <p class="wwd-subtitle">Humidity Precision</p>
            <p class="wwd-body">
              Stable relative humidity levels help preserve cigars at their best — engineered for
              consistency and quiet, reliable operation.
            </p>
          </div>

          <div class="wwd-panel d-none" data-hotspot-text="deliver-2">
            <p class="wwd-subtitle">Temperature Control</p>
            <p class="wwd-body">
              Balanced cooling supports long-term storage while protecting aroma, oils, and wrapper
              integrity across seasons.
            </p>
          </div>

          <div class="wwd-panel d-none" data-hotspot-text="deliver-3">
            <p class="wwd-subtitle">Display &amp; Lighting</p>
            <p class="wwd-body">
              Glass fronts and considered lighting showcase your collection with clarity — without
              compromising the internal climate.
            </p>
          </div>

          <div class="wwd-panel d-none" data-hotspot-text="deliver-4">
            <p class="wwd-subtitle">Materials &amp; Finish</p>
            <p class="wwd-body">
              Premium surfaces and detailing align with residential and hospitality interiors, from
              subtle minimalism to statement pieces.
            </p>
          </div>

          <div class="wwd-panel d-none" data-hotspot-text="deliver-5">
            <p class="wwd-subtitle">Support &amp; Setup</p>
            <p class="wwd-body">
              Guidance on placement, ventilation, and calibration so your humidor performs as
              intended from day one.
            </p>
          </div>
        </div>

        <button type="button" class="wwd-hotspot wwd-hotspot-active" data-hotspot="deliver-1" style="top: 38%; left: 16%;" aria-label="Humidity precision">
          <span></span>
        </button>
        <button type="button" class="wwd-hotspot" data-hotspot="deliver-2" style="top: 56%; left: 36%;" aria-label="Temperature control">
          <span></span>
        </button>
        <button type="button" class="wwd-hotspot" data-hotspot="deliver-3" style="top: 28%; left: 62%;" aria-label="Display and lighting">
          <span></span>
        </button>
        <button type="button" class="wwd-hotspot" data-hotspot="deliver-4" style="top: 62%; left: 63%;" aria-label="Materials and finish">
          <span></span>
        </button>
        <button type="button" class="wwd-hotspot" data-hotspot="deliver-5" style="top: 52%; left: 46%;" aria-label="Support and setup">
          <span></span>
        </button>
        </div>
      </div>
    </div>
  </section>
  


  <!-- Seksioni 3: FAQ (dy kolona — titull | accordion) -->
  <section class="contact-faq-section py-5 py-lg-6 reveal reveal--fade" aria-labelledby="contact-faq-heading">
    <div class="container">
      <div class="row g-4 g-lg-5 align-items-start">
        <div class="col-lg-5 col-xl-4 reveal">
          <h2 id="contact-faq-heading" class="contact-faq-title">Frequently Asked Question</h2>
        </div>
        <div class="col-lg-7 col-xl-8 reveal">
          <div class="accordion contact-faq-accordion" id="contactFaqAccordion">
            <div class="accordion-item contact-faq-item">
              <h3 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#contactFaq1" aria-expanded="true" aria-controls="contactFaq1">
                  What materials are used in Cellar Studio installations?
                </button>
              </h3>
              <div id="contactFaq1" class="accordion-collapse collapse show" data-bs-parent="#contactFaqAccordion">
                <div class="accordion-body">
                  We use premium-grade materials including solid hardwood, architectural glass, powder-coated metal, natural stone, and climate-resistant finishes.
                </div>
              </div>
            </div>

            <div class="accordion-item contact-faq-item">
              <h3 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#contactFaq2" aria-expanded="false" aria-controls="contactFaq2">
                  Do you offer fully bespoke wine cellar and cigar room design?
                </button>
              </h3>
              <div id="contactFaq2" class="accordion-collapse collapse" data-bs-parent="#contactFaqAccordion">
                <div class="accordion-body">
                  Yes — we design and deliver fully bespoke environments tailored to your architecture, collection, and lifestyle, from concept through installation.
                </div>
              </div>
            </div>

            <div class="accordion-item contact-faq-item">
              <h3 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#contactFaq3" aria-expanded="false" aria-controls="contactFaq3">
                  Are your wine racks and display systems climate compatible?
                </button>
              </h3>
              <div id="contactFaq3" class="accordion-collapse collapse" data-bs-parent="#contactFaqAccordion">
                <div class="accordion-body">
                  Our systems are specified to work with professional climate and humidity control. We coordinate engineering so storage conditions remain stable and discreet.
                </div>
              </div>
            </div>

            <div class="accordion-item contact-faq-item">
              <h3 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#contactFaq4" aria-expanded="false" aria-controls="contactFaq4">
                  Can I customise a product from your collection?
                </button>
              </h3>
              <div id="contactFaq4" class="accordion-collapse collapse" data-bs-parent="#contactFaqAccordion">
                <div class="accordion-body">
                  Many products support finishes, sizing, and configuration options. Share your requirements and we will advise what can be adapted within lead times and budget.
                </div>
              </div>
            </div>

            <div class="accordion-item contact-faq-item">
              <h3 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#contactFaq5" aria-expanded="false" aria-controls="contactFaq5">
                  Do you provide installation services?
                </button>
              </h3>
              <div id="contactFaq5" class="accordion-collapse collapse" data-bs-parent="#contactFaqAccordion">
                <div class="accordion-body">
                  Yes. We manage on-site installation, coordination, and quality checks so the finished space matches the approved design and performs as intended.
                </div>
              </div>
            </div>

            <div class="accordion-item contact-faq-item">
              <h3 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#contactFaq6" aria-expanded="false" aria-controls="contactFaq6">
                  Do you ship internationally?
                </button>
              </h3>
              <div id="contactFaq6" class="accordion-collapse collapse" data-bs-parent="#contactFaqAccordion">
                <div class="accordion-body">
                  Where regulations and logistics allow, we can support international delivery. Scope depends on product type, site location, and local compliance — ask us for a project-specific answer.
                </div>
              </div>
            </div>

            <div class="accordion-item contact-faq-item">
              <h3 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#contactFaq7" aria-expanded="false" aria-controls="contactFaq7">
                  How do I begin a project with Cellar Studio?
                </button>
              </h3>
              <div id="contactFaq7" class="accordion-collapse collapse" data-bs-parent="#contactFaqAccordion">
                <div class="accordion-body">
                  Start with a consultation: share your space, timeline, and goals. We will outline next steps — from measurements and concepts to proposals and scheduling.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ========= Materials & Finishes: masonry grid + pill labels (glass blur) ========= -->
  <!-- <section class="materials-finishes-section py-5 py-lg-6 reveal reveal--fade" aria-labelledby="materials-finishes-heading">
    <div class="container-fluid">
      <h2 id="materials-finishes-heading" class="materials-finishes-title reveal">
        Materials &amp; Finishes
      </h2>

      <div class="materials-finishes-grid reveal-stagger">
        <div class="mf-cell mf-cell--metal reveal">
          <img src="img/Rectangle 155.png" alt="Wine bottles on powder-coated metal racking" loading="lazy">
          <div class="mf-label">
            <span class="mf-pill">Powder-coated metal</span>
          </div>
        </div>

        <div class="mf-cell mf-cell--glass reveal">
          <img src="img/Rectangle 153.png" alt="Glass-front wine cellar system" loading="lazy">
          <div class="mf-label">
            <span class="mf-pill">Glass-front systems</span>
          </div>
        </div>

        <div class="mf-cell mf-cell--wide reveal">
          <img src="img/Rectangle 154.png" alt="Dining space with integrated custom wine display" loading="lazy">
          <div class="mf-label">
            <span class="mf-pill">Custom finishes available</span>
          </div>
        </div>

        <div class="mf-cell mf-cell--wood reveal">
          <img src="img/Rectangle 80.png" alt="Solid wood finish detail" loading="lazy">
          <div class="mf-label">
            <span class="mf-pill">Solid wood</span>
          </div>
        </div>
      </div>
    </div>
  </section> -->

  <!-- SECTION: Products carousel (WooCommerce) -->
  <!-- CELLAR_WC_COLLECTIONS -->

<!-- ABOUT SECTION 7: CTA -->
<section class="about-cta py-5 py-lg-6">
    <div class="container text-center reveal-stagger">
      <h2 class="about-cta-title reveal">Design Your Private Cellar</h2>
      <p class="about-cta-subtitle mt-3 reveal">Tailored to your space. Engineered for your collection.</p>
      <div class="mt-4 reveal">
        <a href="bespoke.php#bespoke-enquiry" class="btn btn-dark rounded-pill px-4 about-cta-btn">Start Your Project</a>
      </div>
    </div>
  </section>
  <img src="img/Gemini_Generated_Image_dyqik0dyqik0dyqi.png" style="width: 100%;" alt="" srcset="">

