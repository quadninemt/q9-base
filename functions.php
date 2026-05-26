<?php
defined( 'ABSPATH' ) || exit;

add_action( 'after_setup_theme', function () {
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_editor_style( 'editor-style.css' );
} );

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style(
		'q9-inter',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap',
		[],
		null
	);
} );

add_action( 'enqueue_block_editor_assets', function () {
	wp_enqueue_style(
		'q9-inter-editor',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap',
		[],
		null
	);
} );

add_action( 'init', function () {
	register_block_pattern_category( 'q9', [ 'label' => 'QuadNine' ] );
} );

// Patterns are auto-registered from /patterns/ via the block-patterns header.
// functions.php is kept minimal — all tokens live in theme.json.

// Merge brand-guide-tokens.json into the active theme.json at runtime.
add_filter( 'wp_theme_json_data_theme', function ( WP_Theme_JSON_Data $theme_json ) {
	$tokens_file = get_template_directory() . '/brand-guide-tokens.json';
	if ( ! file_exists( $tokens_file ) ) {
		return $theme_json;
	}
	$tokens = json_decode( file_get_contents( $tokens_file ), true );
	if ( empty( $tokens ) ) {
		return $theme_json;
	}

	$data = $theme_json->get_data();

	if ( ! empty( $tokens['colors'] ) ) {
		foreach ( $data['settings']['color']['palette'] as &$swatch ) {
			if ( isset( $tokens['colors'][ $swatch['slug'] ] ) ) {
				$swatch['color'] = $tokens['colors'][ $swatch['slug'] ];
			}
		}
		unset( $swatch );
	}

	if ( ! empty( $tokens['typography'] ) ) {
		foreach ( $data['settings']['typography']['fontFamilies'] as &$family ) {
			$key = $family['slug'] . '-font-family';
			if ( isset( $tokens['typography'][ $key ] ) ) {
				$family['fontFamily'] = $tokens['typography'][ $key ];
			}
		}
		unset( $family );
		if ( isset( $tokens['typography']['line-height-body'] ) ) {
			$data['settings']['custom']['lineHeight']['body'] = $tokens['typography']['line-height-body'];
		}
		if ( isset( $tokens['typography']['line-height-heading'] ) ) {
			$data['settings']['custom']['lineHeight']['heading'] = $tokens['typography']['line-height-heading'];
		}
	}

	if ( ! empty( $tokens['spacing'] ) ) {
		foreach ( $data['settings']['spacing']['spacingSizes'] as &$size ) {
			if ( isset( $tokens['spacing'][ $size['slug'] ] ) ) {
				$size['size'] = $tokens['spacing'][ $size['slug'] ];
			}
		}
		unset( $size );
	}

	if ( ! empty( $tokens['radius'] ) ) {
		foreach ( $tokens['radius'] as $key => $value ) {
			$data['settings']['custom']['radius'][ $key ] = $value;
		}
	}

	if ( ! empty( $tokens['shadows'] ) ) {
		foreach ( $data['settings']['shadow']['presets'] as &$preset ) {
			if ( isset( $tokens['shadows'][ $preset['slug'] ] ) ) {
				$preset['shadow'] = $tokens['shadows'][ $preset['slug'] ];
			}
		}
		unset( $preset );
	}

	return new WP_Theme_JSON_Data( $data, 'theme' );
} );

// Invalidate theme.json caches after apply-client-tokens writes a new token file.
add_action( 'quadnine_after_apply_client_tokens', function () {
	delete_transient( 'global_styles' );
	wp_cache_delete( 'global_styles', 'theme_json' );
} );
