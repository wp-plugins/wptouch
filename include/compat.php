<?php
// Plugin compatability file
// to help with older versions of WordPress and WordPress MU
// some concepts taken from compatibility.php from the OpenID plugin at http://code.google.com/p/diso/ 

// this will also be the base include for AJAX routines
// so we need to check if WordPress is loaded, if not, load it
// we'll use ABSPATH, since that's defined when WordPress loads
// should be included in the init function of normal plugins

require_once( 'compat_helpers.php' );

if ( !defined( ABSPATH ) ) {
	compat_load_wordpress();
}


if ( !defined( 'WP_CONTENT_URL' ) ) {
      define( 'WP_CONTENT_URL', get_option( 'siteurl' ) . '/wp-content' );
}

if ( !defined( 'WP_CONTENT_DIR' ) ) {
      define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
}

if ( !defined( 'WP_PLUGIN_URL' ) ) { 
      define( 'WP_PLUGIN_URL', WP_CONTENT_URL . '/plugins' );
}

if ( !defined( 'WP_PLUGIN_DIR' ) ) {
      define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );
}


?>