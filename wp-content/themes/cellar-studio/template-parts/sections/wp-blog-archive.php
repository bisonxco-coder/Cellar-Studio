<?php
if (!defined('ABSPATH')) {
	exit;
}

$paged = max(1, (int) get_query_var('paged'));
$search = '';
if (isset($_GET['s'])) {
	$search = sanitize_text_field((string) wp_unslash($_GET['s']));
}

$q = new WP_Query([
	'post_type' => 'post',
	'post_status' => 'publish',
	'posts_per_page' => 12,
	'paged' => $paged,
	's' => $search,
]);

function cellar_studio_estimated_reading_time_minutes(string $html): int {
	$text = wp_strip_all_tags($html);
	$words = str_word_count($text);
	$wpm = 200;
	return max(1, (int) ceil($words / $wpm));
}
?>

<div class="row g-4 reveal-stagger">
	<?php if ($q->have_posts()): ?>
		<?php while ($q->have_posts()): $q->the_post(); ?>
			<?php
			$link = get_permalink();
			$title = get_the_title();
			$date = get_the_date('d M Y');
			$minutes = cellar_studio_estimated_reading_time_minutes((string) get_the_content());
			$excerpt = has_excerpt() ? get_the_excerpt() : wp_trim_words(wp_strip_all_tags((string) get_the_content()), 24);
			$img = get_the_post_thumbnail_url(get_the_ID(), 'large');
			if (!$img) $img = cellar_studio_asset('img/Projects.png');
			?>
			<div class="col-12 col-md-6 col-lg-3">
				<a href="<?php echo esc_url($link); ?>" class="recommended-blog-link">
					<article class="news-card reveal blog-archive-card">
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
	<?php else: ?>
		<div class="col-12">
			<p class="text-center mb-0">No posts yet.</p>
		</div>
	<?php endif; ?>
</div>

<?php
$total = (int) $q->max_num_pages;
wp_reset_postdata();

if ($total > 1):
	$addArgs = [];
	if ($search !== '') {
		$addArgs['s'] = $search;
	}
	$links = paginate_links([
		'total' => $total,
		'current' => $paged,
		'type' => 'array',
		'prev_text' => 'Prev',
		'next_text' => 'Next',
		'add_args' => $addArgs,
	]);
?>
<nav class="blog-pagination reveal" aria-label="Blog pages">
	<?php if (is_array($links)): ?>
		<ul class="blog-pagination-pages list-unstyled mb-0 d-flex flex-wrap align-items-center justify-content-center gap-1 gap-sm-2">
			<?php foreach ($links as $l): ?>
				<li><?php echo wp_kses_post($l); ?></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
</nav>
<?php endif; ?>

