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
						<li><?php echo sprintf(__( "%sGet WPtouch Pro%s", "wptouch" ), '<a href="http://www.bravenewcode.com/wptouch/?utm_source=wptouch&amp;utm_medium=web&amp;utm_campaign=top-' . str_replace( '.', '', $bnc_wptouch_version ) . '" target="_blank">','</a>'); ?> | </li>
						<li><?php echo sprintf(__( "%sFollow Us on Twitter%s", "wptouch" ), '<a href="http://www.twitter.com/bravenewcode" target="_blank">','</a>'); ?></li> |
						<li><?php echo sprintf(__( "%sFind Us on Facebook%s", "wptouch" ), '<a href="http://www.facebook.com/bravenewcode" target="_blank">','</a>'); ?></li>
					</ul>
				</div>
	<div class="bnc-clearer"></div>
			</div>	
			<p>
				<a href="http://www.bravenewcode.com/wptouch/?source=wptouch1"><img class="wptp3" src="<?php echo compat_get_plugin_url('wptouch'); ?>/images/wptouch-ad.jpg" alt="advertisement"/></a>
			</p>
	<div class="bnc-clearer"></div>
	</div><!-- postbox -->
</div><!-- wptouch-head -->
