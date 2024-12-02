<?php
    $build_folder = get_template_directory_uri() . '/assets/';
    $content  = get_sub_field( 'content' );
    $post_nav_links = get_sub_field( 'post_nav_links' );
    $show_more_posts = get_sub_field( 'show_more' );
    $show_more_title = get_sub_field( 'show_more_title' );
    
?>

<section class="single-post">
    <div class="single-post__breadcrumbs">
        <div class="container">
            <?php get_breadcrumbs(); ?>
        </div>
    </div>

    <div class="single-post__image"><?php the_post_thumbnail( 'full', array( 'alt' => get_the_title() ) ); ?></div>

    <div class="container">
        <div class="single-post__box">
            <h1 class="single-post__title"><?php the_title(); ?></h1>

            <div class="single-post__content"><?php echo $content; ?></div>

            <?php if ( $post_nav_links ) : ?>
                <div class="single-post__navs">
                    <?php if (get_previous_post_link()) : ?>
                        <div class="single-post__prev">
                            <?php previous_post_link('%link', '← %title', true); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (get_next_post_link()) : ?>
                        <div class="single-post__next">
                            <?php next_post_link('%link', '%title →', true); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>

        <?php if ( $show_more_posts ) : ?>
            <div class="single-post__more">
                <h2>Інші цікаві статті</h2>

                <?php
                $categories = get_the_category();
                $category_id = $categories ? $categories[0]->term_id : null;

                if ($category_id) {
                    $all = new WP_Query(array(
                        'cat' => $category_id, 
                        'post_type' => 'post', 
                        'post_status' => 'publish',
                        'posts_per_page' => -1, 
                        'post__not_in' => array(get_the_ID()), 
                    ));

                    if ($all->have_posts()) { ?>
                        <div class="single-post__slider">
                            <div class="swiper-container">
                                <ul class="swiper-wrapper">
                                    <?php while ($all->have_posts()) : $all->the_post(); ?>
                                        <li class="swiper-slide">
                                            <a class="post-card" href="<?php the_permalink(); ?>">
                                                <?php if ( has_post_thumbnail() ) : ?>
                                                    <div class="post__image">
                                                        <?php the_post_thumbnail( 'full', array( 'alt' => get_the_title() ) ); ?>
                                                    </div>
                                                <?php endif; ?>

                                                <span class="post__title"><?php the_title(); ?></span>
                                            </a>
                                        </li>
                                    <?php endwhile; ?>
                                    <?php wp_reset_postdata(); ?>
                                </ul>
                            </div>
                        </div>
                    <?php }
                } else {
                    echo '<p>Постів у цій категорії поки немає.</p>';
                }
                ?>
            </div>
        <?php endif; ?>
    </div>
</section>