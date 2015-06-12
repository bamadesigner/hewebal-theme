jQuery(document).ready(function($) {

    // When browsers don't support SVG (Fallback)
    if ( ! Modernizr.svg ) {

        jQuery( 'img[src*="svg"]' ).attr( 'src', function() {
            return jQuery( this ).attr( 'src' ).replace( '.svg', '.png' );
        });

    }

    // Make the map fill up the screen
    var $full_screen_map = jQuery( '.hewebal-map.fullscreen ');
    $full_screen_map.width( jQuery( window ).width() ).height( jQuery( window ).height() - $full_screen_map.offset().top );

});