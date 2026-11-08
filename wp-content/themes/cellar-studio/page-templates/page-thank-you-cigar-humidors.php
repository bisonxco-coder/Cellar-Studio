<?php
/*
Template Name: Thank You - Cigar Humidor
*/

if (!defined('ABSPATH')) {
	exit;
}

get_header();

cellar_studio_render_legacy_template('thank-you-cigar-humidors.php', ['navTheme' => 'light']);

get_footer();
