<?php
$build_folder = get_template_directory_uri() . '/assets/';
$header_logo = get_field( 'logo', 'options' );
$email = get_field( 'email',  'options' );
$telegram = get_field( 'telegram',  'options' );
$inst = get_field( 'inst',  'options' );
?>

<header class="header fixed-block" id="header">
    <div class="header__inner">
        <?php if ( $header_logo ) : ?>
            <a href="<?php echo home_url(); ?>" class="header__logo" data-aos="fade-right" data-aos-duration="300">
                <img src="<?php echo esc_url( $header_logo['url'] ); ?>"
                        alt="<?php echo esc_attr( $header_logo['alt'] ); ?>" />
            </a>
        <?php endif; ?>

        <div class="header__menu" data-aos="zoom-in" data-aos-duration="300">
            <?php wp_nav_menu( array(
                'theme_location' => 'header_nav',
                'container' => 'nav',
                'container_class' => 'main-nav',
                'menu_class' => 'main-nav__list',
            ) ); ?>

            <ul class="header__socials" data-aos="fade-left" data-aos-duration="300">
                <?php if ( $email ) : ?>
                    <li class="header__social">
                        <a class="header__social-link" href="mailto:<?php echo $email; ?>" target="_blank">
                            <svg width='25' height='25'>
                                <use href="<?php echo $build_folder?>img/sprite/sprite.svg#email"></use>
                            </svg>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if ( $telegram ) : ?>
                    <li class="header__social">
                        <a class="header__social-link" href="https://t.me/<?php echo $telegram; ?>" target="_blank">
                            <svg width='25' height='25'>
                                <use href="<?php echo $build_folder?>img/sprite/sprite.svg#telegram"></use>
                            </svg>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if ( $inst ) : ?>
                    <li class="header__social">
                        <a class="header__social-link" href="https://www.instagram.com/<?php echo $inst; ?>" target="_blank">
                            <svg width='25' height='25'>
                                <use href="<?php echo $build_folder?>img/sprite/sprite.svg#instagram"></use>
                            </svg>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
        
        <button class="burger" type="button">
            <span class="burger__line"></span>
        </button>
    </div>
</header>



