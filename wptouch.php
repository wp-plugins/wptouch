<?php
  /*
   Plugin Name: WPtouch iPhone Theme
   Plugin URI: http://bravenewcode.com/wptouch/
   Description: A plugin which formats your site when viewing with an <a href="http://www.apple.com/iphone/">iPhone</a> / <a href="http://www.apple.com/ipodtouch/">iPod touch</a>. Set styling, page, menu and icon options for the theme by visiting the <a href="options-general.php?page=wptouch/wptouch.php">WPtouch Options admin panel</a>. You'll also find help for using WPtouch with your WordPress setup. &nbsp;
   Author: Dale Mugford & Duane Storey
   Version: 1.3
   Author URI: http://www.bravenewcode.com
   
   # Special thanks to ContentRobot and the iWPhone theme/plugin
   #(http://iwphone.contentrobot.com/) which the detection feature
   #of the plugin was based on.
   
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
   
// Let's begin with something we don't need anymore... hee hee	
//update_option('bnc_iphone_pages', serialize(''));

	$bnc_option = get_option('bnc_iphone_pages');
	if ($bnc_option == null) {
		$defaults = array();
		$defaults['header-background-color'] = '222222';
	//	update_option('bnc_iphone_pages', serialize($defaults));
	}
 
// WPtouch Theme Options
    $bnc_wptouch_version = '1.3';
    function WPtouch($before = '', $after = '')
    {
        global $bnc_wptouch_version;
        echo $before . 'WPtouch ' . $bnc_wptouch_version . $after;
    }
 
    // WP Admin stylesheets, detect if we're using WordPress 2.5 or lower, and serve up a slightly different layout for each:
    function wptouch_admin_css()
    {
        $url = get_bloginfo('wpurl');
        $version = (float)get_bloginfo('version');
        echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('wpurl') . '/wp-content/plugins/wptouch/admin-css/wptouch-admin.css" />';
        $version = (float)get_bloginfo('version');
        if ($version < 2.2) {
            echo '<script src="http://www.google.com/jsapi"></script>';
            echo '<script type="text/javascript">google.load("jquery", "1"); jQuery.noConflict( ); </script>';
        }
    }

  add_action('admin_head', 'wptouch_admin_css');
  
  
  class WPtouchPlugin
  {
      var $applemobile;
      var $desired_view;
      
      function WPtouchPlugin()
      {
          $this->applemobile = false;
          add_action('plugins_loaded', array(&$this, 'detectAppleMobile'));
          add_filter('stylesheet', array(&$this, 'get_stylesheet'));
          add_filter('theme_root', array(&$this, 'theme_root'));
          add_filter('theme_root_uri', array(&$this, 'theme_root_uri'));
          add_filter('template', array(&$this, 'get_template'));
          add_filter('init', array(&$this, 'bnc_filter_iphone'));
          
          $this->detectAppleMobile();
      }
      
      function bnc_filter_iphone()
      
	  {

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
          
          if (isset($_COOKIE[$key])) {
              $this->desired_view = $_COOKIE[$key];
          } else {
              $this->desired_view = 'mobile';
          }

			// check static home page problem
			if ($this->desired_view == 'mobile') {
	  			$blog = get_option('page_for_posts');
				if ($blog) {
					if (function_exists('is_front_page') && is_front_page() && $this->applemobile) { 
						header('Location: ' . get_permalink($blog));
						die;
					}
				}
			}
      }
      
      function detectAppleMobile($query = '')
      {
          $container = $_SERVER['HTTP_USER_AGENT'];
          //print_r($container); //this prints out the user agent array
		  // Add whatever user agents you want here if you want to make this show on a Blackberry or something. No guarantees it'll look pretty, though!
          $useragents = array("iPhone", "iPod", "Aspen");
          $this->applemobile = false;
          foreach ($useragents as $useragent) {
              if (eregi($useragent, $container)) {
                  $this->applemobile = true;
              }
          }
      }
      
      function get_stylesheet($stylesheet)
      {
          if ($this->applemobile && $this->desired_view == 'mobile') {
              return 'default';
          } else {
              
              return $stylesheet;
          }
      }
      
      function get_template($template)
      {
          $this->bnc_filter_iphone();
          
          if ($this->applemobile && $this->desired_view === 'mobile') {
              return 'default';
          } else {
              
              return $template;
          }
      }
      
      function get_template_directory($value)
      {
          $theme_root = dirname(__FILE__);
          if ($this->applemobile && $this->desired_view === 'mobile') {
              return $theme_root . '/themes';
          } else {
              
              return $value;
          }
      }
      
      function theme_root($path)
      {
          $theme_root = dirname(__FILE__);
          if ($this->applemobile && $this->desired_view === 'mobile') {
              return $theme_root . '/themes';
          } else {
              
              return $path;
          }
      }
      
      function theme_root_uri($url)
      {
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
  
  function bnc_is_iphone()
  {
      global $wptouch_plugin;
      return $wptouch_plugin->applemobile;
  }
  
    // The template switch code, now works on PHP4, hooray
  function wptouch_switch($before = '', $after = '')
  {
      global $wptouch_plugin;
      if ($wptouch_plugin->applemobile) {
          echo $before . '<a href="' . get_bloginfo('siteurl') . '/?bnc_view=mobile">iPhone View</a> | Normal View' . $after;
  }
}
  
  function bnc_options_menu()
  {
      add_options_page('WPtouch Theme', 'WPtouch', 9, __FILE__, bnc_wp_touch_page);
  }
  
  function bnc_wp_touch_get_menu_pages()
  {
		$v = get_option('bnc_iphone_pages');
		if (!is_array($v)) {
        	$v = unserialize($v);
    	}

     	if ($v != null) {
     		return $v;
		} else {
			$v = array();
			return $a;
		}
  }
  
  function bnc_get_title_image()
  {
      $ids = bnc_wp_touch_get_menu_pages();
      if (isset($ids['main_title'])) {
          return $ids['main_title'];
      } else {
          return 'Default.png';
      }
  }

	function bnc_is_js_enabled() {
      $ids = bnc_wp_touch_get_menu_pages();

      if (!isset($ids['enable-js-header']))  {
			return true;
		}
			return $ids['enable-js-header'];
	}	
	
	function bnc_is_gravatars_enabled() {
      $ids = bnc_wp_touch_get_menu_pages();

      if (!isset($ids['enable-gravatars']))  {
			return true;
		}
			return $ids['enable-gravatars'];
	}	
	
	
	function bnc_is_home_enabled() {
      $ids = bnc_wp_touch_get_menu_pages();

      if (!isset($ids['enable-main-home']))  {
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
  
  
  function bnc_wp_touch_get_pages()
  {
      $ids = bnc_wp_touch_get_menu_pages();

      $a = array();
      
      global $table_prefix;
      $keys = array();
      foreach ($ids as $k => $v) {
          if ($k == 'main_title' || $k == 'enable-js-header' || $k == 'enable-gravatars' || $k == 'enable-main-home' || $k == 'enable-main-rss' || $k == 'enable-main-email' || $k == 'enable-main-name' || $k == 'enable-main-tags' || $k == 'enable-main-categories') {
				// do nothing
          } else {
				if (is_numeric($k)) {
           		$keys[] = $k;
				}
			}
      }
      
      $query = "select * from {$table_prefix}posts where ID in (" . implode(',', $keys) . ") order by post_title asc";
      $con = @mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
      if ($con) {
          if (@mysql_select_db(DB_NAME, $con)) {
              $result = @mysql_query($query);
              while ($row = @mysql_fetch_assoc($result)) {
                  $row['icon'] = $ids[$row['ID']];
                  $a[$row['ID']] = $row;
              }
          }
      }
      
      return $a;
  }

function bnc_get_header_background()
{
	$v = get_option('bnc_iphone_pages');
	if (!is_array($v)) {
		$v = unserialize($v);
	}

	if (!isset($v['header-background-color'])) {
		$v['header-background-color'] = '222222';
	}
	return $v['header-background-color'];
}
  
function bnc_get_header_color()
{
    $v = get_option('bnc_iphone_pages');
    if (!is_array($v)) {
        $v = unserialize($v);
    }

	if (!isset($v['header-text-color'])) { $v['header-text-color'] = 'eeeeee'; }
	return $v['header-text-color'];
}

function bnc_get_link_color()
{
    $v = get_option('bnc_iphone_pages');
    if (!is_array($v)) {
        $v = unserialize($v);
    }

if (!isset($v['link-color'])) {
$v['link-color'] = '006bb3';
}
return $v['link-color'];
}

  function bnc_get_icon_list()
  {
		$a = preg_match('#(.*)wptouch.php#', __FILE__, $matches);
		$dir = opendir($matches[1] . 'images/icon-pool/');
      $files = array();
      if ($dir) {
          while (false !== ($file = readdir($dir))) {
              if ($file == '.' || $file == '..' || $file == '.svn' || $file == 'template.psd' || $file == '.DS_Store' || $file == 'more')
                  continue;
              $icon = array();
              $names = explode('.', $file);
              $icon['friendly'] = ucfirst($names[0]);
              $icon['name'] = $file;
              $icon['url'] = get_bloginfo('wpurl') . '/wp-content/plugins/wptouch/images/icon-pool/' . $file;
              $files[$icon['name']] = $icon;
          }
      }
      
      ksort($files);
      return $files;
  }

	function bnc_output_icons($icons) {
      foreach ($icons as $icon) {
          echo('<option value="' . $icon['name'] . '" ');
          if (isset($v['main_title']) && $icon['name'] == $v['main_title'])
              echo('selected');
          echo(">{$icon['friendly']}</option>");
      }
	}	
  
  function bnc_wp_touch_page()
  {
      if (isset($_POST['submit'])) {
          echo('<div class="updated"><p>Options changes saved.</p></div>');
          echo('<div class="wrap"><div id="wptouch-theme">');
          echo('<div id="wptouch-title"><img src="' . get_bloginfo('wpurl') . '/wp-content/plugins/wptouch/images/wptouch-logo.png" class="logo" alt="" /><img src="' . get_bloginfo('wpurl') . '/wp-content/plugins/wptouch/images/wptouch-title.jpg" alt="" /></div>');
	  echo('' . WPtouch('<div class="wptouch-version">','</div>') . '');
      } else {
          echo('<div class="wrap"><div id="wptouch-theme">');
          echo('<div id="wptouch-title"><img src="' . get_bloginfo('wpurl') . '/wp-content/plugins/wptouch/images/wptouch-logo.png" class="logo" alt="" /><img src="' . get_bloginfo('wpurl') . '/wp-content/plugins/wptouch/images/wptouch-title.jpg" alt="" /></div>');
	  echo('' . WPtouch('<div class="wptouch-version">','</div>') . '');
      }
?>

<?php $icons = bnc_get_icon_list(); ?>

        <?php
      if (isset($_POST['submit'])) {
          // let's rock and roll

          unset($_POST['submit']);
			$a = array();

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

	  $a['header-background-color'] = $_POST['header-background-color'];
	  $a['header-text-color'] = $_POST['header-text-color'];
	  $a['link-color'] = $_POST['link-color'];
        
			$values = serialize($a);
          	update_option('bnc_iphone_pages', $values);
      }
      
    		$v = get_option('bnc_iphone_pages');
    		if (!is_array($v)) {
        		$v = unserialize($v);
    		}

			if (!isset($v['header-background-color'])) {
				$v['header-background-color'] = '222222';
			}

			if (!isset($v['header-text-color'])) {
				$v['header-text-color'] = 'eeeeee';
			}
			
		if (!isset($v['link-color'])) {
				$v['link-color'] = '006bb3';
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

	?>
	
  <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
  
	<div id="wptouch-preview" style="display:none">
		<div style="background: #<?php echo bnc_get_header_background(); ?> url(<?php bloginfo('wpurl'); ?>/wp-content/plugins/wptouch/themes/default/images/head-fade-bk.png) repeat-x; color:#<?php echo bnc_get_header_color(); ?>" id="head-prev"><img src="<?php bloginfo('wpurl'); ?>/wp-content/plugins/wptouch/images/icon-pool/<?php echo bnc_get_title_image(); ?>" alt="" /> <?php bloginfo('title'); ?>
		</div>				
	</div>	
	
<?php
/*
The News Section
*/
?>

