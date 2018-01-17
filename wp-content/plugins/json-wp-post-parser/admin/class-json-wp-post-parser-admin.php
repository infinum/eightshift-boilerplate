<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://infinum.co/careers
 * @since      1.0.0
 *
 * @package    Json_WP_Post_Parser\Admin
 */

namespace Json_WP_Post_Parser\Admin;

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Json_WP_Post_Parser\Admin
 * @author     Infinum <info@infinum.co>
 */
class Json_WP_Post_Parser_Admin {

  /**
   * The ID of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      string    $plugin_name    The ID of this plugin.
   */
  private $plugin_name;

  /**
   * The version of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      string    $version    The current version of this plugin.
   */
  private $version;

  /**
   * Initialize the class and set its properties.
   *
   * @since    1.0.0
   * @param    string $plugin_name  The name of this plugin.
   * @param    string $version      The version of this plugin.
   */
  public function __construct( $plugin_name, $version ) {
      $this->plugin_name = $plugin_name;
      $this->version = $version;
  }

  /**
   * Add page that will display the button for resave action
   *
   * @since 1.0.0
   */
  public function add_posts_parse_page() {
    add_options_page(
      esc_html__( 'Parse posts', 'json-wp-post-parser' ),
      esc_html__( 'Parse posts', 'json-wp-post-parser' ),
      'manage_options',
      'json_parser_posts',
      array( $this, 'render_parse_posts_page' )
    );
  }

  /**
   * Page that is used as a placeholder to show processed posts.
   *
   * @since 1.0.0
   */
  public function render_parse_posts_page() {
    $post_types = array( 'post', 'page' );

    if ( has_filter( 'json_wp_post_parser_add_post_types' ) ) {
      $post_types = apply_filters( 'json_wp_post_parser_add_post_types', $post_types );
    }

    $all_posts_args = array(
        'post_type'      => $post_types,
        'post_status'    => 'publish',
        'posts_per_page' => 5000,
    );

    $all_posts = new \WP_Query( $all_posts_args );
    $posts_array = [];

    if ( $all_posts->have_posts() ) {
      while ( $all_posts->have_posts() ) {
        $all_posts->the_post();
        $posts_array[] = get_the_ID();
      }
      wp_reset_postdata();
    }
    ?>
    <div class="wrap processed-posts">
      <h2><?php esc_html_e( 'Resave posts', 'json-wp-post-parser' ); ?></h2>
      <div class="processed-posts__process-info"><?php esc_html_e( 'This will resave all your existing posts and pages, including any custom post type you might have.', 'json-wp-post-parser' ); ?></div>
      <div class="processed-posts__process-info js-processing"></div>
      <div class="processed-posts js-processed-posts" data-posts="<?php echo wp_kses_post( wp_json_encode( $posts_array ) ); ?>"></div>
      <div class="processed-posts__process-finish js-finished"></div>
      <button class="button button-primary js-start-post-resave"><?php esc_html_e( 'Start resaving', 'json-wp-post-parser' ); ?></button>
    </div>
    <?php
  }

  /**
   * Register the JavaScript for the admin area.
   *
   * @param string $hook Page hook name.
   * @since 1.0.0
   */
  public function enqueue_scripts( $hook ) {
    if ( $hook === 'settings_page_json_parser_posts' ) {
      wp_enqueue_style( $this->plugin_name, plugins_url() . '/' . $this->plugin_name . '/assets/styles/application.css', array(), $this->version, 'all' );
      wp_enqueue_script( $this->plugin_name, plugins_url() . '/' . $this->plugin_name . '/assets/scripts/application.js', array(), $this->version, false );
      wp_localize_script( $this->plugin_name, 'wpApiSettings', array(
          'root'       => esc_url_raw( rest_url() ),
          'nonce'      => wp_create_nonce( 'wp_rest' ),
          'processing' => esc_html__( 'Processing...', 'json-wp-post-parser' ),
          'error'      => esc_html__( 'Error', 'json-wp-post-parser' ),
          'finished'   => esc_html__( 'Finshed', 'json-wp-post-parser' ),
      ) );
    }
  }
}
