<?php global $wptouch_settings; ?>

<div id="wptouch-head">
	<div id="wptouch-head-title"><?php WPtouch(); ?></div>
	<div id="wptouch-head-links">
		<ul>
			<li><?php echo sprintf(__( "%sSupport Forums%s", "wptouch" ), '<a href="http://support.bravenewcode.com">','</a>'); ?> | </li>
			<li><?php echo sprintf(__( "%sWPtouch Homepage%s", "wptouch" ), '<a href="http://www.bravenewcode.com/wptouch">','</a>'); ?> | </li>
			<li><?php echo sprintf(__( "%sDonate%s", "wptouch" ), '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=paypal%40bravenewcode%2ecom&item_name=WPtouch%20Beer%20Fund&no_shipping=1&tax=0&currency_code=CAD&lc=CA&bn=PP%2dDonationsBF&charset=UTF%2d8">','</a>'); ?></li>
		</ul>
	</div>
	
	<div class="wptouch-clearer"></div>
	
	<div id="wptouch-news-beta">
	<div id="wptouch-news-content" style="display: none;"></div>
	<div id="wptouch-beta-content" style="display: none;"></div>
		<script type="text/javascript">
			jQuery.ajax({
				url: "<?php bloginfo('wpurl'); ?>/?wptouch=news",
				success: function(data) {
					jQuery("#wptouch-news-content").html(data).fadeIn();
				}});

			jQuery.ajax({
				url: "<?php bloginfo('wpurl'); ?>/?wptouch=beta",
				success: function(data) {
					jQuery("#wptouch-beta-content").html(data).fadeIn();
				}}); 
		</script>
	</div>
	<div class="wptouch-clearer"></div>
</div>