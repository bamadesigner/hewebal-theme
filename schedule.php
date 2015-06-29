<?php

// Template Name: HEWEBAL Schedule

get_header();

// Get the schedule data
if ( $schedule_data = get_hewebal_schedule_data() ) {

    // What time is it?
    $current_time = new DateTime( 'now', new DateTimeZone( 'America/Chicago' ) );

    // Print "go to current event" button
    ?><a href="#" class="btn btn-primary go-to-current-event">Go To Current Event</a><?php

    foreach ( $schedule_data as $day_key => $day ) {

        // Create the date for this day
        $day_date = new DateTime( $day_key, new DateTimeZone( 'America/Chicago' ) );

        // Has this date passed?
        $day_has_passed = $day_date->format( 'j' ) < $current_time->format( 'j' );

        // Wrap in collapsible block
        if ( $day_has_passed ) {
            echo '<div class="collapsible-schedule-block">';
        }

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
                $current_time_block = $current_time >= $time_block_start_time && $current_time < $time_block_end_time;

                // Is this time block over?
                $past_time_block = $current_time > $time_block_end_time;

                ?><div class="schedule-row <?php echo $row_event_type; echo $current_time_block ? ' current' : NULL; echo $past_time_block ? ' past' : null; ?>">
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

                                // Do we have an event image?
                                $event_image_src = false;

                                // Get event image
                                switch( $event_type ) {

                                    case 'keynote':

                                        // Get featured image
                                        if ( $post_thumbnail_id = get_post_thumbnail_id( $event->ID ) ) {

                                            // Store image src
                                            $event_image_src = ( $event_image_info = wp_get_attachment_image_src( $post_thumbnail_id, 'thumbnail' ) ) && isset( $event_image_info[0] ) ? $event_image_info[0] : false;

                                        }

                                        break;

                                }

                                // Add a class
                                if ( $event_image_src ) {
                                    $event_type_classes[] = 'has-event-image';
                                }

                                // Print the event
                                ?><div class="<?php echo implode( ' ', $event_type_classes ); ?>"><?php

                                    // Show pic
                                    if ( $event_image_src ) {
                                        ?><img class="event-image" src="<?php echo $event_image_src; ?>" /><?php
                                    }

                                    ?><div class="event-text"><?php

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
                                        if ( 'social' != $event_type ) {

                                            if ( ! empty( $event->event_location ) ) {

                                                ?><span class="event-location"><?php echo $event->event_location; ?></span><?php

                                            } else if ( 'auditorium' == $event_type ) {

                                                ?><span class="event-location">Russell Hall Auditorium</span><?php

                                            } else if ( 'session' == $event_type ) {

                                                ?><span class="event-location">RM <?php echo 1 == $event->event_session_room ? '345' : ( 2 == $event->event_session_room ? '344' : null ); ?></span><?php

                                            }

                                        }

                                        // If it has content...
                                        if ( ! empty( $event->post_content ) ) {

                                            switch( $event_type ) {

                                                case 'keynote':
                                                    ?><div class="event-desc"><?php echo wpautop( $event->post_excerpt ); ?></div><?php
                                                    break;

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

                                        // Show the slides button if after 15 minutes before start
                                        if ( ( $current_time->getTimestamp() - $time_block_start_time->getTimestamp() ) >= -900 ) {

                                            // Get from URL first
                                            $session_slides_url = ! empty( $event->session_slides_url ) ? $event->session_slides_url : false;

                                            // If no URL, get field
                                            if ( ! $session_slides_url && ! empty( $event->session_slides_file ) ) {
                                                $session_slides_url = wp_get_attachment_url( $event->session_slides_file );
                                           }

                                           if ( $session_slides_url ) {
                                               ?><a class="btn btn-info btn-block slides-button" href="<?php echo $session_slides_url; ?>" target="_blank">View Slides</a><?php
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

                                    ?></div>
                                </div><?php

                            }
                        }

                        ?><div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div><?php

            }

        ?></div><?php

        // Wrap in collapsible block
        if ( $day_has_passed ) {
            echo '</div>';
        }

    }

}

get_footer();