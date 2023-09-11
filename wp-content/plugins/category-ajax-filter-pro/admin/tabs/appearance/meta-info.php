<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<!-- START META INFO GROUP ---->
	<div class="col-sm-12 row-bottom">
	<div class="form-group row">
    <label for="caf-meta-show" class='col-sm-12 bold-span-title'><?php echo esc_html__('Meta Info Show/Hide', 'category-ajax-filter-pro'); ?><span class='info'><?php echo esc_html__('Author, Date, Comments, Categories show/hide settings.', 'category-ajax-filter-pro'); ?></span></label>
    <div class="col-sm-3 manage-post-author caf-hid">
     <label for="caf-post-author" class='mini-label'>Author</label>
    <select class="form-control" id="caf-post-author" name="caf-post-author">
	    <option value="show" <?php if ($caf_post_author == "show") {echo "selected";}?>>Show</option>
     <option value="hide" <?php if ($caf_post_author == "hide") {echo "selected";}?>>Hide</option>
    </select>
	</div>
<div class="col-sm-3 manage-post-date caf-hid">
 <label for="caf-post-date" class='mini-label'>Date</label>
    <select class="form-control" id="caf-post-date" name="caf-post-date">
	    <option value="show" <?php if ($caf_post_date == "show") {echo "selected";}?>>Show</option>
     <option value="hide" <?php if ($caf_post_date == "hide") {echo "selected";}?>>Hide</option>
    </select>
	</div>
  <div class="col-sm-3 manage-post-comments caf-hid">
   <label for="caf-post-comments" class='mini-label'>Comments</label>
    <select class="form-control" id="caf-post-comments" name="caf-post-comments">
	    <option value="show" <?php if ($caf_post_comments == "show") {echo "selected";}?>>Show</option>
     <option value="hide" <?php if ($caf_post_comments == "hide") {echo "selected";}?>>Hide</option>
    </select>
	</div>
  <div class="col-sm-3 manage-post-cats caf-hid">
   <label for="caf-post-cats" class='mini-label'>Categories</label>
    <select class="form-control" id="caf-post-cats" name="caf-post-cats">
	    <option value="show" <?php if ($caf_post_cats == "show") {echo "selected";}?>>Show</option>
     <option value="hide" <?php if ($caf_post_cats == "hide") {echo "selected";}?>>Hide</option>
    </select>
	</div>
	</div>
  	<div class="form-group row">
      <div class="col-sm-3 manage-post-title">
   <label for="caf-post-title" class='mini-label'>Post Title</label>
    <select class="form-control" id="caf-post-title" name="caf-post-title">
	    <option value="show" <?php if ($caf_post_title == "show") {echo "selected";}?>>Show</option>
     <option value="hide" <?php if ($caf_post_title == "hide") {echo "selected";}?>>Hide</option>
    </select>
	</div>
    <div class="col-sm-3 manage-post-image">
   <label for="caf-post-image" class='mini-label'>Post Image</label>
    <select class="form-control" id="caf-post-image" name="caf-post-image">
	    <option value="show" <?php if ($caf_post_image == "show") {echo "selected";}?>>Show</option>
     <option value="hide" <?php if ($caf_post_image == "hide") {echo "selected";}?>>Hide</option>
    </select>
	</div>

  <div class="col-sm-3 manage-post-rd caf-hid">
   <label for="caf-post-rd" class='mini-label'>Read More Button</label>
    <select class="form-control" id="caf-post-rd" name="caf-post-rd">
	    <option value="show" <?php if ($caf_post_rd == "show") {echo "selected";}?>>Show</option>
     <option value="hide" <?php if ($caf_post_rd == "hide") {echo "selected";}?>>Hide</option>
    </select>
	</div>

    <div class="col-sm-3 manage-post-dsc caf-hid">
   <label for="caf-post-dsc" class='mini-label'>Post Excerpt</label>
    <select class="form-control" id="caf-post-dsc" name="caf-post-dsc">
	    <option value="show" <?php if ($caf_post_dsc == "show") {echo "selected";}?>>Show</option>
     <option value="hide" <?php if ($caf_post_dsc == "hide") {echo "selected";}?>>Hide</option>
    </select>
	</div>




  </div>
	</div>
 <!---- END META INFO GROUP ---->
<div class="col-sm-12 row-bottom">
	<div class="form-group row">
    <label for="caf-post-date-format" class='col-sm-12 bold-span-title'><?php echo esc_html__('Meta Date Format', 'category-ajax-filter-pro'); ?><span class='info'><?php echo esc_html__('Select Date Format You Want To
	Display On your blog', 'category-ajax-filter-pro'); ?></span></label>
	<div class="col-sm-12">
    <select class="form-control" id="caf-post-date-format" name="caf-post-date-format">
	 <option value="d, M Y" <?php if ($caf_post_date_format == "d, M Y") {echo "selected";}?>><?php echo date("d, M Y"); ?></option>
     <option value="n/j/Y" <?php if ($caf_post_date_format == "n/j/Y") {echo "selected";}?>><?php echo date("n/j/Y"); ?></option>
	 <option value="F j, Y" <?php if ($caf_post_date_format == "F j, Y") {echo "selected";}?>><?php echo date("F j, Y"); ?></option>
    </select>
	</div>
	</div></div>