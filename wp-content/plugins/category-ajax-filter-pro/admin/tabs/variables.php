<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
if (isset($type) && $type == "conditional") {
    $post = new stdClass();
    $post->ID = $id;
} else {
    global $post;
}
$caf_post_orders_by = 'title';
$caf_post_order_type = 'asc';
$caf_prev_text = 'Prev';
$caf_next_text = 'Next';
$caf_load_more_text = 'Load More';
$caf_pagination_status = 'on';
$caf_post_desc_font = 'inherit';
$caf_post_desc_transform = 'capitalize';
$caf_post_desc_font_size = '12';
$caf_filter_more_btn = 'off';
$caf_filter_more_val = '4';
$caf_filter_search = 'off';
$caf_filter_search_layout = 'search-layout1';
$default_all_text = 'All';
$caf_want_to_check = "I want to check out";
$caf_check_everything = 'Everything';
$caf_filter_relation = "OR";
$caf_read_more_text = 'Read More';
$caf_f_p_text = 'Search Here....';
$caf_default_term = '';
$caf_cats_relation = "IN";
$caf_taxo_relation = "OR";
$caf_all_ed = "enable";
$caf_term_dy = 'enable';
$caf_scroll_to_div = 'desktop';
$caf_scroll_to_div_desktop = "-100";
$caf_scroll_to_div_mobile = "-100";
$caf_hor_button_text = "Filter";
$caf_post_author = "show";
$caf_post_date = "show";
$caf_post_comments = "show";
$caf_post_cats = "show";
$caf_post_rd = "show";
$caf_post_dsc = "show";
$caf_post_title = "show";
$caf_post_image = "show";
$caf_post_date_format = "d, M Y";
$caf_terms_icon = '';
$caf_search_button = "Search";
$cm_settings = '';
$caf_term_parent_tab = '';
//var_dump($post);
if (isset($GLOBALS['post'])) {
    if (get_post_meta($post->ID, 'caf_term_parent_tab')) {
        $caf_term_parent_tab = get_post_meta($post->ID, 'caf_term_parent_tab', true);
    }
    if (get_post_meta($post->ID, 'caf_terms_icon')) {
        $caf_terms_icon = get_post_meta($post->ID, 'caf_terms_icon', true);
    }
    if (get_post_meta($post->ID, 'caf_post_orders_by')) {
        $caf_post_orders_by = get_post_meta($post->ID, 'caf_post_orders_by', true);
    }
    if (get_post_meta($post->ID, 'caf_post_order_type')) {
        $caf_post_order_type = get_post_meta($post->ID, 'caf_post_order_type', true);
    }
    if (get_post_meta($post->ID, 'caf_prev_text')) {
        $caf_prev_text = get_post_meta($post->ID, 'caf_prev_text', true);
    }
    if (get_post_meta($post->ID, 'caf_next_text')) {
        $caf_next_text = get_post_meta($post->ID, 'caf_next_text', true);
    }
    if (get_post_meta($post->ID, 'caf_load_more_text')) {
        $caf_load_more_text = get_post_meta($post->ID, 'caf_load_more_text', true);
    }
    if (get_post_meta($post->ID, 'caf_pagination_status')) {
        $caf_pagination_status = get_post_meta($post->ID, 'caf_pagination_status', true);
    }
    if (get_post_meta($post->ID, 'caf_post_desc_font')) {
        $caf_post_desc_font = get_post_meta($post->ID, 'caf_post_desc_font', true);
    }
    if (get_post_meta($post->ID, 'caf_post_desc_transform')) {
        $caf_post_desc_transform = get_post_meta($post->ID, 'caf_post_desc_transform', true);
    }
    if (get_post_meta($post->ID, 'caf_post_desc_font_size')) {
        $caf_post_desc_font_size = get_post_meta($post->ID, 'caf_post_desc_font_size', true);
    }
    if (get_post_meta($post->ID, 'caf_filter_more_btn')) {
        $caf_filter_more_btn = get_post_meta($post->ID, 'caf_filter_more_btn', true);
    }
    if (get_post_meta($post->ID, 'caf_filter_more_val')) {
        $caf_filter_more_val = get_post_meta($post->ID, 'caf_filter_more_val', true);
    }
    if (get_post_meta($post->ID, 'caf_filter_search')) {
        $caf_filter_search = get_post_meta($post->ID, 'caf_filter_search', true);
    }
    if (get_post_meta($post->ID, 'caf_filter_search_layout')) {
        $caf_filter_search_layout = get_post_meta($post->ID, 'caf_filter_search_layout', true);
    }
    if (get_post_meta($post->ID, 'caf_default_all_text')) {
        $default_all_text = get_post_meta($post->ID, 'caf_default_all_text', true);
    }
    if (get_post_meta($post->ID, 'caf_want_to_check')) {
        $caf_want_to_check = get_post_meta($post->ID, 'caf_want_to_check', true);
    }
    if (get_post_meta($post->ID, 'caf_check_everything')) {
        $caf_check_everything = get_post_meta($post->ID, 'caf_check_everything', true);
    }
    if (get_post_meta($post->ID, 'caf_filter_relation')) {
        $caf_filter_relation = get_post_meta($post->ID, 'caf_filter_relation', true);
    }
    if (get_post_meta($post->ID, 'caf_read_more_text')) {
        $caf_read_more_text = get_post_meta($post->ID, 'caf_read_more_text', true);
    }
    if (get_post_meta($post->ID, 'caf_f_p_text')) {
        $caf_f_p_text = get_post_meta($post->ID, 'caf_f_p_text', true);
    }
    if (get_post_meta($post->ID, 'caf_search_button')) {
        $caf_search_button = get_post_meta($post->ID, 'caf_search_button', true);
    }
    if (get_post_meta($post->ID, 'caf_default_term')) {
        $caf_default_term = get_post_meta($post->ID, 'caf_default_term', true);
    }
    if (get_post_meta($post->ID, 'caf_cats_relation')) {
        $caf_cats_relation = get_post_meta($post->ID, 'caf_cats_relation', true);
    }
    if (get_post_meta($post->ID, 'caf_taxo_relation')) {
        $caf_taxo_relation = get_post_meta($post->ID, 'caf_taxo_relation', true);
    }
    if (get_post_meta($post->ID, 'caf_all_ed')) {
        $caf_all_ed = get_post_meta($post->ID, 'caf_all_ed', true);
    }
    if (get_post_meta($post->ID, 'caf_term_dy')) {
        $caf_term_dy = get_post_meta($post->ID, 'caf_term_dy', true);
    }
    if (get_post_meta($post->ID, 'caf_scroll_to_div')) {
        $caf_scroll_to_div = get_post_meta($post->ID, 'caf_scroll_to_div', true);
    }
    if (get_post_meta($post->ID, 'caf_scroll_to_div_desktop')) {
        $caf_scroll_to_div_desktop = get_post_meta($post->ID, 'caf_scroll_to_div_desktop', true);
    }
    if (get_post_meta($post->ID, 'caf_scroll_to_div_mobile')) {
        $caf_scroll_to_div_mobile = get_post_meta($post->ID, 'caf_scroll_to_div_mobile', true);
    }
    if (get_post_meta($post->ID, 'caf_hor_button_text')) {
        $caf_hor_button_text = get_post_meta($post->ID, 'caf_hor_button_text', true);
    }
    if (get_post_meta($post->ID, 'caf_post_author')) {
        $caf_post_author = get_post_meta($post->ID, 'caf_post_author', true);
    }
    if (get_post_meta($post->ID, 'caf_post_date')) {
        $caf_post_date = get_post_meta($post->ID, 'caf_post_date', true);
    }
    if (get_post_meta($post->ID, 'caf_post_comments')) {
        $caf_post_comments = get_post_meta($post->ID, 'caf_post_comments', true);
    }
    if (get_post_meta($post->ID, 'caf_post_cats')) {
        $caf_post_cats = get_post_meta($post->ID, 'caf_post_cats', true);
    }
    if (get_post_meta($post->ID, 'caf_post_rd')) {
        $caf_post_rd = get_post_meta($post->ID, 'caf_post_rd', true);
    }
    if (get_post_meta($post->ID, 'caf_post_dsc')) {
        $caf_post_dsc = get_post_meta($post->ID, 'caf_post_dsc', true);
    }
    if (get_post_meta($post->ID, 'caf_post_title')) {
        $caf_post_title = get_post_meta($post->ID, 'caf_post_title', true);
    }
    if (get_post_meta($post->ID, 'caf_post_image')) {
        $caf_post_image = get_post_meta($post->ID, 'caf_post_image', true);
    }
    if (get_post_meta($post->ID, 'caf_post_date_format')) {
        $caf_post_date_format = get_post_meta($post->ID, 'caf_post_date_format', true);
    }
    if (get_post_meta($post->ID, 'caf_cum_css')) {
        $cm_settings = get_post_meta($post->ID, 'caf_cum_css', true);
    }
}
