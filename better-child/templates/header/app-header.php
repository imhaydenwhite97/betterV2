<?php
/*
 * @package WordPress
 * @subpackage Campoal
 */

global $campoal_options;

$header_menu_color          = isset($campoal_options['conikal_header_menu_color_field']) ? $campoal_options['conikal_header_menu_color_field'] : '';
$home_menu_text_color       = isset($campoal_options['conikal_home_menu_text_color_field']) ? $campoal_options['conikal_home_menu_text_color_field'] : '';
$user_menu                  = isset($campoal_options['conikal_user_menu_field']) ? $campoal_options['conikal_user_menu_field'] : 0;
$submit_button              = isset($campoal_options['conikal_submit_button_field']) ? $campoal_options['conikal_submit_button_field'] : 0;
$search_bar                 = isset($campoal_options['conikal_search_bar_field']) ? $campoal_options['conikal_search_bar_field'] : 'hidden';
$wide_menu                  = isset($campoal_options['conikal_wide_header_menu_field']) ? $campoal_options['conikal_wide_header_menu_field'] : 'wide';
$use_inverted_logo          = isset($campoal_options['conikal_use_inverted_logo_field']) ? $campoal_options['conikal_use_inverted_logo_field'] : 1;
$logo                       = isset($campoal_options['conikal_logo_field']['url']) ? $campoal_options['conikal_logo_field']['url'] : '';
$logo_mobile                = isset($campoal_options['conikal_logo_mobile_field']['url']) ? $campoal_options['conikal_logo_mobile_field']['url'] : '';
$login_link_desktop         = isset($campoal_options['conikal_login_link_desktop_field']) ? $campoal_options['conikal_login_link_desktop_field'] : 0;
$page_redirect_logged_in    = isset($campoal_options['conikal_page_redirect_logged_in_field']) ? $campoal_options['conikal_page_redirect_logged_in_field'] : 0;
$country_selection_mode     = isset($campoal_options['conikal_country_selection_mode_field']) ? $campoal_options['conikal_country_selection_mode_field'] : 0;
$shopping_cart              = isset($campoal_options['conikal_shopping_cart_field']) ? $campoal_options['conikal_shopping_cart_field'] : 'header';
$top_menu                   = isset($campoal_options['conikal_top_menu_field']) ? $campoal_options['conikal_top_menu_field'] : 0;
$language_switcher          = isset($campoal_options['conikal_language_switcher_field']) ? $campoal_options['conikal_language_switcher_field'] : 'header';
$country_selection_position = isset($campoal_options['conikal_country_selection_position_field']) ? $campoal_options['conikal_country_selection_position_field'] : 'header';
$type_menu                  = isset($campoal_options['conikal_type_header_menu_field']) ? $campoal_options['conikal_type_header_menu_field'] : 'none';

if ( strtoupper($header_menu_color) == '#FFFFFF' ) {
    $button_classes = 'primary button submit-petition-btn';
} else {
    $button_classes = 'inverted button';
}

$homepage_url           = (!empty($page_redirect_logged_in) && is_user_logged_in() ? get_page_link($page_redirect_logged_in) : home_url('/'));
$submit_button_page     = conikal_get_assign_page('conikal_submit_button_link_field');
$submit_button_id       = ($submit_button_page ? $submit_button_page->id : '');
$submit_button_title    = ($submit_button_page ? $submit_button_page->title : esc_html__('Start a petition', 'campoal'));
$submit_button_link     = ($submit_button_page ? $submit_button_page->link : '');
?>

