<?php
/**
 * The Menu specific functionality.
 *
 * @since   1.0.0
 * @package theme_name
 */

namespace Inf_Theme\Theme\Menu;

/**
 * Class Menu
 */
class Menu {

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
   *
   * @since 1.0.0
   */
  public function __construct( $theme_info = null ) {
    $this->theme_name = $theme_info['theme_name'];
    $this->theme_version = $theme_info['theme_version'];
    $this->assets_version = $theme_info['assets_version'];
  }

  /**
   * Register All Menu positions
   *
   * @since 1.0.0
   */
  public function register_menu_positions() {
    register_nav_menus(
      array(
          'header_main_nav' => esc_html__( 'Menu', 'theme_name' ),
      )
    );
  }

  /**
   * Bem_menu returns an instance of the Bem_Menu_Walker class with the following arguments
   *
   * @param  string     $location            This must be the same as what is set in wp-admin/settings/menus for menu location and registrated in register_menu_positions function.
   * @param  string     $css_class_prefix    This string will prefix all of the menu's classes, BEM syntax friendly.
   * @param  arr|string $css_class_modifiers Provide either a string or array of values to apply extra classes to the <ul> but not the <li's>.
   * @param  bool       $echo                Echo the menu.
   * @return string                          Outputs html version of menu.
   *
   * @since 1.0.0
   */
  public function bem_menu( $location = 'main_menu', $css_class_prefix = 'main-menu', $css_class_modifiers = null, $echo = true ) {

      // Check to see if any css modifiers were supplied.
    if ( $css_class_modifiers ) {

      if ( is_array( $css_class_modifiers ) ) {
        $modifiers = implode( ' ', $css_class_modifiers );
      } elseif ( is_string( $css_class_modifiers ) ) {
        $modifiers = $css_class_modifiers;
      }
    } else {
      $modifiers = '';
    }

      $args = array(
          'theme_location'    => $location,
          'container'         => false,
          'items_wrap'        => '<ul class="' . $css_class_prefix . ' ' . $modifiers . '">%3$s</ul>',
          'echo'              => $echo,
          'walker'            => new Bem_Menu_Walker( $css_class_prefix ),
      );

    if ( has_nav_menu( $location ) ) {
      return wp_nav_menu( $args );
    }
  }
}
