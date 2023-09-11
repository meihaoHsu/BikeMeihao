<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
class CAF_POST_ACTIONS
{
    public $template = TC_CAF_PRO_PATH . '/templates/';
    public $template_path = "category-ajax-filter/templates/";
    public function __construct()
    {
        add_action("caf_content_before_post_loop", array($this, "caf_content_before_post_loop"), 5);
        add_action("caf_article_container_start", array($this, "caf_article_container_start"), 5);
        add_action('caf_after_article_container_start', array($this, 'caf_after_article_container_start'), 5, 2);
        add_action('caf_after_article_container_start', array($this, 'caf_manage_layout_start'), 6, 2);
        add_action('caf_after_article_container_start', array($this, 'caf_get_post_image'), 10, 2);
        add_action('caf_after_article_container_start', array($this, 'caf_manage_post_area_start'), 15, 2);
        add_action('caf_after_article_container_start', array($this, 'caf_get_post_title'), 20, 2);
        add_action("caf_after_article_container_start", array($this, "caf_meta_content_container_start"), 25, 2);
        add_action("caf_after_article_container_start", array($this, "caf_get_meta_auhtor"), 30, 2);
        add_action("caf_after_article_container_start", array($this, "caf_get_meta_date"), 35, 2);
        add_action("caf_after_article_container_start", array($this, "caf_get_meta_comment_count"), 40, 2);
        add_action("caf_after_article_container_start", array($this, "caf_meta_content_container_end"), 45, 2);
        add_action("caf_after_article_container_start", array($this, "caf_get_linked_terms"), 50, 2);
        add_action('caf_after_article_container_start', array($this, 'caf_get_post_content'), 55, 2);
        add_action('caf_after_article_container_start', array($this, 'caf_get_post_read_more'), 60, 2);
        add_action('caf_after_article_container_start', array($this, 'caf_manage_post_area_end'), 65, 2);
        add_action('caf_after_article_container_start', array($this, 'caf_manage_layout_end'), 70, 2);
        add_action("caf_article_container_end", array($this, "caf_article_container_end"));
        add_action("caf_empty_result_error", array($this, "caf_empty_result_error"));
        add_action("caf_content_after_post_loop", array($this, "caf_content_after_post_loop"), 99);
    }
    public function caf_content_before_post_loop($id)
    {
        ob_start();
        include TC_CAF_PATH . 'includes/query-variables.php';
        if ($caf_post_layout == "post-layout9" || $caf_post_layout == "post-layout11") {
            echo "<div class='acf-masnory'>";
        }
        $output = ob_get_contents();
        ob_end_clean();
        $post = '';
        $data = array('post-layout' => $caf_post_layout, 'filter-id' => $id);
        echo apply_filters("caf_article_container_start_filter", $output, $data, $post);
    }
    public function caf_content_after_post_loop($id)
    {
        ob_start();
        include TC_CAF_PATH . 'includes/query-variables.php';
        if ($caf_post_layout == "post-layout9" || $caf_post_layout == "post-layout11") {
            echo "</div>";
        }
        $output = ob_get_contents();
        ob_end_clean();
        $post = '';
        $data = array('post-layout' => $caf_post_layout, 'filter-id' => $id);
        echo apply_filters("caf_article_container_start_filter", $output, $data, $post);
    }
    public function caf_after_article_container_start($id)
    {
        include TC_CAF_PATH . 'includes/query-variables.php';
        include TC_CAF_PATH . 'includes/post-variables.php';
        switch ($caf_post_layout) {
            case "post-layout2":
                remove_action("caf_after_article_container_start", array($this, "caf_manage_layout_start"), 6);
                remove_action('caf_after_article_container_start', array($this, 'caf_manage_layout_end'), 70);
                remove_action("caf_after_article_container_start", array($this, "caf_get_linked_terms"), 50);
                add_action("caf_after_article_container_start", array($this, "caf_get_linked_terms"), 15);
                break;
            case "post-layout3":
                remove_action("caf_after_article_container_start", array($this, "caf_get_linked_terms"), 50);
                add_action("caf_after_article_container_start", array($this, "caf_get_linked_terms"), 15);
                break;
            case "post-layout5":
                remove_action("caf_after_article_container_start", array($this, "caf_meta_content_container_start"), 25);
                remove_action("caf_after_article_container_start", array($this, "caf_get_meta_auhtor"), 30);
                remove_action("caf_after_article_container_start", array($this, "caf_get_meta_date"), 35);
                remove_action("caf_after_article_container_start", array($this, "caf_get_meta_comment_count"), 40);
                remove_action("caf_after_article_container_start", array($this, "caf_meta_content_container_end"), 45);
                remove_action('caf_after_article_container_start', array($this, 'caf_get_post_title'), 20);
                add_action("caf_after_article_container_start", array($this, "caf_meta_content_container_start"), 15, 2);
                add_action("caf_after_article_container_start", array($this, "caf_get_meta_auhtor"), 20, 2);
                add_action("caf_after_article_container_start", array($this, "caf_get_meta_date"), 25, 2);
                add_action("caf_after_article_container_start", array($this, "caf_get_meta_comment_count"), 30, 2);
                add_action("caf_after_article_container_start", array($this, "caf_meta_content_container_end"), 35, 2);
                add_action('caf_after_article_container_start', array($this, 'caf_get_post_title'), 40);
                break;
            case "post-layout6":
                remove_action("caf_after_article_container_start", array($this, "caf_meta_content_container_start"), 25);
                remove_action("caf_after_article_container_start", array($this, "caf_get_meta_auhtor"), 30);
                remove_action("caf_after_article_container_start", array($this, "caf_get_meta_date"), 35);
                remove_action("caf_after_article_container_start", array($this, "caf_get_meta_comment_count"), 40);
                remove_action("caf_after_article_container_start", array($this, "caf_meta_content_container_end"), 45);
                remove_action('caf_after_article_container_start', array($this, 'caf_get_post_title'), 20);
                add_action("caf_after_article_container_start", array($this, "caf_meta_content_container_start"), 15, 2);
                add_action("caf_after_article_container_start", array($this, "caf_get_meta_auhtor"), 20, 2);
                add_action("caf_after_article_container_start", array($this, "caf_get_meta_date"), 25, 2);
                add_action("caf_after_article_container_start", array($this, "caf_get_meta_comment_count"), 30, 2);
                add_action("caf_after_article_container_start", array($this, "caf_meta_content_container_end"), 35, 2);
                add_action('caf_after_article_container_start', array($this, 'caf_get_post_title'), 40);
                break;
            case "post-layout7":
                remove_action("caf_after_article_container_start", array($this, "caf_meta_content_container_start"), 25);
                remove_action("caf_after_article_container_start", array($this, "caf_get_meta_auhtor"), 30);
                remove_action("caf_after_article_container_start", array($this, "caf_get_meta_date"), 35);
                remove_action("caf_after_article_container_start", array($this, "caf_get_meta_comment_count"), 40);
                remove_action("caf_after_article_container_start", array($this, "caf_meta_content_container_end"), 45);
                remove_action('caf_after_article_container_start', array($this, 'caf_get_post_title'), 20);
                add_action("caf_after_article_container_start", array($this, "caf_meta_content_container_start"), 55, 2);
                add_action("caf_after_article_container_start", array($this, "caf_get_meta_auhtor"), 55, 2);
                add_action("caf_after_article_container_start", array($this, "caf_get_meta_date"), 55, 2);
                add_action("caf_after_article_container_start", array($this, "caf_get_meta_comment_count"), 55, 2);
                add_action("caf_after_article_container_start", array($this, "caf_meta_content_container_end"), 55, 2);
                add_action('caf_after_article_container_start', array($this, 'caf_get_post_title'), 40);
                break;
            case "post-layout10":
                remove_action("caf_after_article_container_start", array($this, "caf_meta_content_container_start"), 25);
                remove_action("caf_after_article_container_start", array($this, "caf_get_meta_auhtor"), 30);
                remove_action("caf_after_article_container_start", array($this, "caf_get_meta_date"), 35);
                remove_action("caf_after_article_container_start", array($this, "caf_get_meta_comment_count"), 40);
                remove_action("caf_after_article_container_start", array($this, "caf_meta_content_container_end"), 45);
                remove_action('caf_after_article_container_start', array($this, 'caf_get_post_title'), 20);
                remove_action("caf_after_article_container_start", array($this, "caf_get_linked_terms"), 50, 2);
                remove_action('caf_after_article_container_start', array($this, 'caf_get_post_content'), 55, 2);
                remove_action('caf_after_article_container_start', array($this, 'caf_get_post_read_more'), 60, 2);
                break;
        }
    }
    public function caf_get_file_path($layout)
    {
        return wcpt_get_template($layout, "", $this->template_path, $this->template);
    }
    public function caf_article_container_start($id)
    {
        ob_start();
        include TC_CAF_PATH . 'includes/query-variables.php';
        include TC_CAF_PATH . 'includes/post-variables.php';
        $cats = $this->caf_get_cats($tax);
        $cats_class = $this->caf_get_first_class($cats);
        $caf_mb = 'caf-mb-5';
        if ($caf_post_layout == "post-layout4") {
            $caf_desktop_col = '12';
            $caf_tablet_col = '12';
            $caf_mobile_col = '12';
            $caf_mb = 'caf-mb-10';
        }
        $layout = "article-start.php";
        $filepath = $this->caf_get_file_path($layout);
        if (file_exists($filepath)) {
            include $filepath;
        }
        $output = ob_get_contents();
        ob_end_clean();
        $data = array('desktop-column' => $caf_desktop_col, 'tablet-column' => $caf_tablet_col, 'mobile-column' => $caf_mobile_col, 'post-class' => $caf_special_post_class, 'post-animation' => $caf_post_animation, 'cat-class' => $cats_class, 'post-layout' => $caf_post_layout, 'filter-id' => $id);
        echo apply_filters("caf_article_container_start_filter", $output, $data, $post);
    }
    public function caf_article_container_end($id)
    {
        ob_start();
        include TC_CAF_PATH . 'includes/query-variables.php';
        include TC_CAF_PATH . 'includes/post-variables.php';
        $layout = "article-end.php";
        $filepath = $this->caf_get_file_path($layout);
        if (file_exists($filepath)) {
            include $filepath;
        }
        $output = ob_get_contents();
        ob_end_clean();
        $data = array('post-layout' => $caf_post_layout, 'filter-id' => $id);
        echo apply_filters("caf_article_container_end_filter", $output, $data, $post);
    }
    public function caf_manage_layout_start($id, $i)
    {
        ob_start();
        include TC_CAF_PATH . 'includes/query-variables.php';
        include TC_CAF_PATH . 'includes/post-variables.php';
        $layout = "manage-layout-start.php";
        $filepath = $this->caf_get_file_path($layout);
        if (file_exists($filepath)) {
            include $filepath;
        }
        $output = ob_get_contents();
        ob_end_clean();
        $data = array('post-layout' => $caf_post_layout, 'filter-id' => $id);
        echo apply_filters("caf_manage_layout_start_filter", $output, $data, $post);
    }

