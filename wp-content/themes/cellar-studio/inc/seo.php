<?php
if (!defined('ABSPATH')) {
	exit;
}

function cellar_studio_default_meta_description(): string {
	return 'Cellar Studio designs and installs bespoke wine cellars, wine walls, and cigar rooms in Dubai and the UAE — from concept to installation.';
}

function cellar_studio_meta_description_for_request(): string {
	if (is_singular('post')) {
		$excerpt = get_the_excerpt();
		if (is_string($excerpt) && trim($excerpt) !== '') {
			return wp_strip_all_tags($excerpt);
		}
		$content = wp_strip_all_tags((string) get_post_field('post_content', get_the_ID()));
		return wp_trim_words($content, 28, '…');
	}

	if (function_exists('is_product') && is_product() && function_exists('wc_get_product')) {
		$product = wc_get_product(get_queried_object_id());
		if ($product instanceof WC_Product) {
			$summary = wp_strip_all_tags($product->get_short_description() ?: $product->get_description());
			if (trim($summary) !== '') {
				return wp_trim_words($summary, 28, '…');
			}
			return $product->get_name() . ' from Cellar Studio, for wine and cigar storage in Dubai.';
		}
	}

	$slug = '';
	if (is_front_page()) {
		$slug = 'home';
	} elseif (is_home()) {
		$slug = 'blog';
	} else {
		$queried = get_queried_object();
		if ($queried instanceof WP_Post && $queried->post_type === 'page') {
			$slug = $queried->post_name;
		}
	}

	$map = [
		'home' => cellar_studio_default_meta_description(),
		'about' => 'Meet Cellar Studio, a Swiss–French design team creating refined wine and cigar spaces across Dubai, the UAE, and Switzerland.',
		'contact' => 'Contact Cellar Studio in Dubai to plan a custom wine cellar, wine wall, or cigar room. Call +971 50 912 4567 or email sacha@cellar-studio.com.',
		'bespoke' => 'Bespoke wine cellars, wine walls, and cigar rooms designed around your architecture, collection, and lifestyle.',
		'wine-fridge' => 'Premium wine fridges for homes and hospitality in the UAE, specified and installed by Cellar Studio.',
		'wine-racking-solutions' => 'Modular and semi-custom wine racking systems for residential and commercial cellars, designed for capacity and presentation.',
		'cigar-humidors' => 'Custom cigar humidors and cigar rooms with precise humidity control, crafted for private collections in Dubai.',
		'blog' => 'Guides and ideas on wine storage, cigar humidors, and bespoke cellar design from Cellar Studio.',
		'privacy-policy' => 'How Cellar Studio collects and uses personal data from website enquiries, forms, and analytics cookies.',
		'terms-and-conditions' => 'Terms of use for the Cellar Studio website and enquiry process.',
	];

	if ($slug !== '' && isset($map[$slug])) {
		return $map[$slug];
	}

	return cellar_studio_default_meta_description();
}

function cellar_studio_output_meta_description(): void {
	if (is_admin()) {
		return;
	}
	if (function_exists('cellar_studio_is_thank_you_page') && cellar_studio_is_thank_you_page()) {
		return;
	}
	$desc = cellar_studio_meta_description_for_request();
	if ($desc === '') {
		return;
	}
	echo '<meta name="description" content="' . esc_attr($desc) . '">' . "\n";
}
add_action('wp_head', 'cellar_studio_output_meta_description', 1);

