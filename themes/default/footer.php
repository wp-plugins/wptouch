<!--
////////////////////////////
FOOTER
Here the switch code is very important, as well as the php code which deals with admin links and WordPress
-->
<div id="footer">
			<p>
				<h3>iPhone View | <a href="<?php echo bloginfo('home') . '/?bnc_view=normal'; ?>">Normal View</a></h3>
				
					<br />
					<br />
					Powered by <a href="http://wordpress.org/">WordPress</a> with <a href="http://www.bravenewcode.com/wptouch/"><?php WPtouch(); ?></a>
					<br />
					All content Copyright &copy; <?php the_date('Y'); ?> <?php bloginfo('name'); ?>
					<br />
			
			<?php if (current_user_can('edit_posts')) : ?>      
				<a href="<?php bloginfo('wpurl'); ?>/wp-admin/">Admin</a> | <a href="<?php bloginfo('wpurl'); ?>/wp-login.php?action=logout">Logout</a>
				<?php elseif (current_user_can('read_posts')) : ?>
				<a href="<?php bloginfo('wpurl'); ?>/wp-admin/profile.php">Account Profile</a> | <a href="<?php bloginfo('wpurl'); ?>/wp-login.php?action=logout">Logout</a>
				<?php else : ?>
				<a href="<?php bloginfo('wpurl'); ?>/wp-login.php">Login to <?php bloginfo('name'); ?></a><?php if (get_option('comment_registration')) { ?> | <a href="<?php bloginfo('wpurl'); ?>/wp-register.php">Register</a><?php } ?>
				<?php  endif; ?>
 		 </p>
	
  <?php
  //WPtouch theme designed & developed by Dale Mugford & Duane Storey for BraveNewCode.com
  //Licensed under GPL
  //If you modify it, please, keep our credit in the footer, that's all we ask, folks.
  wp_footer(); ?>
  </div>
</body>
</html>