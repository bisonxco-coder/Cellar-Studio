<?php
$legalEyebrow = $legalEyebrow ?? 'LEGAL';
$legalTitle = $legalTitle ?? 'Legal';
$legalSubtitle = $legalSubtitle ?? '';
$legalBody = $legalBody ?? '';
$legalCtaHref = function_exists('home_url')
	? home_url('/bespoke/#bespoke-enquiry')
	: 'bespoke.php#bespoke-enquiry';
?>
  <section class="page-hero page-hero--video page-hero--legal" aria-label="<?php echo htmlspecialchars($legalTitle, ENT_QUOTES, 'UTF-8'); ?>">
    <div class="hero-nav-layer">
      <?php include __DIR__ . '/navbar.php'; ?>
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
          <p class="page-hero-eyebrow"><?php echo htmlspecialchars($legalEyebrow, ENT_QUOTES, 'UTF-8'); ?></p>
          <h1 class="hero-title"><?php echo htmlspecialchars($legalTitle, ENT_QUOTES, 'UTF-8'); ?></h1>
          <?php if ($legalSubtitle !== '') : ?>
            <p class="hero-subtitle"><?php echo htmlspecialchars($legalSubtitle, ENT_QUOTES, 'UTF-8'); ?></p>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>

  <section class="legal-page" aria-labelledby="legal-page-title">
    <div class="container">
      <div class="legal-page-inner">
        <p class="legal-page-eyebrow">Cellar Studio</p>
        <h2 id="legal-page-title" class="legal-page-title"><?php echo htmlspecialchars($legalTitle, ENT_QUOTES, 'UTF-8'); ?></h2>
        <div class="legal-page-body">
          <?php echo $legalBody; ?>
        </div>
      </div>
    </div>
  </section>

  <section class="about-cta py-5 py-lg-6">
    <div class="container text-center reveal-stagger">
      <h2 class="about-cta-title reveal">Design Your Private Cellar</h2>
      <p class="about-cta-subtitle mt-3 reveal">Tailored to your space. Engineered for your collection.</p>
      <div class="mt-4 reveal">
        <a href="<?php echo htmlspecialchars($legalCtaHref, ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-dark rounded-pill px-4 about-cta-btn">Start Your Project</a>
      </div>
    </div>
  </section>
