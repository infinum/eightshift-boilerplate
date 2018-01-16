<?php
/**
 * The login-specific functionality.
 *
 * @since   1.0.0
 * @package theme_name
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
   */
  protected $theme_name;

  /**
   * Global theme version
   *
   * @var string
   */
  protected $theme_version;

  /**
   * Global assets version
   *
   * @var string
   */
  protected $assets_version;

  /**
   * Initialize class
   *
   * @param array $theme_info Load global theme info.
   */
  public function __construct( $theme_info = null ) {
    $this->theme_name = $theme_info['theme_name'];
    $this->theme_version = $theme_info['theme_version'];
    $this->assets_version = $theme_info['assets_version'];
  }

  /**
   * Enable theme support
   *
   * @return void
   */
  public function add_theme_support() {
    add_theme_support( 'post-thumbnails' );
  }

  /**
   * Create new image sizes
   */
  public function add_custom_image_sizes() {
    add_image_size( 'full_width', 1440, 9999, true );
    add_image_size( 'listing', 570, 320, true );
  }

  /**
   * Enable SVG uplod in media
   *
   * @param array $mimes Load all mimes.
   * @return array
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
   */
  public function enable_svg_library_preview( $response, $attachment, $meta ) {
    if ( $response['type'] === 'image' && $response['subtype'] === 'svg+xml' && class_exists( 'SimpleXMLElement' ) ) {
      try {
        $path = get_attached_file( $attachment->ID );

        if ( file_exists( $path ) ) {
            $svg = new \SimpleXMLElement( file_get_contents( $path ) );
            $src = $response['url'];
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
        new \WP_Error( esc_html__( 'Error: ', 'theme_name' ) . $e );
      }
    }

    return $response;
  }

  /**
   * Wrap utility class arround iframe to enable responsive
   *
   * @param  string $html Iframe html to wrap around.
   * @return  string Wrapped iframe with a utility class.
   */
  public function wrap_responsive_oembed_filter( $html ) {
    $return = '<span class="iframe u__embed-video-responsive">' . $html . '</span>';
    return $return;
  }
}
