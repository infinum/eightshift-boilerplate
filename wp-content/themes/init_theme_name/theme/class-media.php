<?php
/**
 * The Media specific functionality.
 *
 * @since   1.0.0
 * @package init_theme_name
 */

namespace Inf_Theme\Theme;

/**
 * Class Media
 */
class Media {

  /**
   * Global theme name
   *
   * @var string
   *
   * @since 1.0.0
   */
  protected $theme_name;

  /**
   * Global theme version
   *
   * @var string
   *
   * @since 1.0.0
   */
  protected $theme_version;

  /**
   * Initialize class
   *
   * @param array $theme_info Load global theme info.
   *
   * @since 1.0.0
   */
  public function __construct( $theme_info = null ) {
    $this->theme_name     = $theme_info['theme_name'];
    $this->theme_version  = $theme_info['theme_version'];
  }

  /**
   * Enable theme support
   * for full list check: https://developer.wordpress.org/reference/functions/add_theme_support/
   *
   * @since 1.0.0
   */
  public function add_theme_support() {
    add_theme_support( 'post-thumbnails' );
  }

  /**
   * Create new image sizes
   *
   * @since 1.0.0
   */
  public function add_custom_image_sizes() {
    add_image_size( 'full_width', 1440, 9999, true );
    add_image_size( 'listing', 570, 320, true );
  }

  /**
   * Enable SVG uplod in media
   *
   * @param array $mimes Load all mimes types.
   * @return array       Return original and updated.
   *
   * @since 1.0.0
   */
  public function enable_mime_types( $mimes ) {
    $mimes['svg'] = 'image/svg+xml';
    $mimes['zip'] = 'application/zip';
    return $mimes;
  }

  /**
   * Enable SVG preview in Media Library
   *
   * @param array      $response   Array of prepared attachment data.
   * @param int|object $attachment Attachment ID or object.
   * @param array      $meta       Array of attachment meta data.
   *
   * @since 1.0.0
   */
  public function enable_svg_library_preview( $response, $attachment, $meta ) {
    if ( $response['type'] === 'image' && $response['subtype'] === 'svg+xml' && class_exists( 'SimpleXMLElement' ) ) {
      try {
        $path = get_attached_file( $attachment->ID );

        if ( file_exists( $path ) ) {
            $svg    = new \SimpleXMLElement( file_get_contents( $path ) );
            $src    = $response['url'];
            $width  = (int) $svg['width'];
            $height = (int) $svg['height'];

            // media gallery.
            $response['image'] = compact( 'src', 'width', 'height' );
            $response['thumb'] = compact( 'src', 'width', 'height' );

            // media single.
            $response['sizes']['full'] = array(
                'height'      => $height,
                'width'       => $width,
                'url'         => $src,
                'orientation' => $height > $width ? 'portrait' : 'landscape',
            );
        }
      } catch ( Exception $e ) {
        new \WP_Error( sprintf( esc_html__( 'Error: %s', 'init_theme_name' ), $e ) );
      }
    }

    return $response;
  }

  /**
   * Wrap utility class arround iframe to enable responsive
   *
   * @param  string $html   Iframe html to wrap around.
   * @return string Wrapped Iframe with a utility class.
   *
   * @since 1.0.0
   */
  public function wrap_responsive_oembed_filter( $html ) {
    $return = '<span class="iframe u__embed-video-responsive">' . $html . '</span>';
    return $return;
  }
}
