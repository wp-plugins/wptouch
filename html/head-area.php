<?php global $wptouch_settings; ?>
<?php global $bnc_wptouch_version; ?>

<?php include( ABSPATH . WPINC . '/rss.php' ); ?>

<div class="metabox-holder" id="wptouch-head">
	<div class="postbox">
		<div id="wptouch-head-colour">
			<div id="wptouch-head-title">
				<?php WPtouch(); ?>
				<img class="ajax-load" src="<?php echo compat_get_plugin_url('wptouch'); ?>/images/admin-ajax-loader.gif" alt="ajax"/>
			</div>
				<div id="wptouch-head-links">
					<ul>
						<!-- <li><?php echo sprintf(__( "%sSupport Forums%s", "wptouch" ), '<a href="http://support.bravenewcode.com/forum/wptouch" target="_blank">','</a>'); ?> | </li> -->
						<li><?php echo sprintf(__( "%sWPtouch Homepage%s", "wptouch" ), '<a href="http://www.bravenewcode.com/wptouch" target="_blank">','</a>'); ?> | </li>
						<li><?php echo sprintf(__( "%sSupport Forums%s", "wptouch" ), '<a href="http://www.bravenewcode.com/support/" target="_blank">','</a>'); ?> | </li>
						<li><?php echo sprintf(__( "%sNewsletter%s", "wordtwit" ), '<a href="http://www.bravenewcode.com/newsletter" target="_blank">','</a>'); ?> | </li>
						<li><?php echo sprintf(__( "%sDonate%s", "wptouch" ), '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&amp;business=paypal%40bravenewcode%2ecom&amp;item_name=WPtouch%20Beer%20Fund&amp;no_shipping=1&amp;tax=0&amp;currency_code=CAD&amp;lc=CA&amp;bn=PP%2dDonationsBF&amp;charset=UTF%2d8" target="_blank">','</a>'); ?></li>
					</ul>
				</div>
	<div class="bnc-clearer"></div>
			</div>	
	
		<div id="wptouch-news-support">

			<div id="wptouch-news-wrap">
			<h3><span class="rss-head">&nbsp;</span><?php _e( "WPtouch Wire", "wptouch" ); ?></h3>
				<div id="wptouch-news-content">
					<?php $feed = fetch_rss('http://www.bravenewcode.com/tag/wptouch/feed/rss/'); ?>
					<?php $items = array_slice($feed->items, 0, 5); ?>
					<ul>
						<?php if (!empty($items)) : ?>
						<?php foreach ($items as $item) : ?>
							<li><a target="_blank" class="orange-link" href='<?php echo $item['link']; ?>'><?php echo $item['title']; ?></a></li>
						<?php endforeach; ?>
						<?php endif; ?>
					</ul>
				</div>
			</div>

			<div id="wptouch-support-wrap">			
			<h3><span class="rss-head">&nbsp;</span><?php _e( "Twitter Topics", "wptouch" ); ?></h3>
				<div id="wptouch-support-content">
					<?php $feed = fetch_rss('http://search.twitter.com/search.atom?q=wptouch'); ?>								
					<?php $items = array_slice($feed->items, 0, 5); ?>
					<ul>
						<?php if (!empty($items)) : ?>
						<?php foreach ($items as $item) : ?>
							<li><a target="_blank" class="orange-link" href='<?php echo $item['link']; ?>'><?php echo $item['title']; ?></a></li>
						<?php endforeach; ?>
						<?php endif; ?>
					</ul>
				</div>
			</div>
			
		</div><!-- wptouch-news-support -->

	<div class="bnc-clearer"></div>
	</div><!-- postbox -->
</div><!-- wptouch-head -->