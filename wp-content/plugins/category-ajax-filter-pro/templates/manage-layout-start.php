<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
if($caf_post_layout=="post-layout5") {
    echo '<div class="manage-layout5">';
    if ($i % 2 != 0) {
        $caf_post_date_format = apply_filters('tc_caf_post_date_format', $caf_post_date_format, $id);
        echo "<span class='caf-pl-d'>" . get_the_date($caf_post_date_format) . "</span>";
        echo "<div class='point odd'><span class='datecaf-pl-0 odd'>" . get_the_date($caf_post_date_format) . "</span></div>";
        ?>
    <svg viewBox="0 0 50 100" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <path id="dec-post-arrow" stroke-width="1px" d="M 50,0 Q 45,45 0,50 Q 45,55 50,100" />
    </svg>
    <?php
    }
}
else if($caf_post_layout=="post-layout6") {
    echo '<div class="manage-layout6">';
}
else if($caf_post_layout=="post-layout7") {
    echo '<div class="manage-layout7">';
}
else if($caf_post_layout=="post-layout9") {
    echo '<div class="manage-layout9">';
}
else if($caf_post_layout=="post-layout11") {
    echo '<div class="manage-layout11">';
}
else {
echo '<div class="manage-layout1">';
}