<div id="header" class="app-header">
    <!-- header desktop menu  -->
    <div class="ui grid app-header-menu">
        <?php if ($search_bar != 'hidden') { ?>
            <!-- search link -->
            <div class="ui secondary top fixed search-menu menu display none">
                <div class="ui container">
                    <div class="item search-menu-item">
                        <div class="ui fluid category search search-form">
                            <div class="ui icon fluid <?php echo esc_attr(wp_is_mobile() ? 'large ' : '') ?>input">
                              <input class="prompt search-input" id="search-input" type="text" placeholder="<?php esc_attr_e('Search...', 'campoal') ?>">
                              <i class="remove link icon" id="closeSearch"></i>
                            </div>
                            <div class="results"></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <!-- menu -->
        <div class="sixteen wide column computer only header-menu-link">
            <div class="ui header-menu secondary fixed large menu app-menu <?php echo esc_attr($type_menu == 'scroll' ? 'header-border' : 'header-shadow') ?>">
                <?php echo wp_kses_post($wide_menu === 'boxed' && !is_page_template('dashboard-user.php') ? '<div class="ui container">' : '') ?>
                    <div class="item header-menu-logo">
                        <a class="logo fixed-logo" href="<?php echo esc_url($homepage_url); ?>" data-bjax>
                            <?php
                            if($logo != '') { ?>
                                <span>
                                    <img class="logo-desktop" src="<?php echo esc_url($logo) ?>" alt="<?php echo esc_attr(get_bloginfo('name')) ?>">
                                    <img class="logo-mobile" src="<?php echo esc_url(!empty($logo_mobile) ? $logo_mobile : $logo) ?>" alt="<?php echo esc_attr(get_bloginfo('name')) ?>">
                                </span>
                            <?php } else { ?>
                                <div class="logo-text ui header"><?php echo esc_html(get_bloginfo('name')) ?></div>
                            <?php } ?>
                        </a>
                    </div>
                    <?php if ($country_selection_mode == 1 && $country_selection_position == 'header') : ?>
                        <div class="item">
                            <?php get_template_part('templates/header/country-selection') ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($language_switcher == 'header') : ?>
                        <div class="item">
                            <?php get_template_part('templates/header/language-selection') ?>
                        </div>
                    <?php endif ?>
                    <div class="right menu">
                        <?php if ($search_bar == 'header') { ?>
                            <a href="javascript:void(0)" class="item searchBtn" id="searchBtn"><i class="search icon"></i><?php esc_html_e('Search', 'campoal') ?></a>
                        <?php } ?>
                        <?php 
                        // display primary menu
                        conikal_custom_menu('primary');

                        // display header cart
                        if ( function_exists( 'conikal_header_cart' ) && $shopping_cart == 'header') {
                            conikal_header_cart(); 
                        }

                        if(is_user_logged_in()) {
                            if ($submit_button == 1) { ?>
                                <form action="<?php echo esc_url($submit_button_link); ?>" class="item submit-campaign-item">
                                    <button class="ui labeled icon <?php echo esc_attr($button_classes) ?>" id="add-petition-btn"><?php echo conikal_custom_icon('submit') ?> <?php echo esc_html($submit_button_title); ?></button>
                                </form>
                        <?php } 
                        } else {
                            if ($submit_button == 1) { ?>
                                <div class="item submit-campaign-item">
                                    <a href="<?php echo esc_attr($submit_button_page && $login_link_desktop == 1 ? esc_url($submit_button_page->link) : 'javascript:void(0)') ?>" 
                                    class="ui labeled icon <?php echo esc_attr($button_classes) ?><?php echo esc_attr($submit_button_page && $login_link_desktop == 1 ? '' : ' submit-signin-btn') ?>" 
                                    id="add-petition-btn" 
                                    data-id="<?php echo esc_attr($submit_button_id) ?>">
                                        <?php echo conikal_custom_icon('submit') ?>
                                        <?php echo esc_html($submit_button_title); ?>
                                    </a>
                                </div>
                        <?php }
                        } ?>
                        <?php if($user_menu == 1) {
                                get_template_part('templates/header/app-user-menu');
                            }
                        ?>
                    </div>
                <?php echo wp_kses_post($wide_menu === 'boxed' && !is_page_template('dashboard-user.php') ? '</div>' : '') ?>
            </div>
        </div>
    </div>
    <!-- end header desktop menu -->
    
    <!-- header mobile menu -->
    <div class="ui grid app-header-menu">
        <div class="sixteen wide column mobile tablet only header-menu-link">
            <div class="ui header-menu secondary fixed menu app-menu <?php echo esc_attr($type_menu == 'scroll' ? 'header-border' : 'header-shadow') ?>">
                <div class="ui container">
                    <?php if (has_nav_menu('mobile')) { ?>
                    <button class="icon item left-menu-btn" id="left-menu-btn">
                        <i class="fas fa-bars"></i>
                    </button>
                    <?php } ?>
                    <div class="item">
                        <a class="logo fixed-logo" href="<?php echo esc_url($homepage_url); ?>" data-bjax>
                        <?php
                            if($logo != '' || $logo_mobile != '') { ?>
                                <span>
                                    <img class="logo-mobile" src="<?php echo esc_url(!empty($logo_mobile) ? $logo_mobile : $logo) ?>" alt="<?php echo esc_attr(get_bloginfo('name')) ?>">
                                </span>
                            <?php } else { ?>
                                <div class="logo-text ui header"><?php echo esc_html(get_bloginfo('name')) ?></div>
                            <?php } ?>
                        </a>
                    </div>
                    <?php if($user_menu == 1) { ?>
                    <div class="right menu">
                        <?php get_template_part('templates/header/app-user-menu'); ?>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- end header mobile menu -->
</div>