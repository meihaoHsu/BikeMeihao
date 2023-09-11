<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
if ($caf_post_author == "show" || $caf_post_date == "show" || $caf_post_comments == "show")  {
    echo "<div class='caf-meta-content'>";
}