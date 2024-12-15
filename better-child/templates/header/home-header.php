<?php
global $campoal_options;

$user_menu = isset($campoal_options['conikal_user_menu_field']) ? $campoal_options['conikal_user_menu_field'] : 0;
$logo = isset($campoal_options['conikal_logo_field']['url']) ? $campoal_options['conikal_logo_field']['url'] : '';
$search_bar = isset($campoal_options['conikal_search_bar_field']) ? $campoal_options['conikal_search_bar_field'] : 'hidden';
$page_redirect_logged_in = isset($campoal_options['conikal_page_redirect_logged_in_field']) ? $campoal_options['conikal_page_redirect_logged_in_field'] : 0;
$homepage_url = is_user_logged_in() ? get_page_link($page_redirect_logged_in) : home_url('/');
?>

<div class="home-header">
    <div class="ui grid home-header-menu">
        <div class="sixteen wide column computer only header-menu-link">
            <div class="ui menu-home secondary large menu home-menu fb-style">
                <!-- Left Section -->
                <div class="fb-section-left">
                    <div class="item header-menu-logo">
                        <a class="logo" href="<?php echo esc_url($homepage_url); ?>" data-bjax>
                            <?php if ($logo) : ?>
                                <img src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                            <?php else : ?>
                                <span class="logo-text ui header"><?php echo esc_html(get_bloginfo('name')); ?></span>
                            <?php endif; ?>
                        </a>
                    </div>
                </div>

                <!-- Center Section -->

<div class="fb-section-center">
    <?php get_template_part('mega-menu/mega-menu'); ?>
    <?php conikal_custom_menu('primary'); ?>
</div>


                <!-- Right Section -->
                <div class="fb-section-right">
                    <?php if ($search_bar == 'header') : ?>
                        <a href="javascript:void(0)" class="item searchBtn" id="searchBtn">
                            <i class="search icon"></i>
                        </a>
                    <?php endif; ?>

                    <?php if ($user_menu == 1) : ?>
                        <?php get_template_part('templates/header/user-menu'); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Header -->
    <div class="ui grid mobile tablet only home-header-menu">
        <div class="sixteen wide column header-menu-link">
            <div class="ui menu-home secondary menu home-menu">
                <div class="ui container">
                    <?php if (has_nav_menu('mobile')) : ?>
                        <button class="icon item left-menu-btn" id="left-menu-btn">
                            <i class="fas fa-bars"></i>
                        </button>
                    <?php endif; ?>
                    
                    <div class="item">
                        <a class="logo" href="<?php echo esc_url($homepage_url); ?>" data-bjax>
                            <?php if ($logo) : ?>
                                <img src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                            <?php else : ?>
                                <span class="logo-text ui header"><?php echo esc_html(get_bloginfo('name')); ?></span>
                            <?php endif; ?>
                        </a>
                    </div>

                    <?php if ($user_menu == 1) : ?>
                        <div class="right menu">
                            <?php get_template_part('templates/header/user-menu'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
