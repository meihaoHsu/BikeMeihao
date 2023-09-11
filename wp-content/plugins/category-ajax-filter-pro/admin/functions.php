<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
class CAF_PRO_admin_filters
{
    public function __construct()
    {
        add_action('admin_enqueue_scripts', array($this, 'tc_caf_pro_embedCssJs'));
        add_filter('tc_caf_font_family', array($this, 'tc_caf_pro_font_family'), 70, 1);
        add_filter('tc_caf_filter_layouts', array($this, 'tc_caf_pro_filter_layouts'), 70, 1);
        add_filter('tc_caf_post_layouts', array($this, 'tc_caf_pro_post_layouts'), 70, 1);
        add_filter('tc_caf_pagi_type', array($this, 'tc_caf_pro_pagi_type'), 70, 1);
        add_filter('tc_caf_post_animations', array($this, 'tc_caf_pro_post_animations'), 70, 1);
        add_filter('post_row_actions', array($this, 'caf_duplicate_post_link'), 99, 2);
        add_filter('tc_caf_search_layouts', array($this, 'tc_caf_search_layouts'), 99);
        add_filter('tc_caf_filter_all_text', array($this, 'tc_caf_pro_filter_all_text_function'), 99, 2);
        add_filter('tc_caf_add_custom_span_before_filter', array($this, 'tc_caf_pro_add_custom_span_before_filter_function'), 90, 2);
        add_filter('tc_caf_add_custom_list_before_filter', array($this, 'tc_caf_pro_add_custom_list_before_filter_function'), 90, 2);
        add_filter('tc_caf_post_layout_read_more', array($this, 'tc_caf_post_layout_read_more'), 90, 2);
        add_filter('tc_caf_post_date_format', array($this, 'tc_caf_post_date_format'), 90, 2);
        add_filter('tc_caf_post_date_format_timeline', array($this, 'tc_caf_post_date_format_timeline'), 90, 2);
        add_filter('tc_caf_post_date_format_timeline_year', array($this, 'tc_caf_post_date_format_timeline_year'), 90, 2);
        add_filter('tc_caf_post_layout_f_p', array($this, 'tc_caf_post_layout_f_p'), 91, 2);
        //add_action('admin_enqueue_scripts', array($this,'codemirror_enqueue_scripts'));
    }
    public function tc_caf_post_layout_read_more($text, $id)
    {
        $caf_read_more_text = 'Read More';
        if (get_post_meta($id, 'caf_read_more_text')) {
            $caf_read_more_text = get_post_meta($id, 'caf_read_more_text', true);
        }
        return $caf_read_more_text;
    }
    public function tc_caf_post_date_format($format, $id)
    {
        $caf_post_date_format = "d, M Y";
        if (get_post_meta($id, 'caf_post_date_format')) {
            $caf_post_date_format = get_post_meta($id, 'caf_post_date_format', true);
        }
        return $caf_post_date_format;
    }
    public function tc_caf_post_date_format_timeline($format, $id)
    {
        $caf_post_date_format = "d, M";
        return $caf_post_date_format;
    }
    public function tc_caf_post_date_format_timeline_year($format, $id)
    {
        $caf_post_date_format = "Y";
        return $caf_post_date_format;
    }
    public function tc_caf_post_layout_f_p($text, $id)
    {
        $caf_f_p_text = 'Search Here....';
        if (get_post_meta($id, 'caf_f_p_text')) {
            $caf_f_p_text = get_post_meta($id, 'caf_f_p_text', true);
        }
        return $caf_f_p_text;
    }
    public function tc_caf_pro_filter_all_text_function($text, $id)
    {
        if (get_post_meta($id, 'caf_default_all_text')) {
            return $default_all_text = get_post_meta($id, 'caf_default_all_text', true);
        } else {
            return 'All';
        }
    }
    public function tc_caf_pro_add_custom_span_before_filter_function($text, $id)
    {
        if (get_post_meta($id, 'caf_want_to_check')) {
            return get_post_meta($id, 'caf_want_to_check', true) . " ";
        } else {
            return 'I want to check out ';
        }
    }
    public function tc_caf_pro_add_custom_list_before_filter_function($text, $id)
    {
        if (get_post_meta($id, 'caf_check_everything')) {
            return get_post_meta($id, 'caf_check_everything', true);
        } else {
            return 'Everything';
        }
    }
    public function tc_caf_pro_embedCssJs()
    {
        global $post_type,$hook_suffix;
        //var_dump($hook_suffix);
        if ($hook_suffix == "caf_posts_page_caf_custom_layouts") {
            wp_enqueue_style('tc_caf-pro-custom-admin-style', TC_CAF_PRO_URL . 'admin/css/custom.css');
            wp_enqueue_style('tc_caf-pro-custom-antd-admin-style', 'https://cdnjs.cloudflare.com/ajax/libs/antd/4.22.7/antd.min.css');
        }

        if ($post_type == "caf_posts") {
            wp_enqueue_script('tc-caf-pro-script-chart', 'https://www.gstatic.com/charts/loader.js');
            wp_dequeue_style('tc_caf-custom-admin-style');
            $filepath = get_stylesheet_directory() . "/category-ajax-filter/admin/css/custom.css";
            if (file_exists($filepath)) {
                wp_enqueue_style('tc_caf-pro-custom-admin-style', get_stylesheet_directory_uri() . '/category-ajax-filter/admin/css/custom.css');
            } else {
                wp_enqueue_style('tc_caf-pro-custom-admin-style', TC_CAF_PRO_URL . 'admin/css/custom.css');
            }
            $cm_settings['codeEditor'] = wp_enqueue_code_editor(

                array('codemirror' => array(
                    'autoRefresh' => true,
                    'indentUnit' => 0,
                    'indentWithTabs' => false,
                    'inputStyle' => 'contenteditable',
                    'lineNumbers' => true,
                    'lineWrapping' => true,
                    'styleActiveLine' => false), 'type' => 'text/css')
            );
            wp_localize_script('jquery', 'cm_settings', $cm_settings);
            wp_enqueue_script('wp-theme-plugin-editor');
            wp_enqueue_style('wp-codemirror');
        }
    }
    public function tc_caf_pro_font_family($fonts)
    {
        $path = TC_CAF_PRO_PATH . "admin/google-fonts.json";
        $request = file_get_contents($path);
        $fonts_json_decoded = json_decode($request, true);
        $fonts = array();
        foreach ($fonts_json_decoded['items'] as $font_item) {
            if (!isset($font_item['family'], $font_item['variants'], $font_item['subsets'], $font_item['category'])) {
                continue;
            }
            $fonts[sanitize_text_field($font_item['family'])] = array(
                'styles' => sanitize_text_field(implode(',', $font_item['variants'])),
                'character_set' => sanitize_text_field(implode(',', $font_item['subsets'])),
                'type' => sanitize_text_field($font_item['category']),
            );
        }
        ksort($fonts);
        return $fonts;
    }
    public function tc_caf_pro_filter_layouts($layouts)
    {
        $layouts = array("0" => "Classic Filters", "filter-layout1" => 'Default Filter', "filter-layout2" => 'Dropdown Filter', "filter-layout3" => 'Sidebar Filter', "multiple-checkbox" => 'Multiple Checkbox', "tabfilter-layout1" => 'Tab Layout1', "alphabetical-layout" => 'Alphabetical Navigation', "1" => "Multiple Taxonomy Filters", "multiple-taxonomy-filter" => "Multiple Taxonomy Filter - Vertical", "multiple-taxonomy-filter-hor" => "Multiple Taxonomy Filter - Horizontal Dropdown", "multiple-taxonomy-filter-hor-modern" => "Multiple Taxonomy Filter - Horizontal Dropdown (Modern)", "2" => "Parent Child Category Filter", "parent-child-filter" => "Parent Child Category Filter-Vertical", "3" => "end");
        return $layouts;
    }
    public function tc_caf_pro_post_layouts($layouts)
    {
        $layouts_new = array("post-layout5" => 'Simple Timeline', "post-layout6" => 'Full Width Timeline', "post-layout7" => 'Full Rounded Corner', "carousel-slider" => 'Carousel Slider', "post-layout9" => 'Masonry layout', "post-layout10" => 'Gradient Border', "post-layout11" => 'Masonry with Description');
// trusty_register_style($layouts_new);
        if (get_option("caf_custom_post_layout")) {
            $custom_layouts = get_option("caf_custom_post_layout");
            foreach ($custom_layouts as $key => $layout) {
                $title = strtolower(trim($layout));
                $title = str_replace(' ', '', $title);
                $title = $title . "_" . $key;
                if (get_option($title)) {
                    $layouts_new[$title] = $layout . " - CAF Builder Layout";
                }
            }
        }
        $layouts_updated = array_merge($layouts, $layouts_new);
        return $layouts_updated;
    }
    public function tc_caf_search_layouts($layouts)
    {
        $layouts = array("search-layout1" => 'Default Layout', "search-layout2" => 'Search Icon Layout');
        return $layouts;
    }
    public function tc_caf_pro_pagi_type($ptype)
    {
        $ptype = array("number" => 'number', "load-more" => "load more" ,"number2"=>'Prev/Next With Input');
        return $ptype;
    }
    public function tc_caf_pro_post_animations($animations)
    {
        $an = "animate__animated";
        $animations_new = array("Attention Seekers" => "Attention Seekers", "$an animate__bounce" => 'Bounce', "$an animate__flash" => 'Flash', "$an animate__pulse" => 'Pulse', "$an animate__rubberBand" => 'RubberBand', "$an animate__shakeX" => "ShakeX", "$an animate__shakeY" => "ShakeY", "$an animate__headShake" => "HeadShake", "$an animate__swing" => "Swing", "$an animate__tada" => "Tada", "$an animate__wobble" => "Wobble", "$an animate__jello" => "Jello", "$an animate__heartBeat" => "HeartBeat", "optionend" => "Attention Seekers", "Back Entrances" => "Back Entrances", "$an animate__backInDown" => "BackInDown", "$an animate__backInLeft" => "BackInLeft", "$an animate__backInRight" => "BackInRight", "$an animate__backInUp" => "BackInUp", "optionend" => "Back Entrances", "Bouncing entrances" => "Bouncing entrances", "$an animate__bounceIn" => "BounceIn", "$an animate__bounceInDown" => "BounceInDown", "$an animate__bounceInLeft" => "BounceInLeft", "$an animate__bounceInRight" => "BounceInRight", "$an animate__bounceInUp" => "BounceInUp", "optionend" => "Bouncing entrances", "Fading entrances" => "Fading entrances", "$an animate__fadeIn" => "FadeIn", "$an animate__fadeInDown" => "FadeInDown", "$an animate__fadeInDownBig" => "FadeInDownBig", "$an animate__fadeInLeft" => "FadeInLeft", "$an animate__fadeInLeftBig" => "FadeInLeftBig", "$an animate__fadeInRight" => "FadeInRight", "$an animate__fadeInRightBig" => "FadeInRightBig", "$an animate__fadeInUp" => "FadeInUp", "$an animate__fadeInUpBig" => "FadeInUpBig", "$an animate__fadeInTopLeft" => "FadeInTopLeft", "$an animate__fadeInTopRight" => "FadeInTopRight", "$an animate__fadeInBottomLeft" => "FadeInBottomLeft", "$an animate__fadeInBottomRight" => "FadeInBottomRight", "optionend" => "Fading entrances", "Flippers" => "Flippers", "$an animate__flip" => "Flip", "$an animate__flipInX" => "FlipInX", "$an animate__flipInY" => "FlipInY", "optionend" => "Flippers", "Light Speed" => "Light Speed", "$an animate__lightSpeedInRight" => "LightSpeedInRight", "$an animate__lightSpeedInLeft" => "LightSpeedInLeft", "optionend" => "Light Speed", "Rotating entrances" => "Rotating entrances", "$an animate__rotateIn" => "Rotate In", "$an animate__rotateInDownLeft" => "RotateInDownLeft", "$an animate__rotateInDownRight" => "RotateInDownRight", "$an animate__rotateInUpLeft" => "RoatateInUpLeft", "$an animate__rotateInUpRight" => "RotateInUpRight", "optionend" => "Rotating entrances", "Specials" => "Specials", "$an animate__jackInTheBox" => "JackInTheBox", "$an animate__rollIn" => "RollIn", "optionend" => "Specials", "Zooming entrances" => "Zooming entrances", "$an animate__zoomIn" => "ZoomIn", "$an animate__zoomInDown" => "ZoomInDown", "$an animate__zoomInLeft" => "ZoomInLeft", "$an animate__zoomInRight" => "ZoomInRight", "$an animate__zoomInUp" => "ZoomInUp", "optionend" => "Zooming entrances");
// trusty_register_style($layouts_new);
        $animations_updated = array_merge($animations, $animations_new);
        return $animations_updated;
    }
    public function caf_duplicate_post_link($actions, $post)
    {
        //var_dump($post);
        if (current_user_can('edit_posts')) {
            if ($post->post_type == 'caf_posts') {
                $actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=caf_duplicate_filter_as_draft&post=' . $post->ID, basename(__FILE__), 'duplicate_nonce') . '" title="Duplicate this filter" rel="permalink">Clone Filter</a>';
            }}
        return $actions;
    }
}
class CAF_PRO_ACTIONS
{
    public function __construct()
    {
        add_action('tc_caf_after_caf_post_pagi_tab', array($this, 'tc_caf_after_caf_post_pagi_tab'), 10);
        add_action('tc_caf_after_caf_post_class_tab', array($this, 'tc_caf_after_caf_post_class_tab'), 10);
        add_action('save_post', array($this, 'trusty_save_meta_box'), 10, 2);
        add_action("tc_caf_after_caf_pagi_type_row", array($this, "tc_caf_pro_after_caf_pagi_type_row"), 10);
        add_action("tc_caf_after_caf_per_page_row", array($this, "tc_caf_pro_after_caf_per_page_row"), 70);
        add_action("tc_caf_after_caf_post_typo_row", array($this, "tc_caf_pro_after_caf_post_typo_row"), 70);
        add_action("tc_caf_after_caf_filter_color_row", array($this, "tc_caf_pro_after_caf_filter_color_row"), 70);
        add_action("tc_caf_in_import_tab", array($this, "tc_caf_in_import_tab_fun"), 70);
        add_action('admin_action_caf_duplicate_filter_as_draft', array($this, 'caf_duplicate_filter_as_draft'), 10);
        add_action('caf_after_filter_layout', array($this, 'caf_after_filter_layout_fun'), 70, 2);
        add_action('tc_caf_after_caf_post_animation_tab', array($this, 'tc_caf_after_caf_post_animation_tab_fun'), 10);
        add_action('tc_caf_under_manage_filters_row', array($this, 'tc_caf_under_manage_filters_row_fun'), 10);
        //add_action('tc_caf_popup_option',array($this,'tc_caf_popup_option_fun'),70,1);
        add_action('tc_caf_after_caf_post_terms_row', array($this, 'tc_caf_after_caf_post_terms_row_fun'), 10, 2);
        add_action('tc_caf_post_multiple_taxonomies', array($this, 'tc_caf_post_multiple_taxonomies_fun'), 10, 3);
        add_action('tc_caf_post_multiple_taxonomies_terms', array($this, 'tc_caf_post_multiple_taxonomies_terms_fun'), 10, 2);
        add_action('tc_caf_after_caf_empty_result_row', array($this, 'tc_caf_after_caf_empty_result_row_fun'), 10);
        add_action('caf_manage_sorting', array($this, 'caf_manage_sorting_fun'), 10);
        $cl = new CAF_PRO_FILTERS();
        $cl->remove_class_filter("wp_ajax_tc_caf_get_taxonomy", "CAF_admin_ajax", "tc_caf_get_taxonomy");
        $cl->remove_class_filter("wp_ajax_nopriv_tc_caf_get_taxonomy", "CAF_admin_ajax", "tc_caf_get_taxonomy");
        add_action('wp_ajax_tc_caf_get_taxonomy', array($this, 'tc_caf_get_taxonomy_pro'));
        add_action('wp_ajax_nopriv_tc_caf_get_taxonomy', array($this, 'tc_caf_get_taxonomy_pro'));
        add_action('wp_ajax_tc_caf_get_terms_pro', array($this, 'tc_caf_get_terms_pro'));
        add_action('wp_ajax_nopriv_tc_caf_get_terms_pro', array($this, 'tc_caf_get_terms_pro'));
        add_action('wp_ajax_tc_caf_get_terms_pro_def', array($this, 'tc_caf_get_terms_pro_def'));
        add_action('wp_ajax_nopriv_tc_caf_get_terms_pro_def', array($this, 'tc_caf_get_terms_pro_def'));
        add_action('wp_ajax_tc_caf_reset_analytics', array($this, 'tc_caf_reset_analytics'));
        add_action('wp_ajax_nopriv_tc_caf_reset_analytics', array($this, 'tc_caf_reset_analytics'));
        add_action('wp_ajax_tc_caf_enable_analytics', array($this, 'tc_caf_enable_analytics'));
        add_action('wp_ajax_nopriv_tc_caf_enable_analytics', array($this, 'tc_caf_enable_analytics'));
        add_action('wp_ajax_tc_caf_export_me', array($this, 'tc_caf_export_me'));
        add_action('wp_ajax_nopriv_tc_caf_export_me', array($this, 'tc_caf_export_me'));
        add_action('wp_ajax_tc_caf_import_me', array($this, 'tc_caf_import_me'));
        add_action('wp_ajax_nopriv_tc_caf_import_me', array($this, 'tc_caf_import_me'));
        add_action('wp_ajax_tc_caf_add_custom_layout', array($this, 'tc_caf_add_custom_layout'));
        add_action('wp_ajax_nopriv_tc_caf_add_custom_layout', array($this, 'tc_caf_add_custom_layout'));
        add_action('wp_ajax_tc_caf_get_custom_layout', array($this, 'tc_caf_get_custom_layout'));
        add_action('wp_ajax_nopriv_tc_caf_get_custom_layout', array($this, 'tc_caf_get_custom_layout'));
        add_action('wp_ajax_tc_caf_delete_custom_layout', array($this, 'tc_caf_delete_custom_layout'));
        add_action('wp_ajax_nopriv_tc_caf_delete_custom_layout', array($this, 'tc_caf_delete_custom_layout'));
        add_action('wp_ajax_tc_caf_enhance_data', array($this, 'tc_caf_enhance_data'));
        add_action('wp_ajax_nopriv_tc_caf_enhance_data', array($this, 'tc_caf_enhance_data'));
        //add_action( 'admin_menu' , array($this,'caf_builder_admin_page') );
    }
    public function tc_caf_enhance_data() {
        if (isset($_POST["id"])) {
            $id=$_POST["id"];
            $response = ["status" => "error"];
            if (get_post_meta($id, 'caf_enhance')) {
                $response["status"] ="success";
                $response['enhance']= get_post_meta($id, 'caf_enhance',true);
            }
                echo json_encode($response);
                wp_die();
        }
    }
    public function tc_caf_delete_custom_layout()
    {
        if (isset($_POST["data"])) {
            $data = $_POST["data"];
            $custom_layouts = get_option("caf_custom_post_layout");
            if ($custom_layouts[$data]) {
                unset($custom_layouts[$data]);
                update_option("caf_custom_post_layout", $custom_layouts);
                $response = ["status" => "success"];
            } else {
                $response = ["status" => "error"];
            }
            echo json_encode($response);
            wp_die();
        }
    }

