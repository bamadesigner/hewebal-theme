                    </div>
                </div>
            </div>

        </div> <!-- #hewebal-content -->
    </div> <!-- #hewebal-main --><?php

    // Where are the sponsor images?
    $sponsor_images = get_stylesheet_directory_uri() . '/images/sponsors/';

    ?><div id="hewebal-sponsors">
        <div class="hewebal-sponsors-inside">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="sponsors-header">Our Sponsors</h2>
                    <a href="http://ua.edu"><img class="sponsor add-border" src="<?php echo $sponsor_images; ?>univ-of-alabama-2.png" /></a>
                    <a href="http://www.hannonhill.com/"><img class="sponsor" src="<?php echo $sponsor_images; ?>Hannon-Hill-ad.jpg" /></a>
                    <a href="http://www.omniupdate.com/"><img class="sponsor" src="<?php echo $sponsor_images; ?>OmniUpdate-Program-Ad.png" /></a>
                    <a href="https://webtide.ua.edu"><img class="sponsor" class="add-border" src="<?php echo $sponsor_images; ?>webtide.png" /></a>
                    <a href="http://mstnr.me/1QBWNDG"><img class="sponsor" src="<?php echo $sponsor_images; ?>mStoner_banner_540x400_colorOption2.gif" /></a>
                </div>
            </div>
        </div>
    </div>

    <div id="hewebal-footer">
        <div class="container-fluid">

            <a href="http://www.highedweb.org/">
                <img class="heweb-logo" src="<?php echo get_stylesheet_directory_uri(); ?>/images/heweb-logo-white.png" alt="" />
                <span class="screen-reader-text">The HighEdWeb Association</span>
            </a>
            <p>HighEdWeb is an organization of Web professionals working at institutions of higher education. We design, develop, manage and map the futures of higher education websites.</p>
            <ul class="footer-list">
                <li>&copy; <?php echo date( 'Y' ); ?> <a href="http://www.highedweb.org/">HighEdWeb Professionals Association</a></li>
                <li><a href="http://www.highedweb.org/about/anti-harassment-policy/">Code of Conduct</a></li>
                <li><a href="https://hewebal.com/contact/">Contact Us</a></li>
            </ul>

        </div>
    </div> <!-- #hewebal-footer -->

    </div> <!-- #hewebal-wrapper -->

    <?php wp_footer(); ?>

</body>
</html>