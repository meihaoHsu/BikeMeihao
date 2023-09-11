<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
$filter_css = ".data-target-div" . $b . " .caf-pcf-parent-category h3.tax-heading, .data-target-div" . $b . " .caf-mtf-layout h3.tax-heading i {color:" . $caf_filter_primary_color . ";}
.data-target-div" . $b . " .caf-pcf-layout h3.tax-heading i {color:" . $caf_filter_primary_color . ";}
.data-target-div" . $b . " div.caf-pcf-layout ul li label {text-transform:" . $caf_filter_transform . ";font-family:" . $caf_filter_font . ";font-size:" . $caf_filter_font_size . "px;color:" . $caf_filter_sec_color . ";}

 .data-target-div" . $b . " div.caf-pcf-layout ul li input.pcf-terms.check_box:checked:before {color: " . $caf_filter_sec_color2 . ";}

.data-target-div" . $b . " .caf-pcf-parent-category h3.tax-heading{font-family:" . $caf_filter_font . ";}";

wp_add_inline_style($handle, $filter_css);
