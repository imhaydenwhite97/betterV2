<?php
/**
 * @package WordPress
 * @subpackage Campoal
 */


/**
 * Add custom menu on header
 *
 * @since Campoal 1.0.0
 */
function conikal_custom_menu( $theme_location, $classes = '') {
    if ( ($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location]) ) {
        $menu = get_term( $locations[$theme_location], 'nav_menu' );
        if (!is_wp_error($menu)) {
            $menu_items = wp_get_nav_menu_items($menu->term_id);
        } else {
            $menu_items = false;
        }
 
        $bool = false;
        
        if ($menu_items) {
            foreach( $menu_items as $menu_item ) {
                if( $menu_item->menu_item_parent == 0 ) {
                    $class = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $menu_item->classes ), $menu_item) ) );
                    
                    $parent = $menu_item->ID;
                    $icon = get_post_meta( $menu_item->ID, '_menu_item_icon', true );

                    $menu_level_2 = array();
                    foreach( $menu_items as $submenu_2 ) {
                        if( $submenu_2->menu_item_parent == $parent ) {
                            $bool = true;
                            $menu_level_2[] = $submenu_2;
                        }
                    }

                    if( $bool == true && count( $menu_level_2 ) > 0 ) { ?>
                        <div class="ui dropdown item <?php echo esc_attr($class); ?> <?php echo esc_attr($classes != '' ? $classes : 'nav-submenu') ?>">
                            <?php if ( !empty($icon) ) : ?>
                                <i class="<?php echo esc_attr($icon) ?> icon"></i>
                            <?php endif; ?>
                            <a class="text" href="<?php echo esc_url($menu_item->url) ?>" target="<?php echo esc_attr($menu_item->target ? $menu_item->target : '_self') ?>" data-bjax>
                                <?php echo esc_html($menu_item->title) ?>
                            </a>
                            <i class="dropdown icon"></i>
                            <div class="menu">
                            <?php
                                foreach ($menu_level_2 as $item_2) {
                                $class_level_2 = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $item_2->classes ), $item_2) ) );

                                $menu_level_3 = array();
                                $submenu_parent = $item_2->ID;
                                $icon_2 = get_post_meta( $item_2->ID, '_menu_item_icon', true ); ?>
                                    <?php 
                                    foreach ($menu_items as $submenu_3) {
                                        if ($submenu_3->menu_item_parent == $submenu_parent) {
                                            $bool = true;
                                            $menu_level_3[] = $submenu_3;
                                        }
                                    }

                                    if ($bool == true && count($menu_level_3) > 0) { ?>
                                    <div class="item <?php echo esc_attr($class_level_2) ?>">
                                        <i class="dropdown icon"></i>
                                        <a class="text" href="<?php echo esc_url($item_2->url) ?>" target="<?php echo esc_attr($item_2->target ? $item_2->target : '_self') ?>" data-bjax>
                                            <?php if ( !empty($icon_2) ) : ?>
                                                <i class="<?php echo esc_attr($icon_2) ?> icon"></i>
                                            <?php endif; ?>
                                            <?php echo esc_html($item_2->title) ?>
                                        </a>
                                        <div class="menu">
                                        <?php foreach ($menu_level_3 as $item_3) { 
                                            $class_level_3 = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $item_3->classes ), $item_3) ) );
                                            $icon_3 = get_post_meta( $item_3->ID, '_menu_item_icon', true ); ?>
                                            <a class="item <?php echo esc_attr($class_level_3) ?>" href="<?php echo esc_url($item_3->url) ?>" target="<?php echo esc_attr($item_3->target ? $item_3->target : '_self') ?>" data-bjax>
                                                <?php if ( !empty($icon_3) ) : ?>
                                                    <i class="<?php echo esc_attr($icon_3) ?> icon"></i>
                                                <?php endif; ?>
                                                <?php echo esc_html($item_3->title) ?>
                                            </a>
                                        <?php } ?>
                                        </div>
                                    </div>
                                    <?php } else { ?>
                                        <a class="item <?php echo esc_attr($class_level_2) ?>" href="<?php echo esc_url($item_2->url) ?>" target="<?php echo esc_attr($item_2->target ? $item_2->target : '_self') ?>" data-bjax>
                                            <?php if ( !empty($icon_2) ) : ?>
                                                <i class="<?php echo esc_attr($icon_2) ?> icon"></i>
                                            <?php endif; ?>
                                            <?php echo esc_html($item_2->title) ?>
                                        </a>
                                    <?php } ?>
                            <?php } ?>
                            </div>
                        </div>
                    <?php } else { ?>
                        <a class="item <?php echo esc_attr($class); ?>" href="<?php echo esc_url($menu_item->url) ?>" target="<?php echo esc_attr($menu_item->target ? $menu_item->target : '_self') ?>" data-bjax>
                            <?php if ( !empty($icon) ) : ?>
                                <i class="<?php echo esc_attr($icon) ?> icon"></i>
                            <?php endif; ?>
                            <?php echo esc_html($menu_item->title) ?>
                        </a>
                    <?php }
                }
            }
        }
    } else {
        $bool = false; ?>
        <!-- no menu defined in location <?php echo esc_html($theme_location); ?> -->
    <?php }
} 



