<?php
/**
 * Use default or cusotm Favicons
 *
 * @package theme_name
 */

 $favicon_url = IMAGE_URL;
 $favicon_path = get_template_directory() . '/skin/public/images/';

 $favicon_192 = '192.png';
 $favicon_180 = '180.png';
 $favicon_152 = '152.png';
 $favicon_114 = '114.png';
 $favicon_144 = '144.png';
 $favicon_72 = '72.png';
 $favicon_52 = '52.png';
 $favicon_70 = '70.png';
 $favicon_150 = '150.png';
 $favicon_310x150 = '310x150.png';
 $favicon_310 = '310.png';

?>

<?php if ( file_exists( $favicon_path . $favicon_192 ) ) { ?>
  <!-- General -->
  <link rel="shortcut icon" href="<?php echo esc_url( $favicon_url . $favicon_192 );  ?>" />

  <!-- Chrome -->
  <link rel="icon" sizes="192x192" href="<?php echo esc_url( $favicon_url . $favicon_192 );  ?>">
<?php } ?>

<!-- IOS -->
<?php if ( file_exists( $favicon_path . $favicon_180 ) ) { ?>
  <link rel="apple-touch-icon-precomposed" sizes="180x180" href="<?php echo esc_url( $favicon_url . $favicon_180 ); ?>">
<?php } ?>

<?php if ( file_exists( $favicon_path . $favicon_152 ) ) { ?>
  <link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo esc_url( $favicon_url . $favicon_152 ); ?>">
<?php } ?>

<?php if ( file_exists( $favicon_path . $favicon_114 ) ) { ?>
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo esc_url( $favicon_url . $favicon_114 ); ?>">
<?php } ?>

<?php if ( file_exists( $favicon_path . $favicon_144 ) ) { ?>
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo esc_url( $favicon_url . $favicon_144 ); ?>">
<?php } ?>

<?php if ( file_exists( $favicon_path . $favicon_72 ) ) { ?>
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo esc_url( $favicon_url . $favicon_72 ); ?>">
<?php } ?>

<?php if ( file_exists( $favicon_path . $favicon_52 ) ) { ?>
  <link rel="apple-touch-icon-precomposed" sizes="52x52" href="<?php echo esc_url( $favicon_url . $favicon_52 ); ?>">
<?php } ?>


<!-- Win phone -->
<?php if ( file_exists( $favicon_path . $favicon_70 ) ) { ?>
  <meta name="msapplication-square70x70logo" content="<?php echo esc_url( $favicon_url . $favicon_70 ); ?>"/>
<?php } ?>

<?php if ( file_exists( $favicon_path . $favicon_150 ) ) { ?>
  <meta name="msapplication-square150x150logo" content="<?php echo esc_url( $favicon_url . $favicon_150 ); ?>"/>
<?php } ?>

<?php if ( file_exists( $favicon_path . $favicon_310x150 ) ) { ?>
  <meta name="msapplication-wide310x150logo" content="<?php echo esc_url( $favicon_url . $favicon_310x150 ); ?>"/>
<?php } ?>

<?php if ( file_exists( $favicon_path . $favicon_310 ) ) { ?>
  <meta name="msapplication-square310x310logo" content="<?php echo esc_url( $favicon_url . $favicon_310 ); ?>"/>
<?php } ?>
