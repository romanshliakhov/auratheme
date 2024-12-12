<?php
function register_granites_post_type() {
    $labels = array(
        'name'               => 'Гранітні вироби',
        'singular_name'      => 'Гранітні вироби',
        'add_new'            => 'Додати гранітний вироб',
        'add_new_item'       => 'Додати гранітний вироб',
        'edit_item'          => 'Редагувати гранітний вироб',
        'new_item'           => 'Новий гранітний вироб',
        'view_item'          => 'Переглянути гранітний вироб',
        'search_items'       => 'Шукати гранітний вироб',
        'not_found'          => 'гранітних виробів не знайдено',
        'not_found_in_trash' => 'Немає гранітних виробів',
        'parent_item_colon'  => '',
        'menu_name'          => 'Гранітні вироби',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'capability_type'    => 'post',
        'rewrite'           => array('slug' => 'granites'),
        'has_archive'        => false,
        'hierarchical'       => true,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments'),
        'show_in_rest'       => false,
        'menu_icon' => 'dashicons-hammer',
    );

    register_post_type('granites', $args);
}

function create_granites_taxonomies() {
    $labels = array(
        'name'              => 'Категорії гранітних виробів',
        'singular_name'     => 'Категорії гранітних виробів',
        'search_items'      => 'Шукати категорію гранітних виробів',
        'all_items'         => 'Всі категорії гранітних виробів',
        'edit_item'         => 'Редагувати категорію гранітних виробів',
        'update_item'       => 'Оновити категорію гранітних виробів',
        'add_new_item'      => 'Додати нову категорію гранітних виробів',
        'new_item_name'     => 'Назва нової категорії гранітних виробів',
        'menu_name'         => 'Категорії гранітних виробів',
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'granites_category'),
        'show_in_rest'      => false,
    );

    register_taxonomy('granites_category', array('granites'), $args);
}

add_action('init', 'register_granites_post_type');
add_action('init', 'create_granites_taxonomies');

function render_granites_card($post_id) {
    $post = get_post($post_id);

    if (!$post) {
        return '<p>Продукт не знайдено.</p>';
    }

    $title = esc_html($post->post_title);
    $permalink = get_permalink($post_id);
    $thumbnail = get_the_post_thumbnail_url($post_id, 'medium'); 

    ob_start(); ?>

    <li class="catalog-section__granite">
        <a href="<?php echo esc_url($permalink); ?>" class="monument-card">
            <div class="monument-card__image">
                <picture>
                    <img width="271" height="271" src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr($title); ?>">
                </picture>
            </div>
            <div class="monument-card__title"><?php echo $title; ?></div>
        </a>
    </li>

    <?php
    return ob_get_clean();
}