<div class="wptouch-itemrow">
	<div class="wptouch-item-desc">
	<h2>News and Support</h2>
	<p>Here you'll find dynamic information on WPtouch and future changes, as well as support entries and FAQ notes.<br /><br />For now you'll find the latest entries tagged WPtouch on BraveNewCode.com</p>
	</div>
		
	<div class="wptouch-item-content-box1">
	<div id="wptouch-news-frame" style="display: none;"></div>

<script type="text/javascript">
	jQuery.ajax({
		url: "<?php bloginfo('wpurl'); ?>/wp-content/plugins/wptouch/load-news.php",
		success: function(data) {
			jQuery("#wptouch-news-frame").html(data).fadeIn();
		}});
</script>
	</div>
	
	<div class="wptouch-clearer"></div>
</div>

<?php
/*
The Javascript Section
*/
?>

<div class="wptouch-itemrow">
	<div class="wptouch-item-desc">
	<h2>Optimization Options</h2>
	<p>Choose to enable/disable advanced Javascript &amp; Gravatars features</p>
	</div>
	
		<div class="wptouch-item-content-box1">
			<div class="wptouch-checkbox-row"><input type="checkbox" name="enable-js-header" <?php if (isset($v['enable-js-header']) && $v['enable-js-header'] == 1) echo('checked'); ?>><label for="enable-js-header"> Use Advanced <a href="http://www.prototypejs.org/" target="_blank">Prototype</a> Javascript Effects (ajax entries, ajax comments, smooth effects)</label></div>
            
		<div class="wptouch-checkbox-row"><input type="checkbox" name="enable-gravatars" <?php if (isset($v['enable-gravatars']) && $v['enable-gravatars'] == 1) echo('checked'); ?>><label for="enable-gravatars"> Enable Gravatars in Comments</label></div>
      		
            <h4 id="wptouch-js">When Advanced Javascript Is Disabled:</h4>
            <ul class="wptouch-small-menu">
            <li>Your site loads faster on EDGE and 3G connections</li>
            <li>Close icons will appear on the search and menu drop downs</li>
            <li>Comments will not be posted by ajax, and the page will refresh</li>
            <li>The 'Load More Entries' link will not be displayed, and instead regular blog navigation links will be shown</li>
			</ul>

		    <h4 id="wptouch-js">When Gravatars Are Disabled:</h4>		
            <ul class="wptouch-small-menu">
            <li>Single post pages load faster on EDGE and 3G connections</li>
            <li>Gravatar.com images will <strong>not</strong> be shown beside commenter's names on single posts</li>
           </ul>
	
		</div>
	<div class="wptouch-clearer"></div>
