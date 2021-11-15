<?php
/**
 * XSimplyChild posted on and posted by filters
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package XSimplyChild
 * @since 1.0.0
 */

/*
 * Functions mapping
 */
 // none required. This files only overrides existing function from original theme
 
/*
 * Removes dates on postes
 */
if (!function_exists('xsimply_posted_on')):
	
	/**
	 * Overrrides the theme function to remove dates on postes.
	 */
	function xsimply_posted_on() {}
endif;

/*
 * Overrides the author info at the begining of a post
 */
if (!function_exists('xsimply_posted_by')):
	
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function xsimply_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'xsimply' ),
			'<span class="author vcard"><strong>'. esc_html( get_the_author() ). '</strong></span>'
		);
		
		//get_the_author_meta( 'ID' ) //get_avatar('sebastien@linuxstairway.com')
		
		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;
