<?php

load_plugin_textdomain('pubgrowl'); // NLS
$location = get_option('siteurl') . '/wp-admin/admin.php?page=options-growl.php'; // Form Action URI

add_option('pubgrowl_password', 'growlpassword');
add_option('pubgrowl_ip', 'growlip');
add_option('pubgrowl_comments', 'off');
add_option('pubgrowl_posts', 'off');
add_option('pubgrowl_registration', 'off');
add_option('pubgrowl_pageviews','off');


$pubgrowl_password = stripslashes(get_option('pubgrowl_password'));
$pubgrowl_ip = stripslashes(get_option('pubgrowl_ip'));
$pubgrowl_comments = stripslashes(get_option('pubgrowl_comments'));
$pubgrowl_posts = stripslashes(get_option('pubgrowl_posts'));
$pubgrowl_registration = stripslashes(get_option('pubgrowl_registration'));
$pubgrowl_pageviews = stripslashes(get_option('pubgrowl_pageviews'));

/*check form submission and update options*/
if ('process' == $_POST['stage'])
{
	require_once("class.growl.php");
	update_option('pubgrowl_password', $_POST['pubgrowl_password']);
	update_option('pubgrowl_ip', $_POST['pubgrowl_ip']);
	update_option('pubgrowl_comments', $_POST['pubgrowl_comments']);
	update_option('pubgrowl_posts', $_POST['pubgrowl_posts']);
	update_option('pubgrowl_registration', $_POST['pubgrowl_registration']);
	update_option('pubgrowl_pageviews', $_POST['pubgrowl_pageviews']);
	$g = new Growl("WPtouch Growl");
	$g->setAddress($pubgrowl_ip, $pubgrowl_password);
	$g->addNotification("New Comment");
	$g->addNotification("New Post");
	$g->addNotification("Pageview");
	$g->register();
}


?>

<div class="wrap"> 
  <h2><?php _e('WPtouch Growl Options', 'pubgrowl') ?></h2> 
  <?php echo $error_message; ?>
  <form name="form1" method="post" action="<?php echo $location ?>&amp;updated=true">
  	<input type="hidden" name="stage" value="process" />
  	<table width="100%" cellspacing="2" cellpadding="5" class="editform"> 
  	<tr valign="top"> 
		<th scope="row"><?php _e('Your IP:') ?></th>
		<td><input name="pubgrowl_ip" type="text" id="pubgrowl_ip" value="<?php echo $pubgrowl_ip; ?>" size="40" />
		<br />
	<?php _e('Your Computers IP or Hostname.', 'pubgrowl') ?>
		</td>
	</tr>
      <tr valign="top"> 
		<th scope="row"><?php _e('Growl Password:') ?></th>
		<td>
			<input name="pubgrowl_password" type="password" id="pubgrowl_password" value="<?php echo $pubgrowl_password; ?>" size="40" />
		<br />
	<?php _e('Your Growl password.', 'pubgrowl') ?>
		</td>
	</tr>
	<tr valign="top"> 
		<th scope="row"><?php _e('Notify Me of the Following Events:') ?></th>
		<td>
						
			<input name="pubgrowl_comments" type="checkbox" id="pubgrowl_comments" <?php if($pubgrowl_comments == "on") { echo "checked"; } ?> /> <?php _e('New Comments', 'pubgrowl') ?>
		</td>
	</tr>
	<tr valign="top"> 
		<th scope="row"></th>
		<td>
			<input name="pubgrowl_posts" type="checkbox" id="pubgrowl_posts" <?php if($pubgrowl_posts == "on") { echo "checked"; } ?> /> <?php _e('New Posts', 'pubgrowl') ?>
		</td>
	</tr>
	<tr valign="top"> 
		<th scope="row"></th>
		<td>
			<input name="pubgrowl_registration" type="checkbox" id="pubgrowl_registration" <?php if($pubgrowl_registration == "on") { echo "checked"; } ?> /> <?php _e('New Registrations', 'pubgrowl') ?>
		</td>
	</tr>
	<tr valign="top"> 
		<th scope="row"></th>
		<td>
			<input name="pubgrowl_pageviews" type="checkbox" id="pubgrowl_pageviews" <?php if($pubgrowl_pageviews == "on") { echo "checked"; } ?> /> <?php _e('Pageviews', 'pubgrowl') ?>
		</td>
	</tr>
	</table>
	<p class="submit">
      <input type="submit" name="Submit" value="<?php _e('Update Options', 'wpcf') ?> &raquo;" />
    </p>
  </form>
</div>