<?php
// NOTE: We intentionally render the legacy navbar markup even inside WordPress.
// (No bridge to template-parts/navbar.)

$navTheme = $navTheme ?? "dark";
$navActive = $navActive ?? "";
$isLightNav = $navTheme === "light";
$navClass = $isLightNav ? "navbar-light nav-theme-light" : "navbar-dark";
$offcanvasClass = $isLightNav ? "offcanvas-theme-light" : "text-bg-dark";
$ctaClass = $isLightNav ? "btn-dark" : "btn-light";

$productsRoutes = ["product-details", "wine-fridge", "wine-racking", "cigar-humidors"];
$servicesRoutes = ["bespoke"];
$productsParentActive = in_array($navActive, $productsRoutes, true);
$servicesParentActive = in_array($navActive, $servicesRoutes, true);
?>

<div class="site-nav-strip <?php echo $isLightNav ? "site-nav-strip--light" : ""; ?>">
  <div class="container">
    <div class="hero-top-nav navbar <?php echo $navClass; ?> align-items-center w-100 flex-nowrap">
      <div class="d-flex align-items-center flex-shrink-0">
        <a href="/" class="hero-logo text-uppercase fw-semibold">
          <img src="<?php echo $isLightNav ? 'img/logo-black.svg' : 'img/logo.svg'; ?>" alt="Cellar Studio" class="hero-logo-img">
        </a>
      </div>

      <nav class="hero-main-nav d-none d-lg-flex flex-grow-1 justify-content-center" aria-label="Primary">
        <ul class="navbar-nav d-flex flex-row flex-wrap justify-content-center align-items-center gap-1 gap-xl-2 mb-0 list-unstyled">
          <li class="nav-item">
            <a href="index.php" class="nav-link px-2 px-xl-3<?php echo $navActive === "home" ? " nav-link--active" : ""; ?>">Home</a>
          </li>

          <!-- ECOMMERCE OFFLINE (TEMP): Products menu hidden for now
          <li class="nav-item dropdown nav-dropdown">
            <a
              href="#"
              class="nav-link dropdown-toggle px-2 px-xl-3<?php echo $productsParentActive ? " nav-link--active" : ""; ?>"
              id="navProductsDd"
              data-bs-toggle="dropdown"
              aria-expanded="false"
              aria-haspopup="true"
            >Products</a>
            <ul class="dropdown-menu nav-dropdown-menu shadow-sm" aria-labelledby="navProductsDd">
              <li><a class="dropdown-item<?php echo $navActive === "product-details" ? " active" : ""; ?>" href="product-details.php">Product showcase</a></li>
              <li><a class="dropdown-item<?php echo $navActive === "wine-fridge" ? " active" : ""; ?>" href="wine-fridge.php">Wine fridges</a></li>
              <li><a class="dropdown-item<?php echo $navActive === "wine-racking" ? " active" : ""; ?>" href="wine-racking-solutions.php">Wine racking solutions</a></li>
              <li><a class="dropdown-item<?php echo $navActive === "cigar-humidors" ? " active" : ""; ?>" href="cigar-humidors.php">Cigar humidors</a></li>
            </ul>
          </li>
          -->

          <li class="nav-item dropdown nav-dropdown">
            <a
              href="#"
              class="nav-link dropdown-toggle px-2 px-xl-3<?php echo $servicesParentActive ? " nav-link--active" : ""; ?>"
              id="navServicesDd"
              data-bs-toggle="dropdown"
              aria-expanded="false"
              aria-haspopup="true"
            >Services</a>
            <ul class="dropdown-menu nav-dropdown-menu nav-mega-menu shadow-sm" aria-labelledby="navServicesDd">
              <li class="nav-mega-inner">
                <div class="nav-mega-grid" role="menu">
                  <a class="nav-mega-card<?php echo $navActive === "bespoke" ? " is-active" : ""; ?>" href="bespoke.php" role="menuitem">
                    <div class="nav-mega-card-media">
                      <img src="img/Services.png" alt="Bespoke">
                    </div>
                    <div class="nav-mega-card-footer">
                      <span class="nav-mega-card-title">Bespoke</span>
                      <span class="nav-mega-card-plus" aria-hidden="true">+</span>
                    </div>
                  </a>

                  <a class="nav-mega-card<?php echo $navActive === "cigar-humidors" ? " is-active" : ""; ?>" href="cigar-humidors.php" role="menuitem">
                    <div class="nav-mega-card-media">
                      <img src="img/Services 2.png" alt="Cigar Humidors">
                    </div>
                    <div class="nav-mega-card-footer">
                      <span class="nav-mega-card-title">Cigar Humidors</span>
                      <span class="nav-mega-card-plus" aria-hidden="true">+</span>
                    </div>
                  </a>

                  <a class="nav-mega-card<?php echo $navActive === "wine-fridge" ? " is-active" : ""; ?>" href="wine-fridge.php" role="menuitem">
                    <div class="nav-mega-card-media">
                      <img src="img/Services 3.png" alt="Wine Fridge">
                    </div>
                    <div class="nav-mega-card-footer">
                      <span class="nav-mega-card-title">Wine Fridge</span>
                      <span class="nav-mega-card-plus" aria-hidden="true">+</span>
                    </div>
                  </a>

                  <a class="nav-mega-card<?php echo $navActive === "wine-racking" ? " is-active" : ""; ?>" href="wine-racking-solutions.php" role="menuitem">
                    <div class="nav-mega-card-media">
                      <img src="img/Services 4.png" alt="Racking Solutions">
                    </div>
                    <div class="nav-mega-card-footer">
                      <span class="nav-mega-card-title">Racking Solutions</span>
                      <span class="nav-mega-card-plus" aria-hidden="true">+</span>
                    </div>
                  </a>
                </div>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="blog.php" class="nav-link px-2 px-xl-3<?php echo $navActive === "blog" ? " nav-link--active" : ""; ?>">Blog</a>
          </li>
          <li class="nav-item">
            <a href="contact.php" class="nav-link px-2 px-xl-3<?php echo $navActive === "contact" ? " nav-link--active" : ""; ?>">Contact</a>
          </li>
          <li class="nav-item">
            <a href="about.php" class="nav-link px-2 px-xl-3<?php echo $navActive === "about" ? " nav-link--active" : ""; ?>">About</a>
          </li>
        </ul>
      </nav>
      <div class="flex-shrink-0 d-none d-lg-block ms-2">
        <a href="bespoke.php#bespoke-enquiry" class="btn <?php echo $ctaClass; ?> btn-sm rounded-pill hero-cta-top px-3">
          Request a Consultation
        </a>
      </div>

      <button
        class="navbar-toggler d-lg-none border-0 p-0 ms-auto flex-shrink-0"
        type="button"
        data-bs-toggle="offcanvas"
        data-bs-target="#mobileNav"
        aria-controls="mobileNav"
        aria-label="Open menu">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </div>
