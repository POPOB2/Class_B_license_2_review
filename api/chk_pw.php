<?php
include_once "../base.php";



$acc=$POST['acc']??$_GET['acc'];
// 將檢查帳號 設成$chk , 且在後方加上密碼欄位
// echo $User->math('count','id',['acc'=>$acc]);
$chk=$User->math('count','id',['acc'=>$acc,'pw'=>$pw]);

// 新增一個判斷式, 讓使用者可以有session
if($chk){
    $_SESSION['user']=$acc;
    echo 1;
}else{
    echo 0;
}

?>