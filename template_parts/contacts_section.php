<?php
    $build_folder = get_template_directory_uri() . '/assets/';
	$shower = get_sub_field( 'shower' );

    if ( ! $shower ) : ?>
        <section class="banner-section">
            <div class="container container--max">
                <?php if (have_rows('banners')) : ?>
                    <div class="banner-section__slider">
                        <div class="swiper-container">
                            <ul class="swiper-wrapper">
                                <?php while (have_rows('banners')) : the_row(); 
                                    $image = get_sub_field( 'image' );
                                    $title = get_sub_field( 'title' );
                                    ?>
                                    
                                    <li class="swiper-slide">
                                        <div class="banner-section__slide">
                                            <div class="banner-section__slide-image">                            
                                                <img width='450' height='470' src="<?php echo esc_url( $image['url'] ); ?>" 
                                                alt="<?php echo esc_attr( $image['alt'] ); ?>" />
                                            </div>

                                            <!-- <h1 class="banner-section__slide-title"><?php echo $title ?></h1> -->

                                            <div class="container">
                                                <h1 class="banner-section__slide-title"><?php echo $title ?></h1>
                                            </div>
                                        </div>
                                    </li>
                                <?php endwhile; ?>
                            </ul>

                            <span class='swiper-pagination'></span>
                        </div>               
                    </div>         
                <?php endif; ?>
            </div>
        </section>
    <?php endif; 
?>