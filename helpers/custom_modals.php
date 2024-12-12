<?php 
// Регистрация кастомного типа записи
function my_custom_modals() {
    $labels = array(
        'name'                  => 'Модальне вікно',
        'singular_name'         => 'Модальне вікно',
        'menu_name'             => 'Модальні вікна',
        'name_admin_bar'        => 'Modal',
        'add_new'               => 'Add New',
        'add_new_item'          => 'Add New Modal',
        'new_item'              => 'New Modal',
        'edit_item'             => 'Edit Modal',
        'view_item'             => 'View Modal',
        'all_items'             => 'All Modals',
        'search_items'          => 'Search Modals',
        'not_found'             => 'No modals found.',
        'not_found_in_trash'    => 'No modals found in Trash.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'exclude_from_search'=> true, // Исключаем из поиска
        'publicly_queryable' => false, // Отключаем single page
        'has_archive'        => false, // Отключаем archive page
        'rewrite'            => false, // Отключаем поддержку ЧПУ
        'show_in_rest'       => true, // Для поддержки редактора блоков
        'supports'           => array( 'title'), // Поля, которые поддерживает тип записи
        'show_ui'            => true, // Отображать в админке
        'show_in_menu'       => true, // Отображать в меню
        'menu_position'      => 5,    // Позиция в меню админки
        'menu_icon'          => 'dashicons-admin-post', // Иконка в меню
    );

    register_post_type( 'modals', $args );
}

add_action( 'init', 'my_custom_modals' );

function modify_modal_post_link($post_link, $post) {
    if ($post->post_type == 'modals') {
        return '/modal_' . $post->ID;
    }
    return $post_link;
}
add_filter('post_type_link', 'modify_modal_post_link', 10, 2);

function customize_modal_link_results($results, $query) {
    foreach ($results as &$result) {
        if ($result['post_type'] == 'modals') {
            $result['permalink'] = '/modal_' . $result['ID'];
        }
    }
    return $results;
}
add_filter('wp_link_query', 'customize_modal_link_results', 10, 2);

function remove_http_from_modal_links($url, $post) {
    if ($post->post_type == 'modals') {
        return '/modal_' . $post->ID;
    }
    return $url;
}
add_filter('post_link', 'remove_http_from_modal_links', 10, 2);

function modify_modal_shortlink($shortlink, $id, $context, $allow_slugs) {
    $post = get_post($id);
    if ($post && $post->post_type == 'modals') {
        return '/modal_' . $post->ID;
    }
    return $shortlink;
}
add_filter('pre_get_shortlink', 'modify_modal_shortlink', 10, 4);

function strip_protocol_from_links($url) {
    if (strpos($url, '/modal_') !== false) {
        return preg_replace('/.*(/modal_\d+)/', '$1', $url);
    }
    return $url;
}
add_filter('wp_get_attachment_url', 'strip_protocol_from_links', 10, 1);
add_filter('attachment_link', 'strip_protocol_from_links', 10, 1);
add_filter('the_permalink', 'strip_protocol_from_links', 10, 1);

?>
