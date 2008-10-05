<?php
 
  //Favicon fetch and convert script
  //This script will convert favicons for the links listed on your Links page (if you have one).
  function bnc_url_exists($url)
  {
      // Version 4.x supported
      $handle = curl_init($url);
      if (false === $handle) {
          return false;
      }
      curl_setopt($handle, CURLOPT_HEADER, false);
      // this works
      curl_setopt($handle, CURLOPT_FAILONERROR, true);
      curl_setopt($handle, CURLOPT_NOBODY, true);
      curl_setopt($handle, CURLOPT_RETURNTRANSFER, false);
      curl_setopt($handle, CURLOPT_TIMEOUT, 1);
      $connectable = curl_exec($handle);
      $d = curl_getinfo($handle, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
      return($d > 0);
  }
  function bnc_get_ico_file($ico)
  {
      $d = file_get_contents($ico);
      if (!file_exists(bnc_get_local_dir() . '/cache')) {
          mkdir(bnc_get_local_dir() . '/cache', 0755);
      }
      file_put_contents(bnc_get_local_dir() . '/cache/' . md5($ico) . '.ico', $d);
      exec('sh convert ico:' . bnc_get_local_dir() . '/cache/' . md5($ico) . '.ico' . bnc_get_local_dir() . '/cache/' . md5($ico) . '.png');
  }
  function bnc_get_local_dir()
  {
      $dir = preg_split("#/plugins/wptouch/images/icon-pool/#", __FILE__, $test);
      return $dir[0] . '/plugins/wptouch/images/icon-pool';
  }
  function bnc_get_local_icon_url()
  {
      return get_bloginfo('wpurl') . '/wp-content/plugins/wptouch/images/';
  }
  function bnc_get_favicon_for_site($site)
  {
  // Yes we know this goes remote to handle things, but we do this to ensure that it works for everyone. No data is collected, as you can see.
      $i = 'http://keira-anne.com/test2.php?site=' . urlencode($site) . '&default=' . urlencode(bnc_get_local_icon_url() . '/icon-pool/default.png');
      return $i;
  }
?>