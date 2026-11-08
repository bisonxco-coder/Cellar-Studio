<?php
$navActive = "home";
?>
<!DOCTYPE html>
<html lang="sq">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cellar-Studio</title>
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

  <!-- Swiper CSS (slider library) -->
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
  >

  <!-- AOS (Animate On Scroll) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">

  <!-- CSS juaj -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/responsive.css">
</head>
<body>



  <section class="page-hero" aria-label="Wine racking solutions hero">
    <div class="hero-nav-layer">
      <?php include __DIR__ . '/includes/navbar.php'; ?>
    </div>

    <?php
      $heroWebm = function_exists('cellar_studio_asset')
        ? cellar_studio_asset('video/Homepage-web.webm')
        : 'video/Homepage-web.webm';
      $heroMp4 = function_exists('cellar_studio_asset')
        ? cellar_studio_asset('video/Homepage-web.mp4')
        : 'video/Homepage-web.mp4';
      $heroPoster = function_exists('cellar_studio_asset')
        ? cellar_studio_asset('img/Header.png')
        : 'img/Header.png';
    ?>
    <video class="hero-slide-bg hero-slide-video js-hero-bg-video" autoplay muted loop playsinline preload="auto" poster="<?php echo htmlspecialchars($heroPoster, ENT_QUOTES, 'UTF-8'); ?>">
      <source src="<?php echo htmlspecialchars($heroWebm, ENT_QUOTES, 'UTF-8'); ?>" type="video/webm">
      <source src="<?php echo htmlspecialchars($heroMp4, ENT_QUOTES, 'UTF-8'); ?>" type="video/mp4">
    </video>

    <div class="page-hero-overlay">
      <div class="container h-100 d-flex flex-column justify-content-center align-items-center text-center">
        <div class="hero-content reveal reveal--fade">
                  <h1 class="hero-title">
                    Bespoke Wine &amp; Cigar Spaces,<br>
                    Designed Around You
                  </h1>
                  <p class="hero-subtitle">
                    From custom wine cellars to integrated cigar rooms, Cellar Studio designs and<br>
                    delivers premium storage solutions — from concept to installation.
                  </p>
                  <div class="mt-4">
        <a href="bespoke.php#bespoke-enquiry" class="btn btn-light btn-lg hero-cta-main">
                      Start Your Project
                    </a>
                  </div>
        </div>
      </div>
    </div>
  </section>

    <!-- Thumbnails slider at the bottom -->
    <!-- <div class="hero-thumbs-container">
      <div class="container-fluid">
        <div class="swiper heroThumbs">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="hero-thumb-card">
                <img src="img/Header.png" alt="Thumbnail 1">
              </div>
            </div>
            <div class="swiper-slide">
              <div class="hero-thumb-card">
                <img src="img/Frame 2095586165.png" alt="Thumbnail 2">
              </div>
            </div>
            <div class="swiper-slide">
              <div class="hero-thumb-card">
                <img src="img/Frame 2095586164.png" alt="Thumbnail 3">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->

  <!-- LOGO STRIP: Brand icons slider -->
  <section class="section-logo-strip py-3 reveal reveal--fade">
    <div class="container">
      <div class="swiper logoSwiper">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <div class="logo-strip-item">
              <img src="img/Frame 10.png" alt="Strong, durable, and reliable">
            </div>
          </div>
          <div class="swiper-slide">
            <div class="logo-strip-item">
              <img src="img/Frame 11.png" alt="Eco-friendly materials">
            </div>
          </div>
          <div class="swiper-slide">
            <div class="logo-strip-item">
              <img src="img/Frame 12.png" alt="Fast and safe delivery">
            </div>
          </div>
          <div class="swiper-slide">
            <div class="logo-strip-item">
              <img src="img/Frame 13.png" alt="Premium quality">
            </div>
          </div>
          <!-- Optional extra logos if needed -->
          <div class="swiper-slide">
            <div class="logo-strip-item">
              <img src="img/Frame 9.png" alt="Custom logo 1">
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
            Crafting Bespoke<br>
            Wine &amp; Cigar Environments
          </h2>
          <p class="section-subtitle mt-3 reveal">
            Cellar Studio is a Swiss–French design team dedicated to creating refined wine and cigar spaces.
            We combine craftsmanship, technical precision, and architectural elegance to deliver complete
            storage solutions, from concept to installation.
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
              data-portfolio-images="img/ChatGPT Image Apr 24, 2026, 02_52_59 PM.png|img/ChatGPT Image Apr 24, 2026, 02_51_40 PM.png|img/ChatGPT Image Apr 24, 2026, 02_50_16 PM.png|img/ChatGPT Image Apr 24, 2026, 02_50_16 PM.png"
              data-portfolio-description="A bespoke cigar humidor designed as a refined interior feature, where craftsmanship and climate control work in perfect harmony. Warm timber cabinetry, clean metal detailing, and soft integrated lighting create a calm, gallery-like presentation for every box. Engineered for stable humidity and effortless organization, it preserves the collection with precision while elevating the space.">
            <div class="portfolio-card-image">
                  <img src="img/ChatGPT Image Apr 24, 2026, 02_50_16 PM.png" alt="Under-Stair Wine">
                </div>
                <div class="portfolio-card-body">
                  <h3 class="portfolio-card-title">Cigar Humidors</h3>
                  <p class="portfolio-card-location">Al Barari, Dubai, UAE</p>
                </div>
                <button class="portfolio-card-cta" type="button">+</button>
              </article>
            </div>
            <!-- Card 2 -->
            <div class="swiper-slide">
              <article class="portfolio-card"
                data-portfolio-images="img/ChatGPT Image Apr 24, 2026, 02_57_01 PM.png|img/ChatGPT Image Apr 24, 2026, 02_55_43 PM.png|img/ChatGPT Image Apr 24, 2026, 02_54_45 PM.png|img/ChatGPT Image Apr 24, 2026, 03_03_03 PM.png"
                data-portfolio-description="A private wine cellar conceived as an architectural room, balancing storage capacity with a strong, timeless atmosphere. Layered lighting, tailored rack proportions, and premium finishes create depth and guide the eye across the collection. Built for performance and longevity, it delivers consistent conditions and a perfectly ordered display for hundreds of bottles.">
                <div class="portfolio-card-image">
                  <img src="img/ChatGPT Image Apr 24, 2026, 03_03_03 PM.png" alt="Architectural Wine">
                </div>
                <div class="portfolio-card-body">
                  <h3 class="portfolio-card-title">Wine Cellar</h3>
                  <p class="portfolio-card-location">Emirates Hills, Dubai, UAE</p>
                </div>
                <button class="portfolio-card-cta" type="button">+</button>
              </article>
            </div>
            <!-- Card 3 -->
            <div class="swiper-slide">
            <article class="portfolio-card"
              data-portfolio-images="img/ChatGPT Image Apr 24, 2026, 02_47_32 PM.png|img/ChatGPT Image Apr 24, 2026, 02_45_38 PM.png|img/ChatGPT Image Apr 24, 2026, 02_44_16 PM.png|img/ChatGPT Image Apr 24, 2026, 02_44_16 PM.png"
              data-portfolio-description="A compact cigar humidor tailored for daily enjoyment, designed to feel like a piece of luxury furniture within the home. Rich wood tones, precise joinery, and discreet lighting highlight the collection without overpowering the interior. Optimized for accurate humidity and quiet operation, it keeps cigars perfectly conditioned and easy to access.">
                <div class="portfolio-card-image">
                  <img src="img/ChatGPT Image Apr 24, 2026, 02_44_16 PM.png" alt="Cigar Humidor">
                </div>
                <div class="portfolio-card-body">
                <h3 class="portfolio-card-title">Cigar Humidor</h3>
                  <p class="portfolio-card-location">Dubai Hills Estate, Dubai, UAE</p>
                </div>
                <button class="portfolio-card-cta" type="button">+</button>
              </article>
            </div>
            <!-- Card 4 -->
            <div class="swiper-slide">
              <article class="portfolio-card"
                data-portfolio-images="img/ChatGPT Image Apr 24, 2026, 02_41_52 PM.png|img/ChatGPT Image Apr 24, 2026, 02_40_44 PM.png|img/ChatGPT Image Apr 24, 2026, 02_39_24 PM.png|img/ChatGPT Image Apr 24, 2026, 02_38_12 PM.png"
                data-portfolio-description="A statement wine wall designed to elevate the entire space, where architecture and collection become one visual experience. Warm timber, refined metal frames, and layered lighting create depth and highlight every bottle like a curated gallery. Engineered for both performance and impact, it stores several hundred bottles in a bold yet perfectly ordered composition.">
                <div class="portfolio-card-image">
                  <img src="img/ChatGPT Image Apr 24, 2026, 02_41_52 PM.png" alt="Wine Wall">
                </div>
                <div class="portfolio-card-body">
                <h3 class="portfolio-card-title">Wine Wall</h3>
                  <p class="portfolio-card-location">Zurich, Switzerland</p>
                </div>
                <button class="portfolio-card-cta" type="button">+</button>
              </article>
            </div>
            
            <!-- Card 5 -->
            <div class="swiper-slide">
              <article class="portfolio-card"
                data-portfolio-images="img/ChatGPT Image Apr 24, 2026, 02_36_35 PM.png|img/ChatGPT Image Apr 24, 2026, 02_44_16 PM.png|img/ChatGPT Image Apr 24, 2026, 02_41_52 PM.png|img/ChatGPT Image Apr 24, 2026, 02_29_14 PM.png|img/ChatGPT Image Apr 24, 2026, 02_26_56 PM.png"
                data-portfolio-description="A contemporary wine wall crafted as a clean, linear feature, turning the collection into a refined focal point. Slim profiles, balanced spacing, and warm backlighting create rhythm and clarity, even with large bottle counts. Designed for stability and easy selection, it combines precise storage geometry with a high-end architectural finish.">
                <div class="portfolio-card-image">
                  <img src="img/ChatGPT Image Apr 24, 2026, 02_36_35 PM.png" alt="Wine Wall">
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
                data-portfolio-description="A wine wall integrated into the interior architecture, designed to feel seamless, calm, and exceptionally premium. Natural materials and carefully tuned lighting add warmth and depth while keeping the display visually minimal. Built to protect and showcase the collection, it offers generous capacity with a disciplined, perfectly aligned layout.">
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

            
            <!-- Card 7 -->
            <div class="swiper-slide">
              <article class="portfolio-card"
                data-portfolio-images="img/ChatGPT Image Apr 24, 2026, 02_19_08 PM.png|img/ChatGPT Image Apr 24, 2026, 02_17_49 PM.png|img/ChatGPT Image Apr 24, 2026, 02_09_57 PM.png|img/ChatGPT Image Apr 24, 2026, 02_09_57 PM.png|img/ChatGPT Image Apr 24, 2026, 02_09_57 PM.png"
                data-portfolio-description="A modern cigar humidor created for collectors, combining a clean architectural presence with meticulous environmental control. Soft illumination, refined materials, and precise internal organization present each cigar with the care of a curated display. Engineered for reliable humidity and long-term preservation, it delivers performance without compromising on elegance.">
                <div class="portfolio-card-image">
                  <img src="img/ChatGPT Image Apr 24, 2026, 02_19_08 PM.png" alt="Contemporary Cellar">
                </div>
                <div class="portfolio-card-body">
                <h3 class="portfolio-card-title">Cigar Humidor</h3>
                  <p class="portfolio-card-location">Zurich, Switzerland</p>
                </div>
                <button class="portfolio-card-cta" type="button">+</button>
              </article>
            </div>
          </div>
        </div>
      </div>

      <!-- Cigar slider EN TABIN TJETER KJO DEAKTIVE PER MOMENTIN-->
      <!-- <div class="portfolio-slider-wrapper mt-5 d-none" data-portfolio="cigar">
        <div class="swiper portfolioSwiper">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <article class="portfolio-card" data-portfolio-images="img/image 34.png|img/image 34.png|img/image 34.png|img/image 34.png">
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
            <div class="swiper-slide">
            <article class="portfolio-card" data-portfolio-images="img/ChatGPT Image Apr 24, 2026, 02_57_01 PM.png|img/ChatGPT Image Apr 24, 2026, 02_55_43 PM.png|img/ChatGPT Image Apr 24, 2026, 02_54_45  PM.png|img/ChatGPT Image Apr 24, 2026, 03_03_03 PM.png">
            <div class="portfolio-card-image">
                  <img src="img/Projects.png" alt="Under-Stair Wine">
                </div>
                <div class="portfolio-card-body">
                  <h3 class="portfolio-card-title">Under-Stair Wine</h3>
                  <p class="portfolio-card-location">Al Barari, Dubai, UAE</p>
                </div>
                <button class="portfolio-card-cta" type="button">+</button>
              </article>
            </div>
            <div class="swiper-slide">
              <article class="portfolio-card" data-portfolio-images="img/ChatGPT Image Apr 24, 2026, 02_57_01 PM.png|img/ChatGPT Image Apr 24, 2026, 02_55_43 PM.png|img/ChatGPT Image Apr 24, 2026, 02_54_45  PM.png|img/ChatGPT Image Apr 24, 2026, 03_03_03 PM.png">
                <div class="portfolio-card-image">
                  <img src="img/ChatGPT Image Apr 24, 2026, 03_03_03 PM.png" alt="Architectural Wine">
                </div>
                <div class="portfolio-card-body">
                  <h3 class="portfolio-card-title">Architectural Wine</h3>
                  <p class="portfolio-card-location">Emirates Hills, Dubai, UAE</p>
                </div>
                <button class="portfolio-card-cta" type="button">+</button>
              </article>
            </div>
            <div class="swiper-slide"> 
              <article class="portfolio-card" data-portfolio-images="img/image 34.png|img/image 34.png|img/image 34.png|img/image 34.png">
                <div class="portfolio-card-image">
                  <img src="img/image 34.png" alt="Private Dining">
                </div>
                <div class="portfolio-card-body">
                  <h3 class="portfolio-card-title">Private Dining</h3>
                  <p class="portfolio-card-location">Dubai Hills Estate, Dubai, UAE</p>
                </div>
                <button class="portfolio-card-cta" type="button">+</button>
              </article>
            </div>
          </div>
        </div>
      </div> -->
    </div>
  </section>

  <!-- SECTION 2: Our Solutions (static grid) -->
  <section class="section-solutions py-5 py-lg-6 reveal reveal--fade">
    <div class="container-fluid">
      <div class="solutions-header text-center mb-4 mb-lg-5 reveal-stagger">
        <h2 class="solutions-title reveal">Our Solutions</h2>
      </div>

      <div class="row g-4 solutions-grid reveal-stagger">
        <div class="col-12 col-md-6 col-lg-3">
          <article class="solution-card reveal">
            <img src="img/Services.png" alt="Bespoke">
            <div class="solution-card-label">Bespokes</div>
            <div class="solution-card-overlay">
              <p class="solution-card-text">
              We go beyond wine cabinets. Cellar Studio designs and delivers bespoke
