<?php
   $ch = curl_init('http://www.bravenewcode.com/custom/wptouch-news.php');

   curl_setopt($ch, CURLOPT_VERBOSE, 1);
   curl_setopt($ch, CURLOPT_NOBODY, 0);
   curl_setopt($ch, CURLOPT_HEADER, 0);
   curl_setopt($ch, CURLOPT_USERAGENT, 'WPtouch 1.1');
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

   $response = curl_exec($ch);
	curl_close($ch);

	echo $response;
?>