    public function caf_manage_layout_end($id)
    {
        ob_start();
        include TC_CAF_PATH . 'includes/query-variables.php';
        include TC_CAF_PATH . 'includes/post-variables.php';
        $layout = "manage-layout-end.php";
        $filepath = $this->caf_get_file_path($layout);
        if (file_exists($filepath)) {
            include $filepath;
        }
        $output = ob_get_contents();
        ob_end_clean();
        $data = array('post-layout' => $caf_post_layout, 'filter-id' => $id);
        echo apply_filters("caf_manage_layout_start_filter", $output, $data, $post);
    }

    public function caf_manage_post_area_start($id)
    {
        ob_start();
        include TC_CAF_PATH . 'includes/query-variables.php';
        include TC_CAF_PATH . 'includes/post-variables.php';
        $layout = "manage-post-area-start.php";
        $filepath = $this->caf_get_file_path($layout);
        if (file_exists($filepath)) {
            include $filepath;
        }
        $output = ob_get_contents();
        ob_end_clean();
        $data = array('post-layout' => $caf_post_layout, 'filter-id' => $id);
        echo apply_filters("caf_manage_post_area_start_filter", $output, $data, $post);
    }

    public function caf_manage_post_area_end($id)
    {
        ob_start();
        include TC_CAF_PATH . 'includes/query-variables.php';
        include TC_CAF_PATH . 'includes/post-variables.php';
        $layout = "manage-post-area-end.php";
        $filepath = $this->caf_get_file_path($layout);
        if (file_exists($filepath)) {
            include $filepath;
        }
        $output = ob_get_contents();
        ob_end_clean();
        $data = array('post-layout' => $caf_post_layout, 'filter-id' => $id);
        echo apply_filters("caf_manage_post_area_end_filter", $output, $data, $post);
    }

