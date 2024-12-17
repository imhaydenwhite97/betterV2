<?php
/**
 * @package WordPress
 * @subpackage Campoal
 */


/**
 * Included functions theme
 */
require_once get_parent_theme_file_path('/inc/helpers.php');
require_once get_parent_theme_file_path('/inc/theme_enqueue.php');
require_once get_parent_theme_file_path('/inc/theme_setup.php');
require_once get_parent_theme_file_path('/inc/custom_style.php');
require_once get_parent_theme_file_path('/inc/custom_colors.php');
require_once get_parent_theme_file_path('/inc/custom_border.php');
require_once get_parent_theme_file_path('/inc/custom_typography.php');
require_once get_parent_theme_file_path('/inc/custom_menu.php');
require_once get_parent_theme_file_path('/inc/petitions_newsfeed.php');
require_once get_parent_theme_file_path('/inc/petitions_search.php');
require_once get_parent_theme_file_path('/inc/petitions_category.php');
require_once get_parent_theme_file_path('/inc/petitions_taxonomy.php');
require_once get_parent_theme_file_path('/inc/petitions_archive.php');
require_once get_parent_theme_file_path('/inc/petitions_featured.php');
require_once get_parent_theme_file_path('/inc/petitions_trending.php');
require_once get_parent_theme_file_path('/inc/petitions_recent.php');
require_once get_parent_theme_file_path('/inc/petitions_me.php');
require_once get_parent_theme_file_path('/inc/petitions_author.php');
require_once get_parent_theme_file_path('/inc/petitions_bookmark.php');
require_once get_parent_theme_file_path('/inc/petitions_signed.php');
require_once get_parent_theme_file_path('/inc/pagination.php');
require_once get_parent_theme_file_path('/inc/breadcumbs.php');
require_once get_parent_theme_file_path('/inc/comment.php');
require_once get_parent_theme_file_path('/inc/post.php');
require_once get_parent_theme_file_path('/inc/sort_options.php');
require_once get_parent_theme_file_path('/inc/wedocs.php');
require_once get_parent_theme_file_path('/inc/job_manager.php');

/**
 * Some parts of the framework only need to run on admin views.
 * These would be those.
 * Calling these only on admin saves some operation time for the theme, everything in the name of speed.
 * 
 * @since Campoal 1.0.0
 */
if( is_admin() ){
	if ( !class_exists( 'TGM_Plugin_Activation' ) ) {
		require_once get_parent_theme_file_path('/admin/class-tgm-plugin-activation.php');
		require_once get_parent_theme_file_path('/admin/tgmpa-register.php');
		require_once get_parent_theme_file_path('/admin/merlin-config.php');
		require_once get_parent_theme_file_path('/admin/import-demo.php');
	}
}

/**
 *	Check Woocommerce class is exist or not and included woocommerce function
 *	Woocommerce use to create shop page
 *
 * 	@since Campoal 1.0.0
 */
if( class_exists('WooCommerce') ){
	require_once get_parent_theme_file_path('/woocommerce_init.php');
}

/**
 *	Check Give class is exist or not and include extanded Give function
 *	Give use to create contribution and crowdfunding
 *
 * 	@since Campoal 1.0.5
 */
if ( class_exists('Give') ) {
	require_once get_parent_theme_file_path('/inc/give.php');
	require_once get_parent_theme_file_path('/inc/give_category.php');
	require_once get_parent_theme_file_path('/inc/give_tag.php');
}
?>