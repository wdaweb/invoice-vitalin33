
<form action="api/add_invoice.php" method="post">  <!--action:要指向的檔案-->
    <div class="pt-3">日期：<input type="date" name="date" ></div> 
    <div class="pt-3">期別：<select name="period" id="">
            <option value="1">1,2月</option>
            <option value="2">3,4月</option>
            <option value="3">5,6月</option>
            <option value="4">7,8月</option>
            <option value="5">9,10月</option>
            <option value="6">11,12月</option>
        </select></div>
        <div class="pt-3">發票號碼：
            <input type="text" name="code"  style="width: 50px;">
            <input type="number" name="number" style="width: 100px;">
        <div class="text-center pt-3">發票金額：
        <input type="number" name="payment" style="width: 150px;">
        </div>
        </div>
        <div class="text-center">
        <input type="submit" value="送出">
        </div>
        

    </form>