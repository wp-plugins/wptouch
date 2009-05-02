<?php global $is_ajax; $is_ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']); if (!$is_ajax) get_header(); ?>
<?php $wptouch_settings = bnc_wptouch_get_settings(); ?>

<div class="content" id="content<?php echo md5($_SERVER['REQUEST_URI']); ?>">
		
	<div class="result-text"><?php wptouch_core_body_result_text(); ?></div>

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<?php if (function_exists('dsq_comments_template') || function_exists('intensedebate_id')) { } else { ?>
				<?php if (isset($post->comment_count) && $post->comment_count > 0) { ?>
					<div class="comment-bubble<?php if ($post->comment_count > 99) echo('-big'); ?>">
						<?php comments_number('0', '1', '%'); ?>
					</div>
				<?php } ?>
			<?php } ?>		

 <div class="post" id="post-<?php the_ID(); ?>">
 
	<?php if (bnc_is_js_enabled() && bnc_excerpt_enabled()) { ?>
		<a class="post-arrow" id="arrow-<?php the_ID(); ?>" href="javascript:$wptouch('#entry-<?php the_ID(); ?>').fadeIn(500); $wptouch('#arrow-<?php the_ID(); ?>').hide(); $wptouch('#arrow-down-<?php the_ID(); ?>').show();"></a>		
		<a style="display:none" class="post-arrow-down" id="arrow-down-<?php the_ID(); ?>" href="javascript:$wptouch('#entry-<?php the_ID(); ?>').fadeOut(500); $wptouch('#arrow-<?php the_ID(); ?>').show(); $wptouch('#arrow-down-<?php the_ID(); ?>').hide();"></a>	
	<?php } elseif (!bnc_is_js_enabled() && bnc_excerpt_enabled()) { ?>
		<a class="post-arrow" id="arrow-<?php the_ID(); ?>" href="javascript:document.getElementById('entry-<?php the_ID(); ?>').style.display = 'block';document.getElementById('arrow-<?php the_ID(); ?>').style.display = 'none';document.getElementById('arrow-down-<?php the_ID(); ?>').style.display = 'block';"></a>
		<a style="display:none" class="post-arrow-down" id="arrow-down-<?php the_ID(); ?>" href="javascript:document.getElementById('entry-<?php the_ID(); ?>').style.display = 'none';document.getElementById('arrow-<?php the_ID(); ?>').style.display = 'block';document.getElementById('arrow-down-<?php the_ID(); ?>').style.display = 'none';"></a>
	<?php } ?>
	
	<div class="calendar">
		<div class="cal-month month-<?php echo get_the_time('m') ?>"><?php echo get_the_time('M') ?></div>
		<div class="cal-date"><?php echo get_the_time('j') ?></div>
	</div>

