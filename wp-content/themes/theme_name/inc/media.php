<?php

/**
 * Set images sizes
 */
add_theme_support( 'post-thumbnails' );
add_image_size( 'full_width', 1440, 9999, true );
add_image_size( 'listing', 570, 320, true );

add_filter( 'upload_mimes', 'cc_mime_types' );
if ( ! function_exists( 'cc_mime_types' ) ) {
  /**
   * Enable SVG uplod in media
   */
  function cc_mime_types( $mimes ) {
    $mimes['svg'] = 'image/svg+xml';
    // unset($mimes['doc']);
    // unset($mimes['docx']);
    // unset($mimes['xls']);
    // unset($mimes['xlsx']);
    // unset($mimes['psd']);
    // unset($mimes['ppt']);
    // unset($mimes['pptx']);
    // unset($mimes['pps']);
    // unset($mimes['ppsx']);
    return $mimes;
  }
}

add_filter( 'embed_oembed_html', 'responsive_oembed_filter', 10, 4 );
if ( ! function_exists( 'responsive_oembed_filter' ) ) {
  /**
   * Wrap utility class arround iframe to enable responsive
   *
   * @param  string $html Iframe html to wrap around.
   * @return  string Wrapped iframe with a utility class.
   */
  function responsive_oembed_filter( $html ) {
    $return = '<span class="iframe u__embed-video-responsive">' . $html . '</span>';
    return $return;
  }
}
