﻿
<?php
include_once "base.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0039) -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>健康促進網</title>
<link href="./css/css.css" rel="stylesheet" type="text/css">
<script src="./js/jquery-1.9.1.min.js"></script>
<script src="./js/js.js"></script>
</head>

<body>
<div id="alerr" style="background:rgba(51,51,51,0.8); color:#FFF; min-height:100px; width:300px; position:fixed; display:none; z-index:9999; overflow:auto;">
	<pre id="ssaa"></pre>
</div>


	<div id="all">

    	<div id="title">
        <?=date("m 月 d 號 l");?> | 
		今日瀏覽: <?=$Total->find(['date'=>date("Y-m-d")])['total'];?> | 
		累積瀏覽: <?=$Total->math('sum','total');?>
		<a href="index.php" style="float:right">回首頁</a>
		</div>
		

        <div id="title2" title="健康促進網-回首頁">
			<a href="./index.php">
				<img src="./icon/02B01.jpg" >
			</a>
        </div>
        <div id="mm">
        	<div class="hal" id="lef">
				<!-- 將 人氣文章 移到最上方改為 帳號管理, 並將do的路徑更改為user , 其餘文字依題庫更改 -->
				<!-- <a class="blo" href="?do=pop">人氣文章</a> -->
				<a class="blo" href="?do=user">帳號管理</a>
            	<a class="blo" href="?do=po">分類網誌</a>
               	<a class="blo" href="?do=news">最新文章管理</a>
               	<a class="blo" href="?do=know">講座訊息管理</a>
               	<a class="blo" href="?do=que">問卷管理</a>
             </div>
			 
            <div class="hal" id="main">
            	<div>
					
					<marquee style="width:80%; display:inline-block;">
                    	跑馬燈內容
     				</marquee>

                	<span style="width:18%; display:inline-block;">
                    <a href="?do=login">會員登入</a>
                    </span>



                    <div class="content">
						<?php
						$do=$_GET['do']??'main';
						$file="./back/".$do.".php"; // 把front改為back
						if(file_exists($file)){ 
							include $file;
						}else{
							include "./back/main.php"; // 把front改為back
						}
						/* 改完back後, 到back資料夾 新增main.php */ 
						?>
					</div>
                </div>
            </div>
        </div>
        <div id="bottom">
    	    
    	    本網站建議使用：IE9.0以上版本，1024 x 768 pixels 以上觀賞瀏覽 ， Copyright © 2022健康促進網社群平台 All Right Reserved 
    		 <br>
    		 服務信箱：health@test.labor.gov.tw<img src="./icon/02B02.jpg" width="45">
        </div>
    </div>

</body></html>