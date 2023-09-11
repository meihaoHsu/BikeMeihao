<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
include TC_CAF_PATH . 'includes/query-variables.php';
include TC_CAF_PRO_PATH . 'admin/tabs/variables.php';
$target_div = ".data-target-div" . $b;
if (get_post_meta($id, 'caf_post_desc_font')) {
    $caf_post_desc_font = get_post_meta($id, 'caf_post_desc_font', true);
}
if (get_post_meta($id, 'caf_post_desc_transform')) {
    $caf_post_desc_transform = get_post_meta($id, 'caf_post_desc_transform', true);
}
if (get_post_meta($id, 'caf_post_desc_font_size')) {
    $caf_post_desc_font_size = get_post_meta($id, 'caf_post_desc_font_size', true);
}
$post_css = "" . $target_div . ".carousel-slider .flex-control-paging li a.flex-active {
background:" . $caf_post_sec_color2 . ";
}
" . $target_div . ".carousel-slider .flex-direction-nav a:before," . $target_div . ".carousel-slider .carousel-desc {
color:" . $caf_post_sec_color2 . ";
}
" . $target_div . ".carousel-slider li h5 a {color: " . $caf_post_primary_color . ";font-family:" . $caf_post_font . ";text-transform:" . $caf_post_title_transform . ";font-size:" . $caf_post_title_font_size . "px;}
" . $target_div . ".carousel-slider .carousel-desc {
color: " . $caf_post_sec_color . ";font-family:" . $caf_post_desc_font . ";text-transform:" . $caf_post_desc_transform . ";font-size:" . $caf_post_desc_font_size . "px;
}";
wp_add_inline_style($handle, $post_css);
