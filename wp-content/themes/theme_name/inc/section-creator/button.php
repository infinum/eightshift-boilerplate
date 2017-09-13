<?php
/**
 * Button for section creator
 *
 * @package theme_name
 */

if ( ! function_exists( 'inf_sc_get_button' ) ) {

	  /**
	   * Section Buttons
	   *
	   * @param object $key section object.
	   * @param object $array section object.
	   * @return array
	   */
	function inf_sc_get_button( $key, $array ) {
		$type = '';
		$title = '';
		$url = '';

		if ( ! empty( inf_get_array_value( $key, $array ) ) ) {
			$type = inf_get_array_value( 'type', $array[ $key ] );
			$title = inf_get_array_value( 'title', $array[ $key ] );
			$url_original = inf_get_array_value( 'url', $array[ $key ] );
		}

		if ( 'internal' === $type ) {
			$url = get_the_permalink( $url_original );

			if ( false === $url ) {
				$url = $url_original;
			}
		} elseif ( 'external' === $type ) {
			$url = $url_original;
		}

		return array(
		'type' => $type,
		'title' => $title,
		'url' => $url,
		);
	}
}// End if().
