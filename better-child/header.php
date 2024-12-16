<?php
/**
 * @package WordPress
 * @subpackage Campoal
 */

get_template_part('loading-screen/loading-screen');

global $campoal_options;
global $post;

$cookie_notice = isset($campoal_options['conikal_cookie_notice_field']) ? $campoal_options['conikal_cookie_notice_field'] : 0;
$cookie_notice_position = isset($campoal_options['conikal_cookie_notice_position_field']) ? $campoal_options['conikal_cookie_notice_position_field'] : 'footer';
$page_redirect_logged_in = isset($campoal_options['conikal_page_redirect_logged_in_field']) ? $campoal_options['conikal_page_redirect_logged_in_field'] : 0;
$petition_redirection = isset($campoal_options['conikal_petition_redirection_field']) ? $campoal_options['conikal_petition_redirection_field'] : '';
$frontpage_id = get_option('page_on_front');
$frontpage_template = get_page_template_slug($frontpage_id);

// redirect homepage when logged in
if (!empty($petition_redirection)) {
    if ( is_front_page() && !is_home() && !conikal_is_vc_build() ) {
        $petition_link = (is_numeric($petition_redirection)) ? get_permalink(intval($petition_redirection)) : $petition_redirection;
        if ($petition_link) {
            wp_redirect($petition_link);
        }
    }
}

if (!empty($page_redirect_logged_in) && empty($petition_redirection)) {
    if (is_user_logged_in() && is_front_page() && !is_home() && !conikal_is_vc_build() && $frontpage_id != $page_redirect_logged_in && $frontpage_template != 'homepage.php') {
        $page_link = get_page_link($page_redirect_logged_in);
        if (isset($_GET['verify'])) {
            $page_link = add_query_arg( array('verify' => sanitize_text_field($_GET['verify']), 'id' => sanitize_text_field($_GET['id']), 'code' => sanitize_text_field($_GET['code']) ), $page_link);
        }
        if ($page_link) {
            wp_redirect($page_link);
        } else {
            wp_redirect(home_url($wp->request));
        }
    }
}
?>
<!DOCTYPE html>

<html <?php language_attributes(); ?> class="preload">
<head>

