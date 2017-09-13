<?php
/**
 * Except functions
 *
 * @package theme_name
 */

if ( ! function_exists( 'inf_get_excerpt' ) ) {
	/**
	 * Custom Excerpt to set word limit
	 *
	 * @param integer $limit  Number of characters to trim.
	 * @param string  $source From where to chose the source, excerpt or content.
	 * @param string  $only_source From where to chose the source, excerpt or content.
	 * @return string Trimmed excerpt.
	 */
	function inf_get_excerpt( $limit = null, $source = null, $only_source = false ) {

		$original_excerpt = get_the_excerpt();
		$original_content = get_the_content();

		if ( ! empty( $original_excerpt ) ) {
			$excerpt = $original_excerpt;
		} else {
			$excerpt = $original_content;
		}

		if ( ! empty( $source ) ) {
			$excerpt = $source;
		} elseif ( $only_source === true ) {
			$excerpt = '';
		}

		if ( empty( $excerpt ) ) {
			return false;
		}

		if ( empty( $limit ) ) {
			$limit = 140;
		}

		$excerpt = preg_replace( ' (\[.*?\])', '', $excerpt );
		$excerpt = strip_shortcodes( $excerpt );
		$excerpt = strip_tags( $excerpt );
		$excerpt = substr( $excerpt, 0, $limit );
		$excerpt = substr( $excerpt, 0, strripos( $excerpt, ' ' ) );
		$excerpt = trim( preg_replace( '/\s+/', ' ', $excerpt ) );
		$excerpt = '<p>' . $excerpt . '...</p>';
		return $excerpt;
	}
}// End if().
