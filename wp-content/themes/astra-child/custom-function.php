<?php
if(!defined('LIT_DIR')) define('LIT_DIR', get_stylesheet_directory());
if(!defined('LIT_URL')) define('LIT_URL', get_stylesheet_directory_uri());

class CustomFunction
{
    private static $instance;

    private $menu_names = [];

    public function __construct()
    {
        $this->register_hooks();
    }

    private function register_hooks()
    {
        /**
         * 讓WooCommerce Customer/Order CSV Export匯出的csv檔加上BOM檔頭 2018-02-02
         */
        add_filter('wc_customer_order_csv_export_enable_bom', '__return_true');
        /**
         * 移除admin bar的wordpress logo
         */
        add_action('admin_bar_menu', array($this, 'remove_admin_bar_wordpress_logo'), 999);
        /**
         * 針對非管理員移除admin bar上的項目
         */
        add_action('wp_before_admin_bar_render' , array($this, 'remove_admin_bar_none_admin_nodes'), 1000);
        /**
         * 購物車自動更新
         */
        add_action('wp_footer', array($this, 'woocommerce_auto_update_cart'));
        /**
         * 取消 Wordpress 自動更新
         */
        add_filter('pre_site_transient_update_core', array($this, 'remove_core_updates'));
        add_filter('pre_site_transient_update_plugins', array($this, 'remove_core_updates'));
        add_filter('pre_site_transient_update_themes', array($this, 'remove_core_updates'));
        /**
         * 新增Mailpoet選項，讓MailPoet使用WP Mail
         */
        add_action('init', array($this, 'enable_mailpoet_wp_mail_support'));
        /**
         * 更改密碼強度限制
         */
        add_filter('woocommerce_min_password_strength', array($this, 'change_password_length'));
        /**
         * 當紅利點數可用折扣金額為0時，隱藏購物車及結帳頁折抵訊息
         */
        add_filter('wc_points_rewards_redeem_points_message', array($this, 'hide_applying_points_message'), 10, 2);
        /**
         * 載入後台CSS檔案
         */
        add_action('admin_head', array($this, 'load_admin_css_files'));
        /**
         * 修改WordPress從文章內容產生的摘要內的點點點樣式
         */
        add_filter('excerpt_more', array($this, 'override_excerpt_more'), 999);

        /**
         *  修正YITH動態定價無法正常使用
         */
        add_filter('ywdpd_pricing_rules' , array($this, 'modify_multiple_value_to_array'));
        /**
         * 從HTML的資源連結中移除網站網址資訊
         */
        add_action('get_header', array($this, 'remove_domain_from_html'));
        /**
         * 修改選單翻譯
         */
        add_action('admin_init', array($this, 'override_menu_names'));
        /**
         * 針對特定分類、靜態頁面、單一文章頁自動載入指定的CSS與JS檔案
         */
        add_action('wp_enqueue_scripts', array($this, 'load_type_css_js_files'), 102);
        /**
         * 自動載入全域CSS檔案
         */
        add_action('wp_enqueue_scripts', array($this, 'load_global_css_files'), 101);
        /**
         * 自動載入全域JS檔案
         */
        add_action('wp_enqueue_scripts', array($this, 'load_global_js_files'), 100);
        /**
         * 載入後台JS檔案
         */
        add_action('admin_enqueue_scripts', [$this,'load_admin_js_files'],100);
        /**
         * 修改商店管理員可設定的帳號角色
         */
        add_filter('woocommerce_shop_manager_editable_roles', [$this, 'set_shop_manager_editable_roles'], 999);


        /** 客製化功能*/
        add_action('woocommerce_after_checkout_billing_form',[$this,'add_person_count'],10);

        add_action( 'init', [$this, 'create_custom_post_type'], 0 );//新增文章類型-維修站點
        add_action('add_meta_boxes', [$this, 'add_meta_boxes' ] ,20); //維修站點-內容資料
        add_action('init', [$this,'customer_post_taxonomy'], 0 );//維修站點-自定義分類
        add_action('save_post', [$this, 'save_data_for_custom'],1,100); //儲存自訂內容

        add_filter('caf_get_post_read_more_filter', [$this, 'set_product_filter_content'], 999,3);//客制化filter 顯示內容
    }
    public function set_product_filter_content($output, $data, $post){
        if($post->post_type == 'product'){
            $product = wc_get_product($post->ID);
            $output = '<div class="filter-product-price">'.$product->get_price_html().'</div>';
        }else if($post->post_type == 'repair') {
            $repair_title = get_post_meta($post->ID, 'repair_title', 1);
            $repair_phone = get_post_meta($post->ID, 'repair_phone', 1);
            $repair_address = get_post_meta($post->ID, 'repair_address', 1);

            $output = '<div class="filter-repair-detail">';
            $output .= '<div class="repair-detail-title">' . $repair_title . '</div>';
            $output .= '<div class="repair-detail-phone">' . $repair_phone . '</div>';
            $output .= '<div class="repair-detail-address">' . $repair_address . '</div>';
            $output .= '</div>';
        }

        return $output;
    }

