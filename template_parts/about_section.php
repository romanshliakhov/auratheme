<?php
    $build_folder = get_template_directory_uri() . '/assets/';
	$shower = get_sub_field( 'shower' );
    $title = get_sub_field( 'title' );
    $video = get_sub_field( 'video' );
    $poster_image = get_sub_field('poster_image');

    if ( ! $shower ) : ?>
        <section class="about" id="about">
            <div class="container">
                <div class="about__wrapp">
                    <?php display_main_top_section('h2',$title); ?>

                    <?php if (have_rows('slider')) : ?>
                        <div class="about__slider swiper-container" data-aos="fade-up" data-aos-duration="500">
                            <ul class="about__swiper-wrapper swiper-wrapper">
                                <?php while (have_rows('slider')) : the_row(); 
                                    $image = get_sub_field( 'image' );
                                    $text = get_sub_field( 'text' );
                                    ?>
                                    
                                    <li class="about__slide swiper-slide">
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

                            <div class="about__slider-pagination"></div>
                        </div>                        
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; 
?>