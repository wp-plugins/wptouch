<!--
////////////////////////////
HEADER
Here we're establishing whether the page was loaded via Ajax or not, for dynamic purposes. If it's ajax, we're not bringing in header.php and footer.php
-->
<?php global $is_ajax; $is_ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']); if (!$is_ajax) get_header(); ?>
  <div class="content" id="content<?php echo md5($_SERVER['REQUEST_URI']); ?>">
 
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

  <div class="post">

    <a class="sh2" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php if (function_exists('the_title_attribute')) the_title_attribute(); else the_title(); ?>"><?php the_title(); ?></a>
	
    
    
        <div class="single-post-meta-top"><?php echo get_the_time('M / d / y - g:ia') ?> &rsaquo; <?php the_author() ?><br />
<!--
Let's check for DISQUS... we need to skip to a different div if it's installed and active
-->		
		<?php if (function_exists('dsq_comments_template')) { ?>
 			<a href="#dsq-add-new-comment">&darr; Skip to comments</a></div>
			<?php } else { ?>
   		    <a href="#comments">&darr; Skip to comments</a></div>
		<?php } ?>
		
        <div class="clearer"></div>
        </div>
         <div class="post singlecut" id="post-<?php the_ID(); ?>">
        
		  <div id="singlentry">
            <?php the_content(); ?>				
			</div>  
<!--
Categories and Tags post footer
-->        
    <div class="single-post-meta-bottom">
	<?php link_pages('<div class="post-page-nav">Article Pages: ', '</div>', 'number', ' &raquo;', '&laquo; '); ?>          
    Categories: <?php if (the_category(', ')) the_category(); ?>
    <?php if (function_exists('get_the_tags')) the_tags('<br />Tags: ', ', ', ''); ?>  
    </div>
    
<!--
Mail and Bookmark code
-->	
        <div class="single-links">
          <div class="single-bookmark-right"><a href="javascript:$wptouch('#bookmark-box').slideToggle(300);"><img src="<?php bloginfo('template_directory'); ?>/images/bookmarkit.png" class="small" alt="" /> Bookmark It</a></div>
          <div class="single-mail-left"><a href="mailto:?subject=<?php
  bloginfo('name'); ?>- <?php the_title();?>&body=Check out this post: <?php the_permalink() ?>"><img src="<?php bloginfo('template_directory'); ?>/images/mailit.png" class="small" alt="" /> Mail It</a></div>
          <div class="clearer"></div>
          </div>
        <div class="post-spacer"></div>
        </div>

<!--
Hidden bookmark box code (activated by the above link)
-->
  <div id="bookmark-box" style="display:none">
        <ul>
        <li><a  href="http://del.icio.us/post?url=<?php echo get_permalink()
?>&title=<?php the_title(); ?>" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/bookmarks/delicious.jpg" alt="" /> Del.icio.us</a></li>
        <li><a href="http://digg.com/submit?phase=2&url=<?php echo get_permalink()
?>&title=<?php the_title(); ?>" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/bookmarks/digg.jpg" alt="" /> Digg</a></li>
        <li><a href="http://technorati.com/faves?add=<?php the_permalink() ?>" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/bookmarks/technorati.jpg" alt="" /> Technorati</a></li>
        <li><a href="http://ma.gnolia.com/bookmarklet/add?url=<?php echo get_permalink() ?>&title=<?php the_title(); ?>" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/bookmarks/magnolia.jpg" alt="" /> Magnolia</a></li>
        <li><a href="http://www.newsvine.com/_wine/save?popoff=0&u=<?php echo get_permalink() ?>&h=<?php the_title(); ?>" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/bookmarks/newsvine.jpg" target="_blank"> Newsvine</a></li>
        <li class="noborder"><a href="http://reddit.com/submit?url=<?php echo get_permalink() ?>&title=<?php the_title(); ?>" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/bookmarks/reddit.jpg" alt="" /> Reddit</a></li>
        </ul>
        </div>
        
    <div class="navigation">
<!--
Single post navigation links
-->
      <div class="alignleft"><?php next_post_link('<img src="' . get_bloginfo('template_directory') . '/images/blue_arrow_l.jpg" alt="" /> %link') ?></div>
      <div class="alignright"><?php previous_post_link('%link <img src="' . get_bloginfo('template_directory') . '/images/blue_arrow_r.jpg" alt="" />') ?></div>

      <div class="clearer"></div>
    </div>

<!--
Let's rock the comments
-->

  <?php comments_template(); ?>
  
 		 <?php endwhile; else : ?>
<!--
Dynamic test for what page this is. A little redundant, but so what?
-->
			<?php global $is_ajax; if (($is_ajax) && !is_search()) { ?>
			<div class="result-text">No more entries to display.</div>
			<?php } elseif (is_search() && ($is_ajax)) { ?>
			<div class="result-text">No more search results to display.</div>
			<?php } elseif (is_search()) { ?>
			<div class="result-text">No search results results found. Try another query.</div>
			<?php } else { ?>
		    <div class="post"><img src="<?php bloginfo('template_directory'); ?>/images/404.jpg" alt="404 Not Found" /></div>
			<?php } ?>
	
		<?php endif; ?>
	</div>
<!--
Do the footer things
-->
<?php global $is_ajax; if (!$is_ajax) get_footer(); ?>