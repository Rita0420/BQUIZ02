<fieldset>
    <legend>問卷調查</legend>
    <form action="./api/admin_que.php" method="post">
        <div class="cent" style="display:flex;">
            <div style="width:50%">問卷名稱</div>
            <div style="width:50%">
                <input type="text" name="subject" id="subject">
            </div>
        </div>
        <div class="cent item">
            <label for="">選項</label>
            <input type="text" name="option[]" id="item">
            <button onclick="more()" type="button">更多</button>
            <button type="submit">送出</button>
        </div>
    </form>
</fieldset>

<script>
    function more(){
        let item=`
        <div class="cent item">
            <label for="">選項</label>
            <input type="text" name="option[]" id="item">
        </div>
            `;

        $('.item').append(item);
    }
</script>