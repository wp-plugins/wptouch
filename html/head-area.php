<?php global $wptouch_settings; ?>
<?php global $bnc_wptouch_version; ?>

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
					<?php if ( function_exists( 'curl_init' ) ) { include_once (ABSPATH . WPINC . '/rss.php');
								$feed = fetch_rss('http://www.bravenewcode.com/tag/wptouch/rss'); // specify feed url
								$items = array_slice($feed->items, 0, 5); // specify first and last item
					?>
					<ul>
						<?php if (!empty($items)) : ?>
						<?php foreach ($items as $item) : ?>
							<li><a target="_blank" class="orange-link" href='<?php echo $item['link']; ?>'><?php echo $item['title']; ?></a></li>
						<?php endforeach; ?>
						<?php endif; ?>
					</ul>
					<?php } else { ?>
						<p><?php echo sprintf(__( "%sCURL is required%s on your webserver to load RSS feeds.", "wptouch" ), '<a href="http://en.wikipedia.org/wiki/CURL" target="_blank">','</a>'); ?></p>
					<?php } ?>
				</div>
			</div>

			<div id="wptouch-support-wrap">			
			<h3><span class="rss-head">&nbsp;</span><?php _e( "Twitter Topics", "wptouch" ); ?></h3>
				<div id="wptouch-support-content">
					<?php if ( function_exists( 'curl_init' ) ) { include_once (ABSPATH . WPINC . '/rss.php');
								$feed = fetch_rss('http://search.twitter.com/search.atom?q=wptouch'); // specify feed url
								$items = array_slice($feed->items, 0, 5); // specify first and last item
					?>
					<ul>
						<?php if (!empty($items)) : ?>
						<?php foreach ($items as $item) : ?>
							<li><a target="_blank" class="orange-link" href='<?php echo $item['link']; ?>'><?php echo $item['title']; ?></a></li>
						<?php endforeach; ?>
						<?php endif; ?>
					</ul>
					<?php } ?>
				</div>
			</div>
			
		</div><!-- wptouch-news-support -->

	<div class="bnc-clearer"></div>
	</div><!-- postbox -->
</div><!-- wptouch-head -->