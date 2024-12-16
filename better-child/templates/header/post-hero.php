<?php
/**
 * @package WordPress
 * @subpackage Campoal
 */

global $campoal_options;
global $post;

$view_counter = isset($campoal_options['conikal_view_counter_field']) ? $campoal_options['conikal_view_counter_field'] : 0;
$post_title_aligment = isset($campoal_options['conikal_post_title_aligment_field']) ? $campoal_options['conikal_post_title_aligment_field'] : 'left';
$share_button_position = isset($campoal_options['conikal_post_share_button_position_field']) ? $campoal_options['conikal_post_share_button_position_field'] : 'bottom';

switch ($post_title_aligment) {
	case 'left':
		$post_title_aligment_class = 'text align left';
		break;

	case 'right':
		$post_title_aligment_class = 'alignright';
		break;
	
	default:
		$post_title_aligment_class = 'aligncenter';
		break;
}
$author_id = get_the_author_meta( 'ID' );
$author_name = get_the_author();
$post_date = get_the_date();
$post_comment = get_comments_number();
$post_categories = get_the_category();

$author_link = get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' )); ?>
    <div class="post-hero-container masthead">
        <div class="post-hero page-hero-background"></div>
        <div class="post-shadown"></div>
        <div class="post-caption">
            <div class="ui container">
            	<div class="<?php echo esc_attr($post_title_aligment_class) ?>">
					<?php get_template_part('templates/content/part/post-category-labels'); ?>

					<div class="post-title <?php echo esc_attr($post_title_aligment_class) ?>">
	                	<?php the_title() ?>
	                </div>

					<div class="post-subheader-section ui small header">
						<?php get_template_part('templates/content/part/post-subtitle-action'); ?>
	                </div>

	                <div class="clearfix"></div>
	                <?php if ( in_array($share_button_position, array('all', 'header')) ) {
                        echo conikal_social_button_after_post_content('', 'none');
                    } ?>
	            </div>
	            <div class="clearfix"></div>
            </div>
        </div>