function cellar_studio_document_title_parts(array $parts): array {
	$titles = [
		'home' => 'Bespoke Wine Cellars & Cigar Rooms in Dubai',
		'about' => 'About Cellar Studio',
		'contact' => 'Contact Cellar Studio in Dubai',
		'bespoke' => 'Bespoke Wine Cellars & Cigar Rooms',
		'wine-fridge' => 'Wine Fridges for Homes and Hospitality',
		'cigar-humidors' => 'Cigar Humidors & Cigar Rooms in Dubai',
		'wine-racking-solutions' => 'Wine Racking Solutions',
		'blog' => 'Wine Cellar & Cigar Room Guides',
		'shop' => 'Wine Fridges & Cigar Humidors',
	];

	$slug = '';
	if (is_front_page()) {
		$slug = 'home';
	} elseif (is_home()) {
		$slug = 'blog';
	} else {
		$queried = get_queried_object();
		if ($queried instanceof WP_Post && $queried->post_type === 'page') {
			$slug = $queried->post_name;
		}
	}

	if ($slug !== '' && isset($titles[$slug])) {
		$parts['title'] = $titles[$slug];
		$parts['site'] = 'Cellar Studio';
	}

	return $parts;
}
add_filter('document_title_parts', 'cellar_studio_document_title_parts');

function cellar_studio_social_image(): string {
	if (is_singular() && has_post_thumbnail()) {
		$image = get_the_post_thumbnail_url(get_queried_object_id(), 'large');
		if (is_string($image) && $image !== '') {
			return $image;
		}
	}
	return cellar_studio_asset('img/Projects.png');
}

function cellar_studio_output_social_meta(): void {
	if (is_admin() || (function_exists('cellar_studio_is_thank_you_page') && cellar_studio_is_thank_you_page())) {
		return;
	}

	$title = wp_get_document_title();
	$description = cellar_studio_meta_description_for_request();
	$url = function_exists('wp_get_canonical_url') ? (string) wp_get_canonical_url() : '';
	if ($url === '') {
		$url = home_url('/');
	}
	$image = cellar_studio_social_image();

	echo '<meta property="og:locale" content="en_US">' . "\n";
	echo '<meta property="og:site_name" content="Cellar Studio">' . "\n";
	echo '<meta property="og:title" content="' . esc_attr($title) . '">' . "\n";
	echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
	echo '<meta property="og:url" content="' . esc_url($url) . '">' . "\n";
	echo '<meta property="og:type" content="' . (is_singular('post') ? 'article' : 'website') . '">' . "\n";
	echo '<meta property="og:image" content="' . esc_url($image) . '">' . "\n";
	echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
	echo '<meta name="twitter:title" content="' . esc_attr($title) . '">' . "\n";
	echo '<meta name="twitter:description" content="' . esc_attr($description) . '">' . "\n";
	echo '<meta name="twitter:image" content="' . esc_url($image) . '">' . "\n";
}
add_action('wp_head', 'cellar_studio_output_social_meta', 2);

function cellar_studio_post_faq_entries(int $post_id): array {
	$raw = get_post_meta($post_id, 'cellar_llm_faq', true);
	if (!is_string($raw) || $raw === '') {
		return [];
	}
	$decoded = json_decode($raw, true);
	if (!is_array($decoded)) {
		return [];
	}
	$entries = [];
	foreach ($decoded as $row) {
		if (!is_array($row) || empty($row['q']) || empty($row['a'])) {
			continue;
		}
		$entries[] = [
			'q' => (string) $row['q'],
			'a' => (string) $row['a'],
		];
	}
	return $entries;
}

function cellar_studio_faq_entries(): array {
	return [
		[
			'q' => 'What materials are used in Cellar Studio installations?',
			'a' => 'We use premium-grade materials including solid hardwood, architectural glass, powder-coated metal, natural stone, and climate-resistant finishes.',
		],
		[
			'q' => 'Do you offer fully bespoke wine cellar and cigar room design?',
			'a' => 'Yes — we design and deliver fully bespoke environments tailored to your architecture, collection, and lifestyle, from concept through installation.',
		],
		[
			'q' => 'Are your wine racks and display systems climate compatible?',
			'a' => 'Our systems are specified to work with professional climate and humidity control. We coordinate engineering so storage conditions remain stable and discreet.',
		],
		[
			'q' => 'Can I customise a product from your collection?',
			'a' => 'Many products support finishes, sizing, and configuration options. Share your requirements and we will advise what can be adapted within lead times and budget.',
		],
		[
			'q' => 'Do you provide installation services?',
			'a' => 'Yes. We manage on-site installation, coordination, and quality checks so the finished space matches the approved design and performs as intended.',
		],
		[
			'q' => 'Do you ship internationally?',
			'a' => 'Where regulations and logistics allow, we can support international delivery. Scope depends on product type, site location, and local compliance — ask us for a project-specific answer.',
		],
		[
			'q' => 'How do I begin a project with Cellar Studio?',
			'a' => 'Start with a consultation: share your space, timeline, and goals. We will outline next steps — from measurements and concepts to proposals and scheduling.',
		],
	];
}