</div>


<?php
/*
The Style Section
*/
?>

<div class="wptouch-itemrow wptouchbump">
	<div class="wptouch-item-desc">
	<h2>Style Options</h2>
	<p>Select the foreground and background colors for the header, and your site-wide link color using hex values.<br /><br /><a href="http://www.colorpicker.com/" target="_blank">Click here</a> to view a color picker to help you select your colors.</p>
	</div>
		
	<div class="wptouch-item-content-box1" id="wptouchstyle">
				
<div class="header-item-desc">Header Background Color</div>
<div class="header-input">#<input text="text" name="header-background-color" type="text" value="<?php echo $v['header-background-color']; ?>" /></div>

<div class="header-item-desc">Header Text Color</div>
<div class="header-input">#<input type="text" name="header-text-color" type="text" value="<?php echo $v['header-text-color']; ?>" /></div>

<div class="header-item-desc">Link Color</div>
<div class="header-input">#<input type="text" name="link-color" type="text" value="<?php echo $v['link-color']; ?>" /></div>
				
		</div>
	<div class="wptouch-clearer"></div>
</div>

<?php
/*
The Post Listings Section
*/
?>

<div class="wptouch-itemrow">
	<div class="wptouch-item-desc">
	<h2>Post Listings Options</h2>
	<p>Select which post-meta items will be shown beneath post titles on the index, search &amp; archive pages. </p>
	</div>
	
		<div class="wptouch-item-content-box1">
            
      		<div class="wptouch-checkbox-row"><input type="checkbox" name="enable-main-name" <?php if (isset($v['enable-main-name']) && $v['enable-main-name'] == 1) echo('checked'); ?>><label for="enable-authorname"> Show Author's Name</label></div>
			
			<div class="wptouch-checkbox-row"><input type="checkbox" name="enable-main-categories" <?php if (isset($v['enable-main-categories']) && $v['enable-main-categories'] == 1) echo('checked'); ?>><label for="enable-categories"> Show Categories</label></div>
			
			<div class="wptouch-checkbox-row"><input type="checkbox" name="enable-main-tags" <?php if (isset($v['enable-main-tags']) && $v['enable-main-tags'] == 1) echo('checked'); ?>><label for="enable-tags"> Show Tags</label></div>
				
		</div>
	<div class="wptouch-clearer"></div>
