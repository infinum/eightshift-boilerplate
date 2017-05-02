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
	  "url": "<?php echo esc_url( $image['image'] ); ?>",
	  "height": <?php echo esc_attr( $image['height'] ); ?>,
	  "width": <?php echo esc_attr( $image['width'] ); ?>
	},
	"datePublished": "<?php echo get_the_time( 'c' ); ?>",
	"dateModified": "<?php echo date( 'c', strtotime( $post->post_modified ) ); ?>",
	"author": {
	  "@type": "Person",
	  "name": "<?php echo get_the_author() ?>"
	},
	  "publisher": {
	  "@type": "Organization",
	  "name": "<?php echo get_bloginfo( 'name' ); ?>",
	  "logo": {
		"@type": "ImageObject",
		"url": "<?php echo get_template_directory_uri() . '/skin/public/images/meta-google.png'; ?>",
		"width": 220,
		"height": 60
	  }
	},
	"description": "<?php echo strip_tags( get_the_excerpt() ) ?>"
	}
</script>
