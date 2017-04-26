<!-- Favicons -->
<?php
  $favicon    = get_field('favicon', 'option');
  $favicon144 = get_field('favicon_apple_144x144', 'option');
  $favicon114 = get_field('favicon_apple_114x114', 'option');
  $favicon72  = get_field('favicon_apple_72x72', 'option');
  $favicon52  = get_field('favicon_apple_52x52', 'option');
?>

<?php if(!empty($favicon)) { ?>
  <link rel="shortcut icon" href="<?php echo $favicon; ?>" />
<?php } else { ?>
  <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/skin/public/images/favicon.ico" />
<?php } ?>

<?php if(!empty($favicon144)) { ?>
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $favicon144; ?>">
<?php } ?>

<?php if(!empty($favicon114)) { ?>
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $favicon114; ?>">
<?php } ?>

<?php if(!empty($favicon72)) { ?>
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $favicon72; ?>">
<?php } ?>

<?php if(!empty($favicon52)) { ?>
  <link rel="apple-touch-icon-precomposed" sizes="52x52" href="<?php echo $favicon52; ?>">
<?php } ?>