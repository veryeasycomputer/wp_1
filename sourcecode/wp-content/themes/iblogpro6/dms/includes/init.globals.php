<?php

/**
 * Start time and memory for performance metrics
 */
if( defined( 'PL_DEV' ) && PL_DEV ){
	global $pl_start_time, $pl_start_mem;
	$pl_start_time = microtime(TRUE);
	$pl_start_mem = memory_get_usage();
}

/**
 * Define framework version
 */
global $platform_build;

define( 'PL_CORE_VERSION', $platform_build );

define( 'PL_CHILD_VERSION', get_theme_mod( 'pagelines_child_version' ) );

/**
 * Set Theme Name
 */
$theme = 'PageLines';

define( 'PL_THEMENAME', $theme );
define( 'PL_CHILDTHEMENAME', get_option('stylesheet') );

define('PL_NICETHEMENAME', pl_get_theme_data( get_template_directory(), 'Name' ) );
define('PL_NICECHILDTHEMENAME',  pl_get_theme_data( get_stylesheet_directory(), 'Name' ) );

define('PL_PARENT_DIR', pl_get_template_directory() );
define('PL_THEME_DIR', get_template_directory() );
define('PL_CHILD_DIR', get_stylesheet_directory());

define('PL_PARENT_URL', pl_get_template_directory_uri() );
define('PL_THEME_URL', get_template_directory_uri() );
define('PL_CHILD_URL', get_stylesheet_directory_uri());
define('PL_CHILD_IMAGES', PL_CHILD_URL . '/images' );

// if( ! defined( 'PL_LESS_DEV' ) )
// 	define( 'PL_LESS_DEV', false );

// Define Settings Constants for option DB storage
define( 'PAGELINES_SETTINGS', apply_filters( 'pagelines_settings_field', 'pagelines-settings-two' ));
define( 'PAGELINES_EXTENSION', apply_filters( 'pagelines_settings_extension', 'pagelines-extension' ));
define( 'PAGELINES_ACCOUNT', apply_filters( 'pagelines_settings_account', 'pagelines-account' ));
define( 'PAGELINES_SPECIAL', apply_filters( 'pagelines_settings_special', 'pagelines-special' ));
define( 'PAGELINES_TEMPLATES', apply_filters( 'pagelines_settings_templates', 'pagelines-templates' ));
define( 'PAGELINES_TEMPLATE_MAP', apply_filters( 'pagelines_settings_map', 'pagelines-template-map-two' ));

// Active Integrations (adds options in core)
define( 'PAGELINES_INTEGRATIONS', 'pagelines-integrations-handling' );

// Legacy Settings Fields >> ALLOWS FOR REVERT
define( 'PAGELINES_SETTINGS_LEGACY', 'pagelines-settings' );
define( 'PAGELINES_TEMPLATE_MAP_LEGACY', 'pagelines_template_map' );

// Define PL Admin Paths
define( 'PL_ADMIN', pl_get_template_directory() . '/admin' );
define( 'PL_ADMIN_URI', PL_PARENT_URL . '/admin' );

define( 'PL_ADMIN_IMAGES', PL_ADMIN_URI . '/images' );
define( 'PL_ADMIN_ICONS', PL_ADMIN_IMAGES . '/icons' );

define('PL_MAIN_DASH', 'PageLines-Admin');
define('PL_ADMIN_STORE_SLUG', 'pagelines_extend');
define('PL_SPECIAL_OPTS_SLUG', 'pagelines_special');


define('PL_SETTINGS_SLUG', 'PageLines-Admin');
define('PL_SETTINGS_URL', 'admin.php?page='.PL_SETTINGS_SLUG);
define('PL_IMPORT_EXPORT_URL', 'admin.php?page='.PL_MAIN_DASH);
define('PL_DASH_URL', 'admin.php?page='.PL_MAIN_DASH);
define('PL_ACCOUNT_URL', 'admin.php?page='.PL_MAIN_DASH.'&rand='.rand().'#Your_Account'); // rand forces page reload
define('PL_ADMIN_STORE_URL', 'admin.php?page='.PL_ADMIN_STORE_SLUG);
define('PL_TEMPLATE_SETUP_URL', 'admin.php?page=pagelines_templates');
define('PL_SPECIAL_OPTS_URL', 'admin.php?page=pagelines_special');

define( 'PL_EDITOR', pl_get_template_directory() . '/editor' );
define( 'PL_EDITOR_URL', pl_get_template_directory_uri() . '/editor' );
/**
 * Define theme path constants
 */
