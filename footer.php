<?php
$build_folder = get_template_directory_uri() . '/assets/';
$form_shortcode = '[contact-form-7 id="11de863" title="Contact form"]' ;
$policy = get_field( 'policy', 'options' );
$email = get_field( 'email',  'options' );
$telegram = get_field( 'telegram',  'options' );
$inst = get_field( 'inst',  'options' );
?>

</main>

<footer class="footer" id="footer">
    <div class="container">
        <div class="footer__inner">
            <?php if ( $form_shortcode ) : ?>
                <div class="footer__contacts" data-aos="fade-up" data-aos-duration="750">
                    <?php echo do_shortcode($form_shortcode); ?>
                </div>
            <?php endif; ?>

            <div class="footer__content" data-aos="fade-up" data-aos-duration="750">
                <ul class="footer__socials">
                    <?php if ( $email ) : ?>
                        <li class="footer__social">
                            <span class="footer__social-heading">
                                <svg width='25' height='25'>
                                    <use href="<?php echo $build_folder?>img/sprite/sprite.svg#email"></use>
                                </svg>

                                <p>Email</p>
                            </span>

                            <a class="footer__social-link" href="mailto:<?php echo $email; ?>" target="_self">
                                <?php echo $email; ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if ( $telegram ) : ?>
                        <li class="footer__social">
                            <span class="footer__social-heading">
                                <svg width='25' height='25'>
                                    <use href="<?php echo $build_folder?>img/sprite/sprite.svg#telegram"></use>
                                </svg>

                                <p>Telegram</p>
                            </span>

                            <a class="footer__social-link" href="https://t.me/<?php echo $telegram; ?>" target="_blank">
                                @<?php echo $telegram; ?>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if ( $inst ) : ?>
                        <li class="footer__social">
                            <span class="footer__social-heading">
                                <svg width='25' height='25'>
                                    <use href="<?php echo $build_folder?>img/sprite/sprite.svg#instagram"></use>
                                </svg>

                                <p>Instagram</p>
                            </span>

                            <a class="footer__social-link" href="https://www.instagram.com/<?php echo $inst; ?>" target="_self">
                                @<?php echo $inst; ?>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>

                <?php if ( $policy ) : ?>
                    <div class="footer__policy"><?php echo $policy ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</footer>

<a class="scroll-top menu-link" href="#header">
    <svg width='40' height='40'>
        <use href="<?php echo $build_folder?>img/sprite/sprite.svg#arrow-right"></use>
    </svg>
</a>

<div data-overlay class="overlay fixed-block"></div>

<?php
    wp_footer();
?>

</body>
</html>