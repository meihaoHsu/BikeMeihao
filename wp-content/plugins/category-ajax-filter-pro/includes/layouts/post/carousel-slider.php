<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
/**
 * Carousel Slider Layout => Carousel Slider
 *
 * This template can be overridden by copying it to
yourtheme/category-ajax-filter/layouts/post/carousel-slider.php
 *
 * HOWEVER, on occasion CAF will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://caf.trustyplugins.com/documentation
 */
include TC_CAF_PATH . 'includes/query-variables.php';
?>
<div class="flexslider carousel">
  <ul class="slides">
<?php
$i = 0;
if ($qry->have_posts()): while ($qry->have_posts()): $qry->the_post();
        $i++;
        global $post;
        include TC_CAF_PATH . 'includes/post-variables.php';
        // class='caf-featured-img-box'
        if (isset($image[0])) {
            $img = "<a href='" . esc_url($link) . "' target='" . esc_attr($caf_link_target) . "'><div class='caf-featured-img-box' style='background:url(" . esc_url($image[0]) . ")'></div></a>";
            $image = $image[0];
        } else {
            $image = TC_CAF_URL . 'assets/img/unnamed.jpg';
            $img = "<a href='" . esc_url($link) . "' target='" . esc_attr($caf_link_target) . "'><div class='caf-featured-img-box' style='background:url(" . esc_url($image) . ")'></div></a>";
        }
        ?>
		   <li class="<?php echo esc_attr($caf_special_post_class); ?> <?php echo esc_attr($caf_post_animation); ?>">
		    <div class="carousel-container" style='background-image:url("<?php echo $image; ?>")'>
		    <div class='image-carousel'></div>
		    <div class='manage-content-carousel'>
		    <div class="carousel-title"><h5><a href="<?php echo esc_attr($link); ?>" target='".esc_attr($caf_link_target)."'><?php echo esc_attr($title); ?></a></h5></div>
		     <?php
        if ($caf_post_dsc == "show") {
            ?>
		    <div class="carousel-desc"><?php echo wp_kses_post($caf_content); ?></div>
		     <?php
        }
        ?>
		     </div>

		    </div>
		    </li>
		<?php
    endwhile;

    ?>
	<script>
	 jQuery(function($) {
	  var w_width=$(window).width();
	  var div="#caf-post-layout-container"+"<?php echo $target_div; ?>";
	  var wid=$(div).width();
	  if(w_width>1000) {
	   var wid=parseInt(wid/<?php echo $caf_desktop_col_val; ?>);
	  }
	  else if(w_width>500 && w_width<768) {
	   var wid=parseInt(wid/<?php echo $caf_tablet_col_val; ?>);
	  }
	  else {
	   var wid=parseInt(wid/<?php echo $caf_mobile_col_val; ?>);
	  }
	  $('.flexslider').flexslider({
	     animation: "slide",
	    animationLoop: true,
	    itemWidth: wid,
	    itemMargin: 0,
	  });
	});
	</script>
	<?php
    echo "</ul></div>";

    $response = [
        'status' => 200,
        'found' => $qry->found_posts,
        'message' => 'ok',
    ];
    wp_reset_postdata();
else:
    echo "<div class='error-of-empty-result error-caf'>" . esc_html($caf_empty_res) . "</div>";
//$empty_res.='<div class="empty-response">No Posts Found.</div>';
    //echo $empty_res;
    $response = [
        'status' => 201,
        'message' => 'No posts found',
        'content' => '',
    ];
endif;
$title_line_height = $caf_post_title_font_size + 10;
$desc_line_height = $caf_post_desc_font_size + 5;
?>

