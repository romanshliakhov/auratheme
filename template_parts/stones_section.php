<?php
    $build_folder = get_template_directory_uri() . '/assets/';
	$shower = get_sub_field( 'shower' );
    $title = get_sub_field( 'title' );

    if ( ! $shower ) : ?>
        <section class="stones-section">
            <div class="container">
                <div class="stones-section__wrapp">
                    <div class="stones-section__top">
                        <?php display_main_top_section('h2',$title ) ?>
                    </div>

                    <?php $posts = get_sub_field('post');
                        if ($posts) : ?>
                            <ul class="stones-section__posts">
                                <?php foreach ($posts as $post) : ?>
                                    <?php 
                                    setup_postdata($post); 
                                    $image = get_the_post_thumbnail_url($post, 'thumbnail'); 
                                    $alt = get_post_meta(get_post_thumbnail_id($post), '_wp_attachment_image_alt', true);
                                    ?>

                                    <li class="stones-section__post">
                                        <a class="stones-section__post-item" href="<?php the_permalink() ?>">
                                            <span class="stones-section__post-image">
                                                <img width='1150' height='160' src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($alt); ?>" />
                                            </span>

                                            <span class="stones-section__post-title"><?php the_title(); ?></span>
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