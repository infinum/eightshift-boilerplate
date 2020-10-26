<?php
/**
 * The Menu specific functionality.
 *
 * @since   1.0.0
 * @package Eightshift_Boilerplate\Menu
 */

declare( strict_types=1 );

namespace Eightshift_Boilerplate\Menu;

use Eightshift_Libs\Core\Service;
use Eightshift_Libs\Menu\Menu as Libs_Menu;

/**
 * Class Menu
 *
 * @since 1.0.0
 */
class Menu extends Libs_Menu {

  /**
   * Return all menu poistions
   *
   * @return array<string, string> Menu positions with slug => name structure.
   *
   * @since 1.0.0
   */
  public function get_menu_positions() : array {
    return [
      'header_main_nav' => esc_html__( 'Main Menu', 'eightshift-boilerplate' ),
      'footer_main_nav' => esc_html__( 'Footer Menu', 'eightshift-boilerplate' ),
    ];
  }
}
