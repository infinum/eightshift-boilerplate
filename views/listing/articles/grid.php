<?php
/**
 * Grid Article
 *
 * @package Inf_Theme\Template_Parts\Listing\Articles
 */

?>
<article class="article-grid">
  <div class="article-grid__container">
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
  <?php require locate_template( 'views/parts/google-rich-snippets.php' ); ?>
</article>
