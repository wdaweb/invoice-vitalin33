<?php

    include_once "base.php";

?>

  <div class="float-right bg-white vh-100 " style="width:45vw; padding:40px 5% 0 5%">
    <p class="pb-3" style="font-size:1.6rem; color:#333;text-align:center; font-weight:600; ">● 登錄發票資料 ●</p>
    <div class="addinvoice">
        <form action="api/add_invoice.php" method="post">  <!--action:要指向的檔案-->
            <div class="pt-3 inputlist_inv">日　　期：<input type="date" name="date" ></div> 
            <div class="pt-3 inputlist_inv">期　　別：<select name="period" id="">
                <option value=""></option>
                    <option value="1">當年度1、2月發票</option>
                    <option value="2">當年度3、4月發票</option>
                    <option value="3">當年度5、6月發票</option>
                    <option value="4">當年度7、8月發票</option>
                    <option value="5">當年度9、10月發票</option>
                    <option value="6">當年度11、12月發票</option>
                </select></div>
                <div class="pt-3 inputlist_inv">發票號碼：
                        
                    <input type="text" name="code" style="width: 50px;text-transform:uppercase;">
                    <input type="text" name="number" style="width: 100px;" oninput="value=this.value.replace(/\D/g,'')">
                </div>
                <div class="pt-3 inputlist_inv">發票金額：
                <input type="number" name="payment" style="width: 150px; ">
                </div>
                <div class="text-center mt-5 mb-2">
                <input type="submit" value="送出">
                </div>
            </form>
            </div>


</div>

