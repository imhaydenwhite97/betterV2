<?php
/**
 * @package WordPress
 * @subpackage Campoal
 */


/**
 * Setup basic features and required template pages
 *
 * @since Campoal 1.0.0
 */
if( !function_exists('conikal_theme_setup') ): 
    function conikal_theme_setup() {

        // load language file
        load_theme_textdomain('campoal', get_parent_theme_file_path() . '/languages');

        /**
         * Add support feature on theme
         *
         * @since Campoal 1.0.0
         */
        if ( function_exists( 'add_theme_support' ) ) {
            add_theme_support( 'automatic-feed-links' );
            add_theme_support( 'post-thumbnails' );
            add_theme_support( 'title-tag' );
            add_theme_support( 'custom-background' );
            add_theme_support( 'custom-header' );
            add_editor_style( 'style.css' );
            set_post_thumbnail_size( 1920, 1080, true );
        }


        /**
         * Set the content width based on the theme's design and stylesheet.
         *
         * @since Campoal 1.0.0
         */
        if ( ! isset( $content_width ) ) $content_width = 1127;


        /**
         * Register navigation menu
         *
         * @since Campoal 1.0.0
         */
        register_nav_menus( array(
            'top_menu'  => esc_html__( 'Top menu', 'campoal'),
            'primary'   => esc_html__( 'Primary menu', 'campoal'),
            'category'  => esc_html__( 'Category menu','campoal'),
            'footer'    => esc_html__( 'Footer menu','campoal'),
            'mobile'    => esc_html__( 'Mobile menu','campoal'),
        ) );


        /**
         * Add custom image size for thumbnail
         *
         * @since Campoal 1.0.0
         */
        add_image_size( 'conikal-petition-thumbnail', 360, 270, true );
        add_image_size( 'conikal-petition-medium', 550, 310, true );
        add_image_size( 'conikal-petition-small', 170, 95, true );

        /**
         * Add custom image size for thumbnail retina
         *
         * @since Campoal 2.1.0
         */
        add_image_size( 'conikal-petition-thumbnail-retina', 720, 540, true );
        add_image_size( 'conikal-petition-medium-retina', 1100, 620, true );
        add_image_size( 'conikal-petition-small-retina', 340, 190, true );

        /**
         * Add custom image size for user avatar
         *
         * @since Campoal 2.1.0
         */
        add_image_size( 'conikal-avatar-small', 32, 32, true );
        add_image_size( 'conikal-avatar-medium', 64, 64, true );
        add_image_size( 'conikal-avatar-large', 128, 128, true );
        add_image_size( 'conikal-avatar-big', 256, 256, true );

        /**
         * Add custom image size for post
         *
         * @since Campoal 2.1.0
         */
        add_image_size( 'conikal-post-list', 260, 330, true );
        add_image_size( 'conikal-post-list-retina', 520, 660, true );
    }
endif;
add_action( 'after_setup_theme', 'conikal_theme_setup' );

/**
* Register custom widget area sidebar
*
* @since Campoal 1.0.0
*/
if( !function_exists('conikal_widgets_init') ): 
    function conikal_widgets_init() {
        register_sidebar(array(
            'name' => esc_html__('Main Widget Area', 'campoal'),
            'id' => 'main-widget-area',
            'description' => esc_html__('Display widget on single post, archive', 'campoal'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="ui dividing header widget-title">',
            'after_title' => '</h3>'
        ));

        register_sidebar(array(
            'name' => esc_html__('Petition Widget Area', 'campoal'),
            'id' => 'petition-widget-area',
            'description' => esc_html__('Display widget on homepage and petitions page', 'campoal'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="ui dividing header widget-title">',
            'after_title' => '</h3>'
        ));

        register_sidebar(array(
            'name' => esc_html__('1st Footer Widget Area', 'campoal'),
            'id' => 'first-footer-widget-area',
            'description' => esc_html__('The first footer widget area', 'campoal'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>'
        ));

        register_sidebar(array(
            'name' => esc_html__('2nd Footer Widget Area', 'campoal'),
            'id' => 'second-footer-widget-area',
            'description' => esc_html__('The second footer widget area', 'campoal'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>'
        ));

        register_sidebar(array(
            'name' => esc_html__('3rd Footer Widget Area', 'campoal'),
            'id' => 'third-footer-widget-area',
            'description' => esc_html__('The third footer widget area', 'campoal'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>'
        ));

        register_sidebar(array(
            'name' => esc_html__('4th Footer Widget Area', 'campoal'),
            'id' => 'fourth-footer-widget-area',
            'description' => esc_html__('The fourth footer widget area', 'campoal'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>'
        ));

        register_sidebar(array(
            'name' => esc_html__('Footer Mobile Widget Area', 'campoal'),
            'id' => 'footer-mobile-widget-area',
            'description' => esc_html__('The mobile footer widget area', 'campoal'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>'
        ));
    }
endif;
add_action( 'widgets_init', 'conikal_widgets_init' );
?>