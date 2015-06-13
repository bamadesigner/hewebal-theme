<?php

// Enable featured images
add_theme_support( 'post-thumbnails' );

//! @TODO Add image sizes
/*if ( function_exists( 'add_image_size' ) ) {
    add_image_size( '', 1005, 390, true );
}*/

//! @TODO Add favicons To <head>
//add_action( 'wp_head', 'hewebal_add_favicons' );
//add_action( 'admin_head', 'hewebal_add_favicons' );
//add_action( 'login_head', 'hewebal_add_favicons' );
/*function hewebal_add_favicons() {

    // Set the images folder
    $images_folder = get_stylesheet_directory_uri() . '/images/favicons/';

    // Include the favicons
    ?><link rel="shortcut icon" href="<?php echo $images_folder; ?>favicon.png" />
    <link rel="apple-touch-icon" href="<?php echo $images_folder; ?>favicon-60x60.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $images_folder; ?>favicon-76x76.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo $images_folder; ?>favicon-120x120.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo $images_folder; ?>favicon-152x152.png" /><?php

}*/

// Enqueue styles and scripts
add_action( 'wp_enqueue_scripts', function() {
    
    // Set the theme directory
    $theme_dir = get_stylesheet_directory_uri();

    // Enqueue our base stylesheet
    wp_enqueue_style( 'hewebal', $theme_dir . '/css/style.css', array(), NULL );
    
    // Modernizr JS - goes in header
    wp_enqueue_script( 'modernizr', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js' );
    
    // Need collapse for the nav bar - goes in footer
    //wp_enqueue_script( 'bootstrap-collapse', $theme_dir . '/js/bootstrap/collapse.js', array( 'jquery' ), NULL, true );
    
    // Enqueue OUR base JS
    wp_enqueue_script( 'hewebal', $theme_dir . '/js/hewebal.js', array( 'jquery', 'modernizr' ), NULL, true );

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