</div>

<?php
/*
The Availabe Icons Section
*/
?>

<div class="wptouch-itemrow">
	<div class="wptouch-item-desc">
	<h2>Available Icons</h2>
	<p>You can select which icons will be displayed beside corresponding pages enabled below.<br /><br />To add icons to the pool simply drop 60x60 (recommended) - .jpg or .png images into the <strong>icon-pool</strong> folder inside the wptouch/images directory, then refresh this page to select them.<br /><br />Also in the folder is a <strong>.psd template</strong> which you can use to build icons yourself.<br /><br />More official icons are available for download on the <a href="http://www.bravenewcode.com/wptouch/">WPtouch homepage</a>.</p>
	</div>
		
	<div class="wptouch-item-content-box1">
	<?php foreach ($icons as $icon) { ?>
				<div class="wptouch-iconblock">
				<img src="<?php echo($icon['url']); ?>" title="<?php echo($icon['name']); ?>" />
				<br /><p class="wptouch-icon-name"><?php echo($icon['friendly']); ?></p>
				</div>
				<?php } ?>
		</div>
	<div class="wptouch-clearer"></div>
</div>

<?php
/*
The Menu Section
*/
?>

<div class="wptouch-itemrow">
	<div class="wptouch-item-desc">
	<h2>Logo/Bookmark<br />Page &amp; Menu Icons</h2>
	<p>Choose the logo displayed in the header (also your bookmark icon), and which published pages are shown on the WPtouch drop-down menu.<br /><br /><strong>Remember, only those checked<br />will be shown.</strong><br /><br />Next, select the icons from the drop list that you want to pair with each page/menu item.</p>
	</div>
		
	<div class="wptouch-item-content-box1">
		<div class="wptouch-select-row">
			<?php
			// do top header icon 
			echo("<div class=\"wptouch-select-left\">Logo &amp; Home Screen Bookmark Icon</div>");
			echo("<div class=\"wptouch-select-right\"><select name=\"enable_main_title\">");
			foreach ($icons as $icon) {
			echo('<option value="' . $icon['name'] . '" ');
			if (isset($v['main_title']) && $icon['name'] == $v['main_title'])
			echo('selected');
			echo(">{$icon['friendly']}</option>");
			}
			echo("</select></div>");
			?>
		</div>
		

			<?php
			global $table_prefix;
			$query = "select * from {$table_prefix}posts where post_type = 'page' and post_status = 'publish' order by post_title asc";
			$con = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
			if ($con) {
			if (mysql_select_db(DB_NAME, $con)) {
			$result = mysql_query($query);
			while ($row = mysql_fetch_assoc($result)) {
			echo("<div class=\"wptouch-select-row\"><div class=\"wptouch-select-left\"><input type=\"checkbox\" name=\"enable_{$row['ID']}\"");
			if (isset($v[$row['ID']]))
			echo('checked />');
			else
			echo(' />');
			echo("<label for=\"check_{$row['ID']}\">{$row['post_title']}</label></div>");
			echo("<div class=\"wptouch-select-right\"><select name=\"icon_{$row['ID']}\">");
			foreach ($icons as $icon) {
			echo('<option value="' . $icon['name'] . '" ');
			if (isset($v[$row['ID']]) && $icon['name'] == $v[$row['ID']])
			  echo('selected');
			echo(">{$icon['friendly']}</option>");
			}
			echo("</select></div></div>");
			}
			}
			}
			?>
		</div>
	<div class="wptouch-clearer"></div>
