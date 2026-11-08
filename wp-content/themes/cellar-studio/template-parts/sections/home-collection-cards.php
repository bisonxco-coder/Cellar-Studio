<?php
if (!defined('ABSPATH')) {
	exit;
}

$cards = [
	[
		'title' => 'SwissCave',
		'desc' => 'Swiss-designed wine cabinets and climate systems, engineered for precise temperature, humidity, and long-term preservation.',
		'url' => home_url('/wine-fridge/'),
		'img' => cellar_studio_asset('img/WhatsApp Image 2026-05-21 at 13.36.05.jpeg'),
	],
	[
		'title' => 'Raching',
		'desc' => 'Premium humidors with advanced humidity control and Spanish cedar interiors, built for the long-term storage of fine cigars.',
		'url' => home_url('/cigar-humidors/'),
		'img' => cellar_studio_asset('img/cigar-humidors_header.png'),
	],
	[
		'title' => 'Wine Racking Solutions',
		'desc' => 'Modular and custom racking systems in metal, glass, and solid wood — designed for efficiency, scalability, and refined display.',
		'url' => home_url('/wine-racking-solutions/'),
		'img' => cellar_studio_asset('img/ChatGPT Image Apr 27, 2026, 11_30_14 AM.png'),
	],
];
?>

<section class="section-home-collection-cards py-5 py-lg-6 reveal reveal--fade" aria-label="Curated collections">
	<div class="container-fluid">
		<div class="text-center mb-4 mb-lg-5 reveal-stagger">
			<h2 class="home-collection-cards-title reveal">Curated Wine &amp; Cigar<br>Collections</h2>
		</div>

		<div class="row g-4 justify-content-center reveal-stagger">
			<?php foreach ($cards as $c): ?>
				<div class="col-12 col-md-6 col-xl-4">
					<article class="home-collection-card reveal">
						<div class="home-collection-card-inner">
							<div class="home-collection-card-image">
								<img src="<?php echo esc_url($c['img']); ?>" alt="<?php echo esc_attr($c['title']); ?>" loading="lazy" decoding="async">
							</div>
							<div class="home-collection-card-body">
								<h3 class="home-collection-card-title"><?php echo esc_html($c['title']); ?></h3>
								<p class="home-collection-card-desc"><?php echo esc_html($c['desc']); ?></p>
								<a class="home-collection-card-btn" href="<?php echo esc_url($c['url']); ?>">Discover More</a>
							</div>
						</div>
					</article>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

