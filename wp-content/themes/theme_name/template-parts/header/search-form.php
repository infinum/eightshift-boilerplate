<form role="search" method="get" class="header__search-form js-header-serach-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" >
  <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" class="header__search-form-input js-search-form-input" placeholder="<?php echo esc_html__( 'Type in search', 'text_domain' ); ?>" />
  <input type="hidden" name="post_type" value="any" />
</form>
