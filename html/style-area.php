<?php global $wptouch_settings; ?>

<div class="wptouch-itemrow wptouchbump">
	<div class="wptouch-item-desc">
		<h2>Style &amp; Color Options</h2>
		<p>Customize the colors WPtouch will use for your website.</p>
		<p><a href="http://www.colorpicker.com/" target="_blank">Click here</a> to view a color picker to help you select your colors.</p>
	</div>
		
	<div class="wptouch-item-content-box1 wptouchstyle">
		<div class="header-item-desc">Header Title Text <small>(here you can override your site title to fit the WPtouch header)</small></div>
		<div class="header-input">&nbsp; <input type="text" name="header-title" value="<?php $str = $wptouch_settings['header-title']; echo stripslashes($str); ?>" /></div>
	
		<div class="header-item-desc">Logo & site title header background color</div>
		<div class="header-input">#<input type="text" name="header-background-color" value="<?php echo $wptouch_settings['header-background-color']; ?>" /></div>
	
		<div class="header-item-desc">Header 'Search, Login &amp; Menu' background color <small>(dark colors work best)</small></div>
		<div class="header-input">#<input type="text" name="header-border-color" value="<?php echo $wptouch_settings['header-border-color']; ?>" /></div>
	
		<div class="header-item-desc">Header Text Color</div>
		<div class="header-input">#<input type="text" name="header-text-color" value="<?php echo $wptouch_settings['header-text-color']; ?>" /></div>
	
		<div class="header-item-desc">Site-wide Link Color <small>(the color for most of the links in WPtouch)</small></div>
		<div class="header-input">#<input type="text" name="link-color" value="<?php echo $wptouch_settings['link-color']; ?>" /></div>		
	</div>
	
	<div class="wptouch-clearer"></div>
</div>