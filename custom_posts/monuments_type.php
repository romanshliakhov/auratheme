<?php
function register_monuments_post_type() {
    $labels = array(
        'name'               => 'Памʼятники',
        'singular_name'      => 'Памʼятники',
        'add_new'            => 'Додати памʼятник',
        'add_new_item'       => 'Додати новий памʼятник',
        'edit_item'          => 'Редагувати памʼятник',
        'new_item'           => 'Новий памʼятник',
        'view_item'          => 'Переглянути памʼятник',
        'search_items'       => 'Шукати памʼятник',
        'not_found'          => 'Памʼятник не знайдено',
        'not_found_in_trash' => 'Немає памʼятників',
        'parent_item_colon'  => '',
        'menu_name'          => 'Памʼятники',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'capability_type'    => 'post',
        'rewrite'           => array('slug' => 'monuments'),
        'has_archive'        => false,
        'hierarchical'       => true,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
        'show_in_rest'       => false,
        'menu_icon' => 'dashicons-building',
    );

    register_post_type('monuments', $args);
}

function create_monuments_taxonomies() {
    $labels = array(
        'name'              => 'Категорії памʼятників',
        'singular_name'     => 'Категорії памʼятників',
        'search_items'      => 'Шукати категорію памʼятників',
        'all_items'         => 'Всі категорії памʼятників',
        'edit_item'         => 'Редагувати категорію памʼятника',
        'update_item'       => 'Оновити категорію памʼятника',
        'add_new_item'      => 'Додати нову категорію памʼятника',
        'new_item_name'     => 'Назва нової категорії памʼятників',
        'menu_name'         => 'Категорії памʼятників',
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'monuments_category'),
        'show_in_rest'      => false,
    );

    register_taxonomy('monuments_category', array('monuments'), $args);
}

add_action('init', 'register_monuments_post_type');
add_action('init', 'create_monuments_taxonomies');

function render_monuments_card($post_id) {
    $post = get_post($post_id);

    if (!$post) {
        return '<p>Продукт не знайдено.</p>';
    }

    $title = esc_html($post->post_title);
    $permalink = get_permalink($post_id);
    $thumbnail = get_the_post_thumbnail_url($post_id, 'medium'); 

    ob_start(); ?>

    <li class="catalog-section__monument">
        <a href="<?php echo esc_url($permalink); ?>" class="monument-card">
            <div class="monument-card__image">
                <picture>
                    <img width="271" height="271" src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr($title); ?>">
                </picture>
            </div>
            <div class="monument-card__title"><?php echo $title; ?></div>
            <span class="monument-card__link">ДОКЛАДНІШЕ</span>
        </a>
    </li>

    <?php
    return ob_get_clean();
}