</div>
	
<?php
/*
The Default Menu Item Section
*/
?>
	
	<div class="wptouch-itemrow">
	<div class="wptouch-item-desc">
	<h2>Default Menu Items</h2>
	<p>Enable/Disable these items from appearing in the WPtouch dropdown menu.</p>
	</div>
		
	<div class="wptouch-item-content-box1">
				<div class="wptouch-checkbox-row"><input type="checkbox" name="enable-main-home" <?php if (isset($v['enable-main-home']) && $v['enable-main-home'] == 1) echo('checked'); ?>><label for="enable-main-home">Enable Home Icon</label></div>
	
				<div class="wptouch-checkbox-row"><input type="checkbox" name="enable-main-rss" <?php if (isset($v['enable-main-rss']) && $v['enable-main-rss'] == 1) echo('checked'); ?>><label for="enable-main-rss">Enable RSS Icon</label></div>
	
				<div class="wptouch-checkbox-row"><input type="checkbox" name="enable-main-email" <?php if (isset($v['enable-main-email']) && $v['enable-main-email'] == 1) echo('checked'); ?>><label for="enable-main-email">Enable Email Icon</label></div>
		</div>
	<div class="wptouch-clearer"></div>
</div>

<?php
/*
The Plugin Section
*/
?>

<div class="wptouch-itemrow">
	<div class="wptouch-item-desc">
	<h2>Plugin Support &amp; Compatibility</h2>
	<p><strong>
