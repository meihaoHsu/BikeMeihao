<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
$filter_css = ".data-target-div" . $b . " div#caf-multiple-taxonomy-filter ul li label {text-transform:" . $caf_filter_transform . ";font-family:" . $caf_filter_font . ";font-size:" . $caf_filter_font_size . "px;}
 .data-target-div" . $b . " div#caf-multiple-taxonomy-filter ul {background-color: " . $caf_filter_primary_color . ";}
  .data-target-div" . $b . " div#caf-multiple-taxonomy-filter ul li label {background-color: " . $caf_filter_sec_color . ";color:" . $caf_filter_sec_color2 . ";}
 .data-target-div" . $b . " div#caf-multiple-taxonomy-filter ul li input[type='checkbox']:checked + label::before {color: " . $caf_filter_primary_color . ";}
.data-target-div" . $b . " .caf-mtf-layout h3.tax-heading, .data-target-div" . $b . " .caf-mtf-layout h3.tax-heading i {color:" . $caf_filter_sec_color2 . ";}
.data-target-div" . $b . " .caf-mtf-layout h3.tax-heading{font-family:" . $caf_filter_font . ";}
.data-target-div" . $b . " #caf-multiple-taxonomy-filter .caf-manage-search-bar {overflow: hidden;}
.data-target-div" . $b . " #caf-multiple-taxonomy-filter input#caf-search-sub {padding: 7px 12px;border: none;border-left: 1px solid #ddd;}
.data-target-div" . $b . " #caf-multiple-taxonomy-filter .caf-search-bar { margin-bottom: 10px;width:100%;}
.data-target-div" . $b . " #caf-multiple-taxonomy-filter .caf-filter-container {display:block;text-align:left;}
.data-target-div" . $b . " #caf-multiple-taxonomy-filter .caf-search-bar.caf-icon-search.sr-layout2 {text-align: right;background:#fff;}
.data-target-div" . $b . " .caf-filter-layout.srch-on.search-layout2 .caf-manage-search-bar.active {float:left;}
.data-target-div" . $b . " .manage-caf-search-icon {float: right;}";

wp_add_inline_style($handle, $filter_css);
