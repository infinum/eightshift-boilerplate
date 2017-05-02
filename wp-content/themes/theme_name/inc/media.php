<?php

/**
 * Set images sizes
 */
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );

	// add_image_size( 'medium_thumbnails', 300, 300, true );
	add_image_size( 'full_width', 1440, 9999, true );
	add_image_size( 'listing', 570, 320, true );
	// add_image_size( 'mini_thumbnail', 80, 80, true );
};

/**
 * Enable SVG uplod in media
 */
function cc_mime_types( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

/**
 * Wrap utility class arround iframe to enable responsive
 */
function responsive_oembed_filter( $html ) {
	$return = '<span class="iframe u__embed-video-responsive">' . $html . '</span>';
	return $return;
}
add_filter( 'embed_oembed_html', 'responsive_oembed_filter', 10, 4 );

// -----------------------------------------------------------
