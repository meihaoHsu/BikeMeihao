<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
$filter_css = ".data-target-div" . $b . " #caf-filter-layout1 li a,.data-target-div" . $b . " #caf-filter-layout1 li.more span {background-color: " . $caf_filter_sec_color . ";color: " . $caf_filter_primary_color . ";text-transform:" . $caf_filter_transform . ";font-family:" . $caf_filter_font . ";font-size:" . $caf_filter_font_size . "px;}
 .data-target-div" . $b . " .manage-caf-search-icon i {background-color: " . $caf_filter_sec_color . ";color: " . $caf_filter_primary_color . ";text-transform:" . $caf_filter_transform . ";font-size:" . $caf_filter_font_size . "px;}
.data-target-div" . $b . " #caf-filter-layout1 li a.active {background-color: " . $caf_filter_sec_color2 . ";color: " . $caf_filter_sec_color . ";}

.data-target-div" . $b . " ul.caf-tabfilter-layout1 li a::after { background:" . $caf_filter_primary_color . ";color:" . $caf_filter_sec_color . ";}
.data-target-div" . $b . " ul.caf-tabfilter-layout1 li a {
color:" . $caf_filter_sec_color . ";text-transform:" . $caf_filter_transform . ";font-family:" . $caf_filter_font . ";font-size:" . $caf_filter_font_size . "px;
}
.data-target-div" . $b . " ul.caf-tabfilter-layout1 li a.active::after {
background:" . $caf_filter_sec_color . ";
}
.data-target-div" . $b . " ul.caf-tabfilter-layout1 li a.active {
color:" . $caf_filter_primary_color . ";
}
.data-target-div" . $b . ".tabfilter-layout1 #manage-ajax-response,.data-target-div" . $b . ".tabfilter-layout1 .caf-search-bar {
background:" . $caf_filter_sec_color2 . ";
}
.data-target-div" . $b . " .sr-layout2 input#caf-search-sub,.data-target-div" . $b . " .sr-layout1 input#caf-search-sub {background-color: " . $caf_filter_primary_color . ";color: " . $caf_filter_sec_color . ";font-size:" . $caf_filter_font_size . "px;}

.data-target-div" . $b . " .sr-layout2 input#caf-search-input {font-size:" . $caf_filter_font_size . "px;}

.data-target-div" . $b . " .sr-layout1 input#caf-search-input {font-size:" . $caf_filter_font_size . "px;}";

wp_add_inline_style($handle, $filter_css);
