<?php
/**
 * @package WordPress
 * @subpackage Campoal
 */

global $campoal_options;
global $current_user;

$page_title_aligment = isset($campoal_options['conikal_page_title_aligment_field']) ? $campoal_options['conikal_page_title_aligment_field'] : 'left';
$opacity_hero_page_color = isset($campoal_options['conikal_opacity_hero_page_color_field']) ? $campoal_options['conikal_opacity_hero_page_color_field'] : '#FFFFFF';
$recaptcha_contact = isset($campoal_options['conikal_google_recaptcha_contact_field']) ? $campoal_options['conikal_google_recaptcha_contact_field'] : 1;
$use_inverted_logo = isset($campoal_options['conikal_use_inverted_logo_field']) ? $campoal_options['conikal_use_inverted_logo_field'] : 0;

switch ($page_title_aligment) {
	case 'left':
		$page_title_aligment_class = 'alignleft';
		break;

	case 'right':
		$page_title_aligment_class = 'alignright';
		break;
	
	default:
		$page_title_aligment_class = 'aligncenter';
		break;
}

if ($use_inverted_logo != 1) {
	$button_classes = 'primary';
} else {
	$button_classes = 'inverted';
}
?>

<div class="page-caption">
	<div class="ui container">
<?php
	if ( is_author() || is_page_template('my-petitions.php') ) {
		if (is_author()) {
			$curauth 		= (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
			$author_name 	= conikal_get_author_name($curauth->ID);
		} else {
			$curauth 		= wp_get_current_user();
			$author_name 	= conikal_get_author_name($curauth->ID);
		} 
		// Avatar
		$avatar 		= conikal_get_avatar_url( $curauth->ID, array('size' => 128) );
		$avatar_retina 	= conikal_get_avatar_url( $curauth->ID, array('size' => 256) );

		// follow user
		$follow_user 	= get_user_meta($current_user->ID, 'follow_user', true);

		// get level contribute badget
		if (class_exists('Give') && function_exists('conikal_contribution_level_badge')) {
			$level_badge = conikal_contribution_level_badge($curauth->ID);
		} else {
			$level_badge = '';
		}

		// placeholder lazy load avatar
		$lazy_placeholder_avatar = conikal_lazy_load_placeholder('avatar');
?>

	<div class="ui grid">
		<div class="four wide mobile three wide tablet two wide computer column">
			<a class="<?php echo esc_attr($level_badge) ?> large" href="">
				<img class="ui small avatar image lazy" alt="<?php echo esc_attr($author_name) ?>" data-src="<?php echo esc_url($avatar) ?>" data-retina="<?php echo esc_url($avatar_retina) ?>" src="<?php echo esc_url($lazy_placeholder_avatar) ?>">
			</a>
		</div>
		<div class="twelve wide mobile thirteen wide tablet fourteen wide computer column">
			<div class="ui basic vertical segment">
				<div class="ui inverted header <?php echo esc_attr($use_inverted_logo != 1 ? 'profile-title' : 'petition-title') ?>">
					<div class="content truncate">
						<?php echo esc_html($author_name) ?>
						<?php if (function_exists('conikal_register_petition_type') && is_user_logged_in() && (current_user_can('administrator') || current_user_can('editor')) ) : ?>
							<button class="ui primary label admin-settings-btn"><i class="ellipsis horizontal icon"></i> <?php esc_html_e('Settings', 'campoal') ?></button>
							<div class="ui admin-settings popup bottom left transition hidden">
                                <div class="show-visitor-statistics ui toggle checkbox <?php echo esc_attr($curauth->show_visitor_statistics != 0 || $curauth->show_visitor_statistics == '' ? 'checked' : ''); ?>" data-post-id="<?php echo esc_attr($curauth->ID) ?>">
                                  <input type="checkbox" name="show-visitor-statistics" <?php echo esc_attr($curauth->show_visitor_statistics != 0 || $curauth->show_visitor_statistics == '' ? 'checked' : ''); ?>>
                                  <label><?php esc_html_e('Show visitor statistics', 'campoal'); ?></label>
                                </div>
							</div>
						<?php endif; ?>
						<div class="sub header">
						<?php if ( function_exists('conikal_register_petition_type') ) : ?>
							<?php if ($curauth->user_country || $curauth->user_state || $curauth->user_city) { ?>
							<?php echo esc_html($curauth->user_city ? $curauth->user_city . ', ' : '') . ($curauth->user_state ? $curauth->user_state . ', ' : '') . ($curauth->user_country ? $curauth->user_country : '') ?>
							<?php } ?>
						<?php else : ?>
							<?php echo sprintf(_n('%s post', '%s posts', count_user_posts($curauth->ID), 'campoal'), conikal_format_number('%!.0i', count_user_posts($curauth->ID), true)) ?>
						<?php endif; ?>
						</div>
					</div>
				</div>
			<?php if ( function_exists('conikal_register_petition_type') ) : ?>
				<?php if(is_user_logged_in()) {
					if($follow_user != '') {
						if(in_array($curauth->ID, $follow_user) === false) { ?>
							<a href="javascript:void(0)" id="follow-user-<?php echo esc_attr($curauth->ID); ?>" class="ui tiny circular <?php echo esc_attr($button_classes) ?> button follow-profile follow" data-id="<?php echo esc_attr($curauth->ID); ?>"><i class="plus icon"></i><?php esc_html_e('Follow', 'campoal') ?></a>
						<?php } else { ?>
							<a href="javascript:void(0)" id="follow-user-<?php echo esc_attr($curauth->ID); ?>" class="ui tiny circular <?php echo esc_attr($button_classes) ?> button follow-profile following" data-id="<?php echo esc_attr($curauth->ID); ?>"><i class="checkmark icon"></i><?php esc_html_e('Following', 'campoal') ?></a>
					<?php } 
						} else { ?>
						<a href="javascript:void(0)" id="follow-user-<?php echo esc_attr($curauth->ID); ?>" class="ui tiny circular <?php echo esc_attr($button_classes) ?> button follow-profile follow" data-id="<?php echo esc_attr($curauth->ID); ?>"><i class="plus icon"></i><?php esc_html_e('Follow', 'campoal') ?></a>
					<?php }
				} else { ?>
					<a href="javascript:void(0)" class="ui tiny circular <?php echo esc_attr($button_classes) ?> button signin-btn"><i class="plus icon"></i><?php esc_html_e('Follow', 'campoal') ?></a>
				<?php } ?>
				<button class="ui tiny circular <?php echo esc_attr($button_classes) ?> button" id="contact-btn"><i class="mail icon"></i><?php esc_html_e('Contact', 'campoal') ?></button>
			<?php else : ?>
				<a href="<?php echo esc_url( 'mailto:' . $curauth->user_email ) ?>" class="ui tiny <?php echo esc_attr($button_classes) ?> button"><i class="mail icon"></i><?php esc_html_e('Send an email', 'campoal') ?></a>
			<?php endif; ?>
			</div>
		</div>
	</div>
<?php } else if (is_page()) { ?>
	<div class="page-title <?php echo esc_attr($page_title_aligment_class) ?>"><?php the_title(); ?></div>
<?php } else if (is_tax()) {
		$term = get_queried_object();
		$current_user = wp_get_current_user();
		$follow_topics = get_user_meta($current_user->ID, 'follow_topics', true); 
	?>
	
	<div class="page-title <?php echo esc_attr($page_title_aligment_class) ?>"><?php single_term_title(); ?>
		<?php if ($term->taxonomy === 'petition_category') { ?>
		<p class="<?php echo esc_attr($page_title_aligment) ?> align font small page-subtitle">
			<?php echo esc_html($term->count) . ' ' . esc_html__('petitions', 'campoal') ?>
		</p>
		<?php } ?>
	</div>
	<?php if ($term->taxonomy === 'petition_topics') { ?>
	<div class="ui <?php echo esc_attr($page_title_aligment) ?> <?php echo esc_attr($page_title_aligment == 'center' ? 'aligned' : 'floated') ?> basic segment">
		<?php if( is_user_logged_in()  ) { ?>
			<?php if($follow_topics != '') { ?>
				<?php if(in_array($term->term_id, $follow_topics) === false) { ?>
					<a href="javascript:void(0)" id="follow-topic-<?php echo esc_attr($term->term_id) ?>" class="ui tiny <?php echo esc_attr($button_classes) ?> circular button follow-topic follow" data-id="<?php echo esc_attr($term->term_id) ?>"><i class="plus icon"></i><?php esc_html_e('Follow', 'campoal') ?></a>
				<?php } else { ?>
					<a href="javascript:void(0)" id="follow-topic-<?php echo esc_attr($term->term_id) ?>" class="ui tiny primary circular button follow-topic following" data-id="<?php echo esc_attr($term->term_id) ?>"><i class="checkmark icon"></i><?php esc_html_e('Following', 'campoal') ?></a>
				<?php }
			} else { ?>
				<a href="javascript:void(0)" id="follow-topic-<?php echo esc_attr($term->term_id) ?>" class="ui tiny <?php echo esc_attr($button_classes) ?> circular button follow-topic following" data-id="<?php echo esc_attr($term->term_id) ?>"><i class="plus icon"></i><?php esc_html_e('Follow', 'campoal') ?></a>
			<?php }
		} else { ?>
			<a href="javascript:void(0)" class="ui tiny <?php echo esc_attr($button_classes) ?> circular button signin-btn"><i class="plus icon"></i><?php esc_html_e('Follow', 'campoal') ?></a>
		<?php } ?>
	</div>
	<?php } ?>
<?php } else if (class_exists('WooCommerce') && is_shop()) { ?>
	<div class="page-title <?php echo esc_attr($page_title_aligment_class) ?>">
		<?php esc_html_e('Shop', 'campoal') ?>
		<div class="clearfix"></div>
		<?php woocommerce_breadcrumb(); ?>
	</div>
<?php } else if (is_archive()) { ?>
	<?php the_archive_title( '<div class="page-title ' . esc_attr($page_title_aligment_class) . '">', '</div>' ); ?>
<?php } else { ?>
	<div class="page-title <?php echo esc_attr($page_title_aligment_class) ?>"><?php single_term_title(); ?></div>
<?php } ?>
<?php wp_nonce_field('follow_ajax_nonce', 'securityFollow', true); ?>
	</div>
</div>

<?php if ( is_author() ) { ?>
	<div class="ui small modal" id="contact-user">
		<i class="close icon"></i>
		<div class="header">
			<?php esc_html_e('Send an email', 'campoal') ?>
		</div>
		<div class="content">
			<div class="respon-message" id="contact-response"></div>
			<form class="ui form">
				<input type="hidden" id="user_email" name="user_email" value="<?php echo esc_attr($curauth->user_email); ?>">
				<?php if (!is_user_logged_in()) { ?>
				<div class="fields">
					<div class="eight wide required field">
						   <label><?php esc_html_e('Name', 'campoal'); ?></label>
						   <input type="text" id="contact_name" name="contact_name" placeholder="<?php esc_attr_e('Enter your name', 'campoal'); ?>">
					 </div>
					<div class="eight wide required field">
							<label><?php esc_html_e('Email', 'campoal'); ?></label>
							<input type="text" id="contact_email" name="contact_email" placeholder="<?php esc_attr_e('Enter your email', 'campoal'); ?>">
					</div>
				</div>
				<?php } else { ?>
					<input type="hidden" id="contact_name" name="contact_name" value="<?php echo esc_attr($author_name); ?>">
					<input type="hidden" id="contact_email" name="contact_email" value="<?php echo esc_attr($current_user->user_email); ?>">
				<?php } ?>
				<div class="required field">
							<label><?php esc_html_e('Subject', 'campoal'); ?></label>
							<input type="text" id="contact_subject" name="contact_subject" placeholder="<?php esc_attr_e('Enter the subject', 'campoal'); ?>">
				</div>
				<div class="required field">
							<label><?php esc_html_e('Message', 'campoal'); ?></label>
							<textarea id="contact_message" name="contact_message" placeholder="<?php esc_attr_e('Type your message', 'campoal'); ?>" rows="5"></textarea>
				</div>
				<?php if (conikal_show_google_reCaptcha() && $recaptcha_contact == 1) { ?>
                    <p>
                        <?php get_template_part('templates/google', 'recaptcha'); ?>
                    </p>
                <?php } ?>
				<div class="field">
					<a href="javascript:void(0);" class="ui primary button" id="sendBtn"><?php esc_html_e('Send an Email', 'campoal'); ?></a>
				</div>
				<?php wp_nonce_field('contact_user_ajax_nonce', 'securityContactUser', true); ?>
			</form>
		</div>
	</div>
<?php } ?>
