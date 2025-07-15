<?php include_once "db.php";

$chk=$User->count(['acc'=>$_GET['acc'],'pw'=>$_GET['pw']]);

if($chk){
    echo 1;
    $_SESSION['login']=$_GET['acc'];
}else{
    echo 0;
}