wine and cigar storage solutions — from custom wine cellars and wine walls
to premium cigar humidors and cigar rooms.<br><br>
Each project is tailored to your space, collection, and lifestyle. From
concept design and 3D rendering to full fit-out and installation, we create
high-end storage environments that integrate seamlessly into your interior
architecture.</p>
              <a href="bespoke.php" class="solution-card-btn">View more <span aria-hidden="true">→</span></a>
            </div>
          </article>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
          <article class="solution-card reveal">
            <img src="img/Services 2.png" alt="Cigar Humidors">
            <div class="solution-card-label">Cigar Humidors</div>
            <div class="solution-card-overlay">
              <p class="solution-card-text">
              In partnership with Raching, we offer a wide range of freestanding cigar
humidors available in various sizes, materials, and capacities — combining
performance, durability, and refined design.<br><br>
Each solution ensures precise humidity control, optimal preservation
conditions, and a seamless integration into your interior.              </p>
              <a href="cigar-humidors.php" class="solution-card-btn">View more <span aria-hidden="true">→</span></a>
            </div>
          </article>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
          <article class="solution-card reveal">
            <img src="img/Services 3.png" alt="Wine Fridge">
            <div class="solution-card-label">Wine Fridge</div>
            <div class="solution-card-overlay">
              <p class="solution-card-text">
              From freestanding wine fridges to fully integrated solutions, Cellar Studio
