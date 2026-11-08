<?php
/*
Template Name: Wine Fridge
*/

if (!defined('ABSPATH')) {
	exit;
}

get_header();

cellar_studio_render_legacy_template('wine-fridge.php', ['navTheme' => 'dark']);

get_footer();

