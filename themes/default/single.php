<?php global $is_ajax; $is_ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']); if (!$is_ajax) get_header(); ?>
<?php $wptouch_settings = bnc_wptouch_get_settings(); ?>

<div class="content" id="content<?php echo md5($_SERVER['REQUEST_URI']); ?>">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="post">
			    <a class="sh2" href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( "Permanent Link to ", "wptouch" ); ?><?php if (function_exists('the_title_attribute')) the_title_attribute(); else the_title(); ?>"><?php the_title(); ?></a>
			        <div class="single-post-meta-top"><?php echo get_the_time('M jS, Y @ h:i a') ?> &rsaquo; <?php the_author() ?><br />

		<!-- Let's check for DISQUS... we need to skip to a different div if it's installed and active -->		
		<?php if ('open' == $post->comment_status) : ?>
			<?php if (function_exists('dsq_comments_template')) { ?>
		 		<a href="#dsq-add-new-comment">&darr; <?php _e( "Skip to comments", "wptouch" ); ?></a>
			<?php } elseif (function_exists('id_comments_template')) { ?>
				<a href="#idc-container-parent">&darr; <?php _e( "Skip to comments", "wptouch" ); ?></a>
			<?php } elseif (isset($post->comment_count) && $post->comment_count == 0) { ?>
				<a href="#respond">&darr; <?php _e( "Leave a comment", "wptouch" ); ?></a>
			<?php } elseif (isset($post->comment_count) && $post->comment_count > 0) { ?>
				<a href="#com-head">&darr; <?php _e( "Skip to comments", "wptouch" ); ?></a>
			<?php } ?>
		<?php endif; ?>
		</div>
		<div class="clearer"></div>
	</div>

         <div class="post" id="post-<?php the_ID(); ?>">
         	<div id="singlentry" class="<?php echo $wptouch_settings['style-text-size']; ?> <?php echo $wptouch_settings['style-text-justify']; ?>">
            	<?php the_content(); ?>				
			</div>  
			
<!-- Categories and Tags post footer -->        

			<div class="single-post-meta-bottom">
				<?php link_pages('<div class="post-page-nav">' . __( "Article Pages", "wptouch" ) . ': ', '</div>', 'number', ' &raquo;', '&laquo; '); ?>          
			    <?php _e( "Categories", "wptouch" ); ?>: <?php if (the_category(', ')) the_category(); ?>
			    <?php if (function_exists('get_the_tags')) the_tags('<br />' . __( 'Tags', 'wptouch' ) . ': ', ', ', ''); ?>  
		    </div>   

		<ul id="post-options">
		<li><a href="<?php $prevPost = get_previous_post(true); $prevURL = get_permalink($prevPost->ID); echo $prevURL; ?>" id="oprev"></a></li>
		<li><a href="mailto:?subject=<?php
