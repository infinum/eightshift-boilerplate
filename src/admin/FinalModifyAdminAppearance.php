<?php
/**
 * Modify WordPress admin behavior
 *
 * @package EightshiftBoilerplate\Admin
 */

declare( strict_types=1 );

namespace EightshiftBoilerplate\Admin;

use EightshiftBoilerplateVendor\EightshiftLibs\Core\ServiceInterface;

/**
 * Class that modifies some administrator appearance
 *
 * Example: Change color based on environment, remove dashboard widgets etc.
 */
final class FinalModifyAdminAppearance implements ServiceInterface {

  /**
   * List of admin color schemes.
   *
   * @var array
   */
  const COLOR_SCHEMES = [
    'default'   => 'fresh',
    'staging'   => 'blue',
    'production' => 'sunrise',
  ];

  /**
   * Register all the hooks
   *
   * @return void
   */
  public function register() {
    \add_filter( 'get_user_option_admin_color', [ $this, 'set_admin_color' ], 10, 0 );
  }

  /**
   * Method that changes admin colors based on environment variable
   *
   * @return string Modified color scheme..
   */
  public function set_admin_color() : string {
    if ( ! \defined( 'EB_ENV' ) || ! isset( self::COLOR_SCHEMES[ EB_ENV ] ) ) {
      return self::COLOR_SCHEMES['default'];
    }

    return self::COLOR_SCHEMES[ EB_ENV ];
  }
}
