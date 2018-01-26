<?php
/**
 * Use default or cusotm Favicons
 *
 * @package init_theme_name
 */

$favicon_url = INF_IMAGE_URL;
$favicon_path = get_template_directory() . '/skin/public/images/';

$favicon = array(
    '310x150' => $favicon_url . '310x150.png',
    '310'     => $favicon_url . '310.png',
    '192'     => $favicon_url . '192.png',
    '180'     => $favicon_url . '180.png',
    '152'     => $favicon_url . '152.png',
    '150'     => $favicon_url . '150.png',
    '144'     => $favicon_url . '144.png',
    '114'     => $favicon_url . '114.png',
    '72'      => $favicon_url . '72.png',
    '70'      => $favicon_url . '70.png',
    '52'      => $favicon_url . '52.png',
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
