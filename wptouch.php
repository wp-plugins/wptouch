<?php
/*
   Plugin Name: WPtouch iPhone Theme
   Plugin URI: http://bravenewcode.com/wptouch/
   Description: A plugin which reformats your site with a mobile theme when viewing with an <a href="http://www.apple.com/iphone/">iPhone</a> / <a href="http://www.apple.com/ipodtouch/">iPod touch</a>. Set styling, page, menu, icon and more options for the theme by visiting the <a href="options-general.php?page=wptouch/wptouch.php">WPtouch Options admin panel</a>. &nbsp;
   Author: Dale Mugford & Duane Storey
   Version: 1.8
   Author URI: http://www.bravenewcode.com
   
   # Special thanks to ContentRobot and the iWPhone theme/plugin
   # (http://iwphone.contentrobot.com/) which the detection feature
   # of the plugin was based on.
   
   # This plugin is free software; you can redistribute it and/or
   # modify it under the terms of the GNU Lesser General Public
   # License as published by the Free Software Foundation; either
   # version 2.1 of the License, or (at your option) any later version.
   #
   # This plugin is distributed in the hope that it will be useful,
   # but WITHOUT ANY WARRANTY; without even the implied warranty of
   # MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
   # See the GNU lesser General Public License for more details.
*/

require_once( 'include/plugin.php' );

function wptouch_delete_icon( $icon ) {
	if ( !current_user_can( 'upload_files' ) ) {
		// don't allow users to delete who don't have access to upload
		return;	
	}
			
	$dir = explode( 'wptouch', $icon );
	$loc = ABSPATH . 'wp-content/uploads/wptouch/' . $dir[1];
	unlink( $loc );
}

function wptouch_init() {
	
	if ( isset( $_GET['delete_icon'] ) ) {
		wptouch_delete_icon( $_GET['delete_icon'] );
		
		header( 'Location: ' . get_bloginfo('wpurl') . '/wp-admin/options-general.php?page=wptouch/wptouch.php' );
		die;
	}	
	
	$bnc_option = get_option('bnc_iphone_pages');
	if ($bnc_option == null) {
		$defaults = array();
		$defaults['header-background-color'] = '222222';
		$defaults['header-title'] = '' . get_bloginfo('name') . '';
	}
}

function wptouch_content_filter( $content ) {
	$settings = bnc_wptouch_get_settings();
	if ( isset($settings['adsense-id']) && strlen($settings['adsense-id']) && is_single() ) {
		require_once( 'adsense.php' );
		
		$ad = google_show_ad( $settings['adsense-id'] );
		return $content . '<div class="wptouch-adsense-ad">' . $ad . '</div>';	
	} else {
		return $content;
	}
}

add_filter('init', 'wptouch_init');

// WPtouch Theme Options
	global $bnc_wptouch_version;
 	$bnc_wptouch_version = '1.8';

	function WPtouch($before = '', $after = '') {
		global $bnc_wptouch_version;
		echo $before . 'WPtouch ' . $bnc_wptouch_version . $after;
	}
 
	// WP Admin stylesheet, Javascript
	function wptouch_admin_css() {
		$url = get_bloginfo('wpurl');
		$version = (float)get_bloginfo('version');
		echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('wpurl') . '/wp-content/plugins/wptouch/admin-css/wptouch-admin.css" />';
		$version = (float)get_bloginfo('version');
		if ($version < 2.2) {
			echo '<script src="http://www.google.com/jsapi"></script>';
			echo '<script type="text/javascript">google.load("jquery", "1"); jQuery.noConflict( ); </script>';
		}
		echo "<script type=\"text/javascript\" src=\"" . get_bloginfo('wpurl') . '/wp-content/plugins/wptouch/js/jquery.ajax_upload.1.1.js' . "\"></script>";
	}
  
class WPtouchPlugin {
		var $applemobile;
		var $desired_view;
		var $output_started;
		
