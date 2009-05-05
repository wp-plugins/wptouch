<div class="metabox-holder">
	<div class="postbox">

		<h3 class='hndle'><span><?php _e( "Home Page Redirection", "wptouch" ); ?></span></h3>

			<div class="wptouch-left-content">
			<p><?php echo sprintf( __( "For your home page, WPtouch respects the front page behavior you've defined in the %sWordPress &raquo; Reading Options%s.", "wptouch"), '<br /><a href="options-reading.php">', '</a>' ); ?></p>
			<p><?php _e( "If you'd like a different home page for your WPtouch mobile site", "wptouch" ); ?><br /><?php _e( "(your posts page for example) select it from the list below.", "wptouch" ); ?></p>
			</div>

			<div class="wptouch-right-content">
				<div class="wptouch-inside-content-left">
					<label for="home-page"><?php _e( "Override Home Page", "wptouch" ); ?></label>
				</div>		
				<div class="wptouch-inside-content-right">
					<?php wp_dropdown_pages( 'show_option_none=Default&name=home-page&selected=' . bnc_get_selected_home_page()); ?>
				</div>
			</div>

	</div>
<div class="wptouch-clearer"></div>
</div>