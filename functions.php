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

	// "Flush top" — zeroes the top padding of a section group so repeats of the same
	// full-width section pattern (e.g. three q9/services-grid-3 stacked into a 9-card grid)
	// don't double up xlarge padding at the seam. Apply to the 2nd+ instance in a stack.
	// See _linked-instructions commission doc for the approved stacking guidance.
	register_block_style( 'core/group', [
		'name'  => 'flush-top',
		'label' => __( 'Flush top (no top padding)', 'q9-base' ),
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

	// CSS-safe sanitiser: strips characters that are dangerous inside a <style> block.
	// Do NOT use esc_attr() here — it HTML-encodes single quotes, which breaks
	// font-family values such as 'Plus Jakarta Sans', system-ui, sans-serif.
	// Inside a <style> element the output is CSS, not HTML; &#039; is literal text.
	$css_safe = static function ( string $v ): string {
		return preg_replace( '/[<>{};]/', '', wp_strip_all_tags( $v ) );
	};

	$vars = '';

	if ( ! empty( $tokens['colors'] ) ) {
		// Emit a --wp--preset--color--{slug} variable for every colour key in the token file.
		// This covers the 7 semantic colours (primary, secondary, accent, neutral-light,
		// neutral-dark, background, text) AND the optional extended scale (primary-50…900,
		// accent-dark/50/200, snow/cloud/silver/pewter/slate/ink, success). Any slug present
		// in theme.json's palette is overridden; extra slugs are emitted harmlessly.
		foreach ( $tokens['colors'] as $slug => $value ) {
			// Slug must match WordPress preset slug rules: lowercase alphanumerics + hyphens.
			if ( ! is_string( $slug ) || ! preg_match( '/^[a-z0-9-]+$/', $slug ) ) {
				continue;
			}
			$vars .= '--wp--preset--color--' . $slug . ':' . $css_safe( $value ) . ';';
		}
	}

	if ( ! empty( $tokens['typography'] ) ) {
		if ( isset( $tokens['typography']['body-font-family'] ) ) {
			$vars .= '--wp--preset--font-family--body:' . $css_safe( $tokens['typography']['body-font-family'] ) . ';';
		}
		if ( isset( $tokens['typography']['heading-font-family'] ) ) {
			$vars .= '--wp--preset--font-family--heading:' . $css_safe( $tokens['typography']['heading-font-family'] ) . ';';
		}
		if ( isset( $tokens['typography']['line-height-body'] ) ) {
			$vars .= '--wp--custom--line-height--body:' . $css_safe( $tokens['typography']['line-height-body'] ) . ';';
		}
		if ( isset( $tokens['typography']['line-height-heading'] ) ) {
			$vars .= '--wp--custom--line-height--heading:' . $css_safe( $tokens['typography']['line-height-heading'] ) . ';';
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
				$vars .= $prop . ':' . $css_safe( $tokens['spacing'][ $slug ] ) . ';';
			}
		}
	}

	if ( ! empty( $tokens['radius'] ) ) {
		foreach ( [ 'button', 'card', 'input' ] as $key ) {
			if ( isset( $tokens['radius'][ $key ] ) ) {
				$vars .= '--wp--custom--radius--' . $key . ':' . $css_safe( $tokens['radius'][ $key ] ) . ';';
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
		// Override any palette swatch whose slug matches a token colour.
		$seen = [];
		foreach ( $data['settings']['color']['palette'] as &$swatch ) {
			if ( isset( $tokens['colors'][ $swatch['slug'] ] ) ) {
				$swatch['color'] = $tokens['colors'][ $swatch['slug'] ];
			}
			$seen[ $swatch['slug'] ] = true;
		}
		unset( $swatch );
		// Append any token colour that is not already in the palette (extended scale slots a
		// client supplies that the theme default omits), so the Site Editor exposes them.
		foreach ( $tokens['colors'] as $slug => $value ) {
			if ( is_string( $slug ) && preg_match( '/^[a-z0-9-]+$/', $slug ) && empty( $seen[ $slug ] ) ) {
				$data['settings']['color']['palette'][] = [
					'slug'  => $slug,
					'name'  => ucwords( str_replace( '-', ' ', $slug ) ),
					'color' => $value,
				];
			}
		}
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

// ---------------------------------------------------------------------------
// Auto-updater — checks GitHub Releases for a newer version of this theme.
// Surfaces an update notification in WP Admin → Appearance → Themes.
// API response is cached for 12 hours to stay within GitHub rate limits (60/hr
// unauthenticated). The zip attached to each release must have q9-base/ as its
// root directory and must NOT include brand-guide-tokens.json (so client tokens
// are preserved across updates).
// ---------------------------------------------------------------------------
add_filter( 'pre_set_site_transient_update_themes', function ( $transient ) {
	if ( empty( $transient->checked ) ) {
		return $transient;
	}

	$theme_slug = 'q9-base';
	$current    = wp_get_theme( $theme_slug )->get( 'Version' );
	$cache_key  = 'q9_theme_update_check';
	$cached     = get_transient( $cache_key );

	// "Check Again" calls wp_update_themes( true ) — it never calls delete_site_transient(),
	// so the delete_site_transient_update_themes action never fires. Detect the force-check
	// flag directly and bypass our cache so the filter makes a fresh GitHub API call.
	if ( ! empty( $_GET['force-check'] ) ) {
		$cached = false;
	}

	if ( false === $cached ) {
		$response = wp_remote_get(
			'https://api.github.com/repos/quadninemt/q9-base/releases/latest',
			[
				'timeout' => 10,
				'headers' => [ 'User-Agent' => 'q9-base-theme-updater/' . $current ],
			]
		);

		if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
			// Cache a negative result for 1 hour to avoid hammering on error.
			set_transient( $cache_key, [ 'version' => $current, 'package' => '' ], HOUR_IN_SECONDS );
			return $transient;
		}

		$body    = json_decode( wp_remote_retrieve_body( $response ), true );
		$version = ltrim( $body['tag_name'] ?? '', 'v' );
		$package = '';

		foreach ( $body['assets'] ?? [] as $asset ) {
			if ( str_ends_with( $asset['name'], '.zip' ) ) {
				$package = $asset['browser_download_url'];
				break;
			}
		}

		$cached = [ 'version' => $version, 'package' => $package ];
		set_transient( $cache_key, $cached, 12 * HOUR_IN_SECONDS );
	}

	if ( ! empty( $cached['package'] ) && version_compare( $cached['version'], $current, '>' ) ) {
		$transient->response[ $theme_slug ] = [
			'theme'       => $theme_slug,
			'new_version' => $cached['version'],
			'url'         => 'https://github.com/quadninemt/q9-base/releases',
			'package'     => $cached['package'],
			'requires'    => '6.9',
		];
	}

	return $transient;
} );

// Clear our cache when the update_themes transient is explicitly deleted (e.g. after a
// core update or manual DB operation). Does NOT fire during "Check Again" — that case
// is handled above via the $_GET['force-check'] bypass in the filter itself.
add_action( 'delete_site_transient_update_themes', function () {
	delete_transient( 'q9_theme_update_check' );
} );

// Also clear after a successful theme upgrade.
add_action( 'upgrader_process_complete', function ( $upgrader, $options ) {
	if ( 'theme' === ( $options['type'] ?? '' ) ) {
		delete_transient( 'q9_theme_update_check' );
	}
}, 10, 2 );

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