function cellar_studio_current_page_slug(): string {
	if (is_front_page()) {
		return 'home';
	}
	if (is_home()) {
		return 'blog';
	}
	$queried = get_queried_object();
	if ($queried instanceof WP_Post) {
		return (string) $queried->post_name;
	}
	return '';
}

function cellar_studio_schema_graph(): array {
	$org_id = home_url('/#organization');
	$logo = cellar_studio_asset('img/logo-black.svg');
	$graph = [
		[
			'@type' => ['Organization', 'LocalBusiness'],
			'@id' => $org_id,
			'name' => 'Cellar Studio',
			'url' => home_url('/'),
			'description' => cellar_studio_default_meta_description(),
			'email' => 'sacha@cellar-studio.com',
			'telephone' => '+971509124567',
			'image' => $logo,
			'logo' => $logo,
			'address' => [
				'@type' => 'PostalAddress',
				'streetAddress' => 'Swiss Tower, Cluster Y',
				'addressLocality' => 'Jumeirah Lakes Towers',
				'addressRegion' => 'Dubai',
				'addressCountry' => 'AE',
			],
			'openingHoursSpecification' => [
				'@type' => 'OpeningHoursSpecification',
				'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
				'opens' => '08:00',
				'closes' => '21:00',
			],
			'sameAs' => [
				'https://www.instagram.com/cellarstudiouae/',
				'https://www.linkedin.com/company/cellar-studio-uae/',
			],
			'areaServed' => ['Dubai', 'United Arab Emirates', 'Switzerland'],
		],
	];

	$slug = cellar_studio_current_page_slug();
	$services = [
		'bespoke' => 'Bespoke wine cellars, wine walls, and cigar rooms',
		'wine-fridge' => 'Wine fridges and integrated wine refrigeration',
		'cigar-humidors' => 'Cigar humidors and cigar rooms',
		'wine-racking-solutions' => 'Wine racking systems',
	];
	if (isset($services[$slug])) {
		$graph[] = [
			'@type' => 'Service',
			'@id' => home_url('/' . $slug . '/#service'),
			'name' => $services[$slug],
			'serviceType' => $services[$slug],
			'provider' => ['@id' => $org_id],
			'areaServed' => 'Dubai',
			'url' => home_url('/' . $slug . '/'),
		];
	}

	$faq_pages = ['contact', 'bespoke', 'wine-fridge', 'cigar-humidors', 'wine-racking-solutions'];
	if (in_array($slug, $faq_pages, true)) {
		$graph[] = [
			'@type' => 'FAQPage',
			'@id' => home_url('/' . $slug . '/#faq'),
			'mainEntity' => array_map(static function (array $item): array {
				return [
					'@type' => 'Question',
					'name' => $item['q'],
					'acceptedAnswer' => [
						'@type' => 'Answer',
						'text' => $item['a'],
					],
				];
			}, cellar_studio_faq_entries()),
		];
	}

	if (is_singular('post')) {
		$post_id = get_queried_object_id();
		$image = get_the_post_thumbnail_url($post_id, 'large');
		$article = [
			'@type' => 'BlogPosting',
			'@id' => get_permalink($post_id) . '#article',
			'headline' => get_the_title($post_id),
			'description' => cellar_studio_meta_description_for_request(),
			'datePublished' => get_post_time('c', true, $post_id),
			'dateModified' => get_post_modified_time('c', true, $post_id),
			'mainEntityOfPage' => get_permalink($post_id),
			'author' => ['@id' => $org_id],
			'publisher' => ['@id' => $org_id],
		];
		if (is_string($image) && $image !== '') {
			$article['image'] = $image;
		}
		$graph[] = $article;

		$post_faq = cellar_studio_post_faq_entries($post_id);
		if ($post_faq) {
			$graph[] = [
				'@type' => 'FAQPage',
				'@id' => get_permalink($post_id) . '#faq',
				'mainEntity' => array_map(static function (array $item): array {
					return [
						'@type' => 'Question',
						'name' => $item['q'],
						'acceptedAnswer' => [
							'@type' => 'Answer',
							'text' => $item['a'],
						],
					];
				}, $post_faq),
			];
		}
	}

	if ((is_home() || $slug === 'blog') && !is_singular('post')) {
		$posts = get_posts([
			'post_type' => 'post',
			'post_status' => 'publish',
			'posts_per_page' => 12,
			'orderby' => 'date',
			'order' => 'DESC',
		]);
		$items = [];
		$position = 1;
		foreach ($posts as $post) {
			if (!$post instanceof WP_Post) {
				continue;
			}
			$items[] = [
				'@type' => 'ListItem',
				'position' => $position,
				'url' => get_permalink($post),
				'name' => get_the_title($post),
			];
			$position++;
		}
		$graph[] = [
			'@type' => 'CollectionPage',
			'@id' => home_url('/blog/#collection'),
			'name' => 'Wine cellar and cigar room guides',
			'description' => 'Guides and ideas on wine storage, cigar humidors, and bespoke cellar design from Cellar Studio.',
			'url' => home_url('/blog/'),
			'isPartOf' => ['@id' => $org_id],
			'mainEntity' => [
				'@type' => 'ItemList',
				'itemListElement' => $items,
			],
		];
	}

	if (function_exists('is_product') && is_product() && function_exists('wc_get_product')) {
		$product = wc_get_product(get_queried_object_id());
		if ($product instanceof WC_Product) {
			$node = [
				'@type' => 'Product',
				'@id' => get_permalink($product->get_id()) . '#product',
				'name' => $product->get_name(),
				'description' => wp_strip_all_tags($product->get_short_description() ?: $product->get_description() ?: $product->get_name()),
				'url' => get_permalink($product->get_id()),
				'brand' => ['@id' => $org_id],
			];
			$sku = $product->get_sku();
			if ($sku !== '') {
				$node['sku'] = $sku;
			}
			$image_id = $product->get_image_id();
			if ($image_id) {
				$image = wp_get_attachment_image_url($image_id, 'large');
				if (is_string($image) && $image !== '') {
					$node['image'] = $image;
				}
			}
			if ($product->get_price() !== '') {
				$node['offers'] = [
					'@type' => 'Offer',
					'priceCurrency' => function_exists('get_woocommerce_currency') ? get_woocommerce_currency() : 'AED',
					'price' => $product->get_price(),
					'availability' => $product->is_in_stock() ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
					'url' => get_permalink($product->get_id()),
				];
			}
			$graph[] = $node;
		}
	}

	return $graph;
}

