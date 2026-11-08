<?php

if (!defined('ABSPATH')) {
	exit;
}

define('CELLAR_STUDIO_THEME_VERSION', '1.0.18');
define('CELLAR_STUDIO_META_PIXEL_ID', '1695884918273232');
define('CELLAR_STUDIO_GTM_ID', 'GTM-5K9GJMPQ');

require_once get_template_directory() . '/inc/gtm.php';
require_once get_template_directory() . '/inc/legal-pages.php';
require_once get_template_directory() . '/inc/hardening.php';
require_once get_template_directory() . '/inc/seo.php';

/**
 * True when running on local XAMPP (not production).
 */
function cellar_studio_is_local_env(): bool {
	if (!isset($_SERVER['HTTP_HOST'])) {
		return false;
	}
	$host = strtolower((string) $_SERVER['HTTP_HOST']);
	return false !== strpos($host, 'localhost') || false !== strpos($host, '127.0.0.1');
}

/**
 * Rewrite legacy localhost URLs stored in the DB (after migrating from XAMPP).
 */
function cellar_studio_fix_localhost_url(string $url): string {
	if (cellar_studio_is_local_env() || $url === '') {
		return $url;
	}
	$live = 'https://cellar-studio.com';
	return str_replace(
		[
			'http://localhost/cellar-studio.com/',
			'https://localhost/cellar-studio.com/',
			'http://localhost/cellar-studio.com',
			'https://localhost/cellar-studio.com',
		],
		$live,
		$url
	);
}

function cellar_studio_fix_localhost_url_filter($url) {
	return is_string($url) ? cellar_studio_fix_localhost_url($url) : $url;
}

add_filter('wp_get_attachment_url', 'cellar_studio_fix_localhost_url_filter');
add_filter('script_loader_src', 'cellar_studio_fix_localhost_url_filter');
add_filter('style_loader_src', 'cellar_studio_fix_localhost_url_filter');
add_filter('the_content', 'cellar_studio_fix_localhost_url_filter');

function cellar_studio_setup() {
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
	add_theme_support('woocommerce');

	register_nav_menus([
		'primary' => __('Primary Menu', 'cellar-studio'),
		'footer' => __('Footer Menu', 'cellar-studio'),
	]);
}
add_action('after_setup_theme', 'cellar_studio_setup');

function cellar_studio_theme_uri(string $path = ''): string {
	$base = get_template_directory_uri();
	$path = ltrim($path, '/');
	return $path ? $base . '/' . $path : $base;
}

function cellar_studio_asset(string $path): string {
	return cellar_studio_theme_uri('assets/' . ltrim($path, '/'));
}

/**
 * Contact page detection (slug, template, or queried post).
 */
function cellar_studio_is_contact_page(): bool {
	if (is_admin()) {
		return false;
	}
	if (is_page('contact')) {
		return true;
	}
	if (is_page_template('page-templates/page-contact.php')) {
		return true;
	}
	$queried = get_queried_object();
	return $queried instanceof WP_Post
		&& $queried->post_type === 'page'
		&& $queried->post_name === 'contact';
}

/**
 * AJAX endpoint for contact / consultation forms (avoids WAF blocks on /mailer.php).
 */
function cellar_studio_mailer_endpoint(): string {
	return admin_url('admin-ajax.php?action=cellar_studio_mailer');
}

function cellar_studio_handle_mailer_ajax(): void {
	if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
		wp_send_json_error(['message' => 'Invalid request.'], 405);
	}

	$name = sanitize_text_field(wp_unslash($_POST['name'] ?? ''));
	$phone = sanitize_text_field(wp_unslash($_POST['phone'] ?? ''));
	$phone_prefix = sanitize_text_field(wp_unslash($_POST['phone_prefix'] ?? ''));
	$email = sanitize_email(wp_unslash($_POST['email'] ?? ''));
	$message = sanitize_textarea_field(wp_unslash($_POST['message'] ?? ''));
	$page = sanitize_text_field(wp_unslash($_POST['page'] ?? ''));
	$source = sanitize_text_field(wp_unslash($_POST['source'] ?? ''));
	$property_type = sanitize_text_field(wp_unslash($_POST['property_type'] ?? ''));
	$location = sanitize_text_field(wp_unslash($_POST['location'] ?? ''));

	$allowed_property_types = [
		'Private Villa',
		'Apartment / Penthouse',
		'Hospitality / Restaurant',
		'Commercial',
		'Other',
	];
	if ($property_type !== '' && !in_array($property_type, $allowed_property_types, true)) {
		$property_type = '';
	}

	if ($name === '' || $phone === '' || $email === '') {
		wp_send_json_error(['message' => 'Please fill in all required fields.'], 400);
	}

	try {
		$zoho_file = get_template_directory() . '/integrations/zoho-crm.php';
		if (file_exists($zoho_file)) {
			require_once $zoho_file;
		}

		if (!function_exists('cellar_studio_zoho_is_configured') || !cellar_studio_zoho_is_configured()) {
			wp_send_json_error(['message' => 'Zoho CRM is not configured yet.'], 500);
		}

		cellar_studio_zoho_create_lead([
			'name' => $name,
			'phone' => $phone,
			'phone_prefix' => $phone_prefix,
			'email' => $email,
			'message' => $message,
			'page' => $page,
			'source' => $source,
			'property_type' => $property_type,
			'location' => $location,
		]);

		wp_send_json_success(['message' => 'Sent successfully.']);
	} catch (\Throwable $e) {
		error_log('Cellar Studio Zoho mailer: ' . $e->getMessage());
		wp_send_json_error(['message' => 'Could not send. Please try again.'], 500);
	}
}
add_action('wp_ajax_cellar_studio_mailer', 'cellar_studio_handle_mailer_ajax');
add_action('wp_ajax_nopriv_cellar_studio_mailer', 'cellar_studio_handle_mailer_ajax');

function cellar_studio_enqueue_assets() {
	$ver = CELLAR_STUDIO_THEME_VERSION;

	// External libs (same as template).
	wp_enqueue_style('cellar-studio-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', [], '5.3.3');
	wp_enqueue_style('cellar-studio-swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', [], '11');
	wp_enqueue_style('cellar-studio-aos', 'https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css', [], '2.3.4');

	// Theme CSS (copied from template).
	wp_enqueue_style('cellar-studio-style', cellar_studio_asset('css/style.css'), ['cellar-studio-bootstrap', 'cellar-studio-swiper', 'cellar-studio-aos'], $ver);
	wp_enqueue_style('cellar-studio-responsive', cellar_studio_asset('css/responsive.css'), ['cellar-studio-style'], $ver);

	// External JS libs.
	wp_enqueue_script('cellar-studio-bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', [], '5.3.3', true);
	wp_enqueue_script('cellar-studio-swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', [], '11', true);
	wp_enqueue_script('cellar-studio-aos', 'https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js', [], '2.3.4', true);

	// Theme JS (copied from template).
	wp_enqueue_script('cellar-studio-main', cellar_studio_asset('js/main.js'), ['cellar-studio-bootstrap', 'cellar-studio-swiper', 'cellar-studio-aos'], $ver, true);

	if (cellar_studio_is_contact_page()) {
		wp_enqueue_script('jquery');
		wp_enqueue_script('cellar-studio-notify', cellar_studio_asset('js/notify.js'), ['jquery'], $ver, true);
	}
}
add_action('wp_enqueue_scripts', 'cellar_studio_enqueue_assets');

function cellar_studio_template_part_html(string $slug, ?string $name = null, array $args = []): string {
	ob_start();
	get_template_part($slug, $name, $args);
	return (string) ob_get_clean();
}

/**
 * Replace the first div block that contains a given class (nested div-safe).
 */
function cellar_studio_replace_div_by_class(string $html, string $className, string $innerHtml): string {
	$pattern = '/<div\s+class="[^"]*\b' . preg_quote($className, '/') . '\b[^"]*"[^>]*>/i';
	if (!preg_match($pattern, $html, $openMatch, PREG_OFFSET_CAPTURE)) {
		return $html;
	}

	$openTag = $openMatch[0][0];
	$start = (int) $openMatch[0][1];
	$pos = $start + strlen($openTag);
	$depth = 1;
	$len = strlen($html);

	while ($pos < $len && $depth > 0) {
		if (!preg_match('/<\/?div\b[^>]*>/i', $html, $tagMatch, PREG_OFFSET_CAPTURE, $pos)) {
			break;
		}

		$tag = $tagMatch[0][0];
		$pos = (int) $tagMatch[0][1] + strlen($tag);

		if (stripos($tag, '</div') === 0) {
			$depth--;
		} elseif (!preg_match('/\/\s*>$/', $tag)) {
			$depth++;
		}
	}

	return substr($html, 0, $start) . $openTag . $innerHtml . '</div>' . substr($html, $pos);
}

function cellar_studio_rewrite_legacy_html(string $html, array $opts = []): string {
	$navTheme = $opts['navTheme'] ?? 'dark';
	$navbar = cellar_studio_legacy_include_html('includes/navbar.php', ['navTheme' => $navTheme]);
	if ($navbar === '') {
		// Fallback to WP navbar if legacy navbar is missing.
		$navbar = cellar_studio_template_part_html('template-parts/navbar', null, ['navTheme' => $navTheme]);
	}
	// Prefer explicit collection from the legacy template file (navbar/footer text breaks HTML sniffing).
	$defaultCollection = $opts['default_collection'] ?? cellar_studio_wc_collection_for_legacy_file((string) ($opts['legacyFile'] ?? ''));
	if (!$defaultCollection) {
		$defaultCollection = cellar_studio_wc_collection_for_page_slug();
	}
	if (!$defaultCollection) {
		$defaultCollection = 'swisscave';
	}

	$wcCollections = cellar_studio_template_part_html('template-parts/sections/wc-collections', null, [
		'default_collection' => $defaultCollection,
	]);
	$wcCollections = cellar_studio_wc_strip_collection_filter_ui($wcCollections);
	$wpBlogArchive = cellar_studio_template_part_html('template-parts/sections/wp-blog-archive');
	$wpBlogLatest4 = cellar_studio_template_part_html('template-parts/sections/wp-blog-latest');
	$wpBlogRecommended = cellar_studio_template_part_html('template-parts/sections/wp-blog-recommended');
	$wpBlogHotTopics = cellar_studio_template_part_html('template-parts/sections/wp-blog-hot-topics');
	$homeCollectionCards = cellar_studio_template_part_html('template-parts/sections/home-collection-cards');

	// Strip PHP tags that might still exist in legacy templates.
	$html = preg_replace('/<\?(php)?[\s\S]*?\?>/i', '', $html) ?? $html;

	// Replace the navbar layer contents with WP navbar (nested div-safe).
	$html = cellar_studio_replace_div_by_class($html, 'hero-nav-layer', $navbar);
	// Product inner page legacy template uses `.product-hero-nav` instead of `.hero-nav-layer`.
	$html = cellar_studio_replace_div_by_class($html, 'product-hero-nav', $navbar);

	// Replace WooCommerce collections placeholder (home page).
	$html = str_replace('<!-- CELLAR_WC_COLLECTIONS -->', $wcCollections, $html);
	// Replace WP blog archive placeholder (blog page).
	$html = str_replace('<!-- CELLAR_WP_BLOG_ARCHIVE -->', $wpBlogArchive, $html);
	// Replace WP latest posts placeholder (home page news section).
	$html = str_replace('<!-- CELLAR_WP_BLOG_LATEST_4 -->', $wpBlogLatest4, $html);
	// Replace recommended posts placeholder (single post page).
	$html = str_replace('<!-- CELLAR_WP_BLOG_RECOMMENDED -->', $wpBlogRecommended, $html);
	// Replace hot topics placeholder (single post sidebar).
	$html = str_replace('<!-- CELLAR_WP_BLOG_HOT_TOPICS -->', $wpBlogHotTopics, $html);
	// Replace homepage collection cards section.
	$html = str_replace('<!-- CELLAR_HOME_COLLECTION_CARDS -->', $homeCollectionCards, $html);

	$replacements = [
		'src="img/' => 'src="' . cellar_studio_asset('img/') ,
		'src=\'img/' => 'src=\'' . cellar_studio_asset('img/'),
		'href="img/' => 'href="' . cellar_studio_asset('img/'),
		'href=\'img/' => 'href=\'' . cellar_studio_asset('img/'),
		'src="video/' => 'src="' . cellar_studio_asset('video/'),
		'src=\'video/' => 'src=\'' . cellar_studio_asset('video/'),
		'poster="img/' => 'poster="' . cellar_studio_asset('img/'),
		'action="mailer.php"' => 'action="' . esc_url(cellar_studio_mailer_endpoint()) . '"',
		'<form class="contact-page-form js-mailer-form"' => '<form id="contactForm" class="contact-page-form js-mailer-form"',
	];
	$html = strtr($html, $replacements);

	// Rewrite legacy internal links (static .php) to pretty WP URLs.
	$linkMap = [
		'index.php' => home_url('/'),
		'about.php' => home_url('/about/'),
		'bespoke.php' => home_url('/bespoke/'),
		'contact.php' => home_url('/contact/'),
		'thank-you.php' => home_url('/thank-you/'),
		'thank-you-bespoke.php' => home_url('/thank-you-bespoke/'),
		'thank-you-wine-fridge.php' => home_url('/thank-you-wine-fridge/'),
		'thank-you-cigar-humidors.php' => home_url('/thank-you-cigar-humidors/'),
		'blog.php' => home_url('/blog/'),
		'cigar-humidors.php' => home_url('/cigar-humidors/'),
		'wine-fridge.php' => home_url('/wine-fridge/'),
		'wine-racking-solutions.php' => home_url('/wine-racking-solutions/'),
		'product-details.php' => function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/shop/'),
		'privacy-policy.php' => home_url('/privacy-policy/'),
		'terms-and-conditions.php' => home_url('/terms-and-conditions/'),
	];

	foreach ($linkMap as $from => $to) {
		$toUrl = esc_url($to);
		$html = preg_replace(
			'/href=(["\'])' . preg_quote($from, '/') . '((?:#[^"\']*)?)\1/i',
			'href=$1' . $toUrl . '$2$1',
			$html
		) ?? $html;
	}

	$html = cellar_studio_wc_strip_collection_filter_ui($html);
	if (function_exists('cellar_studio_strip_hidden_spam_links')) {
		$html = cellar_studio_strip_hidden_spam_links($html);
	}

	return $html;
}

