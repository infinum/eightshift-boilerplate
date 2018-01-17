<?php
/**
 * Fired during plugin activation
 *
 * @link       https://infinum.co/careers
 * @since      1.0.0
 *
 * @package    Json_WP_Post_Parser\Includes
 */

namespace Json_WP_Post_Parser\Includes;

/**
 * Add additional post column
 *
 * Adds 'post_content_json' column in the posts table.
 *
 * @since      1.0.0
 * @package    Json_WP_Post_Parser\Includes
 * @author     Infinum <info@infinum.co>
 */
class Json_WP_Post_Parser_Activator {

  /**
   * Create post column if it doesn't exist.
   *
   * @since    1.0.0
   */
  public static function activate() {
    $post_json_column_exists = get_option( 'post_json_column_exists' );

    if ( empty( $post_json_column_exists ) || $post_json_column_exists === false ) {
      global $wpdb;

      $column_check = $wpdb->get_row( "SELECT * FROM $wpdb->posts" );

      if ( empty( $column_check->post_content_json ) ) {
        $create_column = $wpdb->query( "ALTER TABLE $wpdb->posts ADD post_content_json LONGTEXT NOT NULL" );
        // Store this info in the database for future use.
        add_option( 'post_json_column_exists', true );
      }
    }
  }
}