bloginfo('name'); ?>- <?php the_title();?>&body=<?php _e( "Check out this post:", "wptouch" ); ?> <?php the_permalink() ?>" onclick="wptouch_mail_confirmation();" id="omail"></a></li>
		<li><a href="javascript:return false;" onclick="$wptouch('#twitter-box').slideToggle(300);" id="otweet"></a></li>
		<li><a href="javascript:return false;" onclick="$wptouch('#bookmark-box').slideToggle(300);" id="obook"></a></li>
		<li><a href="javascript:var%20d%3Ddocument%2Cz%3Dd.createElement%28%27scr%27%2B%27ipt%27%29%2Cb%3Dd.body%3Btry%7Bif%28%21b%29throw%280%29%3Bd.title%3D%27%28Saving...%29%20%27%2Bd.title%3Bz.setAttribute%28%27src%27%2C%27http%3A%2F%2Fwww.instapaper.com%2Fj%2F%27%29%3Bb.appendChild%28z%29%3B%7Dcatch%28e%29%7Balert%28%27Please%20wait%20until%20the%20page%20has%20loaded.%27%29%3B%7Dvoid%280%29" id="opaper"></a></li>
		<li><a href="javascript:return false;" onclick="wptouch_toggle_text();" id="otext"></a></li>
		<li><a href="<?php $nextPost = get_next_post(true); $nextURL = get_permalink($nextPost->ID); echo $nextURL; ?>" id="onext"></a></li>
		</ul>

    </div>

  	<div id="twitter-box" style="display:none">
		<ul>
			<li><a href="javascript:return false;" onclick="window.location='tweetie:'+window.location"><img src="<?php echo compat_get_plugin_url( 'wptouch' ); ?>/themes/core/core-images/tweetie.png" alt="tweetie" /> Post to Tweetie</a></li>
			<li><a href="javascript:return false;" onclick="window.location='twitterrific:///post?message='+escape(window.location)"><img src="<?php echo compat_get_plugin_url( 'wptouch' ); ?>/themes/core/core-images/twitteriffic.png" alt="twitteriffic" /> Post to Twitteriffic</a></li>
			<li><a href="javascript:return false;" onclick="window.location='twit:'+window.location"><img src="<?php echo compat_get_plugin_url( 'wptouch' ); ?>/themes/core/core-images/twittelator.png" alt="twittelator" /> Post to Twittelator Pro</a></li>
		</ul>
	</div>
    	
  	<div id="bookmark-box" style="display:none">
		<ul>
			<li><a  href="http://del.icio.us/post?url=<?php echo get_permalink()
?>&title=<?php the_title(); ?>" target="_blank"><img src="<?php echo compat_get_plugin_url( 'wptouch' ); ?>/themes/core/core-images/bookmarks/delicious.jpg" alt="" /> <?php _e( "Del.icio.us", "wptouch" ); ?></a></li>
			<li><a href="http://digg.com/submit?phase=2&url=<?php echo get_permalink()
?>&title=<?php the_title(); ?>" target="_blank"><img src="<?php echo compat_get_plugin_url( 'wptouch' ); ?>/themes/core/core-images/bookmarks/digg.jpg" alt="" /> <?php _e( "Digg", "wptouch" ); ?></a></li>
			<li><a href="http://technorati.com/faves?add=<?php the_permalink() ?>" target="_blank"><img src="<?php echo compat_get_plugin_url( 'wptouch' ); ?>/themes/core/core-images/bookmarks/technorati.jpg" alt="" /> <?php _e( "Technorati", "wptouch" ); ?></a></li>
			<li><a href="http://ma.gnolia.com/bookmarklet/add?url=<?php echo get_permalink() ?>&title=<?php the_title(); ?>" target="_blank"><img src="<?php echo compat_get_plugin_url( 'wptouch' ); ?>/themes/core/core-images/bookmarks/magnolia.jpg" alt="" /> <?php _e( "Magnolia", "wptouch" ); ?></a></li>
			<li><a href="http://www.newsvine.com/_wine/save?popoff=0&u=<?php echo get_permalink() ?>&h=<?php the_title(); ?>" target="_blank"><img src="<?php echo compat_get_plugin_url( 'wptouch' ); ?>/themes/core/core-images/bookmarks/newsvine.jpg" target="_blank"> <?php _e( "Newsvine", "wptouch" ); ?></a></li>
			<li class="noborder"><a href="http://reddit.com/submit?url=<?php echo get_permalink() ?>&title=<?php the_title(); ?>" target="_blank"><img src="<?php echo compat_get_plugin_url( 'wptouch' ); ?>/themes/core/core-images/bookmarks/reddit.jpg" alt="" /> <?php _e( "Reddit", "wptouch" ); ?></a></li>
		</ul>
	</div>

<!-- Let's rock the comments -->

	<?php comments_template(); ?>

	<?php endwhile; else : ?>

<!-- Dynamic test for what page this is. A little redundant, but so what? -->

	<div class="result-text-footer">
		<?php wptouch_core_else_text(); ?>
	</div>

	<?php endif; ?>
</div>
	
	<!-- Do the footer things -->
	
<?php global $is_ajax; if (!$is_ajax) get_footer(); ?>