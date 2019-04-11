<?php
/**
 * The file that defines the main start class.
 *
 * A class definition that includes attributes and functions used across both the
 * theme-facing side of the site and the admin area.
 *
 * @since   4.0.0 Implementing Eightshift_Libs.
 * @since   1.0.0
 * @package Inf_Theme\Core
 */

namespace Inf_Theme\Core;

use Eightshift_Libs\Core\Main as LibMain;

use Inf_Theme\Admin;
use Inf_Theme\Admin\Menu;
use Inf_Theme\Theme;

/**
 * The main start class.
 *
 * This is used to define admin-specific hooks, and
 * theme-facing site hooks.
 *
 * Also maintains the unique identifier of this theme as well as the current
 * version of the theme.
 */
class Main extends LibMain {

  /**
   * Get the list of services to register.
   *
   * A list of classes which contain hooks.
   *
   * @return array<string> Array of fully qualified class names.
   */
  protected function get_service_classes() : array {
    return [
      Manifest::class,
      Admin\Admin::class,
      Admin\Login::class,
      Admin\Media::class,
      Admin\Widgets::class,
      Menu\Menu::class,
      Theme\Theme::class,
    ];
  }
}
