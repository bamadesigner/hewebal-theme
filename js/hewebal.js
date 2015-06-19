jQuery(document).ready(function($) {

    // When browsers don't support SVG (Fallback)
    if ( ! Modernizr.svg ) {

        jQuery( 'img[src*="svg"]' ).attr( 'src', function() {
            return jQuery( this ).attr( 'src' ).replace( '.svg', '.png' );
        });

    }

    // Make the map fill up the screen
    if ( jQuery( '.hewebal-map ').length >= 1 ) {

		// Set the map
        var $full_screen_map = jQuery( '.hewebal-map' );

		// Set the width and height
        $full_screen_map.width( jQuery( window ).width() ).height( jQuery( window ).height() - $full_screen_map.offset().top );

		// When you want to go full screen
		$full_screen_map.find( '.view-fullscreen' ).on( 'click touchend', function( $event ) {
			$event.preventDefault();

			// If it's already full screen, undo it
			if ( $full_screen_map.hasClass( 'is-fullscreen' ) ) {
				jQuery( this ).html( 'View Fullscreen' );
				$full_screen_map.removeClass( 'is-fullscreen' ).width( jQuery( window ).width() ).height( jQuery( window ).height() - $full_screen_map.offset().top );
			} else {
				jQuery( this ).html( 'Close Fullscreen' );
				$full_screen_map.addClass( 'is-fullscreen' ).width( jQuery( window ).width() ).height( jQuery( window ).height() );
			}
		});

    }

});