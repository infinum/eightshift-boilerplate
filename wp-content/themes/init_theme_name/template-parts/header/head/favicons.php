<?php
/**
 * Use default or cusotm Favicons
 *
 * @package Inf_Theme\Template_Parts\Header\Head
 */

$favicon = array(
    '310x150' => INF_IMAGE_URL . '310x150.png',
    '310'     => INF_IMAGE_URL . '310.png',
    '192'     => INF_IMAGE_URL . '192.png',
    '180'     => INF_IMAGE_URL . '180.png',
    '152'     => INF_IMAGE_URL . '152.png',
    '150'     => INF_IMAGE_URL . '150.png',
    '144'     => INF_IMAGE_URL . '144.png',
    '114'     => INF_IMAGE_URL . '114.png',
    '72'      => INF_IMAGE_URL . '72.png',
    '70'      => INF_IMAGE_URL . '70.png',
    '52'      => INF_IMAGE_URL . '52.png',
);

?>

<!-- General -->
<link rel="shortcut icon" href="<?php echo esc_url( $favicon['192'] ); ?>" />

<!-- Chrome -->
<link rel="icon" sizes="192x192" href="<?php echo esc_url( $favicon['192'] ); ?>">

<!-- IOS -->
<link rel="apple-touch-icon-precomposed" sizes="180x180" href="<?php echo esc_url( $favicon['180'] ); ?>">

<link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo esc_url( $favicon['152'] ); ?>">

<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo esc_url( $favicon['114'] ); ?>">

<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo esc_url( $favicon['144'] ); ?>">

<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo esc_url( $favicon['72'] ); ?>">

<link rel="apple-touch-icon-precomposed" sizes="52x52" href="<?php echo esc_url( $favicon['52'] ); ?>">


<!-- Win phone -->
<meta name="msapplication-square70x70logo" content="<?php echo esc_url( $favicon['70'] ); ?>"/>

<meta name="msapplication-square150x150logo" content="<?php echo esc_url( $favicon['150'] ); ?>"/>

<meta name="msapplication-wide310x150logo" content="<?php echo esc_url( $favicon['310x150'] ); ?>"/>

<meta name="msapplication-square310x310logo" content="<?php echo esc_url( $favicon['310'] ); ?>"/>
