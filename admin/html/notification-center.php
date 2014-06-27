<?php $settings = wptouch_get_settings(); ?>

	<div class="dropdown notifications">
		<?php if ( defined( 'WPTOUCH_IS_FREE' ) ) { ?>
		<a href="<?php echo admin_url( 'admin.php?page=wptouch-admin-upgrade' ); ?>">
			<button id="upgrade-to-pro" class="btn btn-small" type="button"><?php _e( 'Upgrade to Pro', 'wptouch-pro' ); ?></button>
		</a>
		<?php } ?>
		<button id="notification-drop" class="notifications-btn btn btn-small dropdown-toggle" type="button" data-toggle="dropdown">
			<?php _e( 'Notifications', 'wptouch-pro' ); ?>
		</button>
		<span class="number" style="display: none;"></span>

		<div class="dropdown-menu notifications-div" role="menu" aria-labelledby="notification-drop">
			<span id="ajax-notifications"></span>
		</div><!-- drop-down menu -->
	</div>