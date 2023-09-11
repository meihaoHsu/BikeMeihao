<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
$filter_css = ".data-target-div" . $b . " #caf-alphabetical-layout li {background-color: " . $caf_filter_primary_color . ";color: " . $caf_filter_sec_color . ";text-transform:" . $caf_filter_transform . ";font-family:" . $caf_filter_font . ";font-size:" . $caf_filter_font_size . "px;border-color:" . $caf_filter_sec_color2 . " !important;}
 .data-target-div" . $b . " #caf-alphabetical-layout li.active {
 background-color: " . $caf_filter_sec_color . ";color: " . $caf_filter_primary_color . ";
 }";

wp_add_inline_style($handle, $filter_css);
