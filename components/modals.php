<?php 
    $build_folder = get_template_directory_uri() . '/assets/'; 
    $title = get_sub_field( 'title' );
	$text = get_sub_field( 'text' );
    $form_shortcode = '[contact-form-7 id="11de863" title="Contact form"]' ;
?>

<div class="overlay fixed-block" data-overlay>
    <div class="modal" data-popup="contact">
        <div class="modal__inner" role="dialog" aria-modal="true">
            <button class="close modal__close">
                <?php sprite(16, 16, 'close'); ?>
            </button>

            <div class="modal__box">
                <span class="modal__title">Замовити дзвінок</span>

                <div class="modal__text">Залиште свій номер телефону, ми з вами зв’яжемось найближчим часом.</div>

                <?php echo do_shortcode($form_shortcode); ?>
            </div>
        </div>
    </div>
</div>