    public function tc_caf_get_custom_layout()
    {
        $custom_layouts = get_option("caf_custom_post_layout");
        $response = ["status" => "success", "layouts" => $custom_layouts];
        echo json_encode($response);
        wp_die();
    }
    public function tc_caf_add_custom_layout()
    {
        if (isset($_POST["data"])) {
            $data = $_POST["data"];
            if (get_option("caf_custom_post_layout")) {
                $custom_layouts = get_option("caf_custom_post_layout");
                $custom_layouts[] = $data;
                update_option("caf_custom_post_layout", $custom_layouts);
            } else {
                $custom_layouts[] = $data;
                update_option("caf_custom_post_layout", $custom_layouts);
            }
            $response = ["status" => "success"];
            echo json_encode($response);
        }
        wp_die();
    }
    public function caf_builder_admin_page()
    {
        add_submenu_page(
            'edit.php?post_type=caf_posts',
            __('Custom Post Layouts - CAF', 'category-ajax-filter'),
            __('Custom Layouts', 'rushhour'),
            'manage_options',
            'caf_custom_layouts',
            array($this, 'caf_builder_admin_page_display'));
    }
    public function caf_builder_admin_page_display()
    {
        // echo "<div class='caf-wrap'>";
        // echo "<div class='caf-builder-main'><h1>Custom Post Layouts</h1></div>";
        // echo "<div class='caf-builder-layouts'>";
        // echo "<div class='caf-builder-add-btn'><input type='text' class='caf-builder-input' placeholder='Add New Layout'><button class='caf-builder-layout-btn caf-builder-layout-add'>+</button></div>";
        // echo "</div>";
        // echo "</div>";
        // echo "<div id='caf-builder-contain'></div>";
        // echo "</div>";
        echo "<div id='caf-builder-contain'></div>";
    }
    public function tc_caf_reset_analytics()
    {
        if (isset($_POST["data"])) {
            $id = $_POST["data"];
            $dt = array();
            if (get_option("caf_performance_" . $id)) {
                delete_option("caf_performance_" . $id);
                if (get_post_meta($id, 'caf_terms')) {
                    $terms_sel = get_post_meta($id, 'caf_terms', true);
                    if ($terms_sel) {
                        $terms_per = $terms_sel;
                        $trms_per = array();
                        foreach ($terms_per as $term1) {
                            if (strpos($term1, '___') !== false) {
                                $ln = strpos($term1, "___");
                                $tx = substr($term1, 0, $ln);
                                $trm = substr($term1, $ln + 3);
                                $trms_per[$tx][] = array("id" => $trm, "clicks" => (int) 0, "today" => array("date" => date("m.d.y"), "clicks" => (int) 0));
                            }
                        }
                        $obj = new CAF_PRO_FILTERS();
                        echo $obj->insertBaseData($trms_per, $id);
                    }
                }
                $dt['result'] = 'success';
            }
            echo json_encode($dt);
            wp_die();
        }
    }
    public function tc_caf_enable_analytics()
    {
        if (isset($_POST["data"])) {
            $id = $_POST["data"];
            $val = $_POST["val"];
            if ($val == 'Enable') {
                if (get_post_meta($id, 'caf_terms')) {
                    $terms_sel = get_post_meta($id, 'caf_terms', true);
                    if ($terms_sel) {
                        $terms_per = $terms_sel;
                        $trms_per = array();
                        foreach ($terms_per as $term1) {
                            if (strpos($term1, '___') !== false) {
                                $ln = strpos($term1, "___");
                                $tx = substr($term1, 0, $ln);
                                $trm = substr($term1, $ln + 3);
                                $trms_per[$tx][] = array("id" => $trm, "clicks" => (int) 0, "today" => array("date" => date("m.d.y"), "clicks" => (int) 0));
                            }
                        }
                        $obj = new CAF_PRO_FILTERS();
                        echo $obj->insertBaseData($trms_per, $id);
                    }
                }
            }
            update_option("caf_enable_analytics_" . $id, $val);
            $dt['result'] = 'success';
            echo json_encode($dt);
            wp_die();
        }
    }

    public function tc_caf_export_me()
    {
        check_ajax_referer('tc_caf_ajax_nonce', 'nonce_ajax');
        $result['result'] = '';
        if (isset($_POST["postId"])) {
            $postid = $_POST["postId"];
            $meta = get_post_meta($postid);
            $meta['result'] = 'success';
            $json = json_encode($meta);
            $file = TC_CAF_PRO_PATH . "admin/json/general.json";
            $fh = fopen($file, 'w') or die("can't open file");
            if (fwrite($fh, $json) == true) {
                fclose($fh);
                $result['result'] = 'success';
                $result['file'] = TC_CAF_PRO_URL . "admin/json/general.json";
                $result['filename'] = "caf-" . $postid;
                echo json_encode($result);
            }
        }
        wp_die();
    }

