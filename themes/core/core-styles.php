<!-- These styles pull info from the WPtouch admin panel. you can override them, if you wish -->
<style type="text/css">
#headerbar {
	width: 100%;
	background: #<?php echo bnc_get_header_background(); ?> url(<?php echo compat_get_plugin_url( 'wptouch' ); ?>/themes/core/core-images/head-fade-bk.png) repeat-x;
}
#headerbar-title, #headerbar-title a {
	color: #<?php echo bnc_get_header_color(); ?>;
}
#wptouch-menu-inner a:hover {
	color: #<?php echo bnc_get_link_color(); ?>;
}
#catsmenu-inner a:hover {
	color: #<?php echo bnc_get_link_color(); ?>;
}
#drop-fade {
background: #<?php echo bnc_get_header_border_color(); ?>;
}
a {
	text-decoration: none;
	color: #<?php echo bnc_get_link_color(); ?>;
}
.mainentry, .pageentry, #wptouch-links, #wptouch-archives, #singlentry, .comwrap, #catsmenu-inner li, #wptouch-menu-inner li, #drop-fade a{
	-webkit-text-size-adjust: <?php echo bnc_get_zoom_state(); ?>;
}
</style>