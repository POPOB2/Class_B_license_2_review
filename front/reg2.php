<fieldset>
    <legend>會員註冊</legend>
    <div>紅字區</div>

    <table>
        <tr>
            <td>1</td>
            <td><input type="text" name="acc" id="acc"></td>
        </tr>
        <tr>
            <td>2</td>
            <td><input type="password" name="pw" id="pw"></td>
        </tr>
        <tr>
            <td>3</td>
            <td><input type="password" name="pw2" id="pw2"></td>
        </tr>
        <tr>
            <td>4</td>
            <td><input type="text" name="email" id="email"></td>
        </tr>
        <tr>
            <td>
                <button onclick="reg()">reg</button>
                <button onclick="$('table input').val('')">reset</button>
            </td>
        </tr>
    </table>
</fieldset>

<script>
    function reg(){
        let user={
            acc:$('#acc').val(),
            pw:$('#pw').val(),
            pw2:$('#pw2').val(),
            email:$('#email').val()
        }
        if(user.acc==''||user.pw==''||user.pw2==''||user.email==''||){
            alert('不可為空');
        }else if(user.pw!=user.pw2){
            alert("密碼錯誤")
        }else{
            $.post('./api/chk_acc.php',{user:user.acc},(res)=>{
                if(parseInt(res)==1){
                    alert('帳號重複');
                }else{
                    $.post('./api/reg2.php',user,(res)=>{
                        alert('歡迎加入')
                        location.href='?do=login';
                    })
                }
            })
        }
       
    }
</script>