<?php
      //Let's do some WordPress version checks to provide more information for the user about what they can expect using the plugin
      $version = (float)get_bloginfo('version');
      if ($version >= 2.5) {
          echo 'WordPress installed: ' . get_bloginfo('version') . '<br />(Fully Supported)';
      } elseif ($version >= 2.3) {
          echo 'WordPress installed: ' . get_bloginfo('version') . '<br />(Supported, Upgrade Recommended)';
      } elseif ($version >= 2.2) {
          echo 'WordPress installed: ' . get_bloginfo('version') . '<br />(Supported, Upgrade Recommended)';
      } elseif ($version >= 2.1) {
          echo 'WordPress installed: ' . get_bloginfo('version') . '<br />(Supported, Upgrade Recommended)';
      } elseif ($version >= 2.0) {
          echo 'WordPress installed: ' . get_bloginfo('version') . '<br />(NOT Supported! Upgrade <u>Required</u>)';
      } elseif ($version >= 1.5) {
          echo 'WordPress installed: ' . get_bloginfo('version') . '<br />(NOT Supported! Upgrade <u>Required</u>)';
      }
?>  
</strong>
  
  <br /><br  />
  To the right you'll find information on other theme features activated through companion plugins &amp; WordPress versions.<br /><br />
  For further documentation visit <a href="http://www.bravenewcode.com/wptouch/">BraveNewCode</a>.<br /><br />
  To report an incompatible plugin, send an e-mail to <a href="mailto:wptouch@bravenewcode.com">wptouch@bravenewcode.com</a></p>
	</div>
		
	<div class="wptouch-item-content-box1 wptouch-admin-plugins">

              <h4>WordPress Built-in Functions Support</h4>

              <?php
              //Start WordPress functions support checks here
              //WordPress Built-In Tags Support Check 
              if (function_exists('wp_tag_cloud')) { ?>
          <div class="all-good"><img src="<?php bloginfo('wpurl'); ?>/wp-content/plugins/wptouch/images/good.png" alt="" /> The tag cloud for WordPress will automatically show on a page called 'Archives' if you have one.</div>
              <?php } else { ?>
			  
                   <div class="too-bad"><img src="<?php bloginfo('wpurl'); ?>/wp-content/plugins/wptouch/images/bad.png" alt="" /> Since you're using a pre-tag version of WordPress, your categories will be listed on a page called 'Archives', if you have it.</div>
              <?php } ?>
               
                           <br /><br />
                           
                <h4>WordPress Pages &amp; Feature Support</h4>
          
                      <?php
                  //Start Pages support checks here
                  
                  //WordPress Links Page Support
                  $links_page_check = new WP_Query('pagename=links');
                  if ($links_page_check->post->ID) {
                      echo '<div class="all-good"><img src="' . get_bloginfo('wpurl') . '/wp-content/plugins/wptouch/images/good.png" alt="" /> All of your WP links will automatically show on your page called \'Links\'.</div>';
                  } else {
                      
                      echo '<div class="too-bad"><img src="' . get_bloginfo('wpurl') . '/wp-content/plugins/wptouch/images/bad.png" alt="" /> If you create a page called \'Links\', all your WP links would display in <em>WPtouch</em> style.</div>';
                  }
