<?php 
/**
 * @package WordPress
 * @subpackage Campoal
 */

global $current_user;
?>


<!-- User dashboard link -->
<?php 
$user_dashboard_page = conikal_get_assign_page('conikal_page_dashboard_user_field');
if ($user_dashboard_page) { ?>
    <a class="item" href="<?php echo esc_url($user_dashboard_page->link); ?>" data-bjax><i class="cloud icon"></i> <?php echo esc_html($user_dashboard_page->title); ?></a>
<?php } ?>