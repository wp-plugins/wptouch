<?php global $wptouch_settings; ?>

<div class="wptouch-itemrow newsblock">
	<div class="wptouch-item-desc">
		<h2>News &amp; Updates</h2>
		<p>BraveNewCode blog entries tagged 'WPtouch'.</p>
		<p>This list updates with the latest information about the plugin's development.</p>
	</div>
		
	<div class="wptouch-item-content-box1">
		<div id="wptouch-news-frame" style="display: none;"></div>

		<script type="text/javascript">
			jQuery.ajax({
				url: "<?php bloginfo('wpurl'); ?>/wp-content/plugins/wptouch/load-news.php",
				success: function(data) {
					jQuery("#wptouch-news-frame").html(data).fadeIn();
				}});
		</script>
	</div>
	
   <div id="wptouch-news-donate">
	  <h3>Donate To WPtouch</h3> 
	  
	  WPtouch represents hundreds of hours of development work. If you like the project and want to see it continue, please consider <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&amp;business=paypal%40bravenewcode%2ecom&amp;item_name=WPtouch%20Beer%20Fund&amp;no_shipping=1&amp;tax=0&amp;currency_code=CAD&amp;lc=CA&amp;bn=PP%2dDonationsBF&amp;charset=UTF%2d8">donating to WPtouch.</a><br /><br />
	  
	  Everyone who donates will be added to our WPtouch friends and family listing on <a href="http://www.bravenewcode.com/wptouch">bravenewcode.com/wptouch</a>, in appreciation for the support.
   </div>
	
	<div class="wptouch-clearer"></div>
	<div class="donate-spacer"></div>
</div>