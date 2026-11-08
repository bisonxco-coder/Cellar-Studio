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
	if (is_front_page()) {
		$parts['title'] = 'Bespoke Wine Cellars & Cigar Rooms in Dubai';
		$parts['site'] = 'Cellar Studio';
	}
	return $parts;
}
add_filter('document_title_parts', 'cellar_studio_document_title_parts');
