<?php

// Template Name: HEWEBAL Sponsors

$sponsor_images = get_stylesheet_directory_uri() . '/images/sponsors/';

get_header();

if ( have_posts() ) :
    while ( have_posts() ) :
        the_post();

        ?><p class="sponsor-thank-you">A <span class="huge">HUGE</span> thank you to all of our sponsors that help support the advancement of higher education web professionals!</p>

        <div class="sponsors bronze">
            <h2 class="sponsor-header">Bronze Sponsors</h2>
            <a href="http://www.hannonhill.com/"><img src="<?php echo $sponsor_images; ?>Hannon-Hill-ad.jpg" /></a>
            <a href="http://www.omniupdate.com/"><img src="<?php echo $sponsor_images; ?>OmniUpdate-Program-Ad.png" /></a>
            <a href="http://ua.edu"><img class="ua-sponsor-logo" src="<?php echo $sponsor_images; ?>univ-of-alabama.png" /></a>
        </div>

	    <div class="sponsors graduate">
	        <h2 class="sponsor-header">Graduate Sponsors</h2>
            <a href="http://mstnr.me/1QBWNDG"><img src="<?php echo $sponsor_images; ?>mStoner_banner_540x400_colorOption2.gif" /></a>
	    </div><?php

    endwhile;
endif;

get_footer();