<div class="search-form-wrapper">
	<form class="search-form" role="search" method="get" action="<?php echo home_url(); ?>">
		<label class="search-wrapper">
			<div class="search-icon-wrapper">
				<div class="search-icon">🔍</div>
				<?php get_template_part('spinner'); ?>
			</div>
			<?php 
				if ( is_category() || is_search()) {
					$placeholder = "Search all lists...";
				} else {
					$placeholder = "Search for a list...";
				}
			?>
			<input class="search-input" type="search" oninput="instantSearch()" onmousemove="forceCurrentIndex(0)" name="s" placeholder="<?php echo $placeholder; ?>" autocomplete="off">
		</label>
	</form>
	<div class="search-instant-results"></div>
</div>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/nanoajax.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/instantsearch.js"></script>