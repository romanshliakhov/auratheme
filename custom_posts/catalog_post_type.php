<?php
	function register_catalog_post_type() {
		$labels = array(
			'name'               => 'Каталог',
			'singular_name'      => 'Каталог',
			'add_new'            => 'Add New',
			'add_new_item'       => 'Add New Blog Post',
			'edit_item'          => 'Edit Blog Post',
			'new_item'           => 'New Blog Post',
			'view_item'          => 'View Blog Post',
			'search_items'       => 'Search Blog Posts',
			'not_found'          => 'No blog posts found',
			'not_found_in_trash' => 'No blog posts found in Trash',
			'parent_item_colon'  => '',
			'menu_name'          => 'Каталог'
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'capability_type'    => 'post',
			'rewrite'           => array('slug' => 'catalog'),
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
			'show_in_rest'       => false,
		);

		register_post_type('catalog_post', $args);
	}

	function create_catalog_taxonomies() {
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
			'rewrite'           => array('slug' => 'catalog_category'),
			'show_in_rest'      => false,
			'show_in_nav_menus'  => false,
		);

		register_taxonomy('catalog_category', array('catalog_post'), $args);
		
	}

	add_action('init', 'register_catalog_post_type');
	add_action('init', 'create_catalog_taxonomies');

?>