<?php
/**
 * @package WordPress
 * @subpackage Campoal
 */

global $campoal_options;


$home_header = isset($campoal_options['conikal_home_header_field']) ? $campoal_options['conikal_home_header_field'] : 'slideshow';
$home_slideshow_images = isset($campoal_options['conikal_home_slideshow_images']) ? $campoal_options['conikal_home_slideshow_images'] : '';
$home_header_video = isset($campoal_options['conikal_home_header_video_field']) ? $campoal_options['conikal_home_header_video_field'] : ''; 
$home_header_video_sound = isset($campoal_options['conikal_home_header_video_sound_field']) ? $campoal_options['conikal_home_header_video_sound_field'] : 0; 
$home_header_hide_logined = isset($campoal_options['conikal_home_header_hide_logined_field']) ? $campoal_options['conikal_home_header_hide_logined_field'] : 0; 
$home_victory = isset($campoal_options['conikal_home_victory_field']) ? $campoal_options['conikal_home_victory_field'] : 0;
$home_victory_hide_logined = isset($campoal_options['conikal_home_victory_hide_logined_field']) ? $campoal_options['conikal_home_victory_hide_logined_field'] : 0;
$home_header_hight = isset($campoal_options['conikal_hieght_slideshow_field']) ? $campoal_options['conikal_hieght_slideshow_field'] : '675';
$slider_options = array('none', 'slider');

// victory class
$victory_hide_class = '-feature';
if($home_victory == 1 && !in_array($home_header, $slider_options) && $home_victory_hide_logined != 1) {
    if (!is_user_logged_in()) {
        $victory_hide_class = '';
    }
} elseif ($home_victory == 1 && !in_array($home_header, $slider_options)) {
    $victory_hide_class = '';
} else {
    $victory_hide_class = '';
}



// home header class
$home_header_class = 'none-hero-container';
$home_header_masthead = 'none-masthead';
if (!in_array($home_header, $slider_options) && $home_header_hide_logined != 1) {
    if (!is_user_logged_in()) {
        $home_header_class = 'hero-container';
        $home_header_masthead = 'masthead';
    }
} elseif (!in_array($home_header, $slider_options)) {
    $home_header_class = 'hero-container';
    $home_header_masthead = 'masthead';
} elseif (is_home()) {
}
?>

<div id="<?php echo esc_attr($home_header_class) . esc_attr($victory_hide_class) ?>" class="<?php echo esc_attr($home_header_masthead) ?> slideshow-height">
    <?php if($home_header == 'slideshow') { ?>
        <?php if ($home_header_hide_logined != 1) { 
            if (!is_user_logged_in()) { ?>
                <div id="slideshow" class="slideshow-height">
                    <?php 
                        $home_slideshow_images = explode(',', $home_slideshow_images);
                        $i = 0;
                        foreach ($home_slideshow_images as $attachment_id) { ?>
                            <div class="slideshow-background-image-<?php echo esc_attr($i) ?>"></div>
                            <?php 
                            $i++;
                        }
                    ?>
                </div>
                <div class="slideshowShadow"></div>
            <?php } else { ?>
                <div class="none-slideshow"></div>
            <?php }
        } else { ?>
            <div id="slideshow" class="slideshow-height">
                <?php 
                    $home_slideshow_images = explode(',', $home_slideshow_images);
                    $i = 0;
                    foreach ($home_slideshow_images as $attachment_id) { ?>
                        <div class="slideshow-background-image-<?php echo esc_attr($i) ?>"></div>
                        <?php 
                        $i++;
                    }
                ?>
            </div>
            <div class="slideshowShadow"></div>
        <?php } ?>
    <?php } elseif($home_header == 'video') { ?>
         <?php if ($home_header_hide_logined != 1) { 
            if (!is_user_logged_in()) { ?>
                <video autoplay id="bgvid" loop <?php ($home_header_video_sound == 1 ? '' : 'muted') ?>>
                    <source src="<?php echo esc_url($home_header_video); ?>" type="video/mp4">
                </video>
                <div class="slideshowShadow"></div>
            <?php } else { ?>
                <div class="none-slideshow"></div>
            <?php }
        } else { ?>
            <video autoplay id="bgvid" loop <?php ($home_header_video_sound == 1 ? '' : 'muted') ?>>
                <source src="<?php echo esc_url($home_header_video); ?>" type="video/mp4">
            </video>
            <div class="slideshowShadow"></div>
        <?php } ?>
    <?php } else { ?>
        <div class="none-slideshow"></div>
    <?php }
?>