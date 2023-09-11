<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<div class="form-group row">
    <label for="caf-taxonomy" class="col-sm-12 col-form-label"><?php echo esc_html__('Taxonomy', 'category-ajax-filter-pro'); ?><span class="info"><?php echo esc_html__('Select your taxonomy from dropdown. Taxonomies are sortable with drag & drop feature. Default: Category', 'category-ajax-filter-pro'); ?></span></label>
    <div class="col-sm-12">
   <ul class="category-lists taxn">
      <?php
//var_dump($taxo);
if (get_post_meta($post->ID, 'caf_taxonomy')) {
    $taxo1 = get_post_meta($post->ID, 'caf_taxonomy', true);
    //var_dump($taxo1);
    if (is_array($taxo1)) {
        $taxo = array_unique(array_merge($taxo1, $taxo), SORT_REGULAR);
    }
}
// if (!empty($tax) && !is_array($tax)) {
//     $tax = array($tax);
// }
foreach ($taxo as $tax1) {
    $sl = '';
    if (is_array($tax)) {if (in_array($tax1, $tax)) {$sl = "checked";} else { $sl = "";}}
    echo '<li><input name="caf-taxonomy[]" class="caf-taxonomy check" id="caf-taxonomy_' . esc_attr($tax1) . '" type="checkbox" value="' . esc_attr($tax1) . '" ' . $sl . '><label for="caf-taxonomy_' . esc_attr($tax1) . '" class="category-list-label">' . esc_attr($tax1) . '</label></li>';
}
?>
     </ul>
	</div>
	</div>