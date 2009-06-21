<?php global $wptouch_settings; ?>

<div class="metabox-holder">
	<div class="postbox">
		<h3><?php _e( "Style &amp; Color Options", "wptouch" ); ?></h3>

			<div class="wptouch-left-content">
				<p><?php _e( "Customize the look of WPtouch on your website.", "wptouch" ); ?></p>
				<p><?php _e( "A colorpicker box will assist you in picking colors.", "wptouch" ); ?></p>
				<!-- <p><?php _e( "You can also use one of our preset skins, which will update your colors automatically.", "wptouch" ); ?></p>
				 <p><?php _e( "Skins also come with unique backgrounds and other style customizations to enhance WPtouch.", "wptouch" ); ?></p> -->
			</div>
		
			<div class="wptouch-right-content">
				<ul class="wptouch-make-li-italic">
					<li><input type="text" id="header-text-color" name="header-text-color" value="<?php echo $wptouch_settings['header-text-color']; ?>" /><?php _e( "Site title text hex color", "wptouch" ); ?></li>
					<li><input type="text" id="header-background-color" name="header-background-color" value="<?php echo $wptouch_settings['header-background-color']; ?>" /><?php _e( "Header background hex color", "wptouch" ); ?></li>
					<li><input type="text" id="header-border-color" name="header-border-color" value="<?php echo $wptouch_settings['header-border-color']; ?>" /><?php _e( "Sub-header background hex color", "wptouch" ); ?></li>
					<li><input type="text" id="link-color" name="link-color" value="<?php echo $wptouch_settings['link-color']; ?>" /><?php _e( "Site-wide link hex color", "wptouch" ); ?></li>
				</ul>

<br />

				<ul class="wptouch-make-li-italic wptouch-select-options">
					<!--<li>
					<select name="style-skin">
						<option <?php if ($wptouch_settings['style-skin'] == "default-skin") echo " selected"; ?> value="default-skin"><?php _e( "Default", "wptouch" ); ?></option>
						<option <?php if ($wptouch_settings['style-skin'] == "cocoa-skin") echo " selected"; ?> value="mono-skin"><?php _e( "Cocoa", "wptouch" ); ?></option>
						<option <?php if ($wptouch_settings['style-skin'] == "sunkissed-skin") echo " selected"; ?> value="conflower-skin"><?php _e( "Sunkissed", "wptouch" ); ?></option>
						<option <?php if ($wptouch_settings['style-skin'] == "frog-skin") echo " selected"; ?> value="frog-skin"><?php _e( "Frog", "wptouch" ); ?></option>
						<option <?php if ($wptouch_settings['style-skin'] == "sea-skin") echo " selected"; ?> value="sea-skin"><?php _e( "Sea", "wptouch" ); ?></option>															
						<option <?php if ($wptouch_settings['style-skin'] == "lavender-skin") echo " selected"; ?> value="lavender-skin"><?php _e( "Lavender", "wptouch" ); ?></option>																		</select>
					<?php _e( "WPtouch Theme Skin (will update colors above)", "wptouch" ); ?>					
					</li>-->
					<li><select name="style-background">
							<option <?php if ($wptouch_settings['style-background'] == "classic-wptouch-bg") echo " selected"; ?> value="classic-wptouch-bg"><?php _e( "Classic", "wptouch" ); ?></option>
							<option <?php if ($wptouch_settings['style-background'] == "horizontal-wptouch-bg") echo " selected"; ?> value="horizontal-wptouch-bg"><?php _e( "Horizontal Grey", "wptouch" ); ?></option>
							<option <?php if ($wptouch_settings['style-background'] == "diagonal-wptouch-bg") echo " selected"; ?> value="diagonal-wptouch-bg"><?php _e( "Diagonal Grey", "wptouch" ); ?></option>
							<option <?php if ($wptouch_settings['style-background'] == "skated-wptouch-bg") echo " selected"; ?> value="skated-wptouch-bg"><?php _e( "Skated Concrete", "wptouch" ); ?></option>
							<option <?php if ($wptouch_settings['style-background'] == "argyle-wptouch-bg") echo " selected"; ?> value="argyle-wptouch-bg"><?php _e( "Argyle Tie", "wptouch" ); ?></option>
							<option <?php if ($wptouch_settings['style-background'] == "grid-wptouch-bg") echo " selected"; ?> value="grid-wptouch-bg"><?php _e( "Thatches", "wptouch" ); ?></option>
						</select>
						<?php _e( "Background image", "wptouch" ); ?>
					</li>
				</ul>	
		</div><!-- right content -->
	<div class="wptouch-clearer"></div>
	</div><!-- postbox -->
</div><!-- metabox -->