/**
 * Custom mobile menu
 *
 * @since Campoal 1.0.0
 */
function conikal_custom_menu_mobile( $theme_location ) {
    if ( ($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location]) ) {
        $menu = get_term( $locations[$theme_location], 'nav_menu' );
        if ($menu) {
            $menu_items = wp_get_nav_menu_items($menu->term_id);
        } else {
            $menu_items = false;
        }
 
        $menu_list = '';
        $bool = false;
         
        if ($menu_items) {
            foreach( $menu_items as $menu_item ) {
                if( $menu_item->menu_item_parent == 0 ) {
                    $class = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $menu_item->classes ), $menu_item) ) );

                    $parent = $menu_item->ID;
                    $icon = get_post_meta( $menu_item->ID, '_menu_item_icon', true );

                    $menu_level_2 = array();
                    foreach( $menu_items as $submenu_2 ) {
                        if( $submenu_2->menu_item_parent == $parent ) {
                            $bool = true;
                            $menu_level_2[] = $submenu_2;
                        }
                    }

                    //menu level 2
                    if( $bool == true && count( $menu_level_2 ) > 0 ) { ?>
                        <div class="ui vertical fluid accordion menu mobile-menu-item">
                            <div class="item <?php echo esc_attr($class); ?>">
                                <div class="title">
                                    <?php if ( !empty($icon) ) : ?>
                                        <i class="<?php echo esc_attr($icon) ?> icon"></i>
                                    <?php endif; ?>
                                    <a href="<?php echo esc_url($menu_item->url) ?>">
                                        <?php echo esc_html($menu_item->title) ?>
                                    </a>
                                    <i class="dropdown icon"></i>
                                </div>
                                <div class="content">
                                <?php foreach ($menu_level_2 as $item_2) {
                                    $class_level_2 = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $item_2->classes ), $item_2) ) );

                                    $menu_level_3 = array();
                                    $submenu_parent = $item_2->ID;
                                    $icon_2 = get_post_meta( $item_2->ID, '_menu_item_icon', true );
                                    
                                    foreach( $menu_items as $submenu_3 ) {
                                        if( $submenu_3->menu_item_parent == $submenu_parent ) {
                                            $bool = true;
                                            $menu_level_3[] = $submenu_3;
                                        }
                                    }

                                    if( $bool == true && count( $menu_level_3 ) > 0 ) { ?>
                                        <div class="accordion menu mobile-menu-item mobile-submenu">
                                            <div class="item <?php echo esc_attr($class_level_2) ?> mobile-submenu-item">
                                                <div class="title">
                                                    <?php if ( !empty($icon_2) ) : ?>
                                                        <i class="<?php echo esc_attr($icon_2) ?> icon"></i>
                                                    <?php endif; ?>
                                                    <a href="<?php echo esc_url($item_2->url) ?>">
                                                        <?php echo esc_html($item_2->title) ?>
                                                    </a>
                                                    <i class="dropdown icon"></i>
                                                </div>
                                            <div class="content">
                                            <?php foreach ($menu_level_3 as $item_3) {
                                                $class_level_3 = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $item_3->classes ), $item_3) ) );
                                                $icon_3 = get_post_meta( $item_3->ID, '_menu_item_icon', true ); ?>
                                                <div class="item <?php echo esc_attr($class_level_3) ?>">
                                                    <a href="<?php echo esc_url($item_3->url) ?>" target="<?php echo esc_attr($item_3->target ? $item_3->target : '_self') ?>" data-bjax>
                                                        <?php if ( !empty($icon_3) ) : ?>
                                                            <i class="<?php echo esc_attr($icon_3) ?> icon"></i>
                                                        <?php endif; ?>
                                                        <?php echo esc_html($item_3->title) ?>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                            </div>
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        <a class="item <?php echo esc_attr($class_level_2) ?>" href="<?php echo esc_url($item_2->url) ?>" target="<?php echo esc_attr($item_2->target ? $item_2->target : '_self') ?>" data-bjax>
                                            <?php if ( !empty($icon_2) ) : ?>
                                                <i class="<?php echo esc_attr($icon_2) ?> icon"></i>
                                            <?php endif; ?>
                                            <?php echo esc_html($item_2->title) ?>
                                        </a>
                                    <?php }
                                } ?>
                                </div>
                            </div>
                        </div>
                    <?php } else { ?>
                        <a class="item <?php echo esc_attr($class); ?>" href="<?php echo esc_url($menu_item->url) ?>" target="<?php echo esc_attr($menu_item->target ? $menu_item->target : '_self') ?>" data-bjax>
                            <?php if ( !empty($icon) ) : ?>
                                <i class="<?php echo esc_attr($icon) ?> icon"></i>
                            <?php endif; ?>
                            <?php echo esc_html($menu_item->title) ?>
                        </a>
                    <?php }    
                } 
            }
        }
    } else { 
        $bool = false; ?>
        <!-- no menu defined in location <?php echo esc_html($theme_location); ?> -->
    <?php }
}
?>
