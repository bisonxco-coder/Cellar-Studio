<?php
// Thank You (Cigar Humidor) — dedicated confirmation page after the Cigar Humidor enquiry form.
// noindex is injected by the theme (see cellar_studio_noindex_thank_you_pages in functions.php).
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex, nofollow">
  <title>Thank You | Cigar Humidor | Cellar Studio</title>
  <link rel="icon" type="image/png" href="img/favicon.png">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous"
  >

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/responsive.css">
</head>
<body class="thank-you-page thank-you-page--cigar-humidors">

  <section class="thank-you-hero page-hero page-hero--video" aria-label="Thank you">
    <div class="hero-nav-layer">
      <?php include __DIR__ . '/includes/navbar.php'; ?>
    </div>

    <?php
      $heroMp4 = function_exists('cellar_studio_asset')
        ? cellar_studio_asset('video/0630.mp4')
        : 'video/0630.mp4';
    ?>
    <video class="page-hero-video" autoplay muted loop playsinline preload="metadata">
      <source src="<?php echo htmlspecialchars($heroMp4, ENT_QUOTES, 'UTF-8'); ?>" type="video/mp4">
    </video>

    <div class="thank-you-hero-overlay page-hero-overlay">
      <div class="thank-you-hero-glow" aria-hidden="true"></div>
      <div class="thank-you-hero-particles" aria-hidden="true">
        <span></span><span></span><span></span><span></span><span></span><span></span>
      </div>

      <div class="container h-100 d-flex flex-column justify-content-center align-items-center text-center">
        <div class="thank-you-hero-content reveal reveal--fade">
          <div class="thank-you-badge" aria-hidden="true">
            <span class="thank-you-badge-ring"></span>
            <span class="thank-you-badge-ring thank-you-badge-ring--delay"></span>
            <span class="thank-you-badge-icon">
              <svg class="thank-you-check" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle class="thank-you-check-circle" cx="26" cy="26" r="24" stroke="currentColor" stroke-width="2"/>
                <path class="thank-you-check-mark" d="M16 27l7 7 13-14" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </span>
          </div>

          <p class="page-hero-eyebrow thank-you-eyebrow">ENQUIRY RECEIVED</p>
          <h1 class="hero-title thank-you-title">
            Thank You for Your<br>Cigar Humidor Enquiry
          </h1>
          <p class="hero-subtitle thank-you-subtitle">
            Your request has been sent successfully. Our team will review your collection and space requirements
            and get back to you within one business day with a tailored humidor recommendation.
          </p>

          <div class="thank-you-actions mt-4 mt-lg-5 reveal-stagger">
            <a href="index.php" class="btn btn-light btn-lg hero-cta-main thank-you-btn reveal">Back to Home</a>
            <a href="cigar-humidors.php" class="btn btn-outline-light btn-lg thank-you-btn thank-you-btn--ghost reveal">Back to Cigar Humidors</a>
          </div>

          <p class="thank-you-reference mt-4 mb-0 reveal">
            Need immediate assistance?
            <a href="tel:+971509124567" class="thank-you-reference-link">Call +971 50 912 4567</a>
          </p>
        </div>
      </div>
    </div>
  </section>

  <section class="thank-you-steps py-5 py-lg-6" aria-labelledby="thank-you-steps-heading">
    <div class="container">
      <div class="text-center reveal-stagger">
        <p class="thank-you-steps-kicker reveal">WHAT HAPPENS NEXT</p>
        <h2 id="thank-you-steps-heading" class="thank-you-steps-title reveal">Your Humidor Recommendation</h2>
        <p class="thank-you-steps-lead reveal">
          From first enquiry to the right model — here is what you can expect after submitting your request.
        </p>
      </div>

      <div class="row g-4 g-lg-5 mt-2 mt-lg-4 justify-content-center reveal-stagger">
        <div class="col-12 col-md-6 col-lg-4">
          <article class="thank-you-step-card reveal">
            <span class="thank-you-step-number" aria-hidden="true">01</span>
            <div class="thank-you-step-icon" aria-hidden="true">
              <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 6h16v12H4V6zm0 0l8 6 8-6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </div>
            <h3 class="thank-you-step-title">We Review Your Enquiry</h3>
            <p class="thank-you-step-desc mb-0">
              A dedicated consultant reviews your collection size, space, and design preferences to shortlist the right humidor models.
            </p>
          </article>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
          <article class="thank-you-step-card reveal">
            <span class="thank-you-step-number" aria-hidden="true">02</span>
            <div class="thank-you-step-icon" aria-hidden="true">
              <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 4h4l2 4-2.5 2.5a12 12 0 006 6L15 14l4 2v4a1 1 0 01-1 1A17 17 0 013 5a1 1 0 011-1z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
              </svg>
            </div>
            <h3 class="thank-you-step-title">Personal Follow-Up</h3>
            <p class="thank-you-step-desc mb-0">
              Expect a call or email with model recommendations, finishes, pricing guidance, and availability tailored to your project.
            </p>
          </article>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
          <article class="thank-you-step-card reveal">
            <span class="thank-you-step-number" aria-hidden="true">03</span>
            <div class="thank-you-step-icon" aria-hidden="true">
              <svg width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
                <path d="M9 22V12h6v10" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
              </svg>
            </div>
            <h3 class="thank-you-step-title">Delivery &amp; Setup</h3>
            <p class="thank-you-step-desc mb-0">
              Where appropriate, we coordinate delivery and setup guidance so your humidor performs and presents exactly as intended.
            </p>
          </article>
        </div>
      </div>
    </div>
  </section>

  <section class="about-cta py-5 py-lg-6">
    <div class="container text-center reveal-stagger">
      <h2 class="about-cta-title reveal">Have Another Question?</h2>
      <p class="about-cta-subtitle mt-3 reveal">We are always happy to help — reach out anytime.</p>
      <div class="mt-4 reveal">
        <a href="contact.php" class="btn btn-dark rounded-pill px-4 about-cta-btn">Contact Us</a>
      </div>
    </div>
  </section>
</body>
</html>
