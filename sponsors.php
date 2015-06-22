<?php

// Template Name: HEWEBAL Sponsors

$sponsor_images = get_stylesheet_directory_uri() . '/images/sponsors/';

get_header();

if ( have_posts() ) :
    while ( have_posts() ) :
        the_post();

        ?><h1><?php the_title(); ?></h1>

        <h2>Bronze Sponsors</h2>
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <img src="http://placehold.it/540x400" />
            </div>
            <div class="col-sm-6 col-md-6">
                <img src="http://placehold.it/540x400" />
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <img src="http://placehold.it/540x400" />
            </div>
        </div>

	    <div class="graduate-sponsors">
	        <h2>Graduate Sponsors</h2>
	        <div class="row">
	            <div class="col-md-12">
	                <img src="<?php echo $sponsor_images; ?>mStoner_banner_540x400_colorOption2.gif" />
	            </div>
	        </div>
	    </div><?php

    endwhile;
endif;

get_footer();