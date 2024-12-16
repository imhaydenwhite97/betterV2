<?php
/**
 * @package WordPress
 * @subpackage Campoal
 */

global $campoal_options;

$login_link_mobile  = isset($campoal_options['conikal_login_link_mobile_field']) ? $campoal_options['conikal_login_link_mobile_field'] : 1;
$login_page         = conikal_get_assign_page('conikal_page_login_field');
?>

<a href="<?php echo esc_attr($login_page && $login_link_mobile == 1 ? esc_url($login_page->link) : 'javascript:void(0)') ?>" class="item<?php echo esc_attr($login_page && $login_link_mobile == 1 ? '' : ' signin-btn') ?>">
    <i class="sign in icon"></i>
    <?php esc_html_e('Sign In', 'campoal') ?>
</a>
<a href="<?php echo esc_attr($login_page && $login_link_mobile == 1 ? esc_url(add_query_arg(array('action' => 'signup'), $login_page->link)) : 'javascript:void(0)') ?>" class="item<?php echo esc_attr($login_page && $login_link_mobile == 1 ? '' : ' signup-btn') ?>">
    <i class="add user icon"></i>
    <?php esc_html_e('Sign Up', 'campoal') ?>
</a>