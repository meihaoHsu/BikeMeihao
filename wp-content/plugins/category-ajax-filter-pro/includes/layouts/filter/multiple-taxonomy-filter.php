<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
/**
 * Multiple Taxonomy Filter =>Multiple Taxonomy Filter
 *
 * This template can be overridden by copying it to
yourtheme/category-ajax-filter/layouts/filter/multiple-taxonomy-filter.php
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
//var_dump($terms_sel);
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
//var_dump($terms_sel);
?>
<div id="caf-multiple-taxonomy-filter" class='caf-mtf-layout caf-filter-layout data-target-div<?php echo esc_attr($b) . " " . esc_attr($flsr); ?>'>
<?php
if ($caf_filter_search == 'on') {
    do_action("caf_after_filter_layout", $id, $b);
}
$vertical_expand=[];
if (get_post_meta($id, 'vertical-expand')) {
    $vertical_expand = get_post_meta($id, 'vertical-expand', true);
   }
//var_dump($vertical_expand);
if (is_array($tax)) {
    foreach ($tax as $tx) {
        //echo $tx;
        $tx_label = $tx;
        $taxonomy_details = get_taxonomy($tx);
        $tx_label = $taxonomy_details->label;
        //var_dump($taxonomy_details);
        $tx_label = apply_filters('tc_caf_multiple_tax_label_filter', $tx_label, $id);
        echo '<ul class="caf-filter-container caf-mtf-layout caf-mtf-tax-' . esc_attr($tx) . '">';
        echo "<h3 class='tax-heading' data-name='" . esc_attr($tx) . "'>" . esc_attr($tx_label);
       if(in_array($tx,$vertical_expand)) {
        echo "<i class='fa fa-chevron-down' aria-hidden='true'></i>";
       }
       else {
        echo "<i class='fa fa-chevron-up' aria-hidden='true'></i>";
       }
        echo "</h3>";
        if (is_array($txtr) && !empty($txtr)) {
            //var_dump($tx);
            if (isset($txtr[$tx])) {
                foreach ($txtr[$tx] as $key => $trms) {
                    $term_data = get_term($trms);
                    $term_id = $term_data->term_id;
                    $term_tax = $term_data->taxonomy;
                    if ($caf_default_term == $term_tax . "___" . $term_id) {$cl = 'checked';} else { $cl = '';}
                    if ($key == 0) {$child = 'caf-first-child';} else { $child = '';}
                    $ic = '';
                    if (isset($trc)) {
                        if (isset($trc[$term_data->term_id])) {
                            $ic = $trc[$term_data->term_id];
                        }
                    }

                    if(in_array($tx,$vertical_expand)) {
                        $li_style="display:none";
                    }
                    else {
                        $li_style='';
                    }
                    echo "<li style='".$li_style."' class='mtf-li-child " . esc_attr($child) . "'><input $cl type='checkbox' name='mtf_terms[]' class='mtf-terms check_box' id='mtf-terms-" . esc_attr($term_data->term_id) . "' data-id='" . esc_attr($term_tax) . "___" . esc_attr($term_id) . "' value='" . esc_attr($term_tax) . "___" . esc_attr($term_id) . "' data-target-div='data-target-div" . esc_attr($b) . "'><label for='mtf-terms-" . esc_attr($term_data->term_id) . "' class='' data-main-id='flt'>";
                    if (class_exists("TC_CAF_PRO") && $ic && $ic != 'undefined') {
                        echo "<i class='$ic caf-front-ic'></i>";
                    }
                    echo esc_html($term_data->name) . "</label></li>";
                }
            }
            echo "</ul>";
        }
    }
}
?>
</ul>
</div>