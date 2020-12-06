<?php 
    include_once "base.php";


        if(isset($_GET['pd'])){
        $year=explode("-",$_GET['pd'])[0];
        $period=explode("-",$_GET['pd'])[1];
    }else{

        $get_news=$pdo->query("SELECT * FROM `award_numbers` ORDER BY year desc, period desc LIMIT 1")->fetch();
        $year=$get_news['year'];
        $period=$get_news['period'];
    }


        // echo "year=".$year;
        // echo "<br>";
        // echo "period=".$period;
    
        $awards=$pdo->query("select * from `award_numbers` where `year`='$year' && `period`='$period'")->fetchALL();
        
        //不同獎別先宣告出來
        $type1="";  //特別獎
        $type2="";  //特獎
        $type3=[];  //頭獎
        $type4=[];  //增開六獎

        foreach($awards as $aw){

            switch($aw['type']){
                case 1:
                    $type1=$aw['number'];       //特別獎
                break;
                case 2:
                    $type2=$aw['number'];       //特獎
                break;
                case 3:
                    $type3[]=$aw['number'];       //頭獎
                break;
                case 4:
                    $type4[]=$aw['number'];       //增開六獎
                break;
            }
        }
?>



        <div class="d-block bg-white" style="padding:40px 10% 0 10%; padding-top:40px; height:100vh;">
            <p class="pb-3 " style="font-size:1.6rem; color:#333;text-align:center; font-weight:600; ">● 本期開獎發票號碼 ●</p>
            <p class="pb-3" style="font-size:1.6rem; color:#333;text-align:center;"><?=date("Y")?>年度</p>
         <div class="row justify-content-around mb-3 " style="list-style-type: none;padding:0;">
            <li><button class="btn btn-warning mb-2 "><a href="?do=award_numbers&pd=2020-1">1、2月</a></button></li>                
            <li><button class="btn btn-warning mb-2 "><a href="?do=award_numbers&pd=2020-2">3、4月</a></button></li>
            <li><button class="btn btn-warning mb-2 "><a href="?do=award_numbers&pd=2020-3">5、6月</a></button></li>
            <li><button class="btn btn-warning mb-2 "><a href="?do=award_numbers&pd=2020-4">7、8月</a></button></li>
            <li><button class="btn btn-warning mb-2 "><a href="?do=award_numbers&pd=2020-5">9、10月</a></button></li>
            <li><button class="btn btn-warning mb-2 "><a href="?do=award_numbers&pd=2020-6">11、12月</a></button></li>
         </div>

         <!--  -->
        <table class="table table-bordered table-sm " style="width:650px" summary="統一發票中獎號碼單"> 
        <tbody>
         <tr> 
          <th class="addawards" style="background-color: rgb(228, 194, 131);" id="months">年月份</th> 
          <td headers="months" class="title addawards_01 text-primary font-weight-bold"> 
        <?php
        $month=[
            1=>"01 ~ 02",
            2=>"03 ~ 04",
            3=>"05 ~ 06",
            4=>"07 ~ 08",
            5=>"09 ~ 10",
            6=>"11 ~ 12"
        ];
            echo $month[$period];
        ?> 月 </td> 
         </tr> 



         <tr> 
          <th class="addawards" style="background-color: rgb(228, 194, 131);" id="special_prize" rowspan="2">特別獎</th> 
          <td headers="special_prize" class="number text-danger font-weight-bold "> 
              <?php
              if(!empty($type1)){
                echo  $type1;
              }else{
                echo "本期尚未開獎 / 尚未輸入開獎獎號";
              }
            ?>
         </tr> 
         <tr> 
          <td headers="special_prize"> 同期統一發票收執聯8位數號碼與特別獎號碼相同者獎金1,000萬元 </td> 
         </tr> 
         <tr> 
          <th class="addawards" style="background-color: rgb(228, 194, 131);" id="grand_prize" rowspan="2">特獎</th> 
          <td headers="grand_prize" class="number text-danger font-weight-bold"> 
          <?php
              if(!empty($type2)){
                echo  $type2;
              }else{
                echo "本期尚未開獎 / 尚未輸入開獎獎號";
              }
            ?>
         </tr> 
         <tr> 
          <td headers="grand_prize"> 同期統一發票收執聯8位數號碼與特獎號碼相同者獎金200萬元 </td> 
         </tr> 
         <tr> 
          <th class="addawards" style="background-color: rgb(228, 194, 131);" id="first_prize" rowspan="2">頭獎</th> 
          <td headers="first_prize" class="number text-danger font-weight-bold">
                <?php 
                    if(!empty($type3)){
                        foreach($type3 as $f){
                            echo $f."<br>";
                        }
                        }else{
                            echo "本期尚未開獎 / 尚未輸入開獎獎號";
                        }
                ?>
         </td> 
         </tr> 
         <tr> 
          <td headers="first_prize"> 同期統一發票收執聯8位數號碼與頭獎號碼相同者獎金20萬元 </td> 
         </tr> 
         <tr> 
          <th style="background-color: rgb(228, 194, 131);text-align: center;font-size: 15px;"  id="twoPrize">二獎</th> 
          <td headers="twoPrize"> 同期統一發票收執聯末7 位數號碼與頭獎中獎號碼末7 位相同者各得獎金4萬元 </td> 
         </tr> 
         <tr> 
          <th style="background-color: rgb(228, 194, 131);text-align: center;font-size: 15px;"  id="threePrize">三獎</th> 
          <td headers="threeAwards"> 同期統一發票收執聯末6 位數號碼與頭獎中獎號碼末6 位相同者各得獎金1萬元 </td> 
         </tr> 
         <tr> 
          <th style="background-color: rgb(228, 194, 131);text-align: center;font-size: 15px;"  id="fourPrize">四獎</th> 
          <td headers="fourPrizes"> 同期統一發票收執聯末5 位數號碼與頭獎中獎號碼末5 位相同者各得獎金4千元 </td> 
         </tr> 
         <tr> 
          <th style="background-color: rgb(228, 194, 131);text-align: center;font-size: 15px;"  id="fivePrize">五獎</th> 
          <td headers="fivePrize"> 同期統一發票收執聯末4 位數號碼與頭獎中獎號碼末4 位相同者各得獎金1千元 </td> 
         </tr> 
         <tr> 
          <th style="background-color: rgb(228, 194, 131);text-align: center;font-size: 15px;" id="sixPrize">六獎</th> 
          <td headers="sixPrize"> 同期統一發票收執聯末3 位數號碼與 頭獎中獎號碼末3 位相同者各得獎金2百元 </td> 
         </tr> 
         <tr> 
          <th class="addawards" style="background-color: rgb(228, 194, 131);" id="addSix_prize">增開六獎</th> 
          <td headers="addSix_prize" class="number text-danger font-weight-bold addawards_01">
          <?php 
                if(!empty($type4)){
                    foreach($type4 as $s){
                        echo $s."<br>";
                    }
                    }else{
                        echo "本期尚未開獎 / 尚未輸入開獎獎號";
                    }
         ?>
          </td> 
         </tr> 
        </tbody>
       </table> 
   
       <div class="d-flex justify-content-center">
       
           <a href="?do=award_all&year=<?=$year?>&period=<?=$period?>" class=" text-decoration-none login_btn text-center py-2 text-secondary">對獎</a>  <!--網址帶參數的東西，網址盡量不要拆開-->
        
        </div>

       
       </div>
