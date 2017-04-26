<?php

/**
 * HTML Wrapper - Support for a custom class attribute in the native gallery shortcode
 */
add_filter( 'post_gallery', function( $html, $attr, $instance )
{
    if( isset( $attr['class'] ) && $class = $attr['class'] ) {
        // Unset attribute to avoid infinite recursive loops
        unset( $attr['class'] ); 

        // Our custom HTML wrapper
        $html = sprintf( 
            '<div class="%s">%s</div>',
            esc_attr( $class ),
            gallery_shortcode( $attr )
        );
    }
    return $html;
}, 10 ,3 );