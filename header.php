<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
		
		<title><?php
			if ( is_category() ) {
				echo trim( wp_title('', false) );
				echo ' | ';
			} else 
			if ( is_page() ) {
				echo trim( wp_title('', false) );
				echo ' | ';
			} else 
			if ( is_single() ) {
				echo trim( wp_title('', false) );
				echo ' | ';
			} else 
			if ( is_search() ) {
				echo 'Search for ' . esc_html($s) . ' | ';
			} else 
			if ( is_404() ) {
				echo 'Page Not Found | Copy Paste List';
			} 
			bloginfo('name');
		?></title>
		
		<?php if ( !is_single() ) { ?>
		<meta name="description" content="<?php bloginfo('description'); ?>">
		<?php } else { ?>
		<meta name="description" content="List of <?php echo substr(get_the_title(), 8); ?> with no formatting. Quickly and easily copy and paste lists. Print without clutter.">
		<?php } ?>
		
		<meta name="theme-color" content="#ffffff">
		<meta name="rating" content="general">
		<meta name="google" content="notranslate">
		<meta name="google-site-verification" content="google-site-verification=eUupFo8c8CoFrHSOVBf3X3cU9-kk1FLZeonYLIr7tug">
		
		<?php if ( is_page('instant-search') ) { ?>
		<meta name="robots" content="noindex,nofollow">
		<meta name="googlebot" content="noindex,nofollow">
		<?php } ?>
		
		<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/style.css">
		<link rel="apple-touch-icon" sizes="180x180" href="/wp-content/uploads/fbrfg/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/wp-content/uploads/fbrfg/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/wp-content/uploads/fbrfg/favicon-16x16.png">
		<link rel="shortcut icon" href="/wp-content/uploads/fbrfg/favicon.ico">
		<link rel="manifest" href="<?php echo get_stylesheet_directory_uri(); ?>/site.webmanifest">
	</head>
	<body>
		<div class="page-wrapper">
			<header class="no-select no-print">
				<div class="wrapper">
					<div class="container">
						<h1 class="site-title">
							<a class="site-title-link" href="/">Copy Paste List</a>
							<?php if ( !is_page('submit') ) { ?>
								<?php if ( !is_page('successful-submission') ) { ?>
									<a class="submit-page-link" href="submit">
										<span>Submit<span class="extra-text"> a List</span></span>
									</a>
								<?php } else { ?>
									<a class="submit-page-link" href="submit">
										<span>Submit<span class="extra-text"> Another List</span></span>
									</a>
								<?php } ?>
							<?php } else { ?>
								<small class="submit-page-link disabled">
									<span>Submit<span class="extra-text"> a List</span></span>
								</small>
							<?php } ?>
						</h1>
					</div>
				</div>
			</header>

			<?php if ( 
				!is_404() && 
				!is_page('submit') && 
				!is_page('successful-submission') 
			) { ?>
				<section class="intro no-select no-print">
					<div class="wrapper">
						<div class="container">
							<h3>No popups, No formatting. Just a bunch of quick, updated, copy and paste-able lists.</h3>
							<?php get_template_part('search-form'); ?>
						</div>
					</div>
				</section>
			<?php } ?>