    public function tc_caf_import_me()
    {
        check_ajax_referer('tc_caf_ajax_nonce', 'nonce_ajax');
        $result['result'] = '';
        if (isset($_POST["postId"])) {
            $postid = $_POST["postId"];
            $target_dir = TC_CAF_PRO_PATH . "admin/json/";
            $target_file = $target_dir . basename($_FILES["file"]["name"]);
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                $data = file_get_contents($target_file);
                $json = json_decode($data, true);
                foreach ($json as $key => $dt) {
                    if (strpos($key, 'caf') !== false) {
                        foreach ($dt as $dta) {
                            if (strpos($dta, ':') !== false) {
                                $dta = unserialize($dta);
                            }
                            //echo $key."\n";
                            //echo $dta;
                            if ($key == 'caf_cpt_value') {
                                if (post_type_exists($dta)) {
                                    update_post_meta($postid, $key, $dta);
                                } else {
                                    update_post_meta($postid, $key, 'post');
                                }
                            } else if ($key == 'caf_taxonomy') {
                                //var_dump($dta);
                                if (isset($dta) && is_array($dta) && !empty($dta)) {
                                    $tx = array();
                                    foreach ($dta as $tax) {
                                        if (taxonomy_exists($tax)) {
                                            $tx[] = $tax;
                                        }
                                    }

                                    update_post_meta($postid, $key, $tx);
                                }
                            } else {
                                update_post_meta($postid, $key, $dta);
                            }
                        }
                    }
                }
                unlink($target_file);
                $result['result'] = 'success';
            } else {
                $result['result'] = 'failed';
            }
            echo json_encode($result);
        }
        wp_die();
    }

    public function tc_caf_get_taxonomy_pro()
    {
        check_ajax_referer('tc_caf_ajax_nonce', 'nonce_ajax');
        if (isset($_POST["cpt"])) {
            $posttype = sanitize_text_field($_POST["cpt"]);
            $id = sanitize_text_field($_POST["post_id"]);
        }
        $data['tax'] = get_object_taxonomies($posttype);
        if (isset($data['tax'][0])) {
            $data['tax1'] = $data['tax'][0];
            if ($data['tax1']) {
                $terms = wp_list_categories(array(
                    'echo' => '0',
                    'show_count' => true,
                    'use_desc_for_title' => false,
                    'hide_empty' => false,
                    'taxonomy' => $data['tax1'],
                    'order' => 'ASC',
                    'orderby' => 'name',
                    'title_li' => '',
                    'style' => 'list',
                ));

//    $terms = get_terms([
                //    'taxonomy' => $data['tax1'],
                //    'hide_empty' => false,
                //]);

                $data['terms'] = $terms;
            } else {
                $data['terms'] = '';
            }
        } else {
            $data['terms'] = '';
        }
        $caf_terms_icon = '';
        if (get_post_meta($id, 'caf_terms_icon')) {
            $caf_terms_icon = get_post_meta($id, 'caf_terms_icon', true);
        }
        $trc = '';
        if (isset($caf_terms_icon)) {
            if (is_array($caf_terms_icon)) {
                $trc = array();
                foreach ($caf_terms_icon as $tr_icon) {
                    if (!empty($tr_icon)) {
                        if (strpos($tr_icon, '(') !== false) {
                            $ln = strpos($tr_icon, "(");
                            $last = strpos($tr_icon, ")");
                            $label = substr($tr_icon, 0, $ln);
                            preg_match('#\((.*?)\)#', $tr_icon, $match);
                            $key = $match[1];
                            $trc[$key] = $label;
                        }
                    }
                }
            }
        }
        $data['trc'] = $trc;
        echo json_encode($data);
        wp_die();
    }
    public function tc_caf_get_terms_pro()
    {
        check_ajax_referer('tc_caf_ajax_nonce', 'nonce_ajax');
        if (isset($_POST["taxonomy"])) {
            $taxonomy = $_POST["taxonomy"];
            $id = $_POST["post_id"];
            $cr_tax = $_POST["cr_tax"];
            $cr_state = $_POST["cr_state"];
        }
        if ($taxonomy) {
            $caf_terms_icon = '';
            if (get_post_meta($id, 'caf_terms_icon')) {
                $caf_terms_icon = get_post_meta($id, 'caf_terms_icon', true);
            }
            if (isset($caf_terms_icon)) {
                if (is_array($caf_terms_icon)) {
                    $trc = array();
                    foreach ($caf_terms_icon as $tr_icon) {
                        if (!empty($tr_icon)) {
                            if (strpos($tr_icon, '(') !== false) {
                                $ln = strpos($tr_icon, "(");
                                $last = strpos($tr_icon, ")");
                                $label = substr($tr_icon, 0, $ln);
                                preg_match('#\((.*?)\)#', $tr_icon, $match);
                                $key = $match[1];
                                $trc[$key] = $label;
                            }
                        }
                    }
                }
            }
            //var_dump($taxonomy);
            //echo $cr_tax; echo $cr_state;
            $taxonomy = array($cr_tax);
            //var_dump($taxonomy);
            foreach ($taxonomy as $tax) {
                echo "<ul class='each-tax-data $tax' data-name='$tax'>";
                echo "<h2 style='display:inline-block;width:100%;font-weight: 600;text-transform: capitalize;padding: 0;margin: 0;'>" . $tax . "</h2><hr style='margin-top:0'>";
//    $terms=get_terms(array('taxonomy' => $tax,'hide_empty' => false));
                // echo "<ul>";
                $terms = wp_list_categories(array(
                    'echo' => '1',
                    'show_count' => true,
                    'use_desc_for_title' => false,
                    'hide_empty' => false,
                    'taxonomy' => $tax,
                    'order' => 'ASC',
                    'orderby' => 'name',
                    'title_li' => '',
                    'style' => 'list',
                ));
                // echo $out;
                // echo "</ul>";

                //var_dump($terms);
                //    if($terms) {
                //    foreach($terms as $term) {
                //  $ic='';
                //  $sel_ic_val='';
                //if(isset($trc)) {
                //  if(isset($trc[$term->term_id])) {
                // $ic=$trc[$term->term_id];
                //   $sel_ic_val=$ic."(".$term->term_id.")";
                //   }
                //}
                //    echo "<li data-id='$term->term_id'><input type='hidden' name='category-list-icon[]' id='hid$term->term_id' class='hid-icon' data-name='category-list-id$term->term_id' data-selected='' value='$sel_ic_val'><input name='category-list[]' class='category-list check' id='category-list-id$term->term_id' type='checkbox' value='".$term->taxonomy."___".$term->term_id."'><label for='category-list-id$term->term_id' class='category-list-label'>".$term->name."</label><div class='caf-selected-ico'><i onclick='removeIcon(this,event)' class='$ic caf-selected-ic'></i></div><span><i class='fa fa-cog' aria-hidden='true'></i></span></li>";
                //    }
                //    }
                echo "</ul>";
            }
        }
        wp_die();
    }
    public function tc_caf_get_terms_pro_def()
    {
        check_ajax_referer('tc_caf_ajax_nonce', 'nonce_ajax');
        if (isset($_POST["taxonomy"])) {
            $taxonomy = $_POST["taxonomy"];
        }
        if ($taxonomy) {
            $terms = get_terms([
                'taxonomy' => $taxonomy,
                'hide_empty' => false,
            ]);
            $data['terms'] = $terms;
        }
        echo json_encode($data);
        wp_die();
    }
    public function tc_caf_post_multiple_taxonomies_fun($taxo, $tax, $select)
    {
        include TC_CAF_PRO_PATH . 'admin/tabs/variables.php';
        include_once TC_CAF_PRO_PATH . 'admin/tabs/general/taxonomies.php';
    }
    public function tc_caf_after_caf_empty_result_row_fun()
    {
        include TC_CAF_PRO_PATH . 'admin/tabs/variables.php';
        include_once TC_CAF_PRO_PATH . 'admin/tabs/appearance/meta-info.php';
    }
    public function caf_manage_sorting_fun()
    {
        include TC_CAF_PRO_PATH . 'admin/tabs/variables.php';
        //include_once TC_CAF_PRO_PATH . 'includes/sortings.php';
    }
    public function tc_caf_post_multiple_taxonomies_terms_fun($tax, $terms_sel)
    {
        include TC_CAF_PRO_PATH . 'admin/tabs/variables.php';
        include_once TC_CAF_PRO_PATH . 'admin/tabs/general/taxonomies-terms.php';
    }
    public function tc_caf_after_caf_post_pagi_tab()
    {
        include TC_CAF_PRO_PATH . 'admin/tabs/variables.php';
        include_once TC_CAF_PRO_PATH . 'admin/tabs/appearance/sorting.php';
    }
    public function tc_caf_after_caf_post_class_tab()
    {
        include TC_CAF_PRO_PATH . 'admin/tabs/variables.php';
        include_once TC_CAF_PRO_PATH . 'admin/tabs/advanced/scroll.php';
    }
    public function trusty_save_meta_box($post_id, $post)
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        if (!current_user_can('edit_posts', $post_id)) {
            return $post_id;
        }
        if (!isset($_POST['caf_post_meta_option']) || !wp_verify_nonce($_POST['caf_post_meta_option'], basename(__FILE__))) {
            return $post_id;
        }
        if (isset($_POST['vertical-expand'])) {
            $tax_val = $_POST['vertical-expand'];
            update_post_meta($post_id, 'vertical-expand', $tax_val);
        } else {
            update_post_meta($post_id, 'vertical-expand', []);
        }
        $enhance='0';
        if (isset($_POST['check-enhanced'])) {
            $enhance = $_POST['check-enhanced'];
        }
        update_post_meta($post_id, 'caf_enhance', $enhance);
        if (isset($_POST['caf-taxonomy'])) {
            $tax_val = $_POST['caf-taxonomy'];
            update_post_meta($post_id, 'caf_taxonomy', $tax_val);
        }
        if (isset($_POST['category-list-icon'])) {
            $terms_icon = $_POST['category-list-icon'];
            update_post_meta($post_id, 'caf_terms_icon', $terms_icon);
        }

        if (isset($_POST['caf-post-orders-by'])) {
            $caf_orders_by = sanitize_text_field($_POST['caf-post-orders-by']);
            update_post_meta($post_id, 'caf_post_orders_by', $caf_orders_by);
        }
        if (isset($_POST['caf-posts-order-type'])) {
            $caf_post_order_type = sanitize_text_field($_POST['caf-posts-order-type']);
            update_post_meta($post_id, 'caf_post_order_type', $caf_post_order_type);
        }
        if (isset($_POST['caf-prev-text'])) {
            $caf_prev_text = sanitize_text_field($_POST['caf-prev-text']);
            update_post_meta($post_id, 'caf_prev_text', $caf_prev_text);
        }
        if (isset($_POST['caf-next-text'])) {
            $caf_next_text = sanitize_text_field($_POST['caf-next-text']);
            update_post_meta($post_id, 'caf_next_text', $caf_next_text);
        }
        if (isset($_POST['caf-load-more-text'])) {
            $caf_load_more_text = sanitize_text_field($_POST['caf-load-more-text']);
            update_post_meta($post_id, 'caf_load_more_text', $caf_load_more_text);
        }
        if (isset($_POST['caf-pagination-status'])) {
            $pagination_status = sanitize_text_field($_POST['caf-pagination-status']);
            update_post_meta($post_id, 'caf_pagination_status', $pagination_status);
        }
        if (isset($_POST['caf-post-desc-font'])) {
            $caf_post_desc_font = sanitize_text_field($_POST['caf-post-desc-font']);
            update_post_meta($post_id, 'caf_post_desc_font', $caf_post_desc_font);
        }
        if (isset($_POST['caf-post-desc-transform'])) {
            $caf_post_desc_transform = sanitize_text_field($_POST['caf-post-desc-transform']);
            update_post_meta($post_id, 'caf_post_desc_transform', $caf_post_desc_transform);
        }
        if (isset($_POST['caf-post-desc-font-size'])) {
            $caf_post_desc_font_size = sanitize_text_field($_POST['caf-post-desc-font-size']);
            update_post_meta($post_id, 'caf_post_desc_font_size', $caf_post_desc_font_size);
        }
        if (isset($_POST['caf-filter-more'])) {
            $caf_filter_more_btn = sanitize_text_field($_POST['caf-filter-more']);
            update_post_meta($post_id, 'caf_filter_more_btn', $caf_filter_more_btn);
        }
        if (isset($_POST['caf-filter-more-val'])) {
            $caf_filter_more_val = sanitize_text_field($_POST['caf-filter-more-val']);
            update_post_meta($post_id, 'caf_filter_more_val', $caf_filter_more_val);
        }
        if (isset($_POST['caf-filter-search'])) {
            $caf_filter_search = sanitize_text_field($_POST['caf-filter-search']);
            update_post_meta($post_id, 'caf_filter_search', $caf_filter_search);
        }
        if (isset($_POST['caf-filter-search-layout'])) {
            $caf_filter_search_layout = sanitize_text_field($_POST['caf-filter-search-layout']);
            update_post_meta($post_id, 'caf_filter_search_layout', $caf_filter_search_layout);
        }
        if (isset($_POST['default-all-text'])) {
            $default_all_text = sanitize_text_field($_POST['default-all-text']);
            update_post_meta($post_id, 'caf_default_all_text', $default_all_text);
        }
        if (isset($_POST['caf-want-to-check'])) {
            $caf_want_to_check = sanitize_text_field($_POST['caf-want-to-check']);
            update_post_meta($post_id, 'caf_want_to_check', $caf_want_to_check);
        }
        if (isset($_POST['caf-check-everything'])) {
            $caf_check_everything = sanitize_text_field($_POST['caf-check-everything']);
            update_post_meta($post_id, 'caf_check_everything', $caf_check_everything);
        }
        if (isset($_POST['caf-filter-relation'])) {
            $caf_filter_relation = sanitize_text_field($_POST['caf-filter-relation']);
            update_post_meta($post_id, 'caf_filter_relation', $caf_filter_relation);
        }
        if (isset($_POST['caf-read-more-text'])) {
            $caf_read_more_text = sanitize_text_field($_POST['caf-read-more-text']);
            update_post_meta($post_id, 'caf_read_more_text', $caf_read_more_text);
        }
        if (isset($_POST['caf-f-p-text'])) {
            $caf_f_p_text = sanitize_text_field($_POST['caf-f-p-text']);
            update_post_meta($post_id, 'caf_f_p_text', $caf_f_p_text);
        }
        if (isset($_POST['search-submit-button'])) {
            $caf_search_button = sanitize_text_field($_POST['search-submit-button']);
            update_post_meta($post_id, 'caf_search_button', $caf_search_button);
        }
        if (isset($_POST['caf-default-term'])) {
            $caf_default_term = sanitize_text_field($_POST['caf-default-term']);
            update_post_meta($post_id, 'caf_default_term', $caf_default_term);
        }
        if (isset($_POST['caf-cats-relation'])) {
            $caf_cats_relation = sanitize_text_field($_POST['caf-cats-relation']);
            update_post_meta($post_id, 'caf_cats_relation', $caf_cats_relation);
        }
        if (isset($_POST['caf-taxo-relation'])) {
            $caf_taxo_relation = sanitize_text_field($_POST['caf-taxo-relation']);
            update_post_meta($post_id, 'caf_taxo_relation', $caf_taxo_relation);
        }
        if (isset($_POST['caf-all-ed'])) {
            $caf_all_ed = sanitize_text_field($_POST['caf-all-ed']);
            update_post_meta($post_id, 'caf_all_ed', $caf_all_ed);
        }
        if (isset($_POST['caf-term-dy'])) {
            $caf_term_dy = sanitize_text_field($_POST['caf-term-dy']);
            update_post_meta($post_id, 'caf_term_dy', $caf_term_dy);
        }
        if (isset($_POST['caf-scroll-to-div'])) {
            $caf_scroll_to_div = sanitize_text_field($_POST['caf-scroll-to-div']);
            update_post_meta($post_id, 'caf_scroll_to_div', $caf_scroll_to_div);
        }
        if (isset($_POST['caf-scroll-to-div-desktop'])) {
            $caf_scroll_to_div_desktop = sanitize_text_field($_POST['caf-scroll-to-div-desktop']);
            update_post_meta($post_id, 'caf_scroll_to_div_desktop', $caf_scroll_to_div_desktop);
        }
        if (isset($_POST['caf-scroll-to-div-mobile'])) {
            $caf_scroll_to_div_mobile = sanitize_text_field($_POST['caf-scroll-to-div-mobile']);
            update_post_meta($post_id, 'caf_scroll_to_div_mobile', $caf_scroll_to_div_mobile);
        }
        if (isset($_POST['caf-hor-button-text'])) {
            $caf_hor_button_text = sanitize_text_field($_POST['caf-hor-button-text']);
            update_post_meta($post_id, 'caf_hor_button_text', $caf_hor_button_text);
        }
        if (isset($_POST['caf-post-author'])) {
            $caf_post_author = sanitize_text_field($_POST['caf-post-author']);
            update_post_meta($post_id, 'caf_post_author', $caf_post_author);
        }
        if (isset($_POST['caf-post-date'])) {
            $caf_post_date = sanitize_text_field($_POST['caf-post-date']);
            update_post_meta($post_id, 'caf_post_date', $caf_post_date);
        }
        if (isset($_POST['caf-term-parent-tab'])) {
            $caf_term_parent_tab = $_POST['caf-term-parent-tab'];
            update_post_meta($post_id, 'caf_term_parent_tab', $caf_term_parent_tab);
        }
        if (isset($_POST['caf-post-comments'])) {
            $caf_post_comments = sanitize_text_field($_POST['caf-post-comments']);
            update_post_meta($post_id, 'caf_post_comments', $caf_post_comments);
        }
        if (isset($_POST['caf-post-cats'])) {
            $caf_post_cats = sanitize_text_field($_POST['caf-post-cats']);
            update_post_meta($post_id, 'caf_post_cats', $caf_post_cats);
        }
        if (isset($_POST['caf-post-rd'])) {
            $caf_post_rd = sanitize_text_field($_POST['caf-post-rd']);
            update_post_meta($post_id, 'caf_post_rd', $caf_post_rd);
        }
        if (isset($_POST['caf-post-dsc'])) {
            $caf_post_dsc = sanitize_text_field($_POST['caf-post-dsc']);
            update_post_meta($post_id, 'caf_post_dsc', $caf_post_dsc);
        }
        if (isset($_POST['caf-post-title'])) {
            $caf_post_title = sanitize_text_field($_POST['caf-post-title']);
            update_post_meta($post_id, 'caf_post_title', $caf_post_title);
        }
        if (isset($_POST['caf-post-image'])) {
            $caf_post_image = sanitize_text_field($_POST['caf-post-image']);
            update_post_meta($post_id, 'caf_post_image', $caf_post_image);
        }
        if (isset($_POST['cum-css'])) {
            $cm_settings = sanitize_textarea_field($_POST['cum-css']);
            update_post_meta($post_id, 'caf_cum_css', $cm_settings);
        }
        if (isset($_POST['caf-post-date-format'])) {
            $caf_post_date_format = sanitize_textarea_field($_POST['caf-post-date-format']);
            update_post_meta($post_id, 'caf_post_date_format', $caf_post_date_format);
        }
    }
    public function tc_caf_pro_after_caf_pagi_type_row()
    {
        include TC_CAF_PRO_PATH . 'admin/tabs/variables.php';
        include_once TC_CAF_PRO_PATH . 'admin/tabs/appearance/pagination.php';
    }
    public function tc_caf_pro_after_caf_per_page_row()
    {
        include TC_CAF_PRO_PATH . 'admin/tabs/variables.php';
        include_once TC_CAF_PRO_PATH . 'admin/tabs/appearance/pagination-enable.php';
    }
    public function tc_caf_pro_after_caf_post_typo_row()
    {
        include TC_CAF_PRO_PATH . 'admin/tabs/variables.php';
        include_once TC_CAF_PRO_PATH . 'admin/tabs/typography/post-description-typo.php';
    }
    public function tc_caf_under_manage_filters_row_fun()
    {
        include TC_CAF_PRO_PATH . 'admin/tabs/variables.php';
        include_once TC_CAF_PRO_PATH . 'admin/tabs/layouts/multiple-checkbox-relation.php';
    }
    public function tc_caf_pro_after_caf_filter_color_row()
    {
        include TC_CAF_PRO_PATH . 'admin/tabs/variables.php';
        include_once TC_CAF_PRO_PATH . 'admin/tabs/appearance/filter-more-button.php';
    }
    public function tc_caf_in_import_tab_fun()
    {
        include TC_CAF_PRO_PATH . 'admin/tabs/variables.php';
        include_once TC_CAF_PRO_PATH . 'admin/tabs/import/import.php';
    }
    public function caf_duplicate_filter_as_draft()
    {
        global $wpdb;
        if (!(isset($_GET['post']) || isset($_POST['post']) || (isset($_REQUEST['action']) && 'caf_duplicate_filter_as_draft' == $_REQUEST['action']))) {
            wp_die('No Filter post to duplicate has been supplied!');
        }
        /*
         * Nonce verification
         */
        if (!isset($_GET['duplicate_nonce']) || !wp_verify_nonce($_GET['duplicate_nonce'], basename(__FILE__))) {
            return;
        }

        /*
         * get the original post id
         */
        $post_id = (isset($_GET['post']) ? absint($_GET['post']) : absint($_POST['post']));
        /*
         * and all the original post data then
         */
        $post = get_post($post_id);
        /*
         * if you don't want current user to be the new post author,
         * then change next couple of lines to this: $new_post_author = $post->post_author;
         */
        $current_user = wp_get_current_user();
        $new_post_author = $current_user->ID;
        /*
         * if post data exists, create the post duplicate
         */
        if (isset($post) && $post != null) {
            /*
             * new post data array
             */
            $args = array(
                'comment_status' => $post->comment_status,
                'ping_status' => $post->ping_status,
                'post_author' => $new_post_author,
                'post_content' => $post->post_content,
                'post_excerpt' => $post->post_excerpt,
                'post_name' => $post->post_name,
                'post_parent' => $post->post_parent,
                'post_password' => $post->post_password,
                'post_status' => 'draft',
                'post_title' => $post->post_title . "- Copy",
                'post_type' => $post->post_type,
                'to_ping' => $post->to_ping,
                'menu_order' => $post->menu_order,
            );
            /*
             * insert the post by wp_insert_post() function
             */
            $new_post_id = wp_insert_post($args);

            /*
             * get all current post terms ad set them to the new post draft
             */
            $taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
            foreach ($taxonomies as $taxonomy) {
                $post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
                wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
            }
            /*
             * duplicate all post meta just in two SQL queries
             */
            $post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
            if (count($post_meta_infos) != 0) {
                $sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
                foreach ($post_meta_infos as $meta_info) {
                    $meta_key = $meta_info->meta_key;
                    if ($meta_key == '_wp_old_slug') {
                        continue;
                    }

                    $meta_value = addslashes($meta_info->meta_value);
                    $sql_query_sel[] = "SELECT $new_post_id, '$meta_key', '$meta_value'";
                }
                $sql_query .= implode(" UNION ALL ", $sql_query_sel);
                $wpdb->query($sql_query);
            }
            /*
             * finally, redirect to the edit post screen for the new draft
             */
            wp_redirect(admin_url('post.php?action=edit&post=' . $new_post_id));
            exit;
        } else {
            wp_die('Post creation failed, could not find original post: ' . $post_id);
        }
    }
    public function caf_after_filter_layout_fun($id, $b)
    {
        $caf_filter_search = 'off';
        $caf_f_p_text = 'Search Here....';
        $caf_search_button = "Search";
        $caf_filter_search_layout = 'search-layout1';
        if (get_post_meta($id, 'caf_search_button')) {
            $caf_search_button = get_post_meta($id, 'caf_search_button', true);
        }
        if (get_post_meta($id, 'caf_filter_search')) {
            $caf_filter_search = get_post_meta($id, 'caf_filter_search', true);
        }
        if (get_post_meta($id, 'caf_filter_search_layout')) {
            $caf_filter_search_layout = get_post_meta($id, 'caf_filter_search_layout', true);
        }
        if (get_post_meta($id, 'caf_f_p_text')) {
            $caf_f_p_text = get_post_meta($id, 'caf_f_p_text', true);
        }
        $caf_filter_search_layout1 = $caf_filter_search_layout . ".php";
        $template_path = "category-ajax-filter/layouts/filter/search/";
        $default_path = TC_CAF_PRO_PATH . "includes/layouts/filter/search/";
        if ($caf_filter_search == 'on') {
            $filepath = wcpt_get_template($caf_filter_search_layout1, "", $template_path, $default_path);
            if (file_exists($filepath)) {
                include $filepath;
            } else {echo "Search Layout is not Available.";}
        }
    }
    public function tc_caf_popup_option_fun($caf_link_target)
    {
        if ($caf_link_target == 'popup') {
            $sl = 'selected';
        }
        echo "<option value='popup' $sl>PopUp</option>";
    }
    public function tc_caf_after_caf_post_animation_tab_fun()
    {
        include TC_CAF_PRO_PATH . 'admin/tabs/variables.php';
        include_once TC_CAF_PRO_PATH . 'admin/tabs/appearance/translation.php';
    }
    public function tc_caf_after_caf_post_terms_row_fun($terms)
    {
        include TC_CAF_PRO_PATH . 'admin/tabs/variables.php';
        include_once TC_CAF_PRO_PATH . 'admin/tabs/general/default-term.php';
    }
}
class CAF_PRO_FILTERS
{
    public function __construct()
    {
        add_action('admin_enqueue_scripts', array($this, 'tc_pro_caf_embedCssJs'));
        $this->remove_class_filter("wp_ajax_get_filter_posts", "CAF_get_filter_posts", "get_filter_posts");
        $this->remove_class_filter("wp_ajax_nopriv_get_filter_posts", "CAF_get_filter_posts", "get_filter_posts");
        remove_shortcode("caf_filter");
        $this->remove_class_filter("the_posts", "CAF_load_scripts", "conditionally_add_scripts_and_styles");
        $this->remove_class_filter("wp_enqueue_scripts", "CAF_load_scripts", "tc_caf_enqueue_scripts");
        add_action('wp_ajax_get_filter_posts', array($this, 'get_filter_posts_pro'));
        add_action('wp_ajax_nopriv_get_filter_posts', array($this, 'get_filter_posts_pro'));
        add_action('wp_ajax_get_filter_post', array($this, 'get_filter_post_pro'));
        add_action('wp_ajax_nopriv_get_filter_post', array($this, 'get_filter_post_pro'));
        add_shortcode("caf_filter", array($this, "caf_pro_filter_call"));
        add_filter('the_posts', array($this, 'conditionally_add_scripts_and_styles_pro'));
        add_action('wp_enqueue_scripts', array($this, 'tc_caf_enqueue_scripts_pro'));
        add_filter("tc_caf_filter_prev_text", array($this, "tc_caf_pro_filter_prev_text"), 70, 2);
        add_filter("tc_caf_filter_next_text", array($this, "tc_caf_pro_filter_next_text"), 70, 2);
    }
    public function tc_pro_caf_embedCssJs()
    {
        global $post_type,$hook_suffix;
        if ($post_type == "caf_posts") {
            wp_dequeue_script("tc-caf-script");
            wp_enqueue_script('tc-caf-pro-script', TC_CAF_PRO_URL . 'admin/js/custom.js', array('jquery'));
            wp_localize_script('tc-caf-pro-script', 'tc_caf_ajax', array('ajax_url' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('tc_caf_ajax_nonce'), 'plugin_path' => TC_CAF_PRO_URL));
            wp_enqueue_script('tc-caf-pro-script-ui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', array('jquery'));
            wp_enqueue_style('tc-caf-font-awesome-all-style', TC_CAF_URL . 'assets/css/fontawesome/css/all.min.css', '', TC_CAF_PLUGIN_VERSION);
        }

        if ($hook_suffix == "caf_posts_page_caf_custom_layouts") {
            wp_enqueue_script('tc-caf-pro-builder-script', TC_CAF_PRO_URL . 'admin/js/custom-builder.js', array('jquery', 'wp-element'));
            wp_localize_script('tc-caf-pro-builder-script', 'tc_caf_ajax', array('ajax_url' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('tc_caf_ajax_nonce'), 'plugin_path' => TC_CAF_PRO_URL, 'site_base_url' => site_url()));
            wp_enqueue_style('tc-caf-font-awesome-all-style', TC_CAF_URL . 'assets/css/fontawesome/css/all.min.css', '', TC_CAF_PLUGIN_VERSION);
        }
    }
    public function caf_pro_filter_call($atts)
    {
        ob_start();
        $caf_filter = new CAF_front_filter();
        static $b = 1;
        $atts = shortcode_atts(array(
            'id' => '',
        ), $atts);
        $id = $atts['id'];
        if (!get_post_meta($id, 'caf_taxonomy')) {
            return "<h2 style='background: #333348;color: #fff;font-size: 14px;line-height: 18px;padding: 10px;margin: 0;width: 100%;display: inline-block;text-align: center;border: none;text-shadow: none;box-shadow: none;'>" . esc_html__('Please select Taxonomy from specific CAF Filter. It is required to properly work for your Filter.', 'category-ajax-filter-pro') . "</h2>";
        }
        if (!get_post_meta($id, 'caf_terms')) {
            return "<h2 style='background: #333348;color: #fff;font-size: 14px;line-height: 18px;padding: 10px;margin: 0;width: 100%;display: inline-block;text-align: center;border: none;text-shadow: none;box-shadow: none;'>" . esc_html__('Please select Categories/Terms from specific CAF Filter. It is required to properly work for your Filter.', 'category-ajax-filter-pro') . "</h2>";
        }
        if (get_post_meta($id, 'caf_taxonomy')) {
            $tax = get_post_meta($id, 'caf_taxonomy', true);
            if (!empty($tax) && !is_array($tax)) {
                $tax = array($tax);
                if (get_post_meta($id, 'caf_terms', true)) {
                    $terms_sel = get_post_meta($id, 'caf_terms', true);
                    $terms_sel_def = $terms_sel;
                    $terms_sel = array();
                    foreach ($terms_sel_def as $index => $trm) {
                        $terms_sel[] = get_post_meta($id, 'caf_taxonomy', true) . "___" . $trm;
                    }
                    update_post_meta($id, 'caf_taxonomy', $tax);
                    $tax = get_post_meta($id, 'caf_taxonomy', true);
                    update_post_meta($id, 'caf_terms', $terms_sel);
                }
            }

        }
        include TC_CAF_PRO_PATH . 'includes/front-variables.php';
        include TC_CAF_PRO_PATH . 'includes/script-and-styles.php';
        if (($id && !empty($id) && get_post_type($id) == 'caf_posts' && is_numeric($id))) {
            if ($caf_filter_layout == 'filter-layout3') {$cl = 'sidebar';} else { $cl = '';}
            $pcl = '';
            if ($caf_link_target == 'popup') {$pcl = 'popup-active';}
            $caf_filter_relation = 'IN';
            if ($caf_filter_layout == "multiple-checkbox") {
                $caf_filter_relation = 'IN';
                if (get_post_meta($id, 'caf_filter_relation')) {
                    $caf_filter_relation = get_post_meta($id, 'caf_filter_relation', true);
                }
            }
            if ($caf_filter_layout == "alphabetical-layout") {
                $trm = 'all';
                $trm = apply_filters('tc_caf_filter_default_alpha', $trm, $id);
            }
            if (!is_array($tax)) {
                $tax = explode(",", $tax);
            }
            $tax = implode(",", $tax);
            $postid = '';
            if (get_the_id()) {
                $postid = get_the_id();
            }
            //var_dump($trm);
            //echo $b;
            $handle = "tc-caf-dynamic-style-" . $caf_filter_layout . "_" . $b;
            wp_enqueue_style($handle, TC_CAF_URL . '/assets/css/dynamic-styles.css');
            // if (str_contains($caf_post_layout, '_')) {
            //     include_once TC_CAF_PRO_PATH . '/includes/caf-builder-styles.php';
            // }
            // $handle = "tc-caf-dynamic-style-builder-layout";
            // wp_enqueue_style($handle, TC_CAF_PRO_URL . '/assets/css/dynamic-styles.css');
            setDynamicFilterCss($id, $handle, $caf_filter_layout, $b, 'shortcode');
            setDynamicFilterCss($id, $handle, $caf_filter_layout, $b, 'options');
            echo '<div id="caf-post-layout-container" class="caf-post-layout-container ' . esc_attr($cl) . '
     ' . esc_attr($caf_filter_layout) . ' ' . esc_attr($caf_post_layout) . ' ' . esc_attr($pcl) . '
     data-target-div' . esc_attr($b) . '"
     data-post-type="' . esc_attr($caf_cpt_value) . '"
     data-tax="' . esc_attr($tax) . '"
     data-terms="' . esc_attr($trm) . '"
     data-per-page="' . esc_attr($caf_per_page) . '"
     data-selected-terms="' . esc_attr($trm2) . '"
     data-filter-id="' . esc_attr($id) . '"
     data-post-layout="' . esc_attr($caf_post_layout) . '"
     data-filter-layout="' . esc_attr($caf_filter_layout) . '"
     data-target-div="data-target-div' . esc_attr($b) . '"
     data-relation="' . esc_attr($caf_filter_relation) . '"
     data-default-term="' . esc_attr($caf_default_term) . '"
     data-scroll="' . esc_attr($caf_scroll_to_div) . '"
     data-scroll-desk="' . esc_attr($caf_scroll_to_div_desktop) . '"
     data-scroll-mob="' . esc_attr($caf_scroll_to_div_mobile) . '"
     current-post-id="' . esc_attr($postid) . '">';
            if ($caf_filter_status == 'on' && $caf_post_layout != "carousel-slider") {
                if ($caf_filter_layout && strlen($caf_filter_layout) > 13) {
                    //$filepath=TC_CAF_PATH."includes/layouts/filter/".$caf_filter_layout.".php";
                    $flayout = $caf_filter_layout . ".php";
                    $template_path = "category-ajax-filter/layouts/filter/";

                    if ($flayout == "filter-layout1.php" || $flayout == "filter-layout2.php" || $flayout == "filter-layout3.php") {
                        $default_path = TC_CAF_PATH . "includes/layouts/filter/";
                    } else {
                        $default_path = TC_CAF_PRO_PATH . "includes/layouts/filter/";
                    }
                    $filepath = wcpt_get_template($flayout, "", $template_path, $default_path);
                    if (file_exists($filepath)) {
                        //echo $caf_filter_layout;
                        if (($caf_filter_layout == "multiple-taxonomy-filter") || ($caf_filter_layout == "multiple-taxonomy-filter-hor") || ($caf_filter_layout == "multiple-taxonomy-filter-hor-modern") || ($caf_filter_layout == "parent-child-filter")) {
                            $trm = implode(",", $terms_sel_tax);
                        }
                        include $filepath;
                    } else {
                        echo "<div class='error-of-filter-layout error-caf'>" . esc_html__('Filter Layout is not Available.', 'category-ajax-filter-pro') . "</div>";
                    }
                }
            }
            setDynamicFilterCss($id, $handle, $caf_post_layout, $b, 'shortcode');
            do_action('caf_manage_sorting');
            echo "<div id='manage-ajax-response' class='caf-row'>";
            if ($caf_post_layout && strlen($caf_post_layout) > 11) {
                echo '<div class="status"><i class="fa fa-spinner" aria-hidden="true"></i></div>';
                echo '<div class="content"></div>';
            }
            echo "</div>";
            echo "</div>";
        } else {
            if (empty($id)) {
                echo "<div class='error-of-missing-id error-caf'>" . esc_html__('Nothing Found, Missing id as an argument.', 'category-ajax-filter-pro') . ' <a href="https://caf.trustyplugins.com/docs/documentation/getting-started/" target="_blank">' . esc_html__('See Documentation', 'category-ajax-filter-pro') . "</a></div>";
            } else {
                echo "<div class='error-of-missing-id error-caf'>" . esc_html__('Nothing Found, ID Mismatched.', 'category-ajax-filter-pro') . ' <a href="https://caf.trustyplugins.com/docs/documentation/getting-started/" target="_blank">' . esc_html__('See Documentation', 'category-ajax-filter-pro') . "</a></div>";
            }
        }
        $output = ob_get_contents();
        ob_end_clean();
        $b++;
        return $output;
    }
    public function insertBaseData($trms_per, $filter_id)
    {
        //var_dump($trms_per);
        if (!get_option("caf_performance_" . $filter_id)) {
            $clicks = (int) 0;
            $per_arr = array("clicks" => $clicks, array("cats" => $trms_per));
            update_option("caf_performance_" . $filter_id, $per_arr);
        } else {
            $opt_arr = get_option("caf_performance_" . $filter_id, true);
            foreach ($trms_per as $index => $tr) {
                if (!isset($opt_arr[0]['cats'][$index])) {
                    $opt_arr[0]['cats'][$index] = $tr;
                }
            }
            update_option("caf_performance_" . $filter_id, $opt_arr);
        }
    }
    public function initialAnalyticsData($terms_per, $filter_id, $caf_perform, $caf_perform_term)
    {
        if (!empty($caf_perform_term)) {
            $terms_per = array($caf_perform_term);
        }
        $trms_per = array();
        foreach ($terms_per as $term1) {
            if (strpos($term1, '___') !== false) {
                $ln = strpos($term1, "___");
                $tx = substr($term1, 0, $ln);
                $trm = substr($term1, $ln + 3);
                $trms_per[$tx][] = array("id" => $trm, "clicks" => (int) 0, "today" => array("date" => date("m.d.y"), "clicks" => (int) 0));
            }
        }
        echo $this->insertBaseData($trms_per, $filter_id);
        $opt_arr = get_option("caf_performance_" . $filter_id, true);
        if (!empty($caf_perform) && $caf_perform != 'filter-all' && $caf_perform != 'pagination') {
            $clks = (int) $opt_arr['clicks'];
            $clicks = $clks + 1;
            $opt_arr['clicks'] = $clicks;
            foreach ($trms_per as $index => $tr) {
                if (isset($opt_arr[0]['cats'][$index])) {
                    $cats_id = $opt_arr[0]['cats'][$index];
                    foreach ($cats_id as $i => $cat_id) {
                        if ($cat_id['id'] == $tr[0]['id']) {
                            //var_dump($cat_id);
                            $cat_id['clicks'] = $cat_id['clicks'] + 1;
                            if ($cat_id['today']['date'] == date("m.d.y")) {
                                $td_cl = $cat_id['today']['clicks'] + 1;
                            } else {
                                $opt_arr[0]['cats'][$index][$i]['today']['date'] = date("m.d.y");
                                $td_cl = 1;
                            }
                            $opt_arr[0]['cats'][$index][$i]['today']['clicks'] = $td_cl;
                            $opt_arr[0]['cats'][$index][$i]['clicks'] = $cat_id['clicks'];
                        }
                    }
                }
            }
            update_option("caf_performance_" . $filter_id, $opt_arr);
        }
    }
    public function get_filter_posts_pro()
    {
        ob_start();
        //var_dump($_POST['params']);
        $filter_id = sanitize_text_field($_POST['params']['filter-id']);
        $caf_security = 'disable';
        if (get_post_meta($filter_id, "caf_special_security", true)) {
            $caf_security = get_post_meta($filter_id, "caf_special_security", true);
        }
        $caf_cats_relation = 'IN';
        if (get_post_meta($filter_id, "caf_cats_relation", true)) {
            $caf_cats_relation = get_post_meta($filter_id, "caf_cats_relation", true);
        }

        if ($caf_security == 'enable') {
            if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'tc_caf_ajax_nonce')) {
                die('Permission denied');
            }

        }
