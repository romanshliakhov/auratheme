<?php
    $build_folder = get_template_directory_uri() . '/assets/';
	$shower = get_sub_field( 'shower' );
    $title = get_sub_field( 'title' );

    if ( ! $shower ) : ?>
        <section class="advantages-section">
            <div class="container">
                <div class="advantages-section__wrapp">
                    <?php display_main_top_section('h2',$title ) ?>

                    <?php if (have_rows('advantages')) : ?>
                        <ul class="advantages-section__lists">
                            <?php while (have_rows('advantages')) : the_row(); 
                                $image = get_sub_field( 'image' );
                                $title = get_sub_field( 'title' );
                                ?>
                                
                                <li class="advantages-section__list">
                                    <span class="advantages-section__list-image">
                                        <img src="<?php echo esc_url( $image['sizes']['large'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>"/>
                                    </span>

                                    <span class="advantages-section__list-title"><?php echo $title ?></span>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; 
?>


