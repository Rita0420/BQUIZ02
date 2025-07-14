<?php include_once "db.php";

unset($_POST['pw2']);
//可以直接echo 是因為db裡已經return exec()，exec()本身會回傳值(1 or 0)
echo $User->save($_POST);