<a class="h2" href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php if (function_exists('the_title_attribute')) the_title_attribute(); else the_title(); ?>"><?php if (function_exists('bnc_the_title')) bnc_the_title(); else the_title(); ?></a>
			<div class="post-author">
			<?php if (bnc_show_author()) { ?><span class="lead"><?php _e("Author", "wptouch"); ?>:</span> <?php the_author(); ?><br /><?php } ?>
			<?php if (function_exists('wp_tag_cloud')) { ?>
			<?php if (bnc_show_categories()) { echo('<span class="lead">' . __( 'Categories', 'wptouch' ) . ':</span> '); the_category(', '); echo('<br />'); } ?> 
			<?php if (bnc_show_tags() && get_the_tags()) { echo(''); the_tags('<span class="lead">' . __( 'Tags', 'wptouch' ) . ':</span> ', ', ', ''); echo(''); } ?> 
			<?php } else { ?>
			<?php _e( 'Filed', 'wptouch' ); ?>:<?php the_category(', '); ?><?php } ?>
			</div>	
			<div class="clearer"></div>	
            <div id="entry-<?php the_ID(); ?>" <?php if (bnc_excerpt_enabled()) { ?>style="display:none"<?php } ?> class="mainentry <?php echo $wptouch_settings['style-text-size']; ?> <?php echo $wptouch_settings['style-text-justify']; ?>">
 				<?php the_content_rss('', true, '', 50); ?>
 		    <a href="<?php the_permalink() ?>"><?php _e( "Read More", "wptouch" ); ?> &raquo;</a>
	        </div>  
      </div>

    <?php endwhile; ?>	

				<?php if (bnc_is_js_enabled()) { ?>
			<div id="call<?php echo md5($_SERVER['REQUEST_URI']); ?>" class="ajax-load-more">
				<img id="spinner<?php echo md5($_SERVER['REQUEST_URI']); ?>" class="spin" src="<?php bloginfo('template_directory'); ?>/images/main-ajax-loader.gif" style="display:none" alt="" />
				<a class="ajax" href="javascript:$wptouch('#spinner<?php echo md5($_SERVER['REQUEST_URI']); ?>').fadeIn(200); $wptouch('#ajaxentries<?php echo md5($_SERVER['REQUEST_URI']); ?>').load('<?php echo get_next_posts_page_link(); ?>', {}, function(){ $wptouch('#call<?php echo md5($_SERVER['REQUEST_URI']); ?>').fadeOut();})">
				<?php if (is_search()) { ?>
					<?php _e( "Load more search results...", "wptouch" ); ?>
				<?php } elseif (is_category()) { ?>
					<?php _e( "Load more category results...", "wptouch" ); ?>
				<?php } elseif (function_exists('wp_tag_cloud') && is_tag()) { ?>
					<?php _e( "Load more tag results...", "wptouch" ); ?>
				<?php } else { ?>
					<?php _e( "Load more entries...", "wptouch" ); ?>
				<?php } ?></a>
						<div class="post-spacer"></div>
					<div class="clearer"></div>
				</div>
					<div id="ajaxentries<?php echo md5($_SERVER['REQUEST_URI']); ?>"></div>
			</div>
			
		
				<?php } elseif (!bnc_is_js_enabled() && is_search()) { ?>
					<div class="main-navigation">
						<div class="alignleft"><?php previous_posts_link('<img src="' . get_bloginfo('template_directory') . '/themes/default/images/blue_arrow_l.jpg" alt="" /> ' . __( 'Newer In Search', 'wptouch')); ?></div>
						<div class="alignright"><?php next_posts_link( __('Older In Search', 'wptouch') . ' <img src="' . get_bloginfo('template_directory') . 'themes/default/images/blue_arrow_r.jpg" alt="" />') ?></div>
					</div>

				<?php } elseif (!bnc_is_js_enabled() && !is_search()) { ?>
				
				<div class="main-navigation">
					<div class="alignleft">
						<?php previous_posts_link('<img src="' . get_bloginfo('template_directory') . 'themes/default/images/blue_arrow_l.jpg" alt="" /> ' . __( 'Newer Entries', 'wptouch') ) ?>
					</div>
					<div class="alignright">
						<?php next_posts_link( __('Older Entries', 'wptouch') . ' <img src="' . get_bloginfo('template_directory') . 'themes/default/images/blue_arrow_r.jpg" alt="" />') ?>
					</div>
				</div>
				<?php } ?>


<?php else : ?>

<!-- If this was a bogus 404 page, the end of entry results, or a search -->

	<?php global $is_ajax; if (($is_ajax) && !is_search()) { ?>
	  <div class="footer-result-text"><?php _e( "No more entries to display.", "wptouch" ); ?></div>
	 <?php } elseif (is_search() && ($is_ajax)) { ?>
	<div class="footer-result-text"><?php _e( "No more search results to display.", "wptouch" ); ?></div>
	 <?php } elseif (is_search() && (!$is_ajax)) { ?>
	 <div class="footer-result-text" style="padding-bottom:127px"><?php _e( "No search results results found.", "wptouch" ); ?><br /><?php _e( "Try another query.", "wptouch" ); ?></div>
	<?php } else { ?>
	  <div class="post"><img src="<?php bloginfo('template_directory'); ?>/images/404.jpg" alt="404 Not Found" /></div>
	<?php } ?>

 <?php endif; ?>

<!-- Here we're establishing whether the page was loaded via Ajax or not, for dynamic purposes. If it's ajax, we're not bringing in footer.php -->
<?php global $is_ajax; if (!$is_ajax) get_footer(); ?>