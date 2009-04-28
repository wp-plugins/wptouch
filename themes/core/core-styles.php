<!-- These styles pull info from the WPtouch admin panel. you can override them, if you wish -->
<style type="text/css">
#menubar {
	width: 100%;
	height: 45px !important;
	background: #<?php echo bnc_get_header_background(); ?> url(<?php bloginfo('template_directory'); ?>/images/head-fade-bk.png) repeat-x;
}
#blogtitle a {
	text-decoration: none;
	font: 21px HelveticaNeue-Bold, sans-serif;
	letter-spacing: -1px;
	position: relative;
	color: #<?php echo bnc_get_header_color(); ?>;
}
#dropmenu-inner a:hover {
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
.mainentry, .pageentry, #wptouch-links, #wptouch-archives, #singlentry, .comwrap, #catsmenu-inner li, #dropmenu-inner li, #drop-fade a{
	-webkit-text-size-adjust: <?php echo bnc_get_zoom_state(); ?>;
}
</style>