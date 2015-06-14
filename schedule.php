<?php

// Template Name: HEWEBAL Schedule

get_header();

// Get the schedule data
$schedule_data = get_hewebal_schedule_data();

echo "<pre>";
print_r( $schedule_data );
echo "</pre>";

get_footer();