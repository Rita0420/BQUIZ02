<?php
$subject=$Que->find($_GET['id']);
$options=$Que->all(['subject_id'=>$_GET['id']]);
?>
<style>
.line{
    height:24px;
    background-color:#ccc;
}
</style>

<fieldset>
    <legend>目前位置 : 首頁 > 問卷調查 > <?=$subject['text'];?></legend>
    <h3><?=$subject['text'];?></h3>
    <?php
    foreach($options as $key => $option):
        $total=($subject['vote'] == 0)?1:$subject['vote'];
        $rate=$option['vote']/$total;
    ?>
    <div style="display:flex;">
        <div style="width:50%">
            <?=$option['text'];?>
        </div>
        <div style="width:50%;display:flex">
            <div class="line" style="width:<?=$rate*0.8*100;?>%"></div>
            <div class="info" style="width:9%">
                <?=$option['vote'];?>票(<?=round($rate*100);?>%)
            </div>
        </div>
    </div>
    <?php endforeach;?>
    <button onclick="location.href='?do=que'" class="cent">返回</button>
</fieldset>