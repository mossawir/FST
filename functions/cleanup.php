<?php

/*
Clean up wp_head()
*/
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

/*
Show less info to users on failed login for security.
(Will not let a valid username be known.)
*/
function show_less_login_info() { 
    return "<strong>ERROR</strong>: Stop guessing!"; }
add_filter( 'login_errors', 'show_less_login_info' );

/*
Do not generate and display WordPress version
*/
function no_generator()  { 
    return ''; }
add_filter( 'the_generator', 'no_generator' );	

/*
Filter to remove comment author website link
============================================
Use this if you wish to cut down the amount of spammers in your comments (while retaining the "Your website" comment field).
See http://www.wpsquare.com/remove-comment-author-website-link-wordpress/
*/
function author_link(){
	global $comment;
	$comment_ID = $comment->user_id;
	$author = get_comment_author( $comment_ID );
	$url = get_comment_author_url( $comment_ID );
	if ( empty( $url ) || 'http://' == $url )
		$return = $author;
	else
		$return = "$author";
	return $return;
}
add_filter('get_comment_author_link', 'author_link');

?>
