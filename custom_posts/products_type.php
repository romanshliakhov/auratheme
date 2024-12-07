<?php
// Регистрация кастомного пост-тайпа "Гранітні вироби"
function register_granite_products_post_type() {
    register_post_type('granite_products', array(
        'labels' => array(
            'name'               => 'Гранітні вироби',
            'singular_name'      => 'Гранітний виріб',
            'add_new'            => 'Додати новий',
            'add_new_item'       => 'Додати новий виріб',
            'edit_item'          => 'Редагувати виріб',
            'new_item'           => 'Новий виріб',
            'view_item'          => 'Переглянути виріб',
            'search_items'       => 'Шукати вироби',
            'not_found'          => 'Вироби не знайдено',
            'not_found_in_trash' => 'В кошику не знайдено виробів',
            'menu_name'          => 'Гранітні вироби',
        ),
        'public'        => true,
        'has_archive'   => false,
        'rewrite'       => array('slug' => 'granite-products'),
        'supports'      => array('title', 'editor', 'thumbnail', 'excerpt'),
        // Убираем стандартные категории и метки
        'taxonomies'    => [], 
        'menu_icon'     => 'dashicons-hammer', // Иконка в админке
        // 'show_in_rest'  => true, // Поддержка редактора Gutenberg
    ));
}
add_action('init', 'register_granite_products_post_type');

// Регистрация кастомной таксономии для "Гранітні вироби"
function register_granite_categories_taxonomy() {
    register_taxonomy('granite_category', 'granite_products', array(
        'labels' => array(
            'name'              => 'Категорії гранітних виробів',
            'singular_name'     => 'Категорія гранітного вироба',
            'search_items'      => 'Пошук категорії',
            'all_items'         => 'Все категории',
            'parent_item'       => 'Родительская категория',
            'parent_item_colon' => 'Родительская категория:',
            'edit_item'         => 'Редактировать категорию',
            'update_item'       => 'Обновить категорию',
            'add_new_item'      => 'Добавить новую категорию',
            'new_item_name'     => 'Назва нової категорії',
            'menu_name'         => 'Категорії',
        ),
        'hierarchical' => true, // Древовидная структура (категории и подкатегории)
        'public'       => true,
        'show_ui'      => true,
        // 'show_in_rest' => true, // Для поддержки Gutenberg
        'rewrite'      => array('slug' => 'granite-category'),
		'show_admin_column' => true,
    ));
}
add_action('init', 'register_granite_categories_taxonomy');

// AJAX-фильтр для "Гранітних виробів"
add_action('wp_ajax_filter_granite_products', 'filter_granite_products');
add_action('wp_ajax_nopriv_filter_granite_products', 'filter_granite_products');

function filter_granite_products() {
    try {
        $paged       = intval($_POST['page'] ?? 1);
        $category_slug = sanitize_text_field($_POST['category_slug'] ?? '');

        $query_args = array(
            'post_type'      => 'granite_products',
            'posts_per_page' => 8,
            'paged'          => $paged,
        );

        if ($category_slug) {
            $query_args['tax_query'] = array(
                array(
                    'taxonomy' => 'granite_category',
                    'field'    => 'slug',
                    'terms'    => $category_slug,
                ),
            );
        }

        $query = new WP_Query($query_args);

        if ($query->have_posts()) {
            ob_start();

            while ($query->have_posts()) : $query->the_post();
                echo render_products_card(get_the_ID());
            endwhile;

            $posts_html = ob_get_clean();
            wp_reset_postdata();

            wp_send_json_success(array(
                'posts'      => $posts_html,
                'current'    => $paged,
                'max_page'   => $query->max_num_pages, // Добавляем максимальное количество страниц
            ));
        } else {
            wp_send_json_error('Продукты не найдены.');
        }
    } catch (Exception $e) {
        wp_send_json_error(array(
            'message' => $e->getMessage(),
        ), 500);
    }
}

// Рендеринг карточки продукта
function render_products_card($post_id) {
    $post = get_post($post_id);

    if (!$post) {
        return '<p>Продукт не знайдено.</p>';
    }

    $title      = $post->post_title;
    $permalink  = get_permalink($post_id);
    $thumbnail  = get_the_post_thumbnail_url($post_id, 'medium');

    ob_start(); ?>

    <li class="products-section__item">
        <a href="<?php echo esc_url($permalink); ?>" class="product-card">
            <div class="product-card__image">
                <?php if ($thumbnail): ?>
                    <picture>
                        <img width="271" height="271" src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr($title); ?>">
                    </picture>
                <?php endif; ?>
            </div>
            <div class="product-card__title"><?php echo esc_html($title); ?></div>
        </a>
    </li>

    <?php
    return ob_get_clean();
}

?>