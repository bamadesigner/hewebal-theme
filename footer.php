                    </div>
                </div>
            </div>

        </div> <!-- #hewebal-content -->
    </div> <!-- #hewebal-main --><?php

    if ( ! is_page_template( 'sponsors.php' ) ) {

	    // Where are the sponsor images?
	    $sponsor_images = get_stylesheet_directory_uri() . '/images/sponsors/for-footer/';

	    ?><div id="hewebal-sponsors-footer">
		    <div class="hewebal-sponsors-inside">
			    <div class="row">
				    <div class="col-md-12">
					    <h2 class="sponsors-header">Our Sponsors</h2>
					    <a href="http://ua.edu"><img class="sponsor add-border" src="<?php echo $sponsor_images; ?>alabamprimar201.png" alt="" /><span class="screen-reader-text">The University of Alabama</span></a>
					    <a href="http://www.hannonhill.com/"><img class="sponsor" src="<?php echo $sponsor_images; ?>Hannon-Hill.png" alt="" /><span class="screen-reader-text">Hannon Hill</span></a>
					    <a href="http://www.omniupdate.com/"><img class="sponsor" src="<?php echo $sponsor_images; ?>OU-logo_300.png" alt="" /><span class="screen-reader-text">Omni Update</span></a>
					    <a href="https://webtide.ua.edu"><img class="sponsor" class="add-border" src="<?php echo $sponsor_images; ?>webtide.png" alt="" /><span class="screen-reader-text">WebTide</span></a>
					    <a href="http://mstnr.me/1QBWNDG"><img class="sponsor mstoner" src="<?php echo $sponsor_images; ?>mStoner-Logo.png" alt="" /><span class="screen-reader-text">mStoner</span></a>
				    </div>
			    </div>
		    </div>
	    </div><?php

    }

    ?><div id="hewebal-footer">
        <div class="container-fluid">

            <a href="http://www.highedweb.org/">
                <img class="heweb-logo" src="<?php echo get_stylesheet_directory_uri(); ?>/images/heweb-logo-white.png" alt="" />
                <span class="screen-reader-text">The HighEdWeb Association</span>
            </a>
            <p><span class="line">HighEdWeb is an organization of Web professionals working at institutions of higher education.</span><span class="line">We design, develop, manage and map the futures of higher education websites.</span></p>
            <ul class="footer-list">
                <li>&copy; <?php echo date( 'Y' ); ?> <a href="http://www.highedweb.org/">HighEdWeb Professionals Association</a></li>
	            <li><a href="http://2015.highedweb.org/">2015 Annual Conference</a></li>
	            <li><a href="http://www.highedweb.org/about/anti-harassment-policy/">Code of Conduct</a></li>
                <li><a href="<?php echo get_bloginfo( 'url' ); ?>/contact/">Contact Us</a></li>
            </ul>

        </div>
    </div> <!-- #hewebal-footer -->

    </div> <!-- #hewebal-wrapper -->

    <!-- Wifi modal -->
    <div class="modal fade" id="hewebAL-WiFi-Modal" tabindex="-1" role="dialog" aria-labelledby="hewebAL-WiFi-Modal-Label">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="gridSystemModalLabel">How To Connect To The Wi-Fi:</h4>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-3">
                                <img class="hewebal-wifi-icon" src="<?php echo get_stylesheet_directory_uri(); ?>/images/wifi.svg" alt="How to Connect to Wifi" />
                            </div>
                            <div class="col-sm-9">
                                <ol>
                                    <li>Connect to UA-Help for one-time setup.</li>
                                    <li>Click through the steps until asked for credentials.</li>
                                    <li>Use the following credentials to connect to UA-WPA2:
                                        <ol>
                                            <li><strong>Account name:</strong> cit-guest</li>
                                            <li><strong>Password:</strong> W3Lcom3!</li>
                                        </ol>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <?php wp_footer(); ?>

</body>
</html>