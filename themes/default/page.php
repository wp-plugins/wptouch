<?php global $is_ajax; $is_ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']); if (!$is_ajax) get_header(); ?>
<?php $wptouch_settings = bnc_wptouch_get_settings(); ?>
 <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
 	<div class="post content" id="post-<?php the_ID(); ?>">
	 <div class="page">
		<div class="page-title-icon">
		<?php
			$icon_name = strtolower($post->post_title) . '.png';
			$mypages = bnc_wp_touch_get_pages();
		
			if (isset($mypages[get_the_ID()])) {
				$icon_name = $mypages[get_the_ID()]['icon'];
			}
		
			$dir = preg_split("#/plugins/wptouch#", __FILE__, $test);
			if (!file_exists($dir[0] . '/plugins/wptouch/images/icon-pool/' . $icon_name)) {
				$icon_name = 'Default.png';
			}
			echo('<img class="pageicon" src="' . compat_get_plugin_url( 'wptouch' ) . '/images/icon-pool/' . $icon_name . '" />');
		?> 
		</div>
			<h2><?php if (function_exists('bnc_the_title')) bnc_the_title(); else the_title(); ?></h2>
	</div>
	      
<div class="clearer"></div>
  
    <div id="entry-<?php the_ID(); ?>" class="pageentry <?php echo $wptouch_settings['style-text-size']; ?> <?php echo $wptouch_settings['style-text-justify']; ?>">
        <?php the_content(); ?>  
<?php if (is_page('archives')) {
// If you have a page named 'Archives', the WP tag cloud will be displayed below your content. Simply remove this wrapper. 
?>
          </div>
  </div>
          
                <?php if (function_exists('wp_tag_cloud')) { ?>
                <h3 class="result-text"><?php _e( "Tag Cloud", "wptouch" ); ?></h3>
            	<div id="wptouch-tagcloud">
              	<?php wp_tag_cloud('smallest=11&largest=18&unit=px&orderby=count&order=DESC'); ?>
              <?php } else { ?>

            <h3 class="result-text"><?php _e( "Category Cloud", "wptouch" ); ?></h3>
          <div id="wptouch-tagcloud">
          <?php wp_list_categories(); // This will print out the default WordPress Categories Listing. ?>                
          <?php } ?>
		  </div>
	</div>
</div>

          <h3 class="result-text"><?php _e( "Monthly Archives", "wptouch" ); ?></h3>
          <div id="wptouch-archives">
           <?php wp_get_archives(); // This will print out the default WordPress Monthly Archives Listing. ?> 
          </div>
		  
<?php } ?><!-- end if archives page-->
            
<?php if (is_page('photos')) {
// If you have a page named 'Photos', and the FlickrRSS activated and configured your photos will be displayed here.
// It will override other number of images settings and fetch 20 from the ID.
?>
	<?php if (function_exists('get_flickrRSS')) { ?>
		<div id="wptouch-flickr">
			<?php get_flickrRSS(20); ?>
		</div>
	<?php } else { ?>
<!-- do nothing... maybe they have a different look for the photos page themselves-->
	<?php } ?>
<?php } ?><!-- end if photos page-->
           		
<?php if (is_page('links')) {
// If you have a page named 'Links', a default listing of your Links will be displayed here.
?>
		</div>
	</div>          

	<h3 class="result-text">(<?php _e( "Alphabetical Order", "wptouch" ); ?>)</h3>
		<div id="wptouch-links">
			<?php foreach (get_bookmarks('categorize=0&title_li=0') as $bm) { echo('<li>'); echo('<img src="http://bravenewcode.com/code/favicon.php?site=' . urlencode($bm->link_url) . '&default=' . urlencode(bnc_get_local_icon_url() . '/icon-pool/Default.png') . '" />'); echo('<a href="' . $bm->link_url . '">' . $bm->link_name . '</a>'); echo('</li>'); } ?>
		</div>
<?php } ?><!-- end if links page-->    	
	
		<?php wp_link_pages( __('Pages in this article: ', 'wptouch'), '', 'number'); ?>
	</div>    
</div>
    
<!--If comments are enabled for pages in the WPtouch admin, and 'Allow Comments' is checked on a page-->
	<?php if (bnc_is_page_coms_enabled() && 'open' == $post->comment_status) : ?>
		<?php comments_template(); ?>
  	<?php endif; ?>
<!--end comment status-->
    <?php endwhile; ?>	

<?php else : ?>
	<?php global $is_ajax; if (($is_ajax) && !is_search()) { ?>
	  <div class="result-text-footer"><?php _e( "No more entries to display.", "wptouch" ); ?></div>
	 <?php } elseif (is_search() && ($is_ajax)) { ?>
	<div class="result-text-footer"><?php _e( "No more search results to display.", "wptouch" ); ?></div>
	 <?php } elseif (is_search() && (!$is_ajax)) { ?>
	 <div class="result-text-footer" style="padding-bottom:127px"><?php _e( "No search results results found.", "wptouch" ); ?><br /><?php _e( "Try another term.", "wptouch" ); ?></div>
	<?php } else { ?>
	  <div class="post">
	  	<h2><?php _e( "404 Not Found", "wptouch" ); ?></h2>
	  	<p><?php _e( "The page or post you were looking for is missing or has been removed.", "wptouch" ); ?></p>
	  </div>
	<?php } ?>

 <?php endif; ?>

<!-- Here we're establishing whether the page was loaded via Ajax or not, for dynamic purposes. If it's ajax, we're not bringing in footer.php -->
<?php global $is_ajax; if (!$is_ajax) get_footer(); ?>