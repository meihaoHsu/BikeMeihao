<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<div class="trusty-pop-up-caf">
 <div class="caf-pop-up-manage">

	 <div class="close-caf-pop"><i class="fa fa-times cls" aria-hidden="true"></i></div>

 <div class='caf-pop-search'><input type='text' id='caf-pop-sr' placeholder='Search Icon...'></div>
<!--<div class="close-caf-pop"><i class="fa fa-times cls" aria-hidden="true"></i></div>-->
  <?php
$icons = get_option('caf_fa_icons');
if (!$icons) {
    $fa_icons = new CAF_Fa_Icons();
    $fa_icons->caf_generate_icon_array();
    $icons = get_option('caf_fa_icons');
} else {
    $icons = get_option('caf_fa_icons');
}
?>
   <div id="caf_icon_wrapper" class="caf-pop-icons">
            <?php if ($icons): ?>
              <?php foreach ($icons as $icon): ?>
                <div class="caf-icon-holder" data-icon="<?php echo esc_attr($icon['class']); ?>">
                  <div class="caf-p-icon">
                    <i  data-icon-name="<?php echo esc_attr($icon['class']); ?>" class="<?php echo esc_attr($icon['class']); ?>"></i>
                  </div>
                </div>
              <?php endforeach;?>
            <?php endif;?>
          </div>
  </div>
</div>
<div class='col-sm-12 row-bottom terms-row-admin'>
	<?php
//var_dump($tax);
//var_dump($terms_sel);
if (is_array($terms_sel)) {
    $terms_sel1 = implode(",", $terms_sel);
    echo "<input type='hidden' id='category_list_arr' value='" . esc_attr($terms_sel1) . "'>";
}
if (is_array($caf_term_parent_tab)) {
    $caf_term_parent_tabs = implode(",", $caf_term_parent_tab);
} else {
    $caf_term_parent_tabs = $caf_term_parent_tab;
}
echo "<input type='hidden' id='category_parent_arr' value='" . esc_attr($caf_term_parent_tabs) . "'>";

?>
	<!---- FORM GROUP TERMS ---->
	<div class="form-group row">
    <label for="caf-terms" class="col-sm-12 col-form-label"><?php echo esc_html__('Terms', 'category-ajax-filter-pro'); ?><span class="info"><?php echo esc_html__('Select Terms that you want to show on frontend. Default: 5/ASC ORDER', 'category-ajax-filter-pro'); ?></span></label>
    <div class="col-sm-12 ">
	<ul class="category-lists all-terms">
  <?php

$all_ic = '';
$sel_aic_val = '';
//var_dump($caf_terms_icon);
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
        if (isset($trc['all'])) {
            $all_ic = $trc['all'];
            $sel_aic_val = $all_ic . "(all)";
        }
    }
}
if (isset($trc)) {
    foreach ($trc as $key => $value) {
        echo '<input type="hidden" class="cat-term-ic" name="result[]" data-key="' . $key . '" value="' . $value . '">';
    }
}

?>
	<li id="all-cat" data-id="all"><input type='hidden' name='category-list-icon[]' id='hidall' class='hid-icon' data-name='category-list-idall' data-selected='' value='<?php echo esc_attr($sel_aic_val); ?>'><input name='all-select' class='category-list-all check' id='category-all-btn' type='checkbox' onClick="selectAllCats(event)"><label for='category-all-btn' class='category-list-all-label'><?php echo esc_html__('All', 'category-ajax-filter-pro'); ?></label><div class='caf-selected-ico'><i onclick='removeIcon(this,event)' class='<?php echo esc_attr($all_ic); ?> caf-selected-ic'></i></div><span><i class='fa fa-cog' aria-hidden='true'></i></span></li>
	<?php
//var_dump($tax);
if (!is_array($tax)) {
    $tax = explode(",", $tax);
}
if (isset($tax)) {
    $taxs = $tax;
    echo '<ul class="category-lists-sub">';
    //var_dump($taxs);
    foreach ($taxs as $tax) {
        // var_dump($tax);
        echo "<ul class='each-tax-data $tax' data-name='$tax'>";
        echo "<h2 style='display:inline-block;width:100%;font-weight: 600;text-transform: capitalize;padding: 0;margin: 0;'>" . esc_html($tax) . "</h2><hr style='margin-top:0'>";
//    $terms=get_terms(array('taxonomy' => $tax,'hide_empty' => false));
        $terms = wp_list_categories(array(
            'echo' => '1',
            'show_count' => true,
            'use_desc_for_title' => false,
            'hide_empty' => false,
            'taxonomy' => $tax,
            'order' => 'asc',
            'orderby' => 'name',
            'title_li' => '',
            'style' => 'list',
        ));
        //var_dump($terms);
        echo "</ul>";
    }
    echo '</ul>';
}
?>
	</ul>
	</div>
	</div>
    <!---- FORM GROUP ---->
    </div>