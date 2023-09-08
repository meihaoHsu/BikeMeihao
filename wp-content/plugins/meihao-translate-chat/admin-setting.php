<?php

$options = get_option( 'mtc-option' );

require_once ABSPATH . 'wp-admin/includes/translation-install.php';
$translations = wp_get_available_translations();

if(isset($_POST) && $_POST['flag']=='true' ){
    $translate_languages = array();
    foreach ($_POST['translate_languages'] as $languageID){
        $translate_languages[$languageID] =$translations[$languageID]['native_name'];
        if($languageID == 'en_US'){
            $translate_languages['en_US']='English (United States)';
        }
    }

    $options = [
        'prompt'=>$_POST['prompt'],
        'type'=>$_POST['type'],
        'openAIKey'=>$_POST['openAIKey'],
        'translate_languages'=>$translate_languages,
    ];

    update_option('mtc-option',$options,1);
}


?>
    <h1>即時文字翻譯設定</h1>
        <form id="translate-setting-form" method="post" action="">
            <input type="hidden" id="flag" name="flag" value="true">
            <table class="form-table" role="presentation">
                <tbody>
                    <tr>
                        <th scope="row">
                            <label for="prompt">提示文字</label>
                        </th>
                        <td>
                            <p style="color:red;"><b>%s</b> 請勿刪除，且需保留三個，第一個是:需翻譯文字、第二個是:原文語言、第三個是:翻譯語言</p>
                            <textarea name="prompt" id="prompt" class="regular-text"><?=$options['prompt']?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="type">模式</label></th>
                        <td>
                            <select name="type" id="type" class="regular-text">
                                <option value="two-way" <?=($options['type'] == 'two-way')?'selected':''?>>雙向</option>
                                <option value="one-way" <?=($options['type'] == 'one-way')?'selected':''?>>單向</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="openAIKey">OpenAI Key</label></th>
                        <td>
                            <input name="openAIKey" id="openAIKey" class="regular-text" value="<?=$options['openAIKey']?>">
                        </td>
                    </tr>

                    <tr>
                        <th scope="row"><label for="translate_languages" >可用語言</label></th>
                        <td>
                            <select name="translate_languages[]" id="translate_languages" multiple class="regular-text">
                                <option value="en_US" <?=in_array('English (United States)',$options['translate_languages'])?'selected':''?> >English (United States)</option>
                                <?php foreach ($translations as $translation):?>
                                    <option value="<?=$translation['language']?>"  <?=in_array($translation['native_name'],$options['translate_languages'])?'selected':''?> ><?=$translation['native_name']?></option>
                                <?php endforeach;?>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php
                submit_button();
            ?>
        </form>
    </div>

    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('#translate_languages').select2();

            $('#translate-setting-form').on('submit',function (e){
                var str = $('#prompt').val();
                var count = (str.match(/\%s/g) || []).length;
                if(count !== 3){
                    alert('提示文字缺少%s!請確認填寫是否正確!');
                    return false;
                }
            });

        });
    </script>
<?php