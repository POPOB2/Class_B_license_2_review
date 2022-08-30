<!-- 註冊的頁面-->
<fieldset>
    <legend>會員註冊</legend>
    <div style="color:red;">請設定您要註冊的帳號及密碼(最長12個字元)</div>
    <!-- table>tr*5>td+(td>input:text) -->
    <table>
        <tr>
            <td>Step1:登入帳號</td>
            <td><input type="text" name="acc" id="acc"></td>
        </tr>
        <tr>
            <td>Step2:登入密碼</td>
            <td><input type="text" name="pw" id="pw"></td>
        </tr>
        <tr>
            <td>Step3:再次確認密碼</td>
            <td><input type="text" name="pw2" id="pw2"></td>
        </tr>
        <tr>
            <td>Step4:信箱(忘記密碼時使用)</td>
            <td><input type="text" name="email" id="email"></td>
        </tr>
        <tr>
            <td>
                <button onclick="reg()">註冊</button>
                <button onclick="$('table input').val('')">清除</button>
            </td>
            <td></td>
        </tr>
    </table>
</fieldset>


<script>
    // 取得上述傳送過來的資料
    function reg(){
        let user={
            acc:$('#acc').val(),
            pw:$('#pw').val(),
            pw2:$('#pw2').val(),
            email:$('#email').val()
        }

        // 新增判斷 , 用於檢查註冊時可能碰到的問題
        if(user.acc=='' || user.pw=='' || user.pw2=='' || user.email==''){
            alert("不可為空白")
        }else if(user.pw!=user.pw2){
            alert("密碼錯誤")
        }else{
            $.get("./api/chk_acc.php",{acc:user.acc},(res)=>{
                if(parseInt(res)==1){
                    alert("帳號重複")
                }else{
                    $.post("./api/chk_acc.php",user,(res)=>{
                        alert("註冊完成,歡迎加入")
                        location.href="?do=login"
                    })
                }
            })
        }



    } // function reg 的結尾
</script>