	function WPtouchPlugin() {
		$this->output_started = false;
		$this->applemobile = false;
			add_action('plugins_loaded', array(&$this, 'detectAppleMobile'));
			add_filter('stylesheet', array(&$this, 'get_stylesheet'));
			add_filter('theme_root', array(&$this, 'theme_root'));
			add_filter('theme_root_uri', array(&$this, 'theme_root_uri'));
			add_filter('template', array(&$this, 'get_template'));
			add_filter('init', array(&$this, 'bnc_filter_iphone'));
         add_filter('wp', array(&$this, 'bnc_do_redirect'));
		$this->detectAppleMobile();
}

function bnc_do_redirect() {
   global $post;
   if ($this->applemobile && $this->desired_view == 'mobile') {
      if (is_front_page() && bnc_get_selected_home_page() > 0) {
         $url = get_permalink(bnc_get_selected_home_page());
         header('Location: ' . $url);
         die;
      }
   }
}

function bnc_filter_iphone() {
	$key = 'bnc_mobile_' . md5(get_bloginfo('siteurl'));
   	if (isset($_GET['bnc_view'])) {
   		if ($_GET['bnc_view'] == 'mobile') {
			setcookie($key, 'mobile', 0); 
		} elseif ($_GET['bnc_view'] == 'normal') {
			setcookie($key, 'normal', 0);
		}
		header('Location: ' . get_bloginfo('siteurl'));
		die;
	}
		
	$settings = bnc_wptouch_get_settings();
	if (isset($_COOKIE[$key])) {
		$this->desired_view = $_COOKIE[$key];
	} else {
		if ( $settings['enable-regular-default'] ) {
			$this->desired_view = 'normal';
		} else {
	  		$this->desired_view = 'mobile';
		}
	}

	$value = ini_get( 'zlib.output_compression' );
   if ($this->desired_view == 'mobile' && !$this->output_started && !$value) {
	if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') && isset($settings['enable-gzip']) && $settings['enable-gzip']) {
		@ob_start("ob_gzhandler");
	} else {
		@ob_start();
	}
	$this->output_started = true;
   }
}

function detectAppleMobile($query = '') {
	$container = $_SERVER['HTTP_USER_AGENT'];
//The below prints out the user agent array. Uncomment to see it shown on the page.
//print_r($container); 

// Add whatever user agents you want here to the array if you want to make this show on a Blackberry 
// or something. No guarantees it'll look pretty, though!
	$useragents = array("iphone", "ipod", "aspen", "dream", "incognito", "webmate");
		$this->applemobile = false;
			foreach ($useragents as $useragent) {
			if (eregi($useragent, $container)) {
		$this->applemobile = true;
		}
	}
}
	  
function get_stylesheet($stylesheet) {
	if ($this->applemobile && $this->desired_view == 'mobile') {
		return 'default';
	} else {
		return $stylesheet;
	}
}
	  
function get_template($template) {
	$this->bnc_filter_iphone();
		if ($this->applemobile && $this->desired_view === 'mobile') {
		return 'default';
	} else {	   
		return $template;
	}
}
	  
function get_template_directory($value) {
	$theme_root = dirname(__FILE__);
		if ($this->applemobile && $this->desired_view === 'mobile') {
			return $theme_root . '/themes';
		} else {
			return $value;
	}
}
	  
function theme_root($path) {
	$theme_root = dirname(__FILE__);
		if ($this->applemobile && $this->desired_view === 'mobile') {
			return $theme_root . '/themes';
		} else {
			return $path;
	}
}
	  
function theme_root_uri($url) {
	if ($this->applemobile && $this->desired_view === 'mobile') {
		$dir = get_bloginfo('wpurl') . "/wp-content/plugins/wptouch/themes";
		return $dir;
	} else {
		return $url;
		}
	}
}
  
global $wptouch_plugin;
	$wptouch_plugin = new WPtouchPlugin();


function bnc_get_page_id_with_name($name) {
   global $table_prefix;
   if (mysql_connect(DB_HOST, DB_USER, DB_PASSWORD)) {
      if (mysql_select_db(DB_NAME)) {
         $sql = 'select id from ' . $table_prefix . 'posts where post_title = \'' . $name . '\';';
         $result = mysql_query($sql);
         while ($row = mysql_fetch_assoc($result)) {
            print_r($result);
         }
      }
   }
}

function bnc_is_iphone() {
	global $wptouch_plugin;
		return $wptouch_plugin->applemobile;
}
  
	// The Automatic Footer Template Switch Code (into 'wp_footer();')
