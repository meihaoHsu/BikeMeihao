<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
$trm = '';
$caf_post_layout = 'post-layout1';
$caf_filter_layout = 'filter-layout1';
$caf_filter_more_val = "4";
$caf_filter_more_btn = "off";
$caf_default_term = 'all';
$caf_scroll_to_div = 'desktop';
$caf_scroll_to_div_desktop = "-100";
$caf_scroll_to_div_mobile = "-100";
$caf_scroll_to_div_mobile = "-100";
$caf_hor_button_text = "Filter";
$caf_filter_more_scroll_btn = 'on';
$caf_all_ed = 'enable';
$caf_term_dy = 'enable';
$caf_f_p_text = 'Search Here....';
$caf_search_button = "Search";
$cm_settings = '';
$caf_term_parent_tab = '';
if (get_post_meta($id, 'caf_term_parent_tab')) {
    $caf_term_parent_tab = get_post_meta($id, 'caf_term_parent_tab', true);
}

if (get_post_meta($id, 'caf_cum_css')) {
    $cm_settings = get_post_meta($id, 'caf_cum_css', true);
}
if (get_post_meta($id, 'caf_all_ed')) {
    $caf_all_ed = get_post_meta($id, 'caf_all_ed', true);
}
if (get_post_meta($id, 'caf_term_dy')) {
    $caf_term_dy = get_post_meta($id, 'caf_term_dy', true);
}
if (get_post_meta($id, 'caf_filter_more_scroll_btn')) {
    $caf_filter_more_scroll_btn = get_post_meta($id, 'caf_filter_more_scroll_btn', true);
}
if ($caf_filter_more_scroll_btn == "on") {
    $flsmore = "caf-scroll-on";
} else {
    $flsmore = "";
}
if (get_post_meta($id, 'caf_default_term')) {
    $caf_default_term = get_post_meta($id, 'caf_default_term', true);
}
if (get_post_meta($id, 'caf_filter_more_btn')) {
    $caf_filter_more_btn = get_post_meta($id, 'caf_filter_more_btn', true);
}
if (get_post_meta($id, 'caf_f_p_text')) {
    $caf_f_p_text = get_post_meta($id, 'caf_f_p_text', true);
}
if (get_post_meta($id, 'caf_search_button')) {
    $caf_search_button = get_post_meta($id, 'caf_search_button', true);
}
if (get_post_meta($id, 'caf_filter_more_val')) {
    $caf_filter_more_val = get_post_meta($id, 'caf_filter_more_val', true);
}
if (get_post_meta($id, 'caf_cpt_value')) {
    $caf_cpt_value = get_post_meta($id, 'caf_cpt_value', true);
}
if (get_post_meta($id, 'caf_taxonomy')) {
    $tax = get_post_meta($id, 'caf_taxonomy', true);
}
if (get_post_meta($id, 'caf_filter_layout')) {
    $caf_filter_layout = get_post_meta($id, 'caf_filter_layout', true);
}
if (get_post_meta($id, 'caf_terms')) {
    $terms_sel = get_post_meta($id, 'caf_terms', true);
    if ($terms_sel) {
//var_dump($terms_sel);
        $trm = implode(',', $terms_sel);
//var_dump($trm);
        //echo $caf_default_term;
        $trm2 = $trm;
        $trmss = array();
        foreach ($terms_sel as $term) {
            if (strpos($term, '___') !== false) {
                $ln = strpos($term, "___");
                $tx = substr($term, 0, $ln);
                $trmss[] = substr($term, $ln + 3);
            }
        }
        $terms_sel_tax = $terms_sel;
        $terms_sel = $trmss;
        if ($caf_default_term != 'all') {
            $trm = $caf_default_term;
        }

        if ($caf_term_dy == "enable") {
            $termm = get_queried_object();
            if (isset($termm->taxonomy)) {
                $cr_txo = $termm->taxonomy;
                $cr_trmid = $termm->term_id;
                if (in_array($cr_trmid, $trmss)) {
                    $caf_default_term = $cr_txo . "___" . $cr_trmid;
                }
            }
        }
        if ($caf_default_term && $caf_default_term != 'all' && $caf_filter_layout !== 'alphabetical-layout') {
            $trmss = $caf_default_term;
            $trm = $caf_default_term;
        }
    }
// var_dump($trm);
}
//echo $caf_default_term ;
/*---- APPEARANCE TAB SUBMITTED VARIABLE VALUES ----*/
if (get_post_meta($id, 'caf_sec_bg_color')) {
    $caf_sec_bg_color = get_post_meta($id, 'caf_sec_bg_color', true);
}
if (get_post_meta($id, 'caf_filter_status')) {
    $caf_filter_status = get_post_meta($id, 'caf_filter_status', true);
}
if (get_post_meta($id, 'caf_filter_status')) {
    $caf_filter_status = get_post_meta($id, 'caf_filter_status', true);
}
if (get_post_meta($id, 'caf_filter_font')) {
    $caf_filter_font = get_post_meta($id, 'caf_filter_font', true);
}
if (get_post_meta($id, 'caf_filter_transform')) {
    $caf_filter_transform = get_post_meta($id, 'caf_filter_transform', true);
}
if (get_post_meta($id, 'caf_filter_font_size')) {
    $caf_filter_font_size = get_post_meta($id, 'caf_filter_font_size', true);
}
if (get_post_meta($id, 'caf_filter_primary_color')) {
    $caf_filter_primary_color = get_post_meta($id, 'caf_filter_primary_color', true);
}
if (get_post_meta($id, 'caf_filter_sec_color')) {
    $caf_filter_sec_color = get_post_meta($id, 'caf_filter_sec_color', true);
}
if (get_post_meta($id, 'caf_filter_sec_color2')) {
    $caf_filter_sec_color2 = get_post_meta($id, 'caf_filter_sec_color2', true);
}
if (get_post_meta($id, 'caf_post_layout')) {
    $caf_post_layout = get_post_meta($id, 'caf_post_layout', true);
}
if (get_post_meta($id, 'caf_col_opt')) {
    $caf_col_opt = get_post_meta($id, 'caf_col_opt', true);
}
if (get_post_meta($id, 'caf_post_primary_color')) {
    $caf_post_primary_color = get_post_meta($id, 'caf_post_primary_color', true);
}
if (get_post_meta($id, 'caf_post_sec_color')) {
    $caf_post_sec_color = get_post_meta($id, 'caf_post_sec_color', true);
}
if (get_post_meta($id, 'caf_post_sec_color2')) {
    $caf_post_sec_color2 = get_post_meta($id, 'caf_post_sec_color2', true);
}
if (get_post_meta($id, 'caf_image_size')) {
    $caf_image_size = get_post_meta($id, 'caf_image_size', true);
}
if (get_post_meta($id, 'caf_empty_res')) {
    $caf_empty_res = get_post_meta($id, 'caf_empty_res', true);
}
if (get_post_meta($id, 'caf_link_target')) {
    $caf_link_target = get_post_meta($id, 'caf_link_target', true);
}
if (get_post_meta($id, 'caf_per_page')) {
    $caf_per_page = get_post_meta($id, 'caf_per_page', true);
}
/*---- TYPOGRAPHY TAB SUBMITTED VARIABLE VALUES ----*/
if (get_post_meta($id, 'caf_post_title_font_size')) {
    $caf_post_title_font_size = get_post_meta($id, 'caf_post_title_font_size', true);
}
if (get_post_meta($id, 'caf_post_title_font_color')) {
    $caf_post_title_font_color = get_post_meta($id, 'caf_post_title_font_color', true);
}
if (get_post_meta($id, 'caf_post_desc_font_size')) {
    $caf_post_desc_font_size = get_post_meta($id, 'caf_post_desc_font_size', true);
}
if (get_post_meta($id, 'caf_post_desc_font_color')) {
    $caf_post_desc_font_color = get_post_meta($id, 'caf_post_desc_font_color', true);
}
/*---- ADVANCED TAB SUBMITTED VARIABLE VALUES ----*/
if (get_post_meta($id, 'caf_special_post_class')) {
    $caf_special_post_class = get_post_meta($id, 'caf_special_post_class', true);
}
//var_dump($qry);
$pt = get_post_type($id);
$caf_filter_font = 'inherit';
$caf_post_font = 'inherit';
$caf_post_desc_font = 'inherit';
if (get_post_meta($id, 'caf_filter_font')) {
    $caf_filter_font = get_post_meta($id, 'caf_filter_font', true);
}
if (get_post_meta($id, 'caf_post_font')) {
    $caf_post_font = get_post_meta($id, 'caf_post_font', true);
}
if (get_post_meta($id, 'caf_post_desc_font')) {
    $caf_post_desc_font = get_post_meta($id, 'caf_post_desc_font', true);
}
if (get_post_meta($id, 'caf_scroll_to_div')) {
    $caf_scroll_to_div = get_post_meta($id, 'caf_scroll_to_div', true);
}
if (get_post_meta($id, 'caf_scroll_to_div_desktop')) {
    $caf_scroll_to_div_desktop = get_post_meta($id, 'caf_scroll_to_div_desktop', true);
}
if (get_post_meta($id, 'caf_scroll_to_div_mobile')) {
    $caf_scroll_to_div_mobile = get_post_meta($id, 'caf_scroll_to_div_mobile', true);
}
if (get_post_meta($id, 'caf_hor_button_text')) {
    $caf_hor_button_text = get_post_meta($id, 'caf_hor_button_text', true);
}
if (get_post_meta($id, 'caf_filter_search')) {
    $caf_filter_search = get_post_meta($id, 'caf_filter_search', true);
}
if (get_post_meta($id, 'caf_filter_search_layout')) {
    $caf_filter_search_layout = get_post_meta($id, 'caf_filter_search_layout', true);
}
//if(get_post_meta($id,'caf_default_term')) {
//$caf_default_term=get_post_meta($id,'caf_default_term',true);
//}
$flsr = '';
if (isset($caf_filter_search)) {
    if ($caf_filter_search == "on") {
        $flsr = $caf_filter_search_layout . " srch-on";
    }
}
$cl = '';
if ($caf_default_term == "all") {
    $cl = 'active';
}
//var_dump($terms_sel);
$caf_terms_icon = '';
if (get_post_meta($id, 'caf_terms_icon')) {
    $caf_terms_icon = get_post_meta($id, 'caf_terms_icon', true);
}
if (isset($caf_terms_icon)) {
    if (is_array($caf_terms_icon)) {
        $trc = array();
        foreach ($caf_terms_icon as $tr_icon) {
            if (!empty($tr_icon)) {

                if (strpos($tr_icon, '(') !== false) {
                    $ln = strpos($tr_icon, "(");
                    $last = strpos($tr_icon, ")");
                    $label = substr($tr_icon, 0, $ln);
                    preg_match('#\((.*?)\)#', $tr_icon, $match);
                    $key = $match[1];
                    $trc[$key] = $label;
                }
            }
        }
    }
}
