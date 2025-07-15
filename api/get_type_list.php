<?php
include_once "db.php";

$news=$News->all(['type'=>$_GET['type']]);

foreach($news as $new){
    echo "<div>";
    echo "<a href='#' class='post-item' data-post='{$new['id']}'> ";
    echo $new['title'];
    echo "</a>";
    echo "</div>";
}