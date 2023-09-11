<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
if ($caf_filter_font != "inherit") {
    wp_enqueue_style('tp-google-fonts-' . str_replace(" ", "-", $caf_filter_font), "https://fonts.googleapis.com/css?family=" . $caf_filter_font . ":regular&display=swap", array(), null);
}
if ($caf_post_font != "inherit") {
    wp_enqueue_style('tp-google-fonts-' . str_replace(" ", "-", $caf_post_font), "https://fonts.googleapis.com/css?family=" . $caf_post_font . ":regular&display=swap", array(), null);
}
if ($caf_post_desc_font != "inherit") {
    wp_enqueue_style('tp-google-fonts-' . str_replace(" ", "-", $caf_post_desc_font), "https://fonts.googleapis.com/css?family=" . $caf_post_desc_font . ":regular&display=swap", array(), null);
}
wp_enqueue_script("jquery");
wp_enqueue_script('tc-caf-frontend-scripts-pro');
//wp_enqueue_script( "tc-caf-smooth-scroll");
$post_style = ("tc-caf-" . $caf_post_layout);
$filter_style = ("tc-caf-" . $caf_filter_layout);
wp_enqueue_style('tc-caf-common-style');
/*===========================================================
====================ENQUEUE FILTER LAYOUT CSS==================
=============================================================*/
$flayout = $caf_filter_layout . ".css";
$filepath = get_stylesheet_directory() . "/category-ajax-filter/css/filter/" . $flayout;
if (file_exists($filepath)) {
    wp_enqueue_style('tc-caf-' . $caf_filter_layout, get_stylesheet_directory_uri() . '/category-ajax-filter/css/filter/"' . $flayout, '', TC_CAF_PRO_PLUGIN_VERSION);
} else {
    if ($flayout == "filter-layout1.css" || $flayout == "filter-layout2.css" || $flayout == "filter-layout3.css") {
        wp_enqueue_style('tc-caf-' . $caf_filter_layout, TC_CAF_URL . 'assets/css/filter/"' . $flayout, '', TC_CAF_PLUGIN_VERSION);
    } else {
        wp_enqueue_style('tc-caf-pro-' . $caf_filter_layout, TC_CAF_PRO_URL . 'assets/css/filter/"' . $flayout, '', TC_CAF_PRO_PLUGIN_VERSION);
    }
}
/*===========================================================
====================ENQUEUE POST LAYOUT CSS==================
=============================================================*/
$playout = $caf_post_layout . ".css";
$filepath = get_stylesheet_directory() . "/category-ajax-filter/css/post/" . $playout;
if (file_exists($filepath)) {
    wp_enqueue_style('tc-caf-pro-' . $caf_post_layout, get_stylesheet_directory_uri() . '/category-ajax-filter/css/post/"' . $playout, '', TC_CAF_PRO_PLUGIN_VERSION);
} else {
    if ($playout == "post-layout1.css" || $playout == "post-layout2.css" || $playout == "post-layout3.css" || $playout == "post-layout4.css") {
        wp_enqueue_style('tc-caf-' . $caf_post_layout, TC_CAF_URL . 'assets/css/post/"' . $playout, '', TC_CAF_PLUGIN_VERSION);
    } else {
        wp_enqueue_style('tc-caf-pro-' . $caf_post_layout, TC_CAF_PRO_URL . 'assets/css/post/"' . $playout, '', TC_CAF_PRO_PLUGIN_VERSION);
    }
}
wp_enqueue_style('tc-caf-font-awesome-style');
wp_enqueue_style('tc-caf-font-awesome-all-style', TC_CAF_URL . 'assets/css/fontawesome/css/all.min.css', '', TC_CAF_PLUGIN_VERSION);
if ($caf_post_layout == 'carousel-slider') {
    wp_enqueue_script('tc-caf-carouselslider', TC_CAF_PRO_URL . "assets/js/jquery.flexslider.js");
    wp_enqueue_style('tc-caf-carouselslider', TC_CAF_PRO_URL . 'assets/css/common/flexslider.css', TC_CAF_PRO_PLUGIN_VERSION);
}
