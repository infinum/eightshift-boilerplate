<?php
/**
 * Fired during plugin deactivation
 *
 * @link       https://infinum.co/careers
 * @since      1.0.0
 *
 * @package    Json_WP_Post_Parser\Includes
 */

namespace Json_WP_Post_Parser\Includes;

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Json_WP_Post_Parser\Includes
 * @author     Infinum <info@infinum.co>
 */
class Json_WP_Post_Parser_Deactivator {

  /**
   * Flush permalinks
   *
   * @since    1.0.0
   */
  public static function deactivate() {
    delete_option( 'json_wp_post_parser_active' );
    flush_rewrite_rules();
  }

}
