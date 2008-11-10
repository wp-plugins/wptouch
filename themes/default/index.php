<?php global $is_ajax; $is_ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']); if (!$is_ajax) get_header(); ?>
<!--
There's a lot going on in this file, as we've condensed several templates into the one index.php file... let's rock...

Here we're making sure that each ajax div will have a unique ID. 
-->
<div class="content" id="content<?php echo md5($_SERVER['REQUEST_URI']); ?>">

<!--
If this is a search page, let's remind people, and help them out
-->
		<?php global $is_ajax; if (is_search() && ($is_ajax)) { ?>
        <!--do nothing-->
		<?php } elseif (is_search()) { ?>
        <div class="result-text">Search results for &lsquo;<?php the_search_query(); ?>&rsquo;:</div>
 	    <?php } ?>
		
<!--
If this is an archive/tag/category/author archive page, let's remind people, and help them out
-->
		<?php global $is_ajax; if ($is_ajax) { ?>
        <!--do nothing-->
		<?php } elseif (is_archive()) { ?>

		<div class="result-text">Browsing <?php if (is_category()) { ?>
		the category &lsquo;<?php echo single_cat_title(); ?>&rsquo;
		
		<?php
		} elseif (is_tag()) { ?>
		the tag archive for &lsquo;<?php echo single_tag_title(); ?>&rsquo;
		
		<?php
		} elseif (is_day()) { ?> 
		the archive for <?php echo get_the_time('F jS, Y'); ?>
		
		<?php 
		} elseif (is_month()) { ?>
		the archive for <?php echo get_the_time('F, Y'); ?>
		
		<?php
		} elseif (is_year()) { ?>
		the archive for <?php echo get_the_time('Y'); ?>
		
		<?php
		} elseif (is_author()) { ?>
		<?php the_author(); ?>'s archive
		<?php } ?>
		</div>
		<?php } ?>

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
<!--
If It's NOT A Page, Let's Do The Comment Bubble Thing
-->
 		<?php if (!is_page()) { ?>
	
		<?php if (function_exists('dsq_comments_template')) { ?>
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
 
<!--
If it's a page, we want things to be a little different here, especially on photo, archive and links pages
-->
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
        <?php the_content(); ?>  
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
              
              <h3 class="result-text-page">(Alphabetical Order)</h3>
              <div id="wptouch-links">
                  <?php foreach (get_bookmarks('categorize=0&title_li=0') as $bm) {
                  echo('<li>');
                  echo('<img src="http://hdrcore.com/code/favicon.php?site=' . urlencode($bm->link_url) . '&default=' . urlencode(bnc_get_local_icon_url() . '/icon-pool/Default.png') . '" />');
                  echo('<a href="' . $bm->link_url . '">' . $bm->link_name . '</a>');
                  echo('</li>'); } ?>
                </div>
				
<?php } ?><!-- end if links page-->    	
	<?php wp_link_pages('Pages in this article: ', '', 'number'); ?>

	</div>    
</div>
         <!--If comments are enabled for pages in the WPtouch admin-->
		 <?php if (bnc_is_page_coms_enabled()) { ?>
        <?php comments_template(); ?>
        <?php } ?>
  
			<?php } else { ?>
<!--
Page ifs closed, start the rest of things
-->
	
							<?php if (bnc_is_js_enabled() && bnc_excerpt_enabled()) { ?>
							<a class="post-arrow" id="arrow-<?php the_ID(); ?>" href="javascript:$wptouch('#entry-<?php the_ID(); ?>').fadeIn(500); $wptouch('#arrow-<?php the_ID(); ?>').hide(); $wptouch('#arrow-down-<?php the_ID(); ?>').show();"></a>		
							
							<a style="display:none" class="post-arrow-down" id="arrow-down-<?php the_ID(); ?>" href="javascript:$wptouch('#entry-<?php the_ID(); ?>').fadeOut(500); $wptouch('#arrow-<?php the_ID(); ?>').show(); $wptouch('#arrow-down-<?php the_ID(); ?>').hide();"></a>	
							
							
							<?php } elseif (!bnc_is_js_enabled() && bnc_excerpt_enabled()) { ?>
							
					<a class="post-arrow" id="arrow-<?php the_ID(); ?>" href="javascript:document.getElementById('entry-<?php the_ID(); ?>').style.display = 'block';document.getElementById('arrow-<?php the_ID(); ?>').style.display = 'none';document.getElementById('arrow-down-<?php the_ID(); ?>').style.display = 'block';"></a>
					 <a style="display:none" class="post-arrow-down" id="arrow-down-<?php the_ID(); ?>" href="javascript:document.getElementById('entry-<?php the_ID(); ?>').style.display = 'none';document.getElementById('arrow-<?php the_ID(); ?>').style.display = 'block';document.getElementById('arrow-down-<?php the_ID(); ?>').style.display = 'none';"></a>
					 
							<?php } ?>
                    
						<div class="calendar" style="background: url(<?php bloginfo('template_directory'); ?>/images/cal/month<?php echo get_the_time('n') ?>.jpg) no-repeat;">
						<div class="cal-month"><?php echo get_the_time('M') ?></div>
						<div class="cal-date"><?php echo get_the_time('j') ?></div>
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
            <div id="entry-<?php the_ID(); ?>" <?php if (bnc_excerpt_enabled()) { ?>style="display:none"<?php } ?> class="mainentry">
 				<?php the_content_rss('', true, '', 50); ?>
 		    <a href="<?php the_permalink() ?>">Read More &raquo;</a>
					
        </div>  
      </div>
<?php } ?> 
<!--
End of the if page or else code-->

    <?php endwhile; ?>

