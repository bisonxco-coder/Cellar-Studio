<?php
if (!defined('ABSPATH')) {
	exit;
}

get_header();

// When a page is set as "Posts page" (page_for_posts), WordPress uses home.php.
// Render the legacy blog layout to match the template design.
cellar_studio_render_legacy_template('blog.php', ['navTheme' => 'light']);

get_footer();

