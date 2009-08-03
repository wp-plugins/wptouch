<?php
/*
   Plugin Name: WPtouch Prowl Messages
   Plugin URI: http:/www.wptouch.com
   Description: A plugin which adds push notifications to WPtouch.
	Author: Dale Mugford & Duane Storey
	Version: 1.9
	Author URI: http://www.bravenewcode.com
   
	# Special thanks to Henrik Urlund who's 'Prowl Me' plugin was used as the basis for this addition.
	
	# Copyright (c) 2008-2009 Duane Storey & Dale Mugford of BraveNewCode Inc.
	
	# This plugin is free software; you can redistribute it and/or
	# modify it under the terms of the GNU Lesser General Public
	# License as published by the Free Software Foundation; either
	# version 2.1 of the License, or (at your option) any later version.
	
	# THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
	# EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
	# MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
	# NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
	# LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
	# OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
	# WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE. 
	#
	# See the GNU lesser General Public License for more details.
*/

// make sure the session is started
session_start();

/**
 * If possible, define constants, otherwise they need to be set!
 * (will be set on first load - they can be changed in WP admin)
 **/

define('APIKEY', get_option('wptouchprowl_apikey'));
define('APPNAME', 'WPtouch');

class wptouchprowl
{
	private $options;
	
        public function __construct()
        {
		
		// Add shortcode to plugin
		add_shortcode('wptouch-prowl', array(&$this, 'wptouchprowl'));
		
		// Add settings menu
		add_action('admin_menu', array($this, 'my_plugin_menu'));
		
		// add/remove settings on activation/deactivation
		register_deactivation_hook(__FILE__, array($this, 'deactivation'));
		register_activation_hook(__FILE__, array($this, 'activation'));
		
	}

	public function my_plugin_menu()
	{
		add_options_page('WPtouch Prowl Options', 'WPtouch Prowl', 8, 'prowl-me', array($this, 'options_panel'));
	}
	
	public function activation()
	{
		add_option('wptouchprowl_apikey', '', '', 'yes');
		add_option('wptouchprowl_nummsg', '3', '', 'yes');
	}
	
	public function deactivation()
	{
		delete_option('wptouchprowl_apikey');
		delete_option('wptouchprowl_nummsg');
	}
	
	/**
	 * What to do - what to do ... this will find out
	 **/
	
	public function wptouchprowl($atts)
	{
		$txt = '
		<form method="post" action="" id="wptouchprowl">
			<fieldset>
			<legend>WPtouch Prowl Message</legend>
			';
			
			if($_POST["submitprowl"])
				$txt .= $this->prowlmsg($_POST);
			else
				$txt .= $this->buildform();
			
			$txt .= '</fieldset>
		</form>
		';
			
		return $txt;
	}
	
	/**
	 * This shows the form in the WP frontend
	 **/
	
	private function buildform()
	{
		// make 2 random numbers to be used in spam check
		$no1 = rand(1, 9);
		$no2 = rand(1, 9);
		
		// save them - so they can be used on submit
		$_SESSION["spam_check"] = $no1 + $no2;
		
		return '
		<p>
			<label for="yourname">Name:</label><input type="text" name="yourname" class="wptouchprowl_text" />
		</p>
		<p>
			<label for="youremail">* E-mail:</label><input type="text" name="youremail" class="wptouchprowl_text" />
		</p>
		<p>
			<label for="yourmsg">* Message:</label><textarea name="yourmsg" class="wptouchprowl_textarea"></textarea>
		</p>
		<p>
			<label for="spamcheck" class="label_wptouchprowl_spamcheck">'. $no1 .'&nbsp;&nbsp;&#43;&nbsp;&nbsp;'. $no2 .'&nbsp;&nbsp;= </label><input type="text" name="spamcheck" class="wptouchprowl_spamcheck" />
		</p>
		<p>
			<input type="submit" name="submitprowl" value="Send" class="wptouchprowl_submit" />
			<input type="hidden" name="uniqid" value="'. md5(uniqid()) .'" />
		</p>
		';
	}
	
	/**
	 * This function will send the msg, if all conditions are met
	 **/
	
	private function prowlmsg($post)
	{
		// check if the first time - or user reloaded the page
		if($_POST["uniqid"] != $_SESSION["uniqid"])
		{
			// Check if maximum prowls have been sent
			if(get_option('wptouchprowl_nummsg') > 0)
			{
				if($_SESSION["msgsent"] >= get_option('wptouchprowl_nummsg'))
					return '<p>Sorry, you cant send me anymore messages right now.</p>';
			}
			
			// If you cant do the math, lets "thow" an error
			if($_POST["spamcheck"] != $_SESSION["spam_check"])
				return '<p>Sorry, check the math and try again.</p>';
			
			// If spam check was okay lets clean up the text
			$name	= $this->cleanupmsg($_POST["yourname"]);
			$email	= $this->cleanupmsg($_POST["youremail"]);
			$msg	= $this->cleanupmsg($_POST["yourmsg"]);
			
			// If anything is empty, lets "throw" an error
			if(strlen($email) == 0 || strlen($msg) == 0)
				return '<p>An e-mail address and message is required.</p>';
			
			// now everything is okay - lets get the prowl
			require_once('class.prowl.php');
			$prowl = new Prowl(APIKEY, APPNAME);
			
			// now try to send the msg
			$result = $prowl->add(1, "Direct Message", 'From: '. $name . "\nE-Mail: ". $email ."\nMessage: ". $msg);
			
			// now check if the msg was sent - let them know
			if(strlen($result) == 1)
			{
				// If you reach this point, the msg have been sent - lets block for refresh, by saving the uniqid
				$_SESSION["uniqid"] = $_POST["uniqid"];
				
				// Count numbers of sent msg
				$_SESSION["msgsent"]++;
				
				return '<p>Thank you for your message.</p>';
			}
			else
				return '<p>Ooops, something happend, please try again!</p><p><em>Error: "'. $result .'"</em></p>';
		}
		else
			return '<p>Please don\'t reload the page, thanks.</p>';
	}
	
	/**
	 * This function takes care of the msg format, so it will be shown the way it was intented on iPhone
	 **/
	
	private function cleanupmsg($string)
	{
		$string = str_replace("\r\n","\n", $string);
		$string = str_replace("\r","\n", $string);
		return $string;
	}
	
	public function options_panel()
	{
		echo '
		<div class="wrap">
		<h2>WPtouch Prowl Messages</h2>
		
		<form method="post" action="options.php">
		';
		
		wp_nonce_field('update-options');
		
		echo '
		
		<table class="form-table">
		
		<tr valign="top">
		<th scope="row">API key:</th>
		<td><input type="text" name="wptouchprowl_apikey" value="'. get_option('wptouchprowl_apikey') .'" /> <a href="http://prowl.weks.net/" target="_blank">Get API key</a></td>
		</tr>
		
		<tr valign="top">
		<th scope="row">Messages per session: </th>
		<td><input type="text" name="wptouchprowl_nummsg" value="'. get_option('wptouchprowl_nummsg') .'" /> 0 = unlimited</td>
		</tr>
		
		</table>
		
		<input type="hidden" name="action" value="update" />
		<input type="hidden" name="page_options" value="wptouchprowl_apikey,wptouchprowl_nummsg" />
		
		<p class="submit">
		<input type="submit" class="button-primary" value="Save settings" />
		</p>
		
		</form>
		</div>
		';
	}
}

// make an instance of wptouchprowl
$wptouchprowl = new wptouchprowl();
?>