<?php get_header(); ?>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php setPostViews(get_the_ID()); ?>
		<?php
			$category = get_the_category(); 
			$category_name = $category[0]->cat_name;
			$category_slug = strtolower($category_name);
		?>
		<script type="application/ld+json">
			{
				"@context": "https://schema.org",
				"@type": "BreadcrumbList",
				"itemListElement": [
					{
						"@type": "ListItem",
						"position": 1,
						"name": "<?php echo $category_name; ?>",
						"item": "https://copypastelist.com/<?php echo $category_slug; ?>/"
					},
					{
						"@type": "ListItem",
						"position": 2,
						"name": "<?php the_title(); ?>"
					}
				]
			}
		</script>
		<main role="main">
			<section>
				<div class="wrapper split">
					<div class="split-container main">
						<article>
							<h1><?php the_title(); ?></h1>
							<div class="no-select no-print">
								<button class="button copy-button" data-clipboard-target=".content-list">Copy list to clipboard</button>
								<button class="button print-button" onclick="window.print()">Print list</button>
								<?php if ( is_user_logged_in() ) { ?>
									<a class="button edit-button logged-in-button" href="<?php echo get_edit_post_link(); ?>">Edit</a>
									<a class="button admin-button logged-in-button" href="https://copypastelist.com/wp-admin">Admin</a>
								<?php } ?>
							</div>
							<div class="content-list-wrapper">
								<div class="content-list default">
									<?php 
										$content = get_the_content();
										$content = trim($content);
										$content = explode("\n", $content);

										$source_name = get_field( "user_submit_name" );
										$source_url = get_field( "user_submit_url" );

										$i = 0;

										foreach ($content as $value) { 
											echo '<div data-order="' . $i++ . '" class="content-item">' . $value . '</div>';
										}
									?>
								</div>
							</div>
							<div class="print-only">
								<strong>Printed from Copy Paste List</strong> (copypastelist.com)
								<br>
								<div>
									<strong>URL: </strong>
									<code><?php echo get_permalink();?></code>
								</div>
								<div>
									<strong>Updated: </strong>
									<?php echo get_the_modified_date( 'F j, Y' ) ?>
								</div>
								<?php if ( $source_name ) { ?>
									<div>
										<strong>Source: </strong>
										<?php echo $source_name; ?>
									</div>
								<?php } ?>
								<div>
									<strong>List length: </strong>
									<?php echo count($content); ?>
								</div>
							</div>
						</article>
					</div>
					
					<div class="split-container side no-select no-print" role="complementary">
						<?php get_template_part('ad'); ?>
						
						<div class="meta">
							<?php if( is_user_logged_in() ) {?>
								<div class="debug">
									<div class="box">
										<h3>
											<span class="meta-label">Views: </span>
											<span class="meta-value"><?php echo getPostViews(get_the_ID()); ?></span>
										</h3>
									</div>
									<div class="box">
										<h3>
											<span class="meta-label">Tags: </span>
											<span class="meta-value">
												<?php
													$tags = get_the_tags();
													if ($tags) {
														foreach($tags as $tag) {
															echo '<span class="tag">' . $tag->name . '</span>'; 
														}
													} else {
														echo '<span class="tag">none</span>';
													}
												?>
											</span>
										</h3>
									</div>
								</div>
							<?php } ?>

							<div class="box">
								<h3>
								<span class="meta-label">Updated: </span>
									<span class="meta-value">
										<?php echo get_the_modified_date( 'F j, Y' ) ?>
									</span>
								</h3>
							</div>

							
							<?php if ( $source_name ) { ?>
								<div class="box">
									<h3>
										<span class="meta-label">Source: </span>
										<span class="meta-value">
											<a href="<?php echo $source_url; ?>">
												<?php echo $source_name; ?>
											</a>
										</span>
									</h3>
								</div>
							<?php } ?>

							<div class="box">
								<h3>
									<span class="meta-label">List length: </span>
									<span class="meta-value"><?php echo count($content); ?></span>
								</h3>
							</div>

							<div class="box">
								<h3>
									<span class="meta-label">Category: </span>
									<span class="meta-value">
										<?php the_category(', '); ?>		
									</span>
								</h3>
							</div>
						</div>

						<div class="box operations">
							<h3>List order</h3>
							<label class="radio-wrapper sort-default">
								<input type="radio" onchange="sort('default')" name="sort" checked="checked"/><span>Default</span>
							</label>
							<label class="radio-wrapper sort-asc">
								<input type="radio" onchange="sort('asc')" name="sort" /><span>Sort A → Z</span>
							</label>
							<label class="radio-wrapper sort-desc">
								<input type="radio" onchange="sort('desc')" name="sort" /><span>Sort Z → A</span>
							</label>
							<label class="radio-wrapper sort-rand">
								<input type="radio" onclick="sort('rand')" name="sort" /><span>Randomize</span>
							</label>
						</div>

						<div class="box operations">
							<h3>List style</h3>
							<label class="radio-wrapper style-default">
								<input type="radio" onchange="listStyle('default')" name="list_style" checked="checked" /><span>No formatting</span>
							</label>
							<label class="radio-wrapper style-numbers">
								<input type="radio" onchange="listStyle('numbers')" name="list_style" /><span>Numbers</span>
							</label>
							<label class="radio-wrapper style-bullets">
								<input type="radio" onchange="listStyle('bullets')" name="list_style" /><span>Bullets</span>
							</label>
						</div>

						<?php if ( comments_open() ) { get_template_part('comment-form'); } ?>
					</div>
				</div>
			</section>

			<?php related_posts(); ?>
		</main>

	<?php endwhile; endif; ?>

<?php get_footer(); ?>