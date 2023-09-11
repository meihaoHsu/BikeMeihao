<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<!-- HORIZONTAL BUTTON ROW -->
<div class='horizontal-btn-row'>
<!-- HORIZONTAL BUTTON TEXT ROW -->
<div class="col-sm-12 row-bottom manage-horizontal-button-text">
	<div class="form-group row">
    <label for="caf-hor-button-text" class='col-sm-12 bold-span-title'><?php echo esc_html__('Filter Submit Button Text', 'category-ajax-filter-pro'); ?><span class='info'><?php echo esc_html__('Name of the submit button.', 'category-ajax-filter-pro'); ?></span></label>
    <div class="col-sm-12">
		   <input type="text" class="form-control caf_import" data-import="caf_hor_button_text" id="caf-hor-button-text" name="caf-hor-button-text" value="<?php echo esc_html($caf_hor_button_text); ?>">
	</div>
	</div>
	</div>
 </div>
<!-- RELATION ROW -->
<div class="col-sm-12 row-bottom manage-relation-row">
	<div class="form-group row">
    <label for="caf-filter-relation" class='col-sm-12 bold-span-title'><?php echo esc_html__('Select Relation', 'category-ajax-filter-pro'); ?><span class='info'><?php echo esc_html__('Select Relation.', 'category-ajax-filter-pro'); ?></span></label>
    <div class="col-sm-12">
    <select class="form-control tc_caf_object_field tc_caf_select caf_import" data-import="caf_filter_relation" data-field-type='select' id="caf-filter-relation" name="caf-filter-relation">
		<option value="OR" <?php if ($caf_filter_relation == "OR") {echo "selected";}?>>OR</option>
     <option value="AND" <?php if ($caf_filter_relation == "AND") {echo "selected";}?>>AND</option>
		?>
    </select>
	</div>
	</div>
	</div>