<?php
$shower  = get_sub_field( 'shower' );
$title  = get_sub_field( 'title' );
$current_category_id = get_sub_field( 'post' );
$type = get_sub_field( 'post_choose' );

if ( ! $shower ) : ?>
    <section class="post" data-type="<?= $current_category_id; ?>|<?= $type; ?>">
        <div class="container">
            <?php get_breadcrumbs(); ?>

            <div class="post__wrapp">
                <?php if ( $title ): ?>
                    <h1 class="post__title"><?php echo $title; ?></h1>
                <?php endif; ?>

                <ul class="post__items <?= esc_attr( $type ); ?>">
                    <?php
                    $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

                    $query_args = array(
                        'cat' => $current_category_id,
                        'paged' => $paged,
                    );

                    // Если это блог, добавляем ограничение на количество постов
                    if ( $type === 'blog' ) {
                        $query_args['posts_per_page'] = 3;
                    } else {
                        $query_args['posts_per_page'] = -1;
                    }

                    $news_query = new WP_Query( $query_args );

                    if ( $news_query->have_posts() ) :
                        while ( $news_query->have_posts() ) : $news_query->the_post(); ?>
                            <?php echo render_news_card( get_the_ID(), $type ); ?>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <p>Записів поки що немає.</p>
                    <?php endif;
                    wp_reset_postdata(); ?>
                </ul>

                <?php 
                // Пагинация только для типа "blog"
                if ( $type === 'blog' ) : 
                    echo display_pagination( $news_query->max_num_pages, $paged ); 
                endif; 
                ?>
            </div>
        </div>
    </section>
<?php endif; ?>
