<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
echo "<div class='caf-search-bar sr-layout1'><div class='caf-manage-search-bar'><input type='text' name='caf-search-input' id='caf-search-input' placeholder='" . esc_html__($caf_f_p_text, 'category-ajax-filter-pro') . "' class='caf-search-input'><input type='button' value='" . esc_html__($caf_search_button, 'category-ajax-filter-pro') . "' class='caf-search-sub' id='caf-search-sub'></div></div>";
