<?php
$build_folder = get_template_directory_uri() . '/assets/';
$logo = get_field( 'logo', 'options' );

// $email = get_field( 'email',  'options' );
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
                    <a href="<?php echo home_url(); ?>" class="logo">
                        <img src="<?php echo esc_url( $logo['url'] ); ?>"
                                alt="<?php echo esc_attr( $logo['alt'] ); ?>" />
                    </a>
                <?php endif; ?>

                <p class="footer__top-text">Пам'ять, втілена в камені</p>
            </div>

            <div class="footer__box">
                <div class="footer__box-column">
                    <span class="footer__heading">аДРЕСА</span>


                </div>

                <div class="footer__box-column">
                    <span class="footer__heading">НАВІГАЦІЯ</span>

                    <div class="footer__menu">
                        <?php wp_nav_menu( array(
                            'theme_location' => 'header_nav',
                            'container' => 'nav',
                            'container_class' => 'main-nav',
                            'menu_class' => 'main-nav__list',
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
                    
                    <ul>
                        <li>
                            <a href="tel:+380961792039">+ 38 (096) 179 20 39</a>
                        </li>
                        <li>
                            <a href="tel:+380961792039">+ 38 (096) 179 20 39</a>
                        </li>
                    </ul>

                    <a href="mailto:contact@pamyatniki-aura.com">
                        <svg width='20' height='20'>
                            <use href="<?php echo $build_folder?>img/sprite/sprite.svg#email"></use>
                        </svg>

                        contact@pamyatniki-aura.com
                    </a>



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

<div data-overlay class="overlay fixed-block"></div>

<?php
    wp_footer();
?>

</body>
</html>