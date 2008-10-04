<?php
// Do not delete these lines***********************
if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die('Please do not load this page directly. Thanks!');
		if (!empty($post->post_password)) {
			// if there's a password
			if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {
			// and it doesn't match the cookie ?>
			
		<p class="nocomments">This post is password protected. Enter the password to view comments.<p>
<?php return; 
		}
	}
/* This variable is for alternating comment background */
$oddcomment = 'alt'; 
?>
<!-- 
You can start editing here. 
-->
<h3 id="comments"><?php
  comments_number('No Comments', '1 Comment', '% Comments'); ?></h3>

<div id="comment_wrapper">

<ol class="commentlist" id="commentlist">
<?php if ($comments) : ?>
<?php $comment_num = 0; ?>
	<?php foreach ($comments as $comment) : ?>
		<?php if (get_comment_type() == "comment") { ?>

			<li class="<?php  echo $oddcomment; ?>" id="comment-<?php comment_ID(); ?>">
		<?php  if ($comment->comment_approved == '0') : ?>
	<div id="preview"><h2>Preview only: (moderation required)</h2></div>

<?php endif; ?>

	<div class="comwrap">
			<div class="comtop">
			
<!--
Checking to see if Gravatars are enabled for WPtouch
-->
	<?php if (bnc_is_gravatars_enabled()) { ?>
			
			<?php if (function_exists('gravatar')) { 
			/* If we've got the classic Gravatars plugin and they're enabled in the WPtouch admin, serve them up */
			?>
			<img class='gravatar' src="<?php gravatar("R", 28, "' . get_bloginfo('url') . '/wp-content/plugins/wptouch/images/blank_gravatar.png'"); ?>" alt='' />
			
			<?php } elseif (function_exists('get_avatar')) 
			/* If we've got built in Gravatars and they're enabled in the WPtouch admin, serve them up */
			{ 
			echo get_avatar( $comment, $size = '28', $default = '' . get_bloginfo('url') . '/wp-content/plugins/wptouch/images/blank_gravatar.png' ); 
			} else { ?>
			<?php } ?><!--end grav option-->
			
	<?php } ?><!--end grav check -->
		
      <!--  <a class="post-arrow" id="comment-num-<?php echo $comment_num; ?>" href="#" onclick="bnc_scroll_comment('<?php echo $comment_num; ?>'); return false"></a>	 -->
		<a href="<?php comment_author_url(); ?>"><?php comment_author(); ?></a> said:
		<div class="comdater"><?php comment_time('m / d / H:i'); ?></div>  
		</div><!--end comtop-->

        <?php $comment_num++; ?>
	  
		<div class="combody">  
		<?php comment_text(); ?>
		</div>
	</div><!--end comwrap-->
</li>

		<?php
		/* Changes every other comment to a different class */
		if ('alt' == $oddcomment) $oddcomment = '';  else $oddcomment = 'alt'; ?>
		<?php } ?>
		<?php endforeach;
		/* end for each comment */
		?>
		
  </ol>

  <?php  else : // this is displayed if there are no comments so far  ?>
  
  <?php if ('open' == $post->comment_status) : ?>
  <!-- If comments are open, but there are no comments. -->
  <li id="hidelist" style="display:none"></li>
  </ol>
  
  <?php else : // comments are closed  ?>
  <!-- If comments are closed. -->
  <li style="display:none"></li>
  </ol>
  <h3 class="closed">Comments are closed on this post.</h3>
  

  <?php endif; ?><!--end comment status-->

  <?php endif; ?>
 
  <div id="textinputwrap">
  
  	<?php if ('open' == $post->comment_status) : ?>
  
		<?php if (get_option('comment_registration') && !$user_ID) : ?>
		<center>
		<h1>You must <a href="<?php echo get_option('url'); ?>/wp-login.php">login</a> or <a href="<?php echo get_option('url'); ?>/wp-register.php">register</a> to comment.</h1>
		</center>

<?php else : ?>

  <!--
  Let's check for advanced JS setting, and if it's enabled do fancy ajax comments
  -->
	<?php if (bnc_is_js_enabled()) { ?>
	<div id="refresher" style="display:none">&raquo; <a href="javascript:this.location.reload();">Refresh the page</a> to post a new comment.</div>
	<form id="commentform" action="<?php echo get_option('url'); ?>/wp-comments-post.php" method="post" onsubmit="$wptouch('#loading').fadeIn(100);var list = $wptouch('#commentlist'); var html = list.html(); var param = $wptouch('form').serialize(); $wptouch.ajax({url: '<?php bloginfo('template_directory'); ?>/comments-ajax.php?' + param, success: function(data, status){ list.append(data); commentAdded(); }, type: 'get' }); return false;">
	<?php } else { ?>
	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
	<?php } ?>

<?php if ($user_ID) : ?>

		<p class="logged"  id="respond">Logged in as <a href="<?php
		bloginfo('url'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>:</p>
	
	<?php else : ?>
	
		<h3 id="respond"><!--Leave A Comment--></h3>
		<p style="font-size:13px">
		<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
		<label for="author"><small>Name <?php if ($req) echo "*"; ?></small></label>
		</p>
	
		<p style="font-size:13px">
		<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
		<label for="email"><small>Mail (unpublished) <?php if ($req) echo "*"; ?></small></label>
		</p>
	
		<p style="font-size:13px">
		<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
		<label for="url"><small>Website</small></label>
		</p>

<?php endif; ?>

	<p><textarea name="comment" id="comment" tabindex="4"></textarea></p>
	
		<p style="padding-bottom:10px"><input name="submit" type="submit" id="submit" tabindex="5" value="Publish" />
		<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
		
		<div id="loading"  style="display:none">
		<img src="<?php bloginfo('template_directory'); ?>/images/comment-ajax-loader.gif" alt="" />
		</div>
		</p>
		
	<div id="errors" style="display:none">
	There was an error. Please refresh the page and try again.
	</div>
	
<?php do_action('comment_form', $post->ID); ?>
</form>

		<?php endif;
		// If registration required and not logged in 
		?>
		</div><!--END of textinputwrap DIV-->

</div>
<?php endif;
// if you delete this the sky will fall on your head 
?>