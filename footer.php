<?php
$build_folder = get_template_directory_uri() . '/assets/';
$logo = get_field( 'logo', 'options' );
$email = get_field( 'email',  'options' );

// $telegram = get_field( 'telegram',  'options' );
// $inst = get_field( 'inst',  'options' );
?>

</main>

<footer class="footer">
    <div class="footer__divider">
        <img width='1920' height='10' src='<?php echo $build_folder?>img/line.svg'>
    </div>

    <div class="container">
        <div class="footer__wrapp">
            <div class="footer__top">
                <?php if ( $logo ) : ?>
                    <a href="<?php echo home_url(); ?>" class="footer__logo">
                        <img src="<?php echo esc_url( $logo['url'] ); ?>"
                                alt="<?php echo esc_attr( $logo['alt'] ); ?>" />
                    </a>
                <?php endif; ?>

                <p class="footer__top-text">Пам'ять, втілена в камені</p>
            </div>

            <div class="footer__box">
                <div class="footer__box-column">
                    <span class="footer__heading">аДРЕСА</span>

                    <?php if (have_rows('address', 'options')) : ?>
                        <ul class="address">
                            <?php while (have_rows('address', 'options')) : the_row(); 
                                $address_name = get_sub_field( 'address_name' );
                                $address_descr = get_sub_field( 'address_descr' );
                                ?>

                                <li class="address__line">
                                    <span><?php echo $address_name ?></span>

                                    <?php if ( $address_descr ) : ?>
                                        <p><?php echo $address_descr ?></p>
                                    <?php endif; ?>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>
                </div>

                <div class="footer__box-column">
                    <span class="footer__heading">НАВІГАЦІЯ</span>

                    <div class="footer__menu">
                        <?php wp_nav_menu( array(
                            'theme_location' => 'footer_nav',
                            'container' => 'nav',
                            'container_class' => 'footer__nav',
                            'menu_class' => 'footer__nav-list',
                        ) ); ?> 
                    </div>
                </div>

                <div class="footer__box-column">
                    <span class="footer__heading">Каталог</span>
                    
                    <div class="footer__menu">
                        <?php wp_nav_menu( array(
                            'theme_location' => 'catalog_nav',
                            'container' => 'nav',
                            'container_class' => 'main-nav',
                            'menu_class' => 'main-nav__list',
                        ) ); ?>
                    </div>
                </div>

                <div class="footer__box-column">
                    <span class="footer__heading">Контакти</span>

                    <?php if (have_rows('phones', 'options')) : ?>
                        <ul class="phones">
                            <?php while (have_rows('phones', 'options')) : the_row(); 
                                $phone_number = get_sub_field( 'phone_number' );
                                ?>

                                <li class="phones__line">
                                    <a href="tel:<?php echo $phone_number ?>"><?php echo $phone_number ?></a>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>

                    <?php if ( $email ) : ?>
                        <a class="email" href="mailto:<?php echo $email ?>">
                            <?php sprite(20, 20, 'email'); ?>

                            <?php echo $email ?>
                        </a>
                    <?php endif; ?>

                    <ul class="socials">
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

                    <button class="btn-red">Замовити дзвінок</button>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php
    load_template(get_template_directory() . '/components/modals.php', true);
    wp_footer();
?>

</body>
</html>