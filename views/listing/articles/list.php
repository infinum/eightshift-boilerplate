<?php
/**
 * List Simple Article
 *
 * @package Inf_Theme\Template_Parts\Listing\Articles
 */

?>
<article class="article-list">
  <div class="article-list__container">
    <div class="article-list__content">
      <header>
        <h2 class="article-list__heading">
          <a class="article-list__heading-link" href="<?php the_permalink(); ?>">
          <?php esc_html( the_title() ); ?>
          </a>
        </h2>
      </header>
      <div class="article-list__excerpt">
        <?php the_excerpt(); ?>
      </div>
    </div>
  </div>
  <?php require locate_template( 'views/parts/google-rich-snippets.php' ); ?>
</article>
