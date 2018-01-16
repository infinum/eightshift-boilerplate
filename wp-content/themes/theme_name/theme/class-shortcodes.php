<?php
/**
 * The Shortcodes specific functionality.
 *
 * @since   1.0.0
 * @package theme_name
 */

namespace Inf_Theme\Theme;

/**
 * Class Shortcodes
 */
class Shortcodes {

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
   * Call a shortcode function by tag name.
   *
   * @author J.D. Grimes
   * @link https://codesymphony.co/dont-do_shortcode/
   *
   * @param string $tag     The shortcode whose function to call.
   * @param array  $atts    The attributes to pass to the shortcode function. Optional.
   * @param array  $content The shortcode's content. Default is null (none).
   *
   * @return string|bool False on failure, the result of the shortcode on success.
   */
  function inf_do_shortcode( $tag, array $atts = array(), $content = null ) {

    global $shortcode_tags;

    if ( ! isset( $shortcode_tags[ $tag ] ) ) {
      return false;
    }

    return call_user_func( $shortcode_tags[ $tag ], $atts, $content, $tag );
  }
}
