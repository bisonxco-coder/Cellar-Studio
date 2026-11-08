<?php
if (!defined('ABSPATH')) {
	exit;
}

$currentId = (int) get_the_ID();
$queryArgs = [
	'post_type' => 'post',
	'post_status' => 'publish',
	'posts_per_page' => 3,
	'ignore_sticky_posts' => true,
	'orderby' => 'date',
	'order' => 'DESC',
	'post__not_in' => $currentId ? [$currentId] : [],
];
$q = new WP_Query($queryArgs);

function cellar_studio_estimated_reading_time_minutes_hot_topics(string $html): int {
	$text = wp_strip_all_tags($html);
	$words = str_word_count($text);
	return max(1, (int) ceil($words / 200));
}
?>

<?php
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
		$minutes = cellar_studio_estimated_reading_time_minutes_hot_topics((string) get_the_content());
		$img = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
		if (!$img) $img = cellar_studio_asset('img/Projects.png');
		?>
		<li>
			<a href="<?php echo esc_url($link); ?>" class="blog-hot-topic">
				<span class="blog-hot-topic-thumb">
					<img src="<?php echo esc_url($img); ?>" alt="" loading="lazy" decoding="async">
				</span>
				<span class="blog-hot-topic-text">
					<span class="blog-hot-topic-title"><?php echo esc_html($title); ?></span>
					<span class="blog-hot-topic-meta"><?php echo esc_html($date); ?> &nbsp;|&nbsp; <?php echo esc_html($minutes); ?> mins read</span>
				</span>
			</a>
		</li>
	<?php endwhile; ?>
<?php endif; ?>

<?php wp_reset_postdata(); ?>

