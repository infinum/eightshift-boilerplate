<?php
/**
 * The file that defines the main start class
 *
 * A class definition that includes attributes and functions used across both the
 * theme-facing side of the site and the admin area.
 *
 * @since   2.0.0
 * @package Inf_Theme\Includes
 */

namespace Inf_Theme\Includes;

use Inf_Theme\Admin as Admin;
use Inf_Theme\Admin\Menu as Menu;
use Inf_Theme\Plugins\Acf as Acf;
use Inf_Theme\Theme as Theme;
use Inf_Theme\Theme\Utils as Utils;
use Inf_Theme\Helpers\General_Helper;

/**
 * The main start class.
 *
 * This is used to define admin-specific hooks, and
 * theme-facing site hooks.
 *
 * Also maintains the unique identifier of this theme as well as the current
 * version of the theme.
 */
class Main {

  /**
   * Loader variable for hooks
   *
   * @var Loader    $loader    Maintains and registers all hooks for the plugin.
   *
   * @since 2.0.0
   */
  protected $loader;

  /**
   * Initialize class
   * Load hooks and define some global variables.
   *
   * @since 3.0.0 Removing constants.
   * @since 2.0.0
   */
  public function __construct() {
    $this->load_dependencies();
    $this->set_locale();
    $this->set_assets_manifest_data();
    $this->define_admin_hooks();
    $this->define_theme_hooks();
  }

  /**
   * General Helper class instance
   *
   * @since 3.0.0
   *
   * @return class
   */
  public function general_helper() {
    return new General_Helper();
  }

  /**
   * Load the required dependencies.
   *
   * Create an instance of the loader which will be used to register the hooks
   * with WordPress.
   *
   * @since 2.0.0
   */
  private function load_dependencies() {
    $this->loader = new Loader();
  }

  /**
   * Define the locale for this theme for internationalization.
   *
   * @since 2.0.0
   */
  private function set_locale() {
    $plugin_i18n = new Internationalization();

    $this->loader->add_action( 'after_setup_theme', $plugin_i18n, 'load_theme_textdomain' );
  }

  /**
   * Register all of the hooks related to the admin area functionality.
   *
   * @since 2.0.0
   */
  private function define_admin_hooks() {
    $admin       = new Admin\Admin( $this->general_helper() );
    $login       = new Admin\Login();
    $editor      = new Admin\Editor();
    $admin_menus = new Admin\Admin_Menus();
    $users       = new Admin\Users();
    $widgets     = new Admin\Widgets();
    $media       = new Admin\Media( $this->general_helper() );
    $menu        = new Menu\Menu();

    // Admin.
    $this->loader->add_action( 'login_enqueue_scripts', $admin, 'enqueue_styles' );
    $this->loader->add_action( 'admin_enqueue_scripts', $admin, 'enqueue_styles', 50 );
    $this->loader->add_filter( 'get_user_option_admin_color', $admin, 'set_admin_color_based_on_env' );
    $this->loader->add_action( 'admin_enqueue_scripts', $admin, 'enqueue_scripts' );

    // Login page.
    $this->loader->add_filter( 'login_headerurl', $login, 'custom_login_url' );

    // Editor.
    $this->loader->add_action( 'admin_init', $editor, 'add_editor_styles' );

    // Sidebar.
    $this->loader->add_action( 'admin_menu', $admin_menus, 'remove_sub_menus' );

    // Users.
    $this->loader->add_action( 'set_user_role', $users, 'send_main_when_user_role_changes', 10, 2 );
    $this->loader->add_action( 'admin_init', $users, 'edit_editors_capabilities' );

    // Widgets.
    $this->loader->add_action( 'widgets_init', $widgets, 'register_widget_position' );

    // Menu.
    $this->loader->add_action( 'after_setup_theme', $menu, 'register_menu_positions' );

    // Media.
    $this->loader->add_action( 'upload_mimes', $media, 'enable_mime_types' );
    $this->loader->add_action( 'wp_prepare_attachment_for_js', $media, 'enable_svg_library_preview', 10, 3 );
    $this->loader->add_action( 'embed_oembed_html', $media, 'wrap_responsive_oembed_filter', 10, 4 );
    $this->loader->add_action( 'after_setup_theme', $media, 'add_theme_support' );
    $this->loader->add_action( 'after_setup_theme', $media, 'add_custom_image_sizes' );
    $this->loader->add_filter( 'wp_handle_upload_prefilter', $media, 'check_svg_on_media_upload' );
  }

  /**
   * Register all of the hooks related to the theme area functionality.
   *
   * @since 2.0.0
   */
  private function define_theme_hooks() {
    $theme      = new Theme\Theme( $this->general_helper() );
    $gallery    = new Utils\Gallery();
    $general    = new Theme\General();
    $pagination = new Theme\Pagination();

    // Enque styles and scripts.
    $this->loader->add_action( 'wp_enqueue_scripts', $theme, 'enqueue_styles' );
    $this->loader->add_action( 'wp_enqueue_scripts', $theme, 'enqueue_scripts' );

    // Remove inline gallery css.
    $this->loader->add_filter( 'use_default_gallery_style', $theme, '__return_false' );

    /**
     * Optimizations
     *
     * This will remove some default functionality, but it mostly removes unnecessary
     * meta tags from the head section.
     */
    $this->loader->remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    $this->loader->remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    $this->loader->remove_action( 'wp_print_styles', 'print_emoji_styles' );
    $this->loader->remove_action( 'admin_print_styles', 'print_emoji_styles' );
    $this->loader->remove_action( 'wp_head', 'wp_generator' );
    $this->loader->remove_action( 'wp_head', 'wlwmanifest_link' );
    $this->loader->remove_action( 'wp_head', 'wp_shortlink_wp_head' );
    $this->loader->remove_action( 'wp_head', 'rsd_link' );
    $this->loader->remove_action( 'wp_head', 'feed_links', 2 );
    $this->loader->remove_action( 'wp_head', 'feed_links_extra', 3 );
    $this->loader->remove_action( 'wp_head', 'rest_output_link_wp_head' );

    // Gallery.
    $this->loader->add_filter( 'post_gallery', $gallery, 'wrap_post_gallery', 10, 3 );

    // General.
    $this->loader->add_action( 'after_setup_theme', $general, 'add_theme_support' );

    // Pagination.
    $this->loader->add_filter( 'next_posts_link_attributes', $pagination, 'pagination_link_next_class' );
    $this->loader->add_filter( 'previous_posts_link_attributes', $pagination, 'pagination_link_prev_class' );
  }

  /**
   * Run the loader to execute all of the hooks with WordPress.
   *
   * @since 2.0.0
   */
  public function run() {
    $this->loader->run();
  }

  /**
   * Define global variable to save memory when parsing manifest on every load.
   *
   * @since 3.0.0
   */
  public function set_assets_manifest_data() {
    $response = file_get_contents( INF_ASSETS_PUBLIC_PATH . 'manifest.json' );

    if ( ! $response ) {
      return;
    }

    define( 'INF_ASSETS_MANIFEST', $response );
  }
}
