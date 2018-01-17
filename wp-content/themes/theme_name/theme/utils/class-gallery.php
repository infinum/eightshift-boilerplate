<?php
/**
 * The Utils-Gallery specific functionality.
 *
 * @since   1.0.0
 * @package theme_name
 */

namespace Inf_Theme\Theme\Utils;

/**
 * Class Gallery
 */
class Gallery {

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
   * Global assets version
   *
   * @var string
   *
   * @since 1.0.0
   */
  protected $assets_version;

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
    $this->assets_version = $theme_info['assets_version'];
  }

  /**
   * Wrapper for gallery shortcode
   *
   * @param   string $html The gallery output. Default empty.
   * @param   array  $attr Attributes of the gallery shortcode.
   * @param   int    $instance Unique numeric ID of this gallery shortcode instance.
   * @return  string           Modified gallery shortcode.
   *
   * @since 1.0.0
   */
  function wrap_post_gallery( $html, $attr, $instance ) {
    if ( isset( $attr['class'] ) ) {
      // Unset attribute to avoid infinite recursive loops.
      $class = $attr['class'];
      unset( $attr['class'] );

      // Our custom HTML wrapper.
      $html = sprintf(
        '<div class="%s">%s</div>',
        esc_attr( $class ),
        gallery_shortcode( $attr )
      );
    }
    return $html;
  }
}
