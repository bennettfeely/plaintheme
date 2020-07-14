<form id="autocomplete" class="search-form-wrapper autocomplete">
	<div class="search-wrapper">
		<div class="search-icon">🔍</div>
		<input class="search-input autocomplete-input" type="search" name="s" placeholder="Instantly search all lists..." autocomplete="off">
	</div>
	<ul class="autocomplete-result-list"></ul>
</form>

<script>
	var lists = [<?php 
			$args = array(
				'order' => 'ASC',							
				'orderby' => 'title',
				'post_type' => 'post',
				'posts_per_page' => -1
			);
			$query = new WP_Query($args);
		
			 while ($query->have_posts()) {
				$query->the_post();

				$content = get_the_content();
				$content = trim($content);
				$content = explode("\n", $content);

				$keywords = explode(" ", get_the_title());

		?>{
		title: "<?php the_title(); ?>",
		href: "<?php the_permalink(); ?>",
		length: <?php echo count($content); ?>,
		keywords: [<?php
			$tags = get_the_tags();
			if ($tags) {
				foreach($tags as $tag) {
					echo '"' . $tag->name . '",'; 
				}
			}
		?><?php 
			$js_keyword_array = "";

			foreach ($keywords as $word) {
				$forbidden_words = ["list", "of", "and", "the", "in", "to", "on"];
				$forbidden_chars = ["(", ")"];

				if ( !in_array($word, $forbidden_words, true ) ) {
					$word = strtolower(str_replace($forbidden_chars, "", $word));

					$js_keyword_array .= "\"" . $word . "\",";
				}
			}

		echo substr($js_keyword_array, 0, -1) . "]\n";
		?>
	},
	<?php } ?>];
</script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/autocomplete.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/instantsearch.js"></script>