function wptouch_switch() {
	global $wptouch_plugin;
		if ($wptouch_plugin->desired_view == 'normal') {
			echo '<div style="width: auto;height: 48px;padding-top:17px;padding-bottom:15px;font-size: x-large;font-weight: bold;background: url(' . get_bloginfo('wpurl') . '/wp-content/plugins/wptouch/images/switch-bg.png) repeat-x 0 0;margin:0px;border-top: 1px solid #999;border-bottom: 2px solid #999;text-shadow: #e6e6e6 3px 3px 1px;" id="switch-footer-links">View ' . get_bloginfo('title') . '\'s <a href="' . get_bloginfo('siteurl') . '/?bnc_view=mobile">Mobile Theme</a></div>';
	}
}
  
function bnc_options_menu() {
	add_options_page('WPtouch Theme', 'WPtouch', 9, __FILE__, bnc_wp_touch_page);
}

function bnc_get_ordered_cat_list() {
	// We created our own functio for this as wp_list_categories doesn't make the count linkable

	global $table_prefix;
	global $wpdb;

	$sql = "select * from " . $table_prefix . "term_taxonomy inner join " . $table_prefix . "terms on " . $table_prefix . "term_taxonomy.term_id = " . $table_prefix . "terms.term_id where taxonomy = 'category' order by count desc";	
	$results = $wpdb->get_results( $sql );
	foreach ($results as $result) {
		echo "<li><a href=\"" . get_category_link( $result->term_id ) . "\">" . $result->name . " (" . $result->count . ")</a></li>";
	}

}

function bnc_wptouch_get_settings() {
	return bnc_wp_touch_get_menu_pages();
}

function bnc_wp_touch_get_menu_pages() {
	$v = get_option('bnc_iphone_pages');
	if (!is_array($v)) {
		$v = unserialize($v);
	}

	if ($v != null) {
		return $v;
	} else {
		$v = array();
		return $v;
	}
}

function bnc_get_selected_home_page() {
   $v = bnc_wp_touch_get_menu_pages();
   return $v['home-page'];
}

function wptouch_get_stats() {
	$options = bnc_wp_touch_get_menu_pages();
	if (isset($options['statistics'])) {
		echo stripslashes($options['statistics']);
	}
}
   
  
function bnc_get_title_image() {
	$ids = bnc_wp_touch_get_menu_pages();
		if (isset($ids['main_title'])) {
		return $ids['main_title'];
	} else {
		return 'Default.png';
	}
}

function bnc_excerpt_enabled() {
	$ids = bnc_wp_touch_get_menu_pages();
		if (!isset($ids['enable-post-excerpts'])) {
		return true;
		}
	return $ids['enable-post-excerpts'];
}	

function bnc_is_page_coms_enabled() {
	$ids = bnc_wp_touch_get_menu_pages();
		if (!isset($ids['enable-page-coms']))	 {
		return true;
		}
	return $ids['enable-page-coms'];
}		

function bnc_is_cats_button_enabled() {
	$ids = bnc_wp_touch_get_menu_pages();
		if (!isset($ids['enable-cats-button']))	 {
		return true;
		}
	return $ids['enable-cats-button'];
}	

function bnc_is_login_button_enabled() {
	$ids = bnc_wp_touch_get_menu_pages();
		if (!isset($ids['enable-login-button']))	 {
		return true;
		}
	return $ids['enable-login-button'];
}		

function bnc_is_redirect_enable() {
	$ids = bnc_wp_touch_get_menu_pages();
   if (!isset($ids['enable-redirect']))	 {
      return true;
	} else {
	   return $ids['enable-redirect'];
   }
}
	
function bnc_is_js_enabled() {
	$ids = bnc_wp_touch_get_menu_pages();
		if (!isset($ids['enable-js-header']))	 {
		return true;
		}
	return $ids['enable-js-header'];
}	
	
function bnc_is_gravatars_enabled() {
	$ids = bnc_wp_touch_get_menu_pages();
		if (!isset($ids['enable-gravatars']))	 {
		return true;
		}
	return $ids['enable-gravatars'];
}	
	
function bnc_is_home_enabled() {
	$ids = bnc_wp_touch_get_menu_pages();
		if (!isset($ids['enable-main-home']))	 {
		return true;
		}
	return $ids['enable-main-home'];
}	

