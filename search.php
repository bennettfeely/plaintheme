<?php get_header(); ?>
	<main role="main">
		<section>
			<div class="wrapper split">
				<div class="split-container main">
					<?php
						$s = get_search_query();
						$args = array(
							'order' => 'ASC',
							'orderby' => 'relevance',
							'post_type' => 'post',
							'posts_per_page' => -1,
							's' => $s
						);
						$the_query = new WP_Query($args);
					?>
					<h2>
						<?php 
							$search_query = get_search_query();
							$results_length = $the_query->found_posts;
						?>

						<?php if ($results == 0) { ?>
							<h2>No results found for 
								<em><?php echo $search_query; ?></em>
							</h2>
							<p>Sorry about that.</p>
							<p>But if you have a list in mind you might consider <a  href="/submit">submitting a list</a>.</p>
							<p><a class="button" href="http://copypastelist.com/">Return Home</a></p>
						<?php } else if ($results == 1) { ?>
							<h2>1 result found for <em><?php echo $search_query; ?></em>
							</h2>
						<?php } else { ?>
							<h2><?php echo $results; ?> results found for 
								<em><?php echo $search_query; ?></em>
							</h2>
						<?php } ?>
					</h2>
					<ul class="index-list">
						<?php if ( $the_query->have_posts() ):
							while ( $the_query->have_posts() ): $the_query->the_post();

							$content = get_the_content();
							$content = trim($content);
							$content = explode("\n", $content);

							$i = 0;
						?>
							<li>
								<a class="list-link"href="<?php the_permalink(); ?>">
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