<?php
/*
Template Name: Thank You - Wine Fridge
*/

if (!defined('ABSPATH')) {
	exit;
}

get_header();

cellar_studio_render_legacy_template('thank-you-wine-fridge.php', ['navTheme' => 'light']);

get_footer();
