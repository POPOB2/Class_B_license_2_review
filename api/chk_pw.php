<?php
include_once "../base.php";




// 將chk_acc.php的echo 改成$chk , 且在後方加上密碼欄位
// echo $User->math('count','id',['acc'=>$acc]);
$chk=$User->math('count','id',['acc'=>$_POST['acc'],'pw'=>$_POST['pw']]);

// 新增一個判斷式, 讓使用者可以有session, 值為POST過來的acc
if($chk){
    $_SESSION['user']=$_POST['acc'];
    echo 1;
}else{
    echo 0;
}

?>