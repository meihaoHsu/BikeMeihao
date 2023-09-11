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
$post_css = "#caf-post-layout-container" . $target_div . ".post-layout5 {background-color: " . $caf_sec_bg_color . ";font-family:" . $caf_post_font . ";}
" . $target_div . " #caf-post-layout5 .manage-layout5 {background-color: " . $caf_post_primary_color . ";}
" . $target_div . " #caf-post-layout5 .caf-post-title h2 {color: " . $caf_post_sec_color . ";font-family:" . $caf_post_font . ";text-transform:" . $caf_post_title_transform . ";font-size:" . $caf_post_title_font_size . "px;font-weight:bold;}
" . $target_div . " #caf-post-layout5 .caf-meta-content i {color:" . $caf_post_sec_color . ";}
 " . $target_div . " .caf-meta-content-cats li a {background-color: " . $caf_post_sec_color . ";color:" . $caf_post_sec_color . ";font-family:" . $caf_post_font . ";}
" . $target_div . " #caf-post-layout5 span.author," . $target_div . " #caf-post-layout5 span.date," . $target_div . " #caf-post-layout5 span.comment {
font-family:" . $caf_post_font . ";}
" . $target_div . " #caf-post-layout5 .caf-content {font-family:" . $caf_post_desc_font . ";text-transform:".$caf_post_desc_transform.";font-size:". $caf_post_desc_font_size."px;}
 " . $target_div . " ul#caf-layout-pagination.post-layout5 li a,".$target_div." .prev-next-caf-pagination .caf-pagi-btn {font-family:" . $caf_post_font . ";color: " . $caf_post_primary_color . ";background-color:" . $caf_post_sec_color . "}
 " . $target_div . " ul#caf-layout-pagination.post-layout5 li span.current { color: " . $caf_post_sec_color . ";background-color: " . $caf_post_sec_color2 . ";font-family:" . $caf_post_font . ";}
" . $target_div . " .error-caf {background-color: " . $caf_post_primary_color . "; color: " . $caf_post_sec_color . ";font-family:" . $caf_post_font . ";font-size:" . $caf_post_title_font_size . "px;}
" . $target_div . " #caf-post-layout5 .caf-meta-content," . $target_div . " #caf-post-layout5 .caf-content {color: " . $caf_post_sec_color . ";}
" . $target_div . " #caf-post-layout5 a.caf-read-more {font-family:" . $caf_post_font . ";border-color: " . $caf_post_sec_color2 . "; color: " . $caf_post_sec_color2 . ";}
" . $target_div . " #caf-post-layout5 svg{fill: " . $caf_post_primary_color . ";color: " . $caf_post_primary_color . ";stroke: " . $caf_post_primary_color . ";}
" . $target_div . " #caf-post-layout5 span.caf-pl-d{ border-color:" . $caf_post_sec_color2 . "; color: " . $caf_post_sec_color . ";background-color:" . $caf_sec_bg_color . ";}
" . $target_div . " #caf-post-layout5 .point{background-color:" . $caf_post_primary_color . "; box-shadow: 0px 0px 0px 3px " . $caf_post_sec_color2 . ";border-color:" . $caf_sec_bg_color . ";}
" . $target_div . " #caf-post-layout5 .point:hover{background-color:" . $caf_post_sec_color2 . ";}
" . $target_div . " #caf-post-layout5 #manage-ajax-response:after{background-color: " . $caf_post_sec_color2 . ";}
" . $target_div . " #caf-post-layout5 a.caf-read-more:hover {background-color: " . $caf_post_sec_color2 . ";}
" . $target_div . " .status i {color:" . $caf_post_primary_color . ";}
.post-layout5 #manage-ajax-response:after{background:" . $caf_post_sec_color2 . ";}
" . $target_div . " #caf-post-layout5 .caf-meta-content-cats li a {color:".$caf_post_sec_color.";background-color:". $caf_post_sec_color2.";}
.post-layout5 .tp_load_more{color:" . $caf_post_sec_color . "; background: " . $caf_post_sec_color2 . ";}";


wp_add_inline_style($handle, $post_css);
