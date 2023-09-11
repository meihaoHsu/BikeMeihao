<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
if ($caf_post_cats == "show") {
    echo "<div class='caf-meta-content-cats'>";
    echo "<ul class='caf-mb-0'>";
    if (is_array($cats)) {
        foreach ($cats as $index => $cat) {
            if ($cat) {
                    foreach ($cat as $ct) {
                        if ($ct) {
                            $clink = get_category_link($ct->term_id);
                            echo "<li><a href='" . esc_url($clink) . "' target='_blank'>" . esc_html($ct->name) . "</a></li>";
                        }
                    }
                }
            
        }
    }
    echo "</ul>";
    echo "</div>";
}