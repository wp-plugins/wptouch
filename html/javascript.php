<script type="text/javascript">
	$j = jQuery.noConflict();
	$j(document).ready(function(){
		new Ajax_upload('#upload_button', {
			action: '<?php echo get_bloginfo('wpurl'); ?>/?wptouch=upload',
			autoSubmit: true,
			name: 'submitted_file',
			onSubmit: function(file, extension) { $j = jQuery.noConflict(); $j("#upload_progress").show(); },
			onComplete: function(file, response) { $j = jQuery.noConflict(); $j("#upload_progress").hide();
			$j('#upload_response').hide().html(response).fadeIn(); }
	});
	
	$j("a.wptouch-fancylink").fancybox({
		'padding':						5,
		'imageScale':					true,
		'zoomSpeedIn':				250, 
		'zoomSpeedOut':			250,
		'zoomOpacity':				true, 
		'overlayShow':				false,
		'frameHeight':				250,
		'hideOnContentClick': 	true
	});

	jQuery.ajax({
		url: "<?php bloginfo('wpurl'); ?>/?wptouch=news",
		success: function(data) {
			jQuery("#wptouch-news-content").html(data).fadeIn();
		}});
	
	jQuery.ajax({
		url: "<?php bloginfo('wpurl'); ?>/?wptouch=beta",
		success: function(data) {
			jQuery("#wptouch-beta-content").html(data).fadeIn();
		}}); 
});

</script>