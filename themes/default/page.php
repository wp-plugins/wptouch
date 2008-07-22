<?php get_header(); ?>

  <div id="content" class="content">

<?php if (have_posts()) : ?>
               <?php while (have_posts()) : the_post(); ?>
					<div class="post" id="post-<?php the_ID(); ?>">

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
						$icon_name = 'default.png';
						}
						echo('<img class="pageicon" src="' . get_bloginfo('wpurl') . '/wp-content/plugins/wptouch/images/icon-pool/' . $icon_name . '" />');
						?> 
						</div>
						<h2><?php if (function_exists('bnc_the_title')) bnc_the_title(); else the_title(); ?></h2>
						</div>
      
  <div class="clearer"></div>
  
    <div id="entry-<?php the_ID(); ?>" class="pageentry">
        <?php if (function_exists('bnc_the_content')) bnc_the_content(); else the_content(); ?>  
  
            <?php if (is_page('archives')) {
      // If you have a page named 'Archives', the WP tag cloud will be displayed below your content. Simply remove this wrapper. 
	  		?>
          </div>
  </div>
          
                <?php if (function_exists('wp_tag_cloud')) { ?>
                <h3 class="result-text-page">Tag Cloud</h3>
            	<div id="wptouch-tagcloud">
              	<?php wp_tag_cloud('smallest=11&largest=18&unit=px&orderby=count&order=DESC'); ?>
              <?php } else { ?>
            <h3 class="result-text-page">Category Cloud</h3>
            <div id="wptouch-tagcloud">
          <?php
              // This will print out the default WordPress Categories Listing.
              wp_list_categories(); ?>                
          <?php } ?>
          </div>
          
          </div></div>
          <h3 class="result-text-page">Monthly Archives</h3>
          <div id="wptouch-archives">
           <?php
          // This will print out the default WordPress Monthly Archives Listing.
          wp_get_archives(); ?> 
          </div>
            <?php } ?>    
            
                <?php
      if (is_page('photos')) {
          // If you have a page named 'Photos', and the FlickrRSS activated and configured your photos will be displayed here.
          // It will override other number of images settings and fetch 20 from the ID.
?>
              <div id="wptouch-flickr">
              <?php if (function_exists('get_flickrRSS')) { ?>
              <?php get_flickrRSS(20); ?>
              <?php } else { ?>
            You need to install the <a href="http://eightface.com/wordpress/flickrrss/" rel="nofollow">FlickrRSS plugin</a> to unlock the beauty of this page.        
             Edit the theme file page.php to remove this message.
              <?php } ?>
              </div>
				<?php } ?>    

            
                      <?php
          if (is_page('links')) {
              // If you have a page named 'Links', a default listing of your Links will be displayed here.
?>
              </div>
			  </div>
              
              <h3 class="result-text-page">(Alphabetical Order)</h3>
              <div id="wptouch-links">
                  <?php
              foreach (get_bookmarks('categorize=0&title_li=0') as $bm) {
                  echo('<li>');
                  echo('<img src="http://hdrcore.com/code/favicon.php?site=' . urlencode($bm->link_url) . '&default=' . urlencode(bnc_get_local_icon_url() . '/icon-pool/Default.png') . '" />');
                  echo('<a href="' . $bm->link_url . '">' . $bm->link_name . '</a>');
                  echo('</li>');
              }
?>
                </div>
            <?php } ?>    
			
  </div>    
  </div>
  
  <?php endwhile; ?>
  <?php else : ?>
    <div id="fourohfour"><img src="<?php bloginfo('template_directory'); ?>/images/404.png" alt="" /></div>
  <?php endif; ?>
  </div>
<?php get_footer(); ?>