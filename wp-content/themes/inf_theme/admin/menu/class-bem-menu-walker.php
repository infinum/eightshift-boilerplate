<?php
/**
 * Custom Menu Walker specific functionality.
 * It provides BEM classes to menues.
 *
 * @since   2.0.0
 * @package Inf_Theme\Admin\Menu
 */

namespace Inf_Theme\Admin\Menu;

/**
 * Bem Menu Walker
 * Inserts some BEM naming sensibility into WordPress menus
 *
 * @package inf_theme
 */
class Bem_Menu_Walker extends \Walker_Nav_Menu {

  /**
   * Constructor function
   *
   * @param array $css_class_prefix load menu prefixes for class.
   *
   * @since 2.0.0
   */
  public function __construct( $css_class_prefix ) {

    $this->css_class_prefix = $css_class_prefix;

    // Define menu item names appropriately.
    $this->item_css_class_suffixes = array(
        'item'                    => '__item',
        'parent_item'             => '__item--parent',
        'active_item'             => '__item--active',
        'parent_of_active_item'   => '__item--parent--active',
        'ancestor_of_active_item' => '__item--ancestor--active',
        'sub_menu'                => '__sub-menu',
        'sub_menu_item'           => '__sub-menu__item',
        'link'                    => '__link',
    );
  }

  /**
   * Dispaly element for wlaker
   *
   * @param array   $element element.
   * @param array   $children_elements children_elements.
   * @param array   $max_depth max_depth.
   * @param integer $depth depth.
   * @param array   $args args.
   * @param array   $output output.
   * @return element
   *
   * @since 2.0.0
   */
  public function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {

    $id_field = $this->db_fields['id'];

    if ( is_object( $args[0] ) ) {
      $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
    }

    return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );

  }

  /**
   * Start level
   *
   * @param array   $output output.
   * @param integer $depth depth.
   * @param array   $args args.
   * @return void
   *
   * @since 2.0.0
   */
  public function start_lvl( &$output, $depth = 1, $args = array() ) {

    $real_depth = $depth + 1;

    $indent = str_repeat( "\t", $real_depth );

    $prefix = $this->css_class_prefix;
    $suffix = $this->item_css_class_suffixes;

    $classes = array(
        $prefix . $suffix['sub_menu'],
        $prefix . $suffix['sub_menu'] . '--' . $real_depth,
    );

    $class_names = implode( ' ', $classes );

    // Add a ul wrapper to sub nav.
    $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
  }

  /**
   * Add main/sub classes to li's and links.
   *
   * @param array   $output output.
   * @param array   $item item.
   * @param integer $depth depth.
   * @param array   $args args.
   * @param integer $id id.
   * @return void
   *
   * @since 2.0.0
   */
  public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

    global $wp_query;

    $indent = ( $depth > 0 ? str_repeat( '    ', $depth ) : '' ); // code indent.

    $prefix = $this->css_class_prefix;
    $suffix = $this->item_css_class_suffixes;

    $parent_class = $prefix . $suffix['parent_item'];

    if ( ! empty( $item->classes ) ) {
      $user_classes = array();
      foreach ( $item->classes as $class => $class_name ) {
        if ( strpos( $class_name, 'js-' ) !== false ) {
          $user_classes[] = $class_name;
        } else {
          $user_classes[] = $prefix . '__item--' . $class_name;
        }
      }
    }

    // Item classes.
    $item_classes = array(
        'item_class'            => 0 === $depth ? $prefix . $suffix['item'] : '',
        'parent_class'          => $args->has_children ? $parent_class : '',
        'active_page_class'     => in_array( 'current-menu-item', $item->classes, true ) ? $prefix . $suffix['active_item'] : '',
        'active_parent_class'   => in_array( 'current-menu-parent', $item->classes, true ) ? $prefix . $suffix['parent_of_active_item'] : '',
        'active_ancestor_class' => in_array( 'current-page-ancestor', $item->classes, true ) ? $prefix . $suffix['ancestor_of_active_item'] : '',
        'depth_class'           => $depth >= 1 ? $prefix . $suffix['sub_menu_item'] . ' ' . $prefix . $suffix['sub_menu'] . '--' . $depth . '__item' : '',
        'item_id_class'         => $prefix . '__item--' . $item->object_id,
        'user_class'            => ! empty( $user_classes ) ? implode( ' ', $user_classes ) : '',
    );

    // Convert array to string excluding any empty values.
    $class_string = implode( '  ', array_filter( $item_classes ) );

    // Add the classes to the wrapping <li>.
    $output .= $indent . '<li class="' . $class_string . '">';

    // Link classes.
    $link_classes = array(
        'item_link'   => 0 === $depth ? $prefix . $suffix['link'] : '',
        'depth_class' => $depth >= 1 ? $prefix . $suffix['sub_menu'] . $suffix['link'] . '  ' . $prefix . $suffix['sub_menu'] . '--' . $depth . $suffix['link'] : '',
    );

    $link_class_string = implode( '  ', array_filter( $link_classes ) );

    $link_class_output = 'class="' . $link_class_string . ' "';

    $link_text_classes = array(
        'item_link'   => 0 === $depth ? $prefix . $suffix['link'] . '-text' : '',
        'depth_class' => $depth >= 1 ? $prefix . $suffix['sub_menu'] . $suffix['link'] . '-text ' . $prefix . $suffix['sub_menu'] . '--' . $depth . $suffix['link'] . '-text' : '',
    );

    $link_text_class_string = implode( '  ', array_filter( $link_text_classes ) );
    $link_text_class_output = 'class="' . $link_text_class_string . '"';

    // link attributes.
    $attributes  = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
    $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
    $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
    $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';

    // Creatre link markup.
    $item_output  = $args->before;
    $item_output .= '<a' . $attributes . ' ' . $link_class_output . '><span ' . $link_text_class_output . '>';
    $item_output .= $args->link_before;
    $item_output .= apply_filters( 'the_title', $item->title, $item->ID );
    $item_output .= $args->link_after;
    $item_output .= $args->after;
    $item_output .= '</span></a>';

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }

}
