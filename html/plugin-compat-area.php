<?php require_once( ABSPATH . '/wp-content/plugins/wptouch/include/plugin.php' ); ?>
<?php global $wptouch_settings; ?>

<?php $version = bnc_get_wp_version(); ?>

<div class="wptouch-itemrow">
	<div class="wptouch-item-desc">
	
	<h2><?php _e( "Plugin Support &amp; Compatibility", "wptouch" ); ?></h2>
	<p>
		<strong>
		<?php
			if ($version > 2.71) {
				echo __( 'WordPress installed: ', 'wptouch' ) . get_bloginfo('version') . '<br />(' . __( 'Untested', 'wptouch' ) . ')';
			} elseif ($version >= 2.5) {
				echo __('WordPress installed: ', 'wptouch' ) . get_bloginfo('version') . '<br />(' . __( 'Fully Supported', 'wptouch' ) . ')';
			} elseif ($version >= 2.3) {
				echo __( 'WordPress installed: ', 'wptouch' ) . get_bloginfo('version') . '<br />(' . __( 'Supported, Upgrade Recommended', 'wptouch' ) . ')';
			} else {
				echo __( 'WordPress installed: ', 'wptouch' ) . get_bloginfo('version') . '<br />(' . __( 'NOT Supported! Upgrade', 'wptouch' ) . ' <u>' . __( 'Required', 'wptouch' ) . '</u>)';
			} 
		?>	
		</strong>
	</p>
	<p><?php _e( "Here you'll find info on additional WPtouch features and their requirements, including those activated with companion plugins.", "wptouch" ); ?></p>
	<p><?php _e( "For further documentation visit" ); ?> <a href="http://www.bravenewcode.com/wptouch/"><?php _e( "BraveNewCode" ); ?></a>.</p>
	<p><?php _e( "To report an incompatible plugin, send an e-mail to" ); ?> <a href="mailto:wptouch@bravenewcode.com">wptouch@bravenewcode.com</a></p>
</div>
		
