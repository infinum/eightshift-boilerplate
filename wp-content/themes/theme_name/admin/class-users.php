<?php

/**
 * The login-specific functionality.
 * 
 * @since      1.0.0
 *
 * @package    Aaa
 */

/**
 * The login-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Aaa
 */
namespace Inf_Theme\Admin;

class Users {

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
   * Init call
   */
  public function __construct( $theme_info = null ) {
    $this->theme_name = $theme_info['theme_name'];
    $this->theme_version = $theme_info['theme_version'];
    $this->assets_version = $theme_info['assets_version'];
  }

  /**
   * Send email to user on role change
   *
   * @param number $user_id User ID.
   * @param string $new_role User new role.
   */
  public function send_main_when_user_role_changes( $user_id, $new_role  ) {
    $site_url = get_bloginfo( 'wpurl' );
    $user_info = get_userdata( $user_id );
    $to = $user_info->user_email;
    $subject = 'Role changed: ' . $site_url . '';
    $message = 'Hello ' . $user_info->display_name . ' your role has changed on ' . $site_url . ', congratulations you are now an ' . $new_role;
    wp_mail( $to, $subject, $message );
  }

  public function edit_editors_compatibilities() {
    $role_object_editor = get_role( 'editor' );
    if ( ! $role_object_editor->has_cap( 'edit_theme_options' ) ) {
        $role_object_editor->add_cap( 'edit_theme_options' );
    }
  }

}