/**
 * Remove legacy collection filter buttons from rendered HTML.
 * Works even when an older wc-collections.php is still cached on the server.
 */
function cellar_studio_wc_strip_collection_filter_ui(string $html): string {
	$html = preg_replace(
		'~<div class="collection-tabs\b[^"]*"[^>]*>[\s\S]*?</div>~i',
		'',
		$html
	) ?? $html;

	return $html;
}

function cellar_studio_legacy_include_html(string $legacyRelativeFile, array $vars = []): string {
	$legacyRelativeFile = ltrim($legacyRelativeFile, '/');
	$legacyPath = trailingslashit(get_template_directory()) . 'legacy/' . $legacyRelativeFile;

	if (!file_exists($legacyPath)) {
		return '';
	}

	// Provide variables to legacy includes when useful.
	if (!empty($vars)) {
		extract($vars, EXTR_SKIP);
	}

	if (!defined('CELLAR_FRONTEND_BRIDGE')) {
		define('CELLAR_FRONTEND_BRIDGE', true);
	}

	ob_start();
	try {
		include $legacyPath;
	} catch (\Throwable $e) {
		ob_end_clean();
		return '';
	}
	return (string) ob_get_clean();
}

function cellar_studio_render_legacy_template(string $legacyFile, array $opts = []): void {
	$legacyFile = ltrim($legacyFile, '/');
	$themeLegacyPath = trailingslashit(get_template_directory()) . 'legacy/' . $legacyFile;
	$legacyPath = $themeLegacyPath;

	if (!file_exists($legacyPath)) {
		echo '<!-- Legacy template missing in theme: ' . esc_html($legacyFile) . ' -->';
		return;
	}

	// Execute legacy PHP and capture output (more reliable than string parsing).
	if (!defined('CELLAR_FRONTEND_BRIDGE')) {
		define('CELLAR_FRONTEND_BRIDGE', true);
	}

	ob_start();
	try {
		include $legacyPath;
	} catch (\Throwable $e) {
		ob_end_clean();
		echo '<!-- Legacy template error: ' . esc_html($e->getMessage()) . ' -->';
		return;
	}
	$raw = (string) ob_get_clean();

	// Extract body content only.
	$body = $raw;
	$posBody = stripos($raw, '<body');
	if ($posBody !== false) {
		$posStart = stripos($raw, '>', $posBody);
		if ($posStart !== false) {
			$body = substr($raw, $posStart + 1);
		}
	}
	$posEnd = stripos($body, '</body>');
	if ($posEnd !== false) {
		$body = substr($body, 0, $posEnd);
	}

	// Avoid duplicated footer from legacy templates.
	$body = preg_replace('~<footer[\s\S]*$~i', '', $body) ?? $body;

	$collection = cellar_studio_wc_collection_for_legacy_file($legacyFile);
	if ($collection) {
		$opts['default_collection'] = $collection;
	}
	$opts['legacyFile'] = $legacyFile;

	echo cellar_studio_rewrite_legacy_html($body, $opts);
}

function cellar_studio_capture_woocommerce_add_to_cart(): string {
	if (!function_exists('woocommerce_template_single_add_to_cart')) return '';
	ob_start();
	woocommerce_template_single_add_to_cart();
	return (string) ob_get_clean();
}

function cellar_studio_whatsapp_product_cta(WC_Product $product): string {
	$phone = (string) get_option('cellar_studio_whatsapp_phone', '');
	$phone = preg_replace('/[^\d]/', '', $phone) ?? '';

	$link = $product->get_permalink();
	$name = $product->get_name();
	$msg = "Hello, I'm interested in: {$name}\n{$link}";

	$waUrl = $phone !== ''
		? 'https://wa.me/' . rawurlencode($phone) . '?text=' . rawurlencode($msg)
		: 'https://wa.me/?text=' . rawurlencode($msg);

	return '<a href="' . esc_url($waUrl) . '" class="btn btn-dark w-100 rounded-pill product-summary-cta mt-4" target="_blank" rel="noopener">Contact on WhatsApp</a>';
}

function cellar_studio_capture_woocommerce_variations_form(WC_Product $product): string {
	if (!$product->is_type('variable')) return '';
	if (!function_exists('woocommerce_variable_add_to_cart')) return '';
	ob_start();
	woocommerce_variable_add_to_cart();
	return (string) ob_get_clean();
}

function cellar_studio_wc_gallery_slides(WC_Product $product): string {
	$ids = [];
	$featured = (int) $product->get_image_id();
	if ($featured) $ids[] = $featured;
	$gallery = $product->get_gallery_image_ids();
	if (is_array($gallery)) $ids = array_merge($ids, array_map('intval', $gallery));

	$ids = array_values(array_unique(array_filter($ids)));
	if (empty($ids)) {
		$src = wc_placeholder_img_src('large');
		$name = $product->get_name();
		return '<div class="swiper-slide"><div class="product-gallery-item"><img src="' . esc_url($src) . '" alt="' . esc_attr($name) . '" class="product-main-image"></div></div>';
	}

	$out = '';
	$name = $product->get_name();
	foreach ($ids as $i => $id) {
		$src = wp_get_attachment_image_url($id, 'large');
		if (!$src) continue;
		$alt = $name . ' view ' . ($i + 1);
		$out .= '<div class="swiper-slide"><div class="product-gallery-item"><img src="' . esc_url($src) . '" alt="' . esc_attr($alt) . '" class="product-main-image"></div></div>';
	}
	return $out;
}

function cellar_studio_wc_specs_table(WC_Product $product): string {
	$preferred = [
		'pa_product-type',
		'pa_product_type',
		'pa_type',
		'pa_capacity',
		'pa_humidity-control',
		'pa_interior',
		'pa_finish',
		'pa_installation',
		'pa_temperature-zones',
		'pa_temperature_zones',
		'pa_color',
	];

	$rows = '';
	$used = [];

	$allAttrs = $product->get_attributes();

	// Render preferred attributes first (if present + visible + not empty).
	foreach ($preferred as $tax) {
		if (!isset($allAttrs[$tax])) continue;
		$attr = $allAttrs[$tax];
		if (!($attr instanceof WC_Product_Attribute)) continue;
		if (!$attr->get_visible()) continue;

		$value = $product->get_attribute($tax);
		$value = is_string($value) ? trim($value) : '';
		if ($value === '') continue;

		$label = wc_attribute_label($tax);
		$rows .= '<div class="product-spec-table-row"><span>' . esc_html($label) . '</span><span>' . esc_html($value) . '</span></div>';
		$used[$tax] = true;
	}

	// Then render any other visible attributes.
	foreach ($allAttrs as $name => $attr) {
		if (isset($used[$name])) continue;
		if (!($attr instanceof WC_Product_Attribute)) continue;
		if (!$attr->get_visible()) continue;

		$value = $product->get_attribute($name);
		$value = is_string($value) ? trim($value) : '';
		if ($value === '') continue;

		$label = wc_attribute_label($name);
		$rows .= '<div class="product-spec-table-row"><span>' . esc_html($label) . '</span><span>' . esc_html($value) . '</span></div>';
	}

	if ($rows === '') {
		return '<div class="product-spec-table"><div class="product-spec-table-row"><span>Details</span><span>On request</span></div></div>';
	}

	return '<div class="product-spec-table">' . $rows . '</div>';
}

/**
 * Placeholder when a home product card field has no WooCommerce data.
 */
function cellar_studio_wc_card_no_data(): string {
	return esc_html__('NO DATA', 'cellar-studio');
}

/**
 * Color options for card swatches: variation colors, else global pa_color text.
 *
 * @return array<int, array{slug:string,label:string}>
 */
function cellar_studio_wc_product_color_options(WC_Product $product): array {
	$out = [];
	if ($product->is_type('variable')) {
		/** @var WC_Product_Variable $product */
		$attrs = $product->get_variation_attributes();
		if (!is_array($attrs) || $attrs === []) {
			return [];
		}
		$attrKey = '';
		foreach (array_keys($attrs) as $k) {
			if ($k === 'attribute_pa_color' || str_ends_with((string) $k, '_pa_color')) {
				$attrKey = (string) $k;
				break;
			}
		}
		if ($attrKey === '') {
			$attrKey = (string) array_key_first($attrs);
		}
		if ($attrKey === '' || empty($attrs[$attrKey]) || !is_array($attrs[$attrKey])) {
			return [];
		}
		$taxOrName = preg_replace('/^attribute_/', '', $attrKey) ?? $attrKey;
		foreach ($attrs[$attrKey] as $value) {
			$value = (string) $value;
			if ($value === '') {
				continue;
			}
			$label = $value;
			if (taxonomy_exists($taxOrName)) {
				$term = get_term_by('slug', $value, $taxOrName);
				if ($term && !is_wp_error($term) && isset($term->name)) {
					$label = (string) $term->name;
				}
			}
			$out[] = ['slug' => $value, 'label' => $label];
		}
		return $out;
	}

	$raw = $product->get_attribute('pa_color');
	$raw = is_string($raw) ? trim($raw) : '';
	if ($raw === '') {
		return [];
	}
	foreach (array_map('trim', explode(',', $raw)) as $p) {
		if ($p === '') {
			continue;
		}
		$out[] = ['slug' => sanitize_title($p), 'label' => $p];
	}
	return $out;
}

function cellar_studio_wc_swatch_hex_for_slug(string $slug): ?string {
	$s = strtolower($slug);
	static $map = [
		'taupe' => '#8f8278',
		'grey' => '#7a7874',
		'gray' => '#7a7874',
		'deep-red' => '#6b1220',
		'red' => '#7a1420',
		'burgundy' => '#4a1520',
		'forest-green' => '#1d4a38',
		'green' => '#0f6b50',
		'black' => '#111111',
		'golden' => '#c8a24a',
		'gold' => '#c8a24a',
		'silver' => '#b8b8b8',
		'white' => '#f1f1f1',
		'sand' => '#d5c8b4',
		'brown' => '#8b4a1f',
		'wood' => '#b07a43',
		'champagne' => '#d7c7a5',
		'carbon' => '#1b1b1b',
		'carbon-fibre' => '#1b1b1b',
		'carbon-fiber' => '#1b1b1b',
	];
	return $map[$s] ?? null;
}

