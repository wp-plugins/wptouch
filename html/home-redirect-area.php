
<div class="wptouch-itemrow home-page-block">
	<div class="wptouch-item-desc">
		<h2>Home Page Redirection</h2>
		<p>For your home page, WPtouch respects the front page behavior you've defined in the <a href="options-reading.php">WordPress -> Reading Options.</a></p>
	</div>

	<div class="wptouch-item-content-box1">
		<div class="header-item-desc">
			If you'd like a different home page (your posts page for example)<br />select it from the list below.<br /><br />
		</div>
	
		<div class="wptouch-select-row">
			<?php $sel = bnc_get_page_id_with_name( bnc_get_selected_home_page() ); ?>
			<div class="wptouch-select-left">
				<label for="home-page">Override Home Page</label>
			</div>
			
			<div class="wptouch-select-right">
				<?php wp_dropdown_pages( 'show_option_none=Default&name=home-page&selected=' . bnc_get_selected_home_page()); ?>
			</div>
		</div>
	
		<div class="clear"></div>
	</div>
</div>

