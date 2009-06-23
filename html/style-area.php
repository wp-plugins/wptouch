<?php global $wptouch_settings; ?>

<div class="metabox-holder">
	<div class="postbox">
		<h3><?php _e( "Style &amp; Color Options", "wptouch" ); ?></h3>

			<div class="wptouch-left-content skins-left-content">
				<p><img src="<?php echo compat_get_plugin_url( 'wptouch' ); ?>/images/skins/skins-title.jpg" alt="" /></p>
				<p><?php _e( "Skins are built around colour palettes for enhanced customization. Choose a skin that works with your website’s colours.", "wptouch" ); ?></p>
				 <p><?php _e( "Skins also come with unique backgrounds and other style customizations to enhance WPtouch.", "wptouch" ); ?></p>
				 <p><?php _e( "If a skin has options they will be shown here.", "wptouch" ); ?></p>
			</div>
		
			<div class="wptouch-right-content skins-fixed">
				 <div id="skins-menu">
					 <ul>
						 <li><a href="#" class="active">Default</a></li>
						 <li><a href="#">Lavender</a></li>
						 <li><a href="#">Sunkissed</a></li>
						 <li><a href="#">Frog</a></li>
						 <li><a href="#">Sea</a></li>
					 </ul>
				 </div>

				<!-- 

<br />

				<ul class="wptouch-make-li-italic wptouch-select-options">
					<li>
					<select name="style-skin">
						<option <?php if ($wptouch_settings['style-skin'] == "default-skin") echo " selected"; ?> value="default-skin"><?php _e( "Default", "wptouch" ); ?></option>
						<option <?php if ($wptouch_settings['style-skin'] == "cocoa-skin") echo " selected"; ?> value="mono-skin"><?php _e( "Cocoa", "wptouch" ); ?></option>
						<option <?php if ($wptouch_settings['style-skin'] == "sunkissed-skin") echo " selected"; ?> value="conflower-skin"><?php _e( "Sunkissed", "wptouch" ); ?></option>
						<option <?php if ($wptouch_settings['style-skin'] == "frog-skin") echo " selected"; ?> value="frog-skin"><?php _e( "Frog", "wptouch" ); ?></option>
						<option <?php if ($wptouch_settings['style-skin'] == "sea-skin") echo " selected"; ?> value="sea-skin"><?php _e( "Sea", "wptouch" ); ?></option>															
						<option <?php if ($wptouch_settings['style-skin'] == "lavender-skin") echo " selected"; ?> value="lavender-skin"><?php _e( "Lavender", "wptouch" ); ?></option>																		</select>
					<?php _e( "WPtouch Theme Skin (will update colors above)", "wptouch" ); ?>					
					</li>
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
				-->
		<div class="skins-desc" style="display:none"> <!-- Lavender -->
			<h4><?php _e( "Lavender", "wptouch" ); ?></h4>
			<p><?php _e( "Lavender features lush deep plum purples.", "wptouch" ); ?></p>
			<p><?php _e( "There are no configurable options for this skin.", "wptouch" ); ?></p>
			<img src="<?php echo compat_get_plugin_url( 'wptouch' ); ?>/images/skins/lavender.jpg" alt="" />
		</div>

		<div class="skins-desc"> <!-- Default -->
			<h4><?php _e( "Default", "wptouch" ); ?></h4>
			<p><?php _e( "The default WPtouch skin emulates a native iPhone application.", "wptouch" ); ?></p>
			<ul class="wptouch-make-li-italic">
				<li>#<input type="text" id="header-text-color" name="header-text-color" value="<?php echo $wptouch_settings['header-text-color']; ?>" /><?php _e( "Site title text", "wptouch" ); ?></li>
				<li>#<input type="text" id="header-background-color" name="header-background-color" value="<?php echo $wptouch_settings['header-background-color']; ?>" /><?php _e( "Header background", "wptouch" ); ?></li>
				<li>#<input type="text" id="header-border-color" name="header-border-color" value="<?php echo $wptouch_settings['header-border-color']; ?>" /><?php _e( "Sub-header background", "wptouch" ); ?></li>
				<li>#<input type="text" id="link-color" name="link-color" value="<?php echo $wptouch_settings['link-color']; ?>" /><?php _e( "Site-wide links", "wptouch" ); ?></li>
			</ul> 
			<img src="<?php echo compat_get_plugin_url( 'wptouch' ); ?>/images/skins/lavender.jpg" alt="" />
		</div>


		</div><!-- right content -->
	<div class="wptouch-clearer"></div>
	</div><!-- postbox -->
</div><!-- metabox -->