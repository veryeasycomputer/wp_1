<?php 



// ------------------------------------------
// Using Custom Templates
// ------------------------------------------

function pl_get_template_region_attributes(){
	global $pl_custom_template; 
	
	if(! empty( $pl_custom_template ) ){
		
		$attr = sprintf(
			'class="pl-region custom-template editing-locked" data-custom-template="%s" data-template-name="%s"', 
			$pl_custom_template['key'], 
			stripslashes( $pl_custom_template['name'] )
		);
		
	} else 
		$attr = 'class="pl-region"';
		
	return $attr;
}

// ------------------------------------------
// Multisite - Form Wrapper
// ------------------------------------------

add_action('before_signup_form', 'add_multisite_markup_top');
function add_multisite_markup_top(){
	printf('<section id="multisite_area" class="content"><div class="content-pad">');
}

add_action('after_signup_form', 'add_multisite_markup_bottom');
function add_multisite_markup_bottom(){
	printf('</div></section>');
}

// ------------------------------------------
// JS on Comment Form
// ------------------------------------------
add_action( 'comment_form_before', 'pl_comment_form_js' );
function pl_comment_form_js() {
	if ( get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
}

add_action( 'pagelines_after_footer', 'pagelines_after_footer_elements' );
function pagelines_after_footer_elements() {
	
	if( ! pl_is_pro() && ! pl_draft_mode() ): ?>
	<a class="pl-credit" href="http://www.pagelines.com/" title="Built with PageLines DMS [basic]" target="_blank">
		<i class="icon icon-pagelines pl-transit"></i> <span class="fademein">DMS</span>
	</a>
	<?php endif; 
	
	if( pl_setting('supersize_bg') && pl_setting( 'page_background_image_url' ) )
		echo '<div id="supersized"></div>';

}



/**
 * Special content wrap is for plugins that operate outside of pagelines
 * We started doing things manually, so there are legacy extensions still using manual methodology
 *
 * @uses $pagelines_render // this is set in the main pagelines setup_pagelines_template(); function
 **/
function do_special_content_wrap(){
	global $pagelines_render;
	
	if( isset($pagelines_render) )
		return false;
	else
		return true;
}

function pagelines_special_content_wrap_top(){

	if(do_special_content_wrap()){
		
		$integration = new PageLinesIntegrationHandler;
		
		$integration->start_new_integration();
	}

}


/**
 * PageLines Body Classes
 *
 * Sets up classes for controlling design and layout and is used on the body tag
 *
 */
function pagelines_body_classes(){

	global $pagelines_addclasses, $plpg, $pl_custom_template;
	
	$special_body_class = (pl_setting('special_body_class')) ? pl_setting('special_body_class') : '';
	
	$classes = array();
	
	$classes[] = $special_body_class;
	// child theme name
	$classes[] = sanitize_html_class( strtolower( PL_CHILDTHEMENAME ) );
	// pro
	$classes[] = (pl_is_pro()) ? 'pl-pro-version' : 'pl-basic-version';
	
	// for backwards compatiblity, dms is:
	$classes[] = 'responsive';
	$classes[] = 'full_width';

	// externally added via global variable (string)
	if ( isset( $pagelines_addclasses ) && $pagelines_addclasses )
		$classes = array_merge( $classes, (array) explode( ' ', $pagelines_addclasses ) );

	$template = ( isset( $pl_custom_template['key'] ) ) ? $pl_custom_template['key'] : 'none';
	
	$classes[] = sprintf( 'template-%s', $template );

	// ensure no duplicates or empties
	$classes = array_unique( array_filter( $classes ) );
	// filter & convert to string
	$body_classes = join(' ', (array) apply_filters('pagelines_body_classes', $classes) );

	return $body_classes;
}


/**
 * Adds classes to body
 */
function pagelines_add_bodyclass( $class ) {

	global $pagelines_addclasses;

	if ( !isset( $pagelines_addclasses ) )
		$pagelines_addclasses = '';

	if ( isset( $class ) )
		$pagelines_addclasses .= sprintf( ' %s', $class );

}

