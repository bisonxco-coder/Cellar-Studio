<?php
/*
Template Name: Legal
*/

if (!defined('ABSPATH')) {
	exit;
}

$slug = (string) get_post_field('post_name', get_queried_object_id());
$legacy = $slug === 'terms-and-conditions' ? 'terms-and-conditions.php' : 'privacy-policy.php';

get_header();
cellar_studio_render_legacy_template($legacy, ['navTheme' => 'dark']);
get_footer();
