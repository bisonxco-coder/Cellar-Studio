<?php
/*
Template Name: Thank You
*/

if (!defined('ABSPATH')) {
	exit;
}

get_header();

cellar_studio_render_legacy_template('thank-you.php', ['navTheme' => 'light']);

get_footer();
