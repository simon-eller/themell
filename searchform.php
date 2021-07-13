<?php

$twentytwentyone_unique_id = wp_unique_id( 'search-form-' );

$twentytwentyone_aria_label = ! empty( $args['aria_label'] ) ? 'aria-label="' . esc_attr( $args['aria_label'] ) . '"' : '';
?>



<form role="search" <?php echo $twentytwentyone_aria_label; ?> method="get" class="d-flex search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input type="search" id="<?php echo esc_attr( $twentytwentyone_unique_id ); ?>" class="form-control me-2 search-field" value="<?php echo get_search_query(); ?>" name="s" />
    <input type="submit" class="btn themell-btn search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'twentytwentyone' ); ?>" />
</form>
