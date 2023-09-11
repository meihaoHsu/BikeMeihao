<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
$filter_css = ".data-target-div" . $b . " div.caf-multiple-taxonomy-filter-modern .manage-inner-caf {background:" . $caf_filter_primary_color . "}

 .data-target-div" . $b . " div.caf-multiple-taxonomy-filter-modern ul.caf_select_multi {background:" . $caf_filter_sec_color . "}

 .data-target-div" . $b . " div.caf-multiple-taxonomy-filter-modern ul.caf_select_multi li {color:" . $caf_filter_sec_color2 . ";font-family:" . $caf_filter_font . ";font-size:" . $caf_filter_font_size . "px;text-transform:" . $caf_filter_transform . ";}

 .data-target-div" . $b . " div.caf-multiple-taxonomy-filter-modern ul.caf_select_multi ul.caf-multi-drop-sub li:hover {background-color:" . $caf_filter_sec_color2 . ";color:" . $caf_filter_sec_color . "}

 .data-target-div" . $b . " div.caf-multiple-taxonomy-filter-modern ul.caf_select_multi li.active {
 background-color:" . $caf_filter_sec_color2 . ";color:" . $caf_filter_sec_color . "}

 .data-target-div" . $b . " .caf-multiple-taxonomy-filter-modern .caf-manage-search-bar {overflow: hidden;}
.data-target-div" . $b . " .caf-multiple-taxonomy-filter-modern input#caf-search-sub {padding: 7px 12px;border: none;border-left: 1px solid #ddd;}
.data-target-div" . $b . " .caf-multiple-taxonomy-filter-modern .caf-search-bar { margin-bottom: 10px;width:100%;}
.data-target-div" . $b . " .caf-multiple-taxonomy-filter-modern .caf-search-bar.sr-layout2 { margin-bottom: 0px;width:auto;display:-webkit-inline-box;margin-left:5px;position:relative;top:7px;}
.data-target-div" . $b . " .caf-multiple-taxonomy-filter-modern .caf-filter-container {display:block;text-align:left;}
.data-target-div" . $b . " .caf-multiple-taxonomy-filter-modern .caf-search-bar.caf-icon-search.sr-layout2 {text-align: right;}
.data-target-div" . $b . " .caf-filter-layout.srch-on.search-layout2 .caf-manage-search-bar.active {float:left;}

.data-target-div" . $b . " .manage-caf-search-icon {float: right;}";

wp_add_inline_style($handle, $filter_css);
