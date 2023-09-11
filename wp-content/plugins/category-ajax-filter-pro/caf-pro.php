<?php
/*
Plugin Name: Category Ajax Filter PRO
Description: Filter posts/custom post types by category without page reload.Easy to sort/filter and display posts on page with Ajax. It Supports Divi, Elementor and other page builders.
Version: 8.7.5
Author: Trusty Plugins
Author URI: http://trustyplugins.com
License: GPL3
License URI: http://www.gnu.org/licenses/gpl.html
Text Domain: category-ajax-filter-pro
Domain Path: /languages
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
if (!defined('TC_CAF_PRO_PATH')) {
    define('TC_CAF_PRO_PATH', plugin_dir_path(__FILE__));
}
class TC_CAF_PRO
{
    public function __construct()
    {
        add_action('plugins_loaded', array($this, 'tc_caf_pro_load_plugin_data'));
    }
    public function tc_caf_pro_load_plugin_data()
    {
        load_plugin_textdomain('category-ajax-filter-pro', false, basename(dirname(__FILE__)) . '/languages/');
        if (class_exists('TC_CAF_Plugin')) {
            $this->tc_caf_plugin_constants();
            require_once TC_CAF_PRO_PATH . 'admin/admin.php';
            if ($this->check_license() == "Deactivated") {
                add_action('admin_notices', array($this, 'tc_caf_pro_license_error_notice'));
            }
        } else {
            add_action('admin_notices', array($this, 'tc_caf_pro_admin_error_notice'));
        }
    }
    public function check_license()
    {
        $licenseKey = get_option("CategoryAjaxFilterPro_lic_Key", "");
        $liceEmail = get_option("CategoryAjaxFilterPro_lic_email", "");
        CategoryAjaxFilterProBase::addOnDelete(function () {
            delete_option("CategoryAjaxFilterPro_lic_Key");
        });
        if (CategoryAjaxFilterProBase::CheckWPPlugin($licenseKey, $liceEmail, $this->licenseMessage, $this->responseObj, __FILE__)) {
            return "Activated";
        } else {
            return "Deactivated";
        }
    }
    public function tc_caf_pro_admin_error_notice()
    {
        $message = sprintf(esc_html__('The %1$sCategory Ajax Filter PRO %2$s plugin requires %1$sFree Version%2$s plugin active to run properly. Please install and activate %1$sFree Version%2$s of this plugin.', 'category-ajax-filter-pro'), '<strong>', '</strong>');
        printf('<div class="notice notice-error"><p>%1$s</p></div>', wp_kses_post($message));
    }
    public function tc_caf_pro_license_error_notice()
    {
        $message = 'The <b>Category Ajax Filter PRO </b> plugin requires to activate the license. Please Activate the license <a href="admin.php?page=category-ajax-filter-pro">here</a> and enjoy the features.';
        printf('<div class="notice notice-error"><p>%1$s</p></div>', wp_kses_post($message));
    }
    public function tc_caf_plugin_constants()
    {
        if (!defined('TC_CAF_PRO_URL')) {
            define('TC_CAF_PRO_URL', plugin_dir_url(__FILE__));
        }
        if (!defined('TC_CAF_PRO_PATH')) {
            define('TC_CAF_PRO_PATH', plugin_dir_path(__FILE__));
        }
        if (!defined('TC_CAF_PRO_PLUGIN_VERSION')) {
            define('TC_CAF_PRO_PLUGIN_VERSION', '8.7.5');
        }

    }

}
new TC_CAF_PRO();
