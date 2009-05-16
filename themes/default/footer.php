	<div id="footer">
	<ul id="links">
		 <li><a onclick="javascript:document.getElementById('switch-on').style.display='none';javascript:document.getElementById('switch-off').style.display='block';" href="<?php echo bloginfo('home') . '/?theme_view=normal'; ?>"class="text"><?php _e( "Mobile Theme", "wptouch" ); ?></a><img id="switch-on" src="<?php echo compat_get_plugin_url( 'wptouch' ); ?>/images/on.jpg" alt="on switch image" class="wptouch-switch-image" /><img id="switch-off" style="display:none" src="<?php echo compat_get_plugin_url( 'wptouch' ); ?>/images/off.jpg" alt="off switch image" class="wptouch-switch-image" /></li>
	</ul>

			<?php _e( "All content Copyright &copy;", "wptouch" ); ?> <?php $str = bnc_get_header_title(); echo stripslashes($str); ?>
			<br />
			<?php _e( 'Powered by <a href="http://www.wordpress.org/">WordPress</a> with', 'wptouch' ); ?> <a href="http://www.wptouch.com"><?php WPtouch(); ?></a>
	<?php if ( !bnc_wptouch_is_exclusive() ) { wp_footer(); } ?>
	</div>
<br />
<?php wptouch_get_stats(); 
//WPtouch theme designed and developed by Dale Mugford and Duane Storey for BraveNewCode.com
//If you modify it, please keep the link credit *visible* in the footer (and keep the WordPress credit, too!), that's all we ask, folks.
?>
</body>
</html>