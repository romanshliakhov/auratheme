<?php
$build_folder = get_template_directory_uri() . '/assets/';
$content  = get_sub_field('content');
$show_more_posts = get_sub_field('show_more');
$show_more_title = get_sub_field('show_more_title');
?>

<section class="product-post">
    <div class="container">
        <div class="product-post__wrapp">
            <?php get_breadcrumbs(); ?>

            <div class="product-post__box">
                <div class="product-post__gallery">
                    <?php the_post_thumbnail('full', ['alt' => get_the_title()]); ?>
                </div>

                <div class="product-post__details">
                    <h1 class="product-post__title"><?php the_title(); ?></h1>
                    <div class="product-post__content"><?php echo $content; ?></div>
                </div>
            </div>

            <?php if ($show_more_posts): ?>
                <div class="product-post__more">
                    <h2><?php echo $show_more_title ?: 'Схожі за запитом'; ?></h2>

                    <?php
                    // Получаем первую категорию текущего поста
                    $categories = get_the_terms(get_the_ID(), 'granite_category'); // Меняем на вашу таксономию, если нужно
                    $category_id = $categories ? $categories[0]->term_id : null;

                    if ($category_id):
                        $related_posts = new WP_Query([
                            'post_type'      => 'granite_products', // Укажите ваш кастомный тип постов
                            'post_status'    => 'publish',
                            'posts_per_page' =>  -1,
                            'post__not_in'   => [get_the_ID()],
                            'tax_query'      => [
                                [
                                    'taxonomy' => 'granite_category', // Укажите вашу кастомную таксономию
                                    'field'    => 'term_id',
                                    'terms'    => $category_id,
                                ],
                            ],
                        ]);

                        if ($related_posts->have_posts()): ?>
                            <div class="single-post__slider">
                                <div class="swiper-container">
                                    <ul class="swiper-wrapper">
                                        <?php while ($related_posts->have_posts()): $related_posts->the_post(); ?>
                                            <li class="swiper-slide">
                                                <a class="post-card" href="<?php the_permalink(); ?>">
                                                    <?php if (has_post_thumbnail()): ?>
                                                        <div class="post__image">
                                                            <?php the_post_thumbnail('full', ['alt' => get_the_title()]); ?>
                                                        </div>
                                                    <?php endif; ?>

                                                    <span class="post__title"><?php the_title(); ?></span>
                                                </a>
                                            </li>
                                        <?php endwhile; ?>
                                    </ul>
                                </div>
                            </div>
                        <?php else: ?>
                            <p>Схожих товарів поки немає.</p>
                        <?php endif;

                        wp_reset_postdata();
                    else: ?>
                        <p>Схожих товарів поки немає.</p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
