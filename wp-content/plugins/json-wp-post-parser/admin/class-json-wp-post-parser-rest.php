<?php
/**
 * The REST specific functionality of the plugin.
 *
 * @link       https://infinum.co/careers
 * @since      1.0.0
 *
 * @package    Json_WP_Post_Parser\Admin
 */

namespace Json_WP_Post_Parser\Admin;

/**
 * The REST specific functionality of the plugin.
 *
 * Defines the rest routes and endpoints.
 *
 * @package    Json_WP_Post_Parser\Admin
 * @author     Infinum <info@infinum.co>
 */
class Json_WP_Post_Parser_Rest {

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
   * @param    string $plugin_name       The name of this plugin.
   * @param    string $version    The version of this plugin.
   */
  public function __construct( $plugin_name, $version ) {
    $this->plugin_name = $plugin_name;
    $this->version = $version;
  }

  /**
   * Add additional rest routes and meta fields
   *
   * @since 1.0.0
   */
  public function api_fields_init() {
    $post_types = array( 'post', 'page' );
    if ( has_filter( 'json_wp_post_parser_add_post_types' ) ) {
      $post_types = apply_filters( 'json_wp_post_parser_add_post_types', $post_types );
    }

    register_rest_field(
      $post_types,
      'post_content_json',
      array(
          'get_callback' => [ $this, 'get_post_json_content' ],
          'schema'       => null,
      )
    );

    register_rest_route(
      'posts-parse-json/v1/', '/run', array(
          'methods'  => 'POST',
          'callback' => [ $this, 'ajax_post_resave' ],
      )
    );
  }

  /**
   * Get json post content
   *
   * @param  object $object Post object array.
   * @return [type]         [description]
   */
  function get_post_json_content( $object ) {
    global $wpdb;
    $post_id = $object['id'];

    $json_content = $wpdb->get_col( $wpdb->prepare( "SELECT post_content_json FROM $wpdb->posts WHERE ID = %d", $post_id ) );

    return $json_content[0];
  }

  /**
   * Resave post callback
   *
   * @param \WP_REST_Request $request Full data about the request.
   * @since 1.0.0
   */
  public function ajax_post_resave( \WP_REST_Request $request ) {
    $headers = $request->get_headers();

    if ( ! wp_verify_nonce( $headers['x_wp_nonce'][0], 'wp_rest' ) ) {
      $message = esc_html__( 'Nonce error', 'json-wp-post-parser' );
      $error = new \WP_Error( '-1', $message );
      wp_send_json_error( $error );
    }

    if ( isset( $_POST['postID'] ) && $_POST['postID'] !== '' ) {
      $post_id = intval( $_POST['postID'] );

      wp_update_post( array(
          'ID' => $post_id,
      ) );

      wp_send_json( sprintf( esc_html__( '%1$s ID: #%2$d updated', 'json-wp-post-parser' ), ucfirst( get_post_type( $post_id ) ), intval( $post_id ) ) );
    }
  }
}
