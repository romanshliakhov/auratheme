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
                        <div class="single-post__nav prev">
                            <?php previous_post_link('%link', '<svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.20207 0.0292496C8.19503 0.0322717 8.18824 0.0357975 8.18145 0.0395751C8.16957 0.0461229 8.15818 0.0534262 8.14702 0.0614851C8.12932 0.074329 8.11138 0.086921 8.09343 0.0992611C8.0219 0.149377 7.94964 0.198486 7.87981 0.251121C7.82501 0.292422 7.77142 0.335487 7.72147 0.382833C5.29134 2.67634 2.86387 4.97287 0.440045 7.27368C0.288495 7.41773 0.125064 7.58243 0.0513499 7.77282C-0.0650403 8.07302 0.020798 8.3581 0.264489 8.58803C1.91675 10.1472 3.56561 11.7103 5.21568 13.2723C6.08497 14.0953 6.95596 14.9165 7.82258 15.7425C8.01366 15.9246 8.22025 16.0453 8.48528 15.9838C8.73406 15.9261 8.90453 15.7642 8.97339 15.5078C9.0442 15.2442 8.97169 15.0135 8.77965 14.8284C8.46758 14.5279 8.15211 14.2315 7.83762 13.9338C5.77702 11.9833 3.71619 10.0328 1.65511 8.08309C1.63329 8.06244 1.60419 8.05035 1.56515 8.02592C1.83988 7.76502 2.08964 7.52728 2.34012 7.2903C4.44848 5.29421 6.5486 3.28831 8.67272 1.30986C8.76219 1.22675 8.8393 1.12828 8.89507 1.01772C8.94502 0.918748 8.97776 0.80945 8.98358 0.697381C8.98915 0.591356 8.96976 0.484576 8.92465 0.389381C8.87543 0.285119 8.79735 0.198738 8.70594 0.133008C8.59367 0.0519152 8.46103 -0.00877819 8.32185 0.00104355C8.29954 0.00255459 8.27723 0.00608035 8.25541 0.011369C8.23698 0.0159021 8.21928 0.0216944 8.20231 0.0292496L8.20207 0.0292496Z"/>
                                </svg> <p>%title</p>'
                            , true); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (get_next_post_link()) : ?>
                        <div class="single-post__nav next">
                            <?php next_post_link('%link', '<p>%title</p> <svg width="9" height="16" viewBox="0 0 9 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.797935 15.9708C0.804967 15.9677 0.811756 15.9642 0.818546 15.9604C0.830427 15.9539 0.841824 15.9466 0.852978 15.9385C0.870679 15.9257 0.888622 15.9131 0.906566 15.9007C0.978097 15.8506 1.05036 15.8015 1.12019 15.7489C1.17499 15.7076 1.22858 15.6645 1.27853 15.6172C3.70866 13.3237 6.13613 11.0271 8.55995 8.72632C8.7115 8.58227 8.87494 8.41757 8.94865 8.22718C9.06504 7.92698 8.9792 7.6419 8.73551 7.41197C7.08325 5.85283 5.43439 4.28966 3.78432 2.72775C2.91503 1.90473 2.04404 1.08348 1.17742 0.25745C0.986342 0.0753698 0.779749 -0.0452614 0.514718 0.0161867C0.265934 0.0738583 0.095471 0.23579 0.0266068 0.492164C-0.0441973 0.75584 0.0283041 0.986526 0.220348 1.17163C0.53242 1.47207 0.847886 1.76849 1.16238 2.06616C3.22297 4.01666 5.28381 5.96716 7.34489 7.91691C7.36671 7.93756 7.39581 7.94965 7.43485 7.97408C7.16012 8.23498 6.91036 8.47272 6.65988 8.7097C4.55152 10.7058 2.4514 12.7117 0.327282 14.6901C0.237807 14.7733 0.160698 14.8717 0.104928 14.9823C0.0549769 15.0813 0.0222422 15.1906 0.0164226 15.3026C0.0108456 15.4086 0.030244 15.5154 0.0753452 15.6106C0.124569 15.7149 0.202647 15.8013 0.294062 15.867C0.40633 15.9481 0.538966 16.0088 0.67815 15.999C0.700458 15.9974 0.722766 15.9939 0.744589 15.9886C0.763018 15.9841 0.780719 15.9783 0.797692 15.9708H0.797935Z"/>
                                </svg>'
                            , true); ?>
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