offers premium wine refrigeration tailored to your space.<br><br>
In partnership with Swisscave, we provide a complete range of
high-performance units designed for seamless integration, precise
temperature control, and elegant presentation.             </p>
 <a href="wine-fridge.php" class="solution-card-btn">View more <span aria-hidden="true">→</span></a>
            </div>
          </article>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
          <article class="solution-card reveal">
            <img src="img/Services 4.png" alt="Rackings Solutions">
            <div class="solution-card-label">Rackings Solutions</div>
            <div class="solution-card-overlay">
              <p class="solution-card-text">
              From fully bespoke wine racking to ready-made solutions,
Cellar Studio offers flexible storage systems tailored to
each project.<br><br>
Our range includes a wide selection of materials, finishes,
and presentation styles — designed to optimize capacity,
enhance visibility, and integrate seamlessly into your
interior.             </p>
 <a href="wine-racking-solutions.php" class="solution-card-btn">View more <span aria-hidden="true">→</span></a>
            </div>
          </article>
        </div>
      </div>
    </div>
  </section>

  <!-- SECTION 3: What We Do – hotspot image + stats -->
  <section class="section-what-we-do py-5 py-lg-6 reveal reveal--fade">
    <div class="container-fluid">
      <div class="what-we-do-card">
        <div class="what-we-do-visual">
        <img src="img/Photo.png" alt="What we do" class="what-we-do-bg">

        <!-- Hotspot detail bubble -->
        <div class="what-we-do-detail">
          <h3 class="wwd-title">What We Do</h3>

          <!-- Text for hotspot 1: Cellars -->
          <div class="wwd-panel wwd-text-active" data-hotspot-text="cellars">
            <!-- <p class="wwd-subtitle">Chillers</p> -->
            <p class="wwd-body">
            Bespoke or ready made racking systems
            </p>
          </div>

          <!-- Text for hotspot 2: Cigar -->
          <div class="wwd-panel d-none" data-hotspot-text="cigar">
            <!-- <p class="wwd-subtitle">Bespoke</p> -->
            <p class="wwd-body">
            Integrated SwissCave wine fridge
            </p>
          </div>

          <!-- Text for hotspot 3: Design process -->
          <div class="wwd-panel d-none" data-hotspot-text="design">
            <!-- <p class="wwd-subtitle">Racking</p> -->
            <p class="wwd-body">
            Monoblock or Split chiller system for long conservation
            </p>
          </div>
        </div>

        <!-- Hotspots -->
        <button type="button"
                class="wwd-hotspot wwd-hotspot-active"
                data-hotspot="cellars"
                style="top: 40%; left: 32%;">
          <span></span>
        </button>
        <button type="button"
                class="wwd-hotspot"
                data-hotspot="cigar"
                style="top: 65%; left: 50%;">
          <span></span>
        </button>
        <button type="button"
                class="wwd-hotspot"
                data-hotspot="design"
                style="top: 13%; left: 90%;">
          <span></span>
        </button>
        </div>

        <!-- Bottom stats cards -->
        <div class="wwd-stats">
          <article class="wwd-stat-card">
            <p class="wwd-stat-label mb-1">Completed Projects</p>
            <p class="wwd-stat-value">20+</p>
          </article>
          <article class="wwd-stat-card">
            <p class="wwd-stat-label mb-1">Countries Served</p>
            <p class="wwd-stat-value">2+</p>
          </article>
        </div>
      </div>
    </div>
  </section>

  
  <!-- SECTION 6: Our Partners -->
  <section class="section-partners py-4 py-lg-5 reveal reveal--fade">
    <div class="container-fluid text-center">
      <h2 class="partners-title mb-4 mb-lg-5 reveal">Our Partners</h2>
      <div class="row justify-content-center g-3 g-lg-4 partners-row reveal-stagger">
        <div class="col-10 col-sm-6 col-md-4 col-lg-3">
          <div class="partner-card reveal">
            <img src="img/images 1.png" alt="Raching">
          </div>
        </div>
        <div class="col-10 col-sm-6 col-md-4 col-lg-3">
          <div class="partner-card reveal">
            <img src="img/swisscave_logo_2021-invert 1.png" alt="Swisscave">
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- SECTION: Curated Wine & Cigar Collections (Cards) -->
  <!-- CELLAR_HOME_COLLECTION_CARDS -->

  <section class="section-news py-5 py-lg-6 reveal reveal--fade">
    <div class="container-fluid">
      <div class="text-center mb-4 mb-lg-5 reveal">
        <h2 class="news-title">Inspiration &amp; Expertise For<br>Wine &amp; Cigar Spaces</h2>
      </div>

      <!-- CELLAR_WP_BLOG_LATEST_4 -->

      <div class="text-center mt-4 mt-lg-5 reveal">
        <a href="blog.php" class="btn btn-outline-dark rounded-pill px-4 news-more-btn">
          View more
        </a>
      </div>
    </div>
  </section>

  <section class="about-cta py-5 py-lg-6">
    <div class="container text-center reveal-stagger">
      <h2 class="about-cta-title reveal">Let’s Design Your Bespoke Wine Space</h2>
      <p class="about-cta-subtitle mt-3 reveal">Have a space to transform? Tell us about your project.</p>
      <div class="mt-4 reveal">
        <a href="bespoke.php#bespoke-enquiry" class="btn btn-dark rounded-pill px-4 about-cta-btn">Start Your Project</a>
      </div>
    </div>
  </section>


