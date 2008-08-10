<?php global $is_ajax; $is_ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']); if (!$is_ajax) get_header(); ?>
<div id="ajaxsinglepage<?php echo md5($_SERVER['REQUEST_URI']); ?>">
  <div class="content" id="content<?php echo md5($_SERVER['REQUEST_URI']); ?>">


		<!--If this is a search page, let's remind people, and help them out-->
			<?php global $is_ajax; if (is_search() && ($is_ajax)) { ?>
        <?php } elseif (is_search()) { ?>
        <div class="result-text">Search results for &lsquo;<?php the_search_query(); ?>&rsquo;:</div>
 	    <?php } ?>
		
		<!--If this is an archive page, let's remind people, and help them out-->
		<?php global $is_ajax; if ($is_ajax) { ?>
		<?php } elseif (is_archive()) { ?>

		<div class="result-text">Browsing <?php if (is_category()) { ?>
		the category &lsquo;<?php echo single_cat_title(); ?>&rsquo;
		
		<?php
		} elseif (is_tag()) { ?>
		the tag archive for &lsquo;<?php single_tag_title(); ?>&rsquo;
		
		<?php
		} elseif (is_day()) { ?> 
		the archive for <?php the_time('F jS, Y'); ?>
		
		<?php 
		} elseif (is_month()) { ?>
		the archive for <?php the_time('F, Y'); ?>
		
		<?php
		} elseif (is_year()) { ?>
		the archive for <?php the_time('Y'); ?>
		
		<?php
		} elseif (is_author()) { ?>
		<?php the_author(); ?>'s archive
		<?php } ?>
		</div>
		<?php } ?>

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<!--If It's NOT A Page, Let's Do The Comment Bubble Thing-->
 		<?php if (!is_page()) { ?>
	
		<?php if (function_exists('disqus_recent_comments')) { ?>
		<!--We don't want DISQUS to show anything here, it doesn't look nice-->
			<?php } else { ?>
			<!--Show the Comment Bubble (not on pages, this exists for index. archive, tag and category stuff)-->
			<?php if (isset($post->comment_count) && $post->comment_count > 0) { ?>
			<div class="comment-bubble<?php if ($post->comment_count > 99) echo('-big'); ?>">
			<?php comments_number('0', '1', '%'); ?>
			</div>
			<?php } ?><?php } ?>		
	<?php } ?><!--Not a page stuff ends-->

 <div class="post" id="post-<?php the_ID(); ?>">
 
<!--If it's a page, we want things to be a little different, especially on photo, archive and links pages-->
<?php if (is_page()) { ?>
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
          <?php wp_list_categories(); // This will print out the default WordPress Categories Listing. ?>                
          <?php } ?>
		  </div>
	</div>
</div>

          <h3 class="result-text-page">Monthly Archives</h3>
          <div id="wptouch-archives">
           <?php wp_get_archives(); // This will print out the default WordPress Monthly Archives Listing. ?> 
          </div>
            <?php } ?>    
            
                <?php if (is_page('photos')) {
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

            
<?php if (is_page('links')) {
// If you have a page named 'Links', a default listing of your Links will be displayed here.
?>
	</div>
</div>
              
              <h3 class="result-text-page">(Alphabetical Order)</h3>
              <div id="wptouch-links">
                  <?php foreach (get_bookmarks('categorize=0&title_li=0') as $bm) {
                  echo('<li>');
                  echo('<img src="http://hdrcore.com/code/favicon.php?site=' . urlencode($bm->link_url) . '&default=' . urlencode(bnc_get_local_icon_url() . '/icon-pool/Default.png') . '" />');
                  echo('<a href="' . $bm->link_url . '">' . $bm->link_name . '</a>');
                  echo('</li>'); } ?>
                </div>
            <?php } ?>    		
	</div>    
</div>
  
			<?php } else { ?><!--Page close, start the rest of things-->
	
					<?php if (bnc_is_js_enabled()) { ?>
                    <a class="post-arrow" id="arrow-<?php the_ID(); ?>" href="javascript:new Effect.toggle($('entry-<?php the_ID(); ?>'),'Appear', {duration: 0.5});Element.setStyle('arrow-<?php the_ID(); ?>', {display:'none'} );Element.setStyle('arrow-down-<?php the_ID(); ?>', {display:'block'} );"></a>
					<?php } else { ?>
                    <a class="post-arrow" id="arrow-<?php the_ID(); ?>" href="javascript:document.getElementById('entry-<?php the_ID(); ?>').style.display = 'block';document.getElementById('arrow-<?php the_ID(); ?>').style.display = 'none';document.getElementById('arrow-down-<?php the_ID(); ?>').style.display = 'block';"></a>
					<?php } ?>
					
                    <?php if (bnc_is_js_enabled()) { ?>
					<a class="post-arrow-down" id="arrow-down-<?php the_ID(); ?>" href="javascript:new Effect.toggle($('entry-<?php the_ID(); ?>'),'Appear', {duration: 0.5});Element.setStyle('arrow-<?php the_ID(); ?>', {display:'block'} );Element.setStyle('arrow-down-<?php the_ID(); ?>', {display:'none'} );" style="display:none"></a>
                    <?php } else { ?>
					 <a style="display:none" class="post-arrow-down" id="arrow-down-<?php the_ID(); ?>" href="javascript:document.getElementById('entry-<?php the_ID(); ?>').style.display = 'none';document.getElementById('arrow-<?php the_ID(); ?>').style.display = 'block';document.getElementById('arrow-down-<?php the_ID(); ?>').style.display = 'none';"></a>
                    <?php } ?>
                    
						<div class="calendar" style="background: url(<?php bloginfo('template_directory'); ?>/images/cal/month<?php the_time('n') ?>.png) no-repeat;">
						<div class="cal-month"><?php the_time('M') ?></div>
						<div class="cal-date"><?php the_time('j') ?></div>
						</div>
      
<a class="h2" href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php if (function_exists('the_title_attribute')) the_title_attribute(); else the_title(); ?>"><?php if (function_exists('bnc_the_title')) bnc_the_title(); else the_title(); ?></a>
			<div class="post-author">
			<?php if (bnc_show_author()) { ?><span class="lead">Author:</span> <?php the_author(); ?><br /><?php } ?>
			<?php if (function_exists('wp_tag_cloud')) { ?>
			<?php if (bnc_show_categories()) { echo('<span class="lead">Categories:</span> '); the_category(', '); echo('<br />'); } ?> 
			<?php if (bnc_show_tags() && get_the_tags()) { echo(''); the_tags('<span class="lead">Tags:</span> ', ', ', ''); echo(''); } ?> 
			<?php } else { ?>
			Filed:<?php the_category(', '); ?><?php } ?>
			</div>
					
			<div class="clearer"></div>

            <div id="entry-<?php the_ID(); ?>" style="display:none" class="mainentry">
            <?php the_content_rss('', false, '', 50); ?>
		    <a href="<?php the_permalink() ?>">Read More &raquo;</a>
					
        </div>  
      </div>
<?php } ?> <!--End of the if page or else code-->

    <?php endwhile; ?>