<div class="wptouch-item-content-box1 wptouch-admin-plugins">
	<h4><?php _e( "WordPress Built-in Functions Support", "wptouch" ); ?></h4>

	<!-- wp tag cloud -->
	<?php if (function_exists('wp_tag_cloud')) { ?>
	<div class="all-good">
		<img src="<?php bloginfo('wpurl'); ?>/wp-content/plugins/wptouch/images/good.png" alt="" /> <?php _e( "The tag cloud for WordPress will automatically show on a page called 'Archives' if you have one.", "wptouch" ); ?>
	</div>
	<?php } else { ?>
	<div class="too-bad">
		<img src="<?php bloginfo('wpurl'); ?>/wp-content/plugins/wptouch/images/bad.png" alt="" /> <?php _e( "Since you're using a pre-tag version of WordPress, your categories will be listed on a page called 'Archives', if you have it.", "wptouch" ); ?>
	</div>
	<?php } ?>
			   
	<br /><br />
						   
	<h4><?php _e( "WordPress Pages &amp; Feature Support", "wptouch" ); ?></h4>
 
	<?php
	  //Start Pages support checks here
	  
	  //WordPress Links Page Support
	  $links_page_check = new WP_Query('pagename=links');
	  if ($links_page_check->post->ID) {
		  echo '<div class="all-good"><img src="' . get_bloginfo('wpurl') . '/wp-content/plugins/wptouch/images/good.png" alt="" /> ' . __( "All of your WP links will automatically show on your page called 'Links'.", "wptouch" ) . '</div>';
	  } else {
		  
		  echo '<div class="too-bad"><img src="' . get_bloginfo('wpurl') . '/wp-content/plugins/wptouch/images/bad.png" alt="" /> ' . __( "If you create a page called 'Links', all your WP links would display in <em>WPtouch</em> style.", "wptouch" ) . '</div>';
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
	
	<!-- custom anti spam -->
	<?php if (!function_exists('cas_register_post')) { ?>
		<div class="all-good">
			<img src="<?php bloginfo('wpurl'); ?>/wp-content/plugins/wptouch/images/good.png" alt="" /> Cool! <a href="http://wordpress.org/extend/plugins/peters-custom-anti-spam-image/" target="_blank">Peter's Custom Anti-Spam</a>: Your commentform supports it
		.</div>
	<?php } else { ?>
		<div class="sort-of">
			<img src="<?php bloginfo('wpurl'); ?>/wp-content/plugins/wptouch/images/sortof.png" alt="" /> You don't have <a href="http://wordpress.org/extend/plugins/peters-custom-anti-spam-image/" target="_blank">Peter's Custom Anti-Spam</a> installed (Your commentform supports it).
		</div>
	<?php } ?>


	<!-- flickr rss -->	  
	<?php if (function_exists('get_flickrRSS')) { ?>
		<div class="all-good">
			<img src="<?php bloginfo('wpurl'); ?>/wp-content/plugins/wptouch/images/good.png" alt="" /> Cool! <a href="http://eightface.com/wordpress/flickrrss/" target="_blank">FlickrRSS</a>: Your photos will automatically show on a page called 'Photos'.
		</div>
	<?php } else { ?>
		<div class="sort-of">
			<img src="<?php bloginfo('wpurl'); ?>/wp-content/plugins/wptouch/images/sortof.png" alt="" /> You don't have <a href="http://eightface.com/wordpress/flickrrss/" target="_blank">FlickrRSS</a> installed (No automatic photos page support)
		</div>
	<?php } ?>
			  
			  
	<!-- blipit -->
	<?php if (function_exists('bnc_blipit_head')) { ?>
		<div class="all-good">
			<img src="<?php bloginfo('wpurl'); ?>/wp-content/plugins/wptouch/images/good.png" alt="" /> Cool! <a href="http://www.bravenewcode.com/blipit/" target="_blank">Blip.it</a>: Your videos will automatically show on your posts in iPhone version.
		</div>
	<?php } else { ?>
		<div class="sort-of">
			<img src="<?php bloginfo('wpurl'); ?>/wp-content/plugins/wptouch/images/sortof.png" alt="" /> You don't have <a href="http://www.bravenewcode.com/blipit/" target="_blank">Blip.it</a> installed: (No automatic iPhone compatible video support)
		</div>
	<?php } ?>
	
			  
	<!-- wp cache -->		  
	<?php if (function_exists('wp_cache_is_enabled')) { ?>
		<div class="sort-of">
			<img src="<?php bloginfo('wpurl'); ?>/wp-content/plugins/wptouch/images/sortof.png" alt="" /> Achtung! <a href="http://mnm.uib.es/gallir/wp-cache-2/" target="_blank">WP-Cache</a>. If active, <strong>it requires configuration.</strong> Visit the <a href="http://www.bravenewcode.com/wptouch/">WPtouch homepage</a> for help using WP-Cache.
		</div>
	<?php } else { ?>
		<div class="all-good">
			<img src="<?php bloginfo('wpurl'); ?>/wp-content/plugins/wptouch/images/good.png" alt="" />No <a href="http://mnm.uib.es/gallir/wp-cache-2/" target="_blank">WP-Cache</a> active. If activated, <strong>it requires special configuration.</strong> Visit the <a href="http://www.bravenewcode.com/wptouch/">WPtouch homepage</a> for help using WP-Cache.
		</div>
	<?php } ?>
			
			
	<!-- wp super cache -->
	<?php if (function_exists('wp_super_cache_footer')) { ?>
		<div class="sort-of">
			<img src="<?php bloginfo('wpurl'); ?>/wp-content/plugins/wptouch/images/sortof.png" alt="" /> <a href="http://ocaoimh.ie/wp-super-cache/" target="_blank">WP Super Cache</a> support is currently experimental. Please visit <a href="http://www.bravenewcode.com/2009/01/05/wptouch-and-wp-super-cache/">this page</a> for more information.
		</div>
	<?php } else { ?>
		<div class="all-good">
			<img src="<?php bloginfo('wpurl'); ?>/wp-content/plugins/wptouch/images/good.png" alt="" /> <a href="http://ocaoimh.ie/wp-super-cache/" target="_blank">WP Super Cache</a> support is currently experimental. Please visit <a href="http://www.bravenewcode.com/2009/01/05/wptouch-and-wp-super-cache/">this page</a> for more information.
		</div>
	<?php } ?>
	
	</div>
</div>
