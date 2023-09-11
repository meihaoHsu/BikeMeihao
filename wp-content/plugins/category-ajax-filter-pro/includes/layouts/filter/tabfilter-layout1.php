<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
/**
 * Tab Layout Filter =>Tab Layout 1
 *
 * This template can be overridden by copying it to
yourtheme/category-ajax-filter/layouts/filter/tabfilter-layout1.php
 *
 * HOWEVER, on occasion CAF will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://caf.trustyplugins.com/documentation
 */

?>
<div id="caf-tabfilter-layout1" class='caf-tab-layout caf-filter-layout data-target-div<?php echo esc_attr($b) . " " . esc_attr($flsr) . " " . esc_attr($flsmore); ?>'>
<ul class="caf-filter-container caf-tabfilter-layout1">
<?php
if ($terms_sel) {
    //echo $id;
    $total_terms = count($terms_sel);
    $total_terms_1 = $total_terms - 1;
    $trm1 = implode(',', $terms_sel_tax);
    $terms_sel = apply_filters('tc_caf_filter_order_by', $terms_sel, $id);
    $all_text = "All";
    $all_text = apply_filters('tc_caf_filter_all_text', $all_text, $id);
    if ($total_terms >= 5) {
        echo '<div class="caf-scroller caf-scroll-left"><i class="fa fa-caret-left" aria-hidden="true" data-count="' . esc_attr($total_terms) . '"></i></div>';
    }
    if ($caf_default_term == "all") {
        $cl = 'active';
    }
    if ($caf_all_ed == 'enable') {
        echo '<li class="caf-mb-4"><a href="#" data-id="' . esc_attr($trm1) . '" data-main-id="flt" class="' . esc_attr($cl) . '" data-target-div="data-target-div' . esc_attr($b) . '">' . esc_html($all_text) . '</a></li>';
    }
    $j = 0;
    foreach ($terms_sel as $key => $term) {
        if ($j == 4) {
            // echo "</div>";
            echo '<div class="caf-scroller caf-scroll-right"><i class="fa fa-caret-right" aria-hidden="true" data-count="' . esc_html($total_terms) . '"></i></div>';
        }
        $term_data = get_term($term);
        if ($term_data) {
            $ic = '';
            if (isset($trc)) {
                if (isset($trc[$term_data->term_id])) {
                    $ic = $trc[$term_data->term_id];
                }
            }
            if ($caf_default_term == $term_data->taxonomy . "___" . $term_data->term_id) {$cl = 'active';} else { $cl = '';}
            $data_id = esc_attr($term_data->taxonomy) . "___" . esc_attr($term_data->term_id);
            echo "<li class='caf-mb-4'><a href='#' class='" . $cl . "' data-id='" . esc_attr($data_id) . "' data-main-id='flt' data-target-div='data-target-div" . esc_attr($b) . "'>";
            if (class_exists("TC_CAF_PRO") && $ic && $ic != 'undefined') {
                echo "<i class='$ic caf-front-ic'></i>";
            }
            echo esc_html($term_data->name) . "</a></li>";
        }
        $j++;
    }
}
?>
</ul>
 <?php
//do_action("caf_after_filter_layout",$id,$b);
?>
</div>
<?php
do_action("caf_after_filter_layout", $id, $b);
?>