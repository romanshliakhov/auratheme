<?php
    $build_folder = get_template_directory_uri() . '/assets/';
	$shower = get_sub_field( 'shower' );
	$text = get_sub_field( 'text' );
	$bg = get_sub_field( 'background_image' );
    $link = get_sub_field( 'link' );

    if ( ! $shower ) : ?>
        <section class="information-section">
            <div class="container container--max">
                <?php if ( $bg ) : ?>
                    <div class="information-section__bg">
                        <div class="information-section__image">
                            <img src="<?php echo esc_url( $bg['url'] ); ?>"
                                alt="<?php echo esc_attr( $bg['alt'] ); ?>" />
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="container">
                <div class="information-section__wrapp">
                    <?php if ( $text ): ?>
                        <span class="information-section__text"><?php echo $text; ?></span>
                    <?php endif; ?>

                    <?php if ( $link ) :
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <a class="main-button" href="<?php echo esc_url( $link_url ); ?>"
                        target="<?php echo esc_attr( $link_target ); ?>">
                            <?php echo esc_html( $link_title ); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; 
?>


