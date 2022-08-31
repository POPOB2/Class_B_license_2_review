<?php
include_once "../base.php";
// 到base新增連線資料表

// 撈資料 並 判斷acc是否存在
echo $User->math('count','id',['acc'=>$_POST['acc']]);
// 回到front/login.php

// $acc=$_POST['acc']??$_GET['acc'];
// echo $User->math('count','id',['acc'=>$acc]);

?>