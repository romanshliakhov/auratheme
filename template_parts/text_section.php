<?php
    $build_folder = get_template_directory_uri() . '/assets/';
	$shower = get_sub_field( 'shower' );
	$text = get_sub_field( 'content' );

    if ( ! $shower ) : ?>
        <section class="text-section">
            <div class="container">
                <?php if ( $text ): ?>
                    <div class="text-section__content"><?php echo $text; ?></div>
                <?php endif; ?>
            </div>

            <div class="text-section__trigger">Розгорнути</div>
        </section>
    <?php endif; 
?>


