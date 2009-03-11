<?php global $wptouch_settings; ?>

<div class="wptouch-itemrow newsblock">
	<div class="wptouch-item-desc">
		<h2><?php _e( "News &amp; Updates", "wptouch" ); ?></h2>
		<p><?php _e( "BraveNewCode blog entries tagged 'WPtouch'.", "wptouch" ); ?></p>
		<p><?php _e( "This list updates with the latest information about the plugin's development.", "wptouch" ); ?></p>
		<p class="callout"><strong><?php _e( "Interested in helping us internationalize WPtouch?" ); ?></strong><br /><br /><?php echo sprintf(__( "Send us an %se-mail%s telling us what language(s) you're fluent in.", "wptouch" ), '<a href="mailto:wptouch@bravenewcode.com">','</a>'); ?></p>
	</div>
		
	<div class="wptouch-item-content-box1">
		<div id="wptouch-news-frame" style="display: none;"></div>


		<script type="text/javascript">
			jQuery.ajax({
				url: "<?php bloginfo('wpurl'); ?>/wp-content/plugins/wptouch/load-news.php",
				success: function(data) {
					jQuery("#wptouch-news-frame").html(data).fadeIn();
				}});

			jQuery.ajax({
				url: "<?php bloginfo('wpurl'); ?>/wp-content/plugins/wptouch/load-news.php?donations=1",
				success: function(data) {
					jQuery("#wptouch-donation-frame").html(data).fadeIn();
				}});
		</script>


		
	</div>
	
   <div id="wptouch-news-donate">
	  <h3><?php _e( "Donate To WPtouch", "wptouch" ); ?></h3> 
	  
	  <?php echo sprintf( __( "WPtouch represents hundreds of hours of development work. If you like the project and want to see it continue, %splease consider donating to WPtouch%s.", "wptouch"), '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&amp;business=paypal%40bravenewcode%2ecom&amp;item_name=WPtouch%20Beer%20Fund&amp;no_shipping=1&amp;tax=0&amp;currency_code=CAD&amp;lc=CA&amp;bn=PP%2dDonationsBF&amp;charset=UTF%2d8">', '</a>' ); ?><br /><br />
	  
	  <?php echo sprintf( __( "Everyone who donates will be added to our WPtouch friends and family listing on %sbravenewcode.com/wptouch%s, in appreciation for the support.", "wptouch"), '<a href="http://www.bravenewcode.com/wptouch">', '</a>' ); ?>

	<!-- <h3><?php _e( "Last Donations", "wptouch" ); ?></h3>		
	<ul id="wptouch-donation-frame" style="display: none;"></ul> -->
   </div>
	
	<div class="wptouch-clearer"></div>
	<div class="donate-spacer"></div>
</div>
