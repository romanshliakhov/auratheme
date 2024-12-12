<?php

if ( ! defined( '_S_VERSION' ) ) {
	define( '_S_VERSION', '1.0.0' );
}

function connect__assets() {
	wp_enqueue_style( 'main_style', get_stylesheet_directory_uri() . '/assets/css/style.css', array(), _S_VERSION );
	wp_enqueue_script( 'main_script', get_template_directory_uri() . '/assets/js/main.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'portfolio_script', get_template_directory_uri() . '/assets/js/main.js', array(), _S_VERSION, true );

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
			'footer_nav'   => __( 'Footer Menu' ),
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
	// '/helpers/custom_modals.php',

	'/components/main_top.php',
	'/components/global/breadcrumbs.php',
	// '/components/global/pagination.php',
	'/components/global/display_sprite.php',

	'/custom_posts/monuments_type.php',
	'/custom_posts/granite_type.php',
	'/custom_posts/post_type.php',

	// '/custom_posts/portfolio.php',
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
// add_action( 'after_setup_theme', 'theme_setup' );
// add_action('wp_head', 'show_template'); 


// Modals
// function generate_modal_content($post_id) {
//     // Получаем данные поста и ACF поля
//     $post = get_post($post_id);
//     $acf_fields = get_fields($post_id);

//     if (!$post || !$acf_fields) {
//         return '<div class="popup__content">Модальное окно не найдено.</div>'; // Возвращаем сообщение, если пост или данные не найдены
//     }

//     $modal_type = $acf_fields['modal_type'] ?? '';
//     $default_content = $acf_fields['default_content'] ?? '';
//     $default_image = $acf_fields['default_image'] ?? array('url' => '', 'alt' => 'Default Image');

//     // Генерация стандартного контента модалки, если тип модалки не указан
//     if (!$modal_type) {
//         $defaultImageSrc = $default_image['url'];
//         $defaultImageAlt = $default_image['alt'];

//         $markup = '
//             <div class="popup__content max-w-[560px]">
//                 <div class="w-full h-fit bg-white">
//                     <div><img class="w-full object-cover" src="' . esc_url($defaultImageSrc) . '" alt="' . esc_attr($defaultImageAlt) . '" /></div>
//                     <div class="flex px-5 pb-[30px] md:px-[50px] md:pb-10 flex-col gap-7 xl:gap-10">
//                         <div class="w-[100px] h-1 bg-mainYellow"></div>
//                         <div class="flex flex-col gap-5 editor">
//                             <div class="flex flex-col gap-2">' . $default_content . '</div>
//                         </div>
//                     </div>
//                 </div>
//             </div>';
//     } else {
//         // Генерация кастомного контента для модалки
//         $custom_modal = $acf_fields['custom_modal'] ?? array();
//         $markupInner = '';

//         foreach ($custom_modal as $item) {
//             $show_heading = $item['show_heading'] ?? false;
//             $heading = $item['heading'] ?? '';
//             $title = $item['title'] ?? '';
//             $content = $item['content'] ?? '';
//             $desktop_image_box = $item['desktop_image_box'] ?? array('url' => '', 'alt' => 'Desktop Image');
//             $right_content = $item['right_content'] ?? '';
//             $add_decor = $item['add_decor'] ?? false; // Дополнительное условие для декора
        
//             // Разметка заголовков и контента
//             $headingMarkup = ($show_heading && $heading) ? '<span class="text-mainYellow font-bold text-sm uppercase">' . $heading . '</span>' : '';
//             $titleMarkup = $title ? '<h4 class="title-mini">' . $title . '</h4>' : '';
//             $contentMarkup = $content ? '<div class="editor">' . $content . '</div>' : '';
//             $desktopImageSrc = $desktop_image_box['url'];
//             $desktopImageAlt = $desktop_image_box['alt'];
//             $rightContentMarkup = $right_content ? '<div class="example-item__content editor">' . $right_content . '</div>' : '';
        
//             // Добавление класса example-item--decor, если условие выполнено
//             $decorClass = $add_decor ? ' example-item--decor' : '';
        
//             $markupInner .= '
//                 <div class="popup-examples-item grid md:grid-cols-2 gap-[30px] xl:gap-10">
//                     <div class="flex flex-col w-full gap-[25px]">
//                         ' . $headingMarkup . '
//                         <div class="flex flex-col w-full gap-[25px]">
//                             ' . $titleMarkup . '
//                             ' . $contentMarkup . '
//                         </div>
//                     </div>
//                     <div class="example-item h-fit' . $decorClass . '">
//                         <div><img class="w-full object-cover" src="' . esc_url($desktopImageSrc) . '" alt="' . esc_attr($desktopImageAlt) . '" /></div>
//                         ' . $rightContentMarkup . '
//                     </div>
//                 </div>';
//         }
        

//         $markup = '
//             <div class="popup__content max-w-[1200px]">
//                 <div class="white-block flex flex-col gap-[60px] xl:gap-[100px]">
//                     ' . $markupInner . '
//                 </div>
//             </div>';
//     }

//     return $markup;
// }

// function get_modal_content() {
//     if (isset($_POST['post_id'])) {
//         $post_id = intval($_POST['post_id']);

//         if ($post_id) {
//             $modal_content = generate_modal_content($post_id);
//             wp_send_json_success(array('content' => $modal_content));
//         } else {
//             wp_send_json_error('Некорректный ID поста.');
//         }
//     } else {
//         wp_send_json_error('ID поста не передан.');
//     }
// }

// add_action('wp_ajax_get_modal_content', 'get_modal_content');
// add_action('wp_ajax_nopriv_get_modal_content', 'get_modal_content');

// ?>