</div>

<!-- Mobile menu -->
<div class="offcanvas offcanvas-end <?php echo $offcanvasClass; ?>" tabindex="-1" id="mobileNav" aria-labelledby="mobileNavLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="mobileNavLabel">Menu</h5>
    <button
      type="button"
      class="btn-close <?php echo $isLightNav ? "" : "btn-close-white"; ?>"
      data-bs-dismiss="offcanvas"
      aria-label="Close"
    ></button>
  </div>
  <div class="offcanvas-body">
    <nav class="mobile-nav d-flex flex-column gap-1" aria-label="Mobile primary">
      <a href="index.php" class="nav-link py-2<?php echo $navActive === "home" ? " nav-link--active" : ""; ?>">Home</a>

      <!-- ECOMMERCE OFFLINE (TEMP): Products menu hidden for now
      <button
        class="mobile-nav-collapse-toggle nav-link py-2 text-start d-flex justify-content-between align-items-center border-0 bg-transparent w-100<?php echo $productsParentActive ? " nav-link--active" : ""; ?>"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#mobileNavProducts"
        aria-expanded="<?php echo $productsParentActive ? "true" : "false"; ?>"
      >
        Products
        <span class="mobile-nav-chevron" aria-hidden="true"></span>
      </button>
      <div class="collapse<?php echo $productsParentActive ? " show" : ""; ?>" id="mobileNavProducts">
        <div class="d-flex flex-column gap-0 ps-3 pb-2 mobile-nav-sub">
          <a href="product-details.php" class="nav-link py-2 small">Product showcase</a>
          <a href="wine-fridge.php" class="nav-link py-2 small">Wine fridges</a>
          <a href="wine-racking-solutions.php" class="nav-link py-2 small">Wine racking solutions</a>
          <a href="cigar-humidors.php" class="nav-link py-2 small">Cigar humidors</a>
        </div>
      </div>
      -->

      <button
        class="mobile-nav-collapse-toggle nav-link py-2 text-start d-flex justify-content-between align-items-center border-0 bg-transparent w-100<?php echo $servicesParentActive ? " nav-link--active" : ""; ?>"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#mobileNavServices"
        aria-expanded="<?php echo $servicesParentActive ? "true" : "false"; ?>"
      >
        Services
        <span class="mobile-nav-chevron" aria-hidden="true"></span>
      </button>
      <div class="collapse<?php echo $servicesParentActive ? " show" : ""; ?>" id="mobileNavServices">
        <div class="d-flex flex-column gap-0 ps-3 pb-2 mobile-nav-sub">
          <a href="bespoke.php" class="nav-link py-2 small">Bespoke</a>
          <a href="cigar-humidors.php" class="nav-link py-2 small">Cigar Humidors</a>
          <a href="wine-fridge.php" class="nav-link py-2 small">Wine Fridge</a>
          <a href="wine-racking-solutions.php" class="nav-link py-2 small">Racking Solutions</a>
        </div>
      </div>

      <a href="blog.php" class="nav-link py-2<?php echo $navActive === "blog" ? " nav-link--active" : ""; ?>">Blog</a>
      <a href="contact.php" class="nav-link py-2<?php echo $navActive === "contact" ? " nav-link--active" : ""; ?>">Contact</a>
      <a href="about.php" class="nav-link py-2<?php echo $navActive === "about" ? " nav-link--active" : ""; ?>">About</a>

      <hr class="border-secondary my-3">
      <a href="bespoke.php#bespoke-enquiry" class="btn <?php echo $ctaClass; ?> rounded-pill">Request a Consultation</a>
    </nav>
  </div>
</div>
