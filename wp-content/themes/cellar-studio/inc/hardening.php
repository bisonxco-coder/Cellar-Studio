<?php
if (!defined('ABSPATH')) {
	exit;
}

/**
 * Trash known spam / leftover WordPress defaults if they are still published.
 * Cheap lookups; safe to run on the public site after a compromise.
 */
function cellar_studio_trash_compromised_content(): void {
	if (wp_installing()) {
		return;
	}
	if (get_transient('cellar_studio_cleanup_ran')) {
		return;
	}
	set_transient('cellar_studio_cleanup_ran', 1, 5 * MINUTE_IN_SECONDS);

	$slugs = [
		's-post',
		'sample-page',
		'bestes-online-casino-der-schweiz-im-ranking-3',
		'sweet-bonanza-ile-tatli-kazanclar-parmaklarinin-ucunda',
	];

	foreach ($slugs as $slug) {
		$found = get_posts([
			'name' => $slug,
			'post_type' => ['post', 'page'],
			'post_status' => ['publish', 'future', 'pending', 'private', 'draft'],
			'numberposts' => 5,
			'suppress_filters' => true,
		]);
		foreach ($found as $post) {
			if ($post instanceof WP_Post) {
				wp_trash_post($post->ID);
			}
		}
	}

	global $wpdb;
	$like_rows = $wpdb->get_col(
		"SELECT ID FROM {$wpdb->posts}
		WHERE post_status = 'publish'
		AND post_type IN ('post','page')
		AND (
			post_name LIKE '%casino%'
			OR post_name LIKE '%bonanza%'
			OR post_name LIKE '%mostbet%'
			OR post_name LIKE '%kazanmaya%'
			OR post_title LIKE '%casino%'
			OR post_title LIKE '%Mostbet%'
			OR post_title LIKE '%Sweet Bonanza%'
		)"
	);
	foreach ($like_rows as $id) {
		wp_trash_post((int) $id);
	}

	$user = get_user_by('id', 1);
	if ($user instanceof WP_User) {
		$dirty_name = is_email($user->display_name)
			|| str_contains($user->display_name, '@')
			|| $user->display_name === $user->user_login;
		if ($dirty_name) {
			wp_update_user([
				'ID' => 1,
				'display_name' => 'Cellar Studio',
				'nickname' => 'Cellar Studio',
			]);
		}
	}
}
add_action('init', 'cellar_studio_trash_compromised_content', 20);

function cellar_studio_is_spammy_post($post): bool {
	if (!$post instanceof WP_Post) {
		return false;
	}
	$haystack = strtolower($post->post_name . ' ' . $post->post_title);
	foreach (['casino', 'bonanza', 'mostbet', 'kazanmaya', 'alev-casino'] as $needle) {
		if (str_contains($haystack, $needle)) {
			return true;
		}
	}
	return in_array($post->post_name, ['s-post', 'sample-page'], true);
}

function cellar_studio_hide_spam_from_queries($posts, $query) {
	if (is_admin() || !is_array($posts)) {
		return $posts;
	}
	return array_values(array_filter($posts, static function ($post) {
		return !cellar_studio_is_spammy_post($post);
	}));
}
add_filter('the_posts', 'cellar_studio_hide_spam_from_queries', 10, 2);

function cellar_studio_restrict_users_rest($endpoints) {
	if (is_user_logged_in() || !is_array($endpoints)) {
		return $endpoints;
	}
	foreach (array_keys($endpoints) as $route) {
		if (strpos((string) $route, '/wp/v2/users') === 0) {
			unset($endpoints[$route]);
		}
	}
	return $endpoints;
}
add_filter('rest_endpoints', 'cellar_studio_restrict_users_rest');

function cellar_studio_disable_users_sitemap($provider, $name) {
	if ($name === 'users') {
		return false;
	}
	return $provider;
}
add_filter('wp_sitemaps_add_provider', 'cellar_studio_disable_users_sitemap', 10, 2);

function cellar_studio_block_author_archives(): void {
	if (is_author()) {
		wp_safe_redirect(home_url('/blog/'), 301);
		exit;
	}
}
add_action('template_redirect', 'cellar_studio_block_author_archives', 1);

function cellar_studio_block_readme_and_paged_junk(): void {
	$uri = (string) ($_SERVER['REQUEST_URI'] ?? '');
	if (preg_match('#/readme\.html(?:$|\?)#i', $uri)) {
		status_header(404);
		nocache_headers();
		exit;
	}

	if (is_singular() && (int) get_query_var('page') > 1) {
		$post = get_queried_object();
		$has_nextpage = $post instanceof WP_Post && str_contains((string) $post->post_content, '<!--nextpage-->');
		if (!$has_nextpage) {
			global $wp_query;
			$wp_query->set_404();
			status_header(404);
			nocache_headers();
			$template = get_query_template('404');
			if ($template) {
				include $template;
			}
			exit;
		}
	}
}
add_action('template_redirect', 'cellar_studio_block_readme_and_paged_junk', 2);

function cellar_studio_strip_hidden_spam_links($html) {
	if (!is_string($html) || $html === '') {
		return $html;
	}
	$cleaned = preg_replace(
		'#<p[^>]*style=(["\'])[^"\']*display\s*:\s*none[^"\']*\1[^>]*>\s*<a[^>]*href=(["\'])2\2[^>]*>\s*2\s*</a>\s*</p>#i',
		'',
		$html
	);
	return is_string($cleaned) ? $cleaned : $html;
}

function cellar_studio_start_output_filter(): void {
	if (is_admin() || wp_doing_ajax() || wp_doing_cron() || (defined('REST_REQUEST') && REST_REQUEST)) {
		return;
	}
	ob_start('cellar_studio_strip_hidden_spam_links');
}
add_action('template_redirect', 'cellar_studio_start_output_filter', 0);
add_filter('the_content', 'cellar_studio_strip_hidden_spam_links', 99);

function cellar_studio_hide_generator(): void {
	remove_action('wp_head', 'wp_generator');
}
add_action('after_setup_theme', 'cellar_studio_hide_generator');
add_filter('the_generator', '__return_empty_string');
add_filter('get_the_generator_html', '__return_empty_string', 99);
add_filter('get_the_generator_xhtml', '__return_empty_string', 99);
add_filter('get_the_generator_rss2', '__return_empty_string', 99);
add_filter('get_the_generator_atom', '__return_empty_string', 99);
add_filter('get_the_generator_rdf', '__return_empty_string', 99);
add_filter('get_the_generator_comment', '__return_empty_string', 99);
add_filter('get_the_generator_export', '__return_empty_string', 99);
