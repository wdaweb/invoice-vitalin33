<h3 class="text-center mt-5">統一發票記錄與對獎</h3>

<div class="container pt-5">
    <div class="col-8 d-flex justify-content-between mx-auto p-3 border">
   
    <?php 

        $month=[
                    1=>"1,2月",
                    2=>"3,4月",
                    3=>"5,6月",
                    4=>"7,8月",
                    5=>"9,10月",
                    6=>"11,12月"
        ];

            $m=ceil(date("m")/2);
    ?>
   
   
   
    <div class="text-center"><?=$month[$m];?></div>
    <div class="text-center">
        <a href="#">當期發票</a>
    </div>
    <div class="text-center">
        
        <a href="#">對獎</a>
    </div>
    <div class="text-center">
        
        <a href="#">輸入獎號</a>
</div>
    </div>
</div>

    <div class="col-5 d-flex justify-content-between mx-auto p-3 border">
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
    </div>

</div>