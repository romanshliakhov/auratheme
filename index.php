<?php get_header(); ?>

<?php if (have_rows('page_builder', get_the_ID())):
    while (have_rows('page_builder', get_the_ID())) : the_row();

        get_template_part( 'template_parts/' . get_row_layout());

    endwhile;
endif; ?>

<?php get_footer(); ?>