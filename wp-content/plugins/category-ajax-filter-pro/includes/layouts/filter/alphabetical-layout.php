<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
/**
 * Alphabetical-Layout =>Alphabetical Navigation
 *
 * This template can be overridden by copying it to
yourtheme/category-ajax-filter/layouts/filter/alphabetical-Layout.php
 *
 * HOWEVER, on occasion CAF will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://caf.trustyplugins.com/documentation
 */
$all_text = "All";
$all_text = apply_filters('tc_caf_filter_all_text', $all_text, $id);
$alp_text = "0-9";
$alp_text = apply_filters('tc_caf_filter_alpha_numeric', $alp_text, $id);
$def_alp = 'all';
$def_alp = apply_filters('tc_caf_filter_default_alpha', $def_alp, $id);
if ($def_alp == 'all') {
    $cl = 'active';
} else {
    $cl = '';
}
?>
<div id="caf-alphabetical-layout" class='caf-alpha-layout caf-filter-layout data-target-div<?php echo esc_attr($b) . " " . esc_attr($flsr); ?>'>
 <ul class="caf-alpha-list-items">
	 <?php if ($caf_all_ed == 'enable') {?>
  <li class="caf-alpha-list-item all <?php echo esc_attr($cl); ?>" data-main-id="flt" data-id="all" data-target-div="data-target-div<?php echo esc_attr($b); ?>"><?php echo esc_html($all_text); ?></li>
  <li class="caf-alpha-list-item alp" data-main-id="flt" data-id="0-9" data-target-div="data-target-div<?php echo esc_attr($b); ?>"><?php echo esc_html($alp_text); ?></li>
<?php }
foreach (range('a', 'z') as $elements) {
    if ($def_alp == $elements) {$cl = 'active';} else { $cl = '';}
    echo '<li class="caf-alpha-list-item ' . esc_attr($cl) . '" data-main-id="flt" data-id="' . esc_attr($elements) . '" data-target-div="data-target-div' . esc_attr($b) . '">' . esc_attr($elements) . '</li>';
}
?>
  </ul>
</div>
<?php
do_action("caf_after_filter_layout", $id, $b);
?>