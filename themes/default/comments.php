<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	<h3 id="comments"><?php comments_number('No Responses', 'One Response', '% Responses' );?> to &#8220;<?php the_title(); ?>&#8221;</h3>

	<ol class="commentlist">
	<?php wp_list_comments('style=ul&avatar_size=28'); ?>
	</ol>

	<div class="navigation commentnav">
		<div class="alignleft"><?php previous_comments_link('Older Comments','') ?></div>
		<div class="alignright"><?php next_comments_link('Newer Comments','') ?></div>
	</div>
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments">Comments are closed.</p>

	<?php endif; ?>
<?php endif; ?>


<?php if ( comments_open() ) : ?>

  <!--  Let's check for advanced JS setting, and if it's enabled do fancy ajax comments -->
  
	<?php if (!function_exists('cas_register_post')) { ?>
		<div id="refresher" style="display:none;"><img src="<?php echo compat_get_plugin_url( 'wptouch' ); ?>/images/good.png" alt="checkmark" /><h3><?php _e( "Comment successfully added.", "wptouch" ); ?></h3>&raquo; <a href="#" onclick="this.location.reload(); return false;"><?php _e( "Refresh the page", "wptouch" ); ?></a> <?php _e( "to post a new comment.", "wptouch" ); ?></div>
			<form id="commentform" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" onsubmit="$wptouch('#loading').fadeIn(100);var list = $wptouch('#commentlist'); var html = list.html(); var param = $wptouch('form').serialize(); $wptouch.ajax({url: '<?php bloginfo('template_directory'); ?>/comments-ajax.php?' + param, success: function(data, status){ list.append(data); commentAdded(); }, type: 'get' }); return false;">
	<?php } else { ?>
		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
	<?php } ?>

<?php if ($user_ID) : ?>

		<p class="logged"  id="respond"><?php _e( "Logged in as", "wptouch" ); ?> <a href="<?php bloginfo('wpurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>:</p>
	
	<?php else : ?>
	
		<h3 id="respond"><?php _e( "Leave A Comment", "wptouch" ); ?></h3>
			<p style="font-size:13px">
				<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
				<label for="author"><small><?php _e( 'Name', 'wptouch' ); ?> <?php if ($req) echo "*"; ?></small></label>
			</p>
	
			<p style="font-size:13px">
				<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
				<label for="email"><small><?php _e( 'Mail (unpublished)', 'wptouch' ); ?> <?php if ($req) echo "*"; ?></small></label>
			</p>
		
			<p style="font-size:13px">
				<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
				<label for="url"><small><?php _e( 'Website', 'wptouch' ); ?></small></label>
			</p>

<?php endif; ?>

	<p><textarea name="comment" id="comment" tabindex="4"></textarea></p>
	
		<p style="padding-bottom:10px"><input name="submit" type="submit" id="submit" tabindex="5" value="Publish" />
			<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />		
				<div id="loading"  style="display:none">
					<img src="<?php echo compat_get_plugin_url( 'wptouch' ); ?>/themes/core/core-images/comment-ajax-loader.gif" alt="" />
				</div>
		</p>
		
		<div id="errors" style="display:none">
			<?php _e( "There was an error. Please refresh the page and try again.", "wptouch" ); ?>
		</div>
				
		<?php do_action('comment_form', $post->ID); ?>
	</form>
<?php endif; // If registration required and not logged in ?>