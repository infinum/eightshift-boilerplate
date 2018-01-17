<?php
/**
 * The parse functionality of the plugin.
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
class Json_WP_Post_Parser_Parse {

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
   * @param      string $plugin_name       The name of this plugin.
   * @param      string $version    The version of this plugin.
   */
  public function __construct( $plugin_name, $version ) {
      $this->plugin_name = $plugin_name;
      $this->version = $version;
  }

  /**
   * Parse post content and store it in the custom table
   *
   * @param int    $post_id Post ID.
   * @param object $post    Post object.
   * @param bool   $update  Whether this is an existing post being updated or not.
   * @since 1.0.0
   */
  public function update_post_json_content( $post_id, $post, $update ) {
    if ( $update ) { // Trigger only on post save or update, not on new post.
      global $wpdb;

      // Remove newlines. If we don't do this, json has tons of empty texts that notify the newlines.
      $post_content_lines = str_replace( array( "\r\n", "\r" ), "\n", apply_filters( 'the_content', $post->post_content ) );

      $lines = explode( "\n", $post_content_lines );
      $new_lines = array();

      foreach ( $lines as $i => $line ) {
        if ( ! empty( $line ) ) {
          $new_lines[] = trim( $line );
        }
      }

      $post_content = implode( $new_lines );

      if ( ! empty( $post_content ) ) {
        // Remove hidden characters from the post content.
        $new_post_content = preg_replace( '/\s\s/', ' ', preg_replace( '/[^\x00-\x7F]/', ' ', $post_content ) );
        $dom_json = $this->parse_content_to_json( $new_post_content );
        $wpdb->query( $wpdb->prepare( "UPDATE $wpdb->posts SET post_content_json = %s WHERE ID = %d", $dom_json, $post_id ) );
      }
    }
  }

  /**
   * Parse post content and return json string
   *
   * DOMDocument uses HTML4 to parse the DOM, so HTML5 tags will throw out errors.
   * Currently the parser will report errors for such tags but the method for
   * loading HTML will work fine, and the content will be parsed.
   *
   * @param string $content Post content HTML string.
   * @return string         JSON string.
   * @since 1.0.0
   */
  public function parse_content_to_json( $content ) {
      $post_dom = new \DOMDocument();
      libxml_use_internal_errors( true );
      $post_dom->loadHTML( $content );
      libxml_use_internal_errors( false );
      libxml_clear_errors();

      return wp_json_encode( $this->element_to_obj( $post_dom->documentElement ) );
  }

  /**
   * Traverse through post html to create a post JSON
   *
   * @param  object $element Post dom element.
   * @return string          Post as JSON.
   */
  public function element_to_obj( $element ) {
    // Document element doesn't like comments so we treat them separately.
    if ( $element->nodeType === XML_ELEMENT_NODE && $element->nodeName !== '#comment' ) {
      // Get all the html object tag names. E.g. div, h2, code etc.
      $node = $this->check_node_type( $element->nodeType );

      $obj = array(
          'node' => $node,
          'tag'  => $element->tagName,
      );

      // Check the attributes, if there are any.
      foreach ( $element->attributes as $attribute ) {
        $obj['attr'][ $attribute->name ] = $attribute->value;
      }

      foreach ( $element->childNodes as $sub_element ) { // Child nodes.
        $obj['child'][] = $this->element_to_obj( $sub_element );
      }
    } elseif ( $element->nodeType === XML_TEXT_NODE ) {
      $obj['node'] = 'text';
      $obj['text'] = $element->wholeText;
    } else {
      $obj['tag']  = 'html-comment-tag';
      $obj['html'] = $element->nodeValue;
    }

    return $obj;
  }

  /**
   * Check node type
   *
   * @param  int $node_type Node type number.
   * @return string         Type of node.
   */
  public function check_node_type( $node_type ) {
    switch ( $node_type ) {
      case XML_ELEMENT_NODE:
        $node_type = 'element';
            break;
      case XML_TEXT_NODE:
        $node_type = 'text';
            break;
      default:
        $node_type = 'element';
            break;
    }

    return $node_type;
  }
}
