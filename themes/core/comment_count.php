<?php
/*
Provides WPtouch with functions that return or display the number of trackbacks, 
pingbacks, comments or combined pings recieved by a given post.
Authors: Mark Jaquith, Chris J. Davis, Scott "Skippy" Merrill
*/

/*

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.	See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA	 02110-1301, USA.

*/

function wptouch_get_comment_type_count($type='all', $post_id = 0) {
	global $wptouch_comment_count_cache, $id, $post;
	if ( !$post_id )
		$post_id = $post->ID;
	if ( !$post_id )
		return;

	if ( !isset($wptouch_comment_count_cache[$post_id]) ) {
		$p = get_post($post_id);
		$p = array($p);
		update_comment_type_cache($p);
	}

	if ( $type == 'pingback' || $type == 'trackback' || $type == 'comment' )
		return $wptouch_comment_count_cache[$post_id][$type];
	elseif ( $type == 'ping' )
		return $wptouch_comment_count_cache[$post_id]['pingback'] + $wptouch_comment_count_cache[$post_id]['trackback'];
	else
		return array_sum((array) $wptouch_comment_count_cache[$post_id]);

}

function wptouch_comment_type_count($type = 'all', $post_id = 0) {
		echo wptouch_get_comment_type_count($type, $post_id);
}


function wptouch_update_comment_type_cache(&$queried_posts) {
	global $wptouch_comment_count_cache, $wpdb;

	if ( !$queried_posts )
		return $queried_posts;


	foreach ( (array) $queried_posts as $post )
		if ( !isset($wptouch_comment_count_cache[$post->ID]) )
			$post_id_list[] = $post->ID;

	if ( $post_id_list ) {
		$post_id_list = implode(',', $post_id_list);

		foreach ( array('', 'pingback', 'trackback') as $type ) {
			$counts = $wpdb->get_results("SELECT ID, COUNT( comment_ID ) AS ccount
			FROM $wpdb->posts
			LEFT JOIN $wpdb->comments ON ( comment_post_ID = ID AND comment_approved = '1' AND comment_type='$type' )
			WHERE post_status = 'publish' AND ID IN ($post_id_list)
			GROUP BY ID");

			if ( $counts ) {
				if ( '' == $type )
					$type = 'comment';
				foreach ( $counts as $count )
					$wptouch_comment_count_cache[$count->ID][$type] = $count->ccount;
			}
		}
	}
	return $queried_posts;
}

add_filter('the_posts', 'wptouch_update_comment_type_cache');
?>