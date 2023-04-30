<?php

add_theme_support( 'post-thumbnails' );

add_image_size( 'job-thumbnail', 198, 118 );

/**
 * Taking care of assets enqueue
 *
 * @return void
 */
function softuni_assets() {
	//var_dump( get_template_directory_uri() );
    wp_enqueue_style( 'master.css',
        'http://localhost/softuni-homes/wp-content/themes/softuni-homes/assets/css/master.css', array() );
}
add_action( 'wp_enqueue_scripts', 'softuni_assets' );
