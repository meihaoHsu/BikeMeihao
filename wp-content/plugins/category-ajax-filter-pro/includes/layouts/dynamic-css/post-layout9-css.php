<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
include TC_CAF_PATH . 'includes/query-variables.php';
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
$post_css = "#caf-post-layout-container" . $target_div . ".post-layout9 {background-color: " . $caf_sec_bg_color . ";font-family:" . $caf_post_font . ";}
" . $target_div . " #caf-post-layout9 .caf-post-title h2 {color: " . $caf_post_sec_color . ";font-family:" . $caf_post_font . ";text-transform:" . $caf_post_title_transform . ";font-size:" . $caf_post_title_font_size . "px;font-weight:bold;}
" . $target_div . " #caf-post-layout9 .caf-meta-content i {color:" . $caf_post_sec_color . ";}
" . $target_div . " .caf-meta-content-cats li a {background-color: " . $caf_post_sec_color . ";color:" . $caf_post_sec_color2 . ";font-family:" . $caf_post_font . ";}
" . $target_div . " #caf-post-layout9 span.author," . $target_div . " #caf-post-layout9 span.date," . $target_div . " #caf-post-layout9 span.comment {
font-family:" . $caf_post_font . ";color:".$caf_post_sec_color.";}
" . $target_div . " #caf-post-layout9 .caf-content {font-family:" . $caf_post_desc_font . ";text-transform:".$caf_post_desc_transform.";font-size:". $caf_post_desc_font_size."px;}
" . $target_div . " ul#caf-layout-pagination.post-layout9 li a,".$target_div." .prev-next-caf-pagination .caf-pagi-btn {font-family:" . $caf_post_font . ";color: " . $caf_post_primary_color . ";background-color:" . $caf_post_sec_color . "}
" . $target_div . " ul#caf-layout-pagination.post-layout9 li span.current { color: " . $caf_post_sec_color . ";background-color: " . $caf_post_sec_color2 . ";font-family:" . $caf_post_font . ";}
" . $target_div . " .error-caf {background-color: " . $caf_post_primary_color . "; color: " . $caf_post_sec_color . ";font-family:" . $caf_post_font . ";font-size:" . $caf_post_title_font_size . "px;}
" . $target_div . " #caf-post-layout9 .caf-meta-content," . $target_div . " #caf-post-layout9 .caf-content {color: " . $caf_post_sec_color2 . ";}
" . $target_div . " #caf-post-layout9 a.caf-read-more {font-family:" . $caf_post_font . ";border-color: " . $caf_post_sec_color . "; color: " . $caf_post_sec_color . ";}
" . $target_div . " #caf-post-layout9 a.caf-read-more:hover {background-color: " . $caf_post_sec_color . ";color: " . $caf_post_primary_color . ";}
" . $target_div . " .status i {color:" . $caf_post_primary_color . ";}";
wp_add_inline_style($handle, $post_css);
