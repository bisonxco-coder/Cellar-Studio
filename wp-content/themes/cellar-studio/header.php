<?php
if (!defined('ABSPATH')) {
	exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<!-- Meta Pixel Code: first in head so GTM cannot swallow fbq -->
	<script>
	(function () {
		var pixelId = '<?php echo esc_js(CELLAR_STUDIO_META_PIXEL_ID); ?>';
		if (!window.fbq) {
			var n = function () {
				n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(arguments);
			};
			n.queue = [];
			n.loaded = true;
			n.version = '2.0';
			n.push = n;
			window.fbq = n;
			window._fbq = n;
		}
		if (!document.getElementById('facebook-jssdk')) {
			var t = document.createElement('script');
			t.id = 'facebook-jssdk';
			t.async = true;
			t.src = 'https://connect.facebook.net/en_US/fbevents.js';
			var s = document.getElementsByTagName('script')[0];
			if (s && s.parentNode) {
				s.parentNode.insertBefore(t, s);
			} else if (document.head) {
				document.head.appendChild(t);
			}
		}
		fbq('init', pixelId);
		fbq('track', 'PageView');
		<?php
		$cellar_lead_category = function_exists('cellar_studio_meta_lead_category')
			? cellar_studio_meta_lead_category()
			: null;
		if (is_string($cellar_lead_category) && $cellar_lead_category !== '') :
		?>
		(function () {
			var category = <?php echo wp_json_encode($cellar_lead_category); ?>;
			var stored = null;
			try {
				stored = JSON.parse(sessionStorage.getItem('cellarMetaLead') || 'null');
			} catch (e) {
				stored = null;
			}
			if (stored && stored.category && stored.category !== 'Bespoke Lounge') {
				category = stored.category;
			}

			window.dataLayer = window.dataLayer || [];
			window.dataLayer.push({
				event: 'cellar_lead',
				content_category: category
			});

			if (stored && (stored.em || stored.ph)) {
				var userData = {};
				if (stored.em) userData.em = stored.em;
				if (stored.ph) userData.ph = stored.ph;
				fbq('init', pixelId, userData);
			}
			fbq('track', 'Lead', { content_category: category });
			fbq('trackCustom', category, { content_category: category });
			try {
				sessionStorage.removeItem('cellarMetaLead');
				sessionStorage.removeItem('cellarMetaLeadFired');
			} catch (e) {}
		})();
		<?php endif; ?>
	})();
	</script>
	<!-- End Meta Pixel Code -->

	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=AW-18472679618"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());
	gtag('config', 'AW-18472679618');
	<?php
	if (is_string($cellar_lead_category) && $cellar_lead_category !== '') :
	?>
	gtag('event', 'generate_lead', { content_category: <?php echo wp_json_encode($cellar_lead_category); ?> });
	gtag('event', 'conversion', { send_to: 'AW-18472679618' });
	<?php endif; ?>
	</script>

	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-5K9GJMPQ');</script>
	<!-- End Google Tag Manager -->

	<!-- Microsoft Clarity -->
	<script type="text/javascript">
	(function(c,l,a,r,i,t,y){
		c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
		t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
		y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
	})(window, document, "clarity", "script", "y0u7otieap");
	</script>
	<!-- End Microsoft Clarity -->

	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="p:domain_verify" content="5d04f3db5f493fa481efadd5130ad19b">
	<link rel="icon" type="image/png" href="<?php echo esc_url(cellar_studio_asset('img/favicon.png')); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5K9GJMPQ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<!-- Meta Pixel beacons: fire even if JS is delayed or Data Advisor attached late -->
<img height="1" width="1" style="display:none" alt=""
src="https://www.facebook.com/tr?id=<?php echo esc_attr(CELLAR_STUDIO_META_PIXEL_ID); ?>&ev=PageView&noscript=1">
<?php
$cellar_lead_noscript = function_exists('cellar_studio_meta_lead_category')
	? cellar_studio_meta_lead_category()
	: null;
if (is_string($cellar_lead_noscript) && $cellar_lead_noscript !== '') :
	$cellar_lead_qs = rawurlencode($cellar_lead_noscript);
	?>
<img height="1" width="1" style="display:none" alt=""
src="https://www.facebook.com/tr?id=<?php echo esc_attr(CELLAR_STUDIO_META_PIXEL_ID); ?>&ev=Lead&cd[content_category]=<?php echo esc_attr($cellar_lead_qs); ?>&noscript=1">
<?php endif; ?>

<?php wp_body_open(); ?>
