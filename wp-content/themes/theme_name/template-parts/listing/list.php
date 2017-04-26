<?php
  $image = get_post_image('listing');
?>

<article class="article-list">
  <div class="article-list__container">
    <div class="article-list__image">
      <a class="article-list__image-link" href="<?php the_permalink(); ?>" style="background-image:url(<?php echo $image['image']; ?>)"></a>
    </div>
    <div class="article-list__content">
      <header>
        <h2 class="article-list__heading">
          <a class="article-list__heading-link" href="<?php the_permalink(); ?>">
            <?php the_title(); ?>
          </a>
        </h2>
      </header>

      <div class="article-list__excerpt">
        <?php the_excerpt(); ?>
      </div>
    </div>
  </div>

  <?php include(locate_template('template-parts/parts/google-rich-snippets.php')); ?>
  
</article>