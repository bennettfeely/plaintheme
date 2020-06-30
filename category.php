<?php get_header(); ?>
	<main>
		<section>
			<div class="wrapper split">
				<div class="split-container main">
					<?php $current_category = get_queried_object(); ?>
					<h1 class="<?php echo strtolower($current_category->name) ?>">
						<?php single_cat_title(); ?>
						<span class="lists-count">
							<?php echo ' (' . $current_category->count . ')'; ?>
						</span>
					</h1>
					<ul class="index-list">
						<?php
							$args = array(
								'cat' => $current_category->cat_ID,
								'order' => 'ASC',
								'orderby' => 'name',
								'post_type' => 'post',
								'posts_per_page' => -1
							);
							$the_query = new WP_Query($args);

							if($the_query->have_posts()):
								while($the_query->have_posts()): $the_query->the_post();

								$content = get_the_content();
								$content = trim($content);
								$content = explode("\n", $content);

								$i = 0;
						?>
						<li>
							<a class="list-link" href="<?php the_permalink(); ?>">
								<span class="list-link-title"><?php the_title(); ?></span>
								<span class="list-link-length"> (<?php echo count($content); ?>)</span>
							</a>
						</li>
				   		<?php endwhile; endif; ?>
					</ul>
				</div>
				<div class="split-container side">
					<?php get_template_part('ad'); ?>
				</div>
			</div>
		</section>
	</main>
<?php get_footer(); ?>