<?php
defined( 'ABSPATH' ) || exit;

add_action( 'after_setup_theme', function () {
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_editor_style( 'editor-style.css' );
} );

/**
 * Enqueue Google Fonts — per-client URL from brand-guide-tokens.json, falling back to Inter.
 *
 * If the token file contains a `typography.google-fonts-url` value, that URL is loaded (it
 * must include every weight used by both body and heading fonts, plus &display=swap).
 * If the field is absent or the token file doesn't exist, Inter (400–800) is loaded as the
 * theme default.
 */
function q9_get_google_fonts_url(): string {
	$tokens_file = get_template_directory() . '/brand-guide-tokens.json';
	if ( file_exists( $tokens_file ) ) {
		$tokens = json_decode( file_get_contents( $tokens_file ), true );
		$url    = $tokens['typography']['google-fonts-url'] ?? '';
		if ( $url && str_starts_with( $url, 'https://fonts.googleapis.com/' ) ) {
			return $url;
		}
	}
	return 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap';
}

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'q9-fonts', q9_get_google_fonts_url(), [], null );
} );

add_action( 'enqueue_block_editor_assets', function () {
	wp_enqueue_style( 'q9-fonts-editor', q9_get_google_fonts_url(), [], null );
} );

add_action( 'init', function () {
	register_block_pattern_category( 'q9', [ 'label' => 'QuadNine' ] );
} );

function q9_register_nav_menus() {
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'q9-base' ),
		'footer'  => __( 'Footer Navigation',  'q9-base' ),
	) );
}
add_action( 'init', 'q9_register_nav_menus' );

// Register "Reversed (image right)" block style for q9/media-text-row.
// Applies flex-direction:row-reverse to the inner wp:columns block at desktop (≥782px) only.
// Mobile column stacking is unaffected — image always appears above text on small screens.
add_action( 'init', function () {
	register_block_style( 'core/columns', [
		'name'  => 'reversed',
		'label' => __( 'Reversed (image right)', 'q9-base' ),
	] );
} );

// Patterns are auto-registered from /patterns/ via the block-patterns header.

// Inject brand token CSS variables directly into <head>, bypassing theme.json cache.
// This is the reliable runtime path; wp_theme_json_data_theme handles the block editor.
add_action( 'wp_head', function () {
	$tokens_file = get_template_directory() . '/brand-guide-tokens.json';
	if ( ! file_exists( $tokens_file ) ) {
		return;
	}
	$tokens = json_decode( file_get_contents( $tokens_file ), true );
	if ( empty( $tokens ) ) {
		return;
	}

	$vars = '';

	if ( ! empty( $tokens['colors'] ) ) {
		$map = [
			'primary'       => '--wp--preset--color--primary',
			'secondary'     => '--wp--preset--color--secondary',
			'accent'        => '--wp--preset--color--accent',
			'neutral-light' => '--wp--preset--color--neutral-light',
			'neutral-dark'  => '--wp--preset--color--neutral-dark',
			'background'    => '--wp--preset--color--background',
			'text'          => '--wp--preset--color--text',
		];
		foreach ( $map as $slug => $prop ) {
			if ( isset( $tokens['colors'][ $slug ] ) ) {
				$vars .= $prop . ':' . esc_attr( $tokens['colors'][ $slug ] ) . ';';
			}
		}
	}

	if ( ! empty( $tokens['typography'] ) ) {
		if ( isset( $tokens['typography']['body-font-family'] ) ) {
			$vars .= '--wp--preset--font-family--body:' . esc_attr( $tokens['typography']['body-font-family'] ) . ';';
		}
		if ( isset( $tokens['typography']['heading-font-family'] ) ) {
			$vars .= '--wp--preset--font-family--heading:' . esc_attr( $tokens['typography']['heading-font-family'] ) . ';';
		}
		if ( isset( $tokens['typography']['line-height-body'] ) ) {
			$vars .= '--wp--custom--line-height--body:' . esc_attr( $tokens['typography']['line-height-body'] ) . ';';
		}
		if ( isset( $tokens['typography']['line-height-heading'] ) ) {
			$vars .= '--wp--custom--line-height--heading:' . esc_attr( $tokens['typography']['line-height-heading'] ) . ';';
		}
	}

	if ( ! empty( $tokens['spacing'] ) ) {
		$spacing_map = [
			'small'  => '--wp--preset--spacing--small',
			'medium' => '--wp--preset--spacing--medium',
			'large'  => '--wp--preset--spacing--large',
			'xlarge' => '--wp--preset--spacing--xlarge',
		];
		foreach ( $spacing_map as $slug => $prop ) {
			if ( isset( $tokens['spacing'][ $slug ] ) ) {
				$vars .= $prop . ':' . esc_attr( $tokens['spacing'][ $slug ] ) . ';';
			}
		}
	}

	if ( ! empty( $tokens['radius'] ) ) {
		foreach ( [ 'button', 'card', 'input' ] as $key ) {
			if ( isset( $tokens['radius'][ $key ] ) ) {
				$vars .= '--wp--custom--radius--' . $key . ':' . esc_attr( $tokens['radius'][ $key ] ) . ';';
			}
		}
	}

	if ( $vars ) {
		echo '<style id="q9-brand-tokens">:root{' . $vars . '}</style>';
	}
}, 99 );

// Also merge into theme.json data for the block editor (Site Editor preview).
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
	// WP 6.6+ static property cache on the resolver.
	if ( method_exists( 'WP_Theme_JSON_Resolver', 'clean_cached_data' ) ) {
		WP_Theme_JSON_Resolver::clean_cached_data();
	}
	// Clear all known theme_json object cache keys (WP 6.x and 7.x key names).
	foreach ( [ 'global_styles', 'wp_global_styles', 'wp_global_styles_', 'theme_json' ] as $key ) {
		wp_cache_delete( $key, 'theme_json' );
		delete_transient( $key );
	}
	if ( function_exists( 'wp_cache_flush_group' ) ) {
		wp_cache_flush_group( 'theme_json' );
	}
	// Flush full object cache to handle persistent stores (Redis/Memcached).
	wp_cache_flush();
} );
