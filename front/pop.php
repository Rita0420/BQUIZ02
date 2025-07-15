<style>
.title {
    cursor: pointer;
    color: blue;
}

.title:hover {
    color: green;
}

.pop {
    background: rgba(51, 51, 51, 0.8);
    color: #FFF;
    height: 400px;
    width: 500px;
    position: fixed;
    display: none;
    z-index: 9999;
    overflow: auto;
}
</style>

<div class="nav" style="margin-bottom:20px">
    目前位置:首頁 > 人氣文章區
</div>

<table style="width:95%;margin:auto">
    <tr class="ct">
        <td width="30%">標題</td>
        <td width="50%">內容</td>
        <td>人氣</td>
    </tr>
    <?php
    $total=$News->count();
    $div=3;
    $page=ceil($total/$div);
    $now=$_GET['p']??1;
    $start=($now-1)*$div;
    //desc由大到小
    $rows=$News->all("order by `good` desc limit $start,$div");
    foreach($rows as $idx => $row):
    ?>
    <tr>
        <td class="title"><?=$row['title'];?></td>
        <td>
            <div class="short">
                <?=mb_substr($row['text'],0,30);?>...
            </div>
            <div class="all">
                <div id="alerr" class="pop">
                    <!-- 因為db裡有先寫Type,數字對應資料表裡的type -->
                    <h2><?=$Type[$row['type']];?></h2>
                    <pre id="ssaa"><?=$row['text'];?></pre>
                </div>
            </div>
        </td>
        <td></td>
    </tr>
    <?php endforeach;?>

</table>
<div>
    <?php
if($now-1>0){
    echo "<a href='?do=news&p=".($now-1)."'><</a>";
}
?>
    <?php
for($i=1;$i<=$page;$i++):
    $size=($i==$now)?"24px":"20px";
?>
    <a href="?do=pop&p=<?=$i;?>" style="font-size:<?=$size;?>"><?=$i?></a>
    <?php endfor;?>
    <?php
if($now+1<=$page){
    echo "<a href='?do=pop&p=".($now+1)."'>></a>";
}
?>

    <script>
    $(".title").hover(
        function() {
            $(this).next().find(".pop").show();
        },
        function(){
            $(this).next().find(".pop").hide();
        }
    )
    </script>