    public function caf_get_post_image($id)
    {
        ob_start();
        include TC_CAF_PATH . 'includes/query-variables.php';
        include TC_CAF_PATH . 'includes/post-variables.php';
        $a_class = '';
        $img_box = '';
        if ($caf_post_layout == 'post-layout4') {
            $a_class = 'caf-f-img';
        }
        if ($caf_post_layout == 'post-layout6') {
            $a_class = 'caf-featured-a';
            $img_box = 'avt';
        }
        if ($caf_post_layout == 'post-layout7') {
            $a_class = 'caf-featured-a';
        }
        if ($caf_post_layout == 'post-layout11') {
            $a_class = 'caf-f-link';
        }
        $layout = "post-image.php";
        $filepath = $this->caf_get_file_path($layout);
        if (file_exists($filepath)) {
            include $filepath;
        }
        $output = ob_get_contents();
        ob_end_clean();
        $data = array('image' => $image, 'link' => $link, 'link-target' => $caf_link_target, 'post-layout' => $caf_post_layout, 'filter-id' => $id);
        echo apply_filters("caf_get_post_image_filter", $output, $data, $post);
    }

    public function caf_meta_content_container_start($id)
    {
        ob_start();
        include TC_CAF_PATH . 'includes/query-variables.php';
        include TC_CAF_PATH . 'includes/post-variables.php';
        $layout = "meta-content-start.php";
        $filepath = $this->caf_get_file_path($layout);
        if (file_exists($filepath)) {
            include $filepath;
        }
        $output = ob_get_contents();
        ob_end_clean();
        $data = array('post-author' => $caf_post_author, 'post-date' => $caf_post_date, 'post-layout' => $caf_post_layout, 'filter-id' => $id);
        echo apply_filters("caf_meta_content_container_start_filter", $output, $data, $post);
    }

