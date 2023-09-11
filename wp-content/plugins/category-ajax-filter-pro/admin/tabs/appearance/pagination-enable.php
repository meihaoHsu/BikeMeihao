<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<div class="col-sm-12 row-bottom">
	<div class="form-group row">
    <label for="caf-pagination-enable" class='col-sm-12 bold-span-title'><?php echo esc_html__('Enable/Disable Pagination', 'category-ajax-filter-pro'); ?><span class='info'><?php echo esc_html__('Enable/Disable Pagination according to your needs.', 'category-ajax-filter-pro'); ?></span></label>
    <div class="col-sm-12 pagination-en">
    <input type="checkbox" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" id="caf-pagination-enable" name="pagination_status"  class="checkpagi tc_caf_object_field tc_caf_checkbox" data-field-type='checkbox' data-name="caf-pagination-status" <?php if ($caf_pagination_status == "on") {echo "checked";} else {echo "";}?>>
    <input class="tc_caf_object_field tc_caf_text caf_import" data-import='caf_pagination_status' data-field-type='text' type="hidden" name='caf-pagination-status' id='caf-pagination-status' value='<?php echo esc_attr($caf_pagination_status); ?>'>
	</div>
	</div>
	</div>