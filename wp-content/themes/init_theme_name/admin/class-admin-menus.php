<?php
/**
 * The admin sidebar menu specific functionality.
 *
 * @since   2.0.0
 * @package Inf_Theme\Admin
 */

namespace Inf_Theme\Admin;

/**
 * Class Admin_Menus
 */
class Admin_Menus {

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
   * Remove some menu links
   *
   * This methdd removes Comments menu from the admin side.
   * You can remove or modify this if necessary.
   *
   * @since 2.0.0
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
