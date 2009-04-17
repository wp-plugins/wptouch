<?php
// some additional compatibility helpers

function compat_load_wordpress() {
	$cur_dir = dirname( __FILE__ );
	$dir_parts = explode( '/', $cur_dir );
	$parts_size = count( $dir_parts );
	while ( $parts_size >= 0 && !defined( ABSPATH ) ) {
		$dir = '';
		for ( $i = 0 ; $i < $parts_size; $i++) {
			$dir = $dir . $dir_parts[ $i ] . '/';	
		}
				
		if ( file_exists( $dir . 'wp-load.php' ) ) {
			require_once( $dir . 'wp-load.php' );
			break;	
		} else if ( file_exists( $dir . 'wp-config.php' ) ) {
			require_once( $dir . 'wp-config.php' );
			break;			
		}

		if ( $parts_size == 0 ) { 
			break;
		} else {
			$parts_size--;
		}
	}
}


?>