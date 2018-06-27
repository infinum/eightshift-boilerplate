<?php
/**
 * Grid Article
 *
 * @package Inf_Theme\Template_Parts\Listing\Articles
 */

use Inf_Theme\Theme\Utils\Utils;
$images = new Images();
$image  = $images->get_post_image( 'full_width' );
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
  <?php require locate_template( 'template-parts/parts/google-rich-snippets.php' ); ?>
</article>
