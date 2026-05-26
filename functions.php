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

// Hook for cache invalidation after client tokens are applied.
add_action( 'quadnine_after_apply_client_tokens', function () {
	delete_transient( 'global_styles' );
	wp_cache_delete( 'global_styles', 'theme_json' );
} );
