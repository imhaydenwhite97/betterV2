<?php
/**
 * @package WordPress
 * @subpackage Campoal
 */

global $campoal_options;
$header_promo_container = isset($campoal_options['conikal_header_promo_container_field']) ? $campoal_options['conikal_header_promo_container_field'] : 'boxed';
$header_promo_aligment = isset($campoal_options['conikal_header_promo_aligment_field']) ? $campoal_options['conikal_header_promo_aligment_field'] : 'left';
$header_promo_title = isset($campoal_options['conikal_header_promo_title_field']) ? $campoal_options['conikal_header_promo_title_field'] : '';
$header_promo_content = isset($campoal_options['conikal_header_promo_content_field']) ? $campoal_options['conikal_header_promo_content_field'] : '';
$header_promo_video = isset($campoal_options['conikal_header_promo_video_field']) ? $campoal_options['conikal_header_promo_video_field'] : '';

$close_promo_time = isset($_COOKIE['conikal_close_promo']) ? $_COOKIE['conikal_close_promo'] : 0;
?>

<?php if ($close_promo_time != 1) : ?>
<div class="header-promo-segment">
	<div class="ui secondary basic vertical clearing segment header-promo">
		<a href="javascript:void(0)" class="ui right corner label close-promo"><i class="close icon"></i></a>
		<?php if ($header_promo_container == 'boxed') : ?>
			<div class="ui container">
		<?php endif;  ?>
		<?php if ($header_promo_video != '') : ?>
			<div class="ui embed promo-media-embed"></div>
		    <input type="hidden" class="promo-video-url" value="<?php echo esc_attr($header_promo_video) ?>">
		    <div class="ui hidden divider"></div>
	  	<?php endif; ?>
		<div class="text align <?php echo esc_attr($header_promo_aligment) ?>">
			<?php if ($header_promo_title != '') : ?>
				<div class="ui header">
					<div class="content promo-content">
						<?php echo esc_html($header_promo_title) ?>
						<div class="sub header"><?php echo wp_kses_post($header_promo_content); ?></div>
					</div>
				</div>
			<?php else: ?>
			<div class="promo-content"><?php echo wp_kses_post($header_promo_content); ?></div>
			<?php endif; ?>
		</div>
		<?php if ($header_promo_container == 'boxed') : ?>
			</div>
		<?php endif;  ?>
	</div>
</div>
<?php endif; ?>