<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
/**
 * Multiple Taxonomy Filter =>Multiple Taxonomy Filter Horizontal Dropdown
 *
 * This template can be overridden by copying it to
yourtheme/category-ajax-filter/layouts/filter/multiple-taxonomy-filter-hor.php
 *
 * HOWEVER, on occasion CAF will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://caf.trustyplugins.com/documentation
 */
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
?>
<div id="caf-multiple-taxonomy-filter-hor" class='btn-enable caf-mtf-layout caf-filter-layout data-target-div<?php echo esc_attr($b) . " " . esc_attr($flsr) . " " . esc_attr($div_cl); ?>'>
<?php
if (is_array($tax)) {
    foreach ($tax as $key => $tx) {
        //echo $key;
        $tx_label = $tx;
        $taxonomy_details = get_taxonomy($tx);
        $tx_label = $taxonomy_details->label;
        $tx_label = apply_filters('tc_caf_multiple_tax_label_filter', $tx_label, $id);
        echo "<select class='caf_select_multi' name='caf_select_multi'>";
        echo "<option value='0'>" . esc_html($tx_label) . "</option>";
        if (is_array($txtr) && !empty($txtr)) {
            if (isset($txtr[$tx])) {
                foreach ($txtr[$tx] as $key => $trms) {
                    $term_data = get_term($trms);
                    $term_id = $term_data->term_id;
                    $term_tax = $term_data->taxonomy;
                    if ($caf_default_term == $term_tax . "___" . $term_id) {$cl = 'selected';} else { $cl = '';}
                    $ic = '';
                    if (isset($trc)) {
                        if (isset($trc[$term_data->term_id])) {
                            $ic = $trc[$term_data->term_id];
                        }
                    }
                    echo "<option value='" . esc_attr($term_tax) . "___" . esc_attr($term_id) . "' $cl>";
                    if ($ic) {
                        echo "<i class='$ic caf-front-ic'></i>";
                    }
                    echo esc_html($term_data->name) . "</option>";
                }
            }
        }
        echo "</select>";
    }
    echo "<button class='caf_select_multi_btn' data-target-div='data-target-div" . $b . "'>" . esc_html($caf_hor_button_text) . "</button>";
    if ($caf_filter_search == 'on') {
        do_action("caf_after_filter_layout", $id, $b);
    }
}
?>
</ul>
 <?php
//do_action("caf_after_filter_layout",$id,$b);
?>
</div>
<?php
//do_action("caf_after_filter_layout",$id,$b);
?>