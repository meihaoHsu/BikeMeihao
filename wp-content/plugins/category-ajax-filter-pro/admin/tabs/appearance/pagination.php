<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<!-- START PREVIOUS TEXT GROUP ---->
<div class="col-sm-12 prev-text row-bottom">
	<div class="form-group row">
    <label for="caf-prev-text" class="col-sm-12 bold-span-title"> Previous Button Text <span class="info">Prev Button will show in pagination.</span></label>
    <div class="col-sm-12">
    <input type="text" class="form-control caf_import" data-import="caf_prev_text" id="caf-prev-text" name="caf-prev-text" value="<?php echo esc_html($caf_prev_text); ?>">
	</div>
	</div>
	</div>
<!-- END PREVIOUS TEXT GROUP ---->
<!-- START NEXT TEXT GROUP ---->
<div class="col-sm-12 next-text row-bottom">
	<div class="form-group row">
    <label for="caf-next-text" class="col-sm-12 bold-span-title"> Next Button Text <span class="info">Next Button will show in pagination.</span></label>
    <div class="col-sm-12">
    <input type="text" class="form-control caf_import" data-import="caf_next_text" id="caf-next-text" name="caf-next-text" value="<?php echo esc_html($caf_next_text); ?>">
	</div>
	</div>
	</div>
<!-- END NEXT TEXT GROUP ---->
<!-- START LOAD MORE TEXT GROUP ---->
<div class="col-sm-12 caf-load-more-text row-bottom">
	<div class="form-group row">
    <label for="caf-load-more-text" class="col-sm-12 bold-span-title"> Load More Button Text <span class="info">Load More Button will show in pagination.</span></label>
    <div class="col-sm-12">
    <input type="text" class="form-control caf_import" data-import="caf_load_more_text" id="caf-load-more-text" name="caf-load-more-text" value="<?php echo esc_html($caf_load_more_text); ?>">
	</div>
	</div>
	</div>
<!-- END LOAD MORE TEXT GROUP ---->