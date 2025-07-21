<?php 
include_once "db.php";

$option=$Que->find($_POST['option']);
$subject=$Que->find($option['subject_id']);

$option['vote']++;
//主題票數直接跟著增加
$subject['vote']++;

$Que->save($option);
$Que->save($subject);

to("../index.php?do=result&id={$subject['id']}");

