jQuery(document).ready(function($) {

    // When browsers don't support SVG (Fallback)
    if ( ! Modernizr.svg ) {

        jQuery( 'img[src*="svg"]' ).attr( 'src', function() {
            return jQuery( this ).attr( 'src' ).replace( '.svg', '.png' );
        });

    }

});