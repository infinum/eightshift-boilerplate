<?php
/**
 * Footer
 *
 * @package Inf_Theme\Template_Parts\Footer
 */

/**
 * Include cookies template
 */
require locate_template( 'template-parts/parts/cookies-notification.php' ); ?>

<a href="#html, body" class="scroll-to-top js-scroll-to-top">
  <?php esc_html_e( 'To top', 'init_theme_name' ); ?>
</a>
<?php wp_footer(); ?>
</body>
</html>
