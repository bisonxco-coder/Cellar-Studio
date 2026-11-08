<?php
if (!defined('ABSPATH')) {
	exit;
}

if (!function_exists('wc_get_products') || !function_exists('cellar_studio_wc_products_for_collection')) {
	return;
}

/**
 * Args:
 * - default_collection: string (swisscave|racking|humidors)
 * - title: string
 * - subtitle: string
 */
$collection = sanitize_key((string) ($args['default_collection'] ?? $args['tab_slug'] ?? 'swisscave'));
$title = $args['title'] ?? 'Curated Wine &amp; Cigar Collections';
$subtitle = $args['subtitle'] ?? 'Explore premium humidors, wine displays, and storage solutions, carefully selected to complement Cellar Studio environments.';
$products = cellar_studio_wc_products_for_collection($collection);
?>

<section class="section-collections py-5 py-lg-6 reveal reveal--fade" data-collection="<?php echo esc_attr($collection); ?>" data-collections-version="2">
	<div class="container-fluid">
		<div class="text-center mb-4 mb-lg-5 reveal-stagger">
			<h2 class="collections-title reveal"><?php echo wp_kses_post($title); ?></h2>
			<p class="collections-subtitle mt-3 reveal"><?php echo esc_html($subtitle); ?></p>
		</div>

		<div class="collection-slider-wrapper collection-slider-active">
			<div class="swiper collectionSwiper">
				<div class="swiper-wrapper">
					<?php foreach ($products as $p): ?>
						<?php
						/** @var WC_Product $p */
						$permalink = $p->get_permalink();
						$img = $p->get_image_id() ? wp_get_attachment_image_url($p->get_image_id(), 'large') : wc_placeholder_img_src('large');
						$name = $p->get_name();
						$specs_html = function_exists('cellar_studio_wc_card_specs') ? cellar_studio_wc_card_specs($p) : '';
						?>
						<div class="swiper-slide">
							<article class="product-card">
								<div class="product-card-inner">
									<div class="product-card-image">
										<a href="<?php echo esc_url($permalink); ?>">
											<img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($name); ?>" loading="lazy" decoding="async">
										</a>
									</div>
									<div class="product-card-body">
										<h3 class="product-title">
											<a href="<?php echo esc_url($permalink); ?>" style="color: inherit;">
												<?php echo esc_html($name); ?>
											</a>
										</h3>

										<?php echo $specs_html ? $specs_html : ''; ?>
									</div>
								</div>
							</article>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section>
