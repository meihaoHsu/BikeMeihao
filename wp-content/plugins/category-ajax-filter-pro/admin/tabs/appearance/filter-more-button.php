<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<!---- START ENABLE/DISABLE FILTER FORM GROUP ROW ---->
<div class="control-more-full">
	<div class="col-sm-12 row-bottom">
	<div class="form-group row">
    <label for="caf-filter-more" class='col-sm-12 bold-span-title'><?php echo esc_html__('Enable/Disable Filter More Button', 'category-ajax-filter-pro'); ?><span class='info'><?php echo esc_html__('If You have number of categories in filter to show then you can manage them with more button. It will show the categories in dropdown. Also set more button after specific number of categories.', 'category-ajax-filter-pro'); ?></span></label>
    <div class="col-sm-12 filter-en">
    <input type="checkbox" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" id="enable-disable-filter-more" name="filter_more"  class="checkmore tc_caf_object_field tc_caf_checkbox" data-field-type='checkbox' data-name="caf-filter-more" <?php
if ($caf_filter_more_btn == "on") {echo "checked";} else {echo "";}?>>
    <input class="tc_caf_object_field tc_caf_text caf_import" data-import='caf_filter_more' data-field-type='text' type="hidden" name='caf-filter-more' id='caf-filter-more' value='<?php echo esc_attr($caf_filter_more_btn); ?>'>
	</div>
	</div>
	</div>
<div class="caf-control-more">
	<div class="col-sm-12 row-bottom">
<div class="form-group row">
    <label for="caf-filter-more-val" class="col-sm-12 col-form-label">Add More After Number of Categories<span class="info">Add More button after number of categories</span></label>
    <div class="col-sm-12">
    <input type="text" class="caf_import form-control" id="caf-filter-more-val" name="caf-filter-more-val" data-import='caf_filter_more_val' value="<?php echo esc_attr($caf_filter_more_val); ?>">
	</div>
	</div>
</div>
</div>
     </div>
<!---- END ENABLE/DISABLE FILTER FORM GROUP ROW ---->
<?php
$cfl='';
if (get_post_meta($post->ID, 'caf_filter_layout')) {
    $cfl = get_post_meta($post->ID, 'caf_filter_layout', true);
}
if($cfl=="multiple-taxonomy-filter") {
    $cfl_cl='';
}
else {
    $cfl_cl='caf-hide';
}
?>


<div class="control-vertical-layout <?php echo $cfl_cl; ?>">
<div class="col-sm-12 row-bottom">
	<div class="form-group row">
    <label for="caf-filter-search" class='col-sm-12 bold-span-title'><?php echo esc_html__('Collapse Taxonomies - Vertical Filter', 'category-ajax-filter-pro'); ?><span class='info'><?php echo esc_html__('Select the specific taxonomies that you want to collapse by default.', 'category-ajax-filter-pro'); ?></span></label>
    <div class="col-sm-12 filter-en vertical-setting">
   <?php 
   $select='';
   $vertical_expand='';
   if (get_post_meta($post->ID, 'caf_cpt_value')) {
    $select = get_post_meta($post->ID, 'caf_cpt_value', true);
   }
   if (get_post_meta($post->ID, 'vertical-expand')) {
    $vertical_expand = get_post_meta($post->ID, 'vertical-expand', true);
   }
   if($select) {
    $taxo = get_object_taxonomies($select);
    if(is_array($taxo)) {
        foreach($taxo as $tax) {
if($vertical_expand && in_array($tax,$vertical_expand)) {
    $v_ch='checked';
}
else {
    $v_ch=''; 
}
            echo "<label><input type='checkbox' name='vertical-expand[]' class='vertical-check' value='".$tax."' $v_ch />";
            echo $tax;
            echo "</label>";
        }
    }
   }

    ?>
	</div>
	</div>
	</div>
</div>

<div class="control-search-div">
<div class="col-sm-12 row-bottom">
	<div class="form-group row">
    <label for="caf-filter-search" class='col-sm-12 bold-span-title'><?php echo esc_html__('Enable/Disable Search Bar', 'category-ajax-filter-pro'); ?><span class='info'><?php echo esc_html__('Search field to search through the posts.', 'category-ajax-filter-pro'); ?></span></label>
    <div class="col-sm-12 filter-en">
    <input type="checkbox" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" id="enable-disable-search" name="caf-filter-search"  class="checksearch tc_caf_object_field tc_caf_checkbox" data-field-type='checkbox' data-name="caf-filter-search" <?php
if ($caf_filter_search == "on") {echo "checked";} else {echo "";}?>>
    <input class="tc_caf_object_field tc_caf_text caf_import" data-import='caf_filter_more' data-field-type='text' type="hidden" name='caf-filter-search' id='caf-filter-search' value='<?php echo esc_attr($caf_filter_search); ?>'>
	</div>
	</div>
	</div>
	<!---- END ENABLE/DISABLE FILTER FORM GROUP ROW ---->
 <div class="caf-control-search">
	<div class="col-sm-12 row-bottom">
<div class="form-group row">
 <?php
$caf_admin_filters = new CAF_PRO_admin_filters();
$srlayouts = apply_filters('tc_caf_search_layouts', array($caf_admin_filters, 'tc_caf_search_layouts'));
?>
    <label for="caf-filter-search-layout" class="col-sm-12 col-form-label">Select Search Layout<span class="info">Search bar position and design.</span></label>
    <div class="col-sm-12">
    <select class="form-control tc_caf_object_field tc_caf_select caf_import" data-import="caf_filter_search_layout" data-field-type="select" id="caf-filter-search-layout" name="caf-filter-search-layout">
     <?php
foreach ($srlayouts as $key => $layout) {
    if ($caf_filter_search_layout == $key) {$selected = 'selected';} else { $selected = '';}
    echo '<option value="' . esc_attr($key) . '" ' . $selected . '>' . esc_html($layout) . '</option>';
}
?>
    </select>
	</div>
	</div>
</div>
</div>
</div>