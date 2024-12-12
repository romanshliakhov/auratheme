<?php
    $build_folder = get_template_directory_uri() . '/assets/';
	$shower = get_sub_field( 'shower' );
    $title = get_sub_field( 'title' );

    if ( ! $shower ) : ?>
        <section class="works-section">
            <div class="container">
                <?php display_main_top_section('h2',$title ) ?>
            </div>

            <?php
            $gallery = get_field('gallery', 'gallery');

            if ($gallery) : ?>
                <div class="works-section__slider">
                    <div class="swiper-container">
                        <ul class="swiper-wrapper">
                            <?php foreach ($gallery as $image) : ?>
                                <li class="swiper-slide">
                                    <div class="works-section__image">
                                        <img src="<?php echo esc_url($image['sizes']['large']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <button class="swiper-button prev">
                        <?php sprite(32, 54, 'arrow-left'); ?>
                    </button>
                    <button class="swiper-button next">
                        <?php sprite(32, 54, 'arrow-right'); ?>
                    </button>
                </div>
            <?php endif; ?>
        </section>
    <?php endif; 
?>