    public function create_custom_post_type(){
        $labels = array(
            'name'               => '維修站點', 'all_items'          => '所有維修站點',
            'add_new'            => '新增維修站點', 'add_new_item'       => '增加維修站點',
            'edit_item'          => '編輯維修站點', 'view_item'          => '檢視維修站點',
            'search_items'       => '搜尋維修站點', 'not_found'          => '沒有資料',
            'not_found_in_trash' => '沒有於回收桶之中找到', 'parent_item_colon' 	=> '',
        );
        $args = array(
            'labels' 				=> $labels,
            'menu_icon'				=> 'dashicons-admin-tools',
            'public' 				=> true, 'publicly_queryable' 	=> true,
            'show_ui' 				=> true, 'show_admin_column'     => true,
            'query_var' 			=> true, 'capability_type' 		=> 'post',
            'hierarchical' 			=> false, 'menu_position' 		=> null,
            'has_archive'           => true, 'exclude_from_search'   => true,
            'supports' 				=> array('title'),
        );
        register_post_type( 'repair', $args );
    }
    public function add_meta_boxes(){
        add_meta_box( 'repair-detail', '維修站點內容',  [$this,'repair_detail_meta_box'], 'repair', 'normal' );
    }
    public function customer_post_taxonomy(){
        register_taxonomy( 'brand', ['repair','product'], array(
            'label' => '品牌', 'hierarchical' => true,'show_admin_column' => true,
            'show_in_nav_menus' => true,
        ));
        register_taxonomy( 'model', 'product', array(
            'label' => '車種類型', 'hierarchical' => true,'show_admin_column' => true,
            'show_in_nav_menus' => true,
        ));
        register_taxonomy( 'repair-cat', 'repair', array(
            'label' => '功能分類', 'hierarchical' => true,'show_admin_column' => true,
            'show_in_nav_menus' => true,
        ));
        register_taxonomy( 'city', 'repair', array(
            'label' => '城市', 'hierarchical' => true,'show_admin_column' => true,
            'show_in_nav_menus' => true,
        ));
    }
    public function repair_detail_meta_box($post){
        ob_start();
        include_once __DIR__ . "/meihao-custom-file/meihao-repair-detail.php";
        $template = ob_get_contents();
        ob_end_clean();
        echo $template;
    }
    public function save_data_for_custom($post_id){
        $post_type = get_post_type($post_id);
        if($post_type == 'repair'){
            if(isset($_POST['repair_title'])){
                $subtitle_meta_box = $_POST['repair_title'];
                update_post_meta($post_id, 'repair_title', $subtitle_meta_box);
            }
            if(isset($_POST['repair_phone'])){
                $subtitle_meta_box = $_POST['repair_phone'];
                update_post_meta($post_id, 'repair_phone', $subtitle_meta_box);
            }
            if(isset($_POST['repair_address'])){
                $subtitle_meta_box = $_POST['repair_address'];
                update_post_meta($post_id, 'repair_address', $subtitle_meta_box);
            }
        }

    }

    public function set_shop_manager_editable_roles($roles){
        $roles = ['author','contributor','subscriber','vip','vvip','editor','translator','reseller','customer','shop_manager'];
        return $roles;
    }

