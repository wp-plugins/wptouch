<?php require_once( dirname(__FILE__) . '/../include/icons.php' ); ?>
<?php global $wptouch_settings; ?>

<div class="metabox-holder" id="available_icons">
	<div class="postbox">
		<h3><span class="icon-options">&nbsp;</span><?php _e( "Default &amp; Custom Icon Pool", "wptouch" ); ?></h3>

			<div class="left-content">
				<h4><?php _e( "Adding Icons", "wptouch" ); ?></h4>
				<p><?php _e( "To add icons to the pool, simply upload a .png, .jpeg or .gif image from your computer.", "wptouch" ); ?></p>

				<h4><?php _e( "Logo/Bookmark Icons", "wptouch" ); ?></h4>
				<p><?php _e( "If you're adding a logo icon, the best dimensions for it are 57x57px (png) when used as a bookmark icon.", "wptouch" ); ?></p>

				<h4><?php _e( "Glossy vs. Flat Bookmark Icons", "wptouch" ); ?></h4>
				<p><?php echo sprintf( __( "If you do not want your logo to have the glossy effect added to it, make sure you name it %sapple-touch-icon-precomposed.png%s", "wptouch"), "<strong>", "</strong>" ); ?></p>
				<p><?php echo sprintf( __( "Need help? You can use %sthis easy online icon generator%s to make one.", "wptouch"), "<a href='http://www.flavorstudios.com/iphone-icon-generator' target='_blank'>", "</a>" ); ?></p>
				<p><?php echo sprintf( __( "These files will be stored in the<br />%s%s/wptouch/custom-icons%s<br />folder we create.", "wptouch"), "<strong>", '' .get_option( 'upload_path' ). '', "</strong>" ); ?></p>
				<p><?php echo sprintf( __( "If an upload fails (usually it's a permission problem) check your wp-content path settings in WordPress' Miscellaneous Settings, or create the folder yourself using FTP and try again.", "wptouch"), "<strong>", "</strong>" ); ?></p>
						
				<div id="upload_button"></div>

			<div id="upload_response"></div>
				<div id="upload_progress" style="display:none">
					<p><img src="<?php echo compat_get_plugin_url( 'wptouch' ) . '/images/progress.gif'; ?>" alt="" /> <?php _e( "Uploading..."); ?></p>
				</div>
								
			</div><!-- left-content -->
		
	<div class="right-content">	
		<?php bnc_show_icons(); ?>
	</div>
	
	<div class="bnc-clearer"></div>
	</div><!-- postbox -->
</div><!-- metabox -->