<?php
/**
 * @package WordPress
 * @subpackage Campoal
 */

global $campoal_options;

$view_counter       = isset($campoal_options['conikal_view_counter_field']) ? $campoal_options['conikal_view_counter_field'] : 0;
$has_featured_posts = conikal_has_featured_posts();

$args = array(
    'posts_per_page'   => 5,
    'post_type'        => 'post',
    'orderby'          => 'post_date',
    'order'            => 'DESC',
    'post__not_in'     => get_option("sticky_posts"),
    'post_status'      => 'publish'
);

$args['meta_query'] = array('relation' => 'AND');
if ($has_featured_posts) {
    array_push($args['meta_query'], array(
        'key'     => 'post_featured',
        'value'   => 1,
    ));
}

$posts_featured = new wp_query($args);
$t_posts = $posts_featured->found_posts;
?>
<div class="blog-feature-section carousel-v2">
    <div class="blog-feature">
    <?php
    while( $posts_featured->have_posts() ) {
        $posts_featured->the_post();

        $p_id               = get_the_ID();
        $p_title            = get_the_title($p_id);
        $p_link             = get_permalink($p_id);
        $p_image            = get_the_post_thumbnail_url($p_id, 'large');
        $p_image_featured   = get_the_post_thumbnail_url($p_id, 'full');
        $p_excerpt          = get_the_excerpt($p_id);
        $p_excerpt_medium   = conikal_get_excerpt_by_id($p_id, 20);
        $p_excerpt_long     = conikal_get_excerpt_by_id($p_id, 30);
        $p_categories       = get_the_category($p_id);
        $p_date             = get_the_date();
        $p_comment          = get_comments_number();
        $p_time             = sprintf(esc_html__('%s ago', 'campoal'), human_time_diff(get_the_time('U', $p_id), current_time('timestamp')));
        $author_id          = get_the_author_meta( 'ID' );
        $author_name        = get_the_author();
        $author_link        = get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ));
        
        $overlay_color      = array('primary', 'secondary');
        ?>
        <div class="feature-item">
           <div class="ui grid">
                <div class="sixteen wide mobile eight wide tablet ten wide computer column">
                    <div class="feature-image feature-post-lazy" data-src="<?php echo esc_url($p_image_featured) ?>"></div>
                </div>
                <div class="sixteen wide mobile eight wide tablet six wide computer column">
                    <div class="feature-title">
                        <div class="ui raised very padded segment">
                            <?php if ( is_sticky() ) { ?>
                                <span class="ui primary right corner large label"><i class="pin icon"></i></span>
                            <?php } ?>
                            <?php if(isset($p_categories[0])) { ?>
                                <a class="ui primary small label" href="<?php echo get_term_link($p_categories[0]->term_id) ?>" data-bjax>
                                    <?php echo esc_html($p_categories[0]->name); ?>
                                </a>
                            <?php } ?>
                            <?php if (function_exists('conikal_get_post_views')) { 
                            if ($view_counter == 1 && !empty((int) conikal_get_post_views($post->ID))) { ?>
                                <span class="ui basic label">
                                    <?php echo sprintf( _n('%s view', '%s views', (int) conikal_get_post_views($post->ID), 'campoal'), conikal_format_number('%!,0i', (int) conikal_get_post_views($post->ID), true) ); ?>
                                </span>
                            <?php }
                            } ?>
                            <span class="ui basic small label">
                                <i class="time icon"></i>
                                <?php echo conikal_reading_time() ?>
                            </span>
                            <h1 class="ui header">
                                <a href="<?php echo esc_url($p_link) ?>" data-bjax><?php the_title() ?></a>        
                            </h1>
                            <p class="text grey description">
                                <?php echo esc_html($p_excerpt_long) ?>
                                <a href="<?php echo esc_url($p_link) ?>">
                                    <?php esc_html_e('more', 'campoal') ?>
                                    <i class="angle right icon read-more-icon"></i>
                                </a>
                            </p>
                            <div class="ui small header">
                                <div class="post-sub-title sub header">
                                    <?php echo esc_html__('Written by', 'campoal') . ' '; ?>
                                    <a href="<?php echo esc_url($author_link); ?>" data-bjax>
                                        <?php echo esc_html($author_name); ?>
                                    </a>
                                    <?php echo ' — ' . esc_html($p_date); ?>
                                    <?php if (!empty($p_comment)) : ?>
                                        <?php echo ' — ' . sprintf( _n('%s comment', '%s comments', $p_comment, 'campoal'), conikal_format_number('%!,0i', $p_comment, true) ) ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    <?php }
    wp_reset_postdata();
    wp_reset_query();
    ?>
    </div>
</div>
