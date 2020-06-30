<div class="box">
	<button class="button comment-toggle-button">Suggest an edit</button>
	<form class="comment-form">
		<h3 class="meta-label">Suggest an edit</h3>
		<small class="meta-value">Feedback you provide helps keep Copy Paste List updated and accurate.</small>
		<textarea class="comment-textarea" name="comment" id="comment" rows="4" required></textarea>
		<div class="comment-submit">
			<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>">
			<input class="button comment-submit-button" type="submit" name="submit" value="Send">
			<div class="comment-spinner-wrapper">
				<?php get_template_part('spinner'); ?>
			</div>
		</div>
		<?php do_action('comment_form', $post->ID); ?>
	</form>
	<p class="comment-status"></p>
</div>