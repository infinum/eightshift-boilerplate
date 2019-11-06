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
   * Register all the hooks
   *
   * @return void
   *
   * @since 4.0.0
   */
  public function register() : void {
    add_filter( 'get_user_option_admin_color', [ $this, 'set_admin_color' ] );
  }

  /**
   * Method that changes admin colors based on environment variable
   *
   * @param string $color_scheme Color scheme string.
   * @return string              Modified color scheme.
   *
   * @since 4.0.0.
   */
  public function set_admin_color( string $color_scheme ) : string {
    if ( ! \defined( 'EB_ENV' ) ) {
      return 'fresh';
    }

    switch ( EB_ENV ) {
      case 'production':
        $color_scheme = 'sunrise';
            break;
      case 'staging':
        $color_scheme = 'blue';
            break;
      default:
        $color_scheme = 'fresh';
            break;
    }

    return $color_scheme;
  }
}
