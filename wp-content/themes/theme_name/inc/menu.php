<?php
/**
 * Require Menu Walker for BEM
 *
 * @package theme_name
 */

require get_parent_theme_file_path( '/inc/menu/class-walker-texas-ranger.php' );

/**
 * Set menues
 *
 * @package theme_name
 */

add_action( 'init', 'inf_register_menus' );

if ( ! function_exists( 'inf_register_menus' ) ) {
	/**
	 * Register Menu positions
	 */
	function inf_register_menus() {
		register_nav_menus(
			array(
			'header_main_nav' => esc_html__( 'Menu', 'theme_name' ),
			)
		);
	}
}

/**
 * Bem_menu returns an instance of the Walker_Texas_Ranger class with the following arguments
 *
 * @param  string     $location This must be the same as what is set in wp-admin/settings/menus for menu location.
 * @param  string     $css_class_prefix This string will prefix all of the menu's classes, BEM syntax friendly.
 * @param  arr/string $css_class_modifiers Provide either a string or array of values to apply extra classes to the <ul> but not the <li's>.
 * @return [type]
 */
function bem_menu( $location = 'main_menu', $css_class_prefix = 'main-menu', $css_class_modifiers = null ) {

	// Check to see if any css modifiers were supplied.
	if ( $css_class_modifiers ) {

		if ( is_array( $css_class_modifiers ) ) {
			$modifiers = implode( ' ', $css_class_modifiers );
		} elseif ( is_string( $css_class_modifiers ) ) {
			$modifiers = $css_class_modifiers;
		}
	} else {
		$modifiers = '';
	}

	$args = array(
		'theme_location'    => $location,
		'container'         => false,
		'items_wrap'        => '<ul class="' . $css_class_prefix . ' ' . $modifiers . '">%3$s</ul>',
		'walker'            => new Walker_Texas_Ranger( $css_class_prefix, true ),
	);

	if ( has_nav_menu( $location ) ) {
		return wp_nav_menu( $args );
	}
}

