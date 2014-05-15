<?php if ( wptouch_show_renewal_notice() ) { ?>
</tr>
<tr class="plugin-update-tr">
	<td colspan="5" class="plugin-update">
		<div class="update-message">
			<?php echo sprintf( __( 'Your product license has expired. %sRenew now%s to continue to receive feature and security updates.', 'wptouch-pro' ), '<a href="http://www.wptouch.com/renew/?utm_campaign=renew-plugin-page&utm_medium=web&utm_source=wptouch">', '</a>' ); ?>
		</div>
	</td>
</tr>
<?php } else if ( wptouch_should_show_license_nag() ) { ?>
</tr>
<tr class="plugin-update-tr">
	<td colspan="5" class="plugin-update">
		<div class="update-message">
			<?php if ( wptouch_should_show_activation_nag() ) { ?>
				<?php echo sprintf( __( 'This copy of WPtouch Pro is unlicensed! Please %sactivate your license%s, or %spurchase a license%s to enable automatic updates and full product support from us!', 'wptouch-pro' ), '<a href="' . wptouch_get_license_activation_url() . '">', '</a>', '<a href="http://www.wptouch.com/?utm_source=license_nag&utm_medium=web&utm_campaign=wptouch3_upgrades">', '</a>' ); ?>
			<?php } else { ?>
				<?php _e( 'This copy of WPtouch Pro is unlicensed! Please contact the site administrator regarding product licensing.', 'wptouch-pro' ); ?>
			<?php } ?>
		</div>
	</td>
</tr>
<?php } ?>