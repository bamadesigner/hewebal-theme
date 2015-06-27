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

                // Get start time for this block
                $time_block_start_time = ! empty( $time_block[ 'start_time' ] ) ? new DateTime( $day_key . ' ' . $time_block[ 'start_time' ], new DateTimeZone( 'America/Chicago' ) ) : false;

                // Get end time for this block
                $time_block_end_time = ! empty( $time_block[ 'end_time' ] ) ? new DateTime( $day_key . ' ' . $time_block[ 'end_time' ], new DateTimeZone( 'America/Chicago' ) ) : false;

                // Is this the current time block?
                $current_time_block = $current_time >= $time_block_start_time && $current_time <= $time_block_end_time;

                ?><div class="schedule-row <?php echo $row_event_type; echo $current_time_block ? ' current' : NULL; ?>">
                    <div class="schedule-item time"><?php

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

                                // If social, shorten
                                if ( strcasecmp( 'social event', $event_type ) == 0 )
                                    $event_type = 'social';

                                // Define classes for div
                                $event_type_classes = array( $event_type );

                                // If keynote, add session class
                                if ( 'keynote' == $event_type )
                                    $event_type_classes[] = 'session';

                                // Print the event
                                ?><div class="<?php echo implode( ' ', $event_type_classes ); ?>"><?php

                                    switch ( $event_type ) {

                                        case 'session':
                                        case 'keynote':
                                        case 'social':
                                            ?><h3 class="event-header"><a href="<?php echo get_permalink( $event->ID ); ?>"><?php echo $event->post_title; ?></a></h3><?php
                                            break;

                                        default:
                                            ?><span class="event-header"><?php echo $event->post_title; ?></span><?php
                                            break;

                                    }

                                    // Print event location
                                    if ( 'session' != $event_type && 'social' != $event_type ) {

                                        if ( ! empty( $event->event_location ) ) {

                                            ?><span class="event-location"><?php echo $event->event_location; ?></span><?php

                                        } else if ( 'auditorium' == $event_type ) {

                                            ?><span class="event-location">Russell Hall Auditorium</span><?php

                                        }

                                    }

                                    // If it has content...
                                    if ( ! empty( $event->post_content ) ) {

                                        switch( $event_type ) {

                                            case 'session':
                                                ?><div class="event-desc"><?php echo wpautop( wp_trim_words( $event->post_content, 55, '...' ) ); ?></div><?php
                                                break;

                                            default:

                                                // Get featured image
                                                $has_image = false;
                                                $image_html = null;
                                                if ( 'social' == $event_type
                                                    && ( $post_thumbnail_id = get_post_thumbnail_id( $event->ID ) ) ) {

                                                    $thumbnail_src = wp_get_attachment_image_src( $post_thumbnail_id, 'thumbnail' );
                                                    $small_src = wp_get_attachment_image_src( $post_thumbnail_id, 'small' );

                                                    $has_image = true;
                                                    $image_html = '<img class="thumb hidden-xs hidden-sm" src="' . $thumbnail_src[0] . '" /><img class="small hidden-md hidden-lg" src="' . $small_src[0] . '" />';

                                                }

                                                ?><div class="event-desc<?php echo $has_image ? ' has-thumb' : null; ?>"><?php

                                                    // Print thumb
                                                    echo $has_image && $image_html ? $image_html : null;

                                                    // Print description
                                                    echo wpautop( $event->post_content );

                                                ?></div><?php
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