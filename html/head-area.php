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
						<li><?php echo sprintf(__( "%sDownload User's Guide%s", "wptouch" ), '<a href="http://bravenewcode.s3.amazonaws.com/wptouch/WPtouch%201.9.x%20Installation%20Guide.pdf">','</a>'); ?> | </li>
						<li><?php echo sprintf(__( "%sUpgrade to WPtouch Pro%s", "wptouch" ), '<a href="http://www.bravenewcode.com/wptouch/?utm_source=wptouch-free&amp;utm_medium=web&amp;utm_campaign=top-' . str_replace( '.', '', $bnc_wptouch_version ) . '" target="_blank">','</a>'); ?> | </li>
						<li><?php echo sprintf(__( "%sWPtouch on Twitter%s", "wptouch" ), '<a href="http://www.twitter.com/bravenewcode" target="_blank">','</a>'); ?> | </li>
						<li><?php echo sprintf(__( "%sWPtouch on Facebook%s", "wptouch" ), '<a href="http://www.facebook.com/bravenewcode" target="_blank">','</a>'); ?></li>
					</ul>
				</div>
	<div class="bnc-clearer"></div>
			</div>	
			<p>
				<a class="wptouch-text" href="http://www.bravenewcode.com/wptouch/?utm_source=wptouch-free&amp;utm_medium=web&amp;utm_campaign=top-<?php echo str_replace( '.', '', $bnc_wptouch_version ); ?>" target="_blank">
					<img src="http://bravenewcode.s3.amazonaws.com/wptouch/text.png" alt="wptouch advertisement" />
					<img class="wptouch-phones" src="http://bravenewcode.s3.amazonaws.com/wptouch/phones.png" alt="wptouch advertisement" />
				</a>
			</p>
	<div class="bnc-clearer"></div>
	</div><!-- postbox -->
</div><!-- wptouch-head -->
