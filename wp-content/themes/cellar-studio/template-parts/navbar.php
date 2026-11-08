<?php
if (!defined('ABSPATH')) {
	exit;
}

$navTheme = $args['navTheme'] ?? 'dark';
$isLightNav = $navTheme === 'light';
$navClass = $isLightNav ? 'navbar-light nav-theme-light' : 'navbar-dark';
$offcanvasClass = $isLightNav ? 'offcanvas-theme-light' : 'text-bg-dark';
$ctaClass = $isLightNav ? 'btn-dark' : 'btn-light';

$slug = '';
$qid = get_queried_object_id();
if ($qid) {
	$slug = (string) get_post_field('post_name', $qid);
}

$isHome = is_front_page() || $slug === 'home';
?>

<div class="site-nav-strip <?php echo $isLightNav ? 'site-nav-strip--light' : ''; ?>">
	<div class="container">
		<div class="hero-top-nav navbar <?php echo esc_attr($navClass); ?> align-items-center w-100 flex-nowrap">
			<div class="d-flex align-items-center flex-shrink-0">
				<a href="<?php echo esc_url(home_url('/')); ?>" class="hero-logo text-uppercase fw-semibold">
					<img
						src="<?php echo esc_url(cellar_studio_asset($isLightNav ? 'img/logo-black.svg' : 'img/logo.svg')); ?>"
						alt="<?php echo esc_attr(get_bloginfo('name')); ?>"
						class="hero-logo-img"
					>
				</a>
			</div>

			<nav class="hero-main-nav d-none d-lg-flex flex-grow-1 justify-content-center" aria-label="Primary">
				<ul class="navbar-nav d-flex flex-row flex-wrap justify-content-center align-items-center gap-1 gap-xl-2 mb-0 list-unstyled">
					<li class="nav-item">
						<a href="<?php echo esc_url(home_url('/')); ?>" class="nav-link px-2 px-xl-3<?php echo $isHome ? ' nav-link--active' : ''; ?>">Home</a>
					</li>

					<li class="nav-item dropdown nav-dropdown">
						<a
							href="#"
							class="nav-link dropdown-toggle px-2 px-xl-3<?php echo in_array($slug, ['bespoke', 'cigar-humidors', 'wine-fridge', 'wine-racking-solutions'], true) ? ' nav-link--active' : ''; ?>"
							id="navServicesDd"
							data-bs-toggle="dropdown"
							aria-expanded="false"
							aria-haspopup="true"
						>Services</a>
						<ul class="dropdown-menu nav-dropdown-menu nav-mega-menu shadow-sm" aria-labelledby="navServicesDd">
							<li class="nav-mega-inner">
								<div class="nav-mega-grid" role="menu">
									<a class="nav-mega-card<?php echo $slug === 'bespoke' ? ' is-active' : ''; ?>" href="<?php echo esc_url(home_url('/bespoke/')); ?>" role="menuitem">
										<div class="nav-mega-card-media">
											<img src="<?php echo esc_url(cellar_studio_asset('img/Services.png')); ?>" alt="Bespoke">
										</div>
										<div class="nav-mega-card-footer">
											<span class="nav-mega-card-title">Bespoke</span>
											<span class="nav-mega-card-plus" aria-hidden="true">+</span>
										</div>
									</a>

									<a class="nav-mega-card<?php echo $slug === 'cigar-humidors' ? ' is-active' : ''; ?>" href="<?php echo esc_url(home_url('/cigar-humidors/')); ?>" role="menuitem">
										<div class="nav-mega-card-media">
											<img src="<?php echo esc_url(cellar_studio_asset('img/Services 2.png')); ?>" alt="Cigar Humidors">
										</div>
										<div class="nav-mega-card-footer">
											<span class="nav-mega-card-title">Cigar Humidors</span>
											<span class="nav-mega-card-plus" aria-hidden="true">+</span>
										</div>
									</a>

									<a class="nav-mega-card<?php echo $slug === 'wine-fridge' ? ' is-active' : ''; ?>" href="<?php echo esc_url(home_url('/wine-fridge/')); ?>" role="menuitem">
										<div class="nav-mega-card-media">
											<img src="<?php echo esc_url(cellar_studio_asset('img/Services 3.png')); ?>" alt="Wine Fridge">
										</div>
										<div class="nav-mega-card-footer">
											<span class="nav-mega-card-title">Wine Fridge</span>
											<span class="nav-mega-card-plus" aria-hidden="true">+</span>
										</div>
									</a>

									<a class="nav-mega-card<?php echo $slug === 'wine-racking-solutions' ? ' is-active' : ''; ?>" href="<?php echo esc_url(home_url('/wine-racking-solutions/')); ?>" role="menuitem">
										<div class="nav-mega-card-media">
											<img src="<?php echo esc_url(cellar_studio_asset('img/Services 4.png')); ?>" alt="Racking Solutions">
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
						<a href="<?php echo esc_url(home_url('/blog/')); ?>" class="nav-link px-2 px-xl-3<?php echo $slug === 'blog' || is_home() ? ' nav-link--active' : ''; ?>">Blog</a>
					</li>
					<li class="nav-item">
						<a href="<?php echo esc_url(home_url('/contact/')); ?>" class="nav-link px-2 px-xl-3<?php echo $slug === 'contact' ? ' nav-link--active' : ''; ?>">Contact</a>
					</li>
					<li class="nav-item">
						<a href="<?php echo esc_url(home_url('/about/')); ?>" class="nav-link px-2 px-xl-3<?php echo $slug === 'about' ? ' nav-link--active' : ''; ?>">About</a>
					</li>
				</ul>
			</nav>

			<div class="flex-shrink-0 d-none d-lg-block ms-2">
				<a href="<?php echo esc_url(home_url('/bespoke/#bespoke-enquiry')); ?>" class="btn <?php echo esc_attr($ctaClass); ?> btn-sm rounded-pill hero-cta-top px-3">
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

