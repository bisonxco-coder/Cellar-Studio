<?php
$navActive = "bespoke";
?>
<!DOCTYPE html>
<html lang="sq">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bespoke | Cellar Studio</title>
  <link rel="icon" type="image/png" href="img/favicon.png">

  <!-- Google Font: Inter (for paragraphs/body text) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous"
  >

  <!-- Swiper CSS (used by other pages too) -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
  >

  <!-- AOS (Animate On Scroll) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">

  <!-- CSS -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/responsive.css">
</head>
<body>

  <!-- HERO SLIDER SECTION (same fade slider as home) -->
  <section class="hero-slider position-relative" aria-label="Bespoke hero">
    <!-- Top nav (render once) -->
    <div class="hero-nav-layer">
      <?php include __DIR__ . '/includes/navbar.php'; ?>
    </div>

    <!-- Main slider -->
    <div class="swiper heroSwiper h-100">
      <div class="swiper-wrapper">
        <!-- Slide 1 -->
        <div class="swiper-slide">
          <div class="hero-slide">
            <img
              class="hero-slide-bg"
              src="img/bespokeone.png"
              alt=""
              decoding="async"
              fetchpriority="high"
            >
            <div class="hero-overlay">
              <div class="container h-100 d-flex flex-column">
                <div class="hero-content flex-grow-1 d-flex flex-column justify-content-center">
                  <h1 class="hero-title">Bespoke</h1>
                  <p class="hero-subtitle">
                    We design and execute fully bespoke wine cellars, cigar rooms, and integrated storage environments — tailored to your architecture, collection, and lifestyle.
                  </p>
                  <div class="mt-4">
                    <a href="#bespoke-enquiry" class="btn btn-light btn-lg hero-cta-main">Request a Consultation</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="swiper-slide">
          <div class="hero-slide">
            <img class="hero-slide-bg" src="img/ChatGPT Image Apr 27, 2026, 10_52_56 AM.png" alt="" decoding="async">
            <div class="hero-overlay">
              <div class="container h-100 d-flex flex-column">
                <div class="hero-content flex-grow-1 d-flex flex-column justify-content-center">
                  <h1 class="hero-title">Bespoke</h1>
                  <p class="hero-subtitle">
                    We design and execute fully bespoke wine cellars, cigar rooms, and integrated storage environments — tailored to your architecture, collection, and lifestyle.
                  </p>
                  <div class="mt-4">
                    <a href="#bespoke-enquiry" class="btn btn-light btn-lg hero-cta-main">Request a Consultation</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="swiper-slide">
          <div class="hero-slide">
            <img class="hero-slide-bg" src="img/ChatGPT Image Apr 27, 2026, 11_30_14 AM.png" alt="" decoding="async">
            <div class="hero-overlay">
              <div class="container h-100 d-flex flex-column">
                <div class="hero-content flex-grow-1 d-flex flex-column justify-content-center">
                  <h1 class="hero-title">Bespoke</h1>
                  <p class="hero-subtitle">
                    We design and execute fully bespoke wine cellars, cigar rooms, and integrated storage environments — tailored to your architecture, collection, and lifestyle.
                  </p>
                  <div class="mt-4">
                    <a href="#bespoke-enquiry" class="btn btn-light btn-lg hero-cta-main">Request a Consultation</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="swiper-pagination"></div>
    </div>

  <!-- Thumbnails slider at the bottom -->
  <div class="hero-thumbs-container">
    <div class="container-fluid">
      <div class="swiper heroThumbs">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <div class="hero-thumb-card">
              <img src="img/bes_header.png" alt="Thumbnail 1">
            </div>
          </div>
          <div class="swiper-slide">
            <div class="hero-thumb-card">
              <img src="img/ChatGPT Image Apr 27, 2026, 10_52_56 AM.png" alt="Thumbnail 2">
            </div>
          </div>
          <div class="swiper-slide">
            <div class="hero-thumb-card">
              <img src="img/ChatGPT Image Apr 27, 2026, 11_30_14 AM.png" alt="Thumbnail 3">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </section>

  <!-- SECTION 1: Portfolio with tab filter and sliders -->
  <section class="section-portfolio reveal reveal--fade">
    <div class="container-fluid">
      <div class="row justify-content-center text-center reveal-stagger">
        <div class="col-lg-8">
          <h2 class="section-title reveal">
          More Than Cabinets<br>— A Designed<br>Environment
          </h2>
          <p class="section-subtitle mt-3 reveal">
          Cellar Studio delivers complete, custom-built wine and cigar spaces. Each project is engineered from the ground up — combining spatial design, climate precision, and architectural integration.

          From private residences to hospitality venues, we create immersive environments that elevate both collection and experience.
          </p>
        </div>
      </div>

      <!-- Tabs -->
      <!-- <div class="portfolio-tabs text-center mt-4 reveal">
        <button class="btn btn-dark rounded-pill px-4 me-2 portfolio-tab active" data-target="wine">
          Wine Portfolio
        </button>
        <button class="btn btn-outline-dark rounded-pill px-4 portfolio-tab" data-target="cigar">
          Cigar Portfolio
        </button>
      </div> -->

      <!-- Wine slider -->
      <div class="portfolio-slider-wrapper mt-5 portfolio-slider-active" data-portfolio="wine">
        <div class="swiper portfolioSwiper">
          <div class="swiper-wrapper">
            <!-- Card 1 -->
            <div class="swiper-slide">
              <article class="portfolio-card"
                data-portfolio-images="img/ChatGPT Image Apr 24, 2026, 02_57_01 PM.png|img/ChatGPT Image Apr 24, 2026, 02_55_43 PM.png|img/ChatGPT Image Apr 24, 2026, 02_54_45 PM.png|img/ChatGPT Image Apr 24, 2026, 03_03_03 PM.png"
                data-portfolio-description="A statement wine wall designed to elevate the
