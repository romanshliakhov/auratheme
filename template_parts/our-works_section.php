<?php
    $build_folder = get_template_directory_uri() . '/assets/';
	$shower = get_sub_field( 'shower' );
    $title = get_sub_field( 'title' );

    if ( ! $shower ) : ?>
        <section class="works-section">
            <div class="container">
                <?php display_main_top_section('h2',$title ) ?>

                <?php
                    $gallery = get_field( 'gallery', 'gallery' );

                    if ( $gallery ) : ?>
                        <?php foreach( $gallery as $image ) : ?>
                            <a href="<?php echo esc_url( $image['url'] ); ?>">
                                <img src="<?php echo esc_url( $image['sizes']['large'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>"/>
                            </a>
                        <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; 
?>