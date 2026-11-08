<?php
$navActive = "about";
?>
<!DOCTYPE html>
<html lang="sq">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>About Us | Cellar Studio</title>
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

  <!-- ABOUT HERO (static, video background) -->
  <section class="page-hero page-hero--video">
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
          <p class="page-hero-eyebrow">ABOUT US</p>
          <h1 class="hero-title">
            Crafting Spaces For<br>Wine
            &amp; Cigar Connoisseurs
          </h1>
          <p class="hero-subtitle">
            Cellar Studio designs, integrates, and delivers bespoke wine and cigar<br>
            environments — from refined residential installations to fully tailored<br>
            commercial concepts.
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

  <!-- ABOUT SECTION 2: Who We Are -->
  <section class="about-who py-5 py-lg-6">
    <div class="container-fluid">
      <!-- top subtle divider line like screenshot -->
      <div class="about-who-topline">
        <span class="about-pill">About us</span>
        <span class="about-dot"></span>
        <span class="about-line"></span>
        <span class="about-dot"></span>
      </div>

      <div class="row align-items-center g-4 g-lg-5 mt-3">
        <!-- Left content -->
        <div class="col-12 col-lg-6">
          <div class="about-who-left reveal reveal--up-lg">
            <h2 class="about-who-title">Who We Are</h2>
            <p class="about-who-desc mt-3">
            Cellar Studio is a Swiss–French design team dedicated to creating refined wine and cigar spaces. We combine craftsmanship, technical precision, and architectural elegance to deliver complete solutions — from concept to installation.
            </p>

            <div class="about-feature-list mt-4 reveal-stagger">
              <div class="about-feature reveal">
                <div class="about-feature-icon">
                  <!-- placeholder: replace with your exported icon -->
                  <img src="img/Program 1 Icon Container.svg" alt="Design & Concept">
                </div>
                <div class="about-feature-text">
                  <h3>Design &amp; Concept</h3>
                  <p>
                    Every project begins with vision. We develop tailored concepts that integrate
                    seamlessly into your interior architecture.
                  </p>
                </div>
              </div>

              <div class="about-feature reveal">
                <div class="about-feature-icon">
                  <img src="img/Program 1 Icon Container (1).svg" alt="Technical Precision">
                </div>
                <div class="about-feature-text">
                  <h3>Technical Precision</h3>
                  <p>
                    Climate control, humidity balance, material selection — every detail is engineered
                    for perfect preservation and long-term performance.
                  </p>
                </div>
              </div>

              <div class="about-feature reveal">
                <div class="about-feature-icon">
                  <img src="img/Program 1 Icon Container (2).svg" alt="Turnkey Execution">
                </div>
                <div class="about-feature-text">
                  <h3>Turnkey Execution</h3>
                  <p>
                    From planning to final installation, we deliver complete, fully integrated wine and
                    cigar environments with uncompromising quality.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Right image card -->
        <div class="col-12 col-lg-6">
          <div class="about-who-card reveal reveal--fade">
            <!-- placeholder: replace with your exported photo -->
            <img class="about-who-card-bg" src="img/Impact Card.png" alt="About visual">

            <div class="about-who-card-overlay">
              <span class="about-who-badge">CELLAR STUDIO</span>
              <div class="about-who-card-copy">
                <h3>DESIGNED TO PRESERVE.<br>CRAFTED TO IMPRESS.</h3>
                <p>Swiss &amp; French Craftsmanship</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- ABOUT SECTION 3: From Concept To Craft -->
  <section class="about-concept py-5 py-lg-6">
    <div class="container-fluid">
      <div class="about-concept-header text-center reveal-stagger">
        <h2 class="about-concept-title reveal">From Concept To<br>Craft</h2>
        <p class="about-concept-subtitle mt-3 reveal">
          Every cellar begins with understanding the collection — its size,<br>
          character, and architectural context.
        </p>
        <p class="about-concept-subtitle-2 mt-3 reveal">
          We develop a refined concept through sketches, proportions, and<br>
          material studies, ensuring the final piece feels integrated, not<br>
          added.
        </p>
        <p class="about-concept-tag mt-4 reveal">Design. Material. Precision.</p>
      </div>

      <div class="about-concept-grid mt-4 mt-lg-5">
        <!-- Left sketch (placeholder) -->
        <div class="about-concept-left reveal reveal--fade">
          <img src="img/Gemini_Generated_Image_v6ir38v6ir38v6ir.png" alt="Concept sketch left">
        </div>

        <!-- Center sketch (placeholder) -->
        <div class="about-concept-center reveal reveal--fade">
          <img src="img/Gemini_Generated_Image_v6ir38v6ir38v6ir (1).png" alt="Concept sketch center">
        </div>

        <!-- Right photo (placeholder) -->
        <div class="about-concept-right reveal reveal--fade">
          <img src="img/Gemini_Generated_Image_prqvspprqvspprqv.png" alt="Craft photo right">
        </div>
      </div>
    </div>
  </section>

  <!-- ABOUT SECTION 4: Our Team -->
  <section class="about-team py-5 py-lg-6">
    <div class="container-fluid">
      <div class="row align-items-center g-4 g-lg-5">
        <!-- Left copy -->
        <div class="col-12 col-lg-5">
          <div class="about-team-copy reveal reveal--up-lg">
            <p class="about-team-eyebrow mb-2">Our Team</p>
            <h2 class="about-team-title">
              Meet The Visionary<br>
              Team Behind Cellar<br>
              Studio
            </h2>
            <p class="about-team-desc mt-3">
              Cellar Studio is a Swiss–French design studio specializing in bespoke
              wine cellar and cigar rooms.
            </p>
            <p class="about-team-desc mt-3">
              We design and build refined environments where craftsmanship,
              precision, and atmosphere define the experience.
            </p>
          </div>
        </div>

        <!-- Right cards -->
        <div class="col-12 col-lg-7">
          <div class="about-team-cards reveal-stagger">
            <article class="team-card reveal">
              <!-- placeholder: replace with your exported photo -->
              <img class="team-card-img" src="img/Photo (1).png" alt="Co-Founder">
              <div class="team-card-overlay">
                <p class="team-card-role mb-1">Co-Founder</p>
                <h3 class="team-card-name mb-0">Sacha Christe</h3>
              </div>
            </article>

            <article class="team-card reveal">
              <!-- placeholder: replace with your exported photo -->
              <img class="team-card-img" src="img/Photo (2).png" alt="Co-Founder">
              <div class="team-card-overlay">
                <p class="team-card-role mb-1">Co-Founder</p>
                <h3 class="team-card-name mb-0">Florian Grolleau</h3>
              </div>
            </article>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- ABOUT SECTION 6: Our Involvement -->
  <section class="about-involvement  py-lg-6">
    <div class="container-fluid px-0">
      <div class="about-involvement-card reveal reveal--fade">
        <!-- placeholder background image -->
        <img class="about-involvement-bg" src="img/Header (1).png" alt="Our Involvement">

        <div class="about-involvement-overlay">
          <div class="row g-4 g-lg-5 align-items-start">
            <!-- Left copy -->
            <div class="col-12 col-lg-6">
              <div class="about-involvement-copy reveal-stagger">
                <h2 class="about-involvement-title reveal">Our<br>Involvement</h2>
                <p class="about-involvement-text mt-3 reveal">
                  Cellar Studio led the project from initial concept to final installation.
                  Our scope included spatial design, technical planning, material selection,
                  climate-control integration, and full on-site execution.
                </p>
                <p class="about-involvement-text mt-3 reveal">
                  We collaborated closely with the client and interior team to ensure the wine wall became a
                  seamless architectural feature — not an afterthought.
                </p>
                <div class="mt-4 reveal">
                  <a href="bespoke.php#bespoke-enquiry" class="btn btn-light rounded-pill about-involvement-cta">
                    Request a Consultation <span class="ms-2">→</span>
                  </a>
                </div>
              </div>
            </div>

            <!-- Right stacked glass cards -->
            <div class="col-12 col-lg-3 col-md-3 offset-lg-3 offset-md-3">
              <div class="about-involvement-stack reveal-stagger">
                <div class="about-involvement-glass reveal">
                  <div class="about-involvement-icon">
                    <img src="img/image 2082 [Vectorized].svg" alt="Architectural Integration">
                  </div>
                  <h3 class="about-involvement-glass-title">Architectural Integration</h3>
                  <p class="about-involvement-glass-desc">
                    The installation was designed as part of the room’s identity, aligning proportions,
                    symmetry, and materials with the overall interior concept.
                  </p>
                </div>

                <div class="about-involvement-glass reveal">
                  <div class="about-involvement-icon">
                    <img src="img/image 2083 [Vectorized].svg" alt="Technical Precision">
                  </div>
                  <h3 class="about-involvement-glass-title">Technical Precision</h3>
                  <p class="about-involvement-glass-desc">
                    We integrated climate-controlled storage with concealed systems, ensuring optimal
                    temperature and humidity without compromising aesthetics.
                  </p>
                </div>

                <div class="about-involvement-glass reveal">
                  <div class="about-involvement-icon">
                    <img src="img/image 2084 [Vectorized].svg" alt="Lighting Design">
                  </div>
                  <h3 class="about-involvement-glass-title">Lighting Design</h3>
                  <p class="about-involvement-glass-desc">
                    Layered warm illumination was carefully calibrated to enhance depth, highlight labels,
                    and create a gallery-like atmosphere.
                  </p>
                </div>

                <div class="about-involvement-glass reveal">
                  <div class="about-involvement-icon">
                    <img src="img/image 2085 [Vectorized].svg" alt="Craftsmanship & Detailing">
                  </div>
                  <h3 class="about-involvement-glass-title">Craftsmanship &amp; Detailing</h3>
                  <p class="about-involvement-glass-desc">
                    Every joint, shelf alignment, and finish was executed with precision — delivering a
                    refined, long-lasting installation.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

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
  <img src="img/modern-house-interior-design-project-sketch-3d-rendering 1.png" style="width: 100%;" alt="" srcset="">

