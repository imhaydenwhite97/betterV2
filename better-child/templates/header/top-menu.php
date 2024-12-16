<?php
/**
 * @package WordPress
 * @subpackage Campoal
 */

global $campoal_options;
$wide_menu                  = isset($campoal_options['conikal_wide_header_menu_field']) ? $campoal_options['conikal_wide_header_menu_field'] : 'boxed';
$language_switcher          = isset($campoal_options['conikal_language_switcher_field']) ? $campoal_options['conikal_language_switcher_field'] : 'header';
$country_selection_mode     = isset($campoal_options['conikal_country_selection_mode_field']) ? $campoal_options['conikal_country_selection_mode_field'] : 0;
$shopping_cart              = isset($campoal_options['conikal_shopping_cart_field']) ? $campoal_options['conikal_shopping_cart_field'] : 'header';
$top_menu                   = isset($campoal_options['conikal_top_menu_field']) ? $campoal_options['conikal_top_menu_field'] : 0;
$search_bar                 = isset($campoal_options['conikal_search_bar_field']) ? $campoal_options['conikal_search_bar_field'] : 'hidden';
$country_selection_position = isset($campoal_options['conikal_country_selection_position_field']) ? $campoal_options['conikal_country_selection_position_field'] : 'header';
$type_menu                  = isset($campoal_options['conikal_type_header_menu_field']) ? $campoal_options['conikal_type_header_menu_field'] : 'none';
?>


<div class="top-menu-segment">
	<div class="top-menu ui secondary small <?php echo esc_attr($type_menu != 'none' ? 'fixed ' : '') ?>menu top-menu-items">
        <?php if ($wide_menu == 'boxed') : ?>
            <div class="ui container">
        <?php endif;  ?>
		<?php if ($country_selection_mode == 1 && $country_selection_position == 'top') : ?>
            <div class="item">
                <?php get_template_part('templates/header/country-selection') ?>
            </div>
        <?php endif; ?>
        <?php if ($language_switcher == 'top') : ?>
            <div class="item">
                <?php get_template_part('templates/header/language-selection') ?>
            </div>
        <?php endif ?>
        <?php if (!wp_is_mobile()) : ?>
            <div class="right menu">
                <?php if ($search_bar == 'top') { ?>
                    <a href="javascript:void(0)" class="item searchBtn" id="searchBtn"><i class="search icon"></i><?php esc_html_e('Search', 'campoal') ?></a>
                <?php } ?>
            </div>
            <?php 
            	// display primary menu
                conikal_custom_menu('top_menu');

                // display header cart
                if ( function_exists( 'conikal_header_cart' ) && $shopping_cart == 'top') {
                    conikal_header_cart(); 
                }
            ?>
        <?php endif; ?>
        <?php if ($wide_menu == 'boxed') : ?>
            </div>
        <?php endif;  ?>
	</div>
</div>