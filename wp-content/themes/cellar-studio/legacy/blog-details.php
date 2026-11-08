<?php
/**
 * Blog post detail — hero 50vh, artikull, sidebar, carousel "Recommended blogs".
 * $navActive: navbar — "Blog" aktiv.
 */
$navActive = "blog";
$cellarShareUrl = function_exists('get_permalink') ? (string) get_permalink() : '';
$cellarShareTitle = function_exists('get_the_title') ? (string) get_the_title() : 'Cellar Studio';
$cellarShareEnc = rawurlencode($cellarShareUrl);
$cellarShareTitleEnc = rawurlencode($cellarShareTitle);
?>
<!DOCTYPE html>
<html lang="sq">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Designing a Wine Cellar That Fits Your Home | Cellar Studio</title>
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

  <!-- AOS (Animate On Scroll) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/responsive.css">
</head>
<body class="blog-detail-page">

  <!-- Hero: foto full-width, lartësi fikse 50vh + titull (një H1 për faqen) -->
  <header class="blog-detail-hero" aria-label="Article hero">
    <div class="hero-nav-layer">
      <?php include __DIR__ . '/includes/navbar.php'; ?>
    </div>

    <img
      class="blog-detail-hero-bg"
      src="img/Projects.png"
      alt=""
      decoding="async"
      fetchpriority="high"
    >

    <div class="blog-detail-hero-inner">
      <div class="container">
        <h1 class="blog-detail-hero-title reveal reveal--fade">
          Designing a Wine Cellar That Fits Your Home
        </h1>
      </div>
    </div>
  </header>

  <main class="blog-detail-main py-5 py-lg-6">
    <div class="container">
      <div class="row g-5 g-xl-5 align-items-start">
        <!-- Kolona kryesore: meta + body (dummy) -->
        <article class="col-lg-8 blog-detail-article reveal reveal--fade">
          <p class="news-meta mb-3">18 Nov 2026 &nbsp; | &nbsp; 8 mins read</p>

          <div class="blog-article-body">
            <p>
              Every home tells a story — and a thoughtfully designed wine cellar can become one of its
              most memorable chapters. Whether you are working with a compact alcove or a generous
              basement, the goal remains the same: create a space that protects your collection while
              feeling intentional, calm, and beautifully integrated with the architecture around it.
            </p>
            <p>
              Dummy text: we begin by understanding how you live day to day. Circulation, sight lines,
              and proximity to dining or entertaining areas all influence how often the cellar is enjoyed
              — not only how it stores bottles. From there, we align racking density, access patterns,
              and lighting layers so the room feels practical as well as refined.
            </p>

            <figure class="blog-article-figure">
              <img
                src="img/Screenshot 2025-11-30 at 13.24.03 1.png"
                alt="Modern wine racking under a staircase beside a window"
                class="blog-article-inline-img"
                loading="lazy"
              >
            </figure>

            <p>
              Dummy text: materiality plays a quiet but decisive role. Wood tones, metal details, and
              glass fronts each change how light behaves and how the cellar reads from adjacent rooms.
              We prefer solutions that age gracefully — surfaces that tolerate humidity cycles, hardware
              that remains precise, and finishes that support a cohesive interior language.
            </p>
            <p>
              If you are early in planning, start with capacity targets and service expectations rather
              than shelf style. Once those fundamentals are clear, the visual direction becomes easier to
              lock — and the result is more likely to remain satisfying years after installation.
            </p>
          </div>
        </article>

        <!-- Sidebar: hot topics, tags, social -->
        <aside class="col-lg-4 blog-detail-sidebar reveal reveal--fade" aria-label="Blog sidebar">
          <div class="blog-sidebar-widget">
            <h2 class="blog-sidebar-heading">Hot topics</h2>
            <ul class="list-unstyled mb-0">
              <!-- CELLAR_WP_BLOG_HOT_TOPICS -->
            </ul>
          </div>

          <div class="blog-sidebar-widget">
            <h2 class="blog-sidebar-heading">Popular tags</h2>
            <div class="blog-tags">
              <a href="#" class="blog-tag-pill">Wine Cellar Design</a>
              <a href="#" class="blog-tag-pill">Wine Rack</a>
              <a href="#" class="blog-tag-pill">Contemporary</a>
              <a href="#" class="blog-tag-pill">Wooden</a>
              <a href="#" class="blog-tag-pill">Tasting Room</a>
              <a href="#" class="blog-tag-pill">Organized</a>
              <a href="#" class="blog-tag-pill">Stylish</a>
              <a href="#" class="blog-tag-pill">Storage Area</a>
              <a href="#" class="blog-tag-pill">Seating Area</a>
              <a href="#" class="blog-tag-pill">Wine Table</a>
            </div>
          </div>

          <div class="blog-sidebar-widget mb-0">
            <h2 class="blog-sidebar-heading">Social media</h2>
            <ul class="blog-social list-unstyled mb-0">
              <li>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_attr($cellarShareEnc); ?>" class="blog-social-link" aria-label="Share on Facebook" target="_blank" rel="noopener">
                  <svg width="18" height="18" viewBox="0 0 24 24" aria-hidden="true" fill="#1877F2">
                    <path d="M13.5 22v-8.2h2.7l.5-3.2H13.5V8.6c0-.9.3-1.5 1.6-1.5h1.7V4.1c-.8-.1-1.8-.2-2.7-.2-2.7 0-4.5 1.6-4.5 4.6v2.1H7v3.2h2.6V22h3.9z"/>
                  </svg>
                </a>
              </li>
              <li>
                <a href="https://www.instagram.com/cellarstudiouae/" class="blog-social-link" aria-label="Instagram" target="_blank" rel="noopener">
                  <svg width="18" height="18" viewBox="0 0 24 24" aria-hidden="true">
                    <defs>
                      <linearGradient id="blogDetailIg" x1="0%" y1="100%" x2="100%" y2="0%">
                        <stop offset="0%" style="stop-color:#f58529"/>
                        <stop offset="50%" style="stop-color:#dd2a7b"/>
                        <stop offset="100%" style="stop-color:#515bd4"/>
                      </linearGradient>
                    </defs>
                    <rect x="3" y="3" width="18" height="18" rx="5" fill="url(#blogDetailIg)"/>
                    <circle cx="12" cy="12" r="3.5" fill="none" stroke="#ffffff" stroke-width="1.3"/>
                    <circle cx="17" cy="7" r="1.1" fill="#ffffff"/>
                  </svg>
                </a>
              </li>
              <li>
                <a href="https://t.me/share/url?url=<?php echo esc_attr($cellarShareEnc); ?>&amp;text=<?php echo esc_attr($cellarShareTitleEnc); ?>" class="blog-social-link" aria-label="Share on Telegram" target="_blank" rel="noopener">
                  <svg width="18" height="18" viewBox="0 0 24 24" aria-hidden="true" fill="#2AABEE">
                    <path d="M21.5 4.5L2.6 11.1c-1 .4-1 1-.2 1.3l4.7 1.5 1.8 5.5c.2.6.4.7.8.4l2.5-2.3 5.2 3.8c.6.3 1 .1 1.1-.6l3.4-16.1c.2-.8-.3-1.2-.8-.9zM17.9 7.3l-10.2 9.4c-.4.4-.1 1 .5 1.1l2.8.9.5-3.2 6.5-6.1c.3-.3 0-.5-.5-.3l-8.4 5.3-.1-4.4c0-.6.6-.9 1-.6l11.4-4.1z"/>
                  </svg>
                </a>
              </li>
              <li>
                <a href="https://twitter.com/intent/tweet?url=<?php echo esc_attr($cellarShareEnc); ?>&amp;text=<?php echo esc_attr($cellarShareTitleEnc); ?>" class="blog-social-link" aria-label="Share on X" target="_blank" rel="noopener">
                  <svg width="16" height="16" viewBox="0 0 24 24" aria-hidden="true" fill="#1d9bf0">
                    <path d="M18.244 3H21l-6.5 7.4L22 21h-5.9l-4.6-5.3L6.4 21H3.6l6.9-7.9L2 3h6l4.2 4.8L18.244 3z"/>
                  </svg>
                </a>
              </li>
            </ul>
          </div>
        </aside>
      </div>
    </div>
  </main>

  <!-- Recommended blogs: carousel (titull majtas, shigjeta djathtas) -->
  <section class="recommended-blogs-section py-5 py-lg-6 reveal reveal--fade" aria-labelledby="recommended-blogs-heading">
    <div class="container">
      <div class="recommended-blogs-head reveal">
        <h2 id="recommended-blogs-heading" class="recommended-blogs-title">Recommended blogs</h2>
        <div class="recommended-blogs-nav">
          <button type="button" class="recommended-blogs-prev" aria-label="Previous slides">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
              <path d="M15 6L9 12L15 18" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </button>
          <button type="button" class="recommended-blogs-next" aria-label="Next slides">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
              <path d="M9 6L15 12L9 18" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </button>
        </div>
      </div>

      <div class="swiper recommendedBlogsSwiper mt-4 mt-lg-5 reveal">
        <div class="swiper-wrapper">
          <!-- CELLAR_WP_BLOG_RECOMMENDED -->
        </div>
      </div>
    </div>
  </section>

