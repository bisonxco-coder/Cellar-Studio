<?php
$navActive = "product-details";
$navTheme  = "light";
?>
<!DOCTYPE html>
<html lang="sq">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Product Details | Cellar Studio</title>
  <link rel="icon" type="image/png" href="img/favicon.png">

  <!-- Google Font: Inter -->
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

  <!-- Swiper CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

  <!-- AOS (Animate On Scroll) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/responsive.css">
</head>
<body>

  <section class="product-hero">
    <div class="container-fluid">
      <div class="product-hero-nav">
      </div>

      <div class="product-hero-content">
        <!-- CELLAR_WC_PRODUCT_TITLE -->

        <div class="product-gallery-wrap">
          <div class="swiper productGallerySwiper">
            <div class="swiper-wrapper">
              <!-- CELLAR_WC_PRODUCT_GALLERY_SLIDES -->
            </div>
            <div class="product-gallery-bottom" aria-label="Product gallery controls">
              <div class="product-gallery-prev" tabindex="0" role="button" aria-label="Previous slide">‹</div>
              <div class="product-gallery-pagination"></div>
              <div class="product-gallery-next" tabindex="0" role="button" aria-label="Next slide">›</div>
            </div>
          </div>
        </div>

        <!-- CELLAR_WC_PRODUCT_SWATCHES -->
      </div>
    </div>
  </section>
  <!-- Product details content -->
  <section class="product-details-section py-4 py-lg-5">
    <div class="container-fluid">
      <div class="row g-4 g-xl-5">
        <!-- Left column -->
        <div class="col-12 col-xl-7">
          <div class="product-details-left">
            <h2 class="product-details-heading">Description</h2>
            <!-- CELLAR_WC_PRODUCT_DESCRIPTION -->

            <h3 class="product-details-subheading mt-4">Specifications</h3>
            <!-- CELLAR_WC_PRODUCT_SPECS -->

            <h3 class="product-details-subheading mt-4">Dimensions</h3>
            <!-- CELLAR_WC_PRODUCT_DIMENSIONS -->

            <div class="product-details-color mt-4">
              <span class="product-details-color-label">Color</span>
              <!-- CELLAR_WC_PRODUCT_SWATCHES -->
            </div>
          </div>
        </div>

        <!-- Right column -->
        <div class="col-12 col-xl-5">
          <aside class="product-summary-card">
            <!-- CELLAR_WC_PRODUCT_PRICE -->

            <div class="product-summary-divider"></div>

            <div class="product-summary-color">
              <p class="product-summary-label mb-2">Color</p>
              <!-- CELLAR_WC_PRODUCT_SWATCHES -->
            </div>

            <div class="product-summary-divider"></div>

            <ul class="product-benefits list-unstyled mb-0">
              <li>
                <img src="img/image 2084 [Vectorized].svg" alt="" aria-hidden="true">
                <span>Expert installation and setup by our local Dubai-based technical team</span>
              </li>
              <li>
                <img src="img/image 2083 [Vectorized].svg" alt="" aria-hidden="true">
                <span>Dedicated after-sales support and maintenance whenever you need assistance</span>
              </li>
              <li>
                <img src="img/image 2085 [Vectorized].svg" alt="" aria-hidden="true">
                <span>Manufacturer warranty and long-term product reliability for peace of mind</span>
              </li>
            </ul>

            <!-- CELLAR_WC_PRODUCT_CTA -->
          </aside>
        </div>
      </div>
    </div>
  </section>

  <!-- Similar products -->
  <section class="similar-products-section py-4 py-lg-5">
    <div class="container-fluid">
      <div class="similar-products-head">
        <h2 class="similar-products-title mb-0">Similar Products</h2>
        <div class="similar-products-nav">
          <button type="button" class="similar-products-prev" aria-label="Previous">←</button>
          <button type="button" class="similar-products-next" aria-label="Next">→</button>
        </div>
      </div>

      <div class="swiper similarProductsSwiper mt-4">
        <div class="swiper-wrapper">
          <!-- CELLAR_WC_SIMILAR_PRODUCTS -->
        </div>
      </div>

      <div class="mt-4">
        <a href="#" class="btn btn-outline-dark rounded-pill similar-products-more">View more →</a>
      </div>
    </div>
  </section>

    <!-- ABOUT SECTION 7: CTA -->
    <section class="about-cta py-5 py-lg-6">
    <div class="container text-center reveal-stagger">
      <h2 class="about-cta-title reveal">It’s Time to Design Your<br>Perfect Wine & Cigar Space</h2>
      <!-- <p class="about-cta-subtitle mt-3 reveal">Tailored to your space. Engineered for your collection.</p> -->
      <div class="mt-4 reveal">
        <a href="bespoke.php#bespoke-enquiry" class="btn btn-dark rounded-pill px-4 about-cta-btn">Request a Consultation</a>
      </div>
    </div>
  </section>
  <img src="img/modern-house-interior-design-project-sketch-3d-rendering 1.png" style="width: 100%;" alt="" srcset="">


  </body>
</html>