function cellar_studio_wc_card_swatch_span(string $slug, string $label): string {
	$hex = cellar_studio_wc_swatch_hex_for_slug($slug);
	$style = $hex !== null && $hex !== '' ? ' style="background-color:' . esc_attr($hex) . ';"' : '';
	$dc = $hex === null ? ' data-color="' . esc_attr($slug) . '"' : '';
	return '<span class="product-swatch product-swatch--card"' . $dc . $style . ' role="img" aria-label="' . esc_attr($label) . '"></span>';
}

function cellar_studio_wc_card_available_stock_text(WC_Product $product): string {
	foreach (['pa_available-stock', 'pa_stock-availability', 'pa_availability'] as $tax) {
		$v = $product->get_attribute($tax);
		$v = is_string($v) ? trim($v) : '';
		if ($v !== '') {
			return $v;
		}
	}

	// Custom (non-global) attribute fallback.
	foreach (['available stock', 'Available stock', 'availability', 'Availability'] as $name) {
		$v = $product->get_attribute($name);
		$v = is_string($v) ? trim($v) : '';
		if ($v !== '') {
			return $v;
		}
	}
	$meta = $product->get_meta('cellar_available_stock');
	$meta = is_string($meta) ? trim($meta) : '';
	if ($meta !== '') {
		return $meta;
	}
	$av = $product->get_availability();
	if (is_array($av) && !empty($av['availability'])) {
		$t = trim(wp_strip_all_tags((string) $av['availability']));
		if ($t !== '') {
			return $t;
		}
	}

	// Final fallback: use WooCommerce stock status so "in stock" always shows.
	if (method_exists($product, 'get_stock_status')) {
		$status = (string) $product->get_stock_status(); // instock|outofstock|onbackorder
		if ($status === 'instock') {
			return esc_html__('In stock', 'cellar-studio');
		}
		if ($status === 'onbackorder') {
			return esc_html__('Available on backorder', 'cellar-studio');
		}
		if ($status === 'outofstock') {
			return esc_html__('Out of stock', 'cellar-studio');
		}
	}

	return '';
}

/**
 * Read a product attribute from multiple possible keys (global pa_* or custom names).
 *
 * @param string[] $keys
 */
function cellar_studio_wc_attr_first(WC_Product $product, array $keys): string {
	foreach ($keys as $k) {
		$v = $product->get_attribute((string) $k);
		$v = is_string($v) ? trim($v) : '';
		if ($v !== '') {
			return $v;
		}
	}
	return '';
}

/**
 * Home / collection product card: fixed attribute rows + price; missing values show NO DATA.
 *
 * @param int $maxRows Deprecated; full card is always rendered.
 */
function cellar_studio_wc_card_specs(WC_Product $product, int $maxRows = 0): string {
	unset($maxRows);

	$type = cellar_studio_wc_attr_first($product, ['pa_product-type', 'pa_product_type', 'pa_type', 'product-type', 'Product Type', 'product type', 'type', 'Type']);
	$cap = cellar_studio_wc_attr_first($product, ['pa_capacity', 'capacity', 'Capacity']);
	$temp = cellar_studio_wc_attr_first($product, ['pa_temperature', 'temperature', 'Temperature', 'pa_temp', 'temp', 'Temp']);
	$tempZones = cellar_studio_wc_attr_first($product, ['pa_temperature-zones', 'pa_temperature_zones', 'temperature zones', 'Temperature Zones', 'temperature-zones', 'Temperature-Zones']);
	$hum = cellar_studio_wc_attr_first($product, ['pa_humidity-control', 'humidity control', 'Humidity Control', 'humidity-control', 'Humidity-Control']);
	$finish = cellar_studio_wc_attr_first($product, ['pa_finish', 'finish', 'Finish']);

	$colorOpts = cellar_studio_wc_product_color_options($product);
	$colorHtml = '';
	if ($colorOpts !== []) {
		$colorHtml = '<span class="product-swatches product-swatches--card" role="list">';
		foreach ($colorOpts as $o) {
			$colorHtml .= cellar_studio_wc_card_swatch_span($o['slug'], $o['label']);
		}
		$colorHtml .= '</span>';
	}

	$stock = cellar_studio_wc_card_available_stock_text($product);

	$priceHtml = $product->get_price_html();
	$pricePlain = is_string($priceHtml) ? trim(wp_strip_all_tags($priceHtml)) : '';

	$rows = [];
	if ($type !== '') {
		$rows[] = ['label' => __('Type', 'cellar-studio'), 'value' => esc_html($type), 'class' => ''];
	}
	if ($cap !== '') {
		$rows[] = ['label' => __('Capacity', 'cellar-studio'), 'value' => esc_html($cap), 'class' => ''];
	}
	if ($temp !== '') {
		$rows[] = ['label' => __('Temperature', 'cellar-studio'), 'value' => esc_html($temp), 'class' => ''];
	}
	if ($tempZones !== '') {
		$rows[] = ['label' => __('Temperature Zones', 'cellar-studio'), 'value' => esc_html($tempZones), 'class' => ''];
	}
	if ($hum !== '') {
		$rows[] = ['label' => __('Humidity Control', 'cellar-studio'), 'value' => esc_html($hum), 'class' => ''];
	}
	if ($colorHtml !== '') {
		$rows[] = ['label' => __('Color', 'cellar-studio'), 'value' => $colorHtml, 'class' => 'product-spec-row--color'];
	}
	if ($finish !== '') {
		$rows[] = ['label' => __('Finish', 'cellar-studio'), 'value' => esc_html($finish), 'class' => ''];
	}
	if ($stock !== '') {
		$rows[] = ['label' => __('Available stock', 'cellar-studio'), 'value' => esc_html($stock), 'class' => ''];
	}
	if ($pricePlain !== '') {
		$rows[] = ['label' => __('Price', 'cellar-studio'), 'value' => '', 'class' => 'product-spec-row--price'];
	}

	if (empty($rows)) {
		return '';
	}

	$out = '<div class="product-specs">';
	foreach ($rows as $r) {
		$valueCell = $r['value'];
		if ($r['class'] === 'product-spec-row--price') {
			$valueCell = '<span class="product-spec-price-value">' . wp_kses_post($priceHtml) . '</span>';
		}
		$rowClass = $r['class'] !== '' ? ' ' . esc_attr($r['class']) : '';
		$out .= '<div class="product-spec-row' . $rowClass . '"><span>' . esc_html($r['label']) . '</span><span>' . $valueCell . '</span></div>';
	}
	$out .= '</div>';
	return $out;
}

/**
 * Resolve collection key from a legacy template filename.
 */
function cellar_studio_wc_collection_for_legacy_file(string $legacyFile): ?string {
	$map = [
		'wine-fridge.php' => 'swisscave',
		'cigar-humidors.php' => 'humidors',
		'wine-racking-solutions.php' => 'racking',
	];
	return $map[basename($legacyFile)] ?? null;
}

/**
 * Resolve collection key from the current WP page slug (fallback).
 */
function cellar_studio_wc_collection_for_page_slug(): ?string {
	if (!is_singular('page')) {
		return null;
	}
	$slug = (string) get_post_field('post_name', get_queried_object_id());
	$map = [
		'wine-fridge' => 'swisscave',
		'cigar-humidors' => 'humidors',
		'wine-racking-solutions' => 'racking',
	];
	return $map[$slug] ?? null;
}

/**
 * Map page collection keys to WooCommerce product_brand slugs.
 *
 * @return array<string, string>
 */
function cellar_studio_wc_collection_brand_map(): array {
	return [
		'swisscave' => 'swisscave',
		'humidors' => 'raching',
		'racking' => 'cellar-studio',
	];
}

/**
 * Fetch products for a curated collection section (filtered by brand, with category fallback).
 *
 * @return WC_Product[]
 */
function cellar_studio_wc_products_for_collection(string $collection, int $limit = -1): array {
	if (!function_exists('wc_get_products')) {
		return [];
	}

	$collection = sanitize_key($collection);
	$brandMap = cellar_studio_wc_collection_brand_map();
	$brandSlug = $brandMap[$collection] ?? $collection;

	$query = [
		'status' => 'publish',
		'limit' => $limit,
		'orderby' => 'date',
		'order' => 'DESC',
	];

	if (taxonomy_exists('product_brand') && term_exists($brandSlug, 'product_brand')) {
		$query['tax_query'] = [
			[
				'taxonomy' => 'product_brand',
				'field' => 'slug',
				'terms' => [$brandSlug],
			],
		];
	} elseif (term_exists($collection, 'product_cat')) {
		$query['category'] = [$collection];
	}

	$products = wc_get_products($query);
	return is_array($products) ? $products : [];
}

function cellar_studio_wc_dimensions_table(WC_Product $product): string {
	// Many variable products store dimensions on variations, not the parent.
	$dimSource = $product;
	if ($product->is_type('variable')) {
		/** @var WC_Product_Variable $product */
		$childIds = $product->get_children();
		if (is_array($childIds)) {
			foreach ($childIds as $vid) {
				$v = wc_get_product($vid);
				if (!($v instanceof WC_Product)) continue;
				$vd = $v->get_dimensions(false);
				$vl = is_array($vd) ? trim((string) ($vd['length'] ?? '')) : '';
				$vw = is_array($vd) ? trim((string) ($vd['width'] ?? '')) : '';
				$vh = is_array($vd) ? trim((string) ($vd['height'] ?? '')) : '';
				$vweight = $v->get_weight();
				$vweight = is_string($vweight) ? trim($vweight) : '';
				if ($vl !== '' || $vw !== '' || $vh !== '' || $vweight !== '') {
					$dimSource = $v;
					break;
				}
			}
		}
	}

	$dim = $dimSource->get_dimensions(false);
	$l = $dim['length'] ?? '';
	$w = $dim['width'] ?? '';
	$h = $dim['height'] ?? '';

	$unit = get_option('woocommerce_dimension_unit', 'cm');
	$rows = '';

	if ($l !== '') $rows .= '<div class="product-spec-table-row"><span>Length</span><span>' . esc_html($l . ' ' . $unit) . '</span></div>';
	if ($w !== '') $rows .= '<div class="product-spec-table-row"><span>Width</span><span>' . esc_html($w . ' ' . $unit) . '</span></div>';
	if ($h !== '') $rows .= '<div class="product-spec-table-row"><span>Height</span><span>' . esc_html($h . ' ' . $unit) . '</span></div>';

	$weight = $dimSource->get_weight();
	$weight = is_string($weight) ? trim($weight) : '';
	$wUnit = get_option('woocommerce_weight_unit', 'kg');
	if ($weight !== '') {
		$rows .= '<div class="product-spec-table-row"><span>Weight</span><span>' . esc_html($weight . ' ' . $wUnit) . '</span></div>';
	}

	// Optional attributes some products have (manual fields).
	$volume = cellar_studio_wc_attr_first($dimSource, ['pa_volume', 'volume', 'Volume']);
	if ($volume !== '') {
		$rows .= '<div class="product-spec-table-row"><span>Volume</span><span>' . esc_html($volume) . '</span></div>';
	}

	$netWeight = cellar_studio_wc_attr_first($dimSource, ['pa_net-weight', 'pa_net_weight', 'net weight', 'Net weight', 'Net Weight']);
	if ($netWeight !== '') {
		$rows .= '<div class="product-spec-table-row"><span>Net weight</span><span>' . esc_html($netWeight) . '</span></div>';
	}

	if ($rows === '') {
		return '<div class="product-spec-table"><div class="product-spec-table-row"><span>Dimensions</span><span>On request</span></div></div>';
	}

	return '<div class="product-spec-table">' . $rows . '</div>';
}

function cellar_studio_wc_similar_products_slides(WC_Product $product): string {
	if (!function_exists('wc_get_related_products')) return '';
	$ids = wc_get_related_products($product->get_id(), 8);
	if (empty($ids)) return '';

	$out = '';
	foreach ($ids as $id) {
		$p = wc_get_product($id);
		if (!$p) continue;
		$img = $p->get_image_id() ? wp_get_attachment_image_url($p->get_image_id(), 'large') : wc_placeholder_img_src('large');
		$name = $p->get_name();
		$price = $p->get_price_html();
		$link = $p->get_permalink();

		$out .= '<div class="swiper-slide"><article class="similar-product-card">';
		$out .= '<div class="similar-product-image-wrap">';
		$out .= '<a href="' . esc_url($link) . '"><img src="' . esc_url($img) . '" alt="' . esc_attr($name) . '" class="similar-product-image" loading="lazy" decoding="async"></a>';
		$out .= '<button class="similar-product-fav" type="button" aria-label="Add to favorites">♡</button>';
		$out .= '</div>';
		$out .= '<h3 class="similar-product-name"><a href="' . esc_url($link) . '" style="color: inherit;">' . esc_html($name) . '</a></h3>';
		$out .= '<p class="similar-product-price">' . wp_kses_post($price) . '</p>';
		$out .= '</article></div>';
	}
	return $out;
}

