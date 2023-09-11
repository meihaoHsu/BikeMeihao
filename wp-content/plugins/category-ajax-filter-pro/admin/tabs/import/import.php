<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
$caf_admin_fliters = new CAF_admin_filters();
?>

<div class="col-sm-12 row-bottom">
	<div class="form-group row">
    <label for="caf-post-layout-import" class='col-sm-12 bold-span-title'><?php echo esc_html__('Select Post Layout to Import', 'category-ajax-filter-pro'); ?><span class='info'><?php echo esc_html__('Select post layout and click on import button, It will auto import all settings,colors etc like demo preview.', 'category-ajax-filter-pro'); ?></span></label>
    <?php
$playouts = apply_filters('tc_caf_post_layouts', array($caf_admin_fliters, 'tc_caf_post_layouts'));
?>
    <div class="col-sm-12">
    <select class="form-control tc_caf_object_field tc_caf_select caf_import" data-import="caf_post_layout_import" data-field-type='select' id="caf-post-layout-import" name="caf-post-layout-import">
	<?php
foreach ($playouts as $key => $layout) {
    echo '<option value="' . esc_attr($key) . '">' . esc_html($layout) . '</option>';
}
?>
    </select>
	</div>
 </div>
	<input type="button" name="import-layout" id="import-layout-button-pro" value="Import Demo Layout" class="form-control">
	</div>
<!-- EXPORT/IMPORT BUTTONS -->
<div class="col-sm-12 row-bottom">
	<div class="form-group row">
  <label for="caf-post-layout-import-btn" class='col-sm-12 bold-span-title'><?php echo esc_html__('Import/Export All Settings', 'category-ajax-filter-pro'); ?><span class='info'><?php echo esc_html__('Easily export all CAF settings to json file and import.', 'category-ajax-filter-pro'); ?></span></label>
  <div class='col-md-4 manage-imp-btns'>
   <button type='button' name='caf-exp-btn' class="caf-exp-btn">Export</button>
  </div>
  <div class='col-md-8 manage-imp-btns'>
    <input type="file" name="caf-imp-file" class="caf-imp-file">
   <button type='button' name='caf-imp-btn' class='caf-imp-btn'>Import</button>
  </div>
 </div>
	</div>