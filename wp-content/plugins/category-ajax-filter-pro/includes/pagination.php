<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
if ($caf_pagi_type == 'load-more') {
    $caf_load_more_text = 'Load More';
    //echo $filter_id;
    if (get_post_meta($filter_id, 'caf_load_more_text')) {
        $caf_load_more_text = get_post_meta($filter_id, 'caf_load_more_text', true);
    }
    if (!$query) {
        return;
    }

    $total = $query->max_num_pages;
    $current = max(1, $paged);
    $next = $current + 1;
    if ($query->max_num_pages > 1): ?>
       <div class='load-more-container'><button id="tp-load-more" class="tp_load_more <?php echo esc_attr($caf_post_layout); ?>" data-current="<?php echo esc_attr($current); ?>" data-total="<?php echo esc_attr($total); ?>" data-next="<?php echo esc_attr($next); ?>"><?php echo esc_html($caf_load_more_text); ?></button></div>
    <?php endif;
}

if ($caf_pagi_type == 'number2') {
    if (!$query) {
        return;
    }
    $total = $query->max_num_pages;
    $current = max(1, $paged);
    $next = $current + 1;
    $prev = $current - 1;
    $disableprev='';
    $disablenext='';
    if($prev<1) {
        $disableprev='disabled';
    }
    if($next>$total) {
        $disablenext='disabled';
    }
echo "<div class='prev-next-caf-pagination'>";
echo "<div class='prev-next-caf-container'>";
$page_text='Page';
$page_text = apply_filters('tc_caf_pagination_page_text_first', $page_text, $filter_id);
echo $page_text;
echo "<input type='text'  class='prev-next-input' value='".$current."'>";
$page_text2='of';
$page_text2 = apply_filters('tc_caf_pagination_page_text_second', $page_text2, $filter_id);
echo $page_text2." ".$total;
echo "<a class='prev-caf-page caf-pagi-btn' href='#page=".$prev."'  $disableprev>";
$prev_text='<';
$prev_text = apply_filters('tc_caf_pagination_prev_text', $prev_text, $filter_id);
echo $prev_text;
echo "</a>";
echo "<a class='next-caf-page caf-pagi-btn' href='#page=".$next."' $disablenext>";
$next_text='>';
$next_text = apply_filters('tc_caf_pagination_next_text', $next_text, $filter_id);
echo $next_text;
echo "</a>";
echo "</div>";
echo "</div>";
}
?>