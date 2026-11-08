<?php
/*
Template Name: Blog
*/

if (!defined('ABSPATH')) {
	exit;
}

get_header();

cellar_studio_render_legacy_template('blog.php', ['navTheme' => 'light']);

get_footer();

