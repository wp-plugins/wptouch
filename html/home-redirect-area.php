<?php global $wptouch_settings; ?>

<div class="metabox-holder">
	<div class="postbox">
		<h3><?php _e( "Home Page Redirection", "wptouch" ); ?></h3>

			<div class="wptouch-left-content">
				<p><?php echo sprintf( __( "For your home page, WPtouch respects the front page behavior you've defined in the %sWordPress &raquo; Reading Options%s.", "wptouch"), '<br /><a href="options-reading.php">', '</a>' ); ?></p>
			</div>

			<div class="wptouch-right-content">
				<p><label for="home-page"><strong><?php _e( "Override Home Page", "wptouch" ); ?></strong></label></p>
				<p><?php _e( "If you'd like a different home page for your WPtouch mobile site", "wptouch" ); ?><br />
				<?php _e( "(your posts page for example) select it from the list below.", "wptouch" ); ?></p>
				<p>
				<?php if ( count( $pages ) ) { ?>
					<?php wp_dropdown_pages( 'show_option_none=WordPress Settings&name=home-page&selected=' . bnc_get_selected_home_page()); ?>
				<?php } else {?>
					<strong class="no-pages"><?php _e( "You have no pages yet. Create some first!", "wptouch" ); ?></strong>
				<?php } ?>
				</p>
			</div>
			
	<div class="wptouch-clearer"></div>
	</div><!-- postbox -->
</div><!-- metabox -->
