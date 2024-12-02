<?php
$build_folder = get_template_directory_uri() . '/assets/';
$logo = get_field( 'logo', 'options' );
$email = get_field( 'email',  'options' );
$telegram = get_field( 'telegram',  'options' );
$inst = get_field( 'inst',  'options' );
?>

<header class="header fixed-block">
    <div class="container">
        <div class="header__top">
            <?php if ( $logo ) : ?>
                <a href="<?php echo home_url(); ?>" class="logo">
                    <img src="<?php echo esc_url( $logo['url'] ); ?>"
                            alt="<?php echo esc_attr( $logo['alt'] ); ?>" />
                </a>
            <?php endif; ?>

            <div class="header__box">

            </div>

            <div class="header__right">
                <div class="favorites">
                    <svg width='18' height='16'>
                        <use href="<?php echo $build_folder?>img/sprite/sprite.svg#like"></use>
                    </svg>
                </div>

                <div class="lang">
                    <span>UA</span>
                    <span>RU</span>
                </div>

                <button>Замовити дзвінок</button>
            </div>

            <ul class="header__socials">
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

            <button class="burger" type="button">
                <span class="burger__line"></span>
            </button>
        </div>
    </div>

    <div class="container container--max">
        <span class="header__divider">
            <img width='1920' height='10' src='<?php echo $build_folder?>img/line.svg'>
        </span>
    </div>

    <div class="container">
        <div class="header__menu">
            <?php wp_nav_menu( array(
                'theme_location' => 'header_nav',
                'container' => 'nav',
                'container_class' => 'main-nav',
                'menu_class' => 'main-nav__list',
            ) ); ?>
        </div>
    </div>
</header>



