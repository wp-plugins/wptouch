<?php require_once( ABSPATH . WPINC . '/feed.php' );
echo '<ul>';
if (function_exists('fetch_feed')) {
// Get a SimplePie feed object from the specified feed source.
$rss = fetch_feed('http://www.bravenewcode.com/support/rss/forum/wptouch');
if (!is_wp_error( $rss ) ) : // Checks that the object is created correctly 
    // Figure out how many total items there are, but limit it to 5. 
    $maxitems = $rss->get_item_quantity(6);
    $rss_items = $rss->get_items(0, $maxitems); endif; ?>

    <?php if ($maxitems == 0) echo '<li>No feed items found to display.</li>';
    else
    // Loop through each feed item and display each item as a hyperlink.
    foreach ( $rss_items as $item ) : ?>
    <li>
		<a target="_blank" class="orange-link" href='<?php echo $item->get_permalink(); ?>' title='<?php echo 'Posted '.$item->get_date('j F Y | g:i a'); ?>'>
			<?php echo $item->get_title(); ?>
		</a>
    </li>
    <?php endforeach; ?>
    <?php } else { ?>
    <li>No feed items found to display.</li>
    <?php } ?>
</ul>