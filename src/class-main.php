<?php
/**
 * The file that defines the main start class.
 *
 * A class definition that includes attributes and functions used across both the
 * theme-facing side of the site and the admin area.
 *
 * @since   1.0.0
 * @package Eightshift_Boilerplate\Core
 */

declare( strict_types=1 );

namespace Eightshift_Boilerplate\Core;

use Eightshift_Libs\Core\Main as Lib_Core;
use Eightshift_Libs\Manifest as Lib_Manifest;
use Eightshift_Libs\Enqueue as Lib_Enqueue;
use Eightshift_Libs\I18n as Lib_I18n;
use Eightshift_Libs\Login as Lib_Login;
use Eightshift_Libs\Blocks as Lib_Blocks;

use Eightshift_Boilerplate\Admin;
use Eightshift_Boilerplate\Menu;
use Eightshift_Boilerplate\Media;

/**
 * The main start class.
 *
 * This is used to define admin-specific hooks, and
 * theme-facing site hooks.
 *
 * Also maintains the unique identifier of this theme as well as the current
 * version of the theme.
 *
 * @since 1.0.0
 */
class Main extends Lib_Core {

  /**
   * Get the list of services to register.
   *
   * A list of classes which contain hooks.
   *
   * @return array<string> Array of fully qualified class names.
   *
   * @since 1.0.0
   */
  protected function get_service_classes() : array {
    return [

      // Config.
      Config::class,

      // Manifest.
      Lib_Manifest\Manifest::class => [ Config::class ],

      // I18n.
      Lib_I18n\I18n::class => [ Config::class ],

      // Enqueue.
      Lib_Enqueue\Enqueue_Admin::class => [ Config::class, Lib_Manifest\Manifest::class ],
      Lib_Enqueue\Enqueue_Theme::class => [ Config::class, Lib_Manifest\Manifest::class ],
      Lib_Enqueue\Enqueue_Blocks::class => [ Config::class, Lib_Manifest\Manifest::class ],

      // Login.
      Lib_Login\Login::class,

      // Media.
      Media\Media::class,

      // Admin.
      Admin\Modify_Admin_Appearance::class,

      // Menu.
      Menu\Menu::class,

      // Blocks.
      Lib_Blocks\Blocks::class => [ Config::class ],
    ];
  }
}
