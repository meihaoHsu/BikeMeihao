<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
if($caf_post_layout=="post-layout9") {
?>
<article id="caf-post-layout9" class="caf-post-layout9 " data-post-id="<?php echo esc_attr(get_the_id()); ?>">
<?php
}

else if($caf_post_layout=="post-layout11") {
    ?>
<div id="caf-post-layout11" class="caf-post-layout11 " data-post-id="<?php echo esc_attr(get_the_id()); ?>">
    <?php
}
else {
    ?>
    <article id="caf-<?php echo $caf_post_layout; ?>" class="caf-<?php echo $caf_post_layout; ?> caf-col-md-<?php echo esc_attr($caf_desktop_col); ?> caf-col-md-tablet<?php echo esc_attr($caf_tablet_col); ?> caf-col-md-mobile<?php echo esc_attr($caf_mobile_col); ?> <?php echo esc_attr($caf_mb); ?> <?php echo esc_attr($caf_special_post_class); ?> <?php echo esc_attr($caf_post_animation); ?> <?php echo esc_attr($cats_class); ?>" data-post-id="<?php echo esc_attr(get_the_id()); ?>">
    <?php
}