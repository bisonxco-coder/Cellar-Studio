<?php
if (!defined('ABSPATH')) {
	exit;
}

$currentId = (int) get_the_ID();
$queryArgs = [
	'post_type' => 'post',
	'post_status' => 'publish',
	'posts_per_page' => 8,
	'ignore_sticky_posts' => true,
	'orderby' => 'date',
	'order' => 'DESC',
	'post__not_in' => $currentId ? [$currentId] : [],
];
$q = new WP_Query($queryArgs);

function cellar_studio_estimated_reading_time_minutes_recommended(string $html): int {
	$text = wp_strip_all_tags($html);
	$words = str_word_count($text);
	return max(1, (int) ceil($words / 200));
}
?>

<?php
// If there is only 1 published post (the current one), this will be empty.
// Fallback to latest posts (including current) so the section never renders blank.
if (!$q->have_posts() && $currentId) {
	$queryArgs['post__not_in'] = [];
	$q = new WP_Query($queryArgs);
}
?>

<?php if ($q->have_posts()): ?>
	<?php while ($q->have_posts()): $q->the_post(); ?>
		<?php
		$link = get_permalink();
		$title = get_the_title();
		$date = get_the_date('d M Y');
		$minutes = cellar_studio_estimated_reading_time_minutes_recommended((string) get_the_content());
		$excerpt = has_excerpt() ? get_the_excerpt() : wp_trim_words(wp_strip_all_tags((string) get_the_content()), 24);
		$img = get_the_post_thumbnail_url(get_the_ID(), 'large');
		if (!$img) $img = cellar_studio_asset('img/Projects.png');
		?>
		<div class="swiper-slide">
			<a href="<?php echo esc_url($link); ?>" class="recommended-blog-link text-decoration-none text-reset d-block h-100">
				<article class="news-card recommended-blog-card h-100">
					<div class="news-card-image">
						<img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($title); ?>" loading="lazy" decoding="async">
					</div>
					<div class="news-card-body">
						<p class="news-meta"><?php echo esc_html($date); ?> &nbsp; | &nbsp; <?php echo esc_html($minutes); ?> mins read</p>
						<h3 class="news-card-title"><?php echo esc_html($title); ?></h3>
						<p class="news-card-excerpt"><?php echo esc_html($excerpt); ?></p>
					</div>
				</article>
			</a>
		</div>
	<?php endwhile; ?>
<?php endif; ?>

<?php wp_reset_postdata(); ?>

