<?php
/**
 * Modify WordPress admin behavior
 *
 * @package Eightshift_Boilerplate\Admin
 */

declare( strict_types=1 );

namespace Eightshift_Boilerplate\Admin;

use Eightshift_Libs\Core\Service;

/**
 * Class that modifies some administrator appearance
 *
 * Example: Change color based on environment, remove dashboard widgets etc.
 *
 * @since 4.0.0
 */
final class Modify_Admin_Appearance implements Service {

  /**
   * List of admin color schemes.
   *
   * @var array
   */
  const COLOR_SCHEMES = [
    'default'   => 'fresh',
    'staging'   => 'blue',
    'prodution' => 'sunrise',
  ];

  /**
   * Register all the hooks
   *
   * @return void
   *
   * @since 4.0.0
   */
  public function register() : void {
    \add_filter( 'get_user_option_admin_color', [ $this, 'set_admin_color' ], 10, 0 );
  }

  /**
   * Method that changes admin colors based on environment variable
   *
   * @return string Modified color scheme.
   *
   * @since 4.0.0.
   */
  public function set_admin_color() : string {
    if ( ! \defined( 'EB_ENV' ) || ! isset( self::COLOR_SCHEMES[ EB_ENV ] ) ) {
      return self::COLOR_SCHEMES['default'];
    }

    return self::COLOR_SCHEMES[ EB_ENV ];
  }
}
