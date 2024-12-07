<?php
    $build_folder = get_template_directory_uri() . '/assets/';
	$shower = get_sub_field( 'shower' );
    $title = get_sub_field( 'title' );

    if ( ! $shower ) : ?>
        <section class="contacts-section">
            <div class="container">
                <div class="contacts-section__wrapp">
                    <?php get_breadcrumbs(); ?>

                    <?php if($title) : ?>
                        <h1 class="contacts-section__title"><?php echo $title ?></h1>
                    <?php endif; ?>

                    <?php if (have_rows('contact')) : ?>
                        <ul class="contacts-section__box">
                            <?php while (have_rows('contact')) : the_row(); 
                                $address_map = get_sub_field( 'map' );
                                $address_name = get_sub_field( 'address' );
                                $address_descr = get_sub_field( 'descr' );
                                $address_schedule = get_sub_field('schedule');
                                $address_email = get_sub_field('email');
                                ?>
                                
                                <li class="contacts-section__address">
                                    <?php if($address_name) : ?>
                                        <div class="contacts-section__address-info">
                                            <span class="contacts-section__address-heading"><?php echo $address_name ?></span>

                                            <?php if($address_descr) : ?>
                                                <p class="contacts-section__address-descr"><?php echo $address_descr ?></p>
                                            <?php endif; ?>

                                            <div class="contacts-section__address-schedule"><?php echo $address_schedule ?></div>

                                            <?php if (have_rows('contact_phones')) : ?>
                                                <ul class="contacts-section__address-phones">
                                                    <?php while (have_rows('contact_phones')) : the_row(); 
                                                        $address_phone = get_sub_field( 'address_phone' );
                                                        ?>
                                                        
                                                        <li class="contacts-section__address-phone">
                                                            <a href="tel:<?php echo $address_phone ?>" ><?php echo $address_phone ?></a>
                                                        </li>
                                                    <?php endwhile; ?>
                                                </ul>
                                            <?php endif; ?>

                                            <?php if($address_email) : ?>
                                                <a class="contacts-section__address-email" href="mailto:<?php echo $address_email ?>"><?php echo $address_email ?></a>
                                            <?php endif; ?>

                                            <ul class="contacts-section__socials socials">
                                                <li>
                                                    <a href="#">
                                                        <svg width='35' height='35'>
                                                            <use href="<?php echo $build_folder?>img/sprite/sprite.svg#telegram"></use>
                                                        </svg>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <svg width='35' height='35'>
                                                            <use href="<?php echo $build_folder?>img/sprite/sprite.svg#instagram"></use>
                                                        </svg>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <svg width='35' height='41'>
                                                            <use href="<?php echo $build_folder?>img/sprite/sprite.svg#viber"></use>
                                                        </svg>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    <?php endif; ?>

                                    <?php if($address_map) : ?>
                                        <iframe class="contacts-section__address-map" src="<?php echo $address_map ?>" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    <?php endif; ?>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; 
?>