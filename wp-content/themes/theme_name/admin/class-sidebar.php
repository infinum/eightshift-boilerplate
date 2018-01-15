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
namespace Inf_Theme\Admin;

/**
 * Class Sidebar
 */
class Sidebar {

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
   * Custom WordPress Login link
   *
   * @since    1.0.0
   */
  public function remove_sub_menus() {
    remove_menu_page( 'edit-comments.php' );

    if ( current_user_can( 'editor' ) ) {
      remove_submenu_page( 'themes.php', 'themes.php' );

      global $submenu;
      unset( $submenu['themes.php'][6] );
    }
  }

}
