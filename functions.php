<?php

// Enable featured images
add_theme_support( 'post-thumbnails' );

// Register menus
register_nav_menus( array(
    'banner'    => 'Banner Menu',
    'main'      => 'Main Menu',
));

// Register Custom Navigation Walker
get_template_part( 'includes/wp-bootstrap-navwalker' );

//! @TODO Add image sizes
/*if ( function_exists( 'add_image_size' ) ) {
    add_image_size( '', 1005, 390, true );
}*/

add_action( 'wp_head', 'hewebal_add_favicons' );
add_action( 'admin_head', 'hewebal_add_favicons' );
add_action( 'login_head', 'hewebal_add_favicons' );
function hewebal_add_favicons() {

    // Set the images folder
    $images_folder = get_stylesheet_directory_uri() . '/images/';

    // Include the favicons
    // @TODO Add other favicons?
    ?><link rel="shortcut icon" href="<?php echo $images_folder; ?>heweb-favicon.png" />
    <?php /*<link rel="apple-touch-icon" href="<?php echo $images_folder; ?>favicon-60x60.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $images_folder; ?>favicon-76x76.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo $images_folder; ?>favicon-120x120.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo $images_folder; ?>favicon-152x152.png" /><?php*/

}

// Enqueue styles and scripts
add_action( 'wp_enqueue_scripts', function() {
    
    // Set the theme directory
    $theme_dir = get_stylesheet_directory_uri();

    // Register our font
    wp_register_style( 'hewebal-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,600,300' );

    // Enqueue our base stylesheet
    wp_enqueue_style( 'hewebal', $theme_dir . '/css/style.css', array( 'hewebal-fonts' ), NULL );
    
    // Modernizr JS - goes in header
    wp_enqueue_script( 'modernizr', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js' );
    
    // Need collapse for the nav bar
    wp_enqueue_script( 'bootstrap-collapse', $theme_dir . '/js/bootstrap/collapse.js', array( 'jquery' ), NULL, true );
    wp_enqueue_script( 'bootstrap-modal', $theme_dir . '/js/bootstrap/modal.js', array( 'jquery' ), NULL, true );

    // Enqueue OUR base JS
    wp_enqueue_script( 'hewebal', $theme_dir . '/js/hewebal.js', array( 'jquery', 'modernizr' ), NULL, true );

    // Enqueue the schedule script on the schedule page
    if ( is_page_template( 'schedule.php' ) ) {
        wp_enqueue_script( 'hewebal-schedule', $theme_dir . '/js/hewebal-schedule.js', array( 'jquery' ), NULL, true );
    }

});

//! Hide Query Monitor
add_filter( 'qm/process', function( $show_qm, $is_admin_bar_showing ) {
    return $is_admin_bar_showing;
});

//! Setup login styles
add_action( 'login_head', function() {

    ?><style type="text/css">
    body {
        background: #7A181F;
    }
    #login {
        padding-top: 5%;
    }
    #login h1 a {
        display: block;
        background: url( "<?php echo get_template_directory_uri(); ?>/images/hewebal-logo-white.svg" ) center bottom no-repeat;
        background-size: auto 200px;
        width: 100%;
        height: 200px;
    }
    </style><?php

});

//! Run the loop
function run_the_hewebal_loop() {

    if ( have_posts() ) :
        while ( have_posts() ) :
            the_post();

            the_content();

        endwhile;
    endif;

}

