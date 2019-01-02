<?php
/**
 * The users specific functionality.
 *
 * @since   1.0.0
 * @package Inf_Theme\Admin
 */

namespace Inf_Theme\Admin;

/**
 * Class Users
 */
class Users {

  /**
   * Send email to user on role change
   *
   * @param number $user_id User ID.
   * @param string $new_role User new role.
   *
   * @since 1.0.0
   */
  public function send_main_when_user_role_changes( $user_id, $new_role ) {
    $site_url  = get_bloginfo( 'wpurl' );
    $user_info = get_userdata( $user_id );
    $to        = $user_info->user_email;
    $subject   = sprintf( esc_html__( 'Role changed: %s', 'inf_theme' ), $site_url );
    $message   = sprintf( esc_html__( 'Hello %1$s, your role has changed on %2$s. Congratulations, you are now an %3$s.', 'inf_theme' ), $user_info->display_name, $site_url, $new_role );
    wp_mail( $to, $subject, $message );
  }

}