function cellar_studio_wc_variation_swatches_html(WC_Product $product): string {
	if (!function_exists('wc_attribute_label')) return '';
	if (!$product->is_type('variable')) return '';

	/** @var WC_Product_Variable $product */
	$attrs = $product->get_variation_attributes(); // ['attribute_pa_color' => ['golden', ...], ...]
	if (empty($attrs) || !is_array($attrs)) return '';

	// Prefer color if it exists; otherwise fallback to the first variation attribute.
	$attrKey = '';
	foreach (array_keys($attrs) as $k) {
		if ($k === 'attribute_pa_color' || str_ends_with((string) $k, '_pa_color')) {
			$attrKey = (string) $k;
			break;
		}
	}
	if ($attrKey === '') {
		$attrKey = (string) array_key_first($attrs);
	}
	if ($attrKey === '' || empty($attrs[$attrKey]) || !is_array($attrs[$attrKey])) return '';

	$options = array_values(array_filter(array_map('strval', $attrs[$attrKey])));
	if (empty($options)) return '';

	// `attribute_pa_color` -> `pa_color`
	$taxOrName = preg_replace('/^attribute_/', '', $attrKey) ?? $attrKey;

	$out = '<div class="product-swatches" data-wc-variation-swatches data-attr="' . esc_attr($attrKey) . '">';
	foreach ($options as $i => $value) {
		$label = $value;
		if (taxonomy_exists($taxOrName)) {
			$term = get_term_by('slug', $value, $taxOrName);
			if ($term && !is_wp_error($term) && isset($term->name)) {
				$label = (string) $term->name;
			}
		}

		$isActive = $i === 0 ? ' is-active' : '';
		$out .= '<button type="button" class="product-swatch js-wc-swatch' . $isActive . '" data-attr="' . esc_attr($attrKey) . '" data-value="' . esc_attr($value) . '" data-color="' . esc_attr($value) . '" aria-label="' . esc_attr($label) . '"></button>';
	}
	$out .= '</div>';

	return $out;
}

function cellar_studio_render_wc_product_details(WC_Product $product): void {
	$legacyFile = 'product-details.php';

	$legacyFile = ltrim($legacyFile, '/');
	$themeLegacyPath = trailingslashit(get_template_directory()) . 'legacy/' . $legacyFile;
	$legacyPath = $themeLegacyPath;

	if (!file_exists($legacyPath)) {
		echo '<!-- Legacy template missing in theme: ' . esc_html($legacyFile) . ' -->';
		return;
	}

	// Execute legacy PHP and capture output (reliable).
	if (!defined('CELLAR_FRONTEND_BRIDGE')) {
		define('CELLAR_FRONTEND_BRIDGE', true);
	}

	ob_start();
	try {
		include $legacyPath;
	} catch (\Throwable $e) {
		ob_end_clean();
		echo '<!-- Legacy product template error: ' . esc_html($e->getMessage()) . ' -->';
		if (defined('WP_DEBUG') && WP_DEBUG) {
			error_log('[cellar-studio] legacy product template error: ' . $e->getMessage());
		}
		return;
	}
	$raw = (string) ob_get_clean();
	if (defined('WP_DEBUG') && WP_DEBUG) {
		error_log('[cellar-studio] legacy product raw length=' . strlen($raw));
	}

	$body = $raw;
	$posBody = stripos($raw, '<body');
	if (defined('WP_DEBUG') && WP_DEBUG) {
		error_log('[cellar-studio] legacy product posBody=' . ($posBody === false ? 'false' : (string) $posBody));
	}
	if ($posBody !== false) {
		$posStart = stripos($raw, '>', $posBody);
		if ($posStart !== false) {
			$body = substr($raw, $posStart + 1);
		}
	}
	$posEnd = stripos($body, '</body>');
	if (defined('WP_DEBUG') && WP_DEBUG) {
		error_log('[cellar-studio] legacy product posEnd=' . ($posEnd === false ? 'false' : (string) $posEnd));
	}
	if ($posEnd !== false) {
		$body = substr($body, 0, $posEnd);
	}
	$body = preg_replace('~<footer[\s\S]*$~i', '', $body) ?? $body;

	$titleHtml = '<h1 class="product-hero-title">' . esc_html($product->get_name()) . '</h1>';
	$priceHtml = '<p class="product-summary-price" data-original-price-html="' . esc_attr(wp_strip_all_tags((string) $product->get_price_html())) . '">' . wp_kses_post($product->get_price_html()) . '</p>';

	// Hidden variation form used for JS-driven swatches + price sync.
	$variationFormHtml = '';
	if ($product->is_type('variable')) {
		$variationFormHtml = cellar_studio_capture_woocommerce_variations_form($product);
		if ($variationFormHtml) {
			$variationFormHtml = '<div class="cellar-variation-form" aria-hidden="true" style="display:none">' . $variationFormHtml . '</div>';
		}
	}
	$priceHtml .= $variationFormHtml;

	$desc = $product->get_description();
	if (!$desc) $desc = $product->get_short_description();
	$descHtml = $desc ? '<div class="product-details-paragraph">' . wp_kses_post(wpautop($desc)) . '</div>' : '<p class="product-details-paragraph">Details available on request.</p>';

	$ctaHtml = cellar_studio_whatsapp_product_cta($product);

	$body = str_replace('<!-- CELLAR_WC_PRODUCT_TITLE -->', $titleHtml, $body);
	$body = str_replace('<!-- CELLAR_WC_PRODUCT_GALLERY_SLIDES -->', cellar_studio_wc_gallery_slides($product), $body);
	$body = str_replace('<!-- CELLAR_WC_PRODUCT_PRICE -->', $priceHtml, $body);
	$body = str_replace('<!-- CELLAR_WC_PRODUCT_DESCRIPTION -->', $descHtml, $body);
	$body = str_replace('<!-- CELLAR_WC_PRODUCT_SPECS -->', cellar_studio_wc_specs_table($product), $body);
	$body = str_replace('<!-- CELLAR_WC_PRODUCT_DIMENSIONS -->', cellar_studio_wc_dimensions_table($product), $body);
	$body = str_replace('<!-- CELLAR_WC_PRODUCT_CTA -->', $ctaHtml, $body);
	$body = str_replace('<!-- CELLAR_WC_SIMILAR_PRODUCTS -->', cellar_studio_wc_similar_products_slides($product), $body);
	$body = str_replace('<!-- CELLAR_WC_PRODUCT_SWATCHES -->', cellar_studio_wc_variation_swatches_html($product), $body);

	echo cellar_studio_rewrite_legacy_html($body, ['navTheme' => 'light']);
}

function cellar_studio_preconnect_google_fonts() {
	echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
	echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
	echo '<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">' . "\n";
}
add_action('wp_head', 'cellar_studio_preconnect_google_fonts', 1);

/**
 * Thank-you page detection (dedicated per-service confirmation pages).
 * Matches any page whose template is a page-thank-you*.php template or whose slug starts with "thank-you".
 */
function cellar_studio_is_thank_you_page(): bool {
	if (is_admin() || !is_page()) {
		return false;
	}

	$page_id = get_queried_object_id();

	$template = (string) get_page_template_slug($page_id);
	if ($template !== '' && strpos(basename($template), 'page-thank-you') === 0) {
		return true;
	}

	$slug = (string) get_post_field('post_name', $page_id);
	return $slug !== '' && strpos($slug, 'thank-you') === 0;
}

/**
 * Meta Pixel Lead content_category for the current thank-you page.
 */
function cellar_studio_meta_lead_category(): ?string {
	if (!cellar_studio_is_thank_you_page()) {
		return null;
	}

	$slug = (string) get_post_field('post_name', get_queried_object_id());

	if ($slug === 'thank-you-bespoke') {
		return 'Bespoke Lead';
	}
	if ($slug === 'thank-you-wine-fridge') {
		return 'Wine Fridge';
	}
	if ($slug === 'thank-you-cigar-humidors') {
		return 'Cigar Humidor';
	}

	// Generic /thank-you/ must not fire "Bespoke Lounge" (duplicate of Bespoke Lead).
	return null;
}

function cellar_studio_thank_you_body_class(array $classes): array {
	if (!cellar_studio_is_thank_you_page()) {
		return $classes;
	}

	$classes[] = 'thank-you-page';
	$slug = (string) get_post_field('post_name', get_queried_object_id());
	if ($slug === 'thank-you-bespoke') {
		$classes[] = 'thank-you-page--bespoke';
	} elseif ($slug === 'thank-you-wine-fridge') {
		$classes[] = 'thank-you-page--wine-fridge';
	} elseif ($slug === 'thank-you-cigar-humidors') {
		$classes[] = 'thank-you-page--cigar';
	}

	return $classes;
}
add_filter('body_class', 'cellar_studio_thank_you_body_class');

/**
 * Keep thank-you pages out of search engines (noindex, nofollow).
 * Uses the modern wp_robots filter when available, with a direct meta fallback for very old WP.
 */
function cellar_studio_wp_robots_noindex(array $robots): array {
	if (cellar_studio_is_thank_you_page()) {
		$robots['noindex'] = true;
		$robots['nofollow'] = true;
		unset($robots['index'], $robots['follow']);
	}
	return $robots;
}
add_filter('wp_robots', 'cellar_studio_wp_robots_noindex');

function cellar_studio_noindex_thank_you_fallback(): void {
	if (!function_exists('wp_robots') && cellar_studio_is_thank_you_page()) {
		echo '<meta name="robots" content="noindex, nofollow">' . "\n";
	}
}
add_action('wp_head', 'cellar_studio_noindex_thank_you_fallback', 1);

/**
 * Find a page by slug even if it is still a draft (get_page_by_path only sees published).
 */
function cellar_studio_get_page_by_slug(string $slug): ?WP_Post {
	$found = get_posts([
		'name' => $slug,
		'post_type' => 'page',
		'post_status' => ['publish', 'draft', 'pending', 'private', 'future'],
		'numberposts' => 1,
		'suppress_filters' => true,
	]);

	return isset($found[0]) && $found[0] instanceof WP_Post ? $found[0] : null;
}

