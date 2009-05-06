<?php
	$max_size = 128*1024; // 128k	
	$directory_list = array();
	
	if ( current_user_can( 'upload_files' ) ) {
		$upload_dir = compat_get_upload_dir() . '/wptouch/custom-icons';
		$dir_paths = explode( '/', $upload_dir );
		$dir = '';
		foreach ( $dir_paths as $path ) {
			$dir = $dir . "/" . $path;
			if ( !file_exists( $dir ) ) {
				@mkdir( $dir, 0755 ); 
			}			
		}
		
		if ( isset( $_FILES['submitted_file'] ) ) {
			$f = $_FILES['submitted_file'];
			if ( $f['size'] <= $max_size) {
				if ( $f['type'] == 'image/png' || $f['type'] == 'image/jpeg' || $f['type'] == 'image/gif' || $f['type'] == 'image/x-png' || $f['type'] == 'image/pjpeg' ) {	
					@move_uploaded_file( $f['tmp_name'], $upload_dir . "/" . $f['name'] );
					
					if ( !file_exists( $upload_dir . "/" . $f['name'] ) ) {
						echo '<p>There seems to have been an error.  Please try your upload again.</p>';
					} else {
						echo '<p>File has been saved!</p><p>Click <a href="#" style="color:red" onclick="location.reload(true); return false;">here to refresh the page</a>.</p>';						
					}					
				} else {
					echo __( '<p>Sorry, only PNG, GIF and JPEG images are supported.</p>', 'wptouch' );
				}
			} else echo __( '<p>Image too large</p>', 'wptouch' );
		}

	} else echo __( '<p>Insufficient priviledges</p>', 'wptouch' );
?>
