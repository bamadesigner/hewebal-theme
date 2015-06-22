<?php

// Template Name: HEWEBAL Sponsors

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

        <h2>Graduate Sponsors</h2>
        <div class="row">
            <div class="col-md-4">
                <img src="http://placehold.it/540x400">
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
        </div><?php

    endwhile;
endif;

get_footer();