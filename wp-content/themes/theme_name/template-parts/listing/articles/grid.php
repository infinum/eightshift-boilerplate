<?php
/**
 * Grid Article
 *
 * @package theme_name
 */

?>

<?php
  $image = inf_get_post_image( 'listing' );
  // TO DO: Remove inline styling, and add it to dynamic-css.php file.
?>
<article class="article-grid">
  <div class="article-grid__container">
  <a class="article-grid__image" href="<?php the_permalink(); ?>" style="background-image:url(<?php echo esc_url( $image['image'] ); ?>)"></a>
	<div class="article-grid__content">
	  <header>
		<h2 class="article-grid__heading">
		  <a class="article-grid__heading-link" href="<?php the_permalink(); ?>">
			<?php esc_html( the_title() ); ?>
		  </a>
		</h2>
	  </header>
	  <div class="article-grid__excerpt">
		<?php the_excerpt(); ?>
	  </div>
	</div>
  </div>
	<?php include( locate_template( 'template-parts/parts/google-rich-snippets.php' ) ); ?>
</article>
