<?php
/*
Template Name: Bespoke
*/

if (!defined('ABSPATH')) {
	exit;
}

get_header();

cellar_studio_render_legacy_template('bespoke.php', ['navTheme' => 'dark']);

get_footer();