function bnc_is_rss_enabled() {
	$ids = bnc_wp_touch_get_menu_pages();
		if (!isset($ids['enable-main-rss'])) {
		return true;
		}
	return $ids['enable-main-rss'];
}	

function bnc_show_author() {
	$ids = bnc_wp_touch_get_menu_pages();
		if (!isset($ids['enable-main-name'])) {
		return true;
		}
	return $ids['enable-main-name'];
}

function bnc_show_tags() {
	$ids = bnc_wp_touch_get_menu_pages();
		if (!isset($ids['enable-main-tags'])) {
		return true;
		}
	return $ids['enable-main-tags'];
}

function bnc_show_categories() {
	$ids = bnc_wp_touch_get_menu_pages();
		if (!isset($ids['enable-main-categories'])) {
		return true;
		}
	return $ids['enable-main-categories'];
}

function bnc_is_email_enabled() {
	$ids = bnc_wp_touch_get_menu_pages();
		if (!isset($ids['enable-main-email'])) {
		return true;
		}
	return $ids['enable-main-email'];
}	

  
function bnc_wp_touch_get_pages() {
	global $table_prefix;
	$ids = bnc_wp_touch_get_menu_pages();
	$a = array();
	$keys = array();
	foreach ($ids as $k => $v) {
		if ($k == 'main_title' || $k == 'enable-post-excerpts' || $k == 'enable-page-coms' || 
			 $k == 'enable-cats-button'  || $k == 'enable-login-button' || $k == 'enable-redirect' || 
			 $k == 'enable-js-header' || $k == 'enable-gravatars' || $k == 'enable-main-home' || 
			 $k == 'enable-main-rss' || $k == 'enable-main-email' || $k == 'enable-main-name' || $k == 'enable-main-tags' || $k == 'enable-main-categories') {
			} else {
				if (is_numeric($k)) {
					$keys[] = $k;
				}
			}
	}
	 
	$menu_order = array(); 
	$query = "select * from {$table_prefix}posts where ID in (" . implode(',', $keys) . ") order by post_title asc";
	$con = @mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	$inc = 0;
	if ($con) {
		if (@mysql_select_db(DB_NAME, $con)) {
			$result = @mysql_query($query);
			while ($row = @mysql_fetch_assoc($result)) {
				//print_r($row);
				$row['icon'] = $ids[$row['ID']];
				$a[$row['ID']] = $row;
				if (isset($menu_order[$row['menu_order']])) {
					$menu_order[$row['menu_order']*100 + $inc] = $row;
				} else {
					$menu_order[$row['menu_order']*100] = $row;
				}
				$inc = $inc + 1;
			}
		}
	} 

	if (isset($ids['sort-order']) && $ids['sort-order'] == 'page') {
		asort($menu_order);
		return $menu_order;
	} else {
		return $a;
	}
}

function bnc_get_header_title() {
	$v = get_option('bnc_iphone_pages');
		if (!is_array($v)) {
	$v = unserialize($v);
}

		if (!isset($v['header-title'])) {
			$v['header-title'] = '' . get_bloginfo('title') . '';
}
return $v['header-title'];
}

function bnc_get_header_background() {
	$v = get_option('bnc_iphone_pages');
		if (!is_array($v)) {
	$v = unserialize($v);
}
		if (!isset($v['header-background-color'])) {
	$v['header-background-color'] = '222222';
}
return $v['header-background-color'];
}
  
function bnc_get_header_border_color() {
	$v = get_option('bnc_iphone_pages');
		if (!is_array($v)) {
	$v = unserialize($v);
}
		if (!isset($v['header-border-color'])) { 
	$v['header-border-color'] = '333333'; 
}
return $v['header-border-color'];
}

function bnc_get_header_color() {
	$v = get_option('bnc_iphone_pages');
		if (!is_array($v)) {
	$v = unserialize($v);
}
		if (!isset($v['header-text-color'])) { 
	$v['header-text-color'] = 'eeeeee'; 
}
return $v['header-text-color'];
}

