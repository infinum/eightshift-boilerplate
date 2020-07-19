<?php
/**
 * The file that defines the main start class.
 *
 * A class definition that includes attributes and functions used across both the
 * theme-facing side of the site and the admin area.
 *
 * @package EightshiftBoilerplate\Core
 */

declare( strict_types=1 );

namespace EightshiftBoilerplate\Core;

use EightshiftBoilerplateVendor\EightshiftLibs\Core\AbstractMain;
use EightshiftBoilerplateVendor\EightshiftLibs\Manifest as LibManifest;
use EightshiftBoilerplateVendor\EightshiftLibs\Enqueue as LibEnqueue;
use EightshiftBoilerplateVendor\EightshiftLibs\I18n as LibI18n;
use EightshiftBoilerplateVendor\EightshiftLibs\Login as LibLogin;
use EightshiftBoilerplateVendor\EightshiftLibs\Blocks as LibBlocks;

use EightshiftBoilerplate\Admin;
use EightshiftBoilerplate\Menu;
use EightshiftBoilerplate\Media;

/**
 * The main start class.
 *
 * This is used to define admin-specific hooks, and
 * theme-facing site hooks.
 *
 * Also maintains the unique identifier of this theme as well as the current
 * version of the theme.
 */
class Main extends AbstractMain {

  /**
   * Get the list of services to register.
   *
   * A list of classes which contain hooks.
   *
   * @return array<string> Array of fully qualified class names.
   */
  protected function get_service_classes() : array {
    return [

      // Config.
      Config::class,

      // Manifest.
      LibManifest\Manifest::class => [ Config::class ],

      // I18n.
      LibI18n\I18n::class => [ Config::class ],

      // Enqueue.
      LibEnqueue\EnqueueAdmin::class => [ LibManifest\Manifest::class ],
      LibEnqueue\EnqueueTheme::class => [ LibManifest\Manifest::class ],
      LibEnqueue\EnqueueBlocks::class => [ LibManifest\Manifest::class ],

      // Login.
      LibLogin\Login::class,

      // Media.
      Media\Media::class,

      // Admin.
      Admin\FinalModifyAdminAppearance::class,

      // Menu.
      Menu\Menu::class,

      // Blocks.
      // LibBlocks\Blocks::class => [ Config::class ],
    ];
  }
}