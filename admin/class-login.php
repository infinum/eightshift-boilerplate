<?php
/**
 * The login page specific functionality.
 *
 * @since   1.0.0
 * @package Inf_Theme\Admin
 */

namespace Inf_Theme\Admin;

use Inf_Theme\Includes\Service;

/**
 * Class Login
 */
class Login implements Service {

  /**
   * Register all the hooks
   *
   * @since 1.0.0
   */
  public function register() {
    add_filter( 'login_headerurl', [ $this, 'custom_login_url' ] );
  }

  /**
   * Change default logo link with home url
   *
   * @since 1.0.0
   */
  public function custom_login_url() {
    return home_url( '/' );
  }
}
