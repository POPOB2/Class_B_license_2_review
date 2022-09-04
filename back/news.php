<form action="./api/news.php" method="post">
    <table style="width:80%; margin:auto;">
        <tr>
            <th width="10%">編號</th>
            <th width="70%">標題</th>
            <th width="10%">顯示</th>
            <th>刪除</th>
        </tr>


        <?php
            $rows=$News->all();
            foreach($rows as $key => $row){
        ?>


        <tr>
            <td><?=$key+1;?></td>  <!-- 編號的值, +1是因為 系統是從0開始算第一筆資料 -->
            <td><?=$row['title'];?></td>  <!-- 標題內容 -->
             <!-- 若使用複選會有多個值 所以name的值要加上[]作為陣列使用 -->
            <td><input type="checkbox" name="sh[]" value="<?=$row['id'];?>" <?=($row['sh']==1)?'checked':'';?>></td><!-- 3元?該欄值為1時 value為'checked' -->
            <td><input type="checkbox" name="del[]" value="<?=$row['id'];?>"></td>  <!-- value為對應的id -->
            <input type="hidden" name="id[]" value="<?=$row['id'];?>">  <!-- 傳值 傳[被勾選]的id[] -->
        </tr>

            <?php
            }
            ?>

    </table>
    <div class="ct">
        <input type="submit" value="確定修改">
    </div>
</form>