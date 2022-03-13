<?php
/**
 * Template for displaying search forms in Custom Theme
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
      <input type="search" class="search-field" placeholder="<?php echo esc_attr_x('SEARCH', 'placeholder', 'unica-wp'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
      <button type="submit" class="search-submit"><i class="fas fa-search"></i></button>     
</form>