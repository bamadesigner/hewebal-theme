jQuery(document).ready(function($) {

	// Select items that are meant to click to go to current event
	var $go_to_current_event = jQuery( '.go-to-current-event' );

	// If no current events, then hide
	if ( jQuery( '.schedule-row.current' ).length == 0 )
		$go_to_current_event.hide();

	// If the button is clicked...
	$go_to_current_event.on( 'click touchend', function( $event ) {
		$event.preventDefault();

		// Scroll to current event
		jQuery( document ).scrollTop( jQuery( '.schedule-row.current' ).offset().top );

	});

});