function cellar_studio_activation_create_pages() {
	$pages = [
		[
			'title' => 'Home',
			'slug' => 'home',
			'template' => 'front-page.php',
			'is_front' => true,
		],
		[
			'title' => 'About',
			'slug' => 'about',
			'template' => 'page-templates/page-about.php',
		],
		[
			'title' => 'Bespoke',
			'slug' => 'bespoke',
			'template' => 'page-templates/page-bespoke.php',
		],
		[
			'title' => 'Wine Fridge',
			'slug' => 'wine-fridge',
			'template' => 'page-templates/page-wine-fridge.php',
		],
		[
			'title' => 'Wine Racking Solutions',
			'slug' => 'wine-racking-solutions',
			'template' => 'page-templates/page-wine-racking-solutions.php',
		],
		[
			'title' => 'Cigar Humidors',
			'slug' => 'cigar-humidors',
			'template' => 'page-templates/page-cigar-humidors.php',
		],
		[
			'title' => 'Contact',
			'slug' => 'contact',
			'template' => 'page-templates/page-contact.php',
		],
		[
			'title' => 'Thank You',
			'slug' => 'thank-you',
			'template' => 'page-templates/page-thank-you.php',
		],
		[
			'title' => 'Thank You - Bespoke',
			'slug' => 'thank-you-bespoke',
			'template' => 'page-templates/page-thank-you-bespoke.php',
		],
		[
			'title' => 'Thank You - Wine Fridge',
			'slug' => 'thank-you-wine-fridge',
			'template' => 'page-templates/page-thank-you-wine-fridge.php',
		],
		[
			'title' => 'Thank You - Cigar Humidor',
			'slug' => 'thank-you-cigar-humidors',
			'template' => 'page-templates/page-thank-you-cigar-humidors.php',
		],
		[
			'title' => 'Blog',
			'slug' => 'blog',
			'template' => 'page-templates/page-blog.php',
			'is_posts' => true,
		],
		[
			'title' => 'Privacy Policy',
			'slug' => 'privacy-policy',
			'template' => 'page-templates/page-legal.php',
			'content' => cellar_studio_privacy_policy_content(),
		],
		[
			'title' => 'Terms & Conditions',
			'slug' => 'terms-and-conditions',
			'template' => 'page-templates/page-legal.php',
			'content' => cellar_studio_terms_content(),
		],
	];

	$front_id = 0;
	$posts_id = 0;

	foreach ($pages as $p) {
		$existing = cellar_studio_get_page_by_slug($p['slug']);
		$page_id = $existing ? (int) $existing->ID : 0;

		if (!$page_id) {
			$insert = [
				'post_title' => $p['title'],
				'post_name' => $p['slug'],
				'post_status' => 'publish',
				'post_type' => 'page',
			];
			if (!empty($p['content'])) {
				$insert['post_content'] = $p['content'];
			}
			$page_id = wp_insert_post($insert);
		} else {
			$needs_publish = $existing instanceof WP_Post && $existing->post_status !== 'publish';
			$is_legal = in_array($p['slug'], ['privacy-policy', 'terms-and-conditions'], true);
			$content_empty = $existing instanceof WP_Post && !empty($p['content']) && trim((string) $existing->post_content) === '';
			if ($needs_publish || $content_empty || $is_legal) {
				$update = [
					'ID' => $page_id,
					'post_status' => 'publish',
				];
				if (!empty($p['content'])) {
					$update['post_content'] = $p['content'];
				}
				wp_update_post($update);
			}
		}

		if ($page_id && !empty($p['template']) && $p['template'] !== 'front-page.php') {
			update_post_meta($page_id, '_wp_page_template', $p['template']);
		}

		if (!empty($p['is_front'])) $front_id = $page_id;
		if (!empty($p['is_posts'])) $posts_id = $page_id;
	}

	if ($front_id) {
		update_option('show_on_front', 'page');
		update_option('page_on_front', $front_id);
	}
	if ($posts_id) {
		update_option('page_for_posts', $posts_id);
	}
}

add_action('after_switch_theme', 'cellar_studio_activation_create_pages');

/**
 * Create any missing theme pages (e.g. after deploying new thank-you templates).
 * Runs once per request until all required slugs exist.
 */
function cellar_studio_ensure_required_pages(): void {
	$required_slugs = [
		'thank-you',
		'thank-you-bespoke',
		'thank-you-wine-fridge',
		'thank-you-cigar-humidors',
		'privacy-policy',
		'terms-and-conditions',
	];

	$needs_create = false;
	foreach ($required_slugs as $slug) {
		$page = cellar_studio_get_page_by_slug($slug);
		if (!$page || $page->post_status !== 'publish') {
			$needs_create = true;
			break;
		}
	}

	$legal_ver = '1.0.12';
	if ($needs_create || get_option('cellar_studio_legal_pages_ver') !== $legal_ver) {
		cellar_studio_activation_create_pages();
		update_option('cellar_studio_legal_pages_ver', $legal_ver);
	}
}
add_action('init', 'cellar_studio_ensure_required_pages', 99);

/**
 * Admin utility: one-click creation of WooCommerce global attributes + common terms.
 * (Useful when WP-CLI isn't available.)
 */
function cellar_studio_wc_get_attribute_taxonomies_indexed(): array {
	if (!function_exists('wc_get_attribute_taxonomies')) return [];
	$taxes = wc_get_attribute_taxonomies();
	if (!is_array($taxes)) return [];

	$indexed = [];
	foreach ($taxes as $t) {
		if (!is_object($t)) continue;
		$slug = $t->attribute_name ?? '';
		if (!$slug) continue;
		$indexed[(string) $slug] = $t;
	}
	return $indexed;
}

function cellar_studio_wc_ensure_global_attribute(array $spec): array {
	// Returns: [created(bool), attribute_id(int), taxonomy(string), message(string)]
	if (!function_exists('wc_create_attribute')) {
		return ['created' => false, 'attribute_id' => 0, 'taxonomy' => '', 'message' => 'WooCommerce not available.'];
	}

	$label = (string) ($spec['label'] ?? '');
	$slug = (string) ($spec['slug'] ?? '');
	$type = (string) ($spec['type'] ?? 'select');
	$order_by = (string) ($spec['order_by'] ?? 'menu_order');
	$has_archives = !empty($spec['has_archives']);

	if ($label === '' || $slug === '') {
		return ['created' => false, 'attribute_id' => 0, 'taxonomy' => '', 'message' => 'Invalid attribute spec.'];
	}

	$existing = cellar_studio_wc_get_attribute_taxonomies_indexed();
	if (isset($existing[$slug])) {
		return [
			'created' => false,
			'attribute_id' => (int) ($existing[$slug]->attribute_id ?? 0),
			'taxonomy' => wc_attribute_taxonomy_name($slug),
			'message' => 'Already exists.',
		];
	}

	$id = wc_create_attribute([
		'name' => $label,
		'slug' => $slug,
		'type' => $type,
		'order_by' => $order_by,
		'has_archives' => $has_archives ? 1 : 0,
	]);

	if (is_wp_error($id)) {
		return ['created' => false, 'attribute_id' => 0, 'taxonomy' => '', 'message' => $id->get_error_message()];
	}

	delete_transient('wc_attribute_taxonomies');
	if (class_exists('WC_Post_Types')) {
		// Ensure the taxonomy exists in the current request so we can add terms right away.
		WC_Post_Types::register_taxonomies();
	}

	return [
		'created' => true,
		'attribute_id' => (int) $id,
		'taxonomy' => wc_attribute_taxonomy_name($slug),
		'message' => 'Created.',
	];
}

function cellar_studio_wc_ensure_terms(string $taxonomy, array $terms): array {
	// Returns: [createdTerms(int), skippedTerms(int), errors(array<string>)]
	$created = 0;
	$skipped = 0;
	$errors = [];

	if (!taxonomy_exists($taxonomy)) {
		return ['createdTerms' => 0, 'skippedTerms' => 0, 'errors' => ["Taxonomy missing: {$taxonomy}"]];
	}

	foreach ($terms as $t) {
		$name = is_array($t) ? (string) ($t['name'] ?? '') : (string) $t;
		$slug = is_array($t) ? (string) ($t['slug'] ?? '') : '';
		if ($name === '') continue;

		$exists = term_exists($slug !== '' ? $slug : $name, $taxonomy);
		if ($exists) {
			$skipped++;
			continue;
		}

		$args = [];
		if ($slug !== '') $args['slug'] = $slug;
		$r = wp_insert_term($name, $taxonomy, $args);
		if (is_wp_error($r)) {
			$errors[] = $r->get_error_message();
			continue;
		}
		$created++;
	}

	return ['createdTerms' => $created, 'skippedTerms' => $skipped, 'errors' => $errors];
}

function cellar_studio_register_admin_setup_page(): void {
	add_management_page(
		__('Cellar Setup', 'cellar-studio'),
		__('Cellar Setup', 'cellar-studio'),
		'manage_woocommerce',
		'cellar-setup',
		'cellar_studio_render_admin_setup_page'
	);

	add_management_page(
		__('Product Import (Cellar)', 'cellar-studio'),
		__('Product Import (Cellar)', 'cellar-studio'),
		'manage_woocommerce',
		'cellar-product-import',
		'cellar_studio_render_product_import_page'
	);

	add_management_page(
		__('CSV Converter (Cellar)', 'cellar-studio'),
		__('CSV Converter (Cellar)', 'cellar-studio'),
		'manage_woocommerce',
		'cellar-csv-converter',
		'cellar_studio_render_csv_converter_page'
	);
}
add_action('admin_menu', 'cellar_studio_register_admin_setup_page');

function cellar_studio_render_admin_setup_page(): void {
	if (!current_user_can('manage_woocommerce')) {
		wp_die(esc_html__('You do not have permission to access this page.', 'cellar-studio'));
	}

	$did = false;
	$log = [];

	if (isset($_POST['cellar_setup_run'])) {
		check_admin_referer('cellar_setup_run');
		$did = true;

		$attributes = [
			['label' => 'Type', 'slug' => 'type', 'type' => 'select', 'order_by' => 'menu_order', 'has_archives' => false],
			['label' => 'Capacity', 'slug' => 'capacity', 'type' => 'select', 'order_by' => 'menu_order', 'has_archives' => false],
			['label' => 'Humidity Control', 'slug' => 'humidity-control', 'type' => 'select', 'order_by' => 'menu_order', 'has_archives' => false],
			['label' => 'Interior', 'slug' => 'interior', 'type' => 'select', 'order_by' => 'menu_order', 'has_archives' => false],
			['label' => 'Finish', 'slug' => 'finish', 'type' => 'select', 'order_by' => 'menu_order', 'has_archives' => false],
			['label' => 'Installation', 'slug' => 'installation', 'type' => 'select', 'order_by' => 'menu_order', 'has_archives' => false],
			['label' => 'Color', 'slug' => 'color', 'type' => 'select', 'order_by' => 'menu_order', 'has_archives' => false],
			['label' => 'Ammonia Removal', 'slug' => 'ammonia-removal', 'type' => 'select', 'order_by' => 'menu_order', 'has_archives' => false],
		];

		$defaultTerms = [
			'pa_type' => [
				['name' => 'Freestanding', 'slug' => 'freestanding'],
				['name' => 'Built-in', 'slug' => 'built-in'],
				['name' => 'Wine Racking', 'slug' => 'wine-racking'],
				['name' => 'Cigar Humidor', 'slug' => 'cigar-humidor'],
			],
			'pa_finish' => [
				['name' => 'Black', 'slug' => 'black'],
				['name' => 'Stainless Steel', 'slug' => 'stainless-steel'],
				['name' => 'Walnut', 'slug' => 'walnut'],
				['name' => 'Oak', 'slug' => 'oak'],
			],
			'pa_installation' => [
				['name' => 'Freestanding', 'slug' => 'freestanding'],
				['name' => 'Built-in', 'slug' => 'built-in'],
			],
			'pa_color' => [
				['name' => 'Black', 'slug' => 'black'],
				['name' => 'White', 'slug' => 'white'],
				['name' => 'Silver', 'slug' => 'silver'],
				['name' => 'Wood', 'slug' => 'wood'],
			],
			'pa_ammonia-removal' => [
				['name' => 'With', 'slug' => 'with'],
				['name' => 'Without', 'slug' => 'without'],
			],
		];

		foreach ($attributes as $a) {
			$res = cellar_studio_wc_ensure_global_attribute($a);
			$log[] = sprintf(
				'%s (%s): %s',
				esc_html($a['label']),
				esc_html($res['taxonomy'] ?: ('pa_' . $a['slug'])),
				esc_html($res['message'])
			);

			$taxonomy = $res['taxonomy'] ?: wc_attribute_taxonomy_name($a['slug']);
			if (isset($defaultTerms[$taxonomy])) {
				$t = cellar_studio_wc_ensure_terms($taxonomy, $defaultTerms[$taxonomy]);
				$log[] = sprintf(
					'↳ terms %s: created %d, skipped %d%s',
					esc_html($taxonomy),
					(int) $t['createdTerms'],
					(int) $t['skippedTerms'],
					empty($t['errors']) ? '' : ' (errors: ' . esc_html(implode(' | ', $t['errors'])) . ')'
				);
			}
		}
	}

	echo '<div class="wrap">';
	echo '<h1>' . esc_html__('Cellar Setup', 'cellar-studio') . '</h1>';
	echo '<p>' . esc_html__('One click to create the global WooCommerce attributes used by the theme (and some common terms). Safe to run multiple times.', 'cellar-studio') . '</p>';

	if ($did) {
		echo '<div class="notice notice-success"><p><strong>' . esc_html__('Done.', 'cellar-studio') . '</strong></p></div>';
		echo '<ul style="list-style: disc; padding-left: 20px;">';
		foreach ($log as $line) {
			echo '<li>' . $line . '</li>';
		}
		echo '</ul>';
		echo '<p><em>' . esc_html__('If you don’t see the attributes immediately in Products → Attributes, refresh once.', 'cellar-studio') . '</em></p>';
	}

	echo '<form method="post">';
	wp_nonce_field('cellar_setup_run');
	echo '<p><button class="button button-primary" type="submit" name="cellar_setup_run" value="1">' . esc_html__('Create attributes now', 'cellar-studio') . '</button></p>';
	echo '</form>';
	echo '</div>';
}