/*** Default response ***/
        $response = [
            'status' => 500,
            'message' => 'Something is wrong, please try again later ...',
            'content' => false,
            'found' => 0,
        ];
        $caf_perform = '';
        if (isset($_POST['params']['caf-perform'])) {
            $caf_perform = sanitize_text_field($_POST['params']['caf-perform']);
        }
        $caf_perform_term = '';
        if (isset($_POST['params']['caf-perform-term'])) {
            $caf_perform_term = sanitize_text_field($_POST['params']['caf-perform-term']);
        }
        $tax = sanitize_text_field($_POST['params']['tax']);
        $post_type = sanitize_text_field($_POST['params']['post-type']);
        $term = sanitize_text_field($_POST['params']['term']);
        $page = intval($_POST['params']['page']);
        $per_page = intval($_POST['params']['per-page']);
        $caf_post_layout = sanitize_text_field($_POST['params']['caf-post-layout']);
        $target_div = sanitize_text_field($_POST['params']['data-target-div']);
        $caf_filter_layout = sanitize_text_field($_POST['params']['data-filter-layout']);
        $caf_relation = sanitize_text_field($_POST['params']['data-relation']);
        $caf_default_term = sanitize_text_field($_POST['params']['data-default-term']);
        $caf_crnt_id = sanitize_text_field($_POST['params']['current-post-id']);
        $caf_default_first = '';
        //date_default_timezone_set('NZ');
        //echo date("m.d.y");
        //var_dump($term,$tax);
        // var_dump($opt_arr,$term);
        $terms_per = explode(',', $term);
        $status = 'Disable';
        if (get_option('caf_enable_analytics_' . $filter_id)) {
            $status = get_option('caf_enable_analytics_' . $filter_id);
        }
        //echo $status;
        if ($status == 'Enable') {
            echo $this->initialAnalyticsData($terms_per, $filter_id, $caf_perform, $caf_perform_term);
        }
        $opt_arr = get_option("caf_performance_" . $filter_id, true);
