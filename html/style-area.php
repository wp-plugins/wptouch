<?php global $wptouch_settings; ?>

<div class="wptouch-itemrow wptouchbump">
	<div class="wptouch-item-desc">
		<h2><?php _e( "Style &amp; Color Options", "wptouch" ); ?></h2>
		<p><?php _e( "Customize the colors WPtouch will use for your website.", "wptouch" ); ?></p>
		<p><a href="http://www.colorpicker.com/" target="_blank"><?php _e( "Click here", "wptouch" ); ?></a> <?php _e( "to view a color picker to help you select your colors.", "wptouch" ); ?></p>
	</div>
		
	<div class="wptouch-item-content-box1 wptouchstyle">
		<div class="header-item-desc"><?php _e( "Header Title Text", "wptouch" ); ?> <small>(<?php _e( "here you can override your site title to fit the WPtouch header", "wptouch" ); ?>)</small></div>
		<div class="header-input">&nbsp; <input type="text" name="header-title" value="<?php $str = $wptouch_settings['header-title']; echo stripslashes($str); ?>" /></div>
	
		<div class="header-item-desc"><?php _e( "Logo & site title header background color", "wptouch" ); ?></div>
		<div class="header-input">#<input type="text" name="header-background-color" value="<?php echo $wptouch_settings['header-background-color']; ?>" /></div>
	
		<div class="header-item-desc"><?php _e( "Header 'Search, Login &amp; Menu' background color", "wptouch" ); ?> <small>(<?php _e( "dark colors work best", "wptouch" ); ?>)</small></div>
		<div class="header-input">#<input type="text" name="header-border-color" value="<?php echo $wptouch_settings['header-border-color']; ?>" /></div>
	
		<div class="header-item-desc"><?php _e( "Header Text Color", "wptouch" ); ?></div>
		<div class="header-input">#<input type="text" name="header-text-color" value="<?php echo $wptouch_settings['header-text-color']; ?>" /></div>
	
		<div class="header-item-desc"><?php _e( "Site-wide Link Color", "wptouch" ); ?> <small>(<?php _e( "the color for most of the links in WPtouch", "wptouch" ); ?>)</small></div>
		<div class="header-input">#<input type="text" name="link-color" value="<?php echo $wptouch_settings['link-color']; ?>" /></div>		
	</div>
	
	<div class="wptouch-clearer"></div>
</div>