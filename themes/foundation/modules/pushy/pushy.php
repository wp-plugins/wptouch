<?php

add_action( 'foundation_module_init_mobile', 'foundation_pushy_init' );

function foundation_pushy_init() {

	// Pushy CSS is added in Foundation's default/style.css file

	wp_enqueue_script(
		'foundation_pushy_modernizr',
		foundation_get_base_module_url() . '/pushy/modernizr.js',
		array( 'jquery' ),
		FOUNDATION_VERSION,
		true
	);

	wp_enqueue_script(
		'foundation_pushy',
		foundation_get_base_module_url() . '/pushy/pushy.js',
		array( 'foundation_pushy_modernizr' ),
		FOUNDATION_VERSION,
		true
	);
}
