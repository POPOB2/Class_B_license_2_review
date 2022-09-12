<!-- fie>leg>table>tr>td*3 , 寫上標題 -->
<fieldset>
    <legend>目前位置 : 首頁 > 最新文章區</legend>
    <table id="news"> <!-- 新增id 用於變動選項內容 -->
        <tr>
            <td width="30%">標題</td>
            <td width="50%">內容</td>
            <td width="20%"></td>
        </tr>
<!-- -------在tr下方 複製先前做好的back/news.php裡php區域,做修改-------- -->
        <?php
        // $all=$News->math('count','id');//搜尋條件增加一個,['sh'=>1]
        $all=$News->math('count','id',['sh'=>1]);
        // $div=3; // 頁數改為5
        $div=5;
        $pages=ceil($all/$div);
        $now=$_GET['p']??1;
        $start=($now-1)*$div;
        // $rows=$News->all(" limit $start ,$div");//搜尋條件增加一個['sh'=>1],
        $rows=$News->all(['sh'=>1]," limit $start ,$div");
        // foreach($rows as $key => $row){ // 去除$key,改為僅轉為$row
        foreach($rows as $row){
        ?>

        <tr>
            <td class="title clo"><?=$row['title'];?></td> <!-- tr僅留這段,加上class:title -->            
            <!-- 新增下述這段顯示部分內文 -->
            <!-- <td>< ?=mb_substr($row['txt'],0,20);?></td>  -->
            <!-- 並將上述套上span賦予class 並在句尾加上 ... 如下述 -->
            <td>
                <span class="summary"><?=mb_substr($row['txt'],0,20);?>...</span>
                <!-- 複製上述 改成下述 用於置入並隱藏全文 -->
                <span class="full" style="display:none"><?=nl2br($row['txt']);?>...</span>
            </td>
        </tr>

        <?php
        }
        ?>
<!-- ------------------------------------------------------------ -->
    </table>
<!-- ---------table下方複製先前做好的back/news.php裡頁碼區域--------- -->
    <div class="ct"> 
                <?php
                
                if(($now-1)>0){
                    $p=$now-1;
                    echo "<a href='?do=news&p=$p'> < </a>";
                }

                
                for($i=1; $i<=$pages; $i++){
                    $fontsize=($now==$i)?'24px':'16px';
                ?>
                
                <a href="?do=news&p=<?=$i;?>" style="font-size:<?=$fontsize;?>">
                    <?=$i;?>
                </a>

                <?php
                }

                
                if(($now+1)<=$pages){
                    $p=$now+1;
                    echo "<a href='?do=news&p=$p'> > </a>";
                }
                ?>
            </div>
<!-- ------------------------------------------------------------ -->
</fieldset>

<script>
    $(".title").on("click",function(){
        $(this).next().children().toggle()
    })
</script>