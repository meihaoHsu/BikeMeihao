<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if($caf_post_layout=="post-layout6" || $caf_post_layout=="post-layout7") {
    echo "<div id='manage-post-area'>";
    ?>
    <svg viewBox="0 0 50 100" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
					<path id="dec-post-arrow" stroke-width="1px" d="M 50,0 Q 45,45 0,50 Q 45,55 50,100" />
				</svg>
<?php
}
else {
    echo "<div id='manage-post-area'>";
}