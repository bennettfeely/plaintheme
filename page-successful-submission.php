<?php get_header(); ?>
	<main role="main">
		<section class="submit">
			<div class="wrapper">
				<div class="container">
					<div class="wrapper split">
						<div class="split-heading">
							<div class="mega-icon">✅</div>
							<h1>List submission successful!</h1>
							<h2 class="thin">Thank you!</h2>
							<p>Your list has been received. Now it will be reviewed and if approved, included in our index of lists.</p>
						</div>
						<?php
							$post_id = $_GET['post_id'];
							$args = array(
								'p' => $post_id,
								'post_status' => 'any',
								'post_type' => 'post'
							);
							$the_query = new WP_Query($args);
						
							if ($the_query->have_posts()):
							while($the_query->have_posts()): $the_query->the_post();

								$content = get_the_content();
								$content = trim($content);
								$content = explode("\n", $content);

								$source_name = get_field( "user_submit_name" );
								$source_url = get_field( "user_submit_url" );
						?>
						<div class="important-wrapper">
							<div class="important">
								<table>
									<tr>
										<td class="meta_label">List title</td>
										<td class="meta_value"><?php the_title(); ?></td>
									</tr>
									<tr>
										<td class="meta_label">List length</td>
										<td class="meta_value"><?php echo count($content); ?></td>
									</tr>
									<tr>
										<td class="meta_label">List source</td>
										<td class="meta_value"><?php echo $source_name; ?></td>
									</tr>
									<tr>
										<td class="meta_label">List source URL</td>
										<td class="meta_value">
											<a href="<?php echo $source_url; ?>">
												<?php echo $source_url; ?>
											</a>
										</td>
									</tr>
									<tr>
										<td class="meta_label">List category</td>
										<td class="meta_value"><?php the_category( ', ' ); ?></td>
									</tr>
									<tr>
										<td class="meta_label">List submitted</td>
										<td class="meta_value">
											<?php echo get_the_modified_date('F j, Y'); ?>
											<br>
											<?php echo get_the_modified_date('g:i:s A'); ?> UTC
										</td>
									</tr>
									<tr>
										<td class="meta_label">List status</td>
										<td class="meta_value">
											<?php
												$get_status = get_post_status();

												if ($get_status == 'pending') {
													$status = 'Pending Review';
												} else 
												if ($get_status == 'publish') {
													$status = 'Published';
												} else
												if ($get_status == 'trash') {
													$status = 'Not Published';
												} else {
													$status = 'List Received';
												}
												echo 'List ' . $status;
											?>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="submit-preview">
						<h1><?php the_title(); ?></h1>
						<?php 
							$i = 0;
							foreach ($content as $value) { 
						?>
						<div class="content_item">
							<?php echo $value; ?>
						</div>
						<?php } ?>
						<?php if( is_user_logged_in() ) {?>
							<a class="button logged-in-button" href="<?php echo get_edit_post_link(); ?>">Edit list</a>
						<?php } ?>
					</div>
					<div class="submit-footing">
						<h3>Want to contribute some more?</h3>
						<a class="submit-page-link" href="submit">
							<span>Submit<span class="extra-text"> Another List</span></span>
						</a>
					</div>
				</div>
			<?php endwhile; endif; ?>
			</div>
		</section>
	</main>
<?php get_footer(); ?>