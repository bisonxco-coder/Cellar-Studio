<?php
if (!defined('ABSPATH')) {
	exit;
}

get_header();

if (have_posts()) {
	while (have_posts()) {
		the_post();

		$product = null;
		if (function_exists('wc_get_product')) {
			$product = wc_get_product(get_the_ID());
		}

		if ($product instanceof WC_Product) {
			cellar_studio_render_wc_product_details($product);
		} else {
			the_content();
		}
	}
}

get_footer();

