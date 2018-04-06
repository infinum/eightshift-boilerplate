<?php
/**
 * The Advance Custom Field plugin specific functionality.
 *
 * @since   2.0.0
 * @package Inf_Theme\Plugins\Acf
 */

namespace Inf_Theme\Plugins\Acf;

/**
 * Class Advance Custom Fields
 *
 * Main class for any ACF functionality.
 */
class Acf {

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
   * Initialize class
   *
   * @param array $theme_info Load global theme info.
   *
   * @since 2.0.0
   */
  public function __construct( $theme_info = null ) {
    $this->theme_name    = $theme_info['theme_name'];
    $this->theme_version = $theme_info['theme_version'];
  }

  /**
   * Add new toolbar to the ACF WYSIWYG editor
   *
   * @param  array $toolbars Existing toolbars.
   * @return array           Modified toolbars.
   *
   * @since 2.0.0
   */
  public function add_wysiwyg_toolbars( $toolbars ) {

    $toolbars['Very Simple'] = array();
    $toolbars['Very Simple'][1] = array( 'bold', 'italic', 'underline', 'formatselect' );

    $key = array_search( 'code', $toolbars['Full'][2], true );

    if ( $key !== false ) {
      unset( $toolbars['Full'][2][ $key ] );
    }

    return $toolbars;
  }

  /**
   * Add Google Maps API key from admin
   *
   * @param  array $api Existing maps object.
   * @return array      Return modiried object.
   *
   * @since 2.0.0
   */
  public function set_google_map_api_key( $api ) {

    $theme_options_general = new Theme_Options();

    $api['key'] = $theme_options_general->get_theme_option( 'google_maps_api_key' );

    return $api;
  }

}
