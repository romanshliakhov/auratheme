<?php
    $build_folder = get_template_directory_uri() . '/assets/';
	$shower = get_sub_field( 'shower' );
    $title = get_sub_field( 'title' );

    if ( ! $shower ) : ?>
        <section class="portfolio-section">
            <div class="container">
                <div class="portfolio-section__wrapp">
                    <?php get_breadcrumbs(); ?>

                    <?php if($title) : ?>
                        <h1 class="contacts-section__title"><?php echo $title ?></h1>
                    <?php endif; ?>

                    <?php
                    $gallery = get_field('gallery', 'gallery');

                    if ($gallery) : ?>
                        <div class="portfolio-section__images" id="portfolio-gallery">
                            <?php 
                            $initial_images = array_slice($gallery, 0, 6); // Берём первые 6 изображений
                            foreach ($initial_images as $image) : ?>
                                <figure class="portfolio-section__image" data-fancybox="gallery" data-src="<?php echo esc_url($image['url']); ?>">
                                    <img src="<?php echo esc_url($image['sizes']['medium']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                    <figcaption><?php echo esc_attr($image['title']); ?></figcaption>
                                </figure>
                            <?php endforeach; ?>
                        </div>
                        
                        <div id="loading-indicator" style="display: none; text-align: center; padding: 20px;">Загрузка...</div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; 
?>