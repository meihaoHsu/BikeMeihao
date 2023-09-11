<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<div class="tab-panel sorting">
	<div class="tab-header" data-content="sorting"><i class="fa fa-life-ring left" aria-hidden="true"></i> <?php echo esc_html__('Sorting', 'category-ajax-filter-pro'); ?><i class="fa fa-angle-down" aria-hidden="true"></i></div>
	<div class="tab-content sorting">
<!-- START POST ORDERS BY ROW GROUP -->
	<div class="col-sm-12 row-bottom">
	<div class="form-group row">
    <label for="caf-post-orders-by" class='col-sm-12 bold-span-title'><?php echo esc_html__('Posts Order By', 'category-ajax-filter-pro'); ?><span class='info'><?php echo esc_html__('Set posts order by setting.', 'category-ajax-filter-pro'); ?></span></label>
    <div class="col-sm-12">
    <select class="form-control caf_orders_by" data-import="caf_post_orders_by" id="caf-post-orders-by" name="caf-post-orders-by">
    <option value="author" <?php if ($caf_post_orders_by == 'author') {echo "selected";}?>>Author</option>
	<option value="title" <?php if ($caf_post_orders_by == 'title') {echo "selected";}?>>Title</option>
     	<option value="ID" <?php if ($caf_post_orders_by == 'ID') {echo "selected";}?>>Post ID</option>
	<option value="date" <?php if ($caf_post_orders_by == 'date') {echo "selected";}?>>Date</option>
     <option value="rand" <?php if ($caf_post_orders_by == 'rand') {echo "selected";}?>>Random</option>
    </select>
	</div>
  </div>
  </div>
  <!-- END POST ORDERS BY ROW GROUP -->
 <?php do_action("tc_caf_after_caf_orders_by_row");?>
  <!-- START POST ORDERS BY ROW GROUP -->
	<div class="col-sm-12 row-bottom">
	<div class="form-group row">
    <label for="caf-posts-order-type" class='col-sm-12 bold-span-title'><?php echo esc_html__('Posts Order Type', 'category-ajax-filter-pro'); ?><span class='info'><?php echo esc_html__('Set posts order Type.', 'category-ajax-filter-pro'); ?></span></label>
    <div class="col-sm-12">
    <select class="form-control caf_import" data-import="caf_posts_orders_type" id="caf-posts-order-type" name="caf-posts-order-type">
    <option value="asc" <?php if ($caf_post_order_type == 'asc') {echo "selected";}?>>Asc</option>
     <option value="desc" <?php if ($caf_post_order_type == 'desc') {echo "selected";}?>>Desc</option>
    </select>
	</div>
	</div>
   <?php do_action("tc_caf_after_caf_post_animation");?>
  </div>
  <!-- END POST ORDERS BY ROW GROUP -->
 <?php do_action("tc_caf_after_caf_orders_by_row");?>
	</div>
	</div>
<?php do_action("tc_caf_after_caf_sorting_tab");?>