<!-- Add this right after your opening <head> tag -->
<style>
    /* Hide all content until fully loaded */
    body {
        visibility: hidden;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    body.loaded {
        visibility: visible;
        opacity: 1;
    }
    
    /* Set fixed dimensions for logos immediately */
    .site-header .custom-logo-link img {
        width: 80px !important;
        height: 80px !important;
        object-fit: contain !important;
    }
    
    .mega-menu-logo img {
        width: 125px !important;
        height: 125px !important;
        object-fit: contain !important;
    }
</style>

<script>
    window.addEventListener('load', function() {
        document.body.classList.add('loaded');
    });
</script>

    
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="//gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
</head>

<?php
$single_post_style = isset($campoal_options['conikal_single_post_style_field']) ? $campoal_options['conikal_single_post_style_field'] : 'classic';
$single_post_style = !is_active_sidebar('main-widget-area') && !function_exists('conikal_register_petition_type') ? 'simple' : $single_post_style;
$home_header = isset($campoal_options['conikal_home_header_field']) ? $campoal_options['conikal_home_header_field'] : 'slideshow';
$home_caption = isset($campoal_options['conikal_home_caption_field']) ? $campoal_options['conikal_home_caption_field'] : 0;
$home_spotlight = isset($campoal_options['conikal_home_spotlight_field']) ? $campoal_options['conikal_home_spotlight_field'] : 0;
$home_victory = isset($campoal_options['conikal_home_victory_field']) ? $campoal_options['conikal_home_victory_field'] : 0;
$home_victory_hide_logined = isset($campoal_options['conikal_home_victory_hide_logined_field']) ? $campoal_options['conikal_home_victory_hide_logined_field'] : 0;
$home_header_hide_logined = isset($campoal_options['conikal_home_header_hide_logined_field']) ? $campoal_options['conikal_home_header_hide_logined_field'] : 0;
$home_template_name = is_page() ? get_page_template_slug($post->ID) : '';
$verify_notification_style = isset($campoal_options['conikal_verify_notification_style_field']) ? $campoal_options['conikal_verify_notification_style_field'] : 'toast';
$header_visibility = isset($campoal_options['conikal_header_visibility_field']) ? $campoal_options['conikal_header_visibility_field'] : 1;
$header_promo = isset($campoal_options['conikal_header_promo_field']) ? $campoal_options['conikal_header_promo_field'] : 0;
$top_menu = isset($campoal_options['conikal_top_menu_field']) && !wp_is_mobile() ? $campoal_options['conikal_top_menu_field'] : 0;
$type_menu = isset($campoal_options['conikal_type_header_menu_field']) ? $campoal_options['conikal_type_header_menu_field'] : 'none';
$slider_options = array('none', 'slider');
?>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <?php
    // leftside menu display on mobile
    get_template_part('templates/leftside-menu');

    // menu on mobile
    if (wp_is_mobile()) {
        // rightside menu on dashboard user
        if (conikal_check_woocommerce_pages(false, 'orders') ||
            conikal_check_woocommerce_pages(false, 'downloads') ||
            conikal_check_woocommerce_pages(false, 'view-order') || 
            is_page_template('dashboard-user.php')) {
            get_template_part('templates/dashboard-menu');
        }
    }

    // verification email notice
    if (is_user_logged_in() && $verify_notification_style == 'sidebar') {
        get_template_part('templates/header/verification-notice');
    } 

    if ($cookie_notice == 1 && $cookie_notice_position == 'header') {
        get_template_part('templates/cookie-notice');
    }

    if($header_promo == 1 && $type_menu == 'none') {
        get_template_part('templates/header/header-promo');
    }

    if($top_menu == 1 && !is_page_template('login.php')) {
        get_template_part('templates/header/top-menu');
    }
    ?>
        
    <!-- start pusher -->
    <div class="pusher">
    <?php
    if ($header_visibility) :
        if(is_front_page() && !is_home() || $home_template_name == 'homepage.php'){
            get_template_part('templates/header/front-hero');
        } elseif (is_single() && 
            !is_singular('petition') && 
            !is_singular('update') && 
            !is_singular('citation') && 
            !is_singular('give_forms') && 
            !is_singular('ticket') && 
            !is_singular('job_listing') && 
            !is_singular('docs') &&
            $single_post_style == 'classic' && 
            !conikal_check_woocommerce_pages('product')) { 
            get_template_part('templates/header/post-hero');
        } elseif (!is_page_template('petitions-search-results.php') && 
            !is_page_template('homepage.php') && 
            !is_page_template('all-give-forms.php') && 
            !is_page_template('all-petitions.php') && 
            !is_page_template('submit-petition.php') && 
            !is_page_template('submit-give-form.php') && 
            !is_page_template('edit-petition.php') &&
            !is_page_template('dashboard-petition.php') &&
            !is_page_template('dashboard-user.php') &&
            !is_page_template('add-update.php') &&
            !is_page_template('contribute.php') &&
            !is_page_template('sign-successful.php') &&
            !is_page_template('container.php') &&
            (!is_page_template('fullwidth.php') || conikal_check_woocommerce_pages(false, 'edit-address') || conikal_check_woocommerce_pages(false, 'payment-methods') || conikal_check_woocommerce_pages('is_account_page')) &&
            !is_page_template('supporters-list.php') &&
            !is_page_template('login.php') &&
            !is_singular('petition') &&
            !is_singular('update') &&
            !is_singular('citation') &&
            !is_singular('give_forms') &&
            !is_singular('ticket') && 
            !is_singular('job_listing') && 
            !is_singular('docs') && 
            !(is_single() && $single_post_style != 'classic') &&
            !conikal_check_woocommerce_pages() &&
            !conikal_check_woocommerce_pages(false, 'orders') && 
            !conikal_check_woocommerce_pages(false, 'downloads') &&
            !conikal_check_woocommerce_pages(false, 'view-order') &&
            !is_404() &&
            !is_home() &&
            !is_search()) { 
            get_template_part('templates/header/page-hero');
        }

        if(is_page_template('petitions-search-results.php') || 
            is_singular('petition') || 
            is_singular('update') || 
            is_singular('citation') || 
            is_singular('give_forms') || 
            is_singular('ticket') || 
            is_singular('job_listing') || 
            is_singular('docs') || 
            (!is_front_page() && is_page_template('homepage.php')) ||
            is_page_template('all-give-forms.php') ||
            is_page_template('all-petitions.php') || 
            is_page_template('submit-petition.php') ||
            is_page_template('submit-give-form.php') ||
            is_page_template('dashboard-petition.php') ||
            is_page_template('dashboard-user.php') ||
            is_page_template('edit-petition.php') ||
            is_page_template('add-update.php') ||
            is_page_template('contribute.php') ||
            is_page_template('sign-successful.php') ||
            is_page_template('container.php') || 
            (!is_front_page() && is_page_template('fullwidth.php') && !conikal_check_woocommerce_pages(false, 'edit-address') && !conikal_check_woocommerce_pages(false, 'payment-methods') && !conikal_check_woocommerce_pages('is_account_page')) ||
            is_page_template('supporters-list.php') ||
            (is_single() && $single_post_style != 'classic') ||
            conikal_check_woocommerce_pages() ||
            conikal_check_woocommerce_pages(false, 'orders') ||
            conikal_check_woocommerce_pages(false, 'downloads') ||
            conikal_check_woocommerce_pages(false, 'view-order') ||
            is_404() ||
            is_home() ||
            is_search()) {
                get_template_part('templates/header/app-header');
        } elseif (!is_page_template('login.php')) {
            if ( (is_front_page() && !is_home() || $home_template_name == 'homepage.php') && !in_array($home_header, $slider_options) && $home_header_hide_logined != 1) {
                if (is_user_logged_in()) {
                    get_template_part('templates/header/app-header');
                } else {
                    get_template_part('templates/header/home-header');
                }
            } elseif ( (is_front_page() && !is_home() || $home_template_name == 'homepage.php') && !in_array($home_header, $slider_options) ) {
                get_template_part('templates/header/home-header');
            } elseif ( (is_front_page() && !is_home() || $home_template_name == 'homepage.php') && $home_header === 'none' ) {
                get_template_part('templates/header/app-header');
            } else {
                get_template_part('templates/header/home-header');
            }
        }

        if ( (is_front_page() && !is_home() || $home_template_name == 'homepage.php') && !in_array($home_header, $slider_options) && $home_header_hide_logined != 1 && $home_caption == 1) {
            if (!is_user_logged_in()) {
                get_template_part('templates/home-caption');
            }
        } elseif ( (is_front_page() && !is_home() || $home_template_name == 'homepage.php') && !in_array($home_header, $slider_options) && $home_caption == 1) {
            get_template_part('templates/home-caption');
        }

        if(!is_front_page() && 
            !is_home() && 
            !is_single() && 
            !is_404() && 
            !is_search() && 
            !is_page_template('petitions-search-results.php') && 
            !is_page_template('homepage.php') && 
            !is_page_template('all-give-forms.php') && 
            !is_page_template('all-petitions.php') && 
            !is_page_template('submit-petition.php') &&
            !is_page_template('submit-give-form.php') &&
            !is_page_template('edit-petition.php') &&
            !is_page_template('dashboard-petition.php') &&
            !is_page_template('dashboard-user.php') &&
            !is_page_template('add-update.php') &&
            !is_page_template('contribute.php') &&
            !is_page_template('sign-successful.php') &&
            !is_page_template('supporters-list.php') && 
            !is_page_template('container.php') && 
            (!is_page_template('fullwidth.php') || conikal_check_woocommerce_pages(false, 'edit-address') || conikal_check_woocommerce_pages(false, 'payment-methods') || conikal_check_woocommerce_('is_account_page')) &&
            !conikal_check_woocommerce_pages() &&
            !conikal_check_woocommerce_pages(false, 'orders') && 
            !conikal_check_woocommerce_pages(false, 'downloads') &&
            !conikal_check_woocommerce_pages(false, 'view-order') &&
            !is_page_template('login.php')) {
            get_template_part('templates/header/page-caption');
        } ?>

        <?php if(is_front_page() && !is_home() || $home_template_name == 'homepage.php'){ ?>
            </div>
        <?php 
            } elseif(is_single() && 
            !is_singular('petition') && 
            !is_singular('update') && 
            !is_singular('citation') && 
            !is_singular('give_forms') && 
            !is_singular('ticket') && 
            !is_singular('job_listing') && 
            !is_singular('docs') && 
            $single_post_style == 'classic' &&  
            !conikal_check_woocommerce_pages('product')) { ?>
            </div>
        <?php } elseif(!is_page_template('petitions-search-results.php') && 
            !is_page_template('homepage.php') && 
            !is_page_template('all-give-forms.php') && 
            !is_page_template('all-petitions.php') && 
            !is_page_template('submit-petition.php') && 
            !is_page_template('submit-give-form.php') && 
            !is_page_template('edit-petition.php') &&
            !is_page_template('dashboard-petition.php') &&
            !is_page_template('dashboard-user.php') &&
            !is_page_template('add-update.php') &&
            !is_page_template('contribute.php') &&
            !is_page_template('sign-successful.php') &&
            !is_page_template('supporters-list.php') && 
            !is_page_template('container.php') && 
            (!is_page_template('fullwidth.php') || conikal_check_woocommerce_pages(false, 'edit-address') || conikal_check_woocommerce_pages(false, 'payment-methods') || conikal_check_woocommerce_pages('is_account_page')) &&
            !is_page_template('login.php') &&
            !is_singular('petition') &&
            !is_singular('update') &&
            !is_singular('citation') && 
            !is_singular('give_forms') && 
            !is_singular('ticket') && 
            !is_singular('job_listing') && 
            !is_singular('docs') && 
            !(is_single() && $single_post_style != 'classic') &&
            !conikal_check_woocommerce_pages() &&
            !conikal_check_woocommerce_pages(false, 'orders') && 
            !conikal_check_woocommerce_pages(false, 'downloads') &&
            !conikal_check_woocommerce_pages(false, 'view-order') && 
            !is_404() &&
            !is_home() &&
            !is_search()) { ?>
            </div>
        <?php } ?>
    <?php endif; ?>

        <?php
        if((is_front_page() && !is_home() || $home_template_name == 'homepage.php') && $home_victory == 1 && $home_victory_hide_logined != 1) {
            if (!is_user_logged_in()) {
                get_template_part('templates/victory-petitions');
            }
        } elseif ((is_front_page() && !is_home() || $home_template_name == 'homepage.php') && $home_victory == 1) {
            get_template_part('templates/victory-petitions');
        }
        
        if(is_front_page() && !is_home() || $home_template_name == 'homepage.php') {
            get_template_part('templates/home-spotlight');  
        }
    ?>