function cellar_studio_output_schema(): void {
	if (is_admin() || (function_exists('cellar_studio_is_thank_you_page') && cellar_studio_is_thank_you_page())) {
		return;
	}
	$payload = [
		'@context' => 'https://schema.org',
		'@graph' => cellar_studio_schema_graph(),
	];
	echo '<script type="application/ld+json">' . wp_json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}
add_action('wp_head', 'cellar_studio_output_schema', 20);

function cellar_studio_llms_txt(): void {
	$path = (string) wp_parse_url((string) ($_SERVER['REQUEST_URI'] ?? ''), PHP_URL_PATH);
	if ($path !== '/llms.txt') {
		return;
	}

	$lines = [
		'# Cellar Studio',
		'',
		'> Swiss–French design team for bespoke wine cellars, wine walls, cigar humidors, and cigar rooms. Studio: Swiss Tower, Cluster Y, Jumeirah Lakes Towers, Dubai. Phone +971 50 912 4567. Email sacha@cellar-studio.com. Hours Monday–Saturday, 08:00–21:00.',
		'',
		'Partners named on the website: Swisscave and Raching. Markets named on the website: Dubai, the UAE, and Switzerland. Co-founders named on the About page: Sacha Christe and Florian Grolleau.',
		'',
		'## Pages',
		'- [Home](' . home_url('/') . '): bespoke wine and cigar spaces',
		'- [Bespoke](' . home_url('/bespoke/') . '): custom wine cellars, wine walls, and cigar rooms',
		'- [Wine fridges](' . home_url('/wine-fridge/') . '): freestanding and integrated wine refrigeration',
		'- [Cigar humidors](' . home_url('/cigar-humidors/') . '): humidors and cigar rooms',
		'- [Wine racking](' . home_url('/wine-racking-solutions/') . '): bespoke and ready-made racking',
		'- [About](' . home_url('/about/') . '): the studio and partnerships',
		'- [Contact](' . home_url('/contact/') . '): address, phone, email, and hours',
		'- [Guides](' . home_url('/blog/') . '): articles on wine storage, cigar rooms, and cellar design',
		'',
	];

	status_header(200);
	header('Content-Type: text/plain; charset=utf-8');
	header('X-Robots-Tag: noindex');
	echo implode("\n", $lines);
	exit;
}
add_action('template_redirect', 'cellar_studio_llms_txt', 0);

