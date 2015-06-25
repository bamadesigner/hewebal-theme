<?php

// Template Name: HEWEBAL Contact

$images_dir = get_stylesheet_directory_uri() . '/images/';

get_header();

if ( have_posts() ) :
    while ( have_posts() ) :
        the_post();

	    ?><div class="hewebal-contact-info">
	        <div class="row">
	            <div class="col-md-6">
		            <div class="hewebal-contact-twitter">
			            <a class="username" href="https://twitter.com/hewebal">@hewebAL</a>
			            <a class="hashtag" href="https://tagboard.com/hewebAL/229349">#hewebAL</a>
		            </div>
	            </div>
		        <div class="col-md-6">
			        <a class="hewebal-contact-phone" href="tel:+1-205-690-3899">(205) 690-3899</a>
		        </div>
	        </div>
		    <div class="row">
			    <div class="col-md-12">
				    <div class="hewebal-contact-map">Check out the <a href="https://hewebal.com/map/">HighEdWeb Alabama map</a> to find venues plus local food and fun!</div>
			    </div>
		    </div>
        </div><?php

        the_content();

    endwhile;
endif;

get_footer();