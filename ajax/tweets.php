<?php require_once( ABSPATH . WPINC . '/rss.php' ); ?>

<?php $rss = @fetch_rss('http://search.twitter.com/search.atom?q=wptouch');
if ( isset($rss->items) && 0 != count($rss->items) ) { ?>
<ul>
	<?php $rss->items = @array_slice($rss->items, 0, 6); ?>
	<?php foreach ($rss->items as $item ) { ?>
	<li><a target="_blank" class="orange-link" href='<?php echo wp_filter_kses($item['link']); ?>'><?php echo wp_specialchars($item['title']); ?></a></li>
	<?php } ?>
</ul>
<?php } ?>