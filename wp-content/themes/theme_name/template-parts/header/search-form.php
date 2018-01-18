<?php
/**
 * Header Serch form
 *
 * @package init_theme_name
 */

?>

<form role="search" method="get" class="header__search-form js-header-serach-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" >
  <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" class="header__search-form-input js-search-form-input input" placeholder="<?php esc_html_e( 'Type in search', 'init_theme_name' ); ?>" />
  <input type="hidden" name="post_type" value="any" />
</form>
