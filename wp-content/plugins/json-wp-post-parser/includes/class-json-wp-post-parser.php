<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://infinum.co/careers
 * @since      1.0.0
 *
 * @package    Json_WP_Post_Parser\Includes
 */

namespace Json_WP_Post_Parser\Includes;
use Json_WP_Post_Parser\Admin as Admin;

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Json_WP_Post_Parser\Includes
 * @author     Infinum <info@infinum.co>
 */
class Json_WP_Post_Parser {

  /**
   * The loader that's responsible for maintaining and registering all hooks that power
   * the plugin.
   *
   * @since    1.0.0
   * @access   protected
   * @var      Json_WP_Post_Parser_Loader    $loader    Maintains and registers all hooks for the plugin.
   */
  protected $loader;

  /**
   * The unique identifier of this plugin.
   *
   * @since    1.0.0
   * @access   protected
   * @var      string    $plugin_name    The string used to uniquely identify this plugin.
   */
  protected $plugin_name;

  /**
   * The current version of the plugin.
   *
   * @since    1.0.0
   * @access   protected
   * @var      string    $version    The current version of the plugin.
   */
  protected $version;

  /**
   * Define the core functionality of the plugin.
   *
   * Set the plugin name and the plugin version that can be used throughout the plugin.
   * Load the dependencies, define the locale, and set the hooks for the admin area and
   * the public-facing side of the site.
   *
   * @since    1.0.0
   */
  public function __construct() {
    if ( defined( 'JWPP_PLUGIN_VERSION' ) ) {
      $this->version = JWPP_PLUGIN_VERSION;
    } else {
      $this->version = '1.0.0';
    }

    if ( defined( 'JWPP_PLUGIN_NAME' ) ) {
      $this->plugin_name = JWPP_PLUGIN_NAME;
    } else {
      $this->plugin_name = 'json-wp-post-parser';
    }

    $this->load_dependencies();
    $this->set_locale();
    $this->define_admin_hooks();
    $this->register_rest_routes();
  }

  /**
   * Load the required dependencies for this plugin.
   *
   * Create an instance of the loader which will be used to register the hooks
   * with WordPress.
   *
   * @since    1.0.0
   * @access   private
   */
  private function load_dependencies() {
    $this->loader = new Json_WP_Post_Parser_Loader();
  }

  /**
   * Define the locale for this plugin for internationalization.
   *
   * Uses the Json_WP_Post_Parser_i18n class in order to set the domain and to register the hook
   * with WordPress.
   *
   * @since    1.0.0
   * @access   private
   */
  private function set_locale() {
    $plugin_i18n = new Json_WP_Post_Parser_i18n();

    $this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
  }

  /**
   * Register all of the hooks related to the admin area functionality
   * of the plugin.
   *
   * @since    1.0.0
   * @access   private
   */
  private function define_admin_hooks() {
    $plugin_admin = new Admin\Json_WP_Post_Parser_Admin( $this->get_plugin_name(), $this->get_version() );
    $plugin_parse = new Admin\Json_WP_Post_Parser_Parse( $this->get_plugin_name(), $this->get_version() );

    $this->loader->add_action( 'save_post', $plugin_parse, 'update_post_json_content', 10, 3 );
    $this->loader->add_action( 'admin_menu', $plugin_admin, 'add_posts_parse_page' );
    $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
  }

  /**
   * Register custom REST routes.
   *
   * @since    1.0.0
   * @access   private
   */
  private function register_rest_routes() {
    $plugin_rest = new Admin\Json_WP_Post_Parser_Rest( $this->get_plugin_name(), $this->get_version() );

    $this->loader->add_action( 'rest_api_init', $plugin_rest, 'api_fields_init' );
  }

  /**
   * Run the loader to execute all of the hooks with WordPress.
   *
   * @since    1.0.0
   */
  public function run() {
    $this->loader->run();
  }

  /**
   * The name of the plugin used to uniquely identify it within the context of
   * WordPress and to define internationalization functionality.
   *
   * @since     1.0.0
   * @return    string    The name of the plugin.
   */
  public function get_plugin_name() {
    return $this->plugin_name;
  }

  /**
   * The reference to the class that orchestrates the hooks with the plugin.
   *
   * @since     1.0.0
   * @return    Json_WP_Post_Parser_Loader    Orchestrates the hooks of the plugin.
   */
  public function get_loader() {
    return $this->loader;
  }

  /**
   * Retrieve the version number of the plugin.
   *
   * @since     1.0.0
   * @return    string    The version number of the plugin.
   */
  public function get_version() {
    return $this->version;
  }

}