//   echo "<pre>";
        //   print_r($opt_arr);
        //   echo "/<pre>";
        if (isset($_POST['params']['first'])) {
            $caf_default_first = sanitize_text_field($_POST['params']['first']);
        }
        if ($caf_filter_layout == "multiple-checkbox") {
            $ope = "IN";
        } else if ($caf_filter_layout == "multiple-checkbox2") {
            $ope = $caf_relation;
            if ($ope == 'OR') {$ope = 'IN';}
        } else {
            $ope = $caf_cats_relation;
        }
        $ope = apply_filters('tc_caf_multiple_check_filter_relation', $ope, $filter_id);
        //echo $ope;
        //if($per_page=='-1') {$per_page='5';}
        /*** Check if term exists ***/
        $terms = explode(',', $term);
        if (!is_array($terms)) {
            $response = [
                'status' => 501,
                'message' => 'Term doesn\'t exist',
                'content' => 0,
            ];
            die(json_encode($response));
        } else {
            $tax = explode(',', $tax);
            //var_dump($tax);
            if ($terms == 'all') {$opr = "IN";} else { $opr = $ope;}
            //var_dump($terms);
            if (is_array($tax)) {
                //var_dump($terms);
                $trms = array();
                foreach ($terms as $term) {
                    if (strpos($term, '___') !== false) {
                        $ln = strpos($term, "___");
                        $tx = substr($term, 0, $ln);
                        $trm = substr($term, $ln + 3);
                        $trms[$tx][] = $trm;
                    }
                }
                $tx1 = array();
                foreach ($tax as $tx) {
                    if (isset($trms[$tx])) {
                        $tx1[] = array('taxonomy' => $tx, 'field' => 'term_id', 'terms' => $trms[$tx], 'operator' => $ope);
                    }
                }
            }
            if ($caf_default_first) {
                if ($caf_default_term) {
                    if ($caf_default_term != 'all') {
                        if (strpos($caf_default_term, '___') !== false) {
                            $ln = strpos($caf_default_term, "___");
                            $tx = substr($caf_default_term, 0, $ln);
                            $trm = substr($caf_default_term, $ln + 3);
                            $trms3[$tx] = $trm;
                        }
                        $tx1 = array();
                        $tx1[] = array('taxonomy' => $tx, 'field' => 'term_id', 'terms' => $trms3[$tx], 'operator' => $ope);
                    }
                }
            }
            $caf_taxo_relation = "OR";
// echo $caf_filter_layout;
            if ($caf_filter_layout == "multiple-taxonomy-filter") {
                $caf_taxo_relation = "OR";
            } else if ($caf_filter_layout == "multiple-taxonomy-filter2") {
                if (get_post_meta($filter_id, 'caf_taxo_relation')) {
                    $caf_taxo_relation = get_post_meta($filter_id, 'caf_taxo_relation', true);
                }
            } else {
                $caf_taxo_relation = 'OR';
            }
            //echo $caf_taxo_relation;
            //var_dump($term);
            $tx1['relation'] = $caf_taxo_relation;
            $tax_qry = $tx1;
            $tax_qry = apply_filters('tc_caf_filter_posts_tax_query', $tax_qry, $filter_id, $terms);
        }
        $default_order_by = 'title';
        $default_order_by = apply_filters('tc_caf_filter_posts_order_by', $default_order_by);
        if (get_post_meta($filter_id, 'caf_post_orders_by')) {
            $caf_post_orders_by = get_post_meta($filter_id, 'caf_post_orders_by', true);
            $default_order_by = $caf_post_orders_by;
        }
        $default_order = "asc";
        $default_order = apply_filters('tc_caf_filter_posts_order', $default_order);
        if (get_post_meta($filter_id, 'caf_post_order_type')) {
            $caf_post_order_type = get_post_meta($filter_id, 'caf_post_order_type', true);
            $default_order = $caf_post_order_type;
        }
        /*** Setup query ***/
        $args = [
            'paged' => $page,
            'post_type' => $post_type,
            'post_status' => 'publish',
            'posts_per_page' => $per_page,
            'tax_query' => $tax_qry,
            'orderby' => $default_order_by,
            'order' => $default_order,
        ];
        if (isset($_POST['params']['search_string'])) {
            $search_string = sanitize_text_field($_POST['params']['search_string']);
            $args = array_merge($args, array('s' => $search_string));
        }
        if ($caf_filter_layout == "alphabetical-layout") {
            global $wpdb;
            if ($term == 'all') {
                $args = [
                    'paged' => $page,
                    'post_type' => $post_type,
                    'post_status' => 'publish',
                    'posts_per_page' => $per_page,
                    'orderby' => $default_order_by,
                    'order' => $default_order,
                ];
            } else {
                $first_char = $term;
                if ($first_char == '0-9') {
                    $first_char = '^[0-9]+';
                    $postids = $wpdb->get_col($wpdb->prepare("
SELECT      ID
FROM        $wpdb->posts
WHERE       SUBSTR($wpdb->posts.post_title,1,1) REGEXP %s and
$wpdb->posts.post_type='%2s'
ORDER BY    $wpdb->posts.post_title", $first_char, $post_type));
                } else {
                    $postids = $wpdb->get_col($wpdb->prepare("
SELECT      ID
FROM        $wpdb->posts
WHERE       SUBSTR($wpdb->posts.post_title,1,1) = %s and
$wpdb->posts.post_type='%2s'
ORDER BY    $wpdb->posts.post_title", $first_char, $post_type));
                }
                //var_dump($postids);
                if (!empty($postids)) {
                    $args = [
                        'paged' => $page,
                        'post_type' => $post_type,
                        'post_status' => 'publish',
                        'posts_per_page' => $per_page,
                        'post__in' => $postids,
                        'orderby' => $default_order_by,
                        'order' => $default_order,
                    ];
                    if (isset($_POST['params']['search_string'])) {
                        $search_string = sanitize_text_field($_POST['params']['search_string']);
                        $args = array_merge($args, array('s' => $search_string));
                    }
                } else {
                    $args = [];
                }
            }

        }

        $args = apply_filters('tc_caf_filter_posts_query', $args, $filter_id, $caf_crnt_id);
        $qry = new WP_Query($args);
        //   echo "<pre>";
        //   print_r($args);
        //   echo "</pre>";

        if (isset($_POST["params"]["load_more"])) {
            //do something
        } else {
            echo '<div class="status"></div>';
        }
        if ($caf_post_layout && strlen($caf_post_layout) > 11) {
            include_once TC_CAF_PRO_PATH . 'includes/front-functions.php';
            $layout = $caf_post_layout . ".php";
            // if (str_contains($caf_post_layout, '_')) {
            //     $layout = "caf-builder-layout.php";
            // } else {
            //     $layout = $caf_post_layout . ".php";
            // }
            $template_path = "category-ajax-filter/layouts/post/";
            if ($layout == "post-layout1.php" || $layout == "post-layout2.php" || $layout == "post-layout3.php" || $layout == "post-layout4.php") {
                $default_path = TC_CAF_PATH . "includes/layouts/post/";
            } else {
                $default_path = TC_CAF_PRO_PATH . "includes/layouts/post/";
            }
            $filepath = wcpt_get_template($layout, "", $template_path, $default_path);
            if (file_exists($filepath)) {
                include $filepath;
            } else {
                echo "<div class='error-of-post-layout error-caf'>" . esc_html('Post Layout is not Available.', 'tc_caf') . "</div>";
                $response = [
                    'status' => 404,
                    'message' => 'No posts found',
                    //'content' =>'ok',
                ];
            }
        }
//include_once TC_CAF_PATH.'includes/layouts/post/post-layout1.php';
        $response['content'] = ob_get_clean();
        die(json_encode($response));
        //die();
    }
    public function caf_performance()
    {
        return "ok";
    }
    public function get_filter_post_pro()
    {
        ob_start();
        //echo $_POST['nonce'];
        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'tc_caf_ajax_nonce')) {
            die('Permission denied');
        }

/*** Default response ***/
        $response = [
            'status' => 500,
            'message' => 'Something is wrong, please try again later ...',
            'content' => false,
            'found' => 0,
        ];
        $id = sanitize_text_field($_POST['id']);
        $args = [
            'p' => $id,
        ];
        $qry = new WP_Query($args);
        if ($qry->have_posts()): while ($qry->have_posts()): $qry->the_post();
                global $post;
                // $content=$post->post_content;
                //$content=wpautop($content);
                //echo $content;
                //add_filter( 'the_content', 'shortcode_unautop' );
                //echo do_shortcode(apply_filters('the_content', $post->post_content));
                //echo apply_filters( 'the_content', $content );
                // add_filter( 'the_content', 'do_shortcode', 11 );
                //echo the_content();
                echo preg_replace('#\[[^\]]+\]#', '', get_the_content());
            endwhile;
            wp_reset_postdata();
        else:
            echo "<div class='error-of-empty-result error-caf'>No Result Found</div>";
        endif;
        //$thispost = get_post( $id );
        //echo $thispost->post_content;
        $response = [
            'status' => 200,
            'message' => 'ok',
        ];
//include_once TC_CAF_PATH.'includes/layouts/post/post-layout1.php';
        //$response['content'] = ob_get_clean();
        //die(json_encode($response));
        die();
    }
    public function conditionally_add_scripts_and_styles_pro($posts)
    {
        //var_dump($posts);
        if (empty($posts)) {
            return $posts;
        }

        $shortcode_found = false; // use this flag to see if styles and scripts need to be enqueued
        $short_id = array();
        foreach ($posts as $post) {
            if (stripos($post->post_content, '[caf_filter') !== false) {
                $str = get_string_between($post->post_content, "[caf_filter id=", "]");
                if ($str) {
                    $short_ids = array();
                    if (strpos($str, "'") !== false) {
                        $short_ids = trim(str_replace("'", '', $str));
                    }
                }
                $short_id[] = $short_ids;
                $shortcode_found = true; // bingo!
                break;
            }
        }
        //var_dump($short_ids);
        //die;
        if ($shortcode_found) {
            //    var_dump($short_id);

            $caf_post_layout = 'post-layout1';
            $caf_filter_layout = 'filter-layout1';
            wp_enqueue_style('tc-caf-common-style', TC_CAF_URL . 'assets/css/common/common.min.css', '', TC_CAF_PLUGIN_VERSION);
            wp_enqueue_style('tc-caf-pro-common-style', TC_CAF_PRO_URL . 'assets/css/common/common.css', '', TC_CAF_PRO_PLUGIN_VERSION);
            $id = $short_id[0];
            $b = 1;
            if (get_post_meta($id, 'caf_post_layout')) {
                $caf_post_layout = get_post_meta($id, 'caf_post_layout', true);
            }
            if (get_post_meta($id, 'caf_filter_layout')) {
                $caf_filter_layout = get_post_meta($id, 'caf_filter_layout', true);
                $handle = "tc-caf-dynamic-style-" . $caf_filter_layout . "_" . $b;
                wp_enqueue_style($handle, TC_CAF_URL . 'assets/css/dynamic-styles.css');
                setDynamicFilterCss($id, $handle, $caf_filter_layout, $b, 'options');
                setDynamicFilterCss($id, $handle, $caf_filter_layout, $b, 'conditional');
                setDynamicFilterCss($id, $handle, $caf_post_layout, $b, 'conditional');
            }

            /*===========================================================
            ====================ENQUEUE POST LAYOUT CSS==================
            =============================================================*/
            $layout = $caf_post_layout . ".css";
            $filepath = get_stylesheet_directory() . "/category-ajax-filter/css/post/" . $layout;
            if (file_exists($filepath)) {
                wp_enqueue_style('tc-caf-pro-' . $caf_post_layout, get_stylesheet_directory_uri() . '/category-ajax-filter/css/post/"' . $layout, '', TC_CAF_PRO_PLUGIN_VERSION);
            } else {
                if ($layout == "post-layout1.css" || $layout == "post-layout2.css" || $layout == "post-layout3.css" || $layout == "post-layout4.css") {
                    wp_enqueue_style('tc-caf-' . $caf_post_layout, TC_CAF_URL . 'assets/css/post/"' . $layout, '', TC_CAF_PLUGIN_VERSION);
                } else {
                    wp_enqueue_style('tc-caf-pro-' . $caf_post_layout, TC_CAF_PRO_URL . 'assets/css/post/"' . $layout, '', TC_CAF_PRO_PLUGIN_VERSION);
                    // if (str_contains($caf_post_layout, '_')) {
                    //     // Enqueue Dynamic Styles here for builder layout;
                    // } else {
                    //     wp_enqueue_style('tc-caf-pro-' . $caf_post_layout, TC_CAF_PRO_URL . 'assets/css/post/"' . $layout, '', TC_CAF_PRO_PLUGIN_VERSION);
                    // }
                }
            }
            /*===========================================================
            ====================ENQUEUE FILTER LAYOUT CSS==================
            =============================================================*/
            $flayout = $caf_filter_layout . ".css";
            $filepath = get_stylesheet_directory() . "/category-ajax-filter/css/filter/" . $flayout;
            if (file_exists($filepath)) {
                wp_enqueue_style('tc-caf-' . $caf_filter_layout, get_stylesheet_directory_uri() . '/category-ajax-filter/css/filter/"' . $flayout, '', TC_CAF_PRO_PLUGIN_VERSION);
            } else {
                if ($flayout == "filter-layout1.css" || $flayout == "filter-layout2.css" || $flayout == "filter-layout3.css") {
                    wp_enqueue_style('tc-caf-' . $caf_filter_layout, TC_CAF_URL . 'assets/css/filter/"' . $flayout, '', TC_CAF_PLUGIN_VERSION);
                } else {
                    wp_enqueue_style('tc-caf-pro-' . $caf_filter_layout, TC_CAF_PRO_URL . 'assets/css/filter/"' . $flayout, '', TC_CAF_PRO_PLUGIN_VERSION);
                }
            }
            //}
            /*===========================================================
            ====================ENQUEUE COMMON CSS==================
            =============================================================*/
            wp_enqueue_style('tc-caf-font-awesome-style', TC_CAF_URL . 'assets/css/fontawesome/css/font-awesome.min.css', '', TC_CAF_PLUGIN_VERSION);
            wp_enqueue_style('tc-caf-font-awesome-all-style', TC_CAF_URL . 'assets/css/fontawesome/css/all.min.css', '', TC_CAF_PLUGIN_VERSION);
            wp_enqueue_script('jquery');
            wp_enqueue_script('tc-caf-frontend-scripts-pro', TC_CAF_PRO_URL . 'assets/js/script.js', array('jquery'), TC_CAF_PRO_PLUGIN_VERSION);
        }
        return $posts;
    }
    public function tc_caf_enqueue_scripts_pro()
    {
        wp_register_script('tc-caf-frontend-scripts-pro', TC_CAF_PRO_URL . 'assets/js/script.js', array('jquery'), TC_CAF_PRO_PLUGIN_VERSION);
        wp_localize_script('tc-caf-frontend-scripts-pro', 'tc_caf_ajax', array('ajax_url' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('tc_caf_ajax_nonce'), 'plugin_path' => TC_CAF_URL));
        for ($i = 1; $i <= 3; $i++) {
            wp_register_style('tc-caf-filter-layout' . $i, TC_CAF_URL . 'assets/css/filter/filter-layout' . $i . '.css', array(), TC_CAF_PLUGIN_VERSION, 'all');
        }
        for ($i = 1; $i <= 4; $i++) {
            wp_register_style('tc-caf-post-layout' . $i, TC_CAF_URL . 'assets/css/post/post-layout' . $i . '.css', array(), TC_CAF_PLUGIN_VERSION, 'all');
        }
///$d=apply_filters_ref_array('tc_caf_post_layouts', $layouts);
        wp_register_style('tc-caf-common-style', TC_CAF_URL . 'assets/css/common/common.css', array(), TC_CAF_PLUGIN_VERSION, 'all');
        wp_enqueue_style('tc-caf-pro-common-style', TC_CAF_PRO_URL . 'assets/css/common/common.css', '', TC_CAF_PRO_PLUGIN_VERSION);
        wp_register_style('tc-caf-font-awesome-style', TC_CAF_URL . 'assets/css/fontawesome/css/font-awesome.min.css', array(), TC_CAF_PLUGIN_VERSION, 'all');
        wp_enqueue_script('tc-caf-frontend-scripts-pro', TC_CAF_PRO_URL . 'assets/js/script.js', array('jquery'));
    }
    public function tc_caf_pro_filter_prev_text($text, $filter_id)
    {
        $caf_prev_text = "Prev";
        if (get_post_meta($filter_id, 'caf_prev_text')) {
            $caf_prev_text = get_post_meta($filter_id, 'caf_prev_text', true);
        }
        return $caf_prev_text;
    }
    public function tc_caf_pro_filter_next_text($text, $filter_id)
    {
        $caf_next_text = "Next";
        if (get_post_meta($filter_id, 'caf_next_text')) {
            $caf_next_text = get_post_meta($filter_id, 'caf_next_text', true);
        }
        return $caf_next_text;
    }
    public function remove_class_filter($tag, $class_name = '', $method_name = '', $priority = 10)
    {
        global $wp_filter;
        // var_dump($wp_filter);
        // Check that filter actually exists first
        if (!isset($wp_filter[$tag])) {
            //echo "yes";
            return false;
        }
        /**
         * If filter config is an object, means we're using WordPress 4.7+ and the config is no longer
         * a simple array, rather it is an object that implements the ArrayAccess interface.
         *
         * To be backwards compatible, we set $callbacks equal to the correct array as a reference (so $wp_filter is updated)
         *
         * @see https://make.wordpress.org/core/2016/09/08/wp_hook-next-generation-actions-and-filters/
         */
        if (is_object($wp_filter[$tag]) && isset($wp_filter[$tag]->callbacks)) {
            // Create $fob object from filter tag, to use below
            $fob = $wp_filter[$tag];
            $callbacks = &$wp_filter[$tag]->callbacks;
        } else {
            $callbacks = &$wp_filter[$tag];
        }
        // Exit if there aren't any callbacks for specified priority
        if (!isset($callbacks[$priority]) || empty($callbacks[$priority])) {
            return false;
        }
        // Loop through each filter for the specified priority, looking for our class & method
        foreach ((array) $callbacks[$priority] as $filter_id => $filter) {
            // Filter should always be an array - array( $this, 'method' ), if not goto next
            if (!isset($filter['function']) || !is_array($filter['function'])) {
                continue;
            }
            // If first value in array is not an object, it can't be a class
            if (!is_object($filter['function'][0])) {
                continue;
            }
            // Method doesn't match the one we're looking for, goto next
            if ($filter['function'][1] !== $method_name) {
                continue;
            }
            // Method matched, now let's check the Class
            if (get_class($filter['function'][0]) === $class_name) {
                // WordPress 4.7+ use core remove_filter() since we found the class object
                if (isset($fob)) {
                    // Handles removing filter, reseting callback priority keys mid-iteration, etc.
                    $fob->remove_filter($tag, $filter['function'], $priority);
                } else {
                    // Use legacy removal process (pre 4.7)
                    unset($callbacks[$priority][$filter_id]);
                    // and if it was the only filter in that priority, unset that priority
                    if (empty($callbacks[$priority])) {
                        unset($callbacks[$priority]);
                    }
                    // and if the only filter for that tag, set the tag to an empty array
                    if (empty($callbacks)) {
                        $callbacks = array();
                    }
                    // Remove this filter from merged_filters, which specifies if filters have been sorted
                    unset($GLOBALS['merged_filters'][$tag]);
                }
                return true;
            }
        }
        return false;
    }
}
function wcpt_locate_template($template_name, $template_path = '', $default_path = '')
{
    // Set variable to search in woocommerce-plugin-templates folder of theme.
    if (!$template_path):
        $template_path = 'category-ajax-filter-pro/layouts/post/';
    endif;
    // Set default plugin templates path.
    if (!$default_path):
        $default_path = plugin_dir_path(__FILE__) . 'layouts/post/'; // Path to the template folder
    endif;
    // Search template file in theme folder.
    $template = locate_template(array(
        $template_path . $template_name,
        $template_name,
    ));
    // Get plugins template file.
    if (!$template):
        $template = $default_path . $template_name;
    endif;
    return apply_filters('wcpt_locate_template', $template, $template_name, $template_path, $default_path);
}
function wcpt_get_template($template_name, $args = array(), $tempate_path = '', $default_path = '')
{
    if (is_array($args) && isset($args)):
        extract($args);
    endif;
    $template_file = wcpt_locate_template($template_name, $tempate_path, $default_path);
    /*if ( ! file_exists( $template_file ) ){
    //    _doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.',
    // $template_file ), '1.0.0' );
    $file='not found';
    }
    else
    {
    $file=$template_file;
    }*/
    return $template_file;
}
$licenseKey = get_option("CategoryAjaxFilterPro_lic_Key", "");
$liceEmail = get_option("CategoryAjaxFilterPro_lic_email", "");
CategoryAjaxFilterProBase::addOnDelete(function () {
    delete_option("CategoryAjaxFilterPro_lic_Key");
});
if (CategoryAjaxFilterProBase::CheckWPPlugin($licenseKey, $liceEmail, $this->licenseMessage, $this->responseObj, __FILE__)) {
    new CAF_PRO_admin_filters();
    new CAF_PRO_ACTIONS();
    new CAF_PRO_FILTERS();
}
function caf_side_meta_box_pro()
{
    ?>
<ul class='caf-pro-announcements'>
 <li>1. Upcoming Events.</li>
 <li class="button"><a href="https://trustyplugins.com" target="_blank"><span class="dashicons dashicons-visibility"></span> View Demo</a></li>
</ul>
<?php
}
function setDynamicFilterCss($id, $handle, $caf_layout, $b, $type)
{
    static $d = array();
    //echo $type."==".$caf_layout."<br/>";
    if (in_array($caf_layout, $d)) {
        if ($type != "shortcode") {
            return;
        }
    }

    include TC_CAF_PRO_PATH . 'includes/front-variables.php';
    if ($type == "options") {
        wp_add_inline_style($handle, $cm_settings);
    }
    // if (str_contains($caf_layout, '_')) {
    //     include_once TC_CAF_PRO_PATH . '/includes/caf-builder-styles.php';
    // }

    switch ($caf_layout) {
        case "filter-layout1":
            include TC_CAF_PATH . "/includes/layouts/dynamic-css/filter-layout1-css.php";
            break;
        case "filter-layout2":
            include TC_CAF_PATH . "/includes/layouts/dynamic-css/filter-layout2-css.php";
            break;
        case "filter-layout3":
            include TC_CAF_PATH . "/includes/layouts/dynamic-css/filter-layout3-css.php";
            break;
        case "alphabetical-layout":
            include TC_CAF_PRO_PATH . "/includes/layouts/dynamic-css/alphabetical-layout-css.php";
            break;
        case "multiple-checkbox":
            include TC_CAF_PRO_PATH . "/includes/layouts/dynamic-css/multiple-checkbox-css.php";
            break;
        case "tabfilter-layout1":
            include TC_CAF_PRO_PATH . "/includes/layouts/dynamic-css/tabfilter-layout1-css.php";
            break;
        case "multiple-taxonomy-filter":
            include TC_CAF_PRO_PATH . "/includes/layouts/dynamic-css/multiple-taxonomy-filter-css.php";
            break;
        case "multiple-taxonomy-filter-hor":
            include TC_CAF_PRO_PATH . "/includes/layouts/dynamic-css/multiple-taxonomy-filter-hor-css.php";
            break;
        case "multiple-taxonomy-filter-hor-modern":
            include TC_CAF_PRO_PATH . "/includes/layouts/dynamic-css/multiple-taxonomy-filter-hor-modern-css.php";
            break;
        case "parent-child-filter":
            include TC_CAF_PRO_PATH . "/includes/layouts/dynamic-css/parent-child-filter-css.php";
            break;

        case "post-layout1":
            include TC_CAF_PATH . "/includes/layouts/dynamic-css/post-layout1-css.php";
            break;
        case "post-layout2":
            include TC_CAF_PATH . "/includes/layouts/dynamic-css/post-layout2-css.php";
            break;
        case "post-layout3":
            include TC_CAF_PATH . "/includes/layouts/dynamic-css/post-layout3-css.php";
            break;
        case "post-layout4":
            include TC_CAF_PATH . "/includes/layouts/dynamic-css/post-layout4-css.php";
            break;
        case "post-layout5":
            include TC_CAF_PRO_PATH . "/includes/layouts/dynamic-css/post-layout5-css.php";
            break;
        case "post-layout6":
            include TC_CAF_PRO_PATH . "/includes/layouts/dynamic-css/post-layout6-css.php";
            break;
        case "post-layout7":
            include TC_CAF_PRO_PATH . "/includes/layouts/dynamic-css/post-layout7-css.php";
            break;
        case "carousel-slider":
            include TC_CAF_PRO_PATH . "/includes/layouts/dynamic-css/carousel-slider-css.php";
            break;
        case "post-layout9":
            include TC_CAF_PRO_PATH . "/includes/layouts/dynamic-css/post-layout9-css.php";
            break;
        case "post-layout10":
            include TC_CAF_PRO_PATH . "/includes/layouts/dynamic-css/post-layout10-css.php";
            break;
        case "post-layout11":
            include TC_CAF_PRO_PATH . "/includes/layouts/dynamic-css/post-layout11-css.php";
            break;
    }
    $d[] = $caf_layout;
}
add_filter('wp_list_categories', 'caf_cat_count_span');
function caf_cat_count_span($links)
{
    $links = str_replace('</a> (', '</a> <span class="count_link">(', $links);
    $links = str_replace(')', ')</span>', $links);
    return $links;
}