    public function caf_get_meta_auhtor($id)
    {
        ob_start();
        include TC_CAF_PATH . 'includes/query-variables.php';
        include TC_CAF_PATH . 'includes/post-variables.php';
        $layout = "caf-author.php";
        $filepath = $this->caf_get_file_path($layout);
        if (file_exists($filepath)) {
            include $filepath;
        }
        $output = ob_get_contents();
        ob_end_clean();
        $data = array('post-author' => $caf_post_author, 'post-layout' => $caf_post_layout, 'filter-id' => $id);
        echo apply_filters("caf_get_meta_auhtor_filter", $output, $data, $post);
    }

    public function caf_get_meta_date($id)
    {
        ob_start();
        include TC_CAF_PATH . 'includes/query-variables.php';
        include TC_CAF_PATH . 'includes/post-variables.php';
        $layout = "caf-date.php";
        $filepath = $this->caf_get_file_path($layout);
        if (file_exists($filepath)) {
            include $filepath;
        }
        $output = ob_get_contents();
        ob_end_clean();
        $data = array('post-date' => $caf_post_date, 'post-format' => $caf_post_date_format, 'post-layout' => $caf_post_layout, 'filter-id' => $id);
        echo apply_filters("caf_get_meta_date_filter", $output, $data, $post);
    }

    public function caf_get_meta_comment_count($id)
    {
        ob_start();
        include TC_CAF_PATH . 'includes/query-variables.php';
        include TC_CAF_PATH . 'includes/post-variables.php';
        $layout = "comments-count.php";
        $filepath = $this->caf_get_file_path($layout);
        if (file_exists($filepath)) {
            include $filepath;
        }
        $output = ob_get_contents();
        ob_end_clean();
        $data = array('post-comments-count' => $caf_post_comments, 'post-layout' => $caf_post_layout, 'filter-id' => $id);
        echo apply_filters("caf_get_meta_comment_count_filter", $output, $data, $post);
    }

    public function caf_get_post_title($id)
    {
        ob_start();
        include TC_CAF_PATH . 'includes/query-variables.php';
        include TC_CAF_PATH . 'includes/post-variables.php';
        $layout = "title.php";
        $filepath = $this->caf_get_file_path($layout);
        if (file_exists($filepath)) {
            include $filepath;
        }
        $output = ob_get_contents();
        ob_end_clean();
        $data = array('link' => $link, 'title' => $title, 'post-layout' => $caf_post_layout, 'filter-id' => $id);
        echo apply_filters("caf_get_post_title_filter", $output, $data, $post);
    }

