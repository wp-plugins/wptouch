<?php
  get_header();
?>
  <div class="content" id="content<?php
  echo md5($_SERVER['REQUEST_URI']);
?>">
  <?php
  if (have_posts())
      : while (have_posts())
      : the_post();
?>

  <div class="post" id="post-<?php
  the_ID();
?>">

    <a class="sh2" href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php if (function_exists('the_title_attribute')) the_title_attribute(); else the_title(); ?>">
    <?php
  if (function_exists('bnc_the_title'))
      bnc_the_title();
  else
      the_title();
?></a>
        <div class="single-post-meta-top"><?php
  the_time('F jS, Y - g:ia')
?> &rsaquo; By <?php
  the_author()
?><br /><a href="#comments">&darr; Skip to comments</a></div>
        <div class="clearer"></div>
          <div id="singlentry">
            <?php
  if (function_exists('bnc_the_content'))
      bnc_the_content();
  else
      the_content();
?>
          </div>  
        
    <div class="single-post-meta-bottom">
    Categories: <?php
  if (the_category(', '))
      the_category();
?>
    <?php
  if (function_exists('get_the_tags')) the_tags('<br />Tags: ', ', ', ''); ?>  
    </div>
    
        <div class="single-links">
          <div class="single-bookmark-right"><a href="javascript:new Effect.toggle($('bookmark-box'),'Appear', {duration: 0.5});"><img src="<?php
  bloginfo('template_directory');
?>/images/bookmarkit.png" class="small" alt="" /> Bookmark It</a></div>
          <div class="single-mail-left"><a href="mailto:?subject=<?php
  bloginfo('name');
?>- <?php
  the_title();
?>&body=Check out this post: <?php
  the_permalink()
?>"><img src="<?php
  bloginfo('template_directory');
?>/images/mailit.png" class="small" alt="" /> Mail It</a></div>
          <div class="clearer"></div>
          </div>
        <div class="post-spacer"></div>
        </div>

  <div id="bookmark-box" style="display:none">
        <ul>
        <li><a  href="http://del.icio.us/post?url=<?php
  echo get_permalink()
?>&title=<?php
  the_title();
?>" target="_blank"><img src="<?php
  bloginfo('template_directory');
?>/images/bookmarks/delicious.png" alt="" /> Del.icio.us</a></li>
        <li><a href="http://digg.com/submit?phase=2&url=<?php
  echo get_permalink()
?>&title=<?php
  the_title();
?>" target="_blank"><img src="<?php
  bloginfo('template_directory');
?>/images/bookmarks/digg.png" alt="" /> Digg</a></li>
        <li><a href="http://technorati.com/faves?add=<?php
  the_permalink()
?>" target="_blank"><img src="<?php
  bloginfo('template_directory');
?>/images/bookmarks/technorati.png" alt="" /> Technorati</a></li>
        <li><a href="http://ma.gnolia.com/bookmarklet/add?url=<?php
  echo get_permalink()
?>&title=<?php
  the_title();
?>" target="_blank"><img src="<?php
  bloginfo('template_directory');
?>/images/bookmarks/magnolia.png" alt="" /> Magnolia</a></li>
        <li><a href="http://www.newsvine.com/_wine/save?popoff=0&u=<?php
  echo get_permalink()
?>&h=<?php
  the_title();
?>" target="_blank"><img src="<?php
  bloginfo('template_directory');
?>/images/bookmarks/newsvine.png" target="_blank"> Newsvine</a></li>
        <li class="noborder"><a href="http://reddit.com/submit?url=<?php
  echo get_permalink()
?>&title=<?php
  the_title();
?>" target="_blank"><img src="<?php
  bloginfo('template_directory');
?>/images/bookmarks/reddit.png" alt="" /> Reddit</a></li>
        </ul>
        </div>
        
    <div class="navigation">
    <?php
  if (function_exists('bnc_translate_start'))
      bnc_translate_start();
?>    
      <div class="alignleft"><?php
  next_post_link('<img src="' . get_bloginfo('template_directory') . '/images/blue_arrow_l.png" alt="" /> %link')
?></div>
      <div class="alignright"><?php
  previous_post_link('%link <img src="' . get_bloginfo('template_directory') . '/images/blue_arrow_r.png" alt="" />')
?></div>
    <?php
  if (function_exists('bnc_translate_stop'))
      bnc_translate_stop();
?>      
      <div class="clearer"></div>
    </div>

  <?php
  comments_template();
?>
  <?php
  endwhile;
  else
      :
?>
    <div id="fourohfour"><img src="<?php
      bloginfo('template_directory');
?>/images/404.png" alt="" /></div>
<?php
  endif;
?>
  </div>
<?php
  get_footer();
?>