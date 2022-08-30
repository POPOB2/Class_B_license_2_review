<fieldset>
    <legend>會員登入</legend>
    <!-- table>tr*3>td*2 -->
    <table>
        <tr>
            <td class="clo">帳號</td>
            <td><input type="text" name="acc" id="acc"></td>
        </tr>
        <tr>
            <td class="clo">密碼</td>
            <td><input type="password" name="pw" id="pw"></td>
        </tr>
        <tr>
            <td>
                <!-- 因為沒有使用action傳值 , 在button新增onclick事件 -->
                <button onclick="login()">登入</button>
                <button onclick="$('#acc,#pw').val('')">清除</button>
            </td>
            <td class="r">
                <a href="?do=forgot">找回密碼</a>|
                <a href="?do=reg">重新註冊</a>
            </td>
        </tr>
    </table>
</fieldset>

<!-- 在表格外新增script , 內容為 影響本頁的onclick -->
<script>
    // 1. 加入login的function取得的acc和pw的資料
    function login(){
        let acc=$('#acc').val();
        let pw=$('#pw').val();
    
    // 2. 取得資料後 在login的function檢查帳號是否存在
    $.post("./api/chk_acc.php",{acc},(res)=>{
        if(parseInt(res)===1){
            // 從api/chk_login.php回來後新增 一個判斷 用於判斷帳號正確時 比對密碼 且回到特定頁面
            // 第二段新增的密碼判段---START---------------------------------------------
            $.post("./api/chk_pw.php",{acc,pw},(res)=>{
                if(parseInt(res)===1){
                    if(acc=='admin'){
                        location.href='back.php'
                    }else{
                        location.href='index.php'
                    }
                }else{
                    alert("密碼錯誤");
                }
            // 第二段新增的密碼判段---END-----------------------------------------------
            })
        }else{
            alert("查無帳號");
        }
    })
}// function_login的結尾


    /* 寫完帳號判斷 => 到api資料夾 建立chk_acc.php */ 
    /* 寫完密碼判斷 => 將api/chk_acc.php複製一份 更名chk_pw.php */ 
</script>