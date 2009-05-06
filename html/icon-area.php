<?php require_once( compat_get_plugin_dir( 'wptouch' ) . '/include/icons.php' ); ?>
<?php global $wptouch_settings; ?>

<div class="metabox-holder">
	<div class="postbox">
		<h3 class='hndle'><span><?php _e( "Available Icons", "wptouch" ); ?></span></h3>

			<div class="wptouch-left-content">
				<p><?php _e( "You can select which icons will be displayed beside pages enabled below", "wptouch" ); ?></p>
				<p><?php _e( "To add icons to the pool, simply upload a 60x60 .png, .jpeg or .gif from your computer.", "wptouch" ); ?></p>
				<p><?php echo sprintf( __( "These files will be stored in %s/uploads/wptouch/custom-icons/%s", "wptouch"), "<strong>", "</strong>" ); ?></p>
				<div id="upload_response"></div>
				<div id="upload_progress" style="display: none;">
					<p><img src="<?php echo compat_get_plugin_url( 'wptouch' ) . '/images/progress.gif'; ?>" alt="" /></p>
				</div>
				<script type="text/javascript">
					$j = jQuery.noConflict();
					$j(document).ready(function(){
						new Ajax_upload('#upload_button', {
							action: '<?php echo get_bloginfo('wpurl'); ?>/?wptouch=upload',
							autoSubmit: true,
							name: 'submitted_file',
							onSubmit: function(file, extension) { $j = jQuery.noConflict(); $j("#upload_progress").show(); },
							onComplete: function(file, response) { $j = jQuery.noConflict(); $j("#upload_progress").hide();
							$j('#upload_response').hide().html(response).fadeIn(); }
						});
					$j("a.wptouch-fancylink").fancybox({
						'padding':						8,
						'imageScale':					true,
						'zoomSpeedIn':				300, 
						'zoomSpeedOut':			300,
						'zoomOpacity':				true, 
						'overlayShow':				false,
						'frameHeight':				250,
						'hideOnContentClick': 	false
					});
				});
				</script>
					
				<div id="upload_button"></div> 
					
				<p><?php _e( "Need help getting started?", "wptouch" ); ?></p>
				<p><?php echo sprintf(__( 'Download our %s Photoshop template%s which you can use to build custom icons WPtouch style.', 'wptouch'), '<strong><a href="' . compat_get_plugin_dir( 'wptouch' ) . '/images/icon-pool/template.psd">', '</a></strong>' ); ?></p>			
			</div><!-- wptouch-left-content -->
		
	<div class="wptouch-right-content">	
		<?php bnc_show_icons(); ?>
	</div>
	
			
	<div class="wptouch-clearer"></div>
	</div><!-- postbox -->
</div><!-- metabox -->