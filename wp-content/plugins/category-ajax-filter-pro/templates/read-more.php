<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
if ($caf_post_rd == "show") {
    $rd_more = esc_html('Read More');
    if ($caf_post_layout == 'post-layout7') {
        echo "<div class='caf-content-read-more'><a class='caf-read-more' href='" . esc_url($link) . "' target='" . esc_attr($caf_link_target) . "'><i class='fa fa-file-text-o'></i>" . apply_filters('tc_caf_post_layout_read_more', $rd_more, $id) . "</a></div>";
    } else {
        echo "<div class='caf-content-read-more'><a class='caf-read-more' href='" . esc_url($link) . "' target='" . esc_attr($caf_link_target) . "'>" . apply_filters('tc_caf_post_layout_read_more', $rd_more, $id) . "</a></div>";
    }
}

if($caf_post_layout=="post-layout5") {
    if ($i % 2 == 0) {
        $caf_post_date_format=apply_filters('tc_caf_post_date_format',$caf_post_date_format,$id); 
   echo"<div class='point even'><span class='datecaf-pl-0 even'>".get_the_date($caf_post_date_format)."</span></div>";
   ?>
   <svg viewBox="0 0 50 100" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="evensvg">
       <path id="dec-post-arrow" stroke-width="1px" d="M 50,0 Q 45,45 0,50 Q 45,55 50,100" />
   </svg>
   <?php
   }
}