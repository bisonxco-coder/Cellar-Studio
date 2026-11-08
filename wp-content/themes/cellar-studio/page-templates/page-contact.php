<?php
/*
Template Name: Contact
*/

if (!defined('ABSPATH')) {
	exit;
}

get_header();

cellar_studio_render_legacy_template('contact.php', ['navTheme' => 'light']);

get_footer();

