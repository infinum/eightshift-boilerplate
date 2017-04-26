<form role="search" method="get" class="header__search-form js-header-serach-form" action="<?php echo home_url( '/' ); ?>" >
  <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" class="header__search-form-input js-search-form-input" placeholder="<?php echo __('Type in search', 'Theme_Name'); ?>" />
  <input type="hidden" name="post_type" value="any" />
</form>