<?php
/*
	Section: Comments
	Author: PageLines
	Author URI: http://www.pagelines.com
	Description: Adds comments to main on pages/single posts
	Class Name: PageLinesComments
	Filter: social
	Isolate: single
*/

/**
 * Comments Section
 *
 * @package PageLines DMS
 * @author PageLines
 */
class PageLinesComments extends PageLinesSection {

	/**
	* Section template.
	*/
	function section_template() {

		// Important! Comments.php must be in theme root to work properly. Also 'comments_template() function must be used. Its a wordpress thing.

		global $post;
		comments_template();
	}
}