<?php
/**
 * Google Rich Snippets
 *
 * @package theme_name
 */

?>

<!-- Google Rich Snippets -->
<script type="application/ld+json">
	{
		"@context": "http://schema.org",
		"@type": "NewsArticle",
		"mainEntityOfPage": {
			"@type": "WebPage",
			"@id": "https://google.com/article"
		},
		"headline": "<?php the_title() ?>",
	"image": {
		"@type": "ImageObject",
		"url": "<?php echo esc_html( $image['image'] ); ?>",
		"height": <?php echo esc_html( $image['height'] ); ?>,
		"width": <?php echo esc_html( $image['width'] ); ?>
	},
	"datePublished": "<?php echo esc_html( get_the_time( 'c' ) ); ?>",
	"dateModified": "<?php echo esc_html( date( 'c', strtotime( $post->post_modified ) ) ); ?>",
	"author": {
		"@type": "Person",
		"name": "<?php echo get_the_author() ?>"
	},
		"publisher": {
		"@type": "Organization",
		"name": "<?php echo esc_html( get_bloginfo( 'name' ) ); ?>",
		"logo": {
		"@type": "ImageObject",
		"url": "<?php echo esc_url( IMAGE_URL . 'meta-google.png' ); ?>",
		"width": 220,
		"height": 60
		}
	},
	"description": "<?php echo esc_html( strip_tags( get_the_excerpt() ) ) ?>"
	}
</script>
