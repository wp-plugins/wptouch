<?php global $is_ajax; $is_ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']); if (!$is_ajax) get_header(); ?>
<?php $wptouch_settings = bnc_wptouch_get_settings(); ?>

<div class="content" id="content<?php echo md5($_SERVER['REQUEST_URI']); ?>">
		
	<div class="result-text"><?php wptouch_core_body_result_text(); ?></div>

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
 <div class="post" id="post-<?php the_ID(); ?>">
 
 		<?php if (!function_exists('dsq_comments_template') && !function_exists('id_comments_template')) { ?>
				<?php if (wp_touch_get_comment_count() > 0 && !is_archive() && !is_search()) { ?>
					<div class="comment-bubble<?php if (wp_touch_get_comment_count() > 99) echo('-big'); ?>">
						<?php comments_number('0','1','%'); ?>
					</div>
				<?php } ?>
		<?php } ?>			
 	
 	
 	<?php if (is_archive() || is_search()) { ?>
		<div class="archive-top">
			<div class="archive-top-right">
				<?php if (bnc_excerpt_enabled()) { ?>
				<script type="text/javascript">
					$wptouch(document).ready(function(){
						$wptouch("a#arrow-<?php the_ID(); ?>").click(function(event) {
							$wptouch(this).toggleClass("post-arrow-down");
							$wptouch('#entry-<?php the_ID(); ?>').fadeToggle(500);
						});	
					 });					
				</script>
					<a class="post-arrow" id="arrow-<?php the_ID(); ?>" href="javascript: return false;"></a>
				<?php } ?>
			</div> 
		 <div id="arc-top" class="archive-top-left month-<?php echo get_the_time('m') ?>">
			<?php echo get_the_time('M') ?> <?php echo get_the_time('j') ?>, <?php echo get_the_time('Y') ?>
		 </div>
		</div>
 	<?php } else { ?>	
				<?php if (bnc_excerpt_enabled()) { ?>
				<script type="text/javascript">
					$wptouch(document).ready(function(){
						$wptouch("a#arrow-<?php the_ID(); ?>").click(function(event) {
							$wptouch(this).toggleClass("post-arrow-down");
							$wptouch('#entry-<?php the_ID(); ?>').fadeToggle(500);
						});	
					});					
				</script>

					<a class="post-arrow" id="arrow-<?php the_ID(); ?>" href="javascript: return false;"></a>				
				<?php } ?>
				
				
				<?php 
					$version = bnc_get_wp_version();
					if ($version >= 2.9 && $wptouch_settings['post-cal-thumb'] == 'post-thumbnails' ) { ?>
					<div class="wptouch-post-thumb-wrap">
						<img src="<?php echo compat_get_plugin_url( 'wptouch' ); ?>/themes/core/core-images/top-left.png" alt="top-left" class="thumb-top-left" />
						<img src="<?php echo compat_get_plugin_url( 'wptouch' ); ?>/themes/core/core-images/top-right.png" alt="top-right" class="thumb-top-right" />
					<div class="wptouch-post-thumb">
						<?php if (function_exists('has_post_thumbnail')) { ?>
							<?php if (has_post_thumbnail()) { ?>
								<?php the_post_thumbnail(); ?>
							<?php } else { ?>				
								<?php 
								$total = '6'; 
								$file_type = '.jpg'; 
								// Change to the location of the folder containing the images 
								$image_folder = '' . compat_get_plugin_url( 'wptouch' ) . '/themes/core/core-images/thumbs/green/'; 
								$start = '1'; 
								$random = mt_rand($start, $total); 
								$image_name = $random . $file_type; 
								echo "<img src=\"$image_folder/$image_name\" alt=\"$image_name\" />";
							?>
						<?php } } ?>
					</div>
						<img src="<?php echo compat_get_plugin_url( 'wptouch' ); ?>/themes/core/core-images/bottom-left.png" alt="bottom-left" class="thumb-bottom-left" />
						<img src="<?php echo compat_get_plugin_url( 'wptouch' ); ?>/themes/core/core-images/bottom-right.png" alt="bottom-right" class="thumb-bottom-right" />
					</div>
				<?php } else { ?>
					<div class="calendar">
						<div class="cal-month month-<?php echo get_the_time('m') ?>"><?php echo get_the_time('M') ?></div>
						<div class="cal-date"><?php echo get_the_time('j') ?></div>
					</div>				
				<?php } ?>

	<?php } ?>
 
	<a class="h2" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		<div class="post-author">
			<?php if (bnc_show_author()) { ?><span class="lead"><?php _e("Author", "wptouch"); ?>:</span> <?php the_author(); ?><br /><?php } ?>
			<?php if (bnc_show_categories()) { echo('<span class="lead">' . __( 'Categories', 'wptouch' ) . ':</span> '); the_category(', '); echo('<br />'); } ?> 
			<?php if (bnc_show_tags() && get_the_tags()) { the_tags('<span class="lead">' . __( 'Tags', 'wptouch' ) . ':</span> ', ', ', ''); } ?>
		</div>	
			<div class="clearer"></div>	
            <div id="entry-<?php the_ID(); ?>" <?php  if (bnc_excerpt_enabled()) { ?>style="display:none"<?php } ?> class="mainentry <?php echo $wptouch_settings['style-text-size']; ?> <?php echo $wptouch_settings['style-text-justify']; ?>">
 				<?php the_excerpt(); ?>
 		    <a class="read-more" href="<?php the_permalink() ?>"><?php _e( "Read This Post", "wptouch" ); ?></a>
	        </div>  
      </div>

    <?php endwhile; ?>	

<?php if (!function_exists('dsq_comments_template') && !function_exists('id_comments_template')) { ?>

	<div id="call<?php echo md5($_SERVER['REQUEST_URI']); ?>" class="ajax-load-more">
		<div id="spinner<?php echo md5($_SERVER['REQUEST_URI']); ?>" class="spin"	 style="display:none"></div>
		<a class="ajax" href="#" onclick="$wptouch('#spinner<?php echo md5($_SERVER['REQUEST_URI']); ?>').fadeIn(200); $wptouch('#ajaxentries<?php echo md5($_SERVER['REQUEST_URI']); ?>').load('<?php echo get_next_posts_page_link(); ?>', {}, function(){ $wptouch('#call<?php echo md5($_SERVER['REQUEST_URI']); ?>').fadeOut();}); return false;">
			<?php _e( "Load more entries...", "wptouch" ); ?>
		</a>
	</div>
	<div id="ajaxentries<?php echo md5($_SERVER['REQUEST_URI']); ?>"></div>
	
<?php } else { ?>
				<div class="main-navigation">
					<div class="alignleft">
						<?php previous_posts_link( __( 'Newer Entries', 'wptouch') ) ?>
					</div>
					<div class="alignright">
						<?php next_posts_link( __('Older Entries', 'wptouch')) ?>
					</div>
				</div>
<?php } ?>
</div><!-- #End post -->

<?php else : ?>

	<div class="result-text-footer">
		<?php wptouch_core_else_text(); ?>
	</div>

 <?php endif; ?>

<!-- Here we're establishing whether the page was loaded via Ajax or not, for dynamic purposes. If it's ajax, we're not bringing in footer.php -->
<?php global $is_ajax; if (!$is_ajax) get_footer(); ?>