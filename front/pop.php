<!-- 將front/news.php複製一份改名為pop.php -->

<!-- 到index.php 搜尋background 將整段div複製後 
     放到這裡建立style, 把值塞進.modal 的class
     把div的id 改成class="modal"
     刪除pre
    -->

   <!-- 原為 -->
   <!-- <div id="alerr" style="background:rgba(51,51,51,0.8); color:#FFF; min-height:100px; width:300px; position:fixed; display:none; z-index:9999; overflow:auto;"> -->
   <!-- <pre id="ssaa"></pre> -->
   <!-- </div> -->
   <!-- 改為 -->
<style>
    .modal{
        background:rgba(51,51,51,0.8); 
        color:#FFF; 
        min-height:100px; 
        width:300px; 
        position:fixed; 
        display:none; 
        z-index:9999; 
        overflow:auto;
    }
</style>
<!-- 改為下述後剪下, 貼到下方顯示內文的區域 -->
<!-- <div class="modal"> -->
	<!-- <pre class="ssaa"></pre> 這個刪除-->
<!-- </div> -->
<!-- ------------------------------------------------------------------------------------------------ -->
<fieldset>
    <legend>目前位置 : 首頁 > 人氣文章區</legend> <!-- 更改標題:人氣文章區 -->
    <table id="pop"> <!-- id改為pop -->
        <tr>
            <td width="30%">標題</td>
            <td width="50%">內容</td>
            <td width="20%">人氣</td> <!-- 補上內容:人氣 -->
        </tr>

        <?php
        
        $all=$News->math('count','id',['sh'=>1]);
        $div=5;
        $pages=ceil($all/$div);
        $now=$_GET['p']??1;
        $start=($now-1)*$div;

        // 複製上面的 $all 並更改為下述
        $all=$News->all(['sh'=>1]," order by good desc limit $start,$div");

        $rows=$News->all(['sh'=>1]," limit $start ,$div");
        foreach($rows as $row){
        ?>

        <tr>
            <td class="title clo"><?=$row['title'];?></td>
            <td>
                <span class="summary"><?=mb_substr($row['txt'],0,20);?>...</span>
                <!-- <span class="full" style="display:none">< ?=nl2br($row['txt']);?>...</span> -->
                <!-- 把上述的< ?=nl2br($row['txt']);?> 剪進下面的modal內, 剩下的刪除 -->
                <!-- 上面更改後貼到這裡 -->
                <div class="modal">
                    <?=nl2br($row['txt']);?>
                </div>
                <!-- ----------------- -->
            </td>
        </tr>

        <?php
        }
        ?>
    </table>

    <div class="ct"> 
                <?php
                
                if(($now-1)>0){
                    $p=$now-1;
                    echo "<a href='?do=news&p=$p'> < </a>";
                }

                
                for($i=1; $i<$pages; $i++){
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
</fieldset>

<script>
    // 新增一個 標題->hover->內文 事件
    $(".title").hover(
        function(){
            $(this).next().children('.modal').show()
        },
        // 將function複製並用逗號隔開把show改hide 增加一個 滑鼠移除時 隱藏顯示的內文 效果
        function(){
            $(this).next().children('.modal').hide()
        }
    )
</script>