<?php if (!is_page()) { ?>
<!--If it's an index page, let's do these things-->

				<?php if (bnc_is_js_enabled()) { ?>
				<div id="call<?php echo md5($_SERVER['REQUEST_URI']); ?>">
				<a class="ajax" href="javascript:$wptouch('#spinner<?php echo md5($_SERVER['REQUEST_URI']); ?>').fadeIn(200); $wptouch('#ajaxentries<?php
				echo md5($_SERVER['REQUEST_URI']); ?>').load('<?php echo get_next_posts_page_link(); ?>', {}, function(){ $wptouch('#call<?php echo md5($_SERVER['REQUEST_URI']); ?>').fadeOut();})">Load more entries...</a> <img id="spinner<?php echo md5($_SERVER['REQUEST_URI']); ?>" class="spin" src="<?php bloginfo('template_directory'); ?>/images/main-ajax-loader.gif" style="display:none" alt="" />
				<div class="post-spacer"></div>
				<div class="clearer"></div>
				</div>				
				<div id="ajaxentries<?php echo md5($_SERVER['REQUEST_URI']); ?>"></div>
				</div>
		
				<?php } elseif (!bnc_is_js_enabled() && is_search()) { ?>
				<div class="main-navigation">
				<div class="alignleft"><?php previous_posts_link('<img src="' . get_bloginfo('template_directory') . '/images/blue_arrow_l.jpg" alt="" /> Newer In Search') ?></div>
				<div class="alignright"><?php next_posts_link('Older In Search <img src="' . get_bloginfo('template_directory') . '/images/blue_arrow_r.jpg" alt="" />') ?></div>
				</div>

				<?php } elseif (!bnc_is_js_enabled() && !is_search()) { ?>
				
				<div class="main-navigation">
					<div class="alignleft">
					<?php previous_posts_link('<img src="' . get_bloginfo('template_directory') . '/images/blue_arrow_l.jpg" alt="" /> Newer Entries') ?>
					</div>
					<div class="alignright">
					<?php next_posts_link('Older Entries <img src="' . get_bloginfo('template_directory') . '/images/blue_arrow_r.jpg" alt="" />') ?>
					</div>
				</div>
				<?php } ?>
		<?php } ?>

<?php else : ?>
<!--
If this was a bogus 404 page, the end of entry results, or a search -->

	<?php global $is_ajax; if (($is_ajax) && !is_search()) { ?>
	  <div class="result-text">No more entries to display.</div>
	 <?php } elseif (is_search() && ($is_ajax)) { ?>
	<div class="result-text">No more search results to display.</div>
	 <?php } elseif (is_search()) { ?>
	 <div class="result-text" style="padding-bottom:127px">No search results results found.<br />Try another query.</div>
	<?php } else { ?>
	  <div class="post"><img src="<?php bloginfo('template_directory'); ?>/images/404.jpg" alt="404 Not Found" /></div>
	<?php } ?>

  <?php endif; ?>

<!--
Here we're establishing whether the page was loaded via Ajax or not, for dynamic purposes. If it's ajax, we're not bringing in footer.php
-->
<?php global $is_ajax; if (!$is_ajax) get_footer(); ?>