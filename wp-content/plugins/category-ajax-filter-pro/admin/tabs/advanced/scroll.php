<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<div class="tab-panel scroll-div">
	<div class="tab-header" data-content="scroll-div"><i class="fa fa-life-ring left" aria-hidden="true"></i> <?php echo esc_html__('Scroll to Container', 'category-ajax-filter-pro'); ?><i class="fa fa-angle-down" aria-hidden="true"></i></div>
	<div class="tab-content scroll-div">
<!-- START SCROLL TO DIV ROW GROUP -->
	<div class="col-sm-12 row-bottom">
	<div class="form-group row">
    <label for="caf-scroll-to-div" class='col-sm-12 bold-span-title'><?php echo esc_html__('Scroll To Container', 'category-ajax-filter-pro'); ?><span class='info'><?php echo esc_html__('When you click on pagination or categories, page scrolls to container div.', 'category-ajax-filter-pro'); ?></span></label>
    <div class="col-sm-12">
    <select class="form-control scroll-to-div" data-import="caf_scroll_to_div" id="caf-scroll-to-div" name="caf-scroll-to-div">
    <option value="disabled" <?php if ($caf_scroll_to_div == 'disabled') {echo "selected";}?>>Disabled</option>
	   <option value="desktop" <?php if ($caf_scroll_to_div == 'desktop') {echo "selected";}?>>Desktop</option>
    <option value="mobile" <?php if ($caf_scroll_to_div == 'mobile') {echo "selected";}?>>Mobile</option>
	   <option value="desktop&mobile" <?php if ($caf_scroll_to_div == 'desktop&mobile') {echo "selected";}?>>Desktop & Mobile</option>
    </select>
	</div>
  </div>
  </div>
  <!-- END SCROLL TO DIV ROW GROUP -->
  <!-- START SCROLL TO DESKTOP ROW GROUP -->
	<div class="col-sm-12 row-bottom">
	<div class="form-group row">
    <label for="caf-scroll-to-div-desktop" class='col-sm-12 bold-span-title'><?php echo esc_html__('Scroll Position for Desktop', 'category-ajax-filter-pro'); ?><span class='info'><?php echo esc_html__('By default page scrolls to #caf-post-layout-container. For fixed header you can add the scroll top value to fix the issue.', 'category-ajax-filter-pro'); ?></span></label>
    <div class="col-sm-12">
     <input type="text" class="form-control" id="caf-scroll-to-div-desktop" name="caf-scroll-to-div-desktop" value="<?php if ($caf_scroll_to_div_desktop) {echo esc_attr($caf_scroll_to_div_desktop);}?>">
	</div>
	</div>
  </div>
  <!-- END SCROLL TO DESKTOP ROW GROUP -->
  <!-- START SCROLL TO MOBILE ROW GROUP -->
  <div class="col-sm-12 row-bottom">
	   <div class="form-group row">
    <label for="caf-scroll-to-div-mobile" class='col-sm-12 bold-span-title'><?php echo esc_html__('Scroll Position for Mobile', 'category-ajax-filter-pro'); ?><span class='info'><?php echo esc_html__('By default page scrolls to #caf-post-layout-container. For fixed header you can add the scroll top value to fix the issue.', 'category-ajax-filter-pro'); ?></span></label>
    <div class="col-sm-12">
     <input type="text" class="form-control" id="caf-scroll-to-div-mobile" name="caf-scroll-to-div-mobile" value="<?php if ($caf_scroll_to_div_mobile) {echo esc_attr($caf_scroll_to_div_mobile);}?>">
	</div>
	</div>
  </div>
  <!-- END SCROLL TO MOBILE ROW GROUP -->
	</div>
	</div>
<div class="tab-panel css">
	<div class="tab-header" data-content="css"><i class="fa fa-code left" aria-hidden="true"></i> <?php echo esc_html__('Custom CSS', 'category-ajax-filter-pro'); ?><i class="fa fa-angle-down" aria-hidden="true"></i></div>
	<div class="tab-content css">
	<textarea class="cum-css" id="cum-css" name="cum-css" placeholder="Add your custom css here...">
		<?php echo esc_textarea($cm_settings); ?></textarea>
	</div>
</div>