function cellar_studio_norm_text(string $s): string {
	$s = trim($s);
	$s = preg_replace('/\s+/', ' ', $s) ?? $s;
	return $s;
}

function cellar_studio_slugify(string $s): string {
	$s = strtolower(trim($s));
	$s = preg_replace('/[^a-z0-9]+/i', '-', $s) ?? $s;
	$s = trim($s, '-');
	return $s ?: 'x';
}

function cellar_studio_extract_model_code(string $raw): string {
	$raw = trim((string) $raw);
	if ($raw === '') return '';

	// Common patterns: "CT48A size: ...", "DD650C ...", "CD1200(Black titanium) ...", "FJ-MG801 Dimensions: ..."
	if (preg_match('/^\s*([A-Z]{1,6}[A-Z0-9]*(?:-[A-Z0-9]+)*)/i', $raw, $m)) {
		$code = strtoupper((string) $m[1]);
		// Trim trailing separators if any.
		$code = rtrim($code, '-');
		return $code;
	}

	// Fallback: take up to first space/paren.
	$raw = preg_split('/[\s\(\[]/', $raw, 2)[0] ?? $raw;
	$raw = preg_replace('/[^A-Za-z0-9\-]/', '', $raw) ?? $raw;
	return strtoupper($raw);
}

function cellar_studio_parse_spec_to_attrs(string $spec): array {
	$attrs = [];
	$specRaw = $spec;
	$spec = str_replace(["\r\n", "\r"], "\n", $spec);

	if (preg_match('/Capacity\s*:\s*(.+)/i', $spec, $m)) {
		$attrs['pa_capacity'] = cellar_studio_norm_text($m[1]);
	} elseif (preg_match('/Approx\.\s*([0-9][0-9,\. ]+)\s*(cigars|bottles)\b/i', $spec, $m)) {
		$attrs['pa_capacity'] = cellar_studio_norm_text('Approx. ' . $m[1] . ' ' . $m[2]);
	}

	if (preg_match('/Humidity\s*control\s*range\s*:\s*(.+)/i', $spec, $m)) {
		$attrs['pa_humidity-control'] = cellar_studio_norm_text($m[1]);
	} elseif (preg_match('/Humidity\s*control\s*accuracy\s*:\s*(.+)/i', $spec, $m)) {
		$attrs['pa_humidity-control'] = cellar_studio_norm_text($m[1]);
	}

	// Keep raw spec to build descriptions later.
	$attrs['_raw_spec'] = trim($specRaw);
	return $attrs;
}

function cellar_studio_parse_config_to_attrs(string $cfg): array {
	$attrs = [];
	$cfgNorm = strtolower(cellar_studio_norm_text($cfg));
	if ($cfgNorm === '') return $attrs;

	if (strpos($cfgNorm, 'spanish cedar') !== false) {
		$attrs['pa_interior'] = 'Spanish cedar';
	}
	if (strpos($cfgNorm, 'black titanium') !== false) {
		$attrs['pa_finish'] = 'Black titanium';
	} elseif (strpos($cfgNorm, 'stainless') !== false) {
		$attrs['pa_finish'] = 'Stainless Steel';
	}

	$attrs['_raw_cfg'] = trim($cfg);
	return $attrs;
}

function cellar_studio_extract_finish_from_config(string $cfg): string {
	// Try to detect the "finish" (Gold burl / Black / Carbon fiber / etc.) from first bullet line.
	$cfg = str_replace(["\r\n", "\r"], "\n", (string) $cfg);
	$lines = array_values(array_filter(array_map('trim', explode("\n", $cfg)), static fn($l) => $l !== ''));
	if (empty($lines)) return '';

	$first = (string) $lines[0];
	$first = preg_replace('/^[\*\-•\s]+/', '', $first) ?? $first;
	$firstLower = strtolower($first);

	if (str_contains($firstLower, 'gold')) return 'Gold';
	if (str_contains($firstLower, 'black')) return 'Black';
	if (str_contains($firstLower, 'carbon')) return 'Carbon fiber';
	if (str_contains($firstLower, 'walnut')) return 'Walnut';
	if (str_contains($firstLower, 'oak')) return 'Oak';
	if (str_contains($firstLower, 'shadow wood')) return 'Shadow wood';
	if (str_contains($firstLower, 'burl')) return 'Burl wood';

	// Fallback: use cleaned first line but keep it short.
	$first = cellar_studio_norm_text($first);
	$first = preg_replace('/\b(cabinet|box|body|frame)\b/i', '', $first) ?? $first;
	$first = cellar_studio_norm_text($first);
	return $first;
}

function cellar_studio_find_csv_header_and_rows(string $csvPath): array {
	// Returns: ['header'=>array<string>, 'colIndex'=>array<string,int>, 'rows'=>array<array>, 'errors'=>array<string>]
	$out = ['header' => [], 'colIndex' => [], 'rows' => [], 'errors' => []];

	$fh = fopen($csvPath, 'r');
	if (!$fh) {
		$out['errors'][] = 'Cannot read CSV.';
		return $out;
	}

	$header = null;
	$maxScan = 80;
	for ($i = 0; $i < $maxScan; $i++) {
		$row = fgetcsv($fh);
		if ($row === false) break;
		if (!is_array($row)) continue;

		$normRow = array_map(static function ($h) {
			$h = (string) $h;
			$h = preg_replace('/^\xEF\xBB\xBF/', '', $h) ?? $h; // BOM
			return cellar_studio_norm_text($h);
		}, $row);

		if (in_array('Product model', $normRow, true) && in_array('Specification', $normRow, true) && in_array('Configuration', $normRow, true)) {
			$header = $normRow;
			break;
		}
	}

	if (!is_array($header)) {
		fclose($fh);
		$out['errors'][] = 'Could not find header row (expected: Product model, Specification, Configuration).';
		return $out;
	}

	$colIndex = array_flip($header);

	$rows = [];
	while (($row = fgetcsv($fh)) !== false) {
		if (!is_array($row)) continue;
		$rows[] = $row;
	}
	fclose($fh);

	$out['header'] = $header;
	$out['colIndex'] = $colIndex;
	$out['rows'] = $rows;
	return $out;
}

function cellar_studio_products_from_grouped_rows(array $colIndex, array $rows): array {
	// Builds grouped products from rows.
	// Continuation lines have empty model; we keep each continuation row as a "variant line"
	// so we can build variations (finish + ammonia).
	$products = [];
	$lastIndex = -1;

	foreach ($rows as $row) {
		$modelRaw = isset($colIndex['Product model']) ? (string) ($row[$colIndex['Product model']] ?? '') : '';
		$model = cellar_studio_norm_text($modelRaw);
		$spec = isset($colIndex['Specification']) ? (string) ($row[$colIndex['Specification']] ?? '') : '';
		$cfg = isset($colIndex['Configuration']) ? (string) ($row[$colIndex['Configuration']] ?? '') : '';
		$ammonia = isset($colIndex['Ammonia Removal']) ? (string) ($row[$colIndex['Ammonia Removal']] ?? '') : '';

		// Skip pure empty rows.
		if ($model === '' && trim($spec) === '' && trim($cfg) === '' && trim($ammonia) === '') {
			continue;
		}

		if ($model === '') {
			if ($lastIndex >= 0) {
				// Treat as variant/config continuation.
				$products[$lastIndex]['variant_lines'][] = [
					'spec' => trim($spec),
					'cfg' => trim($cfg),
					'ammonia' => trim($ammonia),
				];

				// Also append to the base long text for descriptions.
				if (trim($spec) !== '') $products[$lastIndex]['spec'] .= "\n" . trim($spec);
				if (trim($cfg) !== '') $products[$lastIndex]['cfg'] .= "\n" . trim($cfg);
				if (trim($ammonia) !== '') $products[$lastIndex]['ammonia'] .= "\n" . trim($ammonia);
			}
			continue;
		}

		$products[] = [
			'model' => $model,
			'model_code' => cellar_studio_extract_model_code($model),
			'spec' => trim($spec),
			'cfg' => trim($cfg),
			'ammonia' => trim($ammonia),
			'variant_lines' => [],
		];
		$lastIndex = count($products) - 1;
	}

	return $products;
}

function cellar_studio_build_woocommerce_csv_rows_from_products(array $products, string $categoryName, bool $useVariations = false): array {
	$order = ['pa_type', 'pa_capacity', 'pa_humidity-control', 'pa_interior', 'pa_finish', 'pa_installation', 'pa_color', 'pa_ammonia-removal'];
	$rows = [];

	foreach ($products as $p) {
		$sku = (string) ($p['model_code'] ?? '');
		$sku = cellar_studio_norm_text($sku);
		if ($sku === '') continue;

		$title = (string) ($p['model'] ?? $sku);
		$title = cellar_studio_norm_text($title);

		$spec = (string) ($p['spec'] ?? '');
		$cfg = (string) ($p['cfg'] ?? '');
		$ammonia = (string) ($p['ammonia'] ?? '');

		$specAttrs = cellar_studio_parse_spec_to_attrs($spec);
		$cfgAttrs = cellar_studio_parse_config_to_attrs($cfg);
		$attrs = array_merge($specAttrs, $cfgAttrs);

		$catLower = strtolower($categoryName);
		if (strpos($catLower, 'cigar') !== false) $attrs['pa_type'] = $attrs['pa_type'] ?? 'Cigar Cabinet';
		elseif (strpos($catLower, 'wine') !== false) $attrs['pa_type'] = $attrs['pa_type'] ?? 'Wine Cabinet';
		else $attrs['pa_type'] = $attrs['pa_type'] ?? $categoryName;

		$short = trim($spec);
		if (trim($ammonia) !== '') $short .= "\nAmmonia removal: " . trim($ammonia);

		$descParts = [];
		if (trim($spec) !== '') $descParts[] = "Specifications:\n" . trim($spec);
		if (trim($cfg) !== '') $descParts[] = "Configuration:\n" . trim($cfg);
		if (trim($ammonia) !== '') $descParts[] = "Ammonia removal:\n" . trim($ammonia);
		$desc = trim(implode("\n\n", $descParts));

		$variantLines = is_array($p['variant_lines'] ?? null) ? (array) $p['variant_lines'] : [];
		$hasVariants = $useVariations && !empty($variantLines);

		if (!$hasVariants) {
			$row = [
				'Type' => 'simple',
				'Name' => $title ?: $sku,
				'Published' => '1',
				'SKU' => $sku,
				'Regular price' => '',
				'Categories' => $categoryName,
				'Short description' => $short,
				'Description' => $desc,
				'Images' => '',
			];

			$attrItems = [];
			foreach ($order as $tax) {
				if (!isset($attrs[$tax])) continue;
				$val = cellar_studio_norm_text((string) $attrs[$tax]);
				if ($val === '') continue;
				$attrItems[] = [$tax, $val];
			}

			foreach ($attrItems as $i => $item) {
				$n = $i + 1;
				$row["Attribute {$n} name"] = $item[0];
				$row["Attribute {$n} value(s)"] = $item[1];
				$row["Attribute {$n} visible"] = '1';
				$row["Attribute {$n} global"] = '1';
			}

			$rows[] = $row;
			continue;
		}

		// VARIABLE parent + variations.
		$finishOptions = [];
		$ammoniaOptions = [];
		foreach ($variantLines as $vl) {
			$finish = cellar_studio_extract_finish_from_config((string) ($vl['cfg'] ?? ''));
			$amo = cellar_studio_norm_text((string) ($vl['ammonia'] ?? ''));
			if ($finish !== '') $finishOptions[$finish] = true;
			if ($amo !== '') $ammoniaOptions[ucfirst(strtolower($amo))] = true;
		}
		$finishList = implode(', ', array_keys($finishOptions));
		$ammoniaList = implode(', ', array_keys($ammoniaOptions));

		$parent = [
			'Type' => 'variable',
			'Name' => $title ?: $sku,
			'Published' => '1',
			'SKU' => $sku,
			'Regular price' => '',
			'Categories' => $categoryName,
			'Short description' => $short,
			'Description' => $desc,
			'Images' => '',
		];

		// Parent attributes must list all options.
		$parentAttrs = [];
		foreach ($order as $tax) {
			if (in_array($tax, ['pa_finish', 'pa_ammonia-removal'], true)) continue;
			if (!isset($attrs[$tax])) continue;
			$val = cellar_studio_norm_text((string) $attrs[$tax]);
			if ($val === '') continue;
			$parentAttrs[] = [$tax, $val];
		}
		if ($finishList !== '') $parentAttrs[] = ['pa_finish', $finishList];
		if ($ammoniaList !== '') $parentAttrs[] = ['pa_ammonia-removal', $ammoniaList];

		foreach ($parentAttrs as $i => $item) {
			$n = $i + 1;
			$parent["Attribute {$n} name"] = $item[0];
			$parent["Attribute {$n} value(s)"] = $item[1];
			$parent["Attribute {$n} visible"] = '1';
			$parent["Attribute {$n} global"] = '1';
		}
		$rows[] = $parent;

		// Variations rows. WooCommerce CSV uses Parent (SKU) to relate to parent.
		foreach ($variantLines as $vl) {
			$finish = cellar_studio_extract_finish_from_config((string) ($vl['cfg'] ?? ''));
			$amoRaw = cellar_studio_norm_text((string) ($vl['ammonia'] ?? ''));
			$amo = $amoRaw ? ucfirst(strtolower($amoRaw)) : '';

			$varSku = $sku . '-' . cellar_studio_slugify($finish ?: 'finish') . '-' . cellar_studio_slugify($amo ?: 'ammonia');
			$var = [
				'Type' => 'variation',
				'Name' => '',
				'Published' => '1',
				'SKU' => $varSku,
				'Parent' => $sku,
				'Regular price' => '',
				'Categories' => '',
				'Short description' => '',
				'Description' => '',
				'Images' => '',
			];

			$ai = 1;
			if ($finish !== '') {
				$var["Attribute {$ai} name"] = 'pa_finish';
				$var["Attribute {$ai} value(s)"] = $finish;
				$var["Attribute {$ai} global"] = '1';
				$ai++;
			}
			if ($amo !== '') {
				$var["Attribute {$ai} name"] = 'pa_ammonia-removal';
				$var["Attribute {$ai} value(s)"] = $amo;
				$var["Attribute {$ai} global"] = '1';
				$ai++;
			}

			$rows[] = $var;
		}
	}

	return $rows;
}

