<?php

// Template Name: HEWEBAL Schedule

get_header();

?><h1>Schedule</h1><?php

// Get the schedule data
if ( $schedule_data = get_hewebal_schedule_data() ) {

    foreach ( $schedule_data as $day_key => $day ) {

        // Create the date
        $day_date = new DateTime( $day_key, new DateTimeZone( 'America/Chicago' ) );

        ?><h3 class="schedule-header"><?php echo $day_date->format( 'l, F j' ); ?></h3>
        <div class="schedule-table"><?php

            // Print the events
            foreach ( $day as $time_key => $time_block ) {

                ?><div class="schedule-row">
                    <div class="schedule-item time"><?php

                        // Get start time
                        $start_time = ! empty( $time_block[ 'start_time' ] ) ? new DateTime( $day_key . ' ' . $time_block[ 'start_time' ] ) : false;

                        // Get end time
                        $end_time = ! empty( $time_block[ 'end_time' ] ) ? new DateTime( $day_key . ' ' . $time_block[ 'end_time' ] ) : false;

                        // Print time time
                        if ( $start_time ) {

                            // Print start time
                            echo $start_time->format( 'g:i' );

                            // If we don't have an end time
                            if ( ! $end_time ) {
                                echo $start_time->format( ' a' );
                            } else {

                                // If start meridian is different from end meridian
                                if ( $end_time->format( 'a' ) != $start_time->format( 'a' ) )
                                    echo $start_time->format( ' a' );

                                // Print end time
                                echo ' - ' . $end_time->format( 'g:i a' );

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
                                            ?><h4 class="session-header"><a
                                                href="<?php echo get_permalink( $event->ID ); ?>"><?php echo $event->post_title; ?></a>
                                            </h4><?php
                                            break;

                                        default:
                                            echo $event->post_title;
                                            break;

                                    }

                                ?></div><?php

                            }
                        }

                    ?></div>
                </div><?php

            }

        ?></div><?php

    }

}

get_footer();