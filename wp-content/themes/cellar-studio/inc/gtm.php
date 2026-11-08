<?php
if (!defined('ABSPATH')) {
	exit;
}

/**
 * Official GTM-5K9GJMPQ snippet. Printed first in <head> on every front-end
 * page (including all thank-you templates) so Tag Assistant can detect it.
 */
function cellar_studio_gtm_id(): string {
	return defined('CELLAR_STUDIO_GTM_ID') ? CELLAR_STUDIO_GTM_ID : 'GTM-5K9GJMPQ';
}

function cellar_studio_print_gtm_head(): void {
	if (is_admin() || defined('CELLAR_STUDIO_GTM_HEAD_PRINTED')) {
		return;
	}
	define('CELLAR_STUDIO_GTM_HEAD_PRINTED', true);

	$gtm_id = cellar_studio_gtm_id();
	$thank_you = function_exists('cellar_studio_is_thank_you_page') && cellar_studio_is_thank_you_page();
	$slug = $thank_you ? (string) get_post_field('post_name', get_queried_object_id()) : '';
	?>
	<script>
	window.dataLayer = window.dataLayer || [];
	<?php if ($thank_you) : ?>
	window.dataLayer.push({
		event: 'cellar_thank_you',
		page_type: 'thank_you',
		thank_you_slug: <?php echo wp_json_encode($slug); ?>
	});
	<?php endif; ?>
	</script>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','<?php echo esc_js($gtm_id); ?>');</script>
	<!-- End Google Tag Manager -->
	<?php
}

function cellar_studio_print_gtm_noscript(): void {
	if (is_admin() || defined('CELLAR_STUDIO_GTM_NOSCRIPT_PRINTED')) {
		return;
	}
	define('CELLAR_STUDIO_GTM_NOSCRIPT_PRINTED', true);

	$gtm_id = rawurlencode(cellar_studio_gtm_id());
	?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo esc_attr($gtm_id); ?>"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	<?php
}