function cellar_studio_utility_page_slugs(): array {
	return ['cart', 'checkout', 'my-account'];
}

function cellar_studio_is_utility_page(): bool {
	if (!is_page()) {
		return false;
	}
	return in_array(cellar_studio_current_page_slug(), cellar_studio_utility_page_slugs(), true);
}

function cellar_studio_robots(array $robots): array {
	if (cellar_studio_is_utility_page() || is_search()) {
		$robots['noindex'] = true;
		$robots['follow'] = true;
	}
	return $robots;
}
add_filter('wp_robots', 'cellar_studio_robots');

function cellar_studio_exclude_utility_from_sitemap(array $args, string $post_type): array {
	if ($post_type !== 'page') {
		return $args;
	}
	$exclude = [];
	foreach (cellar_studio_utility_page_slugs() as $slug) {
		$page = get_page_by_path($slug);
		if ($page instanceof WP_Post) {
			$exclude[] = (int) $page->ID;
		}
	}
	if ($exclude) {
		$args['post__not_in'] = array_merge($args['post__not_in'] ?? [], $exclude);
	}
	return $args;
}
add_filter('wp_sitemaps_posts_query_args', 'cellar_studio_exclude_utility_from_sitemap', 10, 2);

function cellar_studio_front_headers(): void {
	if (is_admin() || headers_sent()) {
		return;
	}
	if (is_ssl()) {
		header('Strict-Transport-Security: max-age=31536000');
	}
}
add_action('send_headers', 'cellar_studio_front_headers');

function cellar_studio_trim_head_assets(): void {
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_action('admin_print_styles', 'print_emoji_styles');
	remove_action('wp_head', 'wp_oembed_add_discovery_links');
	remove_action('wp_head', 'wp_oembed_add_host_js');
	add_filter('emoji_svg_url', '__return_false');
}
add_action('init', 'cellar_studio_trim_head_assets');

function cellar_studio_dequeue_guest_dashicons(): void {
	if (!is_user_logged_in()) {
		wp_deregister_style('dashicons');
	}
}
add_action('wp_enqueue_scripts', 'cellar_studio_dequeue_guest_dashicons', 100);
