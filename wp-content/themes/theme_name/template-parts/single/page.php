<?php
	$image = get_post_image( 'full_width' );

	$custom_fields = get_fields();

?>

<!-- Single Content Section -->
<div class="single" id="<?php echo $post->ID; ?>">

	<div class="single__image" style="background-image: url('<?php echo $image['image']; ?>');"></div>

	<header>
	<h1 class="single__title">
		<?php the_title(); ?>
	</h1>
	</header>

	<div class="single__content content-style content-media-style content-container-media-style">
	<?php the_content(); ?>
	</div>

	<?php include( locate_template( 'template-parts/parts/google-rich-snippets.php' ) ); ?>
</div>
