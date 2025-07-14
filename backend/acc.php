<fieldset>
    <legend>帳號管理</legend>
    <form action="./api/del_acc.php" method="post">
        <table width="100%">
            <tr class="ct">
                <td width="40%">帳號</td>
                <td width="40%">密碼</td>
                <td width="20%">刪除</td>
            </tr>
            <?php
            $rows=$User->all();
            foreach($rows as $row):
                if($row['acc']!='admin'):
            ?>
            <tr class="ct">
                <td width="40%"><?=$row['acc'];?></td>
                <td width="40%"><?=str_repeat("*",strlen($row['pw']));?></td>
                <td width="20%">
                    <input type="checkbox" name="del[]" id="del" value="<?=$row['id'];?>">
                </td>
            </tr>
            <?php 
            endif;
            endforeach;?>
        </table>
        <div class="ct">
            <input type="submit" value="確定刪除">
            <input type="reset" value="清空選取">
        </div>
    </form>


    <h3 class="ct">新增會員</h3>
<form>
    <div style="color:red;">*請設定您要設定的帳號及密碼(最長12個字元)</div>
    <table>
        <tr>
            <td>Step1:登入帳號</td>
            <td>
                <input type="text" name="acc" id="acc">
            </td>
        </tr>
        <tr>
            <td>Step2:登入密碼</td>
            <td>
                <input type="password" name="pw" id="pw">
            </td>
        </tr>
        <tr>
            <td>Step3:再次確認密碼</td>
            <td>
                <input type="password" name="pw2" id="pw2">
            </td>
        </tr>
        
        <tr>
            <td>Step4:信箱(忘記密碼時使用)</td>
            <td>
                <input type="email" name="email" id="email">
            </td>
        </tr>
        <tr>
            <td>
                <input type="button" value="註冊" onclick="reg()">
            </td>
            <td>
                <input type="reset" value="清除" >
            </td>
        </tr>
    </table>
</form>

<script>
    function reg(){
        let data={
            acc:$('#acc').val(),
            pw:$('#pw').val(),
            pw2:$('#pw2').val(),
            email:$('#email').val(),
        }

        if(data.acc=='' || data.pw=='' || data.pw2=='' || data.email==''){
            alert("不可空白");
        }else if(data.pw != data.pw2){
            alert("密碼錯誤");
        }else{
            //抓資料庫資料做比對，因為不會改變資料庫內容所以用get取得資料就好
            $.get("./api/chk_acc.php",data,(res)=>{
                //parseInt()可以轉為整數，1 or0 true or false
                if(parseInt(res)){
                    alert("帳號重複")
                }else{
                    $.post("./api/reg.php",data,(res)=>{
                        // if(parseInt(res)){
                        //     alert("註冊成功，歡迎加入");
                        //     location.href="?do=login";
                        // }else{
                        //     alert("註冊失敗，請稍後再試");
                        // }
                    })
                }
            })
        }
    }
</script>
</fieldset>