    public static function get_instance()
    {
        if(is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function remove_admin_bar_wordpress_logo( $wp_admin_bar ) {
        /** @var WP_Admin_Bar $wp_admin_bar */
        $wp_admin_bar->remove_node('wp-logo');

    }

    public function remove_admin_bar_none_admin_nodes() {
        /** @var WP_Admin_Bar $wp_admin_bar */
        global $wp_admin_bar;
        if(!current_user_can('administrator')) {
            //W3 Total Cache
            $wp_admin_bar->remove_node('w3tc');
            //語系切換
//            $wp_admin_bar->remove_node('WPML_ALS');
            //Simply Show Hooks
            $wp_admin_bar->remove_node('cxssh-main-menu');
        }
    }

    public function woocommerce_auto_update_cart() {
        if (is_cart()) :
            ?>
            <script>
                (function($){
                    $('div.woocommerce').on('change', '.qty', function(){
                        var $updateCartButton = $("[name='update_cart']");
                        $updateCartButton.removeAttr('disabled');
                        $updateCartButton.click();
                    });
                })(jQuery);
            </script>
        <?php
        endif;
    }

    public function remove_core_updates(){
        global $wp_version;
        return(object) array('last_checked'=> time(),'version_checked'=> $wp_version);
    }

    public function enable_mailpoet_wp_mail_support() {
        if(class_exists('WYSIJA')){
            $model_config = WYSIJA::get('config','model');
            $model_config->save( array( 'allow_wpmail' => true ));
        }
    }
    public function change_password_length() {
        /**
         * 0: Disable
         * 1: Very weak
         * 2: Weak
         * 3: Strong (Default)
         */
        return 2;
    }

    public function hide_applying_points_message($message, $points)
    {
        if($points<=0)
            return '';

        return $message;
    }

    public function load_admin_css_files()
    {
        $style_uri = get_stylesheet_directory_uri();
        $css_file = '/assets/css/admin-css.css';
        $min_css_file = '/assets/css/admin-css.css';
        if(file_exists(get_stylesheet_directory() . $min_css_file))
            wp_enqueue_style("Han_admin_css", $style_uri . $min_css_file);
        elseif(file_exists(get_stylesheet_directory() . $css_file))
            wp_enqueue_style("Han_admin_css", $style_uri . $css_file);
    }


    public function override_excerpt_more($excerpt_more)
    {
        return '...';
    }



    public function modify_multiple_value_to_array($pricing_rules){
        $rules_name = array(
            'apply_to_categories_list'          , 'apply_to_categories_list_excluded' ,
            'apply_adjustment_categories_list'  , 'apply_adjustment_categories_list_excluded' ,
            'user_rules_customers_list'         , 'user_rules_customers_list_excluded' ,
            'apply_to_products_list'            , 'apply_adjustment_products_list_excluded' ,
            'apply_adjustment_products_list'    , 'apply_adjustment_products_list_excluded' ,
            'apply_to_tags_list'                , 'apply_to_tags_list_excluded' ,
            'apply_adjustment_tags_list'        , 'apply_adjustment_tags_list_excluded' ,
        );

        foreach($pricing_rules as $key => $rule)
        {
            foreach($rule as $name => $value){
                if($value && in_array($name,$rules_name)){
                    $pricing_rules[$key][$name] = explode(',',$value);
                }
            }
        }

        return $pricing_rules;
    }

    public function remove_domain_from_html()
    {
        global $CONFIG;
        if(isset($CONFIG['domains_to_be_removed'])) {
            ob_start(function($html) use($CONFIG){
                foreach($CONFIG['domains_to_be_removed'] as $url) {
                    $url = str_replace('.', '\.', $url);
                    $patterns = [
                        "/https?:\/\/$url\/*/",
                        "/\/\/$url\/*/",
                    ];
                    $html = preg_replace($patterns, '/', $html);
                }
                return $html;
            });
        }
    }

    public function override_menu_names()
    {
        global $menu;
        if($menu){
            foreach ($menu as $i => $_menu) {
                $menu_slug = $_menu[2];
                if(!empty($this->menu_names[$menu_slug])) {
                    $menu[$i][0] = $menu[$i][1] = $this->menu_names[$menu_slug];
                }
            }
            return;
        }
    }

    /**
     * 針對特定分類、靜態頁面、單一文章頁自動載入指定的CSS與JS檔案
     * @hooked wp_enqueue_scripts
     */
    public function load_type_css_js_files()
    {
        global $post;
        $css_dir = '/assets/css';
        $js_dir = '/assets/js';
        $file_names = [];
        if(is_page() || is_404()) {
            $type = 'page';
            $css_dir = $css_dir . '/page/';
            $js_dir = $js_dir . '/page/';
            if(is_front_page()) {
                $file_names[] = 'home';
            } elseif(is_404()) {
                $file_names[] = '404';
            } else {
                $file_names[] = $post->post_name;
                $temp_page = $post;
                while($temp_page->post_parent) {
                    $temp_page = get_post($temp_page->post_parent);
                    $file_names[] = $temp_page->post_name;
                }
            }
        } elseif(is_archive() || (!is_front_page() && is_home())) {
            $type = 'archive';
            $css_dir = $css_dir . '/archive/';
            $js_dir = $js_dir . '/archive/';
            $file_names[] = get_post_type();
            if(!$file_names[0]) {
                global $wp_taxonomies;
                $term = get_queried_object();
                $post_types = (isset($wp_taxonomies[$term->taxonomy])) ? $wp_taxonomies[$term->taxonomy]->object_type : [];
                $file_names[0] = $post_types[0];
            }
        } elseif(is_single()) {
            $type = 'single';
            $css_dir = $css_dir . '/single/';
            $js_dir = $js_dir . '/single/';
            $file_names[] = get_post_type();
        } else
            return;

        foreach ($file_names as $file_name) {
            $min_css = $css_dir . "$file_name.min.css";
            $css = $css_dir . "$file_name.css";
            $min_js = $js_dir . "$file_name.min.js";
            $js = $js_dir . "$file_name.js";

            if(file_exists(LIT_DIR . $min_css)) {
                wp_enqueue_style("Custom-{$type}-css-{$file_name}", LIT_URL . $min_css);
            } elseif(file_exists(LIT_DIR . $css)) {
                wp_enqueue_style("Custom-{$type}-css-{$file_name}", LIT_URL . $css);
            }

            if(file_exists(LIT_DIR . $min_js)) {
                wp_enqueue_script("Custom-{$type}-js-{$file_name}", LIT_URL . $min_js, ['jquery'], false, true);
            } elseif(file_exists(LIT_DIR . $js)) {
                wp_enqueue_script("Custom-{$type}-js-{$file_name}", LIT_URL . $js, ['jquery'], false, true);
            }
        }
    }

    /**
     * 載入全域CSS檔案
     * @hooked wp_enqueue_scripts
     */
    public function load_global_css_files()
    {
        $directory = '/assets/css/global/';
        $files = glob(LIT_DIR . $directory . '*.css');
        foreach ($files as $key => $file) {
            $file_name = pathinfo($file)['filename'];
            $file_base_name = str_replace('.min', '', $file_name);
            $files[$key] = $file_base_name;
        }
        foreach (array_unique($files) as $css_filename) {
            $min_css = "$css_filename.min.css";
            $css = "$css_filename.css";
            if(file_exists(LIT_DIR . $directory . $min_css))
                wp_enqueue_style("Custom-global-css-{$min_css}", LIT_URL . $directory . $min_css);
            elseif(file_exists(LIT_DIR . $directory . $css))
                wp_enqueue_style("Custom-global-css-{$css}", LIT_URL . $directory . $css);
        }
    }

    /**
     * 載入全域CSS檔案
     * @hooked wp_enqueue_scripts
     */
    public function load_global_js_files()
    {
        $directory = '/assets/js/global/';
        $files = glob(LIT_DIR . $directory . '*.js');
        foreach ($files as $key => $file) {
            $file_name = pathinfo($file)['filename'];
            $file_base_name = str_replace('.min', '', $file_name);
            $files[$key] = $file_base_name;
        }
        foreach (array_unique($files) as $js_filename) {
            $min_js = "$js_filename.min.js";
            $js = "$js_filename.js";
            if(file_exists(LIT_DIR . $directory . $min_js))
                wp_enqueue_script("Custom-global-js-{$min_js}", LIT_URL . $directory . $min_js, ['jquery'], false, true);
            elseif(file_exists(LIT_DIR . $directory . $js))
                wp_enqueue_script("Custom-global-js-{$js}", LIT_URL . $directory . $js, ['jquery'], false, true);
        }
    }

    public function load_admin_js_files(){
        $directory = '/assets/js/admin/';
        $files = glob(LIT_DIR . $directory . '*.js');
        foreach ($files as $key => $file) {
            $file_name = pathinfo($file)['filename'];
            $file_base_name = str_replace('.min', '', $file_name);
            $files[$key] = $file_base_name;
        }
        foreach (array_unique($files) as $js_filename) {
            $min_js = "$js_filename.min.js";
            $js = "$js_filename.js";
            if(file_exists(LIT_DIR . $directory . $min_js))
                wp_enqueue_script("Custom-admin-js-{$min_js}", LIT_URL . $directory . $min_js, ['jquery'], false, true);
            elseif(file_exists(LIT_DIR . $directory . $js))
                wp_enqueue_script("Custom-admin-js-{$js}", LIT_URL . $directory . $js, ['jquery'], false, true);
        }
    }
}
$GLOBALS['CustomFunction'] = CustomFunction::get_instance();