?>
                        
          <?php
                  //WordPress Photos Page with and without FlickRSS Support  
                  $links_page_check = new WP_Query('pagename=photos');
                  if ($links_page_check->post->ID && function_exists('get_flickrRSS')) {
                      echo '<div class="all-good"><img src="' . get_bloginfo('wpurl') . '/wp-content/plugins/wptouch/images/good.png" alt="" /> All your <a href="http://eightface.com/wordpress/flickrrss/" target="_blank">FlickrRSS</a> images will automatically show on your page called \'Photos\'.</div>';
                  } elseif ($links_page_check->post->ID && !function_exists('get_flickrRSS')) {
                      echo '<div class="sort-of"><img src="' . get_bloginfo('wpurl') . '/wp-content/plugins/wptouch/images/sortof.png" alt="" /> You have a page called \'Photos\', but don\'t have <a href="http://eightface.com/wordpress/flickrrss/" target="_blank">FlickrRSS</a> installed.</div>';
                  } elseif (!$links_page_check->post->ID && function_exists('get_flickrRSS')) {
                      echo '<div class="sort-of"><img src="' . get_bloginfo('wpurl') . '/wp-content/plugins/wptouch/images/sortof.png" alt="" /> If you create a page called \'Photos\', all your <a href="http://eightface.com/wordpress/flickrrss/" target="_blank">FlickrRSS</a> photos would display in <em>WPtouch</em> style.</div>';
                  } else {
                      
                      echo '<div class="too-bad"><img src="' . get_bloginfo('wpurl') . '/wp-content/plugins/wptouch/images/bad.png" alt="" /> If you create a page called \'Photos\', and install the <a href="http://eightface.com/wordpress/flickrrss/" target="_blank">FlickrRSS</a> plugin, your photos would display in <em>WPtouch</em> style.</div>';
                  }
?>

            <?php
                  //WordPress Archives Page Support with checks for Tags Support or Not
                  $links_page_check = new WP_Query('pagename=archives');
                  if ($links_page_check->post->ID && function_exists('wp_tag_cloud')) {
                      echo '<div class="all-good"><img src="' . get_bloginfo('wpurl') . '/wp-content/plugins/wptouch/images/good.png" alt="" /> Your tags and your monthly listings will automatically show on your page called \'Archives\'.</div>';
                  } elseif ($links_page_check->post->ID && !function_exists('wp_tag_cloud')) {
                      echo '<div class="sort-of"><img src="' . get_bloginfo('wpurl') . '/wp-content/plugins/wptouch/images/good.png" alt="" /> You don\'t have WordPress 2.3 or above, so no Tags will show, but your categories and monthly listings will automatically show on your page called \'Archives\'.</div>';
                  } else {         
                      echo '<div class="too-bad"><img src="' . get_bloginfo('wpurl') . '/wp-content/plugins/wptouch/images/bad.png" alt="" /> If you create a page called \'Archives\', your tags/categories and monthly listings would display in <em>WPtouch</em> style.</div>';
                  }
