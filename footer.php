<?php
/**
 * Display footer
 *
 * @package Eightshift_Boilerplate\Layout\Footer
 *
 * @since 1.0.0
 */

use Eightshift_Libs\Helpers\Components;
?>

</main>

<?php
echo wp_kses_post( Components::render( 'footer', [
  'leftComponent' => Components::render( 'copyright' ),
  'centerComponent' => '',
  'rightComponent' => Components::render( 'menu', [ 'variation' => 'horizontal' ] ),
] ) );
?>

<?php wp_footer(); ?>
</body>
</html>
