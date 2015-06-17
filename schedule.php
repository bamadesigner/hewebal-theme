<?php

// Template Name: HEWEBAL Schedule

get_header();

// Get the schedule data
if ( $schedule_data = get_hewebal_schedule_data() ) {

    foreach ( $schedule_data as $day_key => $day ) {

        // Create the date
        $day_date = new DateTime( $day_key );

        ?><h3 class="schedule-header"><?php echo $day_date->format( 'l, F j' ); ?></h3>
        <div class="schedule-table"><?php

            // Print the events
            foreach ( $day as $time_key => $events ) {

                ?><div class="schedule-row">
                    <div class="schedule-item time"><?php echo $time_key; ?></div>
                    <div class="schedule-item event"><?php

                        // Print each type of event
                        foreach( $events as $event ) {

                            // Define event type
                            $event_type = strtolower( $event->event_type );

                            // Print the event
                            ?><div class="<?php echo $event_type; ?>"><?php

                                switch( $event_type ) {

                                    case 'session':
                                    case 'keynote':
                                        ?><h4 class="session-header"><a href="<?php echo get_permalink( $event->ID ); ?>"><?php echo $event->post_title; ?></a></h4><?php
                                        break;

                                    default:
                                        echo $event->post_title;
                                        break;

                                }

                            ?></div><?php

                        }

                    ?></div>
                </div><?php

            }

        ?></div><?php

    }

}

get_footer();