	<?php if (bnc_is_cats_button_enabled()) { ?>			    
	    <a id="catsopen" href="#" onclick="bnc_jquery_cats_open_and(); return false;"><?php _e( 'Categories', 'wptouch' ); ?></a>
	<?php } ?>
	
	<?php if (bnc_is_tags_button_enabled()) { ?>	
	    <a id="tagsopen" href="#" onclick="bnc_jquery_tags_open_and(); return false;"><?php _e( 'Tags', 'wptouch' ); ?></a>
	<?php } ?>

	<?php if (bnc_is_login_button_enabled()) { ?>
		<?php if (!is_user_logged_in()) { ?>
			    <a id="loginopen" href="#" onclick="bnc_jquery_login_drop_and(); return false;"><?php _e( 'Login', 'wptouch' ); ?></a>	
	
		<?php } else { ?>
			    <a id="accountopen" href="#" onclick="bnc_jquery_acct_open_and(); return false;"><?php _e( 'My Account', 'wptouch' ); ?></a>	
	<?php } } // End android stuff ?>