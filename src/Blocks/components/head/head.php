<?php

/**
 * Template for the document head section.
 *
 * @package EightshiftBoilerplate
 */

use EightshiftBoilerplateVendor\EightshiftLibs\Helpers\Helpers;

$headFavicon = Helpers::checkAttr('headFavicon', $attributes, $manifest);
$headCharset = Helpers::checkAttr('headCharset', $attributes, $manifest);
$headName = Helpers::checkAttr('headName', $attributes, $manifest);

?>

<?php if (isset($headCharset)) { ?>
  <meta charset="<?php echo esc_attr($headCharset); ?>" />
<?php } ?>

<!-- Responsive -->
<meta content="width=device-width, initial-scale=1.0" name="viewport">

<!-- Remove IE's ability to use compatibility mode -->
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<!-- Disable phone formatting on Safari -->
<meta name="format-detection" content="telephone=no">

<!-- Speed up fetching of external assets -->
<link rel="dns-prefetch" href="//fonts.googleapis.com">
<link rel="dns-prefetch" href="//ajax.googleapis.com">
<link rel="dns-prefetch" href="//www.google-analytics.com">

<!-- Windows (Phone) Meta -->
<?php if ($headName ?? '') { ?>
  <meta name="application-name" content="<?php echo esc_attr($headName); ?>" />
<?php } ?>

<!-- Apple -->
<?php if ($headName ?? '') { ?>
  <meta name="apple-mobile-web-app-title" content="<?php echo esc_attr($headName); ?>">
<?php } ?>

<meta name="apple-mobile-web-app-capable" content="yes">

<?php if ($headFavicon ?? '') { ?>
  <link rel="apple-touch-startup-image" href="<?php echo esc_url($headFavicon); ?>">
  <link rel="shortcut icon" href="<?php echo esc_url($headFavicon); ?>" />
<?php } ?>