entire space, where architecture and collection
become one visual experience.
Warm timber, refined metal frames, and layered
lighting create depth and highlight every bottle
like a curated gallery.
Engineered for both performance and impact, it
stores several hundred bottles in a bold yet
perfectly ordered composition.">
                <div class="portfolio-card-image">
                  <img src="img/ChatGPT Image Apr 24, 2026, 03_03_03 PM.png" alt="Architectural Wine">
                </div>
                <div class="portfolio-card-body">
                  <h3 class="portfolio-card-title">Wine Wall</h3>
                  <p class="portfolio-card-location">Emirates Hills, Dubai, UAE</p>
                </div>
                <button class="portfolio-card-cta" type="button">+</button>
              </article>
            </div>
            <!-- Card 2 -->
            <div class="swiper-slide">
              <article class="portfolio-card"
                data-portfolio-images="img/ChatGPT Image Apr 24, 2026, 02_41_52 PM.png|img/ChatGPT Image Apr 24, 2026, 02_40_44 PM.png|img/ChatGPT Image Apr 24, 2026, 02_39_24 PM.png|img/ChatGPT Image Apr 24, 2026, 02_38_12 PM.png"
                data-portfolio-description="A glass-enclosed wine cellar designed to flow naturally within
the home, turning a transition space into a refined journey.
Clean mineral finishes, dark metal framing, and soft lighting
create a subtle contrast, allowing each bottle to appear
suspended within the architecture.
Both discreet and expressive, the space preserves and
showcases a curated collection of several hundred bottles
with precision and elegance.">
                <div class="portfolio-card-image">
                  <img src="img/ChatGPT Image Apr 24, 2026, 02_41_52 PM.png" alt="Contemporary Cellar">
                </div>
                <div class="portfolio-card-body">
                <h3 class="portfolio-card-title">Wine Cellar</h3>
                  <p class="portfolio-card-location">Zurich, Switzerland</p>
                </div>
                <button class="portfolio-card-cta" type="button">+</button>
              </article>
            </div>
            <!-- Card 5 -->
            <div class="swiper-slide">
              <article class="portfolio-card"
                data-portfolio-images="img/ChatGPT Image Apr 24, 2026, 02_36_35 PM.png|img/ChatGPT Image Apr 24, 2026, 02_44_16 PM.png|img/ChatGPT Image Apr 24, 2026, 02_41_52 PM.png|img/ChatGPT Image Apr 24, 2026, 02_29_14 PM.png|img/ChatGPT Image Apr 24, 2026, 02_26_56 PM.png"
                data-portfolio-description="A private dining space seamlessly integrated
