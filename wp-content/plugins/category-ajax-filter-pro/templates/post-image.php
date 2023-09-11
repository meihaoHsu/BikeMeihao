<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
if($caf_post_image=="show") {
if($caf_post_layout=="post-layout6") {
    echo "<div class='caf-featured-section'>";
    if (isset($image[0])) {
        echo "<a href='" . esc_url($link) . "' target='" . esc_attr($caf_link_target) . "' class='" . $a_class . "'><div class='caf-featured-img-box " . $img_box . "' style='background:url(" . esc_url($image[0]) . "
                )'></div></a>";
    } else {
        $image = TC_CAF_URL . 'assets/img/unnamed.jpg';
        echo "<a href='" . esc_url($link) . "' target='" . esc_attr($caf_link_target) . "' class='" . $a_class . "'><div class='caf-featured-img-box " . $img_box . "' style='background:url(" . esc_url($image) . "
                )'></div>
                </a>";
    }
        $caf_post_date_format = apply_filters('tc_caf_post_date_format_timeline', $caf_post_date_format, $id);
        $caf_post_date_format_year = apply_filters('tc_caf_post_date_format_timeline_year', $caf_post_date_format, $id);
        echo "<div class='p-date'><span class='caf-pl-d'>" . get_the_date($caf_post_date_format) . "</span>";
        echo "<span class='caf-pl-d caf-pl-t'>" . get_the_date($caf_post_date_format_year) . "</span></div>";
    echo "</div>";
}
else if($caf_post_layout=="post-layout7") {
    echo "<div class='caf-featured-section'>";
    if (isset($image[0])) {
        echo "<a href='" . esc_url($link) . "' target='" . esc_attr($caf_link_target) . "' class='" . $a_class . "'><div class='caf-featured-img-box " . $img_box . "' style='background:url(" . esc_url($image[0]) . "
                )'></div></a>";
    } else {
        $image = TC_CAF_URL . 'assets/img/unnamed.jpg';
        echo "<a href='" . esc_url($link) . "' target='" . esc_attr($caf_link_target) . "' class='" . $a_class . "'><div class='caf-featured-img-box " . $img_box . "' style='background:url(" . esc_url($image) . "
                )'></div>
                </a>";
    }
        $caf_post_date_format = apply_filters('tc_caf_post_date_format_timeline', $caf_post_date_format, $id);
        $caf_post_date_format_year = apply_filters('tc_caf_post_date_format_timeline_year', $caf_post_date_format, $id);
        echo "<span class='caf-pl-d'>" . get_the_date($caf_post_date_format) . "</span>";
        echo "<span class='caf-pl-d caf-pl-t'>" . get_the_date($caf_post_date_format_year) . "</span>";
    echo "</div>";
}
else if($caf_post_layout=="post-layout9" || $caf_post_layout=="post-layout11") {
    if (isset($image[0])) {
        echo "<a href='" . esc_url($link) . "' target='" . esc_attr($caf_link_target) . "' class='caf-f-link'><img src='" . $image[0] . "' alt='" . $image_alt . "'></a>";
    } else {
        $image = TC_CAF_URL . 'assets/img/unnamed.jpg';
        echo "<a href='" . esc_url($link) . "' target='" . esc_attr($caf_link_target) . "'><img src='" . esc_url($image) . "' alt='caf-default-image'></a>";
    }
}
else if($caf_post_layout=="post-layout10") {
    if (isset($image[0])) {
        echo "<div class='caf-featured-img-box' style='background:url(" . esc_url($image[0]) . ")'>
        
        <div class='caf-layout-9-back-color '>";
        
        if ($caf_post_title == "show") {    
        echo "<div class='vertically-center-title-layout-9 caf-post-title'><h2><a href='" . esc_url($link) . "' target='" . esc_attr($caf_link_target) . "'>" . esc_attr($title) . "</a></h2>";
    }
    // if ($caf_post_author == "show" || $caf_post_date == "show" || $caf_post_comments == "show")  {
    //     echo "<div class='caf-meta-content'>";
    // }
    // if ($caf_post_author == "show") {
    //     echo "<b><span class='author caf-pl-0'>By " . get_the_author() . " - </span></b>";
    //     }
    //     if ($caf_post_date == "show") {
    //         $caf_post_date_format = apply_filters('tc_caf_post_date_format', $caf_post_date_format, $id);
    //         echo "<p>" . get_the_date($caf_post_date_format) . "</p>";
    //     }
    //     if ($caf_post_comments == "show") {
    //         echo "<span class='comment caf-col-md-3 caf-pl-0'><i class='fa fa-comment' aria-hidden='true'></i> " . get_comments_number() . "</span>";
    //     }
    //     if ($caf_post_author == "show" || $caf_post_date == "show" || $caf_post_comments == "show")  {
    //         echo "</div>";
    //     }
        if ($caf_post_cats == "show") {
            echo "<div class='caf-meta-content-cats'>";
            echo "<ul class='caf-mb-0'>";
            $cats = $this->caf_get_cats($tax);
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
        if ($caf_post_dsc == "show") {
            echo "<div class='caf-content'>" . wp_kses_post($caf_content) . "</div>";
        }
        if ($caf_post_rd == "show") {
            $rd_more = esc_html('Read More');
            if ($caf_post_layout == 'post-layout7') {
                echo "<div class='caf-content-read-more'><a class='caf-read-more' href='" . esc_url($link) . "' target='" . esc_attr($caf_link_target) . "'><i class='fa fa-file-text-o'></i>" . apply_filters('tc_caf_post_layout_read_more', $rd_more, $id) . "</a></div>";
            } else {
                echo "<div class='caf-content-read-more'><a class='caf-read-more' href='" . esc_url($link) . "' target='" . esc_attr($caf_link_target) . "'>" . apply_filters('tc_caf_post_layout_read_more', $rd_more, $id) . "</a></div>";
            }
        }


        echo "</div></div></div>";
    } else {
        $image = TC_CAF_URL . 'assets/img/unnamed.jpg';
        echo "<div class='caf-featured-img-box' style='background:url(" . esc_url($image) . ")'><div class='caf-layout-9-back-color '><div class='vertically-center-title-layout-9 caf-post-title'><a href='" . esc_url($link) . "' target='" . esc_attr($caf_link_target) . "'><h2>" . esc_attr($title) . "</h2></a></div></div>
    </div>";
    }
}




else {
if (isset($image[0])) {
            echo "<a href='" . esc_url($link) . "' target='" . esc_attr($caf_link_target) . "' class='" . $a_class . "'><div class='caf-featured-img-box " . $img_box . "' style='background:url(" . esc_url($image[0]) . "
                    )'></div></a>";
        } else {
            $image = TC_CAF_URL . 'assets/img/unnamed.jpg';
            echo "<a href='" . esc_url($link) . "' target='" . esc_attr($caf_link_target) . "' class='" . $a_class . "'><div class='caf-featured-img-box " . $img_box . "' style='background:url(" . esc_url($image) . "
                    )'></div>
                    </a>";
        }
    }
}