<?php
    $build_folder = get_template_directory_uri() . '/assets/';
	$shower = get_sub_field( 'shower' );
    $bg = get_sub_field('bg');
    $bg_mob = get_sub_field('bg_mob');
    $heading = get_sub_field( 'heading' );
    $title = get_sub_field( 'title' );
    $link = get_sub_field( 'link' );


    if ( ! $shower ) : ?>
        <section class="hero">
            <?php if ($bg): ?>
                <div class="hero__bg">
                    <picture>
                        <source media='(max-width: 575px)' srcset='<?php echo esc_url( $bg_mob['url'] ); ?>'>
                        <img src="<?php echo esc_url( $bg['url'] ); ?>" alt="<?php echo esc_attr( $bg['alt'] ); ?>" />
                    </picture>
                </div>
            <?php endif; ?>

            <div class="container">
                <div class="hero__wrapp">
                    <?php if ($heading): ?>
                        <span class="hero__heading" data-aos="fade-up" data-aos-duration="550">
                            <?php echo $heading ?>
                        </span>
                    <?php endif; ?>

                    <?php if ($title): ?>
                        <div class="hero__text" data-aos="fade-up" data-aos-duration="700">
                            <?php echo $title; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <?php if ( $link ) :
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self'; ?>

                <a class="hero__anchor menu-link"
                    data-aos="fade-right" data-aos-duration="1000" data-aos-offset="0"
                    href="<?php echo esc_url( $link_url ); ?>"
                    target="<?php echo esc_attr( $link_target ); ?>"
                    >

                    <svg width='25' height='25'>
                        <use href="<?php echo $build_folder?>img/sprite/sprite.svg#anchor"></use>
                    </svg>
                    <p><?php echo esc_html( $link_title ); ?></p>
                </a>
            <?php endif; ?>
        </section>
    <?php endif; 
?>