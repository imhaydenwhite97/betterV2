<?php
/**
 * @package WordPress
 * @subpackage Campoal
 */

global $campoal_options;
global $current_user;

$shadow_opacity         = isset($campoal_options['conikal_shadow_opacity_field']) ? $campoal_options['conikal_shadow_opacity_field'] : '';
$header_menu_color      = isset($campoal_options['conikal_header_menu_color_field']) ? $campoal_options['conikal_header_menu_color_field'] : '';
$home_menu_text_color   = isset($campoal_options['conikal_home_menu_text_color_field']) ? $campoal_options['conikal_home_menu_text_color_field'] : '';
$display_name_setting   = isset($campoal_options['conikal_user_menu_name_field']) ? $campoal_options['conikal_user_menu_name_field'] : 'none';
$login_link_mobile      = isset($campoal_options['conikal_login_link_mobile_field']) ? $campoal_options['conikal_login_link_mobile_field'] : 1;
$login_link_desktop     = isset($campoal_options['conikal_login_link_desktop_field']) ? $campoal_options['conikal_login_link_desktop_field'] : 0;
$login_page             = conikal_get_assign_page('conikal_page_login_field');
$login_page             = $login_page ? $login_page->link : false;
$use_inverted_logo      = isset($campoal_options['conikal_use_inverted_logo_field']) ? $campoal_options['conikal_use_inverted_logo_field'] : 1;

// get user avatar
$avatar                 = conikal_get_avatar_url( $current_user->ID, array('size' => 64) );
$avatar_retina          = conikal_get_avatar_url( $current_user->ID, array('size' => 128) );

// get username
$username               = conikal_username_display_header($current_user, $display_name_setting);

if ($use_inverted_logo) {
    $signin_button_classes = 'inverted';
    $signup_button_classes = 'inverted';
} else {
    $signin_button_classes = 'primary';
    $signup_button_classes = 'green signup-btn-style';
}

// placeholder lazy load avatar
$lazy_placeholder_avatar = conikal_lazy_load_placeholder('avatar');
?>

<?php if(is_user_logged_in()) { ?>
    <div class="ui inline dropdown item user-menu">
        <span class="text">
            <span class="user-menu-label"><i class="dropdown icon"></i><?php echo esc_html($username); ?></span>
            <img class="ui avatar image lazy" data-src="<?php echo esc_url($avatar); ?>" data-retina="<?php echo esc_url($avatar_retina); ?>" src="<?php echo esc_url($lazy_placeholder_avatar); ?>" alt="<?php echo esc_attr($username) ?>">
        </span>
        <div class="menu">
            <?php 
                // Get user menu items
                get_template_part('templates/header/part/user-menu', 'items');
            ?>
        </div>
    </div>
<?php } else { ?>
    <!-- Sign in and sign up buttons -->
    <?php $login_page = (($login_link_mobile == 1 && wp_is_mobile()) || $login_link_desktop == 1) ? $login_page : false; ?>
    <div class="item signin-btn-item">
        <div class="ui grid">
            <div class="column tablet computer only">
                <div class="ui buttons">
                    <button 
                        onclick="<?php echo esc_attr($login_link_desktop == 1 && $login_page ? 'window.location.href="' . esc_url(add_query_arg(array('action' => 'signup'), $login_page)) . '"' : '') ?>" 
                        class="<?php echo esc_attr($login_page && $login_link_desktop == 1 ? 'signup-btn-link ' : 'signup-btn ') ?>ui <?php echo esc_attr($signup_button_classes) ?> button" 
                        data-id="">
                        <?php esc_html_e('Sign Up', 'campoal') ?>
                    </button>
                    <div class="or" data-text="<?php esc_attr_e('or', 'campoal') ?>"></div>
                    <button 
                        onclick="<?php echo esc_attr($login_link_desktop == 1 && $login_page ? 'window.location.href="' . esc_url($login_page) . '"' : '') ?>" 
                        class="<?php echo esc_attr($login_page && $login_link_desktop == 1 ? 'signin-btn-link ' : 'signin-btn ') ?>ui <?php echo esc_attr($signin_button_classes) ?> button" 
                        data-id="">
                        <?php esc_html_e('Sign In', 'campoal') ?>
                    </button>
                </div>
            </div>
            <div class="column mobile only">
                <?php get_template_part('templates/header/part/login-button-mobile') ?>
            </div>
        </div>
    </div>
<?php } ?>