<?php

if ( ! defined( '_S_VERSION' ) ) {
	define( '_S_VERSION', '1.0.0' );
}

function connect__assets() {
	wp_enqueue_style( 'main_style', get_stylesheet_directory_uri() . '/assets/css/style.css', array(), _S_VERSION );
	wp_enqueue_script( 'main_script', get_template_directory_uri() . '/assets/js/main.js', array(), _S_VERSION, true );
}

add_action( 'wp_enqueue_scripts', 'connect__assets' );


function theme_setup() {
	add_theme_support( 'post-thumbnails' );
}

add_action( 'after_setup_theme', 'theme_setup' );

function register_my_menus() {
	register_nav_menus(
		array(
			'header_nav'   => __( 'Header Menu' ),
		)
	);
}

add_action( 'after_setup_theme', 'register_my_menus' );


// function disable_plugin_updates( $value ) {
// 	if ( isset( $value ) && is_object( $value ) ) {
// 		if ( isset( $value->response ) && is_array( $value->response ) ) {
// 			foreach ( $value->response as $plugin => $data ) {
// 				unset( $value->response[ $plugin ] );
// 			}
// 		}
// 	}

// 	return $value;
// }

// add_filter( 'site_transient_update_plugins', 'disable_plugin_updates' );

function remove_head_scripts() {
	remove_action( 'wp_head', 'wp_print_scripts' );
	remove_action( 'wp_head', 'wp_print_head_scripts', 9 );
	remove_action( 'wp_head', 'wp_enqueue_scripts', 1 );
	remove_action( 'wp_head', 'wp_print_styles', 99 );
	remove_action( 'wp_head', 'wp_enqueue_style', 99 );

	add_action( 'wp_footer', 'wp_print_scripts', 5 );
	add_action( 'wp_footer', 'wp_enqueue_scripts', 5 );
	add_action( 'wp_footer', 'wp_print_head_scripts', 5 );
	add_action( 'wp_head', 'wp_print_styles', 30 );
	add_action( 'wp_head', 'wp_enqueue_style', 30 );

	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'global-styles' );
	wp_dequeue_style( 'classic-theme-styles' );

	wp_deregister_style( 'classic-theme-styles' );
}

add_action( 'wp_enqueue_scripts', 'remove_head_scripts' );


// options ACF
if ( function_exists( 'acf_add_options_sub_page' ) ) {
	acf_add_options_sub_page();
}

//  helpers
load_template( get_template_directory() . '/helpers/contactFormHooks.php', true );
load_template( get_template_directory() . '/components/main_top.php', true );
load_template( get_template_directory() . '/helpers/acf_auto_fields.php', true );

// admin 
function theme_admin_assets() {
	wp_enqueue_style( 'admin-css', get_template_directory_uri() . '/admin/css/theme.css', array(), 1.0 );
	wp_enqueue_script( 'admin-js', get_template_directory_uri() . '/admin/js/theme.js', array(), 1.0, true );
   
	$issetPluginACF = class_exists( 'Acf' );
	wp_localize_script(
	 'admin-js',
	 'theme_js_params',
	 array(
	  'is_acf_exist' => $issetPluginACF,
	  'theme_path'   => get_stylesheet_directory_uri(),
	 )
	);
}
   
add_action( 'admin_enqueue_scripts', 'theme_admin_assets' );

function add_custom_menu_link_class($atts, $item, $args) {
    $atts['class'] = 'menu-link';
    
    return $atts;
}

add_filter('nav_menu_link_attributes', 'add_custom_menu_link_class', 10, 3);