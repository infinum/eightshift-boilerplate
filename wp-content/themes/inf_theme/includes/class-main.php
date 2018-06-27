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
   * Global theme name
   *
   * @var string
   *
   * @since 2.0.0
   */
  protected $theme_name;

  /**
   * Global theme version
   *
   * @var string
   *
   * @since 2.0.0
   */
  protected $theme_version;

  /**
   * Initialize class
   * Load hooks and define some global variables.
   *
   * @since 2.0.0
   */
  public function __construct() {

    if ( defined( 'INF_THEME_VERSION' ) ) {
      $this->theme_version = INF_THEME_VERSION;
    } else {
      $this->theme_version = '1.0.0';
    }

    if ( defined( 'INF_THEME_NAME' ) ) {
      $this->theme_name = INF_THEME_NAME;
    } else {
      $this->theme_name = 'inf_theme';
    }

    $this->load_dependencies();
    $this->define_admin_hooks();
    $this->define_theme_hooks();
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
    $plugin_i18n = new Internationalization( $this->get_theme_info() );

    $this->loader->add_action( 'after_setup_theme', $plugin_i18n, 'load_theme_textdomain' );
  }

  /**
   * Register all of the hooks related to the admin area functionality.
   *
   * @since 2.0.0
   */
  private function define_admin_hooks() {
    $admin       = new Admin\Admin( $this->get_theme_info() );
    $login       = new Admin\Login( $this->get_theme_info() );
    $editor      = new Admin\Editor( $this->get_theme_info() );
    $admin_menus = new Admin\Admin_Menus( $this->get_theme_info() );
    $users       = new Admin\Users( $this->get_theme_info() );
    $widgets     = new Admin\Widgets( $this->get_theme_info() );
    $menu        = new Menu\Menu( $this->get_theme_info() );
    $media       = new Admin\Media( $this->get_theme_info() );

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
    $theme           = new Theme\Theme( $this->get_theme_info() );
    $legacy_browsers = new Theme\Legacy_Browsers( $this->get_theme_info() );
    $gallery         = new Utils\Gallery( $this->get_theme_info() );
    $general         = new Theme\General( $this->get_theme_info() );
    $pagination      = new Theme\Pagination( $this->get_theme_info() );

    // Enque styles and scripts.
    $this->loader->add_action( 'wp_enqueue_scripts', $theme, 'enqueue_styles' );
    $this->loader->add_action( 'wp_enqueue_scripts', $theme, 'enqueue_scripts' );

    // Remove inline gallery css.
    $this->loader->add_filter( 'use_default_gallery_style', $theme, '__return_false' );

    // Legacy Browsers.
    $this->loader->add_action( 'template_redirect', $legacy_browsers, 'redirect_to_legacy_browsers_page' );

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
   * The reference to the class that orchestrates the hooks.
   *
   * @return Loader Orchestrates the hooks.
   *
   * @since 2.0.0
   */
  public function get_loader() {
    return $this->loader;
  }

  /**
   * The name used to uniquely identify it within the context of
   * WordPress and to define internationalization functionality.
   *
   * @return string Theme name.
   *
   * @since 2.0.0
   */
  public function get_theme_name() {
    return $this->theme_name;
  }

  /**
   * Retrieve the version number.
   *
   * @return string Theme version number.
   *
   * @since 2.0.0
   */
  public function get_theme_version() {
    return $this->theme_version;
  }

  /**
   * Retrieve the theme info array.
   *
   * @return array Theme info array.
   *
   * @since 2.0.0
   */
  public function get_theme_info() {
    return array(
        'theme_name'    => $this->theme_name,
        'theme_version' => $this->theme_version,
    );
  }
}
