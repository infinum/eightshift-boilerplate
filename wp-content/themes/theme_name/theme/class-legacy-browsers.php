<?php
/**
 * The login-specific functionality.
 *
 * @since      1.0.0
 *
 * @package    Aaa
 */

/**
 * The login-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Aaa
 */
namespace Inf_Theme\Theme;

/**
 * Class Legacy Browsers
 */
class Legacy_Browsers {

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
   * Get browser object from browser cap
   * this will not work if you don't have browsecap setup in phpini
   * reference the location of browsecap.ini to phpini on your server.
   *
   * Here is a link for download. For this you can download the smallest version.
   * https://browscap.org/
   *
   * @return void
   */
  public function get_browser_info() {
    $browser_info = get_browser();

    if ( $browser_info === false ) {
      return false;
    }

    return $browser_info;
  }

  /**
   * Get browser version number
   *
   * @return string Return browser version name.
   */
  public function get_browser_version() {
    $browser_verion = $this->get_browser_info();

    return (int) $browser_verion->majorver;
  }

  /**
   * Get Browser name
   *
   * @return void
   */
  public function get_browser_name() {
    $browser_name = $this->get_browser_info();

    return $browser_name->browser;
  }

  /**
   * Check if browser is valid.
   *
   * @since    1.0.0
   */
  public function check_is_browser_valid() {

    $browser_name = $this->get_browser_name();
    $browser_version = $this->get_browser_version();

    if ( ($browser_name === 'IE' && $browser_version <= 10) || ( $browser_name === 'Safari' && $browser_version <= 8 ) ) {
      return true;
    }

    return false;
  }

  /**
   * If old browser is detected go to redirect
   *
   * @return void
   */
  public function redirect_to_legacy_browsers_page() {

    if( $this->check_is_browser_valid() === true ) {
      global $wp_query, $inf_theme_options;
      $redirect_page = $inf_theme_options['old_browsers_page'];

      // Prevent redirections if you are allready on the redirect page.
      if ( $wp_query->post->ID !== $redirect_page ) {
        wp_redirect( get_permalink( $redirect_page ), 301 );
        exit;
      }
    }
  }

}
