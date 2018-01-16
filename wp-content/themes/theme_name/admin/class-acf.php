<?php
/**
 * The Advance Custom Field specific functionality.
 *
 * @since   1.0.0
 * @package theme_name
 */

namespace Inf_Theme\Admin;

use Inf_Theme\Theme\Acf as Acf_Theme;

/**
 * Class Advance Custom Fields
 */
class Acf {

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
   * Add new toolbar to the ACF WYSIWYG editor
   *
   * @param  array $toolbars Existing toolbars.
   * @return array           Modified toolbars.
   *
   * @since 1.0.0
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
   * @since 1.0.0
   */
  public function set_google_map_api_key( $api ) {

    $theme_options_general = new Acf_Theme\Theme_Options_General();

    $api['key'] = $theme_options_general->get_theme_option( 'google_maps_api_key' );

    return $api;
  }

}
