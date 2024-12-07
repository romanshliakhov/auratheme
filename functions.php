<?php

if ( ! defined( '_S_VERSION' ) ) {
	define( '_S_VERSION', '1.0.0' );
}

function connect__assets() {
	wp_enqueue_style( 'main_style', get_stylesheet_directory_uri() . '/assets/css/style.css', array(), _S_VERSION );
	wp_enqueue_script( 'main_script', get_template_directory_uri() . '/assets/js/main.js', array(), _S_VERSION, true );

	wp_localize_script(
		'main_script', 'ajax_params',
		
		array(
		 'ajax_url' => admin_url( 'admin-ajax.php' ),
		 'themeUrl' => get_template_directory_uri(),
		)
	);
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
			'catalog_nav'   => __( 'Catalog Menu' ),
		)
	);
}

add_action( 'after_setup_theme', 'register_my_menus' );

// options ACF
if ( function_exists( 'acf_add_options_sub_page' ) ) {
	acf_add_options_sub_page();
}

// Gallery ACF
if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page( array(
		'page_title' => 'Каталог 3D проектів',
		'menu_title' => 'Каталог 3D проектів',
		'menu_slug'  => 'acf-options-gallery-settings',
		'capability' => 'edit_posts',
		'redirect'   => false,
		'post_id'    => 'gallery',
	) );
}

$theme_dir = get_template_directory();

$helpers = array(
	'/helpers/default_reset.php',
	'/helpers/allow_svg_upload.php',
	'/helpers/contact_form_hooks.php',
	'/helpers/acf_auto_fields.php',
	'/helpers/remove_post_slug.php',

	'/components/main_top.php',
	'/components/global/breadcrumbs.php',
	// '/components/global/pagination.php',
	'/components/global/display_sprite.php',

	'/custom_posts/post_type.php',
	'/custom_posts/products_type.php',

	'/custom_posts/catalog_post_type.php',
);
   
foreach ( $helpers as $helper ) {
	require_once $theme_dir . $helper;
}

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

function show_template() {
	global $template;
	echo '<div> Template used: ' . basename( $template ) . ' </div>';
}

// Show template 
add_action( 'after_setup_theme', 'theme_setup' );
add_action('wp_head', 'show_template'); 


function enqueue_portfolio_scripts() {
    // Подключаем ваш JS-файл (замените 'portfolio.js' на путь к вашему JS-файлу)
    // wp_enqueue_script('portfolio-script', get_template_directory_uri() . '/assets/js/portfolio.js', array('jquery'), null, true);

    // Передаём AJAX URL в ваш скрипт
    wp_localize_script('portfolio-script', 'ajaxurl', admin_url('admin-ajax.php'));
}
add_action('wp_enqueue_scripts', 'enqueue_portfolio_scripts');


// portfolio
function load_more_gallery_images() {
    if (!isset($_POST['offset'])) {
        wp_send_json_error('Offset not provided');
    }

    $offset = intval($_POST['offset']);
    $gallery = get_field('gallery', 'gallery');

    if (!$gallery || $offset >= count($gallery)) {
        wp_send_json_error('No more images to load');
    }

    $images_to_load = array_slice($gallery, $offset, 6); // Следующие 6 изображений
    $output = '';

    foreach ($images_to_load as $image) {
        $output .= '<figure class="portfolio-section__image" data-fancybox="gallery" data-src="' . esc_url($image['url']) . '">';
        $output .= '<img src="' . esc_url($image['sizes']['medium']) . '" alt="' . esc_attr($image['alt']) . '" />';
        $output .= '<figcaption>' . esc_attr($image['title']) . '</figcaption>';
        $output .= '</figure>';
    }

    wp_send_json_success($output);
}
add_action('wp_ajax_load_more_gallery_images', 'load_more_gallery_images');
add_action('wp_ajax_nopriv_load_more_gallery_images', 'load_more_gallery_images');