<div class="offcanvas offcanvas-end <?php echo esc_attr($offcanvasClass); ?>" tabindex="-1" id="mobileNav" aria-labelledby="mobileNavLabel">
	<div class="offcanvas-header">
		<h5 class="offcanvas-title" id="mobileNavLabel">Menu</h5>
		<button
			type="button"
			class="btn-close <?php echo $isLightNav ? '' : 'btn-close-white'; ?>"
			data-bs-dismiss="offcanvas"
			aria-label="Close"
		></button>
	</div>
	<div class="offcanvas-body">
		<nav class="mobile-nav d-flex flex-column gap-1" aria-label="Mobile primary">
			<a href="<?php echo esc_url(home_url('/')); ?>" class="nav-link py-2<?php echo $isHome ? ' nav-link--active' : ''; ?>">Home</a>

			<button
				class="mobile-nav-collapse-toggle nav-link py-2 text-start d-flex justify-content-between align-items-center border-0 bg-transparent w-100<?php echo in_array($slug, ['bespoke', 'cigar-humidors', 'wine-fridge', 'wine-racking-solutions'], true) ? ' nav-link--active' : ''; ?>"
				type="button"
				data-bs-toggle="collapse"
				data-bs-target="#mobileNavServices"
				aria-expanded="false"
			>
				Services
				<span class="mobile-nav-chevron" aria-hidden="true"></span>
			</button>
			<div class="collapse" id="mobileNavServices">
				<div class="d-flex flex-column gap-0 ps-3 pb-2 mobile-nav-sub">
					<a href="<?php echo esc_url(home_url('/bespoke/')); ?>" class="nav-link py-2 small">Bespoke</a>
					<a href="<?php echo esc_url(home_url('/cigar-humidors/')); ?>" class="nav-link py-2 small">Cigar Humidors</a>
					<a href="<?php echo esc_url(home_url('/wine-fridge/')); ?>" class="nav-link py-2 small">Wine Fridge</a>
					<a href="<?php echo esc_url(home_url('/wine-racking-solutions/')); ?>" class="nav-link py-2 small">Racking Solutions</a>
				</div>
			</div>

			<a href="<?php echo esc_url(home_url('/blog/')); ?>" class="nav-link py-2<?php echo $slug === 'blog' || is_home() ? ' nav-link--active' : ''; ?>">Blog</a>
			<a href="<?php echo esc_url(home_url('/contact/')); ?>" class="nav-link py-2<?php echo $slug === 'contact' ? ' nav-link--active' : ''; ?>">Contact</a>
			<a href="<?php echo esc_url(home_url('/about/')); ?>" class="nav-link py-2<?php echo $slug === 'about' ? ' nav-link--active' : ''; ?>">About</a>

			<hr class="border-secondary my-3">
			<a href="<?php echo esc_url(home_url('/bespoke/#bespoke-enquiry')); ?>" class="btn <?php echo esc_attr($ctaClass); ?> rounded-pill">Request a Consultation</a>
		</nav>
	</div>
</div>

