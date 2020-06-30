<?php get_header(); ?>
	<main role="main">
		<?php if (function_exists('user_submitted_posts')) user_submitted_posts(); ?>
	</main>
<?php get_footer(); ?>