<?php

add_filter('wpcf7_autop_or_not', '__return_false');

add_filter('wpcf7_form_elements', function($content) {
	$theme_url = get_template_directory_uri() . '/assets/';
	$content = str_replace('[theme-url]', $theme_url, $content);
	return $content;
});

add_filter('shortcode_atts_wpcf7', function($out, $pairs, $atts) {
	if (!isset($atts['html_class'])) {
		$out['html_class'] = 'main-form';
	}
	return $out;
}, 10, 3);
?>