<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
if ($caf_post_title == "show") {
    echo "<div class='caf-post-title'><h2><a href='" . get_the_permalink() . "' target='" . esc_attr($caf_link_target) . "'>" . esc_html($title) . "</a></h2></div>";
    }