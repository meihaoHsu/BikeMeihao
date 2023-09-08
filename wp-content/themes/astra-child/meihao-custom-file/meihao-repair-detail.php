<?php
$repair_title = get_post_meta($post->ID,'repair_title',1);
$repair_phone = get_post_meta($post->ID,'repair_phone',1);
$repair_address = get_post_meta($post->ID,'repair_address',1);

?>
<div >
    <p><label for="repair_title">店家名稱 </label></p>
    <input type="text" name="repair_title" id="repair_title" class="regular-text" placeholder="店家名稱" value="<?=$repair_title?>"></br>
</div>
<div >
    <p><label for="repair_phone">電話 </label></p>
    <input type="text" name="repair_phone" id="repair_phone" class="regular-text" placeholder="電話" value="<?=$repair_phone?>"></br>
</div>
<div >
    <p><label for="repair_address">地址 </label></p>
    <input type="text" name="repair_address" id="repair_address" class="regular-text" placeholder="地址" value="<?=$repair_address?>"></br>
</div>