jQuery(document).ready(function($) {

	// Select items that are meant to click to go to current event
	var $go_to_current_event = jQuery( '.go-to-current-event' ).hide();

	// If current events, then show button
	if ( jQuery( '.schedule-row.current' ).length >= 1 )
		$go_to_current_event.show().css({'display':'block'});

	// If the button is clicked...
	$go_to_current_event.on( 'click', function( $event ) {
		$event.preventDefault();

		// Scroll to current event
		jQuery( document ).scrollTop( jQuery( '.schedule-row.current' ).offset().top );

	});

	// Handle collapsed schedule blocks
	jQuery( '.collapsible-schedule-block .schedule-header' ).on( 'click', function( $event ) {

		// Get parent
		var $the_block = jQuery( this ).closest( '.collapsible-schedule-block' );

		if ( $the_block.hasClass( 'open' ) ) {
			$the_block.removeClass( 'open' );
		} else {
			$the_block.addClass( 'open' );
		}

	});

});