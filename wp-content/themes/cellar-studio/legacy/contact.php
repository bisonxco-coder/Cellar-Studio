<?php
// Contact — hero, forma kontaktit (2 kolona), FAQ accordion, pastaj CTA.
$navActive = "contact";
?>
<!DOCTYPE html>
<html lang="sq">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Contact | Cellar Studio</title>
  <link rel="icon" type="image/png" href="img/favicon.png">

  <!-- Inter (body) -->
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

  <!-- Swiper (përdoret nga footer.js / faqet e tjera) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

  <!-- AOS (Animate On Scroll) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/responsive.css">
</head>
<body>

  <!-- Hero: video + navbar (i njëjtë stil si about) -->
  <section class="page-hero page-hero--video" aria-label="Contact hero">
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
    <video class="page-hero-video js-hero-bg-video" autoplay muted loop playsinline preload="auto" poster="<?php echo htmlspecialchars($heroPoster, ENT_QUOTES, 'UTF-8'); ?>">
      <source src="<?php echo htmlspecialchars($heroWebm, ENT_QUOTES, 'UTF-8'); ?>" type="video/webm">
      <source src="<?php echo htmlspecialchars($heroMp4, ENT_QUOTES, 'UTF-8'); ?>" type="video/mp4">
    </video>

    <div class="page-hero-overlay">
      <div class="container h-100 d-flex flex-column justify-content-center align-items-center text-center">
        <div class="hero-content reveal reveal--fade">
          <p class="page-hero-eyebrow">CONTACT US</p>
          <h1 class="hero-title">
            Start Your Project with<br>Cellar Studio
          </h1>
          <p class="hero-subtitle">
            Tell us about your space, timeline, and how you live with wine and cigars.<br>
            We will respond with next steps — from an introductory call to an on-site visit<br>
            or a tailored proposal for your residential or commercial project.
          </p>
          <div class="mt-4">
            <a href="#contact-form" class="btn btn-light btn-lg hero-cta-main">
            Start Your Project
          </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Seksioni 2: info + hartë | forma “Request a Consultation” (si design) -->
  <section id="contact-form" class="contact-page-section py-5 py-lg-6 reveal reveal--fade">
    <div class="container">
      <div class="row g-5 g-xl-5 align-items-start">
        <!-- Majtas: titull, përshkrim, ikona + detaje, hartë -->
        <div class="col-lg-6 reveal">
          <h2 class="contact-page-heading">Let’s Design Your Bespoke Wine Space</h2>
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
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M4 14v3a2 2 0 002 2h1M20 14v3a2 2 0 01-2 2h-1M6 14h-.5A2.5 2.5 0 013 11.5V10a9 9 0 0118 0v1.5A2.5 2.5 0 0118.5 14H18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </span>
              <p class="contact-info-text mb-0">
                <span class="contact-info-strong">Support hours:</span>
                Monday - Saturday, 08:00 AM - 09:00 PM
              </p>
            </li>
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
                  <path d="M4 6h16v12H4V6zm0 0l8 6 8-6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </span>
              <p class="contact-info-text mb-0">
              <a href="mailto:sacha@cellar-studio.com" class="contact-info-link">sacha@cellar-studio.com</a>
              </p>
            </li>
            <li class="contact-info-row">
              <span class="contact-info-icon" aria-hidden="true">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M12 21s7-4.35 7-10a7 7 0 10-14 0c0 5.65 7 10 7 10z" stroke="currentColor" stroke-width="1.5"/>
                  <circle cx="12" cy="11" r="2.5" stroke="currentColor" stroke-width="1.5"/>
                </svg>
              </span>
              <p class="contact-info-text mb-0">
              Swiss Tower<br>
              Cluster Y, Jumeirah Lakes Towers
              </p>
            </li>
          </ul>

          <div class="contact-page-map mt-4 mt-lg-5">
            <iframe
              title="Cellar Studio location — Swiss Tower, JLT"
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4291.274307482536!2d55.15068542603294!3d25.077996727787905!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f6ca6c3a55555%3A0x783197e24b5536e7!2sSwiss%20Tower!5e1!3m2!1sen!2s!4v1786441404330!5m2!1sen!2s"
              width="600"
              height="320"
              style="border:0;"
              allowfullscreen=""
              loading="lazy"
              referrerpolicy="strict-origin-when-cross-origin"
            ></iframe>
          </div>
        </div>

        <!-- Djathtas: forma -->
        <div class="col-lg-6 reveal">
          <h2 class="contact-page-heading contact-page-heading--form">Start Your Project</h2>
          <?php
            $contactThankYou = function_exists('home_url')
              ? home_url('/thank-you/')
              : 'thank-you.php';
            $contactMailerUrl = function_exists('cellar_studio_mailer_endpoint')
              ? cellar_studio_mailer_endpoint()
              : 'mailer.php';
          ?>
          <form id="contactForm" class="contact-page-form js-mailer-form" data-mailer="fetch" data-thank-you="<?php echo esc_url($contactThankYou); ?>" action="<?php echo esc_url($contactMailerUrl); ?>" method="post" novalidate aria-label="Bespoke project inquiry">
            <input type="hidden" name="source" value="Bespoke Inquiry">
            <div class="d-flex flex-column gap-3">
              <div class="contact-form-status" role="status" aria-live="polite"></div>
              <?php
                $inquiryFieldPrefix = 'contact';
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
                  <a href="#contact-form" class="d-inline-block mt-2">Start your project inquiry</a>.
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
        <a href="#contact-form" class="btn btn-dark rounded-pill px-4 about-cta-btn">Start Your Project</a>
      </div>
    </div>
  </section>
  <img src="img/modern-house-interior-design-project-sketch-3d-rendering 1.png" style="width: 100%;" alt="" srcset="">