function bnc_get_link_color() {
	$v = get_option('bnc_iphone_pages');
		if (!is_array($v)) {
	$v = unserialize($v);
}
		if (!isset($v['link-color'])) {
	$v['link-color'] = '006bb3';
}
return $v['link-color'];
}

	require_once( 'include/icons.php' );
  
  function bnc_wp_touch_page()
  {
	  if (isset($_POST['submit'])) {
		  echo('<div class="wrap"><div id="wptouch-theme">');
		  echo('<div id="wptouchupdated">Your new WPtouch settings were saved.</div>');
		  echo('<div id="wptouch-title">' . WPtouch('<div class="header-wptouch-version"> This is ','</div>') . '</div>');
	  } else {
		  echo('<div class="wrap"><div id="wptouch-theme">');
		  echo('<div id="wptouch-title">' . WPtouch('<div class="header-wptouch-version"> This is ','</div>') . '</div>');
	  }
?>

<?php $icons = bnc_get_icon_list(); ?>

		<?php
	  if (isset($_POST['submit'])) {
		  // let's rock and roll

		  unset($_POST['submit']);
			$a = array();

			if (isset($_POST['enable-post-excerpts'])) {
				$a['enable-post-excerpts'] = 1;
			} else {
				$a['enable-post-excerpts'] = 0;
			}
			
			if (isset($_POST['enable-page-coms'])) {
				$a['enable-page-coms'] = 1;
			} else {
				$a['enable-page-coms'] = 0;
			}
			
			if (isset($_POST['enable-cats-button'])) {
				$a['enable-cats-button'] = 1;
			} else {
				$a['enable-cats-button'] = 0;
			}
						
			if (isset($_POST['enable-login-button'])) {
				$a['enable-login-button'] = 1;
			} else {
				$a['enable-login-button'] = 0;
			}

         if (isset($_POST['enable-redirect'])) {
            $a['enable-redirect'] = 1;
         } else {
            $a['enable-redirect'] = 0;
         }
			
			if (isset($_POST['enable-js-header'])) {
				$a['enable-js-header'] = 1;
			} else {
				$a['enable-js-header'] = 0;
			}
			
		if (isset($_POST['enable-gravatars'])) {
				$a['enable-gravatars'] = 1;
			} else {
				$a['enable-gravatars'] = 0;
			}
			
			if (isset($_POST['enable-main-home'])) {
				$a['enable-main-home'] = 1;
			} else {
				$a['enable-main-home'] = 0;
			}

			if (isset($_POST['enable-main-rss'])) {
				$a['enable-main-rss'] = 1;
			} else {
				$a['enable-main-rss'] = 0;
			}

			if (isset($_POST['enable-main-email'])) {
				$a['enable-main-email'] = 1;
			} else {
				$a['enable-main-email'] = 0;
			}

			if (isset($_POST['enable-main-name'])) {
				$a['enable-main-name'] = 1;
			} else {
				$a['enable-main-name'] = 0;
			}

			if (isset($_POST['enable-main-tags'])) {
				$a['enable-main-tags'] = 1;
			} else {
				$a['enable-main-tags'] = 0;
			}

		 if (isset($_POST['enable-main-categories'])) {
			$a['enable-main-categories'] = 1;
		 } else {
			$a['enable-main-categories'] = 0;
		 }

      if (isset($_POST['home-page'])) {
         $a['home-page'] = $_POST['home-page'];
         if (strlen($a['home-page']) == 0) {
            $a['home-page'] = 'Default';
         }
      } else {
         $a['home-page'] = 'Default';
      }

		if (isset($_POST['statistics'])) {
			$a['statistics'] = $_POST['statistics'];
		}

		if (isset($_POST['sort-order'])) {
			$a['sort-order'] = $_POST['sort-order'];
		}
		
		if (isset($_POST['enable-regular-default'])) {
			$a['enable-regular-default'] = 1;
		} else {
			$a['enable-regular-default'] = 0;
		}

		if (isset($_POST['enable-gzip'])) {
			$a['enable-gzip'] = 1;
		} else {
			$a['enable-gzip'] = 0;
		}
		
		if (isset($_POST['adsense-id'])) {
			$a['adsense-id'] = $_POST['adsense-id'];
		}

		  foreach ($_POST as $k => $v) {
			  if ($k == 'enable_main_title') {
				  $a['main_title'] = $v;
			  } else {
				  if (preg_match('#enable_(.*)#', $k, $matches)) {
					  $id = $matches[1];
					  if (!isset($a[$id]))
						  $a[$id] = $_POST['icon_' . $id];
				  }
		 }
}

		   $a['header-title'] = $_POST['header-title'];
		 if (!isset($a['header-title']) || (isset($a['header-title']) && strlen($a['header-title']) == 0)) {
			$a['header-title'] = get_bloginfo('title');
}

		 $a['header-background-color'] = $_POST['header-background-color'];
		 $a['header-border-color'] = $_POST['header-border-color'];
		 $a['header-text-color'] = $_POST['header-text-color'];
		 $a['link-color'] = $_POST['link-color'];
		
		$values = serialize($a);
		update_option('bnc_iphone_pages', $values);
}
	  
			$v = get_option('bnc_iphone_pages');
			if (!is_array($v)) {
				$v = unserialize($v);
			}
			
			global $wptouch_settings;
			$wptouch_settings = $v;

			if (!isset($v['header-title'])) {
				$v['header-title'] = '' . get_bloginfo('title') . '';
			}
			
			if (!isset($v['header-background-color'])) {
				$v['header-background-color'] = '222222';
			}

			if (!isset($v['header-border-color'])) {
				$v['header-border-color'] = '333333';
			}
			
			if (!isset($v['header-text-color'])) {
				$v['header-text-color'] = 'eeeeee';
			}
			
			if (!isset($v['link-color'])) {
				$v['link-color'] = '006bb3';
			}

			if (!isset($v['enable-post-excerpts'])) {
			$v['enable-post-excerpts'] = 1;
			}	
			
			if (!isset($v['enable-page-coms'])) {
			$v['enable-page-coms'] = 0;
			}	
			
			if (!isset($v['enable-cats-button'])) {
			$v['enable-cats-button'] = 0;
			}	
			
			if (!isset($v['enable-login-button'])) {
			$v['enable-login-button'] = 0;
			}	

         if (!isset($v['enable-redirect'])) {
            $v['enable-redirect'] = 1;
         }
	
			if (!isset($v['enable-js-header'])) {
			$v['enable-js-header'] = 1;
			}	
			
		if (!isset($v['enable-gravatars'])) {
			$v['enable-gravatars'] = 1;
			}	
			
			if (!isset($v['enable-main-home'])) {
			$v['enable-main-home'] = 1;
			}

			if (!isset($v['enable-main-rss'])) {
			$v['enable-main-rss'] = 1;
			}

			if (!isset($v['enable-main-email'])) {
			$v['enable-main-email'] = 1;
			}

			if (!isset($v['enable-main-name'])) {
			$v['enable-main-name'] = 0;
			}

			if (!isset($v['enable-main-tags'])) {
			$v['enable-main-tags'] = 0;
			}

			if (!isset($v['enable-main-categories'])) {
			$v['enable-main-categories'] = 1;
			}

         if (!isset($v['home-page'])) {
            $v['home-page'] = 'Default';
         }

?>
	
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
	<?php require_once( 'html/news-area.php' ); ?>
	<?php require_once( 'html/home-redirect-area.php' ); ?>
	<?php require_once( 'html/javascript-area.php' ); ?>
	<?php require_once( 'html/style-area.php' ); ?>
	<?php require_once( 'html/post-listings-area.php' ); ?>
	<?php require_once( 'html/advertising-area.php' ); ?>
	<?php require_once( 'html/icon-area.php' ); ?>
	<?php require_once( 'html/default-menu-area.php' ); ?>
	<?php require_once( 'html/plugin-compat-area.php' ); ?>
	
	
 		<?php echo('' . WPtouch('<div class="wptouch-version"> This is ','</div>') . ''); ?>
 <input type="submit" name="submit" value="<?php _e('Save Options', 'submit'); ?>" id="wptouch-button" />
  </form>
</div>

<?php 
echo('</div></div>'); } 
add_action('wp_footer', 'wptouch_switch');
add_action('admin_head', 'wptouch_admin_css');
add_action('admin_menu', 'bnc_options_menu'); 
add_action('the_content', 'wptouch_content_filter');
add_filter('the_content_rss', 'do_shortcode', 11);
?>