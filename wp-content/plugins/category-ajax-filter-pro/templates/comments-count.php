<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
if ($caf_post_comments == "show") {
if($caf_post_layout=="post-layout11") {
    echo "<span class='comment caf-pl-0'><i class='fa fa-comment' aria-hidden='true'></i> " . get_comments_number() . "</span>";
}
else {
    echo "<span class='comment caf-col-md-3 caf-pl-0'><i class='fa fa-comment' aria-hidden='true'></i> " . get_comments_number() . "</span>";
}
}
