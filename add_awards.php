<?php

    include_once "base.php";
?>

<style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }
</style>

<div class="float-right bg-white vh-100 " style="width:45vw; padding:40px 10% 0 10%">
        <p class="pb-3" style="font-size:1.6rem; color:#333;text-align:center; font-weight:600; ">● 新增發票開獎獎號 ●</p>

<form action="api/add_award_number.php" method="post" >
<table class="table table-sm table-bordered mx-auto" summary="統一發票中獎號碼單"> 
   <tbody>
    <tr> 
     <th class="addawards" style="background-color: rgb(228, 194, 131);" id="months">年月份</th> 
     <td headers="months" class="title addawards_01" style="font-size:15px;"> 
     <input class="" style="font-size:15px;" type="number" name="year" min="<?=date("Y")-1;?>" max="<?=date("Y")+1;?>" step="1" value="<?=date("Y");?>">年 
     <select class="" style="font-size:15px;" name="period" >
         <option value="1">01~02</option>
         <option value="2">03~04</option>
         <option value="3">05~06</option>
         <option value="4">07~08</option>
         <option value="5">09~10</option>
         <option value="6">11~12</option>
     </select>
     月 </td> 
    </tr> 
    <tr> 
     <th class="addawards " style="background-color: rgb(228, 194, 131);" id="special_prize" rowspan="2">特別獎</th> 
     <td headers="special_prize" class="number"> 
         <input type="number" style="width:120px" name="special_prize" maxlength="10" min="00000001" max="99999999"></td> 
    </tr> 
    <tr> 
     <td headers="special_prize"> 同期統一發票收執聯8位數號碼與特別獎號碼相同者獎金1,000萬元 </td> 
    </tr> 
    <tr> 
     <th class="addawards" style="background-color: rgb(228, 194, 131);" id="grand_prize" rowspan="2">特獎</th> 
     <td headers="grand_prize" class="number"> 
     <input type="number" style="width:120px" name="grand_prize" minlength="8" maxlength="8" min="00000001" max="99999999" required></td> 
    </tr> 
    <tr> 
     <td headers="grand_prize"> 同期統一發票收執聯8位數號碼與特獎號碼相同者獎金200萬元 </td> 
    </tr> 
    <tr> 
     <th class="addawards" style="background-color: rgb(228, 194, 131);" id="first_prize" rowspan="2">頭獎</th> 
     <td headers="first_prize" class="number">
     <input type="number" style="width:120px" name="first_prize[]" minlength="8" maxlength="8" min="00000001" max="99999999" required>
     <input type="number" style="width:120px" name="first_prize[]" minlength="8" maxlength="8" min="00000001" max="99999999" required>
     <input type="number" style="width:120px" name="first_prize[]" minlength="8" maxlength="8" min="00000001" max="99999999"required>     
    
    </td> 
    </tr> 
    <tr> 
     <td headers="first_prize"> 同期統一發票收執聯8位數號碼與頭獎號碼相同者獎金20萬元 </td> 
    </tr> 
    <tr > 
     <th style="background-color: rgb(228, 194, 131);text-align: center;font-size: 15px;" id="twoPrize">二獎</th> 
     <td headers="twoPrize"> 同期統一發票收執聯末7 位數號碼與頭獎中獎號碼末7 位相同者各得獎金4萬元 </td> 
    </tr> 
    <tr > 
     <th style="background-color: rgb(228, 194, 131);text-align: center;font-size: 15px;" id="threePrize">三獎</th> 
     <td headers="threeAwards"> 同期統一發票收執聯末6 位數號碼與頭獎中獎號碼末6 位相同者各得獎金1萬元 </td> 
    </tr> 
    <tr > 
     <th style="background-color: rgb(228, 194, 131);text-align: center;font-size: 15px;" id="fourPrize">四獎</th> 
     <td headers="fourPrizes"> 同期統一發票收執聯末5 位數號碼與頭獎中獎號碼末5 位相同者各得獎金4千元 </td> 
    </tr> 
    <tr > 
     <th style="background-color: rgb(228, 194, 131);text-align: center;font-size: 15px;" id="fivePrize">五獎</th> 
     <td headers="fivePrize"> 同期統一發票收執聯末4 位數號碼與頭獎中獎號碼末4 位相同者各得獎金1千元 </td> 
    </tr> 
    <tr > 
     <th style="background-color: rgb(228, 194, 131);text-align: center;font-size: 15px;" id="addSix_prize[]">六獎</th> 
     <td headers="addSix_prize[]"> 同期統一發票收執聯末3 位數號碼與 頭獎中獎號碼末3 位相同者各得獎金2百元 </td> 
    </tr> 
    <tr> 
     <th class="addawards" style="background-color: rgb(228, 194, 131);" id="addSix_prize">增開六獎</th> 
     <td class="addawards_01"  headers="addSix_prize" class="number">
     <input type="number" style="width:120px" name="addSix_prize[]" minlength="3" maxlength="3" min="000" max="999" required>
     <p>&nbsp;</p>
     <input type="number" style="width:120px" name="addSix_prize[]" minlength="3" maxlength="3" min="000" max="999" required>
     <p>&nbsp;</p>
     <input type="number" style="width:120px" name="addSix_prize[]" minlength="3" maxlength="3" min="000" max="999" required>  
     </td> 
    </tr> 
   </tbody>


  </table> 
  <div class="text-center">
            <input type="submit" style="width:120px" value="儲存" class="mx-2 btn btn-primary">
            <input type="reset" style="width:120px" value="清空" class="mx-2 btn btn-warning">
   </div>
 </div> 
</div>
        </div>
    </div>
    </form>

    </div>