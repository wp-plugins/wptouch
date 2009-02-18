<!-- Here the switch code is very important, as well as the php code which deals with admin links and WordPress -->
	<div id="footer">
		<p>
		
			<center><h3><?php if (current_user_can('edit_posts')) : // If it's not an admin don't show these! ?>      
				<a href="<?php bloginfo('wpurl'); ?>/wp-admin/">Admin</a> | 
					<?php //Another WordPress version check to figure out the correct logout method
						$version = (float)get_bloginfo('version'); 
						if ($version >= 2.7) { ?>
							<a href="<?php echo wp_logout_url($_SERVER['REQUEST_URI']); ?>">
						<?php } else { ?>
							<a href="<?php bloginfo('wpurl'); ?>/wp-login.php?action=logout&redirect_to=<?php echo $_SERVER['REQUEST_URI']; ?>">
						<?php } ?>Logout</a>
				<?php elseif (current_user_can('read_posts')) : ?>
					<a href="<?php bloginfo('wpurl'); ?>/wp-admin/profile.php">Account Profile</a><?php if (!bnc_is_login_button_enabled()) { ?> | <a href="<?php echo wp_logout_url(); ?>">Logout</a><?php } ?>
				<?php else : ?>
					<?php if (!bnc_is_login_button_enabled() && get_option('comment_registration') && !$user_ID) { ?>
						<a href="<?php bloginfo('wpurl'); ?>/wp-login.php">Login to <?php bloginfo('name'); ?></a> | 
					<?php } ?>
					
					<?php if (get_option('comment_registration')) { ?>
						<a href="<?php bloginfo('wpurl'); ?>/wp-register.php">Register for this site</a>
					<?php } ?>
				<?php  endif; ?></h3></center>

			<h3>View <?php bloginfo('title'); ?>'s <a href="<?php echo bloginfo('home') . '/?bnc_view=normal'; ?>">Regular Theme</a></h3>	

			All content Copyright &copy; <?php bloginfo('name'); ?><br />
			Powered by <a href="http://wordpress.org/">WordPress</a> with <a href="http://bravenewcode.com/wptouch/"><?php WPtouch(); ?></a>
		<br />


				</p>
		<?php wp_footer(); ?>
	</div>
	<?php wptouch_get_stats(); 
	//WPtouch theme designed and developed by Dale Mugford and Duane Storey for BraveNewCode.com
	//Licensed under GPL
	//If you modify it, please keep the link credit *visible* in the footer (and keep the WordPress credit, too!), that's all we ask, folks.
?>
</body>
</html>