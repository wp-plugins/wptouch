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
                          if (isset($post->comment_count) && $post->comment_count > 0) {
?>
        <div class="comment-bubble<?php
                              if ($post->comment_count > 99)
                                  echo('-big');
?>"><?php
                              comments_number('0', '1', '%');
?></div>
      <?php
                          }
?>

        <div class="post" id="post-<?php
      the_ID();
?>">

          <a class="post-arrow" id="arrow-<?php
      the_ID();
?>" href="javascript:new Effect.toggle($('entry-<?php
      the_ID();
?>'),'Appear', {duration: 0.5});new Effect.toggle($('entry-<?php
      the_ID();
?>'),'Appear', {duration: 0.5});Element.setStyle('arrow-<?php
      the_ID();
?>', {display:'none'} );Element.setStyle('arrow-down-<?php
      the_ID();
?>', {display:'block'} );"></a>
          <a class="post-arrow-down" id="arrow-down-<?php
      the_ID();
?>" href="javascript:new Effect.toggle($('entry-<?php
      the_ID();
?>'),'Appear', {duration: 0.5});new Effect.toggle($('entry-<?php
      the_ID();
?>'),'Appear', {duration: 0.5});Element.setStyle('arrow-<?php
      the_ID();
?>', {display:'block'} );Element.setStyle('arrow-down-<?php
      the_ID();
?>', {display:'none'} );" style="display:none"></a>
      <div class="calendar" style="background: url(<?php
  bloginfo('template_directory');
?>/images/cal/month<?php
  the_time('n')
?>.png) no-repeat;">
      <div class="cal-month"><?php
      the_time('M')
?></div>
      <div class="cal-date"><?php
      the_time('j')
?></div>
      </div>
      
      <a class="h2" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php if (function_exists('the_title_attribute')) the_title_attribute(); else the_title(); ?>">
      <?php
      if (function_exists('bnc_the_title'))
          bnc_the_title();
      else
          the_title();
?></a></h2>
        <div class="post-author">
        <!--by <?php
      the_author()
?>-->
        <?php
      the_time('Y')
?><?php if (function_exists('wp_tag_cloud')) { ?>
<?php if (get_the_tags()) the_tags(' | Tagged: ', ', ', ''); ?> 
<?php } else { ?>
Filed:<?php the_category(', '); ?><?php } ?>
        </div>
        <div class="clearer"></div>

            <div id="entry-<?php
      the_ID();
?>" style="display:none" class="mainentry">
            <?php
      if (function_exists('bnc_translate_start'))
          bnc_translate_start();
?>
            <?php
      the_content_rss('', false, '', 50);
?>
            <?php
      if (function_exists('bnc_translate_stop'))
          bnc_translate_stop();
?>
        <a href="<?php
      the_permalink()
?>">Read More &raquo;</a>
        </div>  
      </div>
<div class="post-spacer"></div>
    <?php
      endwhile;
?>

<div id="call<?php
      echo md5($_SERVER['REQUEST_URI']);
?>">
 <a class="ajax" href="javascript:new Effect.Appear('spinner<?php
      echo md5($_SERVER['REQUEST_URI']);
?>', {duration:0.2});new Ajax.Updater('ajaxentries<?php
      echo md5($_SERVER['REQUEST_URI']);
?>', '<?php
      echo get_next_posts_page_link();
?>', {onComplete:function(){ new Effect.Fade('call<?php
      echo md5($_SERVER['REQUEST_URI']);
?>');}, asynchronous:true});">Load more entries...</a> <img id="spinner<?php
      echo md5($_SERVER['REQUEST_URI']);
?>" class="spin" src="<?php
      bloginfo('template_directory');
?>/images/main-ajax-loader.gif" style="display:none" alt="" />
<div class="post-spacer"></div>
<div class="clearer"></div>
</div>

<div id="ajaxentries<?php
      echo md5($_SERVER['REQUEST_URI']);
?>"></div>

  <?php
      else
          :
?>
  
<?php
          global $is_ajax;
      if ($is_ajax) {
?>
  <div class="result-text">No more search results to display.</div>
  <?php
          } else
          {
?>
  <div class="result-text">No search results found. Try a different query.</div>
<?php
          }
?>

  <?php
          endif;
?>
  </div>
<?php global $is_ajax; if (!$is_ajax) get_footer(); ?>