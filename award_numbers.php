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
        <div class="d-inline-block ">
         <div class="row justify-content-around" style="list-style-type: none;padding:0;">
            <li><a href="?do=award_numbers&pd=2020-1">1、2月</a></li>                
            <li><a href="?do=award_numbers&pd=2020-2">3、4月</a></li>
            <li><a href="?do=award_numbers&pd=2020-3">5、6月</a></li>
            <li><a href="?do=award_numbers&pd=2020-4">7、8月</a></li>
            <li><a href="?do=award_numbers&pd=2020-5">9、10月</a></li>
            <li><a href="?do=award_numbers&pd=2020-6">11、12月</a></li>
         </div>


        <table class="table table-bordered table-sm" summary="統一發票中獎號碼單"> 
        <tbody>
         <tr> 
          <th id="months">年月份</th> 
          <td headers="months" class="title"> 
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
          <th id="special_prize" rowspan="2">特別獎</th> 
          <td headers="special_prize" class="number"> 
            <?=$type1;?>
         </tr> 
         <tr> 
          <td headers="special_prize"> 同期統一發票收執聯8位數號碼與特別獎號碼相同者獎金1,000萬元 </td> 
         </tr> 
         <tr> 
          <th id="grand_prize" rowspan="2">特獎</th> 
          <td headers="grand_prize" class="number"> 
            <?=$type2;?>
         </tr> 
         <tr> 
          <td headers="grand_prize"> 同期統一發票收執聯8位數號碼與特獎號碼相同者獎金200萬元 </td> 
         </tr> 
         <tr> 
          <th id="first_prize" rowspan="2">頭獎</th> 
          <td headers="first_prize" class="number">
                <?php 
                    foreach($type3 as $f){

                        echo $f."<br>";

                    }

                ?>
         
         </td> 
         </tr> 
         <tr> 
          <td headers="first_prize"> 同期統一發票收執聯8位數號碼與頭獎號碼相同者獎金20萬元 </td> 
         </tr> 
         <tr hidden> 
          <th id="twoPrize">二獎</th> 
          <td headers="twoPrize"> 同期統一發票收執聯末7 位數號碼與頭獎中獎號碼末7 位相同者各得獎金4萬元 </td> 
         </tr> 
         <tr hidden> 
          <th id="threePrize">三獎</th> 
          <td headers="threeAwards"> 同期統一發票收執聯末6 位數號碼與頭獎中獎號碼末6 位相同者各得獎金1萬元 </td> 
         </tr> 
         <tr hidden> 
          <th id="fourPrize">四獎</th> 
          <td headers="fourPrizes"> 同期統一發票收執聯末5 位數號碼與頭獎中獎號碼末5 位相同者各得獎金4千元 </td> 
         </tr> 
         <tr hidden> 
          <th id="fivePrize">五獎</th> 
          <td headers="fivePrize"> 同期統一發票收執聯末4 位數號碼與頭獎中獎號碼末4 位相同者各得獎金1千元 </td> 
         </tr> 
         <tr hidden> 
          <th id="sixPrize">六獎</th> 
          <td headers="sixPrize"> 同期統一發票收執聯末3 位數號碼與 頭獎中獎號碼末3 位相同者各得獎金2百元 </td> 
         </tr> 
         <tr> 
          <th id="addSix_prize">增開六獎</th> 
          <td headers="addSix_prize" class="number">
          <?php 
                    foreach($type4 as $s){
                        echo $s."<br>";
                    }
         ?>
          </td> 
         </tr> 
        </tbody>
       </table> 
   

       <button class="btn btn-primary mx-auto">
           <a href="?do=award_all&year=<?=$year?>&period=<?=$period?>" class="text-light text-decoration-none">對獎</a>  <!--網址帶參數的東西，網址盡量不要拆開-->
        </button>

       
       </div>