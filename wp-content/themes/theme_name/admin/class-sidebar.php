<?php
/**
 * The sidebar menu specific functionality.
 *
 * @since   1.0.0
 * @package theme_name
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
    $this->theme_name = $theme_info['theme_name'];
    $this->theme_version = $theme_info['theme_version'];
    $this->assets_version = $theme_info['assets_version'];
  }

  /**
   * Remove some menu links
   *
   * @since 1.0.0
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