add_action('rest_api_init', function () {
    register_rest_route('caf-custom-builder/v1', '/custom-code/', array(
        'methods' => 'GET',
        'callback' => 'caf_get_code',
        'permission_callback' => '__return_true',
    ));
});
function caf_get_code($data)
{
    //var_dump($data);
    if (isset($_REQUEST["code"])) {
        $code = '[contact-form-7 id="3128" title="Contact form 1"]';
        //$result= do_shortcode($code);
        echo json_encode(array("status" => "success", "code_html" => do_shortcode($code)));
    }
}

add_action('rest_api_init', function () {
    register_rest_route('caf-custom-builder/v1', '/options/', array(
        'methods' => 'GET',
        'callback' => 'caf_get_rest_option',
        'permission_callback' => '__return_true',
    ));
});
function get_Saved_option($layouts)
{
    $layouts_available = array();
    foreach ($layouts as $key => $layout) {
        $title = strtolower(trim($layout));
        $title = str_replace(' ', '', $title);
        $title = $title . "_" . $key;
        $layouts_available[$key] = get_option($title);
    }
    return $layouts_available;
}
function caf_get_rest_option($data)
{
    ob_start();
    $layouts = get_option($data['option_name']);
    $layouts_available = get_Saved_option($layouts);
    echo json_encode(array("status" => "success", "layouts" => $layouts, "layouts_available" => $layouts_available));
}