define('PL_SECTIONS', pl_get_template_directory() . '/sections');

/**
 * Define web constants
 */
define('PL_SECTION_ROOT', PL_PARENT_URL . '/sections');

/**
 * Define theme web constants
 */
define('PL_CSS', PL_PARENT_URL . '/css');
define('PL_JS', PL_PARENT_URL . '/js');
define('PL_IMAGES', PL_PARENT_URL . '/images');

/**
 * Define Extension Constants
 */

define( 'EXTEND_CHILD_DIR', WP_PLUGIN_DIR . '/pagelines-customize' );
define( 'EXTEND_CHILD_URL', plugins_url( 'pagelines-customize' ) );
define( 'EXTEND_UPDATE', 'pagelines_theme_update' );

define( 'PL_EXTEND_DIR', WP_PLUGIN_DIR . '/pagelines-sections');
define( 'PL_EXTEND_URL', plugins_url( 'pagelines-sections' ) );
define( 'PL_EXTEND_INIT', WP_PLUGIN_DIR . '/pagelines-sections/pagelines-sections.php');
define( 'PL_EXTEND_STYLE', EXTEND_CHILD_URL . '/style.css' );
define( 'PL_EXTEND_STYLE_PATH', EXTEND_CHILD_DIR . '/style.css' );
define( 'PL_EXTEND_FUNCTIONS', EXTEND_CHILD_DIR . '/functions.php' );
define( 'PL_EXTEND_THEMES_DIR', WP_CONTENT_DIR .'/themes/' );
define( 'PL_EXTEND_SECTIONS_PLUGIN', 'pagelines-sections.php' );
define( 'PL_STORE_URL', 'http://www.pagelines.com/store' );
define( 'PL_CORE_LESS', PL_PARENT_DIR . '/less' );
define( 'PL_CORE_LESS_URL', PL_PARENT_URL . '/less' );
define( 'PL_CHILD_LESS', PL_CHILD_DIR . '/less' );
define( 'PL_CHILD_LESS_URL', PL_CHILD_URL . '/less' );


// if ( is_multisite() && ! is_super_admin() )
// 	define( 'EXTEND_NETWORK', true);
// else
// 	define( 'EXTEND_NETWORK', false);


/**
 * Define API Constants
 */

define( 'PL_API_URL', 'http://www.pagelines.com/?pl-api=init');

// LEGACY
define( 'PL_API', 'www.pagelines.com/api/');
define( 'PL_API_FETCH', 'http://www.pagelines.com/api/' );
define( 'PL_API_CDN', 'http://cdn.pagelines.com/api/' );




/**
 * Define language constants
 */
if (is_dir( PL_CHILD_DIR . '/language' )) {
	$lang = PL_CHILD_DIR . '/language';
	$lang_url = PL_CHILD_URL . '/language';
} elseif (is_dir( EXTEND_CHILD_DIR . '/language' )){
	$lang = EXTEND_CHILD_DIR . '/language';
	$lang_url = EXTEND_CHILD_URL . '/language';
} else {

}

// dms core language folder
$corelang = PL_PARENT_DIR . '/language';
$corelang_url = PL_PARENT_URL . '/language';
define( 'PAGELINES_CORE_LANG_DIR', $corelang );
define( 'PAGELINES_CORE_LANG_URL', $corelang_url );

// secondary lang folder, this will be ./language if its a CORE theme, or stylesheet_dir/language if its a normal child theme.

if( defined( 'DMS_CORE' ) ) {
	if( is_dir( PL_THEME_DIR . '/language') ) {
		$lang = PL_THEME_DIR . '/language';
		$lang_url = PL_THEME_URL . '/language';
	}
} elseif( is_dir( EXTEND_CHILD_DIR . '/language' ) ) {
	$lang = EXTEND_CHILD_DIR . '/language';
	$lang_url = EXTEND_CHILD_URL . '/language';
}
if( isset( $lang ) ) {
	define( 'PAGELINES_THEME_LANG_DIR', $lang );
	define( 'PAGELINES_THEME_LANG_URL', $lang_url );
}
/**
 * Pro/Free Version Variables
 */
define( 'VPRO_NAME','PageLines Framework' );
define( 'VPRO_TOUR','http://www.pagelines.com/DMS/' );
define( 'VPRO_PRICING','http://www.pagelines.com/pricing/' );
