<?php
// Template Name: Каталог

get_header(); ?>

<section class="catalog-section">
    <div class="container">
        <?php get_breadcrumbs(); ?>

        <h1 class="catalog-section__title"><?php the_title(); ?></h1>

        <div class="catalog-section__wrapp">
            <?php
            // Получаем категории
            $categories = get_terms(array(
                'taxonomy'   => 'monuments_category',
                'hide_empty' => false,
            ));

            if ($categories): ?>
                <ul class="catalog-section__categories">
                    <?php foreach ($categories as $category): ?>
                        <li class="catalog-section__category">
                            <a href="<?php echo esc_url(get_term_link($category)); ?>" 
                               class="catalog-section__category-btn">
                                <?php echo esc_html($category->name); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <div class="catalog-section__box">
                <div>
                    <h2>фільтри</h2>
                </div>

                <ul class="catalog-section__monuments">
                    <?php
                    // Запрос записей
                    $paged = get_query_var('paged') ? get_query_var('paged') : 1;

                    $args = array(
                        'post_type'      => 'monuments',
                        'posts_per_page' => 6,
                        'paged'          => $paged,
                    );

                    $query = new WP_Query($args);

                    if ($query->have_posts()):
                        while ($query->have_posts()): $query->the_post(); ?>
                            <?php echo render_monuments_card(get_the_ID()); ?>
                        <?php endwhile;
                    wp_reset_postdata(); else: ?>
                        <p>Нічого не знайдено.</p>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="text-section">
    <div class="container">
        <div class="text-section__content"><?php the_content(); ?></div>
    </div>

    <div class="text-section__trigger">Розгорнути</div>
</section>

<?php get_footer(); ?>