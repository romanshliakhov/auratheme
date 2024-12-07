<?php
	$post_types = get_option( 'remove_slug_post_types', ['category'] );

	function remove_post_type_slug( $post_link, $post ) {
		$post_types = get_option( 'remove_slug_post_types', [] );
		if ( in_array( $post->post_type, $post_types ) ) {
			return str_replace( "/$post->post_type/", '/', $post_link );
		}

		return $post_link;
	}

	function add_post_type_to_get_posts_request( $query ) {
		if ( is_admin() || ! $query->is_main_query() ) {
			return;
		}

		if ( ! isset( $query->query['name'] ) || empty( $query->query['name'] ) || count( $query->query ) != 2 ) {
			return;
		}

		$post_types = get_option( 'remove_slug_post_types', [] );
		if ( ! empty( $post_types ) ) {
			$query->set( 'post_type', array_merge( [ 'post', 'page' ], $post_types ) );
		}
	}

	add_filter( 'post_type_link', 'remove_post_type_slug', 10, 2 );

	add_action( 'pre_get_posts', 'add_post_type_to_get_posts_request' );

// Настройки "Чтение"
	add_action( 'admin_init', function () {
		add_settings_section(
			'remove_slug_settings_section',
			__( 'Настройки удаления Slug для типов записей', 'textdomain' ),
			null,
			'reading'
		);

		add_settings_field(
			'remove_slug_post_types',
			__( 'Типы записей для удаления Slug', 'textdomain' ),
			function () {
				$all_post_types      = get_post_types( [ 'public' => true ], 'objects' );
				$selected_post_types = get_option( 'remove_slug_post_types', [] );

				foreach ( $all_post_types as $post_type ) {
					$checked = in_array( $post_type->name, $selected_post_types ) ? 'checked' : '';
					echo '<label>';
					echo '<input type="checkbox" name="remove_slug_post_types[]" value="' . esc_attr( $post_type->name ) . '" ' . $checked . '>';
					echo esc_html( $post_type->labels->name );
					echo '</label><br>';
				}

				echo '<p class="description">' . __( 'Выберите типы записей, для которых нужно удалить Slug из URL.', 'textdomain' ) . '</p>';
			},
			'reading',
			'remove_slug_settings_section'
		);

		register_setting( 'reading', 'remove_slug_post_types', [
			'type'              => 'array',
			'sanitize_callback' => function ( $input ) {
				return array_map( 'sanitize_text_field', (array) $input );
			},
			'default'           => [],
		] );
	} );

	add_action( 'update_option_remove_slug_post_types', function ( $old_value, $new_value ) {
		if ( $old_value !== $new_value ) {
			flush_rewrite_rules();
		}
	}, 10, 2 );
