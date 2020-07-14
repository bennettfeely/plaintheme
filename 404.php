<?php get_header(); ?>
	<main role="main">
		<section>
			<div class="wrapper">
				<div class="container">
					<?php get_template_part('search-form'); ?>
				</div>
			</div>
		</section>
		<section>
			<div class="wrapper">
				<div class="container">
					<div class="wrapper split split-half split-centered">
						<div class="split-item">
							<div class="mega-icon">💩</div>
							<h1>404. Page Not Found.</h1>
							<h2 class="thin">Sorry, the page you were looking for could not be found. It might have been removed or renamed.</h2>
						</div>
						<div class="split-spacer"></div>
						<aside class="split-item">
							<h3>Maybe one of these random lists interests you?</h3>
							<ul class="list index-list">
								<?php 
									$args = array(
										'orderby' => 'rand',
										'post_type' => 'post',
										'posts_per_page' => 8
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
						</aside>
					</div>
				</div>
			</div>
		</section>
	</main>
<?php get_footer(); ?>