//! Get HEWEBAL schedule data
function get_hewebal_schedule_data() {
    global $wpdb;

    // See if we have the data stored in a transient
    $schedule_transient_name = 'hewebal_schedule_data';

    // If we have cached schedule data...
    if ( ( $transient_schedule_data = get_transient( $schedule_transient_name ) )
        && $transient_schedule_data !== false ) {

        // Return the cached schedule data
        return $transient_schedule_data;

    }

    // These are the custom meta keys
    $custom_keys = array( 'event_type', 'event_location', 'event_date', 'event_start_hour', 'event_start_minute', 'event_end_hour', 'event_end_minute', 'event_session_room', 'session_slides_url', 'session_slides_file', 'session_feedback_url', 'learning_objectives', 'speakers' );

    // One query to rule them all!
    $schedule_query = "SELECT posts.*";

        // Join to get the meta value
        foreach( $custom_keys as $key ) {
            $schedule_query .= ", {$key}_meta.meta_value AS {$key}";
        }

    $schedule_query .= " FROM {$wpdb->posts} posts";

        // Join to get the meta value
        foreach( $custom_keys as $key ) {
            $schedule_query .= " LEFT JOIN {$wpdb->postmeta} {$key}_meta ON {$key}_meta.post_id = posts.ID AND {$key}_meta.meta_key = '{$key}'";
        }

    $schedule_query .= " WHERE posts.post_type = 'schedule' AND posts.post_status = 'publish'
        ORDER BY event_date_meta.meta_value ASC, LENGTH( event_start_hour_meta.meta_value ) ASC, event_start_hour_meta.meta_value ASC, event_start_minute_meta.meta_value ASC, LENGTH( event_end_hour_meta.meta_value ) ASC, event_end_hour_meta.meta_value ASC, event_end_minute_meta.meta_value ASC, event_session_room_meta.meta_value ASC";

    // Store the data
    if ( $schedule_data = $wpdb->get_results( $schedule_query ) ) {

        // Sort by DateTime
        $schedule_sorted_by_dt = array();

        foreach( $schedule_data as &$schedule_item ) {

            // Store the start time
            $start_time = NULL;
            $end_time = NULL;

            // Add time
            if ( $schedule_item->event_start_hour ) {

                // Set start time with start hour
                $start_time = $schedule_item->event_start_hour; // > 12 ? ( $schedule_item->event_start_hour - 12 ) : $schedule_item->event_start_hour;

                // Add start minute
                if ( $schedule_item->event_start_minute )
                    $start_time .= ":{$schedule_item->event_start_minute}";

                // Set end time
                if ( $schedule_item->event_end_hour ) {

                    // Add end hour
                    $end_time = $schedule_item->event_end_hour;
                    //$dt_timestamp .= " to " . ( $schedule_item->event_end_hour > 12 ? ( $schedule_item->event_end_hour - 12 ) : $schedule_item->event_end_hour );

                    // Add end minute
                    if ( $schedule_item->event_end_minute )
                        $end_time .= ":{$schedule_item->event_end_minute}";

                }

                // Store start and end time
                $schedule_sorted_by_dt[ $schedule_item->event_date ][ $start_time ][ 'start_time' ] = $start_time;
                $schedule_sorted_by_dt[ $schedule_item->event_date ][ $start_time ][ 'end_time' ] = $end_time;

            }

            // Store session type
            $schedule_sorted_by_dt[ $schedule_item->event_date ][ $start_time ][ 'event_type' ] = $schedule_item->event_type;

            // Store the speaker count
            $speaker_count = $schedule_item->speakers;

            // Clear out the speakers
            $schedule_item->speakers = NULL;

            // If this item has speakers...
            if ( $speaker_count >= 1 ) {

                // Going to now use the speaker area for the info
                $schedule_item->speakers = array();

                for( $speaker_index = 0; $speaker_index < $speaker_count; $speaker_index++ ) {

                    // Get the data
                    $speaker_data = $wpdb->get_results( "SELECT meta_key, meta_value FROM {$wpdb->postmeta} WHERE post_id = {$schedule_item->ID} AND meta_key LIKE 'speakers\_{$speaker_index}\_%' " );
                    if ( $speaker_data ) {

                        // Build all speaker info
                        $this_speaker_info = (object) array();

                        foreach( $speaker_data as $data ) {

                            // Fix the meta key
                            $meta_key = preg_replace( '/^speakers\_' . $speaker_index . '\_speaker\_/i', '', $data->meta_key );

                            // Store with other data
                            $this_speaker_info->{$meta_key} = $data->meta_value;

                        }

                        // Store speaker info
                        $schedule_item->speakers[] = $this_speaker_info;

                    }

                }

            }

            // Sort by date, then start time
            $schedule_sorted_by_dt[ $schedule_item->event_date ][ $start_time ][ 'events' ][] = $schedule_item;

        }

        // Store for a week - it updates when any schedule items are updated
        set_transient( $schedule_transient_name, $schedule_sorted_by_dt, 604800 );

        return $schedule_sorted_by_dt;

    }

    return false;

}

//! Flush the schedule whenever an item is saved/updated
add_action( "save_post_schedule", function( $post_ID, $post, $update ) {

    delete_transient( 'hewebal_schedule_data' );

});

// Tweak the form submit button
add_filter( 'gform_submit_button', function( $button_input, $form ) {

	// Add some button classes
	return preg_replace( '/gform\_button\sbutton/i', 'gform_button btn btn-primary btn-block', $button_input );

}, 100 );