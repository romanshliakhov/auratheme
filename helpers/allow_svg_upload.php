<?php
	function allow_svg_upload($mimes) {
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}
	add_filter('upload_mimes', 'allow_svg_upload');

	function fix_svg_display() {
		echo '<style>
        #set-post-thumbnail img {
            width: 100% !important;
            height: auto !important;
            background: #fff;
        }
        #set-post-thumbnail {
            width: 100%;
        }
    </style>';
	}
	add_action('admin_head', 'fix_svg_display');


	function sanitize_svg($file, $filename, $mimes, $real_mime) {
		if ($real_mime !== 'image/svg+xml') {
			return $file;
		}

		if (extension_loaded('libxml')) {
			$svg = file_get_contents($file);
			$dom = new DOMDocument();

			$dom->loadXML($svg, LIBXML_NOENT | LIBXML_DTDLOAD | LIBXML_DTDATTR);
		}

		return $file;
	}
	add_filter('wp_check_filetype_and_ext', 'sanitize_svg', 10, 4);

	function inline_svg_processing($buffer) {
		if (preg_match_all('/<img[^>]+src="([^"]+\.svg)"[^>]*>/', $buffer, $matches)) {
			foreach ($matches[0] as $index => $img_tag) {
				$svg_url = $matches[1][$index];
				$attachment_id = attachment_url_to_postid($svg_url);
				$svg_file = get_attached_file($attachment_id);

				if ($svg_file && file_exists($svg_file)) {
					$svg_content = file_get_contents($svg_file);

					$svg_content = preg_replace('/<\?xml.*?\?>|<!DOCTYPE.*?>/i', '', $svg_content);

					$wrapped_svg = '<i class="sprite">' . $svg_content . '</i>';
					$buffer = str_replace($img_tag, $wrapped_svg, $buffer);
				}
			}
		}
		return $buffer;
	}


	function start_output_buffering() {
		ob_start("inline_svg_processing");
	}
	add_action('template_redirect', 'start_output_buffering');
