<?php
/**
 * The Advance Custom Fields general helper specific functionality.
 * Used on fields created via ACF.
 *
 * @since   2.0.0
 * @package init_theme_name
 */

namespace Inf_Theme\Theme\Acf;

use Inf_Theme\Helpers as General_Helpers;

/**
 * Class Helpers
 */
class Helpers {

  /**
   * Global theme name
   *
   * @var string
   *
   * @since 2.0.0
   */
  protected $theme_name;

  /**
   * Global theme version
   *
   * @var string
   *
   * @since 2.0.0
   */
  protected $theme_version;

  /**
   * General Helper class
   *
   * @var object General_Helper
   *
   * @since 2.0.0
   */
  public $general_helper;

  /**
   * Initialize class
   *
   * @param array $theme_info Load global theme info.
   *
   * @since 2.0.0
   */
  public function __construct( $theme_info = null ) {
    $this->theme_name     = $theme_info['theme_name'];
    $this->theme_version  = $theme_info['theme_version'];

    $this->general_helper = new General_Helpers\General_Helper();
  }

  /**
   * Return button array with all fields
   *
   * @param string $key   Button key in array.
   * @param array  $array Array to look in.
   * @return array        Get full button array.
   *
   * @since 2.0.0
   */
  public function get_button( $key, $array ) {
    $view_type = '';
    $title     = '';
    $color     = '';
    $type      = '';
    $url       = '';
    $new_tab   = '';
    $class     = '';
    $id        = '';

    if ( ! empty( $this->general_helper->get_array_value( $key, $array ) ) ) {
      global $post;

      $type = $this->general_helper->get_array_value( 'type', $array[ $key ] );
      $url  = $this->general_helper->get_array_value( 'url', $array[ $key ] );

      if ( $type === 'none' || empty( $url ) ) {
        return;
      }

      $view_type = $this->general_helper->get_array_value( 'view_type', $array[ $key ] );
      $title     = $this->general_helper->get_array_value( 'title', $array[ $key ] );
      $color     = $this->general_helper->get_array_value( 'color', $array[ $key ] );
      $new_tab   = $this->general_helper->get_array_value( 'new_tab', $array[ $key ] );

      if ( $view_type === 'btn' ) {
        $class = 'btn btn--color-' . $color;
      } elseif ( $view_type === 'link' ) {
        $class = 'link link--color-' . $color;
      }

      if ( $type === 'external' ) {
        $new_tab = true;
      }

      // Create unique ID for GTM.
      $id  = $post->ID . md5( $title . '-' . $url );
      $url = $this->get_link( $url, $type );
    }

    return array(
        'view_type'   => $view_type,
        'title'       => $title,
        'color'       => $class,
        'type'        => $type,
        'url'         => $url,
        'color_value' => $color,
        'new_tab'     => $new_tab,
        'id'          => $id,
    );
  }

  /**
   * Return link array with all fields
   *
   * @param string $link Full link or page ID depending on the type.
   * @param string $type Link type.
   * @return array       Get full link array.
   *
   * @since 2.0.0
   */
  public function get_link( $link, $type ) {
    $url      = '';
    $url_type = '';

    if ( empty( $link ) || empty( $type ) ) {
      return false;
    }

    if ( $type === 'internal' ) {
      if ( is_numeric( $link ) ) {
        $url = get_the_permalink( $link );
      } else {
        $url = $link;
      }
    } elseif ( $type === 'external' || $type === 'mailto' ) {
      $url = $link;
    } elseif ( $type === 'post-category' ) {
      $url = get_category_link( intval( $link, 10 ) );
    }

    return $url;
  }

  /**
   * Return image or placeholder if the image doesn't exist
   *
   * @param string $key            Image key in array.
   * @param array  $array          Array to look in.
   * @param string $image_size     Specify image size.
   * @param bool   $return_default Return placeholder if image doesn't exist.
   * @return array                 Get full image array.
   *
   * @since 2.0.0
   */
  function get_image_simple( $key, $array, $image_size, $return_default = true ) {
    $image       = '';
    $image_title = '';

    if ( $return_default !== false ) {
      $image = INF_IMAGE_URL . 'no-image-' . $image_size . '.jpg';
    }

    if ( ! empty( $this->general_helper->get_array_value( $key, $array ) ) ) {
      $image = $this->general_helper->get_array_value( $key, $array );
      $image = $image['sizes'][ $image_size ];
    }

    return array(
        'image' => $image,
    );
  }

  /**
   * Return title array with all fields
   *
   * @param string $key   Title key in array.
   * @param array  $array Array to look in.
   * @return array        Get full title array.
   *
   * @since 2.0.0
   */
  function get_title( $key, $array ) {
    $title         = '';
    $title_size    = '';
    $title_seo_tag = 'h2';

    if ( ! empty( $this->general_helper->get_array_value( $key, $array ) ) ) {
      $title         = $this->general_helper->get_array_value( 'title', $array[ $key ] );
      $title_size    = 'u-text-size--' . $this->general_helper->get_array_value( 'title_size', $array[ $key ] );
      $title_seo_tag = $this->general_helper->get_array_value( 'title_seo_tag', $array[ $key ] );
    }

    return array(
        'title'   => $title,
        'size'    => $title_size,
        'seo_tag' => $title_seo_tag,
    );
  }

  /**
   * Return utilities
   *
   * @param string $key   Utilities key in array.
   * @param array  $array Array to look in.
   * @return array        Get full utilities array.
   *
   * @since 2.0.0
   */
  function get_utilities( $key, $array ) {
    $class          = '';
    $id             = '';
    $spacing_top    = '';
    $spacing_bottom = '';
    $combined       = '';
    $id_tag         = '';
    $container_size = '';

    if ( ! empty( $this->general_helper->get_array_value( $key, $array ) ) ) {
      $class          = $this->general_helper->get_array_value( 'class', $array[ $key ] );
      $id             = $this->general_helper->get_array_value( 'id', $array[ $key ] );
      $spacing_top    = $this->general_helper->get_array_value( 'spacing_top', $array[ $key ] );
      $spacing_bottom = $this->general_helper->get_array_value( 'spacing_bottom', $array[ $key ] );
      $container_size = $this->general_helper->get_array_value( 'container_size', $array[ $key ] );

      if ( ! empty( $id ) ) {
        $id_tag = 'id=' . $id . '';
      }

      if ( ! empty( $container_size ) ) {
        $container_size = 'section__container--' . $container_size;
      }

      if ( $spacing_top === 'no-spacing' ) {
        $spacing_top = '';
      } else {
        $spacing_top = 'section__spacing-top--' . $spacing_top;
      }

      if ( $spacing_bottom === 'no-spacing' ) {
        $spacing_bottom = '';
      } else {
        $spacing_bottom = 'section__spacing-bottom--' . $spacing_bottom;
      }

      $combined = $class . ' ' . $spacing_top . ' ' . $spacing_bottom;
    }

    return array(
        'class'          => $class,
        'id'             => $id,
        'id_tag'         => $id_tag,
        'spacing_top'    => $spacing_top,
        'spacing_bottom' => $spacing_bottom,
        'combined'       => $combined,
        'container_size' => $container_size,
    );
  }
}
