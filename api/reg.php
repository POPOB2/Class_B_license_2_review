<?php
include_once "../base.php";

// 在此去除pw2的資料內容後, 儲存POST陣列
unset($_POST['pw2']);
$User->save($_POST);
?>