<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
if ($filter_id) {
    $id = $filter_id;
}
$caf_post_desc_font = 'inherit';
$caf_post_desc_transform = 'capitalize';
$caf_post_desc_font_size = '12';
if (get_post_meta($id, 'caf_post_desc_font')) {
    $caf_post_desc_font = get_post_meta($id, 'caf_post_desc_font', true);
}
if (get_post_meta($id, 'caf_post_desc_transform')) {
    $caf_post_desc_transform = get_post_meta($id, 'caf_post_desc_transform', true);
}
if (get_post_meta($id, 'caf_post_desc_font_size')) {
    $caf_post_desc_font_size = get_post_meta($id, 'caf_post_desc_font_size', true);
}