?>
              <br /><br />

          <h4>Other Plugin Support &amp; Compatibility</h4>
      <?php
      //Start plugin support checks here
      
      //FlickrRSS Plugin check 
      if (function_exists('get_flickrRSS')) {
?>
             <div class="all-good"><img src="<?php bloginfo('wpurl'); ?>/wp-content/plugins/wptouch/images/good.png" alt="" /> Cool! <a href="http://eightface.com/wordpress/flickrrss/" target="_blank">FlickrRSS</a>: Your photos will automatically show on a page called 'Photos'.</div>
              <?php } else { ?>
          <div class="too-bad"><img src="<?php bloginfo('wpurl'); ?>/wp-content/plugins/wptouch/images/bad.png" alt="" /> You don't have <a href="http://eightface.com/wordpress/flickrrss/" target="_blank">FlickrRSS</a> installed (No automatic photos page support)</div>
              <?php } ?>
              
          <?php
		   //Blip-it Check
           if (function_exists('bnc_blipit_head')) { ?>
         <div class="all-good"><img src="<?php bloginfo('wpurl'); ?>/wp-content/plugins/wptouch/images/good.png" alt="" /> Cool! <a href="http://www.bravenewcode.com/blipit/" target="_blank">Blip.it</a>: Your videos will automatically show on your posts in iPhone version.</div>
           <?php } else { ?>
           <div class="sort-of"><img src="<?php bloginfo('wpurl'); ?>/wp-content/plugins/wptouch/images/sortof.png" alt="" /> You don't have <a href="http://www.bravenewcode.com/blipit/" target="_blank">Blip.it</a> installed: (No automatic iPhone compatible video support)</div>
            <?php } ?>
			
	<?php /*?>		      <?php
				  //CodeBox Check
           if (function_exists('codebox_header')) { ?>
         <div class="all-good"><img src="<?php bloginfo('wpurl'); ?>/wp-content/plugins/wptouch/images/good.png" alt="" /> Gravy. <a href="http://wordpress.org/extend/plugins/wp-codebox/" target="_blank">CodeBox</a> is <em>not</em> installed. If it was, things would look ugly.</div>
           <?php } else { ?>
           <div class="too-bad"><img src="<?php bloginfo('wpurl'); ?>/wp-content/plugins/wptouch/images/good.png" alt="" /> D'oh, <a href="http://wordpress.org/extend/plugins/wp-codebox/" target="_blank">CodeBox</a> <strong>is</strong> installed. WPtouch <em>does not</em> currently support it, so things will look ugly until it does, sorry.</div>
            <?php } ?><?php */?>
              
        <?php
          //WP-Cache Plugin Check
          if (function_exists('wp_cache_is_enabled')) { ?>
     <div class="sort-of"><img src="<?php bloginfo('wpurl'); ?>/wp-content/plugins/wptouch/images/sortof.png" alt="" /> Achtung! <a href="http://mnm.uib.es/gallir/wp-cache-2/" target="_blank">WP-Cache</a>. If active, <strong>it requires configuration.</strong> Visit the <a href="http://www.bravenewcode.com/wptouch/">WPtouch homepage</a> for help using WP-Cache.</div>
      
	  <?php } else { ?>
	  
    <div class="all-good"><img src="<?php bloginfo('wpurl'); ?>/wp-content/plugins/wptouch/images/good.png" alt="" /> Whew. No <a href="http://mnm.uib.es/gallir/wp-cache-2/" target="_blank">WP-Cache</a>. If installed, <strong>it requires configuration.</strong> Visit the <a href="http://www.bravenewcode.com/wptouch/">WPtouch homepage</a> for help using WP-Cache.</div>
            <?php } ?>
			
			       <?php
          //Super-Cache Plugin Check
          if (function_exists('wp_super_cache_footer')) { ?>
     <div class="too-bad"><img src="<?php bloginfo('wpurl'); ?>/wp-content/plugins/wptouch/images/bad.png" alt="" /> Yikes! <a href="http://ocaoimh.ie/wp-super-cache/" target="_blank">WP Super Cache</a>. <strong>Currently, it does <em>not</em> work correctly with WPtouch.</strong> We're working on it, though. Visit the <a href="http://www.bravenewcode.com/wptouch/">WPtouch homepage</a> for updates.</div>
      
	  <?php } else { ?>
	  
    <div class="all-good"><img src="<?php bloginfo('wpurl'); ?>/wp-content/plugins/wptouch/images/good.png" alt="" /> Whew. No <a href="http://mnm.uib.es/gallir/wp-cache-2/" target="_blank">WP Super Cache</a>. <strong>Currently, it does <em>not</em> work correctly with WPtouch.</strong> We're working on it, though. Visit the <a href="http://www.bravenewcode.com/wptouch/">WPtouch homepage</a> for updates.</div>
            <?php } ?>
    
    	</div>
	</div>
  <input type="submit" name="submit" value="<?php _e('Save Options', 'submit'); ?>" id="wptouch-button" />
  </form>
</div>

<?php 
echo('</div></div>'); } 
add_action('admin_menu', 'bnc_options_menu'); 
?>
