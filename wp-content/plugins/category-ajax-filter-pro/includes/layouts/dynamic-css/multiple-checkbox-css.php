<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
$filter_css = ".data-target-div" . $b . " .caf-multiple-check-filter li input[type='checkbox']:checked + label {
 background-color: " . $caf_filter_primary_color . ";
 border-color:" . $caf_filter_sec_color . ";
 }
  .data-target-div" . $b . " ul.caf-multiple-check-filter li label {
  color:" . $caf_filter_sec_color2 . ";
   border-color:" . $caf_filter_sec_color2 . ";
  }
 .data-target-div" . $b . " .manage-caf-search-icon i {background-color: " . $caf_filter_sec_color . ";color: " . $caf_filter_primary_color . ";text-transform:" . $caf_filter_transform . ";font-size:" . $caf_filter_font_size . "px;}
.data-target-div" . $b . " #caf-filter-layout1 li a.active {background-color: " . $caf_filter_sec_color2 . ";color: " . $caf_filter_sec_color . ";}

.data-target-div" . $b . " .search-layout2 input#caf-search-sub,.data-target-div" . $b . " .search-layout1 input#caf-search-sub {background-color: " . $caf_filter_primary_color . ";color: #fff;text-transform:" . $caf_filter_transform . ";font-size:" . $caf_filter_font_size . "px;}

.data-target-div" . $b . " .search-layout2 input#caf-search-input {font-size:" . $caf_filter_font_size . "px;text-transform:" . $caf_filter_transform . ";}
.data-target-div" . $b . " .search-layout1 input#caf-search-input {font-size:" . $caf_filter_font_size . "px;text-transform:" . $caf_filter_transform . ";}";

wp_add_inline_style($handle, $filter_css);
