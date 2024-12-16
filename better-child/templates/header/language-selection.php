<?php 
/*
 * @package WordPress
 * @subpackage Campoal
 */

global $campoal_options;
global $current_user;
$country_selection = isset($campoal_options['conikal_country_selection_field']) ? $campoal_options['conikal_country_selection_field'] : 0;
$country_selected = conikal_get_country_selected($current_user);
?>
<?php if (class_exists('PLL_Switcher')) {
    $translations = pll_the_languages( array( 'raw' => 1 ) );
    $current_language = pll_current_language( 'name' ); ?>
    <div class="ui floating dropdown language-selection">
        <input type="hidden" name="language-selected" id="language-selected">
        <span class="text"><i class="language icon"></i><?php echo esc_html($current_language) ?></span>
        <div class="menu">
            <div class="ui icon search input">
                <i class="search icon"></i>
                <input type="text" placeholder="<?php esc_attr_e('Search language...', 'campoal') ?>">
            </div>
            <div class="divider"></div>
            <div class="header">
                <i class="language icon"></i>
                <?php esc_html_e('Languages', 'campoal') ?>
            </div>
            <div class="scrolling menu">
                <?php foreach ($translations as $id => $attrs) { ?>
                <a href="<?php echo esc_attr($attrs['url']) ?>" class="item">
                    <img class="ui inline middle aligned image" src="<?php echo esc_attr($attrs['flag']) ?>"><?php echo esc_html($attrs['name']) ?></a>
                <?php } ?>
            </div>
            
        </div>
    </div>
<?php } else if (class_exists('GTranslate')) { 
    echo GTranslate::get_widget_code(false);
} ?>