<?php

global $wpdb, $post;

// Get data
$item_data = get_hewebal_schedule_data( $post->ID );

// We don't need a page for "other"
if ( in_array( $item_data->event_type, array( 'Auditorium', 'Food', 'Other' ) ) ) {
    wp_redirect( 'https://hewebal.com/schedule/' );
    exit;
}

get_header();

// What time is it?
$current_time = new DateTime( 'now', new DateTimeZone( 'America/Chicago' ) );

// Get start time
$start_time = new DateTime( "{$item_data->event_date} {$item_data->event_start_hour}:{$item_data->event_start_minute}", new DateTimeZone( 'America/Chicago' ) );

// Get end time
$end_time = ! empty( $item_data->event_date ) && ! empty( $item_data->event_end_hour ) ? new DateTime( "{$item_data->event_date} {$item_data->event_end_hour}:{$item_data->event_end_minute}", new DateTimeZone( 'America/Chicago' ) ) : false;

?><div class="single-schedule <?php echo $item_data->event_type; ?>"><?php

    if ( have_posts() ) :
        while ( have_posts() ) :
            the_post();

            ?><div class="panel panel-default schedule-item-details">
                <div class="panel-heading">
                    <h3 class="panel-title">Session Details</h3>
                </div>
                <div class="panel-body">
                    <ul>
                        <li class="date"><strong>Date:</strong> <?php echo $start_time->format( 'l, F j' ); ?></li>
                        <li class="time"><strong>Time:</strong> <?php

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

                        ?></li>
                        <li><strong>Room:</strong> <?php echo ! empty( $item_data->event_location ) ? $item_data->event_location : ( 1 == $item_data->event_session_room ? '355' : ( 2 == $item_data->event_session_room ? '354' : null ) ); ?></li>
                    </ul><?php

                    // Show the slides button if after 15 minutes before start
                    if ( ( $current_time->getTimestamp() - $start_time->getTimestamp() ) >= -900 ) {

                        // Get from URL first
                        $session_slides_url = ! empty( $item_data->session_slides_url ) ? $item_data->session_slides_url : false;

                        // If no URL, get field
                        if ( ! $session_slides_url && ! empty( $item_data->session_slides_file ) ) {
                            $session_slides_url = wp_get_attachment_url( $item_data->session_slides_file );
                        }

                        if ( $session_slides_url ) {
                            ?><a class="btn btn-info btn-block slides-button" href="<?php echo $session_slides_url; ?>" target="_blank">View Slides</a><?php
                        }

                    }

                    // Show the feedback button if 30 minutes after start
                    if ( ! empty( $item_data->session_feedback_url ) ) {

                        // Print feedback URL if event has been going on at least 30 minutes
                        if ( ( $current_time->getTimestamp() - $start_time->getTimestamp() ) >= 1800 ) {
                            ?><a class="btn btn-success btn-block feedback-button" href="<?php echo $item_data->session_feedback_url; ?>" target="_blank">Give Feedback</a><?php
                        }

                    }

                ?></div>
            </div><?php

            the_content();

            // Print learning objectives
            if ( $item_data->learning_objectives ) {
                ?><h2>Learning Objectives</h2>
                <ul class="learning-objectives"><li><?php echo implode( '</li><li>', $item_data->learning_objectives ); ?></li></ul><?php
            }

            // Print
            if ( $item_data->speakers ) {

                ?><h2>Speakers</h2>
                <div class="speakers"><?php

                    foreach( $item_data->speakers as $speaker ) {

                        // Get photo
                        $speaker_image_src = $speaker->photo > 0 && ( $speaker_image_info = wp_get_attachment_image_src( $speaker->photo, 'thumbnail' ) ) && isset( $speaker_image_info[0] ) ? $speaker_image_info[0] : false;

                        ?><div class="speaker<?php echo $speaker_image_src ? ' has-image' : null; ?>"><?php

                            if ( $speaker_image_src ) {
                                ?><img class="speaker-thumb" src="<?php echo $speaker_image_src; ?>" /><?php
                            }

                            ?><div class="speaker-text">

                                <h3><?php echo $speaker->name; ?></h3><?php

                                if ( $speaker->position ) {
                                    ?><h4 class="speaker-position"><?php echo $speaker->position;

                                    if ( $speaker->institution ) {

                                        if ( ! empty( $speaker->institution_website ) ) {
                                            ?>, <a href="<?php echo $speaker->institution_website; ?>"><?php echo $speaker->institution; ?></a><?php
                                        } else {
                                            echo ', ' . $speaker->institution;
                                        }

                                    }

                                    ?></h4><?php

                                }

                                if ( ! empty( $speaker->twitter_handle ) ) {
                                    ?><a class="twitter" href="https://twitter.com/<?php echo $speaker->twitter_handle; ?>">@<?php echo $speaker->twitter_handle; ?></a><?php
                                }

                                if ( $speaker->biography ) {
                                    echo wpautop( $speaker->biography );
                                }

                            ?></div>

                        </div><?php

                    }

                ?></div><?php

            }

        endwhile;
    endif;

?></div><?php

get_footer();