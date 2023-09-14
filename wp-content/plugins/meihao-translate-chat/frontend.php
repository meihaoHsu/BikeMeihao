<?php
$options = get_option( 'mtc-option' );
if(isset($_SESSION['trans_logs']) && $_SESSION['trans_logs'] !=''){
    $translate_logs = unserialize($_SESSION['trans_logs']);
}else{
    $translate_logs = array();
}
?>
<div class="pick_lang">
    <select id="inputLanguage" name="inputLanguage">
        <?php foreach ($options['translate_languages'] as $langID => $title):?>
            <option value="<?=$langID?>"><?=$title?></option>
        <?php endforeach;?>
    </select>
    <button type="button" id="changeLanguage">
        <img src="http://bike.meihao.shopping/wp-content/uploads/2023/09/Frame-18630.png">
    </button>
    <select id="outputLanguage" name="outputLanguage">
        <?php foreach ($options['translate_languages'] as $langID => $title):?>
            <option value="<?=$langID?>"><?=$title?></option>
        <?php endforeach;?>
    </select>
</div>
<div>
    <label class="result">輸入內容</label>
    <textarea id="inputText" name="inputText" placeholder="Text or send voice message..."></textarea>
</div>
<div>
    <label class="result">翻譯結果</label>
    <textarea id="outputText" name="outputText" placeholder="Text or send voice message..."></textarea>

</div>
<div class="enter_btn">
    <button id="voice-input"><img src="http://bike.meihao.shopping/wp-content/uploads/2023/09/Frame-18548.png"></button>

    <div class="translate_log">
        <div id="translate-log-open-wrapper">
            <button id="translate-log-open">最近對話內容</button>
        </div>
        <div id="lightbox">
          <div id="translate-log-wrapper" style="display: none;">
            <div id="translate-log-detail">
                <?php foreach($translate_logs as $key => $translate_log):?>
                    <p class="translate-log" >
                        <?=$translate_log?>
                    </p>
                <?php endforeach;?>
            </div>
        </div>
    </div>
        
    </div>

    <button id="translate-button">translation</button>
</div>


