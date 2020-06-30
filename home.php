<?php get_header(); ?>
	<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@type": "WebSite",
			"url": "https://copypastelist.com/",
			"potentialAction": {
				"@type": "SearchAction",
				"target": "https://copypastelist.com/?s={search_term_string}",
				"query-input": "required name=search_term_string"
			}
		}
	</script>
	<main role="main">
		<section class="categories-index-section">
			<div class="wrapper">
				<div class="container">
					<h2 class="no-select">Index of Categories</h2>
					<ul class="category-list">
						<?php 
							$categories = get_categories(array(
								'exclude' => 1,
								'hide_empty' => false,
								'order' => 'ASC',
								'orderby' => 'name'
							));
						?>
						<?php foreach($categories as $category) { ?>
							<li class="half">
								<a href="<?php echo strtolower($category->name) ?>/" class="list-link <?php echo strtolower($category->name) ?>" ?>
									<span class="list-link-title"><?php echo $category->name ?></span>
									<span class="list-link-length"> (<?php echo $category->count; ?>)</span>
								</a>
							</li>
						<?php } ?>
					</ul>
					<?php if ( is_user_logged_in() ) { ?>
						<a class="button admin-button logged-in-button" href="https://copypastelist.com/wp-admin">Admin</a>
					<?php } ?>
				</div>
			</div>
		</section>

		<?php 
			$the_query = new WP_Query(
				array( 
					'post_type' => 'any',
					'orderby' => 'none',
					'post__in' => array(
						21, // List of Countries and Territories
						31, // List of US Presidents
						96, // List of US States
						25 // List of Chemical Elements
					)
				)
			);
		?>
		<?php if ( $the_query->have_posts() ) : ?>
			<section class="popular-lists-section">
				<div class="wrapper">
					<div class="container">
						<h2 class="no-select">Popular Lists</h2>
						<ul class="popular-list">					 
							<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
								<?php 
									$content = get_the_content();
									$content = trim($content);
									$content = explode("\n", $content);
								?>
								<li class="popular-list-item">
									<a class="list-link" href="<?php the_permalink(); ?>">
										<span class="list-link-title"><?php the_title(); ?></span>
										<span class="list-link-length"> (<?php echo count($content); ?>)</span>
										<ol class="popular_list_preview">
											<?php 
												for ($i = 1; $i <= 5; $i++) { 
													echo '<li>' . $content[$i] . '</li>';
												}
											?>
										</ol>
									</a>
								</li>
							<?php endwhile; ?>
						</ul>
					</div>
				</div>
			</section>
		<?php wp_reset_postdata(); else : endif; ?>

		<section class="index-section">
			<div class="wrapper">
				<div class="container">
					<h2 class="no-select">
						Index of Lists
						<span class="lists-count">
							<?php
								$count = wp_count_posts();
								$list_count = $count->publish;
								echo ' (' . $list_count . ')';
							?>
						</span>
					</h2>
					<ul class="list index-list">
						<?php 
							$args = array(
								'order' => 'ASC',							
								'orderby' => 'title',
								'post_type' => 'post',
								'posts_per_page' => -1
							);
							$query = new WP_Query($args);
						?>
						<?php while ($query->have_posts()) {
							$query->the_post();
		
							$content = get_the_content();
							$content = trim($content);
							$content = explode("\n", $content);
						?>
							<li>
								<a class="list-link" href="<?php the_permalink(); ?>">
									<span class="list-link-title"><?php the_title(); ?></span>
									<span class="list-link-length"> (<?php echo count($content); ?>)</span>
								</a>
							</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</section>

	</main>

<?php get_footer(); ?>