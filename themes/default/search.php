<?php global $is_ajax; $is_ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']); if (!$is_ajax) get_header(); ?>

  <div id="content<?php echo md5($_SERVER['REQUEST_URI']); ?>" class="content">
      
      <?php global $is_ajax; if ($is_ajax) { ?>
        <?php } else { ?>
        <div class="result-text">Search results for &lsquo;<?php
          the_search_query();
?>&rsquo;:</div>
      <?php
      }
?>
  
  <?php
      if (have_posts())
          : while (have_posts())
          : the_post();
?>

  <?php
  if (function_exists('disqus_recent_comments')) { ?>
 
<?php } else { ?>
       <?php if (isset($post->comment_count) && $post->comment_count > 0) { ?>
        <div class="comment-bubble<?php if ($post->comment_count > 99) echo('-big'); ?>">
		<?php comments_number('0', '1', '%'); ?>
		</div>
      <?php } ?>
<?php } ?>

   <div class="post" id="post-<?php the_ID(); ?>">

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
      
<a class="h2" href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php if (function_exists('the_title_attribute')) the_title_attribute(); else the_title(); ?>">

      <?php if (function_exists('bnc_the_title')) bnc_the_title(); else the_title(); ?></a></h2>
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
            <?php if (function_exists('bnc_translate_start')) bnc_translate_start(); ?>
            <?php the_content_rss('', false, '', 50); ?>
            <?php if (function_exists('bnc_translate_stop')) bnc_translate_stop(); ?>
            <a href="<?php the_permalink() ?>">Read More &raquo;</a>
        </div>  
      </div>
    <?php endwhile; ?>

			<?php if (bnc_is_js_enabled()) { ?>
			<div id="call<?php echo md5($_SERVER['REQUEST_URI']); ?>">
				<a class="ajax" href="javascript:new Effect.Appear('spinner<?php echo md5($_SERVER['REQUEST_URI']); ?>', {duration:0.2});new Ajax.Updater('ajaxentries<?php
				echo md5($_SERVER['REQUEST_URI']); ?>', '<?php echo get_next_posts_page_link(); ?>', {onComplete:function(){ new Effect.Fade('call<?php echo md5($_SERVER['REQUEST_URI']); ?>', {delay:1, duration:.5});}, asynchronous:true});">Load more entries...</a> <img id="spinner<?php echo md5($_SERVER['REQUEST_URI']); ?>" class="spin" src="<?php bloginfo('template_directory'); ?>/images/main-ajax-loader.gif" style="display:none" alt="" />
				<div class="post-spacer"></div>
				<div class="clearer"></div>
				</div>

<div id="ajaxentries<?php echo md5($_SERVER['REQUEST_URI']); ?>"></div>
</div>
<?php } else { ?>
	<div class="main-navigation">
			<div class="alignleft"><?php previous_posts_link('<img src="' . get_bloginfo('template_directory') . '/images/blue_arrow_l.png" alt="" /> Newer In Search') ?></div>
			<div class="alignright"><?php next_posts_link('Older In Search <img src="' . get_bloginfo('template_directory') . '/images/blue_arrow_r.png" alt="" />') ?></div>
		</div>
<?php } ?>

 <?php else : ?>

<?php global $is_ajax; if ($is_ajax) { ?>
<div class="result-text">No more search results to display.</div>
<?php } else { ?>
<div class="result-text">No search results results found. Try another query.</div>
<?php } ?>

<?php endif; ?>
</div>

<?php global $is_ajax; if (!$is_ajax) get_footer(); ?>