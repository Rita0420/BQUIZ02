<form action="./api/admin_news.php" method="post">
<table>
    <tr>
        <td>編號</td>
        <td>標題</td>
        <td>顯示</td>
        <td>刪除</td>
    </tr>
    <?php
    $total=$News->count();
    $div=3;
    $page=ceil($total/$div);
    $now=$_GET['p']??1;
    $start=($now-1)*$div;
    $rows=$News->all(" limit $start,$div");
    foreach($rows as $idx => $row):
    ?>

    <tr>
        <td><?=$idx+$start+1;?></td>
        <td><?=$row['title'];?></td>
        <td>
            <input type="checkbox" name="sh[]" id="" value="<?=$row['id'];?>" <?=$row['sh']== 1?"checked":"";?>>
        </td>
        <td>
            <input type="checkbox" name="del[]" id="" value="<?=$row['id'];?>">
        </td>
    </tr>
    <input type="hidden" name="id[]" value="<?=$row['id'];?>">
    <?php endforeach;?>
</table>
<div class="ct">
<?php
if($now-1>0){
    echo "<a href='?do=news&p=".($now-1)."'><</a>";
}
?>
<?php
for($i=1;$i<=$page;$i++):
    $size=($i==$now)?"24px":"20px";
?>
<a href="?do=news&p=<?=$i;?>" style="font-size:<?=$size;?>"><?=$i?></a>
<?php endfor;?>
<?php
if($now+1<=$page){
    echo "<a href='?do=news&p=".($now+1)."'>></a>";
}
?>
</div>
<div class="cent">
    <input type="submit" value="確定修改">
</div>
</form>