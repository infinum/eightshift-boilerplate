<?php
/**
 * The Media specific functionality.
 *
 * @since   1.0.0
 * @package Inf_Theme\Admin
 */

namespace Inf_Theme\Admin;

use Eightshift_Libs\Core\Service;

use Inf_Theme\Helpers\General_Helper;
use Inf_Theme\Helpers\Object_Helper;

/**
 * Class Media
 *
 * This class handles all media options. Sizes, Types, Features, etc.
 */
class Media implements Service {

  /**
   * Use trait inside class.
   */
  use Object_Helper;

  /**
   * Register all the hooks
   *
   * @return void
   *
   * @since 1.0.0
   */
  public function register() : void {
    add_action( 'after_setup_theme', [ $this, 'add_theme_support' ] );
    add_action( 'after_setup_theme', [ $this, 'add_custom_image_sizes' ] );
    add_action( 'upload_mimes', [ $this, 'enable_mime_types' ] );
    add_action( 'wp_prepare_attachment_for_js', [ $this, 'enable_svg_library_preview' ], 10, 3 );
    add_filter( 'wp_handle_upload_prefilter', [ $this, 'check_svg_on_media_upload' ] );
  }

  /**
   * Enable theme support
   * for full list check: https://developer.wordpress.org/reference/functions/add_theme_support/
   *
   * @return void
   *
   * @since 1.0.0
   */
  public function add_theme_support() : void {
    add_theme_support( 'title-tag', 'html5', 'post-thumbnails' );
  }

  /**
   * Create new image sizes
   *
   * @return void
   *
   * @since 1.0.0
   */
  public function add_custom_image_sizes() : void {
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
  public function enable_mime_types( $mimes ) : array {
    $mimes['svg'] = 'image/svg+xml';
    $mimes['zip'] = 'application/zip';

    return $mimes;
  }

  /**
   * Enable SVG preview in Media Library
   *
   * @param array      $response   Array of prepared attachment data.
   * @param int|object $attachment Attachment ID or object.
   *
   * @since 3.0.1 Adding theme review comments.
   * @since 3.0.0 Replacing file_get_content with file.
   * @since 2.0.2 Added checks if xml file is valid.
   * @since 1.0.0
   */
  public function enable_svg_library_preview( $response, $attachment ) {
    if ( $response['type'] === 'image' && $response['subtype'] === 'svg+xml' && class_exists( 'SimpleXMLElement' ) ) {
      try {
        $path = get_attached_file( $attachment->ID );

        if ( file_exists( $path ) ) {
          $svg_content = file( $path );
          $svg_content = implode( ' ', $svg_content );

          if ( ! $this->is_valid_xml( $svg_content ) ) {

            /* translators: path to file. */
            new \WP_Error( sprintf( esc_html__( 'Error: File invalid: %s', 'inf_theme' ), $path ) );
            return false;
          }

          $svg    = new \SimpleXMLElement( $svg_content );
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
      } catch ( \Exception $e ) {

        /* translators: Exception error description. */
        new \WP_Error( sprintf( esc_html__( 'Error: %s', 'inf_theme' ), $e ) );
      }
    }

    return $response;
  }

  /**
   * Check if svg is valid on Add New Media Page.
   *
   * @param array $response Response array.
   * @return array
   *
   * @since 3.0.0 Replacing file_get_content with file.
   * @since 1.0.0
   */
  public function check_svg_on_media_upload( $response ) : array {
    if ( $response['type'] === 'image/svg+xml' && class_exists( 'SimpleXMLElement' ) ) {
      $path = $response['tmp_name'];

      $svg_content = file( $path );
      $svg_content = implode( ' ', $svg_content );

      if ( file_exists( $path ) ) {
        if ( ! $this->is_valid_xml( $svg_content ) ) {
          return array(
            'size' => $response,
            'name' => $response['name'],
          );
        }
      }
    }

    return $response;
  }
}
