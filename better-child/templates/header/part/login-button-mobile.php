<?php
/**
 * @package WordPress
 * @subpackage Campoal
 */

global $campoal_options;

$login_link_mobile      = isset($campoal_options['conikal_login_link_mobile_field']) ? $campoal_options['conikal_login_link_mobile_field'] : 1;
$mobile_login_button    = isset($campoal_options['conikal_mobile_login_button_field']) ? $campoal_options['conikal_mobile_login_button_field'] : 0;
$login_page             = conikal_get_assign_page('conikal_page_login_field');
$use_inverted_logo = isset($campoal_options['conikal_use_inverted_logo_field']) ? $campoal_options['conikal_use_inverted_logo_field'] : 1;

if ($use_inverted_logo) {
    $signin_button_classes = 'inverted';
} else {
    $signin_button_classes = 'primary';
}
?>

<?php if ($mobile_login_button == 'button') : ?>
<div class="ui <?php echo esc_attr($signin_button_classes) ?> buttons">
    <a href="<?php echo esc_attr($login_page && $login_link_mobile == 1 ? esc_url($login_page->link) : 'javascript:void(0)') ?>" class="ui <?php echo esc_attr($signin_button_classes) ?> button<?php echo esc_attr($login_page && $login_link_mobile == 1 ? ' signin-btn-link' : ' signin-btn') ?>">
        <?php esc_html_e('Login', 'campoal') ?>
    </a>
<?php endif; ?>
    <div class="ui icon dropdown <?php echo esc_attr($signin_button_classes) ?> <?php echo esc_attr( $mobile_login_button == 'button' ? 'button signin-btn-link' : 'item' ) ?> user-menu">
        <i class="ellipsis vertical<?php echo esc_attr( $mobile_login_button == 'icon' ? ' large' : '' ) ?> icon"></i>
        <div class="menu">
            <?php get_template_part('templates/header/part/login-menu', 'mobile') ?>
        </div>
    </div>
<?php if ($mobile_login_button == 'button') : ?>
</div>
<?php endif; ?>