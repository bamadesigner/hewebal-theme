<?php

// Template Name: HEWEBAL Schedule

get_header();

// Get the schedule data
if ( $schedule_data = get_hewebal_schedule_data() ) {

    // What time is it?
    $current_time = new DateTime( 'now', new DateTimeZone( 'America/Chicago' ) );

    foreach ( $schedule_data as $day_key => $day ) {

        // Create the date for this day
        $day_date = new DateTime( $day_key, new DateTimeZone( 'America/Chicago' ) );

        ?><h2 class="schedule-header"><?php echo $day_date->format( 'l, F j' ); ?></h2>
        <div class="schedule-table"><?php

            // Print the events
            foreach ( $day as $time_key => $time_block ) {

                // Define event type
                $row_event_type = strtolower( $time_block[ 'event_type' ] );

                ?><div class="schedule-row <?php echo $row_event_type; ?>">
                    <div class="schedule-item time"><?php

                        // Get start time for this block
                        $time_block_start_time = ! empty( $time_block[ 'start_time' ] ) ? new DateTime( $day_key . ' ' . $time_block[ 'start_time' ], new DateTimeZone( 'America/Chicago' ) ) : false;

                        // Get end time for this block
                        $time_block_end_time = ! empty( $time_block[ 'end_time' ] ) ? new DateTime( $day_key . ' ' . $time_block[ 'end_time' ], new DateTimeZone( 'America/Chicago' ) ) : false;

                        // Print time time
                        if ( $time_block_start_time ) {

                            // Print start time
                            echo $time_block_start_time->format( 'g:i' );

                            // If we don't have an end time
                            if ( ! $time_block_end_time ) {
                                echo $time_block_start_time->format( ' a' );
                            } else {

                                // If start meridian is different from end meridian
                                if ( $time_block_end_time->format( 'a' ) != $time_block_start_time->format( 'a' ) )
                                    echo $time_block_start_time->format( ' a' );

                                // Print end time
                                echo ' - ' . $time_block_end_time->format( 'g:i a' );

                            }

                        }

                    ?></div>
                    <div class="schedule-item event"><?php

                        // Print each event
                        if ( $time_block[ 'events' ] ) {
                            foreach ( $time_block[ 'events' ] as $event ) {

                                // Define event type
                                $event_type = strtolower( $event->event_type );

                                // Print the event
                                ?><div class="<?php echo $event_type; ?>"><?php

                                    switch ( $event_type ) {

                                        case 'session':
                                        case 'keynote':
                                            ?><h3 class="event-header"><a href="<?php echo get_permalink( $event->ID ); ?>"><?php echo $event->post_title; ?></a></h3><?php
                                            break;

                                        default:
                                            ?><span class="event-header"><?php echo $event->post_title; ?></span><?php

                                            // Print event location
                                            if ( ! empty( $event->event_location ) ) {

                                                ?><span class="event-location"><?php echo $event->event_location; ?></span><?php

                                            } else if ( 'auditorium' == $event_type ) {

                                                ?><span class="event-location">Russell Hall Auditorium</span><?php

                                            }

                                            break;

                                    }

                                    // If it has content...
                                    if ( ! empty( $event->post_content ) ) {

                                        switch( $event_type ) {

                                            case 'session':
                                                echo wpautop( wp_trim_words( $event->post_content, 55, '...' ) );
                                                break;

                                            default:
                                                echo wpautop( $event->post_content );
                                                break;

                                        }

                                    }

                                    // Show the feedback button if 30 minutes after start
                                    if ( ! empty( $event->session_feedback_url ) ) {

                                        switch ( $event_type ) {

                                            case 'session':
                                            case 'keynote':

                                                // Print feedback URL if event has been going on at least 30 minutes
                                                if ( ( $current_time->getTimestamp() - $time_block_start_time->getTimestamp() ) >= 1800 ) {

                                                    ?><a class="btn btn-success btn-block feedback-button" href="<?php echo $event->session_feedback_url; ?>" target="_blank">Give Feedback</a><?php

                                                }

                                                break;

                                        }

                                    }

                                ?></div><?php

                            }
                        }

                        ?><div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div><?php

            }

        ?></div><?php

    }

}

get_footer();