with a full-height wine wall, creating a warm
and immersive atmosphere.
Natural wood, stone, and soft lighting enhance
depth and elegance, while the racking system
ensures optimal wine storage conditions.
Designed for both hosting and display, the cellar
accommodates several hundred bottles in a
refined, architectural layout.">
                <div class="portfolio-card-image">
                  <img src="img/ChatGPT Image Apr 24, 2026, 02_36_35 PM.png" alt="Private Dining">
                </div>
                <div class="portfolio-card-body">
                <h3 class="portfolio-card-title">Wine Wall</h3>
                  <p class="portfolio-card-location">Zurich, Switzerland</p>
                </div>
                <button class="portfolio-card-cta" type="button">+</button>
              </article>
            </div>
            
            <!-- Card 6 -->
            <div class="swiper-slide">
              <article class="portfolio-card"
                data-portfolio-images="img/ChatGPT Image Apr 24, 2026, 02_25_01 PM.png|img/ChatGPT Image Apr 24, 2026, 02_23_20 PM.png|img/ChatGPT Image Apr 24, 2026, 02_22_16 PM.png|img/ChatGPT Image Apr 24, 2026, 02_22_16 PM.png|img/ChatGPT Image Apr 24, 2026, 02_22_16 PM.png"
                data-portfolio-description="A contemporary wine wall designed as a
