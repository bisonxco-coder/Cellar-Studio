<?php
$navActive = "cigar-humidors";
/**
 * Cigar Humidors — faqe statike (prototip).
 * Hero me imazh, intro tekst, seksion hotspots (i njëjtë me logjikën globale në main.js),
 * CTA dhe imazh full-width para footer-it.
 * Për WordPress: zëvendëso përmbajtjen me template parts / ACF.
 */
?>
<!DOCTYPE html>
<html lang="sq">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cigar Humidors | Cellar Studio</title>
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
  <section class="page-hero page-hero--video" aria-label="Cigar Humidors hero">
    <div class="hero-nav-layer">
      <?php include __DIR__ . '/includes/navbar.php'; ?>
    </div>

    <?php
      $heroMp4 = function_exists('cellar_studio_asset')
        ? cellar_studio_asset('video/0630.mp4')
        : 'video/0630.mp4';
    ?>
    <video class="page-hero-video" autoplay muted loop playsinline preload="metadata" poster="img/cigar-humidors_header.png">
      <source src="<?php echo htmlspecialchars($heroMp4, ENT_QUOTES, 'UTF-8'); ?>" type="video/mp4">
    </video>

    <div class="page-hero-overlay">
      <div class="container h-100 d-flex flex-column justify-content-center align-items-center text-center">
        <div class="hero-content reveal reveal--fade">
          <h1 class="hero-title">Cigar Humidors</h1>
          <p class="hero-subtitle">
            Designed for Display &amp; Performance.<br>
            Premium cigar fridges that combine humidity precision, refined materials, and elegant presentation.
          </p>
          <div class="mt-4">
            <a href="#cigar-humidors-enquiry" class="btn btn-light btn-lg hero-cta-main">Explore Models</a>
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
            The Perfect Balance<br>of Control &amp; Design
          </h2>
          <p class="section-subtitle mt-3 reveal">
            Our curated selection of cigar fridges offers advanced humidity regulation and temperature
            stability — while maintaining a refined, furniture-grade appearance.
          </p>
          <p class="section-subtitle reveal">
            Ideal for collectors who require performance without compromising interior aesthetics.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- ========= Hotspots: data-hotspot / data-hotspot-text duhet të përputhen (main.js) ========= -->
  <section class="section-what-we-do py-5 py-lg-6 reveal reveal--fade" aria-label="Features overview">
    <div class="container-fluid">
      <div class="what-we-do-card">
        <div class="what-we-do-visual">
        <img src="img/WhatsApp Image 2026-05-21 at 13.33.06.jpeg" alt="" class="what-we-do-bg" role="presentation">

        <div class="bespoke-deliver-title" aria-hidden="true">
          What We<br>Deliver
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
  
  <!-- SECTION: Products carousel (WooCommerce) -->
  
  <!-- CELLAR_WC_COLLECTIONS -->

    <!-- <div class="container-fluid">
      <div class="text-center mb-4 mb-lg-5 reveal-stagger">
        <h2 class="collections-title reveal">
          Curated Wine &amp; Cigar Collections
        </h2>
        <p class="collections-subtitle mt-3 reveal">
          Explore premium humidors, wine displays, and storage solutions, carefully selected to complement
          Cellar Studio environments.
        </p>
      </div>
    </div> -->
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

  <!-- ========= Cigar Humidor enquiry form (dedicated lead flow) ========= -->
  <?php
    $cigarHumidorThankYou = function_exists('home_url')
      ? home_url('/thank-you-cigar-humidors/')
      : 'thank-you.php';
    $cigarHumidorMailerUrl = function_exists('cellar_studio_mailer_endpoint')
      ? cellar_studio_mailer_endpoint()
      : 'mailer.php';
  ?>
  <section id="cigar-humidors-enquiry" class="contact-page-section py-5 py-lg-6 reveal reveal--fade" aria-labelledby="cigar-humidors-enquiry-heading">
    <div class="container">
      <div class="row g-5 g-xl-5 align-items-start">
        <div class="col-lg-6 reveal">
          <h2 id="cigar-humidors-enquiry-heading" class="contact-page-heading">Looking for the Right Cigar Humidor?</h2>
          <p class="contact-page-lead mt-3">
            Tell us about your space and collection — we&rsquo;ll recommend the best model for your needs.
          </p>
          <p class="contact-page-lead mt-3">
            Share a few details about your collection size, room dimensions, and design preferences. Within one
            business day, a Cellar Studio consultant will send you a tailored recommendation with model options,
            finishes, pricing guidance, and availability — completely free and with no obligation.
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
          <h2 class="contact-page-heading contact-page-heading--form">Get Your Free Recommendation</h2>
          <form id="cigarHumidorEnquiryForm" class="contact-page-form js-mailer-form" data-mailer="fetch" data-thank-you="<?php echo esc_url($cigarHumidorThankYou); ?>" action="<?php echo esc_url($cigarHumidorMailerUrl); ?>" method="post" novalidate aria-label="Cigar Humidor enquiry">
            <input type="hidden" name="source" value="Cigar Humidor">
            <div class="d-flex flex-column gap-3">
              <div class="contact-form-status" role="status" aria-live="polite"></div>
              <div>
                <label for="cigar-humidor-name" class="form-label contact-form-label">Your Name <span class="contact-required" aria-hidden="true">*</span></label>
                <div class="contact-field">
                  <span class="contact-field-icon" aria-hidden="true">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2M12 11a4 4 0 100-8 4 4 0 000 8z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                  </span>
                  <input type="text" class="form-control contact-field-input" id="cigar-humidor-name" name="name" autocomplete="name" placeholder="Your full name" required>
                </div>
              </div>

              <div>
                <label for="cigar-humidor-phone" class="form-label contact-form-label">Best Number to Reach You <span class="contact-required" aria-hidden="true">*</span></label>
                <div class="contact-field contact-field--phone">
                  <label class="visually-hidden" for="cigar-humidor-phone-prefix">Country code</label>
                  <select class="form-select contact-phone-prefix" id="cigar-humidor-phone-prefix" name="phone_prefix" aria-label="Country calling code">
                    <option value="+33">FR +33</option>
                    <option value="+971" selected>AE +971</option>
                    <option value="+41">CH +41</option>
                    <option value="+44">UK +44</option>
                  </select>
                  <input type="tel" class="form-control contact-field-input" id="cigar-humidor-phone" name="phone" autocomplete="tel" placeholder="50 123 4567" required>
                </div>
              </div>

              <div>
                <label for="cigar-humidor-email" class="form-label contact-form-label">Email Address <span class="contact-required" aria-hidden="true">*</span></label>
                <div class="contact-field">
                  <span class="contact-field-icon" aria-hidden="true">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M4 6h16v12H4V6zm0 0l8 6 8-6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </span>
                  <input type="email" class="form-control contact-field-input" id="cigar-humidor-email" name="email" autocomplete="email" placeholder="you@email.com" required>
                </div>
              </div>

              <div>
                <label for="cigar-humidor-message" class="form-label contact-form-label">Tell Us About Your Collection &amp; Space</label>
                <div class="contact-field contact-field--textarea">
                  <span class="contact-field-icon" aria-hidden="true">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M12 20h9M16.5 3.5a2.12 2.12 0 013 3L8 18l-4 1 1-4L16.5 3.5z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </span>
                  <textarea class="form-control contact-field-input contact-field-textarea" id="cigar-humidor-message" name="message" rows="4" placeholder="Collection size, room dimensions, preferred finish, timeline..."></textarea>
                </div>
              </div>

              <div class="pt-1">
                <button type="submit" class="btn btn-dark contact-page-submit w-100 w-sm-auto">Get My Free Recommendation</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- ========= CTA (klasa të përbashkëta me about.php) ========= -->
  <section class="about-cta py-5 py-lg-6" aria-labelledby="cigar-cta-heading">
    <div class="container text-center reveal-stagger">
      <h2 id="cigar-cta-heading" class="about-cta-title reveal">It’s Time to Design Your<br>Perfect Wine & Cigar Space</h2>
      <!-- <p class="about-cta-subtitle mt-3 reveal">Tailored to your space. Engineered for your collection.</p> -->
      <div class="mt-4 reveal">
        <a href="#cigar-humidors-enquiry" class="btn btn-dark rounded-pill px-4 about-cta-btn">Request a Consultation</a>
      </div>
    </div>
  </section>

  <!-- ========= Imazh dekorativ full-width para footer-it (opsionale: zëvendëso me asset të dedikuar) ========= -->
  <figure class="cigar-page-fullbleed-image mb-0">
    <img
      src="img/Gemini_Generated_Image_oqf99joqf99joqf9.png"
      alt="Interior design sketch visualization"
      class="img-fluid w-100 d-block"
      loading="lazy"
      decoding="async"
    >
  </figure>

