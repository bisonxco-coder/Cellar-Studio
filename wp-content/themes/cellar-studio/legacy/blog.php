<?php
/**
 * Blog — hero, kërkim, arkiv me sort (dropdown), rrjet kartash (klasat e News nga index.php), pagination.
 * $navActive: navbar — linku "Blog" aktiv.
 */
$navActive = "blog";
?>
<!DOCTYPE html>
<html lang="sq">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blog | Cellar Studio</title>
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
<body>

  <!-- Hero: i njëjtë me page-hero (about etj.), por me foto + overlay + search -->
  <section class="page-hero page-hero--blog" aria-label="Blog hero">
    <div class="hero-nav-layer">
      <?php include __DIR__ . '/includes/navbar.php'; ?>
    </div>

    <img
      class="page-hero-bg-img"
      src="img/Header Wine (3).png"
      alt=""
      decoding="async"
      fetchpriority="high"
    >

    <div class="page-hero-overlay">
      <div class="container h-100 d-flex flex-column justify-content-center align-items-center text-center px-3">
        <div class="hero-content reveal reveal--fade w-100">
          <h1 class="hero-title">
            Find blog inspiration<br>
            that you want to explore
          </h1>

          <form class="blog-hero-search" role="search" action="<?php echo function_exists('home_url') ? esc_url(home_url('/blog/')) : '#'; ?>" method="get" aria-label="Search blog posts">
            <span class="blog-hero-search-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <circle cx="11" cy="11" r="6.5" stroke="currentColor" stroke-width="1.5"/>
                <path d="M16 16L20 20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
              </svg>
            </span>
            <label class="visually-hidden" for="blog-search-input">Search the blog</label>
            <input
              id="blog-search-input"
              class="blog-hero-search-field"
              type="search"
              name="s"
              placeholder="Search the blog"
              autocomplete="off"
              value="<?php echo isset($_GET['s']) ? esc_attr((string) wp_unslash($_GET['s'])) : ''; ?>"
            >
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Blog archive: sort + grid (kartat = të njëjtat klasa si News në index.php) + pagination -->
  <section class="section-news section-blog-archive py-5 py-lg-6 reveal reveal--fade" aria-label="Blog posts">
    <div class="container-fluid">
      <div class="blog-archive-toolbar d-flex flex-wrap align-items-center gap-2 gap-sm-3 mb-4 mb-lg-5 reveal">
        <span class="blog-sort-label" id="blog-sort-label">Sort by:</span>
        <div class="dropdown">
          <button
            class="btn blog-sort-toggle dropdown-toggle d-inline-flex align-items-center gap-2"
            type="button"
            id="blogSortDropdown"
            data-bs-toggle="dropdown"
            aria-expanded="false"
            aria-labelledby="blog-sort-label"
          >
            Latest release
          </button>
          <ul class="dropdown-menu dropdown-menu-end shadow-sm border" aria-labelledby="blogSortDropdown">
            <li><a class="dropdown-item active" href="#">Latest release</a></li>
            <li><a class="dropdown-item" href="#">Oldest first</a></li>
            <li><a class="dropdown-item" href="#">Title A–Z</a></li>
          </ul>
        </div>
      </div>

      <!-- CELLAR_WP_BLOG_ARCHIVE -->
    </div>
  </section>

  
<!-- ABOUT SECTION 7: CTA -->
<section class="about-cta py-5 py-lg-6">
    <div class="container text-center reveal-stagger">
      <h2 class="about-cta-title reveal">Design Your Private Cellar</h2>
      <p class="about-cta-subtitle mt-3 reveal">Tailored to your space. Engineered for your collection.</p>
      <div class="mt-4 reveal">
        <a href="bespoke.php#bespoke-enquiry" class="btn btn-dark rounded-pill px-4 about-cta-btn">Request a Consultation</a>
      </div>
    </div>
  </section>
  <img src="img/modern-house-interior-design-project-sketch-3d-rendering 1.png" style="width: 100%;" alt="" srcset="">

