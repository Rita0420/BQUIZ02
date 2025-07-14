<fieldset>
    <legend>忘記密碼</legend>
    <div>請輸入信箱以查詢密碼</div>
    <div>
        <input type="text" name="email" id="email">
    </div>
    <div id="ans"></div>
    <div>
        <button onclick="search()">尋找</button>
    </div>
</fieldset>
<script>
function search(){
    $.get("./api/chk_email.php",{email:$('#email').val()},(res)=>{
            $('#ans').html(res);
    })
}
</script>
