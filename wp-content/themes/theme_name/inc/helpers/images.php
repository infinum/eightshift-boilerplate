<?php
/**
 * Functions related to images
 *
 * @package theme_name
 */

if ( ! function_exists( 'inf_get_post_image' ) ) {
	/**
	 * Get post image
	 *
	 * If found return if not return no image placeholder.
	 *
	 * @param  string|array $size  Image size. Accepts any valid image size, or an array of width and height values in pixels.
	 * @param  integer      $post_id   Post ID.
	 * @return array        Array with image settings.
	 */
	function inf_get_post_image( $size, $post_id = null ) {
		global $post;

		if ( ! $post_id ) {
			$post_id = $post->ID;
		}

		if ( has_post_thumbnail( $post_id ) ) {
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );
			$image_src = $image[0];
			$image_width = $image[1];
			$image_height = $image[2];
		} else {
			$image = IMAGE_URL . 'no-image-' . $size . '.jpg';
			$image_src = $image;
			$image_width = 1440;
			$image_height = 700;
		}

		return [
		'image' => esc_url( $image_src ),
		'width' => $image_width,
		'height' => $image_height,
		];
	}
}// End if().

if ( ! function_exists( 'inf_get_image_from_array' ) ) {
	/**
	 * Get image from image array
	 * If found return if not return no image placeholder
	 *
	 * @param [type] $size Image size from Image object.
	 * @param [type] $image_array WP image array.
	 */
	function inf_get_image_from_array( $size, $image_array ) {
		if ( ! empty( $image_array ) ) {
			$img = $image_array['sizes'];
			$src = $img[ $size ];
		} else {
			$src = IMAGE_URL . 'no-image-' . $size . '.jpg';
		}

		return [
		'image' => esc_url( $src ),
		];
	}
}
