<?php

$options = get_option( 'mtc-option' );

?>

<div>
    <label>輸入語言</label>
    <select id="inputLanguage" name="inputLanguage">
        <?php foreach ($options['translate_languages'] as $langID => $title):?>
            <option value="<?=$langID?>"><?=$title?></option>
        <?php endforeach;?>
    </select>
    <button type="button" id="changeLanguage">
        <span class="dashicons dashicons-sort"></span>
    </button>
    <label>翻譯語言</label>
    <select id="outputLanguage" name="outputLanguage">
        <?php foreach ($options['translate_languages'] as $langID => $title):?>
            <option value="<?=$langID?>"><?=$title?></option>
        <?php endforeach;?>
    </select>
</div>
<div>
    <textarea id="inputText" name="inputText"></textarea>
    <button id="translate-button">手動翻譯</button>
    <button id="voice-input">語音輸入</button>
</div>
<div>
    <label>翻譯結果</label>
    <textarea id="outputText" name="outputText"></textarea>
</div>
