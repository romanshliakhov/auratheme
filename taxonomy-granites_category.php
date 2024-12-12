<?php get_header(); 
$term_id = get_queried_object_id(); // Получаем ID текущей таксономии
$content = get_field('content', 'term_' . $term_id); // Получаем значение ACF-поля для термина
?>

<section class="catalog-section">
    <div class="container">
        <?php get_breadcrumbs(); ?>

        <h1 class="catalog-section__title"><?php single_term_title(); ?></h1>

        <div class="catalog-section__wrapp">
            <?php
                // Получаем текущий объект таксономии
                $current_term = get_queried_object();

                if ($current_term && !is_wp_error($current_term)):

                    // Получаем все категории таксономии monuments_category
                    $categories = get_terms(array(
                        'taxonomy'   => 'granites_category',
                        'hide_empty' => false, // Показывать категории, даже если они пустые
                    ));

                    if (!is_wp_error($categories) && !empty($categories)): ?>
                        <ul class="catalog-section__categories">
                            <?php foreach ($categories as $category): 
                                // Проверяем, является ли категория активной
                                $is_active = ($category->term_id === $current_term->term_id); 
                            ?>
                                <li class="catalog-section__category">
                                    <a href="<?php echo esc_url(get_term_link($category)); ?>" 
                                    class="catalog-section__category-btn <?php echo $is_active ? 'active' : ''; ?>">
                                        <?php echo esc_html($category->name); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <ul class="catalog-section__granites">
                        <?php
                        // Запрос записей текущей категории
                        $paged = get_query_var('paged') ? get_query_var('paged') : 1;

                        $args = array(
                            'post_type'      => 'granites',
                            'posts_per_page' => 8,
                            'paged'          => $paged,
                            'tax_query'      => array(
                                array(
                                    'taxonomy' => 'granites_category',
                                    'field'    => 'term_id',
                                    'terms'    => $current_term->term_id,
                                ),
                            ),
                        );

                        $query = new WP_Query($args);

                        if ($query->have_posts()):
                            while ($query->have_posts()): $query->the_post(); ?>
                                <?php echo render_granites_card(get_the_ID()); ?>
                            <?php endwhile;
                            wp_reset_postdata();
                        else: ?>
                            <p>Нічого не знайдено.</p>
                        <?php endif; ?>
                    </ul>
                <?php else: ?>
                    <p>Категорія не знайдена.</p>
                <?php endif; ?>
        </div>
    </div>
</section>

<?php if ($content): ?>
    <section class="text-section">
        <div class="container">
            <div class="text-section__content"><?php echo $content; ?></div>
        </div>
        <div class="text-section__trigger">Розгорнути</div>
    </section>
<?php endif; ?>

<?php get_footer(); ?>

