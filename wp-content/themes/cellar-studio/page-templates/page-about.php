<?php
/*
Template Name: About
*/

if (!defined('ABSPATH')) {
	exit;
}

get_header();

cellar_studio_render_legacy_template('about.php', ['navTheme' => 'dark']);

get_footer();

