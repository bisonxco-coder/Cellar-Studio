<?php
if (!defined('ABSPATH')) {
	exit;
}

get_header();

cellar_studio_render_legacy_template('index.php', ['navTheme' => 'dark']);

get_footer();