add_action('rest_api_init', function () {
    register_rest_route('caf-custom-builder/v1', '/delete-options/', array(
        'methods' => 'GET',
        'callback' => 'caf_delete_rest_option',
        'permission_callback' => '__return_true',
    ));
});

function caf_delete_rest_option($data)
{
    ob_start();
    $opt = $data['option_name'];
    $index = $data['index'];
    $options = get_option($opt);
    $layouts_available = get_Saved_option($options);
    if ($options[$index]) {
        $layout = $options[$index];
        $title = strtolower(trim($layout));
        $title = str_replace(' ', '', $title);
        $title = $title . "_" . $index;
        unset($options[$index]);
        delete_option($title);
        update_option($opt, $options);
        echo json_encode(array("status" => "success", "layouts" => get_option($opt), "layouts_available" => $layouts_available));
    }
}

add_action('rest_api_init', function () {
    register_rest_route('caf-custom-builder/v1', '/add-options/', array(
        'methods' => 'GET',
        'callback' => 'caf_add_rest_option',
        'permission_callback' => '__return_true',
    ));
});

function caf_add_rest_option($data)
{
    ob_start();
    $opt = $data['option_name'];
    $title = $data['title'];
    if (get_option($opt)) {
        $custom_layouts = get_option($opt);
        $custom_layouts[] = $title;
        update_option($opt, $custom_layouts);
    } else {
        $custom_layouts[] = $title;
        update_option($opt, $custom_layouts);
    }
    $layouts_available = get_Saved_option(get_option($opt));
    echo json_encode(array("status" => "success", "layouts" => get_option($opt), "layouts_available" => $layouts_available));
}

