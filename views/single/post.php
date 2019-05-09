<?php
/**
 * Single Post
 *
 * @package Inf_Theme\Template_Parts\Single
 */

?>

<!-- Single Content Section -->
<section class="single" id="<?php echo esc_attr( $post->ID ); ?>">
  <header>
    <h1 class="single__title">
      <?php the_title(); ?>
    </h1>
  </header>
  <div class="single__content content-style content-media-style">
    <?php the_content(); ?>
  </div>
  <?php require locate_template( 'views/parts/google-rich-snippets.php' ); ?>
</section>
