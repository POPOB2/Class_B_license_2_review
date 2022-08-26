<?php
include_once "../base.php";
// 到base新增連線資料表

// 無論 get/post 均可接收
$acc=$POST['acc']??$_GET['acc'];
// 撈資料 並 判斷acc是否存在
echo $User->math('count','id',['acc'=>$acc]);

// 回到front/login.php

?>