function cellar_studio_csv_rows_to_string(array $rows): string {
	if (empty($rows)) return '';

	$baseFields = ['Type', 'Name', 'Published', 'SKU', 'Parent', 'Regular price', 'Categories', 'Short description', 'Description', 'Images'];
	$extra = [];
	foreach ($rows as $r) {
		foreach (array_keys($r) as $k) {
			if (in_array($k, $baseFields, true)) continue;
			if (!in_array($k, $extra, true)) $extra[] = $k;
		}
	}
	$fields = array_merge($baseFields, $extra);

	$fh = fopen('php://temp', 'r+');
	fputcsv($fh, $fields);
	foreach ($rows as $r) {
		$line = [];
		foreach ($fields as $f) $line[] = $r[$f] ?? '';
		fputcsv($fh, $line);
	}
	rewind($fh);
	$csv = stream_get_contents($fh);
	fclose($fh);

	// Excel-friendly UTF-8 BOM.
	return "\xEF\xBB\xBF" . (string) $csv;
}

function cellar_studio_import_csv_grouped_products(string $csvPath, string $categoryName): array {
	// Returns summary: ['created'=>int,'updated'=>int,'skipped'=>int,'errors'=>array<string>]
	$summary = ['created' => 0, 'updated' => 0, 'skipped' => 0, 'errors' => []];

	if (!file_exists($csvPath)) {
		$summary['errors'][] = 'CSV missing.';
		return $summary;
	}

	$fh = fopen($csvPath, 'r');
	if (!$fh) {
		$summary['errors'][] = 'Cannot read CSV.';
		return $summary;
	}

	// Find header row (some exports include title rows above header).
	$header = null;
	$maxScan = 50;
	for ($i = 0; $i < $maxScan; $i++) {
		$row = fgetcsv($fh);
		if ($row === false) break;
		if (!is_array($row)) continue;
		$normRow = array_map(static function ($h) {
			$h = (string) $h;
			// Strip UTF-8 BOM if present.
			$h = preg_replace('/^\xEF\xBB\xBF/', '', $h) ?? $h;
			return cellar_studio_norm_text($h);
		}, $row);

		if (in_array('Product model', $normRow, true) && in_array('Specification', $normRow, true) && in_array('Configuration', $normRow, true)) {
			$header = $normRow;
			break;
		}
	}

	if (!is_array($header)) {
		fclose($fh);
		$summary['errors'][] = 'Could not find header row (expected: Product model, Specification, Configuration).';
		return $summary;
	}

	$colIndex = array_flip($header);
	$required = ['Product model', 'Specification', 'Configuration', 'Ammonia Removal'];
	foreach ($required as $req) {
		if (!isset($colIndex[$req])) {
			// allow missing Ammonia Removal on some sheets
			if ($req === 'Ammonia Removal') continue;
			fclose($fh);
			$summary['errors'][] = 'Missing column: ' . $req;
			return $summary;
		}
	}

	$rows = [];
	while (($row = fgetcsv($fh)) !== false) {
		if (!is_array($row)) continue;
		$rows[] = $row;
	}
	fclose($fh);

	// Group by "Product model" blocks (continuation lines have empty model)
	$products = [];
	$lastIndex = -1;
	foreach ($rows as $row) {
		$model = isset($colIndex['Product model']) ? cellar_studio_norm_text((string) ($row[$colIndex['Product model']] ?? '')) : '';
		$spec = isset($colIndex['Specification']) ? (string) ($row[$colIndex['Specification']] ?? '') : '';
		$cfg = isset($colIndex['Configuration']) ? (string) ($row[$colIndex['Configuration']] ?? '') : '';
		$ammonia = isset($colIndex['Ammonia Removal']) ? (string) ($row[$colIndex['Ammonia Removal']] ?? '') : '';

		if ($model === '') {
			if ($lastIndex >= 0) {
				if (trim($spec) !== '') $products[$lastIndex]['spec'] .= "\n" . trim($spec);
				if (trim($cfg) !== '') $products[$lastIndex]['cfg'] .= "\n" . trim($cfg);
				if (trim($ammonia) !== '') $products[$lastIndex]['ammonia'] .= "\n" . trim($ammonia);
			}
			continue;
		}

		$products[] = [
			'model' => $model,
			'spec' => trim($spec),
			'cfg' => trim($cfg),
			'ammonia' => trim($ammonia),
		];
		$lastIndex = count($products) - 1;
	}

	// Ensure category exists
	$catTerm = term_exists($categoryName, 'product_cat');
	if (!$catTerm) {
		$catTerm = wp_insert_term($categoryName, 'product_cat');
	}
	$catId = is_array($catTerm) ? (int) ($catTerm['term_id'] ?? 0) : (int) $catTerm;

	$order = ['pa_type', 'pa_capacity', 'pa_humidity-control', 'pa_interior', 'pa_finish', 'pa_installation', 'pa_color'];

	foreach ($products as $p) {
		$sku = $p['model'];
		$name = $p['model'];

		// Find by SKU first
		$existingId = 0;
		if (function_exists('wc_get_product_id_by_sku')) {
			$existingId = (int) wc_get_product_id_by_sku($sku);
		}

		$product = null;
		$isUpdate = false;
		if ($existingId) {
			$product = wc_get_product($existingId);
			$isUpdate = (bool) $product;
		}
		if (!$product) {
			$product = new WC_Product_Simple();
		}

		$specAttrs = cellar_studio_parse_spec_to_attrs($p['spec']);
		$cfgAttrs = cellar_studio_parse_config_to_attrs($p['cfg']);
		$attrs = array_merge($specAttrs, $cfgAttrs);

		$catLower = strtolower($categoryName);
		if (strpos($catLower, 'cigar') !== false) {
			$attrs['pa_type'] = $attrs['pa_type'] ?? 'Cigar Cabinet';
		} elseif (strpos($catLower, 'wine') !== false) {
			$attrs['pa_type'] = $attrs['pa_type'] ?? 'Wine Cabinet';
		} else {
			$attrs['pa_type'] = $attrs['pa_type'] ?? 'Stainless steel cabinet';
		}

		$short = trim($p['spec']);
		if (trim($p['ammonia']) !== '') {
			$short .= "\nAmmonia removal: " . trim($p['ammonia']);
		}
		$descParts = [];
		if (trim($p['spec']) !== '') $descParts[] = "Specifications:\n" . trim($p['spec']);
		if (trim($p['cfg']) !== '') $descParts[] = "Configuration:\n" . trim($p['cfg']);
		if (trim($p['ammonia']) !== '') $descParts[] = "Ammonia removal:\n" . trim($p['ammonia']);
		$desc = trim(implode("\n\n", $descParts));

		$product->set_name($name);
		$product->set_sku($sku);
		$product->set_status('publish');
		$product->set_short_description($short);
		$product->set_description($desc);

		if ($catId) {
			$product->set_category_ids([$catId]);
		}

		// Attach global attributes to product
		$wcAttrs = [];
		foreach ($order as $tax) {
			if (!isset($attrs[$tax])) continue;
			$val = cellar_studio_norm_text((string) $attrs[$tax]);
			if ($val === '') continue;

			$taxName = $tax;
			$attr = new WC_Product_Attribute();
			$attr->set_name($taxName);
			$attr->set_visible(true);
			$attr->set_variation(false);

			// Ensure term exists and get term id
			if (taxonomy_exists($taxName)) {
				$term = term_exists($val, $taxName);
				if (!$term) {
					$term = wp_insert_term($val, $taxName);
				}
				$termId = is_array($term) ? (int) ($term['term_id'] ?? 0) : (int) $term;
				if ($termId) {
					$attr->set_options([$termId]);
				}
			} else {
				// fallback: custom attribute as plain text
				$attr->set_name(wc_attribute_taxonomy_name($taxName));
				$attr->set_options([$val]);
			}

			$wcAttrs[$taxName] = $attr;
		}
		if (!empty($wcAttrs)) {
			$product->set_attributes($wcAttrs);
		}

		$id = $product->save();
		if (!$id) {
			$summary['errors'][] = 'Failed to save product: ' . $sku;
			continue;
		}

		// Assign terms for global attrs (helps filters/archives)
		foreach ($order as $tax) {
			if (!isset($attrs[$tax])) continue;
			$val = cellar_studio_norm_text((string) $attrs[$tax]);
			if ($val === '' || !taxonomy_exists($tax)) continue;
			wp_set_object_terms($id, [$val], $tax, false);
		}

		if ($isUpdate) $summary['updated']++;
		else $summary['created']++;
	}

	return $summary;
}

function cellar_studio_render_product_import_page(): void {
	if (!current_user_can('manage_woocommerce')) {
		wp_die(esc_html__('You do not have permission to access this page.', 'cellar-studio'));
	}

	$done = false;
	$summary = null;
	$error = '';

	if (isset($_POST['cellar_product_import_run'])) {
		check_admin_referer('cellar_product_import_run');

		$category = isset($_POST['cellar_product_import_category']) ? cellar_studio_norm_text((string) $_POST['cellar_product_import_category']) : '';
		if ($category === '') {
			$error = 'Please choose a category.';
		} elseif (empty($_FILES['cellar_product_import_file']['tmp_name'])) {
			$error = 'Please upload a CSV file.';
		} else {
			$tmp = (string) $_FILES['cellar_product_import_file']['tmp_name'];
			$summary = cellar_studio_import_csv_grouped_products($tmp, $category);
			$done = true;
		}
	}

	echo '<div class="wrap">';
	echo '<h1>' . esc_html__('Product Import (Cellar)', 'cellar-studio') . '</h1>';
	echo '<p>' . esc_html__('Export each Excel sheet as CSV, then import here. The importer groups continuation rows under the same Product model and creates WooCommerce products with global attributes.', 'cellar-studio') . '</p>';

	echo '<div class="notice notice-info"><p>';
	echo '<strong>CSV columns expected:</strong> Product model, Specification, Configuration, Ammonia Removal (Ammonia Removal optional).';
	echo '</p></div>';

	if ($error) {
		echo '<div class="notice notice-error"><p><strong>' . esc_html($error) . '</strong></p></div>';
	}

	if ($done && is_array($summary)) {
		$msg = sprintf('Created: %d, Updated: %d, Errors: %d', (int) $summary['created'], (int) $summary['updated'], is_array($summary['errors']) ? count($summary['errors']) : 0);
		echo '<div class="notice notice-success"><p><strong>' . esc_html($msg) . '</strong></p></div>';
		if (!empty($summary['errors'])) {
			echo '<ul style="list-style: disc; padding-left: 20px;">';
			foreach ($summary['errors'] as $e) echo '<li>' . esc_html((string) $e) . '</li>';
			echo '</ul>';
		}
		echo '<p><a class="button" href="' . esc_url(admin_url('edit.php?post_type=product')) . '">Open Products</a></p>';
	}

	echo '<form method="post" enctype="multipart/form-data" style="margin-top:16px;">';
	wp_nonce_field('cellar_product_import_run');

	echo '<table class="form-table" role="presentation"><tbody>';
	echo '<tr><th scope="row"><label for="cellar_product_import_category">Category</label></th><td>';
	echo '<select id="cellar_product_import_category" name="cellar_product_import_category" required>';
	echo '<option value="">Select…</option>';
	foreach (['Cigar Cabinet', 'Wine Cabinet', 'Stainless steel cabinet'] as $cat) {
		echo '<option value="' . esc_attr($cat) . '">' . esc_html($cat) . '</option>';
	}
	echo '</select>';
	echo '</td></tr>';

	echo '<tr><th scope="row"><label for="cellar_product_import_file">CSV file</label></th><td>';
	echo '<input type="file" id="cellar_product_import_file" name="cellar_product_import_file" accept=".csv,text/csv" required>';
	echo '</td></tr>';
	echo '</tbody></table>';

	echo '<p><button class="button button-primary" type="submit" name="cellar_product_import_run" value="1">' . esc_html__('Import now', 'cellar-studio') . '</button></p>';
	echo '</form>';
	echo '</div>';
}

