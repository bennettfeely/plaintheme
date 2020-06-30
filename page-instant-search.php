<?php 
	$instant_s = $_GET['instant_s'];
	$args = array(
		'post_type' => 'post',
		'posts_per_page' => 10,
		'orderby' => 'relevance',
		'order' => 'ASC',
		's' => $instant_s
	);
	$the_query = new WP_Query($args);
	$i = 0;
?>

<?php if ( $the_query->have_posts() ) : ?>

	<ul class="index-list instant-index-list">
		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<?php 
				$content = get_the_content();
				$content = trim($content);
				$content = explode("\n", $content);

				// Incremement [data-instant-index]
				$i++;
			?>
			<li class="list-item">
				<a class="list-link" data-instant-index="<?php echo $i; ?>" href="<?php the_permalink(); ?>" onmousemove="forceCurrentIndex(<?php echo $i; ?>)">
					<span class="list-link-title"><?php the_title(); ?></span>
					<span class="list-link-length"> (<?php echo count($content); ?>)</span>
				</a>
			</li>
		<?php endwhile; ?>
	</ul>

	<?php wp_reset_postdata(); ?>

<?php else : ?>
	<!-- No Results -->
<?php endif; ?>