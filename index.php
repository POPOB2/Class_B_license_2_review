<!-- 新增base檔 -->
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
<!-- 刪除iframe -->
<!-- <iframe name="back" style="display:none;"></iframe> -->
	<div id="all">

    	<div id="title">
        <!-- 1. 固定時間改為date函式 
		     2. 加上a標籤回首頁 靠右
			 3. 今日瀏覽 改為變數
			 4. 累積瀏覽 改為變數  -->
        <?=date("m 月 d 號 l");?> | 
		今日瀏覽: <?=$Total->find(['date'=>date("Y-m-d")])['total'];?> | 
		累積瀏覽: <?=$Total->math('sum','total');?>
		<a href="index.php" style="float:right">回首頁</a>
		</div>
		

		<!-- 在title2 新增title屬性 內容:健康促進網-回首頁 -->
        <div id="title2" title="健康促進網-回首頁">
		<!-- 在該title2內,新增可以回首頁的橫幅 -->
			<a href="./index.php">
				<img src="./icon/02B01.jpg" >
			</a>
        </div>
        <div id="mm">
        		<div class="hal" id="lef">
            		<a class="blo" href="?do=po">分類網誌</a>
               		<a class="blo" href="?do=news">最新文章</a>
               		<a class="blo" href="?do=pop">人氣文章</a>
               		<a class="blo" href="?do=know">講座訊息</a>
               		<a class="blo" href="?do=que">問卷調查</a>
               	</div>
            <div class="hal" id="main">
            	<div>
					<!-- 複製會員登入的sapn,  放在會員登入上方,  18%改80%, 刪除a標籤, 將sapn改成marquee輸入跑馬燈內容 -->
					<marquee style="width:80%; display:inline-block;">
                    	跑馬燈內容
     				</marquee>

                	<span style="width:18%; display:inline-block;">
					<?php
					if(isset($_SESSION['user'])){
						if($_SESSION['user']==='admin'){
					?>

					歡迎,<?=$_SESSION['user'];?>
					<button onclick="location.href='back.php'">管理</button>
					|
					<button onclick="logout()">登出</button>

					<?php
					}else{
					?>

					歡迎,<?=$_SESSION['user'];?>
					<button onclick="logout()">登出</button>

					<?php
					}
					}else{
					?>

					<a href="?do=login">會員登入</a>

					<?php
					}
					?>
                    </span>


                    <!-- 在class加上content -->
					<!-- 切版 :在content的div內新增php -->
                    <div class="content">
						<?php
						$do=$_GET['do']??'main';   // 新增 $do 內容為GET到的do, main為值
						$file="./front/".$do.".php"; // 新增 $file 內容為 路徑:前台資料夾的$do值 檔名
						if(file_exists($file)){ // 若 上述設好路徑的資料夾存在
							include $file; // 連結到該資料夾(用do傳值的檔名)
						}else{
							include "./front/main.php"; //否則到指定位置
						}
						/* 打完這段php之後原地複製整份index.php,  改名為back.php
						   並到front資料夾下 新增一個main.php
						*/
						?>
					</div>
                </div>
            </div>
        </div>
        <div id="bottom">
    	    <!-- 2012改成今年  -->
    	    本網站建議使用：IE9.0以上版本，1024 x 768 pixels 以上觀賞瀏覽 ， Copyright © 2022健康促進網社群平台 All Right Reserved 
    		 <br>
    		 服務信箱：health@test.labor.gov.tw<img src="./icon/02B02.jpg" width="45">
        </div>
    </div>

</body></html>