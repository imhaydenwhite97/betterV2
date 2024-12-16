<?php
/**
 * @package WordPress
 * @subpackage Campoal
 */

global $campoal_options;
global $current_user;

$admin_submit_petition_only = isset($campoal_options['conikal_admin_submit_petition_only_field']) ? $campoal_options['conikal_admin_submit_petition_only_field'] : 0;
$display_name_setting = isset($campoal_options['conikal_user_menu_name_field']) ? $campoal_options['conikal_user_menu_name_field'] : 'none';

if ($display_name_setting == 'fullname') {
    $username = $current_user->display_name;
} elseif ($display_name_setting == 'firstname') {
    $username = $current_user->user_firstname;
} elseif ($display_name_setting == 'lastname') {
    $username = $current_user->user_lastname;
} elseif ($display_name_setting == 'nickname') {
    $username = $current_user->user_login;
} else {
    $username = '';
}

?>

<?php if ($admin_submit_petition_only == 1) { 
if (current_user_can('editor') || current_user_can('administrator') || current_user_can('subscriber') || current_user_can('give_subscriber') || current_user_can('givewp_donor')) {

// Get user menu items
get_template_part('templates/header/part/user-menu', 'submit');

}
} else {

// Get user menu items
get_template_part('templates/header/part/user-menu', 'submit');

} ?>

<!-- Bookmark petition link -->
<a class="item" href="<?php echo esc_url(add_query_arg(array('tab' => 'bookmarks'), get_author_posts_url($current_user->ID))); ?>" data-bjax><i class="bookmark icon"></i> <?php esc_html_e('Bookmarks', 'campoal'); ?></a>

<!-- User account link -->
<?php
$user_account_page = conikal_get_assign_page('conikal_page_user_account_field');
if ($user_account_page) { ?>
<a class="item" href="<?php echo esc_url($user_account_page->link); ?>" data-bjax><i class="user icon"></i> <?php echo esc_html($user_account_page->title); ?></a>
<?php } ?>

<div class="ui divider"></div>

<!-- Logout link -->
<a class="item" href="<?php echo wp_logout_url(home_url('/')); ?>"><i class="sign out alternate icon"></i> <?php esc_html_e('Logout', 'campoal'); ?></a>