function cellar_studio_render_csv_converter_page(): void {
	if (!current_user_can('manage_woocommerce')) {
		wp_die(esc_html__('You do not have permission to access this page.', 'cellar-studio'));
	}

	$error = '';
	$downloadUrl = '';
	$meta = [];
	$useVariations = true;

	if (isset($_POST['cellar_csv_convert_run'])) {
		check_admin_referer('cellar_csv_convert_run');

		$mode = isset($_POST['cellar_csv_convert_mode']) ? (string) $_POST['cellar_csv_convert_mode'] : 'variations';
		$useVariations = ($mode !== 'simple');

		$category = isset($_POST['cellar_csv_convert_category']) ? cellar_studio_norm_text((string) $_POST['cellar_csv_convert_category']) : '';
		if ($category === '') {
			$error = 'Please choose a category.';
		} elseif (empty($_FILES['cellar_csv_convert_file']['tmp_name'])) {
			$error = 'Please upload a CSV file.';
		} else {
			$tmp = (string) $_FILES['cellar_csv_convert_file']['tmp_name'];
			$parsed = cellar_studio_find_csv_header_and_rows($tmp);
			if (!empty($parsed['errors'])) {
				$error = implode(' | ', array_map('strval', (array) $parsed['errors']));
			} else {
				$products = cellar_studio_products_from_grouped_rows((array) $parsed['colIndex'], (array) $parsed['rows']);
				$wcRows = cellar_studio_build_woocommerce_csv_rows_from_products($products, $category, $useVariations);
				$csv = cellar_studio_csv_rows_to_string($wcRows);

				if ($csv === '') {
					$error = 'No products detected.';
				} else {
					$upload = wp_upload_bits('cellar-woocommerce-import-' . sanitize_file_name($category) . '-' . gmdate('Ymd-His') . '.csv', null, $csv);
					if (!empty($upload['error'])) {
						$error = (string) $upload['error'];
					} else {
						$downloadUrl = (string) ($upload['url'] ?? '');
						$meta = [
							'products' => count($products),
							'rows' => count($wcRows),
						];
					}
				}
			}
		}
	}

	echo '<div class="wrap">';
	echo '<h1>' . esc_html__('CSV Converter (Cellar)', 'cellar-studio') . '</h1>';
	echo '<p>' . esc_html__('Upload your Excel-exported CSV (raw). This tool will analyze it and generate a WooCommerce-ready CSV with attributes (pa_*).', 'cellar-studio') . '</p>';

	if ($error) {
		echo '<div class="notice notice-error"><p><strong>' . esc_html($error) . '</strong></p></div>';
	}

	if ($downloadUrl) {
		$msg = sprintf('Generated. Products detected: %d', (int) ($meta['products'] ?? 0));
		echo '<div class="notice notice-success"><p><strong>' . esc_html($msg) . '</strong></p></div>';
		echo '<p><a class="button button-primary" href="' . esc_url($downloadUrl) . '" target="_blank" rel="noopener">Download WooCommerce CSV</a></p>';
		echo '<p><a class="button" href="' . esc_url(admin_url('edit.php?post_type=product')) . '">Open Products</a></p>';
		echo '<p><em>' . esc_html__('Next: go to Products → Import and upload the downloaded CSV (or use Tools → Product Import (Cellar) to import directly).', 'cellar-studio') . '</em></p>';
	}

	echo '<form method="post" enctype="multipart/form-data" style="margin-top:16px;">';
	wp_nonce_field('cellar_csv_convert_run');

	echo '<table class="form-table" role="presentation"><tbody>';
	echo '<tr><th scope="row"><label for="cellar_csv_convert_category">Category</label></th><td>';
	echo '<select id="cellar_csv_convert_category" name="cellar_csv_convert_category" required>';
	echo '<option value="">Select…</option>';
	foreach (['Cigar Cabinet', 'Wine Cabinet', 'Stainless steel cabinet'] as $cat) {
		echo '<option value="' . esc_attr($cat) . '">' . esc_html($cat) . '</option>';
	}
	echo '</select>';
	echo '</td></tr>';

	echo '<tr><th scope="row">Mode</th><td>';
	echo '<label><input type="radio" name="cellar_csv_convert_mode" value="variations" checked> Create variations (recommended)</label><br>';
	echo '<label><input type="radio" name="cellar_csv_convert_mode" value="simple"> Simple products only</label>';
	echo '</td></tr>';

	echo '<tr><th scope="row"><label for="cellar_csv_convert_file">Raw CSV file</label></th><td>';
	echo '<input type="file" id="cellar_csv_convert_file" name="cellar_csv_convert_file" accept=".csv,text/csv" required>';
	echo '</td></tr>';
	echo '</tbody></table>';

	echo '<p><button class="button button-primary" type="submit" name="cellar_csv_convert_run" value="1">' . esc_html__('Convert now', 'cellar-studio') . '</button></p>';
	echo '</form>';
	echo '</div>';
}

function cellar_studio_load_zoho_integration(): void {
	$zoho_file = get_template_directory() . '/integrations/zoho-crm.php';
	if (file_exists($zoho_file)) {
		require_once $zoho_file;
	}
}

function cellar_studio_zoho_has_credentials(): bool {
	return defined('CELLAR_ZOHO_DC')
		&& defined('CELLAR_ZOHO_CLIENT_ID')
		&& defined('CELLAR_ZOHO_CLIENT_SECRET')
		&& (string) CELLAR_ZOHO_CLIENT_ID !== ''
		&& (string) CELLAR_ZOHO_CLIENT_SECRET !== '';
}

function cellar_studio_zoho_html_response(string $title, string $message, int $status = 200): WP_REST_Response {
	$html = '<!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">'
		. '<title>' . esc_html($title) . '</title>'
		. '<style>body{font-family:system-ui,-apple-system,sans-serif;max-width:520px;margin:48px auto;padding:0 20px;color:#1a1a1a}'
		. 'h1{font-size:1.35rem}p{line-height:1.5;color:#444}</style></head><body>'
		. '<h1>' . esc_html($title) . '</h1><p>' . esc_html($message) . '</p></body></html>';

	$response = new WP_REST_Response($html, $status);
	$response->header('Content-Type', 'text/html; charset=utf-8');
	return $response;
}

add_action('admin_menu', function (): void {
	add_options_page(
		'Zoho CRM',
		'Zoho CRM',
		'manage_options',
		'cellar-zoho-crm',
		'cellar_studio_render_zoho_admin_page'
	);
});

function cellar_studio_render_zoho_admin_page(): void {
	if (!current_user_can('manage_options')) {
		return;
	}

	cellar_studio_load_zoho_integration();

	$hasCredentials = cellar_studio_zoho_has_credentials();
	$hasRefresh = function_exists('cellar_studio_zoho_get_refresh_token')
		&& cellar_studio_zoho_get_refresh_token() !== '';
	$isReady = function_exists('cellar_studio_zoho_is_configured') && cellar_studio_zoho_is_configured();
	$redirectUri = function_exists('cellar_studio_zoho_callback_redirect_uri')
		? cellar_studio_zoho_callback_redirect_uri()
		: home_url('/wp-json/cellar-studio/v1/zoho/callback');
	$connectUrl = function_exists('cellar_studio_zoho_authorization_url')
		? cellar_studio_zoho_authorization_url(wp_create_nonce('cellar_zoho_oauth'))
		: '';

	echo '<div class="wrap">';
	echo '<h1>Zoho CRM</h1>';
	echo '<p>Connect Zoho CRM so consultation form submissions create Leads automatically.</p>';

	echo '<table class="widefat striped" style="max-width:720px"><tbody>';
	echo '<tr><th scope="row">Credentials</th><td>' . ($hasCredentials ? 'Configured' : 'Missing') . '</td></tr>';
	echo '<tr><th scope="row">Refresh token</th><td>' . ($hasRefresh ? 'Saved' : 'Not connected yet') . '</td></tr>';
	echo '<tr><th scope="row">Integration status</th><td>' . ($isReady ? '<strong style="color:green">Ready</strong>' : '<strong style="color:#b45309">Pending authorization</strong>') . '</td></tr>';
	echo '<tr><th scope="row">Redirect URI</th><td><code>' . esc_html($redirectUri) . '</code></td></tr>';
	echo '</tbody></table>';

	if ($hasCredentials && $connectUrl !== '' && !$isReady) {
		echo '<p style="margin-top:20px"><a class="button button-primary button-hero" href="' . esc_url($connectUrl) . '">Connect to Zoho CRM</a></p>';
		echo '<p><em>Authorize once on the live site. Zoho will redirect back here and save the refresh token automatically.</em></p>';
	}

	if ($isReady) {
		echo '<p style="margin-top:20px;color:green"><strong>Zoho CRM is connected.</strong> Form submissions will create Leads.</p>';
	}

	echo '</div>';
}

/**
 * Zoho OAuth callback endpoint.
 *
 * Zoho redirects here with `?code=...` after authorization.
 */
add_action('rest_api_init', function (): void {
	register_rest_route('cellar-studio/v1', '/zoho/callback', [
		'methods' => 'GET',
		'callback' => function (WP_REST_Request $request) {
			$code = sanitize_text_field((string) $request->get_param('code'));
			if ($code === '') {
				return cellar_studio_zoho_html_response(
					'Zoho CRM',
					'Missing authorization code. Use WordPress Admin → Settings → Zoho CRM → Connect to Zoho CRM.',
					400
				);
			}

			cellar_studio_load_zoho_integration();

			if (!function_exists('cellar_studio_zoho_exchange_code_for_refresh_token')) {
				return cellar_studio_zoho_html_response('Zoho CRM', 'Zoho helper not available.', 500);
			}

			try {
				$res = cellar_studio_zoho_exchange_code_for_refresh_token($code);
				$json = $res['json'] ?? null;
				$refreshToken = is_array($json) && isset($json['refresh_token']) ? (string) $json['refresh_token'] : '';

				if ($refreshToken === '') {
					$msg = is_array($json) && isset($json['error']) ? (string) $json['error'] : 'refresh_token missing';
					return cellar_studio_zoho_html_response(
						'Zoho CRM authorization failed',
						'Could not get refresh token: ' . $msg,
						400
					);
				}

				update_option('cellar_zoho_refresh_token', $refreshToken, false);

				return cellar_studio_zoho_html_response(
					'Zoho CRM connected',
					'Refresh token saved successfully. You can close this tab and test the consultation form.',
					200
				);
			} catch (\Throwable $e) {
				return cellar_studio_zoho_html_response(
					'Zoho CRM authorization failed',
					'OAuth exchange failed: ' . $e->getMessage(),
					500
				);
			}
		},
		'permission_callback' => '__return_true',
	]);
});

