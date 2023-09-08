<?php
/*
 * Plugin Name: Meihao Translate Chat
 * Description: Meihao Translate Chat
 * Version: 1.0.0
 * Author: Han Hsu
 */
! defined( 'Meihao_TRANSLATE_CHAT_DIR' ) && define( 'Meihao_TRANSLATE_CHAT_DIR', plugin_dir_path( __FILE__ ) );
! defined( 'Meihao_TRANSLATE_CHAT_URL' ) && define( 'Meihao_TRANSLATE_CHAT_URL', plugin_dir_url( __FILE__ ) );

class Meihao_translate_chat{
    private static $instance;
    protected $_panel;
    public function __construct()
    {
        $this->hooks();
    }
    private function hooks()
    {
        add_action('admin_menu', [$this, 'menuBuild']);
        add_shortcode( 'meihao-translate-chat-frontend', [ $this, 'meihao_translate_chat_frontend' ] );

        add_action('wp_enqueue_scripts', [$this, 'load_meihao_css_js_files'], 110);
        add_action( 'admin_enqueue_scripts', [$this, 'admin_enqueue_scripts_callback'] );

        add_action( 'wp_ajax_ajax_translate_text', [$this,'ajax_translate_text'] ); // 210922 抽獎動作
        add_action( 'wp_ajax_nopriv_ajax_translate_text', [$this,'ajax_translate_text'] ); // 210922 抽獎動作
    }

    public static function getInstance()
    {
        if(is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function menuBuild(){
        add_submenu_page('tools.php', '即時文字翻譯設定', '即時文字翻譯設定', 'manage_options', 'meihao-translate-chat', [$this,'meihao_translate_chat']);

    }

    public function load_meihao_css_js_files(){
        global $post;
        if(isset($post->post_content)){
            if( has_shortcode($post->post_content,'meihao-translate-chat-frontend')){
                wp_enqueue_script("meihao-translate-js", Meihao_TRANSLATE_CHAT_URL. 'assets/js/frontend.js', ['jquery'], false, true);
            }
        }
    }
    public function admin_enqueue_scripts_callback(){
        //Add the Select2 CSS file
        wp_enqueue_style( 'select2-css', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css', array(), '4.1.0-rc.0');
        //Add the Select2 JavaScript file
        wp_enqueue_script( 'select2-js', 'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js', 'jquery', '4.1.0-rc.0');

    }

    public function meihao_translate_chat(){
        include_once (Meihao_TRANSLATE_CHAT_DIR.'admin-setting.php');
    }

    public function meihao_translate_chat_frontend(){
        include_once (Meihao_TRANSLATE_CHAT_DIR.'frontend.php');
    }

    public function ajax_translate_text(){
        $options = get_option( 'mtc-option' );
        $prompt = $options['prompt']; $openAIKey = $options['openAIKey']; $Language = $options['translate_languages'];

        $inputLanguage = $_POST['inputLanguage']; $outputLanguage = $_POST['outputLanguage']; $input_text = $_POST['inputText']; // 輸入的文字

        $url = 'https://api.openai.com/v1/engines/text-davinci-003/completions';
        if($input_text == ''){
            $output = ['result'=>'0','text'=>'沒有輸入的文字!'];
            echo json_encode($output);
            die();
        }
        $prompt = sprintf($prompt,$input_text,$Language[$inputLanguage],$Language[$outputLanguage]);
        $content = array(
            'prompt' => $prompt,
            'temperature' => 0.5,
            'max_tokens' => 60,
            'top_p' => 1,
            'n' => 1,
        );

// 設置 HTTP 請求的標頭
        $headers = array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $openAIKey,
        );

// 初始化 cURL，設置請求內容和標頭
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($content));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// 執行 HTTP 請求
        $response = curl_exec($ch);
        if ($response !== false) {
            $result = json_decode($response, true);
            if (isset($result['choices'][0]['text'])) {
                $output_text = $result['choices'][0]['text'];
            }
        }
        $output = ['result'=>'1','text'=>trim($output_text)];

        echo json_encode($output);

        die();


    }
}

add_action('plugins_loaded', array('Meihao_translate_chat', 'getInstance'));
?>