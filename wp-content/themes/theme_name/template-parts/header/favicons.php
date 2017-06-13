<?php
/**
 * Use default or cusotm Favicons
 */

 $favicon_url = get_template_directory_uri() . '/skin/public/images/favicons/';
?>

<!-- General -->
<link rel="shortcut icon" href="<?php echo $favicon_url . '192.png';  ?>" />

<!-- Chrome -->
<link rel="icon" sizes="192x192" href="<?php echo $favicon_url . '192.png';  ?>">

<!-- IOS -->
<link rel="apple-touch-icon-precomposed" sizes="180x180" href="<?php echo $favicon_url . '180.png';  ?>">
<link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo $favicon_url . '152.png';  ?>">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $favicon_url . '114.png';  ?>">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $favicon_url . '72.png';  ?>">
<link rel="apple-touch-icon-precomposed" sizes="52x52" href="<?php echo $favicon_url . '52.png';  ?>">

<!-- Win phone -->
<meta name="msapplication-square70x70logo" content="<?php echo $favicon_url . '70.png';  ?>"/>
<meta name="msapplication-square150x150logo" content="<?php echo $favicon_url . '150.png';  ?>"/>
<meta name="msapplication-wide310x150logo" content="<?php echo $favicon_url . '310x150.png';  ?>"/>
<meta name="msapplication-square310x310logo" content="<?php echo $favicon_url . '310.png';  ?>"/>