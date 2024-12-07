<?php
$shower = get_sub_field('shower');
$title  = get_sub_field('title'); // Убедитесь, что переменная задана

if (!$shower) : ?>
    <section class="products-section">
        <div class="container">
            <div class="products-section__wrapp">
                <?php get_breadcrumbs(); ?>

                <?php if ($title): ?>
                    <h1 class="products-section__title"><?php echo esc_html($title); ?></h1>
                <?php endif; ?>

                <?php
                // Получаем подкатегории для текущей категории
                $subcategories = get_terms(array(
                    'taxonomy'   => 'granite_category', // Кастомная таксономия
                    'hide_empty' => false,
                ));

                // Выводим фильтры только если есть подкатегории
                if ($subcategories): ?>
                    <ul class="products-section__categories" id="products-filters">
                        <?php foreach ($subcategories as $subcategory): 
                            $is_active = isset($_GET['category']) && $_GET['category'] === $subcategory->slug;
                        ?>
                            <li class="products-section__category">
                                <button class="products-section__category-btn <?php echo $is_active ? 'active' : ''; ?>" 
                                        data-category-slug="<?php echo esc_attr($subcategory->slug); ?>">
                                    <?php echo esc_html($subcategory->name); ?>
                                </button>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <ul class="products-section__list" id="products-list">
                    <?php
                    $paged = max(1, get_query_var('paged'));
                    $selected_category_slug = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : '';

                    $query_args = array(
                        'post_type'      => 'granite_products',
                        'posts_per_page' => 8,
                        'paged'          => $paged,
                    );

                    // Добавляем фильтр по категории, если указан
                    if ($selected_category_slug) {
                        $query_args['tax_query'] = array(
                            array(
                                'taxonomy' => 'granite_category',
                                'field'    => 'slug',
                                'terms'    => $selected_category_slug,
                            ),
                        );
                    }

                    $products_query = new WP_Query($query_args);

                    if ($products_query->have_posts()):
                        while ($products_query->have_posts()): $products_query->the_post(); ?>
                            <?php echo render_products_card(get_the_ID()); ?>
                        <?php endwhile;
                    else: ?>
                        <p>Записів поки що немає.</p>
                    <?php endif;
                    wp_reset_postdata(); ?>
                </ul>

                <div id="loading-indicator" style="display: none;">Загрузка...</div>
            </div>
        </div>
    </section>
<?php endif; ?>