seamless extension of the living space, turning
storage into a striking architectural feature.
Natural wood, stone textures, and warm lighting
enhance depth, while the racking system
ensures optimal wine conditions.
Balancing display and functionality, it
accommodates several hundred bottles in a
clean, elegant composition">
                <div class="portfolio-card-image">
                  <img src="img/ChatGPT Image Apr 24, 2026, 02_25_01 PM.png" alt="Contemporary Cellar">
                </div>
                <div class="portfolio-card-body">
                <h3 class="portfolio-card-title">Wine Wall</h3>
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

  <!-- SECTION: What We Deliver (hotspots with 5 points) -->
  <section class="section-what-we-do py-5 py-lg-6 reveal reveal--fade">
    <div class="container-fluid">
      <div class="what-we-do-card">
        <div class="what-we-do-visual">
        <img src="img/ChatGPT Image Apr 27, 2026, 11_55_43 AM.png" alt="What we deliver" class="what-we-do-bg">

        <!-- Large left title (as in design) -->
        <div class="bespoke-deliver-title">
          What We<br>Deliver
        </div>

        <!-- Hotspot detail bubble -->
        <div class="what-we-do-detail">
          <h3 class="wwd-title">What We Deliver</h3>

          <div class="wwd-panel wwd-text-active" data-hotspot-text="deliver-1">
            <!-- <p class="wwd-subtitle">Custom Spatial Planning</p> -->
            <p class="wwd-body">Bespoke or ready made racking systems</p>
          </div>

          <div class="wwd-panel d-none" data-hotspot-text="deliver-2">
            <!-- <p class="wwd-subtitle">Precision Joinery</p> -->
            <p class="wwd-body">Perfect Kelvin ligthing for you wine</p>
          </div>

          <div class="wwd-panel d-none" data-hotspot-text="deliver-3">
            <!-- <p class="wwd-subtitle">Climate Integration</p> -->
            <p class="wwd-body">Monoblock or Split chiller system
            for long conservation</p>
          </div>

        </div>

        <!-- 5 Hotspots -->
        <button type="button"
                class="wwd-hotspot wwd-hotspot-active"
                data-hotspot="deliver-1"
                style="top: 38%; left: 16%;">
          <span></span>
        </button>
        <button type="button"
                class="wwd-hotspot"
                data-hotspot="deliver-2"
                style="top: 56%; left: 66%;">
          <span></span>
        </button>
        <button type="button"
                class="wwd-hotspot"
                data-hotspot="deliver-3"
                style="top: 18%; left: 82%;">
          <span></span>
        </button>
        </div>
      </div>
    </div>
  </section>

  <!-- SECTION: Our Process (OLD - disabled, kept for reference) -->
  <!--
  <section class="bespoke-process-section py-5 py-lg-6 reveal reveal--fade">
    <div class="container-fluid">
      <div class="bespoke-process-layout">
        <aside class="bespoke-process-heading-wrap reveal">
          <h2 class="bespoke-process-heading">
          Our Process in Designing & Building Custom Bespoke
          </h2>
        </aside>

        <div class="bespoke-process-cards reveal-stagger">
          <article class="bespoke-process-card reveal">
            <div class="bespoke-process-image">
              <img src="img/image 3354.png" alt="Consultation and Measurements">
            </div>
            <div class="bespoke-process-content">
              <p class="bespoke-process-index">01</p>
              <h3 class="bespoke-process-title">Consultation &amp; Measurements</h3>
              <p class="bespoke-process-text">
              Every project begins with a detailed consultation and on-site assessment. We take precise measurements, understand the space, and discuss your collection, lifestyle, and expectations. This foundation allows us to design wine cellar and cigar room solutions that are fully tailored, technically accurate, and ready for custom fit-out.
              </p>
            </div>
          </article>

          <article class="bespoke-process-card reveal">
            <div class="bespoke-process-image">
              <img src="img/image 34543.png" alt="Concept Design and 3D Rendering">
            </div>
            <div class="bespoke-process-content">
              <p class="bespoke-process-index">02</p>
              <h3 class="bespoke-process-title">Concept, Design &amp; 3D Rendering</h3>
              <p class="bespoke-process-text">
              The second step is understanding the space, the collection, and the desired experience. We develop detailed concepts and realistic 3D renderings that visualize the complete wine cellar or cigar room before any fabrication begins.
              </p>
            </div>
          </article>

          <article class="bespoke-process-card reveal">
            <div class="bespoke-process-image">
              <img src="img/Projects1231122.png" alt="Material Selection and Climate Engineering">
            </div>
            <div class="bespoke-process-content">
              <p class="bespoke-process-index">03</p>
              <h3 class="bespoke-process-title">Material Selection &amp; Climate Engineering</h3>
              <p class="bespoke-process-text">
              Based on the approved design, we select premium materials and engineer precise climate and humidity systems. Every element is tailored to ensure optimal preservation while supporting the architectural vision of the space.
              </p>
            </div>
          </article>

          <article class="bespoke-process-card reveal">
            <div class="bespoke-process-image">
              <img src="img/Frame 2095586182 (1).png" alt="Custom Fit Out Installation and Quality Control">
            </div>
            <div class="bespoke-process-content">
              <p class="bespoke-process-index">04</p>
              <h3 class="bespoke-process-title">Custom Fit-Out, Installation &amp; Quality Control</h3>
              <p class="bespoke-process-text">
              We execute the full custom fit-out, from cabinetry and lighting to climate systems and final detailing. Each wine cellar and cigar room is installed on site, tested, and refined to ensure long-term performance and flawless integration.
              </p>
            </div>
          </article>
        </div>
      </div>
    </div>
  </section>
  -->

  <!-- SECTION: Our Process (V2 - new design) -->
  <section class="bespoke-process-v2-section py-5 py-lg-6 reveal reveal--fade" aria-label="Our process">
    <div class="container-fluid">
      <div class="bespoke-process-v2-layout">
        <aside class="bespoke-process-v2-heading reveal">
          <h2 class="bespoke-process-v2-title">
            Our Process In<br>
            Designing &amp; Building<br>
            Custom Bespoke
          </h2>
        </aside>

        <div class="bespoke-process-v2-grid reveal-stagger">
          <article class="bespoke-process-v2-card reveal">
            <p class="bespoke-process-v2-index">01</p>
            <h3 class="bespoke-process-v2-card-title">Consultation &amp; Measurements</h3>
            <p class="bespoke-process-v2-card-text">
              Every project begins with a detailed consultation and on-site assessment. We take precise measurements, understand the space, and discuss your collection, lifestyle, and expectations. This foundation allows us to design wine cellar and cigar room solutions that are fully tailored, technically accurate, and ready for custom fit-out.
            </p>
          </article>

          <article class="bespoke-process-v2-card reveal">
            <p class="bespoke-process-v2-index">02</p>
            <h3 class="bespoke-process-v2-card-title">Concept, Design &amp; 3D Rendering</h3>
            <p class="bespoke-process-v2-card-text">
              The second step is understanding the space, the collection, and the desired experience. We develop detailed concepts and realistic 3D renderings that visualize the complete wine cellar or cigar room before any fabrication begins.
            </p>
          </article>

          <article class="bespoke-process-v2-card reveal">
            <p class="bespoke-process-v2-index">03</p>
            <h3 class="bespoke-process-v2-card-title">Material Selection &amp; Climate Engineering</h3>
            <p class="bespoke-process-v2-card-text">
              Based on the approved design, we select premium materials and engineer precise climate and humidity systems. Every element is tailored to ensure optimal preservation while supporting the architectural vision of the space.
            </p>
          </article>

          <article class="bespoke-process-v2-card reveal">
            <p class="bespoke-process-v2-index">04</p>
            <h3 class="bespoke-process-v2-card-title">Custom Fit-Out, Installation &amp; Quality Control</h3>
            <p class="bespoke-process-v2-card-text">
              We execute the full custom fit-out, from cabinetry and lighting to climate systems and final detailing. Each wine cellar and cigar room is installed on site, tested, and refined to ensure long-term performance and flawless integration.
            </p>
          </article>
        </div>
      </div>
    </div>
  </section>
  
  <?php include __DIR__ . '/includes/technical-precision.php'; ?>

  
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

  <?php
    $bespokeThankYou = function_exists('home_url')
      ? home_url('/thank-you-bespoke/')
      : 'thank-you-bespoke.php';
    $bespokeMailerUrl = function_exists('cellar_studio_mailer_endpoint')
      ? cellar_studio_mailer_endpoint()
      : 'mailer.php';
  ?>
  <section id="bespoke-enquiry" class="contact-page-section py-5 py-lg-6 reveal reveal--fade" aria-labelledby="bespoke-enquiry-heading">
    <div class="container">
      <div class="row g-5 g-xl-5 align-items-start">
        <div class="col-lg-6 reveal">
          <h2 id="bespoke-enquiry-heading" class="contact-page-heading">Let’s Design Your Bespoke Wine Space</h2>
          <p class="contact-page-lead mt-3">
            Have a space to transform? Tell us about your project and let’s explore what we can create.
          </p>
          <p class="contact-page-lead mt-3">
            Share a few details about the property, location, and what you want to build — a wine room, wine wall,
            cellar, or cigar room. Within one business day, a Cellar Studio consultant will follow up with next
            steps, completely free and with no obligation.
          </p>
          <ul class="contact-info-list list-unstyled mt-4 mb-0">
            <li class="contact-info-row">
              <span class="contact-info-icon" aria-hidden="true">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M5 4h4l2 4-2.5 2.5a12 12 0 006 6L15 14l4 2v4a1 1 0 01-1 1A17 17 0 013 5a1 1 0 011-1z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
                </svg>
              </span>
              <p class="contact-info-text mb-0">
                <a href="tel:+971509124567" class="contact-info-link">+971 50 912 4567</a>
              </p>
            </li>
            <li class="contact-info-row">
              <span class="contact-info-icon" aria-hidden="true">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M4 14v3a2 2 0 002 2h1M20 14v3a2 2 0 01-2 2h-1M6 14h-.5A2.5 2.5 0 013 11.5V10a9 9 0 0118 0v1.5A2.5 2.5 0 0118.5 14H18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </span>
              <p class="contact-info-text mb-0">
                <span class="contact-info-strong">Support hours:</span>
                Monday - Saturday, 08:00 AM - 09:00 PM
              </p>
            </li>
          </ul>
        </div>
        <div class="col-lg-6 reveal">
          <h2 class="contact-page-heading contact-page-heading--form">Start Your Project</h2>
          <form id="bespokeEnquiryForm" class="contact-page-form js-mailer-form" data-mailer="fetch" data-thank-you="<?php echo esc_url($bespokeThankYou); ?>" action="<?php echo esc_url($bespokeMailerUrl); ?>" method="post" novalidate aria-label="Bespoke project inquiry">
            <input type="hidden" name="source" value="Bespoke">
            <div class="d-flex flex-column gap-3">
              <div class="contact-form-status" role="status" aria-live="polite"></div>
              <?php
                $inquiryFieldPrefix = 'bespoke';
                include __DIR__ . '/includes/inquiry-form-fields.php';
              ?>
              <div class="pt-1">
                <button type="submit" class="btn btn-dark contact-page-submit w-100 w-sm-auto">Submit Project Inquiry</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- ABOUT & BESPOKE SECTION 7: CTA -->
  <section class="about-cta py-5 py-lg-6">
    <div class="container text-center reveal-stagger">
      <h2 class="about-cta-title reveal">Design Your Private Cellar</h2>
      <p class="about-cta-subtitle mt-3 reveal">Tailored to your space. Engineered for your collection.</p>
      <div class="mt-4 reveal">
        <a href="#bespoke-enquiry" class="btn btn-dark rounded-pill px-4 about-cta-btn">Start Your Project</a>
      </div>
    </div>
  </section>
  <img src="img/Gemini_Generated_Image_o6ul44o6ul44o6ul.png" style="width: 100%;" alt="" srcset="">