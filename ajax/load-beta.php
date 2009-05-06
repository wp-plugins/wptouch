<?php	
	require_once( ABSPATH . '/wp-includes/class-snoopy.php');
	
   $snoopy = new Snoopy;
   {

		$snoopy->fetch('http://www.bravenewcode.com/custom/wptouch-beta.php');
		$response = $snoopy->results;
		echo '<h3>Beta Downloads</h3>' . $response;

	}
?>