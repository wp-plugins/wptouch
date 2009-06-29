<?php require_once( compat_get_plugin_dir( 'wptouch' ) . '/include/plugin.php' ); ?>
<?php global $wptouch_settings; ?>
<?php $version = bnc_get_wp_version(); ?>

<div class="metabox-holder">
	<div class="postbox">
		<h3><?php _e( "Plugin Support &amp; Compatibility", "wptouch" ); ?></h3>

			<div class="wptouch-left-content">
				<div class="wptouch-version-support">
					<?php
						echo '<p class="wpv">';
						echo __( 'WordPress version: ', 'wptouch' );
						echo '' . get_bloginfo('version') . '';
						echo '</p><p class="wptv">';
						echo __( '' . wptouch() . ' support: ', 'wptouch' );
						if ($version > 2.81) {
							echo sprintf(__( "%sUntested%s", "wptouch" ), '<span class="caution">','</span>');
						} elseif ($version >= 2.6) {
							echo sprintf(__( "%sFully Supported%s", "wptouch" ), '<span class="go">','</span>');
						} else {
							echo sprintf(__( "%Unsupported. Upgrade Required.%s", "wptouch" ), '<span class="red">','</span>');
						} 
						echo '</p>';
					?>	
				</div>
				<p><?php _e( "Here you'll find information on additional WPtouch features and their requirements, including those activated with companion plugins.", "wptouch" ); ?></p>
				<p><?php _e( "For further documentation visit" ); ?> <?php echo sprintf(__( "%sBraveNewCode.%s", "wptouch" ), '<a href="http://www.bravenewcode.com/wptouch/">','</a>'); ?></p>
				<p><?php echo sprintf( __( "To report an incompatible plugin, let us know in our %sSupport Forums%s.", "wptouch"), '<a href="http://support.bravenewcode.com/">', '</a>' ); ?></p>
		</div>
		
		<div class="wptouch-right-content">
			
			<h4><?php _e( "WordPress Pages &amp; Feature Support", "wptouch" ); ?></h4>
			
				<?php
					//WordPress Links Page Support
				$links_page_check = new WP_Query('pagename=links');
				if ($links_page_check->post->ID) {
				echo '<div class="all-good">' . __( "All of your WP links will automatically show on your page called 'Links'.", "wptouch" ) . '</div>';
				} else {
				echo '<div class="too-bad">' . __( "If you create a page called 'Links', all your WP links would display in <em>WPtouch</em> style.", "wptouch" ) . '</div>'; } ?>
				
				<?php
				//WordPress Photos Page with and without FlickRSS Support	 
				$photos_page_check = new WP_Query('pagename=photos');
				if ($photos_page_check->post->ID && function_exists('get_flickrRSS')) {
				echo '<div class="all-good">' . __( 'All your <a href="http://eightface.com/wordpress/flickrrss/" target="_blank">FlickrRSS</a> images will automatically show on your page called \'Photos\'.', 'wptouch' ) . '</div>';
				} elseif ($photos_page_check->post->ID && !function_exists('get_flickrRSS')) {
				echo '<div class="sort-of">' . __( 'You have a page called \'Photos\', but don\'t have <a href="http://eightface.com/wordpress/flickrrss/" target="_blank">FlickrRSS</a> installed.', 'wptouch' ) . '</div>';
				} elseif (!$photos_page_check->post->ID && function_exists('get_flickrRSS')) {
				echo '<div class="sort-of">' . __( 'If you create a page called \'Photos\', all your <a href="http://eightface.com/wordpress/flickrrss/" target="_blank">FlickrRSS</a> photos would display in <em>WPtouch</em> style.', 'wptouch' ) . '</div>';
				} else {
				
				echo '<div class="too-bad">' . __( 'If you create a page called \'Photos\', and install the <a href="http://eightface.com/wordpress/flickrrss/" target="_blank">FlickrRSS</a> plugin, your photos would display in <em>WPtouch</em> style.', 'wptouch' ) . '</div>';
				}
				?>
				
				<?php
				//WordPress Archives Page Support with checks for Tags Support or Not
				$archives_page_check = new WP_Query('pagename=archives');
				if ($archives_page_check->post->ID) {
				echo '<div class="all-good">' . __( 'Your tags and your monthly listings will automatically show on your page called \'Archives\'.', 'wptouch' ) . '</div>';
				} else {		   
				echo '<div class="too-bad">' . __( 'If you had a page called \'Archives\', your tags and monthly listings would display in <em>WPtouch</em> style.', 'wptouch' ) . '</div>';
				}
				?>
				<br /><br />
				
			<h4><?php _e( 'Other Plugin Support &amp; Compatibility', 'wptouch' ); ?></h4>
			
			<!-- custom anti spam -->
			<?php if (function_exists('cas_register_post')) { ?>
				<div class="all-good">
				<?php _e( 'Cool! <a href="http://wordpress.org/extend/plugins/peters-custom-anti-spam-image/" target="_blank">Peter\'s Custom Anti-Spam</a>: Your comment form supports it', 'wptouch'); ?>
				</div>
			<?php } else { ?>
				<div class="sort-of">
				<?php _e( 'You don\'t have <a href="http://wordpress.org/extend/plugins/peters-custom-anti-spam-image/" target="_blank">Peter\'s Custom Anti-Spam</a> installed (Your commentform supports it)', 'wptouch' ); ?>
				</div>
			<?php } ?>
			
			<!-- flickr rss -->	  
			<?php if (function_exists('get_flickrRSS')) { ?>
				<div class="all-good">
				<?php _e( 'Cool! <a href="http://eightface.com/wordpress/flickrrss/" target="_blank">FlickrRSS</a>: Your photos will automatically show on a page called \'Photos\'.', 'wptouch' ); ?>
				</div>
			<?php } else { ?>
				<div class="sort-of">
				<?php _e( 'You don\'t have <a href="http://eightface.com/wordpress/flickrrss/" target="_blank">FlickrRSS</a> installed (No automatic photos page support)', 'wptouch' ); ?>
				</div>
			<?php } ?>
			
			<!-- blipit -->
			<?php if (function_exists('bnc_blipit_head')) { ?>
				<div class="all-good">
				<?php _e( 'Cool! <a href="http://www.bravenewcode.com/blipit/" target="_blank">Blip.it</a>: Your videos will automatically show on your posts in iPhone version.', 'wptouch' ); ?>
				</div>
			<?php } else { ?>
				<div class="sort-of">
				<?php _e( 'You don\'t have <a href="http://www.bravenewcode.com/blipit/" target="_blank">Blip.it</a> installed: (No automatic iPhone compatible video support)', 'wptouch' ); ?>
				</div>
			<?php } ?>
			
			<!-- wp cache -->		  
			<?php if (function_exists('wp_cache_is_enabled')) { ?>
				<div class="sort-of">
				<?php _e( '<a href="http://mnm.uib.es/gallir/wp-cache-2/" target="_blank">WP-Cache</a> active. If activated, add <em>ipod</em>, <em>iphone</em>, <em>android</em>, <em>dream</em>, <em>blackberry9500</em> and <em>blackberry9530</em> to the list of rejected user agents, then empty the plugin\'s cache.', 'wptouch' ); ?>
				</div>
			<?php } else { ?>
				<div class="all-good">
				<?php _e( '<a href="http://mnm.uib.es/gallir/wp-cache-2/" target="_blank">WP-Cache</a> inactive. If activated, add <em>ipod</em>, <em>iphone</em>, <em>android</em>, <em>dream</em>, <em>blackberry9500</em> and <em>blackberry9530</em> to the list of rejected user agents, then empty the plugin\'s cache.', 'wptouch' ); ?>
				</div>
			<?php } ?>
						
			<!-- wp super cache -->
			<?php if (function_exists('wp_super_cache_footer')) { ?>
				<div class="sort-of">
				<?php _e( '<a href="http://ocaoimh.ie/wp-super-cache/" target="_blank">WP Super Cache</a> If activated, enable "mobile support" and add <em>ipod</em>, <em>iphone</em>, <em>android</em>, <em>dream</em>, <em>blackberry9500</em> and <em>blackberry9530</em> to the list of rejected user agents, then empty the plugin\'s cache.', 'wptouch' ); ?>
				</div>
			<?php } else { ?>
				<div class="all-good">
				<?php _e( '<a href="http://ocaoimh.ie/wp-super-cache/" target="_blank">WP Super Cache</a> inactive. If activated, enable "mobile support" and add <em>ipod</em>, <em>iphone</em>, <em>android</em>, <em>dream</em>, <em>blackberry9500</em> and <em>blackberry9530</em> to the list of rejected user agents, then empty the plugin\'s cache.', 'wptouch' ); ?>
				</div>
			<?php } ?>
		</div><!-- right content -->
	<div class="wptouch-clearer"></div>
	</div><!-- postbox -->
</div><!-- metabox -->