add_action('rest_api_init', function () {
    register_rest_route('caf-custom-builder/v1', '/save-builder-layout/', array(
        'methods' => 'POST',
        'callback' => 'caf_save_rest_option',
        'permission_callback' => '__return_true',
    ));
});

function caf_save_rest_option($data)
{
    ob_start();
    //$data_layouts=$data['data_layouts'];
    $data_layouts = json_decode($data['json_data']);
    // echo json_encode(array("status"=>"success","data"=>$data_layouts));
    $opt = $data['option_name'];
    $index = $data['index'];
    $data_layouts = json_decode($data['json_data']);
    $layouts = get_option($opt);
    $title = strtolower(trim($layouts[$index]));
    $title = str_replace(' ', '', $title);
    $title = $title . "_" . $index;
    //var_dump($data_layouts);
    update_option($title, $data_layouts);
    echo json_encode(array("status" => "success", "layouts" => get_option($opt), "data-layouts" => get_option($title)));
}

function camelCasetoCssString($styles)
{
    $css = '';
    foreach ($styles as $key => $st) {
        $css .= $key . ":" . $st . ";";
        $css = strtolower(preg_replace('/(?:[a-z]|[A-Z]+)\K(?=[A-Z]|\d+)/', '-', $css));
    }
    return $css;
}