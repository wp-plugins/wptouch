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
						echo 'There seems to have been an error.  Please try your upload again.';
					} else {
						echo 'File has been saved! <br />Click <a href="#" style="color:red" onclick="location.reload(true); return false;">here to refresh the page</a>.<br /><br />';						
					}					
				} else {
					echo __( 'Sorry, only PNG, GIF and JPEG images are supported.', 'wptouch' );
				}
			} else echo __( 'Image too large', 'wptouch' );
		}

	} else echo __( 'Insufficient priviledges', 'wptouch' );
?>
