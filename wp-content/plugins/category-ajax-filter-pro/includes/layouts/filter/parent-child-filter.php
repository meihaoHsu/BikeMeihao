<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
/**
 * Parent Child Filter =>Parent Child Filter
 *
 * This template can be overridden by copying it to
yourtheme/category-ajax-filter/layouts/filter/parent-child-filter.php
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
//var_dump($caf_term_parent_tab);
//var_dump($terms_sel);
?>
<div class='caf-pcf-layout caf-filter-layout data-target-div<?php echo esc_attr($b) . " " . esc_attr($flsr); ?>'>
 <?php
if ($caf_filter_search == 'on') {
    do_action("caf_after_filter_layout", $id, $b);
}
if (is_array($caf_term_parent_tab)) {
    foreach ($caf_term_parent_tab as $key => $ptab) {
        if (strpos($ptab, '___') !== false) {
            $ln = strpos($ptab, "___");
            $tx = substr($ptab, 0, $ln);
            $trmc = substr($ptab, $ln + 3);
            $term_data = get_term($trmc);
            //var_dump($term_data);
            $term_id = $term_data->term_id;
            $term_tax = $term_data->taxonomy;
            $term_name = $term_data->name;
            echo "<ul class='caf-filter-container caf-pcf-layout caf-pcf-parent-category' data-loop-key='$key'>";
            $ic = '';
            if (isset($trc)) {
                if (isset($trc[$term_id])) {
                    $ic = $trc[$term_id];
                }
            }
            echo '<h3 class="tax-heading" data-name="' . $term_name . '">';
            if (class_exists("TC_CAF_PRO") && $ic && $ic != 'undefined') {
                echo "<i class='$ic caf-front-ic'></i>";
            }
            echo $term_name . '</h3>';
            $args = array(
                'child_of' => $term_id,
                'hide_empty' => false,
            );

            $terms = get_terms($term_tax, $args);
            foreach ($terms as $term) {
                $tr_name = $term->name;
                $tr_id = $term->term_id;
                if ($caf_default_term == $term_tax . "___" . $tr_id) {$cl = 'checked';} else { $cl = '';}
                if ($key == 0) {$child = 'caf-first-child';} else { $child = '';}
                $ic = '';
                if (isset($trc)) {
                    if (isset($trc[$tr_id])) {
                        $ic = $trc[$tr_id];
                    }
                }
                if (in_array($term->term_id, $terms_sel)) {
                    echo "<li class='mtf-li-child " . esc_attr($child) . "'><label>";
                    echo "<input $cl type='checkbox' name='pcf_terms[]' class='pcf-terms check_box' value='" . $term_tax . "___" . $tr_id . "' id='" . $term_tax . "___" . $tr_id . "' data-id='" . $term_tax . "___" . $tr_id . "' data-target-div='data-target-div" . esc_attr($b) . "'>";
                    if (class_exists("TC_CAF_PRO") && $ic && $ic != 'undefined') {
                        echo "<i class='$ic caf-front-ic'></i>";
                    }
                    echo $tr_name;
                    echo "</label></li>";
                }
            }
        }
        echo "</ul>";
    }
}
?>
</div>