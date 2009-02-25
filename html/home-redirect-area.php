
<div class="wptouch-itemrow home-page-block">
	<div class="wptouch-item-desc">
		<h2><?php _e( "Home Page Redirection", "wptouch" ); ?></h2>
		<p><?php _e( sprintf( "For your home page, WPtouch respects the front page behavior you've defined in the %sWordPress -> Reading Options%s.", '<a href="options-reading.php">', '</a>' ), "wptouch" ); ?></p>
	</div>

	<div class="wptouch-item-content-box1">
		<div class="header-item-desc">
			<?php _e( "If you'd like a different home page (your posts page for example)", "wptouch" ); ?><br /><?php _e( "select it from the list below.", "wptouch" ); ?><br /><br />
		</div>
	
		<div class="wptouch-select-row">
			<div class="wptouch-select-left">
				<label for="home-page"><?php _e( "Override Home Page", "wptouch" ); ?></label>
			</div>
			
			<div class="wptouch-select-right">
				<?php wp_dropdown_pages( 'show_option_none=Default&name=home-page&selected=' . bnc_get_selected_home_page()); ?>
			</div>
		</div>
	
		<div class="clear"></div>
	</div>
</div>

