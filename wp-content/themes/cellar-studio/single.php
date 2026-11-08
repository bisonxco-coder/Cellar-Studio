<?php
if (!defined('ABSPATH')) {
	exit;
}

get_header();

if (have_posts()) {
	the_post();

	// Render legacy blog detail template (design), but inject WP data.
	$post = get_post();
	if ($post) {
		$legacyFile = 'blog-details.php';
		$legacyPath = trailingslashit(get_template_directory()) . 'legacy/' . $legacyFile;

		if (file_exists($legacyPath)) {
			if (!defined('CELLAR_FRONTEND_BRIDGE')) {
				define('CELLAR_FRONTEND_BRIDGE', true);
			}

			ob_start();
			include $legacyPath;
			$raw = (string) ob_get_clean();

			// Extract <body> content.
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

			// Replace the obvious static parts with WP post data (minimal & safe).
			$title = get_the_title();
			$heroImg = get_the_post_thumbnail_url(get_the_ID(), 'full');
			if (!$heroImg) $heroImg = cellar_studio_asset('img/Projects.png');

			$date = get_the_date('d M Y');
			$content = apply_filters('the_content', get_the_content());
			// Some editors add a leading H1/H2 (often duplicating the title). Since the template
			// already renders the title in the hero, strip the first heading block.
			$content = preg_replace('~^\s*<h[12][^>]*>[\s\S]*?</h[12]>\s*~i', '', (string) $content, 1) ?? (string) $content;
			$text = wp_strip_all_tags((string) $content);
			$words = str_word_count($text);
			$mins = max(1, (int) ceil($words / 200));
			$meta = esc_html($date) . ' &nbsp; | &nbsp; ' . esc_html($mins) . ' mins read';

			// Hero image (first occurrence).
			$body = preg_replace('~(<img[^>]+class="blog-detail-hero-bg"[^>]+src=")[^"]*(")~i', '$1' . esc_url($heroImg) . '$2', $body, 1) ?? $body;
			// H1 title (first occurrence).
			$body = preg_replace('~(<h1[^>]*class="blog-detail-hero-title[^"]*"[^>]*>)([\s\S]*?)(</h1>)~i', '$1' . esc_html($title) . '$3', $body, 1) ?? $body;
			// Meta line (first occurrence). Match any class list that contains `news-meta`.
			$body = preg_replace('~(<p[^>]*class="[^"]*\bnews-meta\b[^"]*"[^>]*>)([\s\S]*?)(</p>)~i', '$1' . $meta . '$3', $body, 1) ?? $body;
			// Replace article body.
			$body = preg_replace('~(<div[^>]*class="blog-article-body"[^>]*>)([\s\S]*?)(</div>)~i', '$1' . $content . '$3', $body, 1) ?? $body;

			echo cellar_studio_rewrite_legacy_html($body, ['navTheme' => 'light']);
		} else {
			the_content();
		}
	}
}

get_footer();

