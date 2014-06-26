<?php

function wptouch_admin_is_post_type_checked() {
	global $_primed_setting;
	
	$settings = wptouch_get_settings( $_primed_setting->domain );
	
	if ( $settings ) {
		$name = $_primed_setting->name;
		preg_match('/\[(.*?)\]/', $name, $matches );
		$matches[0] = str_replace( array('[',']') , ''  , $matches[0] );

		if ( !is_object( $settings->enabled_custom_post_types ) ) {
			$enabled_post_types = maybe_unserialize( stripslashes( $settings->enabled_custom_post_types ) );
		} else {
			$enabled_post_types = $settings->enabled_custom_post_types;
		}

		if ( is_array( $enabled_post_types ) && array_key_exists( $matches[0], $enabled_post_types ) ) {
			return true;
		}
	} 
		
	return false;
}