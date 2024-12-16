<?php
/**
 * @package WordPress
 * @subpackage Campoal
 */

global $campoal_options;

$shadow_opacity = isset($campoal_options['conikal_shadow_opacity_field']) ? $campoal_options['conikal_shadow_opacity_field'] : '';
$header_menu_color = isset($campoal_options['conikal_header_menu_color_field']) ? $campoal_options['conikal_header_menu_color_field'] : '';
$home_menu_text_color = isset($campoal_options['conikal_home_menu_text_color_field']) ? $campoal_options['conikal_home_menu_text_color_field'] : '';
$user_menu = isset($campoal_options['conikal_user_menu_field']) ? $campoal_options['conikal_user_menu_field'] : 0;
$search_bar = isset($campoal_options['conikal_search_bar_field']) ? $campoal_options['conikal_search_bar_field'] : 'hidden';
$use_inverted_logo = isset($campoal_options['conikal_use_inverted_logo_field']) ? $campoal_options['conikal_use_inverted_logo_field'] : 1;
$logo = isset($campoal_options['conikal_logo_field']['url']) ? $campoal_options['conikal_logo_field']['url'] : '';
$logo_mobile = isset($campoal_options['conikal_logo_mobile_field']['url']) ? $campoal_options['conikal_logo_mobile_field']['url'] : '';
$inverted_logo = isset($campoal_options['conikal_inverted_logo_field']['url']) ? $campoal_options['conikal_inverted_logo_field']['url'] : '';
$inverted_logo_mobile = isset($campoal_options['conikal_inverted_logo_mobile_field']['url']) ? $campoal_options['conikal_inverted_logo_mobile_field']['url'] : '';
$button_classes = 'inverted button';
$page_redirect_logged_in = isset($campoal_options['conikal_page_redirect_logged_in_field']) ? $campoal_options['conikal_page_redirect_logged_in_field'] : 0;
$homepage_url = (!empty($page_redirect_logged_in) && is_user_logged_in() ? get_page_link($page_redirect_logged_in) : home_url('/'));
?>

	<div class="blog-header">
	    <!-- header menu desktop -->
	    <div class="ui grid blog-header-menu">
	        <?php if ($search_bar == 1) { ?>
	        <!-- search link -->
	        <div class="ui secondary top fixed search-menu menu display none">
	            <div class="ui container">
	                <div class="item search-menu-item">
	                    <div class="ui fluid category search search-form">
	                        <div class="ui icon fluid <?php echo esc_attr(wp_is_mobile() ? 'large ' : '') ?>input">
	                          <input class="prompt search-input" type="text" placeholder="<?php esc_attr_e('Search...', 'campoal') ?>">
	                          <i class="remove link icon" id="closeSearch"></i>
	                        </div>
	                        <div class="results"></div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <?php } ?>

	        <!-- menu link -->
	        <div class="sixteen wide column computer only header-menu-link">
	        	<div class="ui container">
	            	<div class="ui secondary menu blog-menu">
	                    <div class="item header-menu-logo">
	                        <a class="logo" href="<?php echo esc_url($homepage_url); ?>" data-bjax>
	                            <?php if($logo != '' && $inverted_logo != '') { ?>
	                                <img class="logo-desktop-inverted" src="<?php echo esc_url($use_inverted_logo ? $inverted_logo : $logo) ?>" alt="<?php echo esc_attr(get_bloginfo('name')) ?>">
	                            <?php } else { ?>
	                                <div class="logo-text ui inverted huge header">
	                                	<div class="content">
	                                		<?php echo esc_html(get_bloginfo('name')) ?>
	                                		<div class="sub header"><?php echo esc_html(get_bloginfo('description')) ?></div>
	                                	</div>	
	                                </div>
	                            <?php } ?>
	                        </a>
	                    </div>
	                    <div class="right menu">
	                        <?php 
	                            if($user_menu == 1) {
	                                get_template_part('templates/header/user-menu');
	                            }
	                        ?>
	                        <div class="item search-item">
	                        	<?php get_search_form(); ?>
	                        </div>
	                    </div>
	                </div>
	                <div class="clearfix"></div>
	                <div class="ui secondary menu blog-menu second">
	                	<?php if ($search_bar == 1) { ?>
	                        <a href="javascript:void(0)" class="item searchBtn" id="searchBtn"><i class="search icon"></i><?php esc_html_e('Search', 'campoal') ?></a>
	                    <?php } ?>
	                    <?php 
                        	conikal_custom_menu('primary');
                       	?>
	                    <div class="right menu">
	                      	<?php if ( function_exists( 'conikal_header_cart' ) ) { conikal_header_cart(); } ?>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <!-- end header desktop menu -->

	    <!-- header mobile menu -->
	    <div class="ui grid mobile tablet only blog-header-menu">
	        <div class="sixteen wide column header-menu-link">
				<div class="ui secondary inverted menu blog-menu">
					<div class="ui container">
						<?php if (has_nav_menu('mobile')) { ?>
						<button class="icon item left-menu-btn" id="left-menu-btn">
							<i class="fas fa-bars"></i>
						</button>
						<?php } ?>
						<div class="item">
							<a class="logo" href="<?php echo esc_url($homepage_url); ?>" data-bjax>
								<?php if ($inverted_logo != '') { 
									if (!empty($logo_mobile) || !empty($inverted_logo_mobile)) { ?>
									<span>
										<img class="logo-mobile-inverted" src="<?php echo esc_url($use_inverted_logo ? $inverted_logo_mobile : $logo_mobile) ?>" alt="<?php echo esc_attr(get_bloginfo('name')) ?>"/>
									</span>
									<?php } else { ?>
									<span>
										<img class="logo-mobile-inverted" src="<?php echo esc_url($use_inverted_logo ? $inverted_logo : $logo) ?>" alt="<?php echo esc_attr(get_bloginfo('name')) ?>"/>
									</span>
								<?php }
								} else { ?>
									<div class="logo-text ui inverted huge header">
										<div class="content">
											<?php echo esc_html(get_bloginfo('name')) ?>
										</div>	
									</div>
								<?php } ?>
							</a>
						</div>
	                    <?php if($user_menu == 1) { ?>
	                    <div class="right menu">
	                        <?php get_template_part('templates/header/user-menu'); ?>
	                    </div>
	                    <?php } ?>
	                </div>
	            </div>
	        </div>
	    </div>
	    <!-- end header mobile menu -->
	</div>