<?php get_header(); ?>

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

            <div class="single-post__content"><?php the_content(); ?></div>

            <div class="single-post__navs">
                <?php if (get_previous_post_link()) : ?>
                    <div class="single-post__prev">
                        <?php 
                        // Ссылка на предыдущий пост
                        previous_post_link('%link', '← %title'); 
                        ?>
                    </div>
                <?php endif; ?>

                <?php if (get_next_post_link()) : ?>
                    <div class="single-post__next">
                        <?php 
                        // Ссылка на следующий пост
                        next_post_link('%link', '%title →'); 
                        ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>


        <div class="single-post__more">
            <h2>Інші цікаві статті</h2>

            <?php $all = new WP_Query(array(
                'post_type' => 'products_post',
                'post_status' => 'publish',
            ));

            if ($all->have_posts()) { ?>
                <div class="single-post__slider">
                    <div class="swiper-container">
                        <ul class="swiper-wrapper">
                            <?php while ($all->have_posts()) {
                                $all->the_post();
                                global $all;
                            ?>
                                <li class="swiper-slide">
                                    <a class="post" href="<?php the_permalink() ?>">
                                        <?php if ( has_post_thumbnail() ) : ?>
                                            <div class="post__image">
                                                <?php the_post_thumbnail( 'full', array( 'alt' => get_the_title() ) ); ?>
                                            </div>
                                        <?php endif; ?>
                                        

                                        <span class="post__title"><?php the_title(); ?></span>
                                    </a>
                                </li>
                            <?php
                            }
                            wp_reset_postdata(); // сбрасываем переменную $post
                            ?>

                        </ul>
                    </div>
                </div>
            <?php }
            ?>

        </div>
    </div>
</section>

<?php get_footer(); ?>



