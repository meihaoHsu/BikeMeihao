<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
$fonts = apply_filters('tc_caf_font_family', 'tc_caf_font_family');
?>
<div class="form-group row-bottom">
    <label for="caf-post-desc-font" class="col-sm-12 col-form-label"><?php echo esc_html__('Post Description Font ', 'category-ajax-filter-pro'); ?><br/><span><?php echo esc_html__('Select Properties for post description.', 'category-ajax-filter-pro'); ?></span></label>
	<!-- START SIDEBAR OF BAR AREA POST TITLE-->
	<div class="col-sm-12">
	<!-- START FIRST ROW OF POST TITLE SIDEBAR -->
	<div class="row">
	<!-- START FONT FAMILY GROUP POST TITLE -->
    <div class="col-sm-4">
	<span class='label-title'><?php echo esc_html__('Font Family', 'category-ajax-filter-pro'); ?></span>
    <select  class="form-control caf_import" data-import="caf_post_desc_fonts" id="caf-post-desc-font" name="caf-post-desc-font">
	<option value="inherit" <?php if ($caf_post_desc_font == 'inherit') {echo "selected";}?>><?php echo esc_html__('Default', 'category-ajax-filter-pro'); ?></option>
	<?php
foreach ($fonts as $key => $font) {
    if ($caf_post_desc_font == $key) {$font_sel = "selected";} else { $font_sel = '';}
    ?>
         <option <?php echo esc_attr($font_sel); ?> value="<?php echo esc_attr($key); ?>" data-val="<?php echo esc_attr($font['character_set']); ?>" datat-type="<?php echo esc_attr($font['type']); ?>"><?php echo esc_html($key); ?></option>
         <?php
}
?>
    </select>
	</div>
	<!-- END FONT FAMILY GROUP POST TITLE -->
	<!-- START TEXT TRANSFORM GROUP POST TITLE-->
	<div class="col-sm-4">
	<span class='label-title'><?php echo esc_html__('Text Transform', 'category-ajax-filter-pro'); ?></span>
    <select  class="form-control caf_import" data-import="caf_post_desc_transform" id="caf-post-desc-transform" name="caf-post-desc-transform">
     <option value="inherit" <?php if ($caf_post_desc_transform == 'inherit') {echo "selected";}?>><?php echo esc_html__('Inherit', 'category-ajax-filter-pro'); ?></option>
	<option value="uppercase" <?php if ($caf_post_desc_transform == 'uppercase') {echo "selected";}?>><?php echo esc_html__('Uppercase', 'category-ajax-filter-pro'); ?></option>
	<option value="capitalize" <?php if ($caf_post_desc_transform == 'capitalize') {echo "selected";}?>><?php echo esc_html__('Capitalize', 'category-ajax-filter-pro'); ?></option>
	<option value="lowercase" <?php if ($caf_post_desc_transform == 'lowercase') {echo "selected";}?>><?php echo esc_html__('Lowercase', 'category-ajax-filter-pro'); ?></option>
    </select>
	</div>
	<!-- END TEXT TRANSFORM GROUP POST TITLE-->
		<!-- START FONT SIZE GROUP POST TITLE-->
    <div class="col-sm-4">
	<span class='label-title'><?php echo esc_html__('Font Size', 'category-ajax-filter-pro'); ?></span>
    <div class="input-group">
    <input type="number" class="form-control caf_import" data-import="caf_post_desc_font_size" placeholder="12" aria-label="font-size" aria-describedby="basic-addon2" name="caf-post-desc-font-size" value="<?php echo esc_html($caf_post_desc_font_size); ?>">
    <div class="input-group-append">
    <span class="input-group-text" id="basic-addon2"><?php echo esc_html__('px', 'category-ajax-filter-pro'); ?></span>
    </div>
    </div>
	</div>
	<!---- END FONT SIZE GROUP POST TITLE ---->
	</div>
	<!-- END FIRST ROW OF POST TITLE SIDEBAR -->
	</div>
	<!---- END SIDEBAR OF BAR AREA POST TITLE ---->
	</div>