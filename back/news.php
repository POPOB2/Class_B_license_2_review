<form action="./api/news.php" method="post">
    <table style="width:80%; margin:auto;">
        <tr>
            <th width="10%">編號</th>
            <th width="70%">標題</th>
            <th width="10%">顯示</th>
            <th>刪除</th>
        </tr>


        <?php
            // SET 分頁所需的頁數 相關資料
            $all=$News->math('count','id'); // 撈資料 計算總筆數
            $div=3; // 設定幾筆一頁
            $pages=ceil($all/$div); // 計算總頁數 : 所有資料 除 3筆一頁
            $now=$_GET['p']??1; // 取得當前頁
            $start=($now-1)*$div; // 計算從哪裡開始抓取內容
            // ---------------------------------------------------------


            // $rows=$News->all(); // 改為下述 將all()其內容增加 撈資料的條件
            $rows=$News->all(" limit $start ,$div");
            foreach($rows as $key => $row){
        ?>


        <tr>
            <!-- 編號的值, +1是因為 系統是從0開始算第一筆資料 -->
            <!-- <td>< ?=$key+1;?></td>   -->
            <td><?=$now*$div-2+$key;?></td> <!-- 將上述改為這個算式, 即可對應頁碼顯示正確編號排序 -->
            <td><?=$row['title'];?></td>  <!-- 標題內容 -->
             <!-- 若使用複選會有多個值 所以name的值要加上[]作為陣列使用 -->
            <td><input type="checkbox" name="sh[]" value="<?=$row['id'];?>" <?=($row['sh']==1)?'checked':'';?>></td><!-- 3元?該欄值為1時 value為'checked' -->
            <td><input type="checkbox" name="del[]" value="<?=$row['id'];?>"></td>  <!-- value為對應的id -->
            <input type="hidden" name="id[]" value="<?=$row['id'];?>">  <!-- 編號排序 -->

        </tr>

            <?php
            }
            ?>

    </table>
    <!-- 新增分頁的顯示 用div增設頁碼區塊 -->
            <div class="ct"> 
                <?php
                // 上一頁的功能
                if(($now-1)>0){
                    $p=$now-1;
                    echo "<a href='?do=news&p=$p'> < </a>";
                }

                

                // $i 為頁碼
                for($i=1; $i<=$pages; $i++){
                    $fontsize=($now==$i)?'24px':'16px'; // 用於當前頁放大數字
                ?>
                
                <a href="?do=news&p=<?=$i;?>" style="font-size:<?=$fontsize;?>">
                    <?=$i;?>
                </a>

                <?php
                }

                // 下一頁的功能
                if(($now+1)<=$pages){
                    $p=$now+1;
                    // $p=$pages;
                    echo "<a href='?do=news&p=$p'> > </a>";
                }
                ?>

                


            </div>
    <!-- -----END----- -->
    <div class="ct">
        <input type="submit" value="確定修改">
    </div>
</form>