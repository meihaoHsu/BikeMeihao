<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ($caf_post_dsc == "show") {
    echo "<div class='caf-content'>" . wp_kses_post($caf_content) . "</div>";
}