<?php if (!is_page()) { ?><!--If it's an index page, let's do these things-->

				<?php if (bnc_is_js_enabled()) { ?>
				<div id="call<?php echo md5($_SERVER['REQUEST_URI']); ?>">
				<a class="ajax" href="javascript:new Effect.Appear('spinner<?php echo md5($_SERVER['REQUEST_URI']); ?>', {duration:0.2});new Ajax.Updater('ajaxentries<?php
				echo md5($_SERVER['REQUEST_URI']); ?>', '<?php echo get_next_posts_page_link(); ?>', {onComplete:function(){ new Effect.Fade('call<?php echo md5($_SERVER['REQUEST_URI']); ?>', {delay:1, duration:.5});}, asynchronous:true});">Load more entries...</a> <img id="spinner<?php echo md5($_SERVER['REQUEST_URI']); ?>" class="spin" src="<?php bloginfo('template_directory'); ?>/images/main-ajax-loader.gif" style="display:none" alt="" />
				<div class="post-spacer"></div>
				<div class="clearer"></div>
				</div>				
				<div id="ajaxentries<?php echo md5($_SERVER['REQUEST_URI']); ?>"></div>
				</div>
		
				<?php } elseif (!bnc_is_js_enabled() && is_search()) { ?>
				<div class="main-navigation">
				<div class="alignleft"><?php previous_posts_link('<img src="' . get_bloginfo('template_directory') . '/images/blue_arrow_l.png" alt="" /> Newer In Search') ?></div>
				<div class="alignright"><?php next_posts_link('Older In Search <img src="' . get_bloginfo('template_directory') . '/images/blue_arrow_r.png" alt="" />') ?></div>
				</div>

				<?php } elseif (!bnc_is_js_enabled() && !is_search()) { ?>
				
				<div class="main-navigation">
				<div class="alignleft"><?php previous_posts_link('<img src="' . get_bloginfo('template_directory') . '/images/blue_arrow_l.png" alt="" /> Newer Entries') ?></div>
				<div class="alignright"><?php next_posts_link('Older Entries <img src="' . get_bloginfo('template_directory') . '/images/blue_arrow_r.png" alt="" />') ?></div>
				</div>
				<?php } ?>
		<?php } ?>

<?php else : ?><!--If this was a bogus 404 page, the end of entry results, or a search -->

	<?php global $is_ajax; if (($is_ajax) && !is_search()) { ?>
	  <div class="result-text">No more entries to display.</div>
	 <?php } elseif (is_search() && ($is_ajax)) { ?>
	<div class="result-text">No more search results to display.</div>
	 <?php } elseif (is_search()) { ?>
	 <div class="result-text">No search results results found. Try another query.</div>
	<?php } else { ?>
	  <div class="result-text">No entries found. Try using the search to find what you were looking for.</div>
	<?php } ?>

  <?php endif; ?>
</div>
<?php global $is_ajax; if (!$is_ajax) get_footer(); ?>