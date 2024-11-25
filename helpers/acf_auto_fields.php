<?php
	add_filter('acf/load_field/name=page_builder', 'add_true_false_to_flexible_content');
	function add_true_false_to_flexible_content($field) {
		if (isset($field['layouts']) && is_array($field['layouts'])) {
			foreach ($field['layouts'] as &$layout) {
				$field_exists = false;
				if (isset($layout['sub_fields']) && is_array($layout['sub_fields'])) {
					foreach ($layout['sub_fields'] as $sub_field) {
						if (isset($sub_field['name']) && $sub_field['name'] === 'shower') {
							$field_exists = true;
							break;
						}
					}
				} else {
					$layout['sub_fields'] = array();
				}

				if (!$field_exists) {
					$new_field = array(
						'key' => 'field_shower_' . $layout['name'],
						'label' => 'Hide Section?',
						'name' => 'shower',
						'_name' => 'shower',
						'type' => 'true_false',
						'instructions' => 'Activate to hide the block.',
						'default_value' => 0,
						'ui' => 1,
						'ui_on_text' => 'Hide',
						'ui_off_text' => 'Show',
						'required' => 0,
						'ID' => 'field_shower_' . $layout['name'],
						'parent' => $layout['key'],
						'wrapper' => array(
							'class' => '',
							'id' => '',
							'width' => ''
						)
					);
					array_unshift($layout['sub_fields'], $new_field);
				}
			}
		}

		return $field;
	}

	add_filter('acf/update_value/name=shower', 'save_true_false_field_value', 10, 3);
	function save_true_false_field_value($value, $post_id, $field) {
		return $value;
	}
?>
