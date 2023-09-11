<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
/**
 * Multiple Selection Filter => Multiple Selection
 *
 * This template can be overridden by copying it to
yourtheme/category-ajax-filter/layouts/filter/multiple-checkbox.php
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
<div id="caf-multiple-check-filter" class='caf-filter-layout data-target-div<?php echo esc_attr($b) . " " . esc_attr($flsr); ?>'>
<ul class="caf-filter-container caf-multiple-check-filter">
<?php
if ($terms_sel) {
    $terms_sel = apply_filters('tc_caf_filter_order_by', $terms_sel);
    $trm1 = implode(',', $terms_sel_tax);
    $all_text = "All";
    $all_text = apply_filters('tc_caf_filter_all_text_param', $all_text);
    $i = 0;
    foreach ($terms_sel as $term) {
        $term_data = get_term($term);
        if ($term_data) {
            $ic = '';
            if (isset($trc)) {
                if (isset($trc[$term_data->term_id])) {
                    $ic = $trc[$term_data->term_id];
                }
            }
            if ($caf_default_term == $term_data->taxonomy . "___" . $term_data->term_id) {$cl = 'checked';} else { $cl = '';}
            echo '<li>';
            echo "<input type='checkbox' $cl data-id='" . esc_attr($term_data->taxonomy) . "___" . esc_attr($term_data->term_id) . "' id='" . esc_attr($term_data->taxonomy) . "___" . esc_attr($term_data->term_id) . "' value='" . esc_attr($term_data->taxonomy) . "___" . esc_attr($term_data->term_id) . "' class='check_box' data-target-div='data-target-div" . esc_attr($b) . "'><label data-main-id='flt' for='" . esc_attr($term_data->taxonomy) . "___" . esc_attr($term_data->term_id) . "'>";
            if (class_exists("TC_CAF_PRO") && $ic && $ic != 'undefined') {
                echo "<i class='$ic caf-front-ic'></i>";
            }
            echo esc_html($term_data->name) . "</label>";
            echo '</li>';
        }
        $i++;
    }
}
do_action("caf_after_filter_layout", $id, $b);?>
</ul>
</div>