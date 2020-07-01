<?php

// Rename posts to lists in admin menu =================================
	function changePostLabel() {
		global $menu;
		global $submenu;
		$menu[5][0] = 'Lists';
		$submenu['edit.php'][5][0] = 'Lists';
		$submenu['edit.php'][10][0] = 'Add List';
		$submenu['edit.php'][16][0] = 'List Tags';
	}
	function changePostObject() {
		global $wp_post_types;
		$labels = &$wp_post_types['post']->labels;
		$labels->name = 'Lists';
		$labels->singular_name = 'List';
		$labels->add_new = 'Add New List';
		$labels->add_new_item = 'Add New List';
		$labels->edit_item = 'Edit List';
		$labels->new_item = 'New List';
		$labels->view_item = 'View Lists';
		$labels->search_items = 'Search Lists';
		$labels->not_found = 'No List found';
		$labels->not_found_in_trash = 'No Lists found in Trash';
		$labels->all_items = 'All Lists';
		$labels->menu_name = 'Lists';
		$labels->name_admin_bar = 'New List';
	}

	add_action( 'admin_menu', 'changePostLabel' );
	add_action( 'init', 'changePostObject' );

// Make instant search work in Firefox =================================
	function add_cors_http_header(){
	    header("Access-Control-Allow-Origin: https://copypastelist.com");
	}
	add_action('init', 'add_cors_http_header');


// Basic stats =========================================================
	function getPostViews($postID) {
		$count_key = 'post_views_count';
		$count = get_post_meta($postID, $count_key, true);

		if ($count == '') {
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
			return "0";
		}
		return $count;
	}

	function setPostViews($postID) {
		$count_key = 'post_views_count';
		$count = get_post_meta($postID, $count_key, true);

		if ($count == '') {
			$count = 0;
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
		} else {
			$count++;
			update_post_meta($postID, $count_key, $count);
		}
	}
?>