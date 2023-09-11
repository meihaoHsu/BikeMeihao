<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<!-- Start Taxonomy Relation -->
<div class="col-sm-12 row-bottom">
	<!---- FORM GROUP ---->
	<div class="form-group row">
    <label for="caf-taxo-relation" class="col-sm-12 col-form-label"><?php echo esc_html__("Taxonomy Relation", 'category-ajax-filter-pro'); ?><span class="info"><?php echo esc_html__("Select Taxonomy Relation", 'category-ajax-filter-pro'); ?></span></label>
    <div class="col-sm-12">
    <select class="form-control tc_caf_object_field tc_caf_select" data-field-type="select" id="caf-taxo-relation" name="caf-taxo-relation">
     <option value="OR" <?php if ($caf_taxo_relation == "OR") {echo "selected";}?>>OR</option>
     <option value="AND" <?php if ($caf_taxo_relation == "AND") {echo "selected";}?>>AND</option>
     </select>
	</div>
	</div>
    <!---- FORM GROUP ---->
 </div>
<!-- End Taxonomy Relation -->
<!-- Start CATS Relation -->
<div class="col-sm-12 row-bottom">
	<!---- FORM GROUP ---->
	<div class="form-group row">
    <label for="caf-cats-relation" class="col-sm-12 col-form-label"><?php echo esc_html__("Category Relation", 'category-ajax-filter-pro'); ?><span class="info"><?php echo esc_html__("Select Category Relation", 'category-ajax-filter-pro'); ?></span></label>
    <div class="col-sm-12">
    <select class="form-control tc_caf_object_field tc_caf_select" data-field-type="select" id="caf-cats-relation" name="caf-cats-relation">
     <option value="IN" <?php if ($caf_cats_relation == "IN") {echo "selected";}?>>OR</option>
     <option value="AND" <?php if ($caf_cats_relation == "AND") {echo "selected";}?>>AND</option>
     </select>
	</div>
	</div>
    <!---- FORM GROUP ---->
 </div>
<!-- End CATS Relation -->
<!-- Start All Disable/Enable -->
<div class="col-sm-12 row-bottom">
	<!---- FORM GROUP ---->
	<div class="form-group row">
    <label for="caf-all-ed" class="col-sm-12 col-form-label"><?php echo esc_html__("Display 'All' button in filter", 'category-ajax-filter-pro'); ?><span class="info"><?php echo esc_html__("Enable/Disable filter's 'All' button.", 'category-ajax-filter-pro'); ?> </span></label>
    <div class="col-sm-12">
    <select class="form-control tc_caf_object_field tc_caf_select" data-field-type="select" id="caf-all-ed" name="caf-all-ed">
     <option class="enable" value="enable" <?php if ($caf_all_ed == "enable") {echo "selected";}?>>Enable</option>
     <option class="disable" value="disable" <?php if ($caf_all_ed == "disable") {echo "selected";}?>>Disable</option>
     </select>
	</div>
	</div>
    <!---- FORM GROUP ---->
 </div>
<!-- End All Disable/Enable -->
<!-- Start Dynamic Disable/Enable terms -->
<div class="col-sm-12 row-bottom">
	<!---- FORM GROUP ---->
	<div class="form-group row">
    <label for="caf-term-dy" class="col-sm-12 col-form-label"><?php echo esc_html__("Auto Select Default Term", 'category-ajax-filter-pro'); ?> <span class="info"> <?php echo esc_html__("If shortcode is placed on the category page then it will auto select that specific term as default on page load.", 'category-ajax-filter-pro'); ?> </span></label>
    <div class="col-sm-12">
    <select class="form-control tc_caf_object_field tc_caf_select" data-field-type="select" id="caf-term-dy" name="caf-term-dy">
     <option class="enable" value="enable" <?php if ($caf_term_dy == "enable") {echo "selected";}?>>Enable</option>
     <option class="disable" value="disable" <?php if ($caf_term_dy == "disable") {echo "selected";}?>>Disable</option>
     </select>
	</div>
	</div>
    <!---- FORM GROUP ---->
 </div>
<!-- End of Dynamic Disable/Enable terms -->
<div class="col-sm-12 row-bottom">
	<!---- FORM GROUP ---->
	<div class="form-group row">
    <label for="caf-default-term" class="col-sm-12 col-form-label"><?php echo esc_html__("Default Term", 'category-ajax-filter-pro'); ?><span class="info"><?php echo esc_html__("Select your default term while posts load on frontend. Default: All", 'category-ajax-filter-pro'); ?></span></label>
    <div class="col-sm-12">
		<?php /// var_dump($terms); ?>
    <select class="form-control tc_caf_object_field tc_caf_select" data-field-type="select" id="caf-default-term" name="caf-default-term">
 <?php if ($caf_all_ed == "enable") {?>
	<option class="remove_it" value="all">All</option>
	<?php }
if ($terms && is_array($terms)) {
    foreach ($terms as $term) {
        //if(isset($term->taxonomy)) {
        $sl = '';
        if ($caf_default_term == $term->taxonomy . "___" . $term->term_id) {$sl = "selected";}
        echo "<option data-id='" . $term->taxonomy . "' value='" . $term->taxonomy . "___" . $term->term_id . "' $sl>" . esc_html($term->name) . "</option>";
    }}
//}
else {
    echo "<option data-id='" . $terms->taxonomy . "' value='" . $terms->taxonomy . "___" . $terms->term_id . "'>" . esc_html($terms->name) . "</option>";
}
?>
</select>
	</div>
	</div>
    <!---- FORM GROUP ---->
 </div>