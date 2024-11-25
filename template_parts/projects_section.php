<?php
	$shower = get_sub_field( 'shower' );

    if ( ! $shower ) : ?>
        <section class="projects" id="projects">
            <?php if (have_rows('projects')) : ?>
                <ul class="projects__lists">
                    <?php while (have_rows('projects')) : the_row(); 
                        $image = get_sub_field('image');
                        $title = get_sub_field('title');
                        $title_second = get_sub_field('title_second');
                        $space_beetween = get_sub_field('space_beetween');
                        $active_class = $space_beetween ? ' active' : ''; 
                    ?>
                    
                    <li class="projects__list<?php echo $active_class; ?>">
                        <?php if ($image): ?>
                            <div class="projects__list-image">
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                            </div>
                        <?php endif; ?>

                        <div class="projects__list-title" data-aos="fade-down" data-aos-offset="300" data-aos-easing="linear" data-aos-duration="500"><?php echo esc_html($title); ?></div>

                        <?php if ($active_class): ?>
                            <div class="projects__list-title" data-aos="fade-up" data-aos-offset="0" data-aos-easing="linear" data-aos-duration="500"><?php echo esc_html($title_second); ?></div>
                        <?php endif; ?>
                    </li>

                    <?php endwhile; ?>
                </ul>
            <?php endif; ?>
        </section>
    <?php endif; 
?>