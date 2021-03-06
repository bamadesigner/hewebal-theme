<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php wp_title( '-', true, 'left' ); ?></title>

    <?php wp_head(); ?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body <?php body_class(); ?>>
    <a href="#" id="skip-to-content">Skip to Content</a>

    <div id="hewebal-wrapper">

        <div id="hewebal-banner">
            <div class="container-fluid">

                <div class="hewebal-twitter">
                    <a class="hashtag" href="https://tagboard.com/hewebAL/229349">#hewebAL</a>
                </div>

	            <?php /*<a class="hewebal-phone" href="tel:+1-205-690-3899">(205) 690-3899</a>*/ ?>
                <?php /*<img class="hewebal-wifi-trigger" data-toggle="modal" data-target="#hewebAL-WiFi-Modal" src="<?php echo get_stylesheet_directory_uri(); ?>/images/wifi.svg" alt="How to Connect to Wifi" /> */ ?>

                <div class="hewebal-banner-menu"><?php

                    // Print the banner menu
                    wp_nav_menu( array(
                        'theme_location'    => 'banner',
                        'depth'             => 1,
                        'container'         => false,
                        'menu_id'           => 'hewebal-banner-menu'
                    ) );

                 ?></div>

            </div>
        </div>

        <div id="hewebal-header">

            <div class="hewebal-header-photo">
                <a class="hewebal-logo" href="<?php echo get_bloginfo( 'url' ); ?>">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/hewebal-logo-white.svg" alt="HighEdWeb Alabama"/>
                    <span class="hewebal-header-text">
                        <span class="date">June 29-30, 2015</span>
                        <span class="location">The University of Alabama</span>
                        <span class="tagline">A Regional HighEdWeb Association Conference</span>
                    </span>
                </a>
            </div>

        </div> <!-- #hewebal-header -->

        <div id="hewebal-menu">
            <div class="container-fluid">

                <nav id="hewebal-navbar" class="navbar navbar-default">

                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <span class="navbar-brand" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="true">Menu</span>
                    </div><?php

                    // Print the main menu
                    wp_nav_menu( array(
                        'theme_location'    => 'main',
                        'depth'             => 2,
                        'container'         => 'div',
                        'container_class'   => 'collapse navbar-collapse',
                        'container_id'      => 'bs-example-navbar-collapse-1',
                        'menu_class'        => 'nav navbar-nav',
                        //'link_before'       => '<span>',
                        //'link_after'        => '</span>',
                        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                        'walker'            => new wp_bootstrap_navwalker()
                    ) );

                ?></nav>

            </div>
        </div>

        <div id="hewebal-main"><?php

            if ( ! ( is_front_page() || is_page_template( 'map.php' ) ) ) {

                ?><div class="hewebal-h1">
                    <div class="container-fluid">
                        <h1><?php echo get_the_title();?></h1>
                    </div>
                </div><?php

            }

            ?><div id="hewebal-content">

                <div class="container-fluid">

                    <div class="row">
                        <div class="col-md-12">