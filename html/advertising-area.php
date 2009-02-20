<?php global $wptouch_settings; ?>

<div class="wptouch-itemrow">		
	<div class="double-box-one">
		<div class="wptouch-item-desc">
			<h2>Advertising Options</h2>
			
			<p>Enter your Google AdSense ID if you'd like to support mobile advertising in WPtouch posts.</p>
			<p>Make sure to include the 'pub-' part of your ID string.</p>
		</div>	
			
		<div class="wptouch-item-content-box1 wptouchstyle">
			<div class="header-item-desc">Google AdSense ID</div>
			<div class="header-input">#<input type="text" name="adsense-id" type="text" value="<?php echo $wptouch_settings['adsense-id']; ?>" /></div>
		</div>
	</div>
	
	<div class="double-box-two">
		<div class="wptouch-item-desc">
			<h2>Stats Tracking</h2>
	 		<p>If you'd like to capture traffic statistics (Google Analytics, MINT, Etc):</p>
	 		<p>Enter the code snippet(s) for your statistics tracking here.</p>
		</div>	
		<textarea name="statistics"><?php echo stripslashes($wptouch_settings['statistics']); ?></textarea>
	</div>
		
	<div class="wptouch-clearer"></div>
</div>