<?php 
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Core Header Functions
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function wptouch_core_header_enqueue() {
	$version = get_bloginfo('version'); 
		if ($version >= 2.5 && !bnc_wptouch_is_exclusive() && bnc_is_js_enabled()) { 
			echo	 '' . wp_enqueue_script('jquery') . '';	

		} elseif ($version >= 2.5 && bnc_wptouch_is_exclusive() && bnc_is_js_enabled()) { 
			echo '<script type="text/javascript" src="http://www.google.com/jsapi"></script>';
			echo '<script type="text/javascript">google.load("jquery", "1");</script>';

		} elseif ($version < 2.5 && bnc_is_js_enabled()) { 
			echo '<script type="text/javascript" src="http://www.google.com/jsapi"></script>';
			echo '<script type="text/javascript">google.load("jquery", "1");</script>';
 	}
 }

function wptouch_core_header_corejs() {
 if ( bnc_is_js_enabled() ) {
	echo '<script src="' . get_bloginfo('wpurl') . '/wp-content/plugins/wptouch/themes/core/core.js" type="text/javascript" charset="utf-8"></script>'; 
	 }
 }

function wptouch_core_header_plugin_compat() {
if (!function_exists('dsq_comments_template') ) {
	 if ( is_single() && bnc_is_js_enabled()) {
	echo '<script src="' . get_bloginfo('template_directory') . '/js/ajaxcoms.js" type="text/javascript"></script>';
		} elseif ( is_page() && bnc_is_page_coms_enabled() ) {
	echo '<script src="' . get_bloginfo('template_directory') . '/js/ajaxcoms.js" type="text/javascript"></script>';
		}
	 }  
  }
  
function wptouch_core_header_get_pages() {
	$pages = bnc_wp_touch_get_pages();
	global $blog_id;
	foreach ($pages as $p) {
		if ( file_exists( compat_get_plugin_dir( 'wptouch' ) . '/images/icon-pool/' . $p['icon'] ) ) {
			$image = compat_get_plugin_url( 'wptouch' ) . '/images/icon-pool/' . $p['icon'];	
		} else {
		$image = compat_get_upload_url() . '/wptouch/custom-icons/' . $p['icon'];
	}
		echo('<li><a href="' . get_permalink($p['ID']) . '"><img src="' . $image . '" alt="icon" />' . $p['post_title'] . '</a></li>'); 
	}
  }
  
  
function wptouch_core_header_check_use() {
	if (false && function_exists('bnc_is_iphone') && !bnc_is_iphone()) {
		echo '<div class="content post">';
		echo '<a href="#" class="h2">' . _e( 'Warning', 'wptouch' ) . '</a>';
		echo '<div class="mainentry">';
		echo '' . _e( "Sorry, this theme is only meant for use with WordPress on Apple's iPhone and iPod Touch.", "wptouch" ) . '';
		echo '</div></div>';
		echo '' .get_footer() . '';
		echo '</body>';
	die; 
	} 
}
  
  
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// WPtouch Standard Functions
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Comment Avatars				
function wptouch_core_get_avatar() {
if (bnc_is_gravatars_enabled()) {
	if (function_exists('gravatar')) {
		echo "<img class='gravatar' src=\"' . gravatar(\"R\", 28, \"' . get_bloginfo('wpurl') . '/wp-content/plugins/wptouch/images/blank_gravatar.png'\"); ?> alt='' />";
			 } elseif (function_exists('get_avatar')) { 
		echo get_avatar( $comment, $size = '28', $default = '' . get_bloginfo('wpurl') . '/wp-content/plugins/wptouch/images/blank_gravatar.png' );
		}
	}		
}

//Favicon fetch and convert script // This script will convert favicons for the links listed on your Links page (if you have one).
function bnc_url_exists($url)
  {
// Version 4.x supported
      $handle = curl_init($url);
      if (false === $handle) {
          return false;
      }
      curl_setopt($handle, CURLOPT_HEADER, false);
      // this works
      curl_setopt($handle, CURLOPT_FAILONERROR, true);
      curl_setopt($handle, CURLOPT_NOBODY, true);
      curl_setopt($handle, CURLOPT_RETURNTRANSFER, false);
      curl_setopt($handle, CURLOPT_TIMEOUT, 1);
      $connectable = curl_exec($handle);
      $d = curl_getinfo($handle, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
      return($d > 0);
  }
  
  
// This fetches the .ico files for the Links page generation 
function bnc_get_ico_file($ico)
  {
      $d = file_get_contents($ico);
      if (!file_exists(bnc_get_local_dir() . '/cache')) {
          mkdir(bnc_get_local_dir() . '/cache', 0755);
      }
      file_put_contents(bnc_get_local_dir() . '/cache/' . md5($ico) . '.ico', $d);
      exec('sh convert ico:' . bnc_get_local_dir() . '/cache/' . md5($ico) . '.ico' . bnc_get_local_dir() . '/cache/' . md5($ico) . '.png');
  }


// Where's the icon pool? Ah, there it is
function bnc_get_local_dir()
  {
      $dir = preg_split("#/plugins/wptouch/images/icon-pool/#", __FILE__, $test);
      return $dir[0] . '/plugins/wptouch/images/icon-pool';
  }


// This detects where the admin images are located, for all the page icons and such
function bnc_get_local_icon_url()
  {
      return compat_get_plugin_url( 'wptouch' ) . '/images/';
  }


// This does the fancy favicons as icons for WordPress links
function bnc_get_favicon_for_site($site)
  {// Yes we know this goes remote to handle things, but we do this to ensure that it works for everyone. No data is collected, as you'll see if you look at the script.
      $i = 'http://www.bravenewcode.com/code/favicon.php?site=' . urlencode($site) . '&default=' . urlencode(bnc_get_local_icon_url() . '/icon-pool/default.png');
      return $i;
  }

$bnc_start_content = '[gallery]';
$bnc_end_content = '';

add_filter('the_content_rss', 'rename_content');

function rename_content($content) {
   global $bnc_start_content;
   global $bnc_end_content;

   $content = str_replace($bnc_start_content, $bnc_end_content, $content);

   return $content;
  }
?>