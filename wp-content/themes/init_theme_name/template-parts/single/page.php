<?php
/**
 * Single Page
 *
 * @package Inf_Theme\Template_Parts\Single
 */

use Inf_Theme\Theme\Utils as Utils;
$images = new Utils\Images();
$image  = $images->get_post_image( 'full_width' );
?>

<!-- Single Content Section -->
<section class="single" id="<?php echo esc_attr( $post->ID ); ?>">
  <div class="single__image" style="background-image: url('<?php echo esc_url( $image['image'] ); ?>');"></div>
  <header>
    <h1 class="single__title">
      <?php the_title(); ?>
    </h1>
  </header>
  <div class="single__content content-style content-media-style">
    <?php the_content(); ?>
  </div>
  <?php require locate_template( 'template-parts/parts/google-rich-snippets.php' ); ?>
</section>
