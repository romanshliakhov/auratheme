<?php
$build_folder = get_template_directory_uri() . '/assets/';
$logo = get_field( 'logo', 'options' );
$email = get_field( 'email',  'options' );
$telegram = get_field( 'telegram',  'options' );
$inst = get_field( 'inst',  'options' );
?>

<header class="header">
    <div class="container">
        <div class="header__top">
            <?php if ( $logo ) : ?>
                <a href="<?php echo home_url(); ?>" class="header__logo">
                    <img src="<?php echo esc_url( $logo['url'] ); ?>"
                            alt="<?php echo esc_attr( $logo['alt'] ); ?>" />
                </a>
            <?php endif; ?>

            <div class="header__box">
                <div class="header__info">
                    <div class="header__contacts">
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

                        <ul class="socials">
                            <li>
                                <a href="#">
                                    <svg width='25' height='25'>
                                        <use href="<?php echo $build_folder?>img/sprite/sprite.svg#telegram"></use>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <svg width='25' height='25'>
                                        <use href="<?php echo $build_folder?>img/sprite/sprite.svg#instagram"></use>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <svg width='25' height='30'>
                                        <use href="<?php echo $build_folder?>img/sprite/sprite.svg#viber"></use>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="header__details">
                        <div class="header__locations">
                            <div class="header__locations-trigger">
                                <p>Наші магазини </p>
                                <?php sprite(10, 10, 'arrow-down'); ?>
                            </div>

                        </div>

                        <?php if ( $email ) : ?>
                            <a class="email" href="mailto:<?php echo $email ?>">
                                <?php sprite(20, 20, 'email'); ?>

                                <?php echo $email ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="header__controls">
                    <div class="header__controls-top">
                        <div class="favorites">
                            <span class="favorites__icon">
                                <?php sprite(18, 16, 'like'); ?>
                            </span>
                        </div>

                        <div class="lang">
                            <span class="active">UA</span>
                            <span>RU</span>
                        </div>
                    </div>

                    <button class="header__btn-contact" data-btn-modal='contact'>Замовити дзвінок</button>
                </div>

                <button class="burger" type="button">
                    <span class="burger__line"></span>
                </button>
            </div>
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
                'container_class' => 'header__nav',
                'menu_class' => 'header__nav-list',
            ) ); ?>
        </div>
    </div>
</header>



