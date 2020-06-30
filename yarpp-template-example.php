<?php if (have_posts()):?>
	<section class="no-print">
		<div class="wrapper">
			<div class="container">
				<h3>Related Lists</h3>
				<ul class="index-list">
					<?php while (have_posts()) : the_post(); ?>
						<?php 
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
					<?php endwhile; ?>
				</ul>
			</div>
		</div>
	</section>
<?php else: ?>
	<!-- No related lists to show -->
<?php endif; ?>