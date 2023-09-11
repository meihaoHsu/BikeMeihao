<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
/**
 * Multiple Taxonomy Filter =>Multiple Taxonomy Filter Horizontal Dropdown (Modern)
 *
 * This template can be overridden by copying it to
yourtheme/category-ajax-filter/layouts/filter/multiple-taxonomy-filter-hor-modern.php
 *
 * HOWEVER, on occasion CAF will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://caf.trustyplugins.com/documentation
 */
//var_dump($terms_sel);
$trmc = array();
$txtr = array();
if ($trm) {
    $terms_sel = explode(",", $trm);
}
foreach ($terms_sel as $term) {
    if (strpos($term, '___') !== false) {
        $ln = strpos($term, "___");
        $tx = substr($term, 0, $ln);
        $trmc[] = substr($term, $ln + 3);
        $txtr[$tx][] = substr($term, $ln + 3);
    }
}
$terms_sel_tax = $terms_sel;
$terms_sel = $trmc;
$tax = explode(",", $tax);
$div_cl = "caf_multi_tax" . count($tax);
$caf_filter_search_layout = '';
if (get_post_meta($id, 'caf_filter_search_layout')) {
    $caf_filter_search_layout = get_post_meta($id, 'caf_filter_search_layout', true);
}
if (strpos($caf_default_term, '___') !== false) {
    $ln = strpos($caf_default_term, "___");
    $df_tx = substr($caf_default_term, 0, $ln);
    $df_trmid = substr($caf_default_term, $ln + 3);
}
//echo $caf_default_term;
?>
<div class='caf-multiple-taxonomy-filter-modern btn-enable caf-mtf-layout caf-filter-layout data-target-div<?php echo esc_attr($b) . " " . esc_attr($flsr) . " " . esc_attr($div_cl); ?>'>
 <div class='manage-inner-caf'>
<?php
if (is_array($tax)) {
    foreach ($tax as $key => $tx) {
        $all_text = "All";
        $all_text = apply_filters('tc_caf_filter_all_text', $all_text, $id);
        if (!class_exists("TC_CAF_PRO")) {
            $cl = 'active';
        } else {
            if ($caf_default_term == 'all') {
                $cl = 'active';
            }
        }
        //echo $key;
        $tx_label = $tx;
        $taxonomy_details = get_taxonomy($tx);
        $tx_label = $all_text . ' ' . $taxonomy_details->label;
        $tx_label = apply_filters('tc_caf_multiple_tax_label_filter', $tx_label, $id);
        // echo $caf_default_term;
        echo "<ul class='caf_select_multi'>";
        //echo $tx;
        $tx_label_new = $tx_label;
        $caf_df_trm='0';
        if (isset($df_tx)) {
            if ($tx == $df_tx) {
                $df_term = get_term_by('id', $df_trmid, $df_tx);
                $tx_label_new = $df_term->name;
                $caf_df_trm=$caf_default_term;
            }
        }
        echo "<li class='caf_select_multi_default' data-value='$caf_df_trm'><span>";
        echo esc_html($tx_label_new) . "</span>";
        echo "<i class='fa fa-chevron-down caf-multi-mod-right' aria-hidden='true'></i>";
        echo "</li>";

        echo "<ul class='caf-multi-drop-sub'>";
        $ic_all = '';
        if (isset($trc)) {
            if (isset($trc['all'])) {
                $ic_all = $trc['all'];
            }
        }
        echo "<li class='caf_select_multi_default_label_2' data-value='0' data-name='$tx_label'><i class='$ic_all caf-front-ic'></i><span>" . $tx_label . "</span></li>";
        if (is_array($txtr) && !empty($txtr)) {
            if (isset($txtr[$tx])) {
                foreach ($txtr[$tx] as $key => $trms) {
                    $term_data = get_term($trms);
                    $term_id = $term_data->term_id;
                    $term_tax = $term_data->taxonomy;
                    if ($caf_default_term == $term_tax . "___" . $term_id) {$cl = 'active';} else { $cl = '';}
                    $ic = '';
                    if (isset($trc)) {
                        if (isset($trc[$term_data->term_id])) {
                            $ic = $trc[$term_data->term_id];

                        }
                    }
                    echo "<li class='caf_select_multi_dp_value $cl' data-value='" . esc_attr($term_tax) . "___" . esc_attr($term_id) . "' data-name='" . esc_attr($term_data->name) . "' $cl>";
                    if (class_exists("TC_CAF_PRO") && $ic && $ic != 'undefined') {
                        echo "<i class='$ic caf-front-ic'></i>";
                    }
                    echo esc_html($term_data->name) . "</li>";
                }
            }
            echo "</ul></ul>";
        }
    }
}
?>
</ul>
 <?php

if ($caf_filter_search == 'on' && $caf_filter_search_layout == 'search-layout2') {
    do_action("caf_after_filter_layout", $id, $b);
}
?>
</div>
<?php
if ($caf_filter_search == 'on' && $caf_filter_search_layout == 'search-layout1') {
    do_action("caf_after_filter_layout", $id, $b);
}
?>
</div>
<?php
//do_action("caf_after_filter_layout",$id,$b);
?>