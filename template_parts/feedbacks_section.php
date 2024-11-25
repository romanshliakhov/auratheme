<?php
    $build_folder = get_template_directory_uri() . '/assets/';
	$shower = get_sub_field( 'shower' );
    $title = get_sub_field( 'title' );
    $video = get_sub_field( 'video' );
    $poster_image = get_sub_field('poster_image');

    if ( ! $shower ) : ?>
        <section class="feedbacks" id="feedbacks">
            <div class="container">
                <div class="feedbacks__wrapp">
                    <?php display_main_top_section('h2',$title) ?>

                    <?php if (have_rows('feedbacks')) : ?>
                        <div class="feedbacks__slider swiper-container" data-aos="fade-up" data-aos-duration="500">
                            <ul class="feedbacks__swiper-wrapper swiper-wrapper">
                                <?php while (have_rows('feedbacks')) : the_row(); 
                                    $image = get_sub_field( 'image' );
                                    $text = get_sub_field( 'text' );
                                    ?>
                                    
                                    <li class="feedbacks__slide swiper-slide">
                                        <div class="feedback">
                                            <div class="feedback__image">                            
                                                <img width='450' height='470' src="<?php echo esc_url( $image['url'] ); ?>" 
                                                alt="<?php echo esc_attr( $image['alt'] ); ?>" />
                                            </div>

                                            <div class="feedback__text"><?php echo $text ?></div>
                                        </div>
                                    </li>
                                <?php endwhile; ?>
                            </ul>

                            <div class="feedbacks__slider-controls">
                                <div class="feedbacks__slider-nav feedbacks__slider-prev">
                                    <svg width='80' height='80'>
                                        <use href="<?php echo $build_folder?>img/sprite/sprite.svg#arrow-left"></use>
                                    </svg>
                                </div>

                                <div class="feedbacks__slider-pagination"></div>

                                <div class="feedbacks__slider-nav feedbacks__slider-next">
                                    <svg width='80' height='80'>
                                        <use href="<?php echo $build_folder?>img/sprite/sprite.svg#arrow-right"></use>
                                    </svg>
                                </div>
                            </div>
                        </div>                        
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; 
?>