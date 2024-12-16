<?php 
/*
 * @package WordPress
 * @subpackage Campoal
 */

global $campoal_options;
global $current_user;
$country_selection = isset($campoal_options['conikal_country_selection_field']) ? $campoal_options['conikal_country_selection_field'] : 0;
$country_selected = conikal_get_country_selected($current_user);
$language_switcher = isset($campoal_options['conikal_language_switcher_field']) ? $campoal_options['conikal_language_switcher_field'] : 'header';
$country_selection_position = isset($campoal_options['conikal_country_selection_position_field']) ? $campoal_options['conikal_country_selection_position_field'] : 'header';
?>

<div class="ui floating dropdown <?php echo esc_attr(!wp_is_mobile() && $country_selection_position == 'header' ? 'circular basic button ' : 'fluid ') ?>country-selection">
    <input type="hidden" name="country-selected" class="country-selected" id="country-selected" value="<?php echo esc_attr($country_selected); ?>">
  	<span class="text"><i class="world icon"></i><?php esc_html_e('Global', 'campoal') ?></span>
  	<div class="menu">
	    <div class="ui icon search input">
	      	<i class="search icon"></i>
	      	<input type="text" placeholder="<?php esc_attr_e('Search country...', 'campoal') ?>">
	    </div>
    	<div class="divider"></div>

    	<?php if ($language_switcher == 'country' && class_exists('PLL_Switcher')) :
			$translations = pll_the_languages( array( 'raw' => 1 ) );
			$current_language = pll_current_language( 'name' ); ?>
			<div class="ui left pointing dropdown link icon item">
				<i class="language icon"></i>
				<?php esc_html_e('Languages', 'campoal') ?>
				<div class="menu">
					<?php foreach ($translations as $id => $attrs) { ?>
					<a href="<?php echo esc_attr($attrs['url']) ?>" class="item">
						<img class="ui inline middle aligned image" src="<?php echo esc_attr($attrs['flag']) ?>"><?php echo esc_html($attrs['name']) ?></a>
					<?php } ?>
				</div>
			</div>
	  	<?php endif; ?>

	    <div class="header">
	      	<i class="map marker icon"></i>
	      	<?php esc_html_e('Countries', 'campoal') ?>
	    </div>
	    <div class="scrolling menu">
	        <?php echo conikal_country_list_menu_html($country_selection) ?>
	    </div>
	    
  	</div>
</div>