<?php
  /*
   Plugin Name: WPtouch iPhone Theme
   Plugin URI: http://bravenewcode.com/wptouch/
   Description: A plugin which formats your site when viewing with an <a href="http://www.apple.com/iphone/">iPhone</a> / <a href="http://www.apple.com/ipodtouch/">iPod touch</a>. Set styling, page, menu and icon options for the theme by visiting the <a href="options-general.php?page=wptouch/wptouch.php">WPtouch Options admin panel</a>. You'll also find help for using WPtouch with your WordPress setup. &nbsp;
   Author: Dale Mugford & Duane Storey
   Version: 1.1
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
   # MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
   # Lesser General Public License for more details.
   #
   */
 
     // The version function
  function WPtouch($before = '', $after = '')
  {
     	$version = '1.1';
          echo $before . 'WPtouch 1.1' . $after;
}

 
  //WP Admin stylesheets, detect if we're using WordPress 2.5 or lower, and serve up a slightly different layout for each:
  function wptouch_admin_css()
  {
      $url = get_bloginfo('wpurl');
      $version = (float)get_bloginfo('version');
      if ($version >= 2.5) {
          $url = $url . '/wp-content/plugins/wptouch/admin-css/wptouch25-admin.css';
      } else {
          $url = $url . '/wp-content/plugins/wptouch/admin-css/wptouch-admin.css';
      }
      echo '<link rel="stylesheet" type="text/css" href="' . $url . '" />';
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
	  
	  $blog = get_option('page_for_posts');
if ($blog) {
if (function_exists('is_front_page') && is_front_page()) { 
header('Location: ' . get_permalink($blog));
die;
}
}
          $key = 'bnc_mobile_' . md5(get_bloginfo('wpurl'));
          if (isset($_GET['bnc_view'])) {
              if ($_GET['bnc_view'] == 'mobile') {
                  setcookie($key, 'mobile', 0);
              } elseif ($_GET['bnc_view'] == 'normal') {
                  setcookie($key, 'normal', 0);
              }
              
              header('Location: ' . get_bloginfo('wpurl'));
              die;
          }
          
          if (isset($_COOKIE[$key])) {
              $this->desired_view = $_COOKIE[$key];
          } else {
              $this->desired_view = 'mobile';
          }
      }
      
      function detectAppleMobile($query = '')
      {
          $container = $_SERVER['HTTP_USER_AGENT'];
          //print_r($container); //this prints out the user agent array. uncomment to see it shown on page.
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
          echo $before . '<a href="' . get_bloginfo('home') . '/?bnc_view=mobile">iPhone View</a> | Normal View' . $after;
  }
}
  
  function bnc_options_menu()
  {
      add_options_page('WPtouch Theme', 'WPtouch', 9, __FILE__, bnc_wp_touch_page);
  }
  
  function bnc_wp_touch_get_menu_pages()
  {
     	$a = get_option('bnc_iphone_pages');
     	if ($a != null) {
     		return unserialize($a);
	} else {
		$a = array();
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
          if ($k == 'main_title' || $k == 'enable-main-home' || $k == 'enable-main-rss' || $k == 'enable-main-email' || $k == 'enable-main-name' || $k == 'enable-main-tags' || $k == 'enable-main-categories') {
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
$v = unserialize(get_option('bnc_iphone_pages'));
if (!isset($v['header-background-color'])) {
$v['header-background-color'] = '222222';
}
return $v['header-background-color'];
}
  
function bnc_get_header_color()
{
	$v = unserialize(get_option('bnc_iphone_pages')); 
	if (!isset($v['header-text-color'])) { $v['header-text-color'] = 'eeeeee'; }
	return $v['header-text-color'];
}

function bnc_get_link_color()
{
$v = unserialize(get_option('bnc_iphone_pages'));
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

<?php
      $icons = bnc_get_icon_list();
?>
        <?php
      if (isset($_POST['submit'])) {
          // let's rock and roll

          unset($_POST['submit']);
			$a = array();

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
      
      	$v = unserialize(get_option('bnc_iphone_pages'));

			if (!isset($v['header-background-color'])) {
				$v['header-background-color'] = '222222';
			}

			if (!isset($v['header-text-color'])) {
				$v['header-text-color'] = 'eeeeee';
			}
			
		if (!isset($v['link-color'])) {
				$v['link-color'] = '006bb3';
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


<div id="wptouch-header-css">
  	<table class="wptouch-form-table">
		<tr valign="top">
			<th scope="row">
			<div class="wptouch-thtext">You can use this section to customize the look of WPtouch links, header logo and colors, and post options.
			<br /><br /></div>
			</th>
		
				<td>
				<div class="header-item-desc">Header Background Color</div>
				<div class="header-input">#<input text="text" name="header-background-color" type="text" value="<?php echo $v['header-background-color']; ?>" /></div>
				
				<div class="header-item-desc">Header Text Color</div>
				<div class="header-input">#<input type="text" name="header-text-color" type="text" value="<?php echo $v['header-text-color']; ?>" /></div>
				
				<div class="header-item-desc">Link Color</div>
				<div class="header-input">#<input type="text" name="link-color" type="text" value="<?php echo $v['link-color']; ?>" /></div>
				</td>
				
				<td><input type="checkbox" name="enable-main-home" <?php if (isset($v['enable-main-home']) && $v['enable-main-home'] == 1) echo('checked'); ?>><label for="enable-main-home">Enable Home Icon</label></td>
	
				<td><input type="checkbox" name="enable-main-rss" <?php if (isset($v['enable-main-rss']) && $v['enable-main-rss'] == 1) echo('checked'); ?>><label for="enable-main-rss">Enable RSS Icon</label></td>
	
				<td><input type="checkbox" name="enable-main-email" <?php if (isset($v['enable-main-email']) && $v['enable-main-email'] == 1) echo('checked'); ?>><label for="enable-main-email">Enable Email Icon</label>
				</td>
				</tr>
				</table>
</div>
	<?php
	// Here's Where the new options are hooray
	?>
	
<div id="wptouch-active">  
	<table class="wptouch-form-table">
		<tr valign="top">
			<th scope="row">
			<div class="wptouch-thhead">Main Post Options</div><div class="wptouch-thtext">You can select which items will be shown beneath post titles on the index, search &amp; archive pages here. </div>
			</th>

			<td>
			<input type="checkbox" name="enable-main-name" <?php if (isset($v['enable-main-name']) && $v['enable-main-name'] == 1) echo('checked'); ?>><label for="enable-authorname"> Show Author's Name</label><br /><br />

<input type="checkbox" name="enable-main-categories" <?php if (isset($v['enable-main-categories']) && $v['enable-main-categories'] == 1) echo('checked'); ?>><label for="enable-categories"> Show Categories</label><br /><br />

<input type="checkbox" name="enable-main-tags" <?php if (isset($v['enable-main-tags']) && $v['enable-main-tags'] == 1) echo('checked'); ?>><label for="enable-tags"> Show Tags</label>
			</td>
		</tr>
	</table>
</div>
	

<div id="wptouch-available">  
	<table class="wptouch-form-table">
		<tr valign="top">
			<th scope="row">
			<div class="wptouch-thhead">Available Page Icons</div><div class="wptouch-thtext">You can select which icons will be displayed beside corresponding pages enabled below.<br /><br />To add icons to the pool simply drop 60x60 (recommended) - .jpg or .png images into the <strong>icon-pool</strong> folder inside the wptouch/images directory, then refresh this page to select them.<br /><br />Also in the folder is a <strong>.psd template</strong> which you can use to build icons yourself.<br /><br />More official icons are available for download on the <a href="http://www.bravenewcode.com/wptouch/">WPtouch homepage</a>.
			</div>
			</th>  
				<td>
				<?php foreach ($icons as $icon) { ?>
				<div class="wptouch-iconblock">
				<img src="<?php echo($icon['url']); ?>" title="<?php echo($icon['name']); ?>" />
				<br /><p class="wptouch-icon-name"><?php echo($icon['friendly']); ?></p>
				</div>
				<?php } ?>
				</td>
			</tr>
	</table>
</div>
	
<div id="wptouch-active">  
	<table class="wptouch-form-table">
		<tr valign="top">
			<th scope="row">
			<div class="wptouch-thhead">Logo, Pages &amp; Icons</div><div class="wptouch-thtext">Choose the logo displayed in the header (also your bookmark icon), and which published pages are shown on the WPtouch drop-down menu.<br /><br /><strong>Remember, only those checked will be shown.</strong><br /><br />Next, select the icons from the drop list that you want to pair with each page/menu item.
			</div>
			</th>      

				<td id="wptouch-page-choices">
				<?php echo("<table class=\"wptouch-select-wrap-headicon\">");
				// do top header icon 
				echo("<tr><td class=\"wptouch-select-left\">Logo &amp; Home Screen Bookmark Icon</td><td class=\"wptouch-select-right\"><select name=\"enable_main_title\">");
				foreach ($icons as $icon) {
				echo('<option value="' . $icon['name'] . '" ');
				if (isset($v['main_title']) && $icon['name'] == $v['main_title'])
				echo('selected');
				echo(">{$icon['friendly']}</option>");
				}
				echo("</select></td></tr><tr></table><table class=\"wptouch-select-wrap\">");
				
				global $table_prefix;
				$query = "select * from {$table_prefix}posts where post_type = 'page' and post_status = 'publish' order by post_title asc";
				$con = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
				if ($con) {
				if (mysql_select_db(DB_NAME, $con)) {
				$result = mysql_query($query);
				while ($row = mysql_fetch_assoc($result)) {
				echo("<tr><td class=\"wptouch-select-left\"><input type=\"checkbox\" name=\"enable_{$row['ID']}\"");
				if (isset($v[$row['ID']]))
				echo('checked />');
				else
				echo(' />');
				echo("<label for=\"check_{$row['ID']}\">{$row['post_title']}</label></td>");
				echo("<td class=\"wptouch-select-right\"><select name=\"icon_{$row['ID']}\">");
				foreach ($icons as $icon) {
				echo('<option value="' . $icon['name'] . '" ');
				if (isset($v[$row['ID']]) && $icon['name'] == $v[$row['ID']])
				  echo('selected');
				echo(">{$icon['friendly']}</option>");
				}
				echo("</select></td></tr>");
				}
				}
				}
				?>
	
				</table>
				</td>
			</tr>
	</table>
</div>
  
<?php
      //Let's do some checks to see what's installed for plugins, built-in WordPress functions, and Pages
?>  
  <div id="wptouch-plugins">  
<table class="wptouch-form-table">
    <tr valign="top">
      <th scope="row"><div class="wptouch-thhead">Companion Support</div><div class="wptouch-thtext">
  
<strong>
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
          echo 'WordPress installed: ' . get_bloginfo('version') . '<br />(NOT Supported! Upgrade Required)';
      } elseif ($version >= 1.5) {
          echo 'WordPress installed: ' . get_bloginfo('version') . '<br />(NOT Supported! Upgrade Required)';
      }
?>  
</strong>
  
  <br /><br  />
  To the right you'll find information on other theme features activated through companion plugins &amp; WordPress versions.
  <br /><br />
  For further documentation visit <a href="http://www.bravenewcode.com/wptouch/">BraveNewCode</a>.
  <br /><br />
  To report an incompatible plugin, send an e-mail to <a href="mailto:wptouch@bravenewcode.com">wptouch@bravenewcode.com</a></div>
        </th>  
      
            <td  id="wptouch-plugins-active">

              <h4>WordPress Built-in Functions Support</h4>

              <?php
              //Start WordPress functions support checks here
              //WordPress Built-In Tags Support Check 
              if (function_exists('wp_tag_cloud')) {
?>
          <div class="all-good"><img src="<?php
                  bloginfo('url');
?>/wp-content/plugins/wptouch/images/good.png" alt="" /> The tag cloud for WordPress will automatically show on a page called 'Archives' if you have one.</div>
              <?php } else { ?>
			  
                   <div class="too-bad"><img src="<?php
                      bloginfo('url');
?>/wp-content/plugins/wptouch/images/bad.png" alt="" /> Since you're using a pre-tag version of WordPress, your categories will be listed on a page called 'Archives', if you have it.</div>
              <?php
                  }
?>
               
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
             <div class="all-good"><img src="<?php
          bloginfo('url');
?>/wp-content/plugins/wptouch/images/good.png" alt="" /> Cool! <a href="http://eightface.com/wordpress/flickrrss/" target="_blank">FlickrRSS</a>: Your photos will automatically show on a page called 'Photos'.</div>
              <?php } else { ?>
          <div class="too-bad"><img src="<?php
              bloginfo('url');
?>/wp-content/plugins/wptouch/images/bad.png" alt="" /> You don't have <a href="http://eightface.com/wordpress/flickrrss/" target="_blank">FlickrRSS</a> installed (No automatic photos page support)</div>
              <?php } ?>
              
          <?php
		   //Blip-it Check
           if (function_exists('bnc_blipit_head')) { ?>
         <div class="all-good"><img src="<?php bloginfo('url'); ?>/wp-content/plugins/wptouch/images/good.png" alt="" /> Cool! <a href="http://www.bravenewcode.com/blipit/" target="_blank">Blip.it</a>: Your videos will automatically show on your posts in iPhone version.</div>
           <?php } else { ?>
           <div class="sort-of"><img src="<?php bloginfo('url'); ?>/wp-content/plugins/wptouch/images/sortof.png" alt="" /> You don't have <a href="http://www.bravenewcode.com/blipit/" target="_blank">Blip.it</a> installed: (No automatic iPhone compatible video support)</div>
            <?php } ?>
			
	<?php /*?>		      <?php
				  //CodeBox Check
           if (function_exists('codebox_header')) { ?>
         <div class="all-good"><img src="<?php bloginfo('url'); ?>/wp-content/plugins/wptouch/images/good.png" alt="" /> Gravy. <a href="http://wordpress.org/extend/plugins/wp-codebox/" target="_blank">CodeBox</a> is <em>not</em> installed. If it was, things would look ugly.</div>
           <?php } else { ?>
           <div class="too-bad"><img src="<?php bloginfo('url'); ?>/wp-content/plugins/wptouch/images/good.png" alt="" /> D'oh, <a href="http://wordpress.org/extend/plugins/wp-codebox/" target="_blank">CodeBox</a> <strong>is</strong> installed. WPtouch <em>does not</em> currently support it, so things will look ugly until it does, sorry.</div>
            <?php } ?><?php */?>
              
        <?php
          //WP-Cache Plugin Check
          if (function_exists('wp_cache_is_enabled')) {
?>
     <div class="sort-of"><img src="<?php
              bloginfo('url');
?>/wp-content/plugins/wptouch/images/sortof.png" alt="" /> Achtung! <a href="http://mnm.uib.es/gallir/wp-cache-2/" target="_blank">WP-Cache</a>. If active, <strong>it requires configuration.</strong> Visit the <a href="http://www.bravenewcode.com/wptouch/">WPtouch homepage</a> for help using WP-Cache.</div>
      
	  <?php } else { ?>
	  
    <div class="all-good"><img src="<?php
                  bloginfo('url');
?>/wp-content/plugins/wptouch/images/good.png" alt="" /> Whew. No <a href="http://mnm.uib.es/gallir/wp-cache-2/" target="_blank">WP-Cache</a>. If installed, <strong>it requires configuration.</strong> Visit the <a href="http://www.bravenewcode.com/wptouch/">WPtouch homepage</a> for help using WP-Cache.</div>
            <?php } ?>
			
			       <?php
          //Super-Cache Plugin Check
          if (function_exists('wp_super_cache_footer')) {
?>
     <div class="too-bad"><img src="<?php
              bloginfo('url');
?>/wp-content/plugins/wptouch/images/bad.png" alt="" /> Yikes! <a href="http://ocaoimh.ie/wp-super-cache/" target="_blank">WP Super Cache</a>. <strong>Currently, it does work correctly with WPtouch.</strong> We're working on it, though. Visit the <a href="http://www.bravenewcode.com/wptouch/">WPtouch homepage</a> for updates.</div>
      
	  <?php } else { ?>
	  
    <div class="all-good"><img src="<?php
                  bloginfo('url');
?>/wp-content/plugins/wptouch/images/good.png" alt="" /> Whew. No <a href="http://mnm.uib.es/gallir/wp-cache-2/" target="_blank">WP Super Cache</a>. <strong>Currently, it does work correctly with WPtouch.</strong> We're working on it, though. Visit the <a href="http://www.bravenewcode.com/wptouch/">WPtouch homepage</a> for updates.</div>
            <?php } ?>
              
      </td>
  </tr>
</table>
    
    </div>
  <input type="submit" name="submit" value="<?php _e('Save Options', 'submit'); ?>" id="wptouch-button" />
  </form>
<?php echo('</div></div>'); } add_action('admin_menu', 'bnc_options_menu'); ?>