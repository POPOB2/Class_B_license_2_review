<!-- 前台/分類網誌/主題內容 -->

<style>
    .type{
        cursor: pointer;
        color: blue;
        margin: 1px blue;
    }
    .type:hover{
        border-bottom: 1px blue;
    }
</style>


<div>目前位置:首頁 > 分類網誌 > <span id="header">健康新知</span></div>

<div style="display:flex;">
    <fieldset style="width:20%">
        <legend>分類網誌</legend>
        <div class="type">健康新知</div>
        <div class="type">菸害防制</div>
        <div class="type">癌症防治</div>
        <div class="type">慢性病防治</div>
    </fieldset>
    <fieldset style="width:80%">
        <legend>文章列表</legend>
        <div id="content"></div> <!-- 這裡會放文章內容, 用下方script引入 -->
    </fieldset>
</div>

<script>

    // 加入一個script讓畫面一載入就直接讀取到健康新知的項目
    getList('健康新知')



    /* 加入一個click事件
       取得標題內容
       換掉文章內容並取得列表*/
    $(".type").on("click",function(){
        let type=$(this).text()
        $('#header').text(type)
        getList(type);
    })



    // 增加一個取得列表的function
    function getList(type){
        $.get("./api/get_list.php",{type},(list)=>{
            $("#content").html(list)
        })
    }


    // 增加一個取得文章內容的function, 丟到api/get_news.php, 在那邊echo給上方的id:content
    function getNews(id){
        $.get("./api/get_news.php",{id},(news)=>{
            $("#content").html(news)
        })
    }
</script>
