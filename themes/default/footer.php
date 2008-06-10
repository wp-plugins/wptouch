<div id="footer">
  		<p>
  			<h3>iPhone View | <a href="<?php echo get_bloginfo('home') . '/?bnc_view=normal'; ?>">Normal View</a></h3>

				  <?php if (current_user_can('edit_posts')) : ?>      
				<a href="<?php get_bloginfo('home'); ?>/wp-admin/">Admin</a> | <a href="<?php bloginfo('url'); ?>/wp-login.php?action=logout">Logout</a>
				<?php elseif (current_user_can('read_posts')) : ?>
				<a href="<?php get_bloginfo('home'); ?>/wp-admin/profile.php">Account Profile</a> | 
				<a href="<?php bloginfo('wpurl'); ?>/wp-login.php?action=logout">Logout</a>
				<?php else : ?>
				<a href="<?php bloginfo('wpurl'); ?>/wp-login.php">Login to <?php bloginfo('name'); ?></a><?php if (get_option('comment_registration')) { ?> | <a href="<?php bloginfo('wpurl'); ?>/wp-register.php">Register</a><?php } ?>
				<?php  endif; ?>
			<br /><br />
			Proudly powered by <a href="http://wordpress.org/">WordPress</a>, and <a href="http://www.bravenewcode.com/wptouch/">WPtouch</a>
				<br />All content Copyright &copy; <?php the_date('Y'); ?> <?php bloginfo('name'); ?></a>
 		 </p>
	</div>
</div>
  <?php
  //WPtouch theme designed & developed by Dale Mugford & Duane Storey for BraveNewCode.com
  //Licensed under GPL
  //If you modify it, please, give us credit, that's all we ask
  wp_footer();
?>
</body>
</html>