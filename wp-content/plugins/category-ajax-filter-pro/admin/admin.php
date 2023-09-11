<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
//TC_CAF_PRO_PATH . 'admin/admin.php';
require_once TC_CAF_PRO_PATH . "admin/updates/CategoryAjaxFilterProBase.php";
class CategoryAjaxFilterPro
{
    public $plugin_file = "caf-pro.php";
    public $responseObj;
    public $licenseMessage;
    public $showMessage = false;
    public $slug = "category-ajax-filter-pro";
    public function __construct()
    {
        add_action('admin_print_styles', [$this, 'SetAdminStyle']);
        $licenseKey = get_option("CategoryAjaxFilterPro_lic_Key", "");
        $liceEmail = get_option("CategoryAjaxFilterPro_lic_email", "");
        CategoryAjaxFilterProBase::addOnDelete(function () {
            delete_option("CategoryAjaxFilterPro_lic_Key");
        });
        if (CategoryAjaxFilterProBase::CheckWPPlugin($licenseKey, $liceEmail, $this->licenseMessage, $this->responseObj, __FILE__)) {
            add_action('admin_menu', [$this, 'ActiveAdminMenu'], 99999);
            add_action('admin_post_CategoryAjaxFilterPro_el_deactivate_license', [$this, 'action_deactivate_license']);
            //$this->licenselMessage=$this->mess;
            //***Write you plugin's code here***
            require_once TC_CAF_PRO_PATH . 'admin/functions.php';
        } else {
            if (!empty($licenseKey) && !empty($this->licenseMessage)) {
                $this->showMessage = true;
            }
            update_option("CategoryAjaxFilterPro_lic_Key", "") || add_option("CategoryAjaxFilterPro_lic_Key", "");
            add_action('admin_post_CategoryAjaxFilterPro_el_activate_license', [$this, 'action_activate_license']);
            add_action('admin_menu', [$this, 'InactiveMenu'], 99999);
        }
    }
    public function SetAdminStyle()
    {
        wp_register_style("CategoryAjaxFilterProLic", TC_CAF_PRO_URL . "admin/updates/_lic_style.css", 10);
        wp_enqueue_style("CategoryAjaxFilterProLic");
    }
    public function ActiveAdminMenu()
    {

        add_menu_page("CategoryAjaxFilterPro", "CAF License", "activate_plugins", $this->slug, [$this, "Activated"], " dashicons-star-filled ");
        //add_submenu_page(  $this->slug, "CategoryAjaxFilterPro License", "License Info", "activate_plugins",  $this->slug."_license", [$this,"Activated"] );

    }
    public function InactiveMenu()
    {
        add_menu_page("CategoryAjaxFilterPro", "Caf License", 'activate_plugins', $this->slug, [$this, "LicenseForm"], " dashicons-star-filled ");

    }
    public function action_activate_license()
    {
        check_admin_referer('el-license');
        $licenseKey = !empty($_POST['el_license_key']) ? $_POST['el_license_key'] : "";
        $licenseEmail = !empty($_POST['el_license_email']) ? $_POST['el_license_email'] : "";
        update_option("CategoryAjaxFilterPro_lic_Key", $licenseKey) || add_option("CategoryAjaxFilterPro_lic_Key", $licenseKey);
        update_option("CategoryAjaxFilterPro_lic_email", $licenseEmail) || add_option("CategoryAjaxFilterPro_lic_email", $licenseEmail);
        update_option('_site_transient_update_plugins', '');
        wp_safe_redirect(admin_url('admin.php?page=' . $this->slug));
    }
    public function action_deactivate_license()
    {
        check_admin_referer('el-license');
        $message = "";
        if (CategoryAjaxFilterProBase::RemoveLicenseKey(__FILE__, $message)) {
            update_option("CategoryAjaxFilterPro_lic_Key", "") || add_option("CategoryAjaxFilterPro_lic_Key", "");
            update_option('_site_transient_update_plugins', '');
        }
        wp_safe_redirect(admin_url('admin.php?page=' . $this->slug));
    }
    public function Activated()
    {
        ?>
        <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
            <input type="hidden" name="action" value="CategoryAjaxFilterPro_el_deactivate_license"/>
            <div class="el-license-container">
                <h3 class="el-license-title"><i class="dashicons-before dashicons-star-filled"></i> <?php _e("Category Ajax Filter Pro License Info", $this->slug);?> </h3>
                <hr>
                <ul class="el-license-info">
                <li>
                    <div>
                        <span class="el-license-info-title"><?php _e("Status", $this->slug);?></span>

                        <?php if ($this->responseObj->is_valid): ?>
                            <span class="el-license-valid"><?php _e("Valid", $this->slug);?></span>
                        <?php else: ?>
                            <span class="el-license-valid"><?php _e("Invalid", $this->slug);?></span>
                        <?php endif;?>
                    </div>
                </li>

                <li>
                    <div>
                        <span class="el-license-info-title"><?php _e("License Type", $this->slug);?></span>
                        <?php echo $this->responseObj->license_title; ?>
                    </div>
                </li>

               <li>
                   <div>
                       <span class="el-license-info-title"><?php _e("License Expired on", $this->slug);?></span>
                       <?php echo $this->responseObj->expire_date;
        if (!empty($this->responseObj->expire_renew_link)) {
            ?>
                           <a target="_blank" class="el-blue-btn" href="<?php echo $this->responseObj->expire_renew_link; ?>">Renew</a>
                           <?php
}
        ?>
                   </div>
               </li>

               <li>
                   <div>
                       <span class="el-license-info-title"><?php _e("Support Expired on", $this->slug);?></span>
                       <?php
echo $this->responseObj->support_end;
        if (!empty($this->responseObj->support_renew_link)) {
            ?>
                               <a target="_blank" class="el-blue-btn" href="<?php echo $this->responseObj->support_renew_link; ?>">Renew</a>
                            <?php
}
        ?>
                   </div>
               </li>
                <li>
                    <div>
                        <span class="el-license-info-title"><?php _e("Your License Key", $this->slug);?></span>
                        <span class="el-license-key"><?php echo esc_attr(substr($this->responseObj->license_key, 0, 9) . "XXXXXXXX-XXXXXXXX" . substr($this->responseObj->license_key, -9)); ?></span>
                    </div>
                </li>
                </ul>
                <div class="el-license-active-btn">
                    <?php wp_nonce_field('el-license');?>
                    <?php submit_button('Deactivate');?>
                </div>
            </div>
        </form>
    <?php
}

