<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<div class="tab-panel translation">
	<div class="tab-header" data-content="translation"><i class="fa fa-life-ring left" aria-hidden="true"></i> <?php echo esc_html__('Translation', 'category-ajax-filter-pro'); ?><i class="fa fa-angle-down" aria-hidden="true"></i></div>
	<div class="tab-content translation">
<!-- START ALL TEXT TRANSLATION ROW GROUP -->
	<div class="col-sm-12 row-bottom">
<div class="form-group row">
    <label for="default-all-text" class='col-sm-12 bold-span-title'><?php echo esc_html__('Default All Text', 'category-ajax-filter-pro'); ?><span class='info'><?php echo esc_html__('All text is default in filter layouts.', 'category-ajax-filter-pro'); ?></span></label>
    <div class="col-sm-8">
    <input type='text' class="form-control caf_import" data-import="default_all_text" id="default-all-text" name="default-all-text" value='<?php echo esc_html($default_all_text); ?>'>
	</div>
	</div>
  </div>
<!-- END ALL TEXT TRANSLATION ROW GROUP -->
  <!-- START WANT TO ROW GROUP -->
	<div class="col-sm-12 row-bottom">
<div class="form-group row">
    <label for="caf-want-to-check" class='col-sm-12 bold-span-title'><?php echo esc_html__('Dropdown Filter - I want to Check out', 'category-ajax-filter-pro'); ?><span class='info'><?php echo esc_html__('Change text of Dropdown Filter.', 'category-ajax-filter-pro'); ?></span></label>
    <div class="col-sm-8">
    <input type='text' class="form-control caf_import" data-import="caf_want_to_check" id="caf-want-to-check" name="caf-want-to-check" value='<?php echo esc_html($caf_want_to_check); ?>'>
	</div>
	</div>
  </div>
<!-- END CHECK EVERYTHING TRANSLATION ROW GROUP -->
 <!-- START CHECK EVERYTHING ROW GROUP -->
	<div class="col-sm-12 row-bottom">
<div class="form-group row">
    <label for="caf-check-everything" class='col-sm-12 bold-span-title'><?php echo esc_html__('Dropdown Filter - everything', 'category-ajax-filter-pro'); ?><span class='info'><?php echo esc_html__('Change text of Dropdown Filter.', 'category-ajax-filter-pro'); ?></span></label>
    <div class="col-sm-8">
    <input type='text' class="form-control caf_import" data-import="caf_check_everything" id="caf-check-everything" name="caf-check-everything" value='<?php echo esc_html($caf_check_everything); ?>'>
	</div>
	</div>
  </div>
<!-- END CHECK EVERYTHING TRANSLATION ROW GROUP -->
 <!-- START READ MORE ROW GROUP -->
	<div class="col-sm-12 row-bottom">
<div class="form-group row">
    <label for="caf-read-more-text" class='col-sm-12 bold-span-title'><?php echo esc_html__('Post Layout - Read More', 'category-ajax-filter-pro'); ?><span class='info'><?php echo esc_html__('Change text of Read More Button.', 'category-ajax-filter-pro'); ?></span></label>
    <div class="col-sm-8">
    <input type='text' class="form-control caf_import" data-import="caf_read_more_text" id="caf-read-more-text" name="caf-read-more-text" value='<?php echo esc_html($caf_read_more_text); ?>'>
	</div>
	</div>
  </div>
<!-- END READ MORE TRANSLATION ROW GROUP -->
<!-- START SEARCH FILTER TRANSLATION ROW GROUP -->
		<div class="col-sm-12 row-bottom">
		<div class="form-group row">
		<label for="caf-f-P-text" class='col-sm-12 bold-span-title'><?php echo esc_html__('Search placeholder - Input Field', 'category-ajax-filter-pro'); ?><span class='info'><?php echo esc_html__('Change placeholder text of Search input field.', 'category-ajax-filter-pro'); ?></span></label>
			 <div class="col-sm-8">
    <input type='text' class="form-control caf_import" data-import="caf_f_p_text" id="caf-f-P-text" name="caf-f-p-text" value='<?php echo esc_html($caf_f_p_text); ?>'>
	</div>
			</div>
		</div>
<!-- END SEARCH FILTER TRANSLATION ROW GROUP -->
		<!-- START SEARCH FILTER TRANSLATION ROW GROUP -->
		<div class="col-sm-12 row-bottom">
		<div class="form-group row">
		<label for="search-submit-button" class='col-sm-12 bold-span-title'><?php echo esc_html__('Search Submit Button', 'category-ajax-filter-pro'); ?><span class='info'><?php echo esc_html__('Change Search Submit button value', 'category-ajax-filter-pro'); ?></span></label>
			 <div class="col-sm-8">
    <input type='text' class="form-control caf_import" data-import="search_submit_button" id="search-submit-button" name="search-submit-button" value='<?php echo esc_html($caf_search_button); ?>'>
	</div>
			</div>
		</div>
<!-- END SEARCH FILTER TRANSLATION ROW GROUP -->
 </div>
	</div>