<?php
    $build_folder = get_template_directory_uri() . '/assets/';
	$shower = get_sub_field( 'shower' );
    $title = get_sub_field( 'title' );

    if ( ! $shower ) : ?>
        <section class="blog-section">
            <div class="container">
                <div class="blog-section__wrapp">
                    <div class="blog-section__top">
                        <?php display_main_top_section('h2',$title ) ?>
                    </div>

                    <?php $posts = get_sub_field('post');
                        if ($posts) : ?>
                            <ul class="blog-section__posts">
                                <?php foreach ($posts as $post) : ?>
                                    <?php 
                                    setup_postdata($post); 
                                    $image = get_the_post_thumbnail_url($post, 'thumbnail'); 
                                    $alt = get_post_meta(get_post_thumbnail_id($post), '_wp_attachment_image_alt', true);
                                    ?>

                                    <li class="blog-section__post">
                                        <a class="blog-section__post-item" href="<?php the_permalink() ?>">
                                            <span class="blog-section__post-image">
                                                <img width="544" height="544" src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($alt); ?>" />
                                            </span>

                                            <div class="blog-section__post-info">
                                                <span class="blog-section__post-title"><?php the_title(); ?></span>
                                                <p class="blog-section__post-btn">
                                                    Читати далі
                                                    <?php sprite(16, 16, 'arrow-right'); ?>
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                                <?php wp_reset_postdata(); ?>
                            </ul>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; 
?>