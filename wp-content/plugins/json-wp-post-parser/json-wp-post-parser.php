<?php
/**
 *
 * Plugin main file
 *
 * @link              https://infinum.co/careers
 * @since             1.0.0
 * @package           Json_WP_Post_Parser
 *
 * @wordpress-plugin
 * Plugin Name:       JSON post parser
 * Plugin URI:        http://infinum.co
 * Description:       Parse post and pages content as JSON and serve it in default REST endpoint.
 * Version:           1.0.0
 * Author:            Infinum
 * Author URI:        https://infinum.co/careers
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       json-wp-post-parser
 */

namespace Json_WP_Post_Parser;
use Json_WP_Post_Parser\Includes as Includes;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
  die;
}

define( 'JWPP_PLUGIN_VERSION', '1.0.0' );
define( 'JWPP_PLUGIN_NAME', 'json-wp-post-parser' );

// Include the autoloader so we can dynamically include the rest of the classes.
include_once( 'lib/autoloader.php' );

add_action( 'admin_init', __NAMESPACE__ . '\\json_wp_post_parser_add_activation_notice' );

/**
 * Add admin notice upon plugin activation
 *
 * @since 1.0.0
 */
function json_wp_post_parser_add_activation_notice() {
  add_action( 'admin_notices', __NAMESPACE__ . '\\json_wp_post_parser_activation_notice' );
}

/**
 * Custom activation notice
 *
 * @since 1.0.0
 */
function json_wp_post_parser_activation_notice() {
  $json_wp_post_parser_active = get_option( 'json_wp_post_parser_active' );

  if ( ! $json_wp_post_parser_active ) {
    update_option( 'json_wp_post_parser_active', true );
    ?>
    <div class="notice notice-success is-dismissible">
      <p><?php printf( esc_html__( 'If you want to update all your posts and pages, go to ', 'json-wp-post-parser' ) . '<a href="%s">' . esc_html__( 'this page', 'json-wp-post-parser' ) . '</a>', esc_url( admin_url( 'options-general.php?page=json_parser_posts' ) ) ); ?></p>
    </div>
    <?php
  }
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-json-wp-post-parser-activator.php
 */
function activate_json_wp_post_parser() {
  require_once plugin_dir_path( __FILE__ ) . 'includes/class-json-wp-post-parser-activator.php';
  Includes\Json_WP_Post_Parser_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-json-wp-post-parser-deactivator.php
 */
function deactivate_json_wp_post_parser() {
  require_once plugin_dir_path( __FILE__ ) . 'includes/class-json-wp-post-parser-deactivator.php';
  Includes\Json_WP_Post_Parser_Deactivator::deactivate();
}

register_activation_hook( __FILE__, __NAMESPACE__ . '\\activate_json_wp_post_parser' );
register_deactivation_hook( __FILE__, __NAMESPACE__ . '\\deactivate_json_wp_post_parser' );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_json_wp_post_parser() {
  $plugin = new Includes\Json_WP_Post_Parser();
  $plugin->run();
}

run_json_wp_post_parser();
