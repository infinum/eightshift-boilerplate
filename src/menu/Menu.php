<?php
/**
 * The Menu specific functionality.
 *
 * @package EightshiftBoilerplate\Menu
 */

declare( strict_types=1 );

namespace EightshiftBoilerplate\Menu;

use EightshiftBoilerplateVendor\EightshiftLibs\Menu\AbstractMenu;

/**
 * Class Menu
 */
class Menu extends AbstractMenu {

  /**
   * Return all menu poistions
   *
   * @return array Menu positions with slug => name structure.
   */
  public function get_menu_positions() : array {
    return [
      'header_main_nav' => esc_html__( 'Main Menu', 'eightshift-boilerplate' ),
      'footer_main_nav' => esc_html__( 'Footer Menu', 'eightshift-boilerplate' ),
    ];
  }
}
