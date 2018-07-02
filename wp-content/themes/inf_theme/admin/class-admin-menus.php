<?php
/**
 * The admin sidebar menu specific functionality.
 *
 * @since   3.0.0 Removing global variables.
 * @since   2.0.0
 * @package Inf_Theme\Admin
 */

namespace Inf_Theme\Admin;

/**
 * Class Admin_Menus
 */
class Admin_Menus {

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
