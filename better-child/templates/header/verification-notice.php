<?php
/**
 * @package WordPress
 * @subpackage Campoal
 */

global $campoal_options;
global $current_user;

$verification_email = isset($campoal_options['conikal_verification_email_field']) ? $campoal_options['conikal_verification_email_field'] : 1;
$user_account_page = isset($campoal_options['conikal_page_user_account_field']) ? $campoal_options['conikal_page_user_account_field'] : 0;
$verify_notification_position = isset($campoal_options['conikal_verify_notification_position_field']) ? $campoal_options['conikal_verify_notification_position_field'] : 'top';
$user_account_page = ($user_account_page ? get_permalink($user_account_page) : get_site_url());
$account_activation = get_user_meta($current_user->ID, 'is_activated', true);
?>

<?php if ( $verification_email != 0 && $account_activation != 1 || isset($_GET['verify']) ) : ?>
<div class="ui <?php echo esc_attr($verify_notification_position) ?> verificaton-notice sidebar ui segment">
	<div class="ui center aligned page grid">
	    <div class="one column row">
	      	<div class="sixteen wide column">
	      		<?php if (!empty($account_activation) || isset($_GET['verify'])) { ?>
	      			<h3 class="ui icon green header">
	      				<i class="circular checkmark icon"></i>
	      				<?php esc_html_e('Your email has been verified!', 'campoal'); ?>
	      				<div class="sub header">
		        			<p><?php echo sprintf(esc_html__('Now you can use your account %1$s for all the functions on %2$s without limits.', 'campoal'), $current_user->user_login, get_bloginfo('name')); ?></p>
		        		</div>
	      			</h3>
	      		<?php } else { ?>
		        	<h3 class="ui header">
		        		<?php esc_html_e('Your account is unverified!', 'campoal'); ?>
		        		<div class="sub header">
		        			<p><?php echo sprintf(esc_html__('Check your inbox and confirm %1$s for access to all things on %2$s.', 'campoal'), $current_user->user_email, get_bloginfo('name')); ?></p>
		        		</div>		
		        	</h3>
		        	<button class="ui labeled icon primary small button" id="resend-email"><i class="send icon"></i><?php esc_html_e('Resend', 'campoal') ?></button>
		        	<a href="<?php echo esc_url($user_account_page) ?>" class="ui basic small button"><?php esc_html_e('Change email', 'campoal') ?></a>
		        	<?php wp_nonce_field('resend_ajax_nonce', 'securityResendVerification', true); ?>
		        <?php } ?>
	      	</div>
	    </div>
	</div>
</div>
<?php endif; ?>