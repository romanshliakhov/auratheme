<?php
    $build_folder = get_template_directory_uri() . '/assets/';
	$shower = get_sub_field( 'shower' );
    $title = get_sub_field( 'title' );

    if ( ! $shower ) : ?>
        <section class="services-section">
            <div class="container">
                <div class="services-section__wrapp">
                    <div class="services-section__top">
                        <?php display_main_top_section('h2',$title ) ?>
                    </div>

                    <?php $posts = get_sub_field('post');
                        if ($posts) : ?>
                            <ul class="services-section__posts">
                                <?php foreach ($posts as $post) : ?>
                                    <?php 
                                    setup_postdata($post); 
                                    $image = get_the_post_thumbnail_url($post, 'thumbnail'); 
                                    $alt = get_post_meta(get_post_thumbnail_id($post), '_wp_attachment_image_alt', true);
                                    $tags = get_the_tags(); // Получаем метки текущего поста
                                    ?>

                                    <li class="services-section__post">
                                        <a class="services-section__post-link" href="<?php the_permalink() ?>">
                                            <?php if ($tags) : ?>
                                                <ul class="services-section__post-tags">
                                                    <?php foreach ($tags as $tag) : ?>
                                                        <li class="services-section__post-tag">
                                                            <?php echo esc_html($tag->name); ?>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php endif; ?>

                                            <span class="services-section__post-image">
                                                <img width="544" height="544" src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($alt); ?>" />
                                            </span>

                                            <span class="services-section__post-title"><?php the_title(); ?></span>
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