    public function LicenseForm()
    {
        ?>
    <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
        <input type="hidden" name="action" value="CategoryAjaxFilterPro_el_activate_license"/>
        <div class="el-license-container">
            <h3 class="el-license-title"><i class="dashicons-before dashicons-star-filled"></i> <?php _e("Category Ajax Filter Pro Licensing", $this->slug);?></h3>
            <hr>
            <?php
if (!empty($this->showMessage) && !empty($this->licenseMessage)) {
            ?>
                <div class="notice notice-error is-dismissible">
                    <p><?php echo _e($this->licenseMessage, $this->slug); ?></p>
                </div>
                <?php
}
        ?>
            <p><?php _e("Enter your license key here, to activate the product, and get full feature updates and premium support.", $this->slug);?></p>
            <div class="el-license-field">
                <label for="el_license_key"><?php _e("License code", $this->slug);?></label>
                <input type="text" class="regular-text code" name="el_license_key" size="50" placeholder="xxxxxxxx-xxxxxxxx-xxxxxxxx-xxxxxxxx" required="required">
            </div>
            <div class="el-license-field">
                <label for="el_license_key"><?php _e("Email Address", $this->slug);?></label>
                <?php
$purchaseEmail = get_option("CategoryAjaxFilterPro_lic_email", get_bloginfo('admin_email'));
        ?>
                <input type="text" class="regular-text code" name="el_license_email" size="50" value="<?php echo esc_attr($purchaseEmail); ?>" placeholder="" required="required">
                <div><small><?php _e("We will send update news of this product by this email address, don't worry, we hate spam", $this->slug);?></small></div>
            </div>
            <div class="el-license-active-btn">
                <?php wp_nonce_field('el-license');?>
                <?php submit_button('Activate');?>
            </div>
        </div>
    </form>
        <?php
}
}

new CategoryAjaxFilterPro();

require_once TC_CAF_PRO_PATH . 'admin/fa-icons/fa-icons-class.php';