    public function caf_meta_content_container_end($id)
    {
        ob_start();
        include TC_CAF_PATH . 'includes/query-variables.php';
        include TC_CAF_PATH . 'includes/post-variables.php';
        $layout = "meta-content-end.php";
        $filepath = $this->caf_get_file_path($layout);
        if (file_exists($filepath)) {
            include $filepath;
        }
        $output = ob_get_contents();
        ob_end_clean();
        $data = array('post-author' => $caf_post_author, 'post-date' => $caf_post_date, 'post-layout' => $caf_post_layout, 'filter-id' => $id);
        echo apply_filters("caf_meta_content_container_end_filter", $output, $data, $post);
    }
    public function caf_get_post_content($id)
    {
        ob_start();
        include TC_CAF_PATH . 'includes/query-variables.php';
        include TC_CAF_PATH . 'includes/post-variables.php';
        $layout = "caf-content.php";
        $filepath = $this->caf_get_file_path($layout);
        if (file_exists($filepath)) {
            include $filepath;
        }
        $output = ob_get_contents();
        ob_end_clean();
        $data = array('post-description' => $caf_post_dsc, 'post-content' => $caf_content, 'post-layout' => $caf_post_layout, 'filter-id' => $id);
        echo apply_filters("caf_get_post_content_filter", $output, $data, $post);
    }
    public function caf_get_post_read_more($id, $i)
    {
        ob_start();
        include TC_CAF_PATH . 'includes/query-variables.php';
        include TC_CAF_PATH . 'includes/post-variables.php';
        $layout = "read-more.php";
        $filepath = $this->caf_get_file_path($layout);
        if (file_exists($filepath)) {
            include $filepath;
        }
        $output = ob_get_contents();
        ob_end_clean();
        $data = array('post-content' => $caf_content, 'post-read' => $caf_post_rd, 'post-link' => $link, 'link-target' => $caf_link_target, 'post-layout' => $caf_post_layout, 'filter-id' => $id);
        echo apply_filters("caf_get_post_read_more_filter", $output, $data, $post);
    }
    public function caf_empty_result_error($caf_empty_res)
    {
        ob_start();
        $post = '';
        $layout = "empty-result.php";
        $filepath = $this->caf_get_file_path($layout);
        if (file_exists($filepath)) {
            include $filepath;
        }
        $output = ob_get_contents();
        ob_end_clean();
        $data = array('empty-result-error' => $caf_empty_res);
        echo apply_filters("caf_empty_result_error_filter", $output, $data, $post);
    }
    public function caf_get_linked_terms($id)
    {
        ob_start();
        include TC_CAF_PATH . 'includes/query-variables.php';
        include TC_CAF_PATH . 'includes/post-variables.php';
        $cats = $this->caf_get_cats($tax);
        $layout = "caf-terms.php";
        $filepath = $this->caf_get_file_path($layout);
        if (file_exists($filepath)) {
            include $filepath;
        }
        $output = ob_get_contents();
        ob_end_clean();
        $data = array('tax' => $tax, 'post-cats' => $caf_post_cats, 'post-layout' => $caf_post_layout, 'filter-id' => $id);
        echo apply_filters("caf_article_container_start_filter", $output, $data, $post);
    }
    public function caf_get_cats($tax)
    {
        global $post;
        $caf_post_id = get_the_ID();
        if (is_array($tax)) {
            $cats = array();
            foreach ($tax as $tx) {
                $cats[] = get_the_terms($caf_post_id, $tx);
            }
        } else {
            $cats = get_the_terms($caf_post_id, $tax);
        }
        return $cats;
    }
    public function caf_get_first_class($cats)
    {
        // echo "<pre>";
        // print_r($cats);
        // echo "</pre>";
        $cats_class = '';
        if (is_array($cats)) {
            if (isset($cats)) {
                if (isset($cats[0][0])) {
                    if (isset($cats[0][0]->name)) {
                        $cats_class = $cats[0][0]->name;
                    }
                }
                $cats_class = str_replace(' ', '_', $cats_class);
                $cats_class = "tp_" . $cats_class;
            } else { $cats_class = '';}}
        return $cats_class;
    }
}
global $caf_post_actions;
$caf_post_actions = new CAF_POST_ACTIONS();
