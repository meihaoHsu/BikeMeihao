<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
/**
 * Post Layout 11 => Masonry with description
 *
 * This template can be overridden by copying it to
yourtheme/category-ajax-filter/layouts/post/post-layout11.php
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
$i = 0;
do_action("caf_content_before_post_loop", $id);
if ($qry->have_posts()): while ($qry->have_posts()): $qry->the_post();
        global $post;
        $i++;
        // <article>
        do_action('caf_article_container_start', $id);

        do_action("caf_after_article_container_start", $id, $i);

        // </article>
        do_action("caf_article_container_end", $id);
    endwhile;
    do_action("caf_content_after_post_loop", $id);

/**** Pagination*****/
    if (isset($_POST["params"]["load_more"])) {
        //do something
    } else {
        $caf_pagination->caf_ajax_pager($qry, $page, $caf_post_layout, $caf_pagi_type, $filter_id);
    }

    $response = [
        'status' => 200,
        'found' => $qry->found_posts,
        'message' => 'ok',
    ];
    wp_reset_postdata();
else:

    // class='error-of-empty-result error-caf'
    do_action("caf_empty_result_error", $caf_empty_res);
    
    $response = [
        'status' => 201,
        'message' => 'No posts found',
        'content' => '',
    ];
endif;
