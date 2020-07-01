<section class="submit">
	<div class="wrapper">
		<div class="container">
			<div class="wrapper split">
				<div class="split-heading">
					<div class="mega-icon">✍️</div>
					<h1>Create a New List</h1>
					<?php
						$count = wp_count_posts();
						$list_count = $count->publish;
					?>
					<h2 class="thin">We currently have <span id="submit-list-count"><?php echo $list_count; ?></span> lists on Copy Paste List, and we're always looking for more.</h2>
					<p>You are more than welcome to contribute to this website by submitting your own list.</p>
					<p>All lists are reviewed before publication.</p>
					<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/countup.min.js"></script>
					<script>
						var options = {
							useEasing: true, 
							useGrouping: true
						};
						var demo = new CountUp("submit-list-count", 0, <?php echo $list_count; ?>, 0, 2.5, options);
						demo.start();
					</script>
				</div>
				<div class="important-wrapper">
					<div class="important">
						<h3>Make sure your list...</h3>
						<ul>
							<li>Is backed by a reputable source</li>
							<li>Is in a logical order</li>
							<li>Is appropriate for all ages</li>
							<li>Is objective and definitive</li>
								<ul class="bad">
									<li>Bad: List of the Worst Movies</li>
									<li>Bad: List of Things to do in Paris</li>
								</ul>
							<li>Is finite</li>
								<ul class="bad">
									<li>Bad: List of Colors</li>
									<li>Bad: List of Stars</li>
								</ul>
							<li>Doesn't need frequent updates</li>
								<ul class="bad">
									<li>Bad: List of New York Yankees</li>
									<li>Bad: List of Richest People in the World</li>
								</ul>
						</ul>
					</div>
					<div class="trim-bottom"></div>
				</div>
			</div>

			<form id="usp_form" method="post" enctype="multipart/form-data" action=" https://copypastelist.com/successful-submission/">
				
				<div class="split">
					<fieldset class="submit-title">
						<label for="user-submitted-title">
							<div class="meta-label">List title</div>
							<input class="submit-input" id="user-submitted-title" name="user-submitted-title" type="text" placeholder="List of..." value="" required>
						</label>
					</fieldset>
					<div class="spacer"></div>
					<fieldset class="submit-category">
						<label for="user-submitted-category">
							<div class="meta-label">List category</div>
							<select id="user-submitted-category" name="user-submitted-category" required>
								<option value="">Select a category</option>
								<?php echo usp_get_cat_options(); ?>
							</select>
						</label>
					</fieldset>
				</div>

				<div class="split">
					<fieldset class="submit-custom-source-name">
						<label for="user-submitted-name">
							<div class="meta-label">List source</div>
							<small class="meta-value">e.g. NASA</small>
							<input id="user-submitted-name" name="user-submitted-name" type="text" value="" class="usp-input" required>
						</label>
					</fieldset>
					<div class="spacer"></div>
					<fieldset class="submit-custom-source-url">
						<label for="user-submitted-url">
							<div class="meta-label">List URL</div>
							<small class="meta-value">Wikipedia is discouraged</small>
							<input id="user-submitted-url" name="user-submitted-url" type="url" placeholder="https://" value="" class="usp-input" required>
						</label>
					</fieldset>
				</div>

				
				<fieldset class="submit-content">
					<label for="user-submitted-content">
						<div class="meta-label">List data</div>
						<small class="meta-value">Insert a new line for each data item. Do not include line numbers, bullet points, or any other formatting.</small>
						<textarea id="user-submitted-content" name="user-submitted-content" rows="15" class="submit-textarea" required></textarea>
					</label>	
				</fieldset>

				<fieldset class="submit-email">
					<label for="user-submitted-email">
						<div class="meta-label">Your email address</div>
						<small class="meta-value">(Optional) Receive a notification if your list has been published.</small>
						<input class="submit-input" id="user-submitted-email" name="user-submitted-email" type="email" value="">
					</label>
				</fieldset>

				<!-- <fieldset>
					<label>
						<div class="meta-label">Verification</div>
						<script src="https://www.google.com/recaptcha/api.js" async defer></script>
						<div class="g-recaptcha" data-sitekey="6LdjxqUZAAAAAD1nriqjxNW-Djg4HFqPw9BtRMu0"></div>
					</label>
				</fieldset> -->

				<div class="submit-button-wrapper" id="usp-submit">
					<div class="meta-label">All finished?</div>

					<input type="hidden" class="submit-hidden" name="redirect-override" value="<?php echo esc_url($usp_options['redirect-url']); ?>">
					<input type="submit" class="submit-button button" id="user-submitted-post" name="user-submitted-post" value="Submit List For Review">

					<?php wp_nonce_field('usp-nonce', 'usp-nonce', false); ?>
				</div>
			</form>

			<script>(function(){var e = document.getElementById('usp_verify'); if(e) e.parentNode.removeChild(e);})();</script>
		</div>
	</div>
</section>