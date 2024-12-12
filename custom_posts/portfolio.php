<?php 

// portfolio
function load_more_gallery_images() {
    if (!isset($_POST['offset'])) {
        wp_send_json_error('Offset not provided');
    }

    $offset = intval($_POST['offset']);
    $gallery = get_field('gallery', 'gallery');

    if (!$gallery || $offset >= count($gallery)) {
        wp_send_json_error('No more images to load');
    }

    $images_to_load = array_slice($gallery, $offset, 6); // Следующие 6 изображений
    $output = '';

    foreach ($images_to_load as $image) {
        $output .= '<figure class="portfolio-section__image" data-fancybox="gallery" data-src="' . esc_url($image['url']) . '">';
        $output .= '<img src="' . esc_url($image['sizes']['medium']) . '" alt="' . esc_attr($image['alt']) . '" />';
        $output .= '<figcaption>' . esc_attr($image['title']) . '</figcaption>';
        $output .= '</figure>';
    }

    wp_send_json_success($output);
}
add_action('wp_ajax_load_more_gallery_images', 'load_more_gallery_images');
add_action('wp_ajax_nopriv_load_more_gallery_images', 'load_more_gallery_images');

?>