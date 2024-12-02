<?php
	function register_products_post_type() {
		$labels = array(
			'name'               => 'Гранітні вироби',
			'singular_name'      => 'Гранітні вироби',
			'add_new'            => 'Add New',
			'add_new_item'       => 'Add New Blog Post',
			'edit_item'          => 'Edit Blog Post',
			'new_item'           => 'New Blog Post',
			'view_item'          => 'View Blog Post',
			'search_items'       => 'Search Blog Posts',
			'not_found'          => 'No blog posts found',
			'not_found_in_trash' => 'No blog posts found in Trash',
			'parent_item_colon'  => '',
			'menu_name'          => 'Гранітні вироби'
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'capability_type'    => 'post',
			'rewrite'           => array('slug' => 'products'),
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
			'show_in_rest'       => false,
		);

		register_post_type('products_post', $args);
	}

	function create_products_taxonomies() {
		$labels = array(
			'name'              => 'Blog Categories',
			'singular_name'     => 'Blog Category',
			'search_items'      => 'Search Blog Categories',
			'all_items'         => 'All Blog Categories',
			'edit_item'         => 'Edit Blog Category',
			'update_item'       => 'Update Blog Category',
			'add_new_item'      => 'Add New Blog Category',
			'new_item_name'     => 'New Blog Category Name',
			'menu_name'         => 'Blog Categories',
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array('slug' => 'products_category'),
			'show_in_rest'      => false,
			'show_in_nav_menus'  => false,
		);

		register_taxonomy('products_category', array('products_post'), $args);
		
	}

	add_action('init', 'register_products_post_type');
	add_action('init', 'create_products_taxonomies');

?>

