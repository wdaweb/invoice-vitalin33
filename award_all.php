<div class="float-right bg-white vh-100 " style="width:45vw; padding:40px 5% 0 5%">
    <p class="pb-3" style="font-size:1.6rem; color:#333;text-align:center; font-weight:600; ">● 本次中獎 ●</p>
    <div class="container d-flex row justify-content-center">
<?php

        include_once "base.php";

    $period_str=[                  //利用傳來的period值，以陣列方式儲存期別所代表的月份，以供顯示
        1=>'1,2月',
        2=>'3,4月',
        3=>'5,6月',
        4=>'7,8月',
        5=>'9,10月',
        6=>'11,12月'

    ];

    echo "<div class='award_title'".$_GET['year']."年";
    echo $period_str[$_GET['period']]."的發票已完成對獎</div>";
    echo "<br>";

    //撈出該期的發票

                        /** mysql取得年份的方式：
                        *  1. YEAR(date)
                        *  2. substr / left / right 函數 ：left(date,長度)
                        **/

    $sql="select * from `invoices` where `period`='{$_GET['period']}' && left(date,4)='{$_GET['year']}' order by date desc";

    $invoices=$pdo->query($sql)->fetchAll();

    // echo "<br>".count($invoices);
    // echo "<pre>";
    // print_r($invoices);
    // echo "</pre>";

    //撈出該期開獎獎號

    $sql="select * from `award_numbers` where `period`='{$_GET['period']}' && `year`='{$_GET['year']}'";
    echo "<br>";
    $awardsNum=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    // if($awardsNum){
    //     echo "<pre>";
    //     print_r($awardsNum);
    //     echo "</pre>";

    // }else{
    //     echo "本期尚未建立開獎獎號";
    // }

        /*開始對獎*/
    foreach($invoices as $inv){
        $number=$inv['number'];
        $date=$inv['date'];
        $year=explode('-',$date)[0]; //取出年份
        $period=ceil(explode('-',$date)[1]/2);
    
            foreach($awardsNum as $award){
                switch($award['type']){
                    case 1:                
                        if($award['number']==$number){     //資料型態需要一致
                            $award_j[]=$number;
                            $award_t[]="特別獎";
                            $money_t[]=10000000;
                            $allResult=0;
                            }
                            
                    break;
                        
                    case 2:
                            if($award['number']==$number){     //資料型態需要一致
                                $award_j[]=$number;
                                $award_t[]="特獎";
                                $money_t[]=2000000;
                                $allResult=0;
                                }
                    break;
                            
                    case 3:
                            $res=-1;
                            // for($i=0;$i<6;$i++){
                            for($i=5;$i>=0;$i--){
        
                                $target=mb_substr($award['number'],$i,(8-$i),'utf8');
                                $mynumber=mb_substr($number,$i,(8-$i),'utf8');
        
                                if($target==$mynumber){     //資料型態需要一致
                                    $res=$i;
                                }else{
                                    break;  //沒有中就停掉了
                                            //控制迴圈的方法：continue & break                            
                                    }
                            }
                         
                            if($res!=-1){
                                $award_j[]=$number;
                                $award_t[]="{$awardStr[$res]}獎";    //$awardStr因為是不會變更的資料，這個變數在base.php
                                switch($awardStr[$res]){
                                    case $res==5:
                                    $money_t[]=200;
                                    break;
                                    case $res==4:
                                    $money_t[]=1000;
                                    break;
                                    case $res==3:
                                    $money_t[]=4000;
                                    break;
                                    case $res==2:
                                    $money_t[]=1000;
                                    break;
                                    case $res==1:
                                    $money_t[]=40000;
                                    break;
                                    case $res==0:
                                    $money_t[]=200000;
                                    break;

                                }

                            $allResult=0;
                        }
        
                    break;
        
                    case 4:
                        //   $target=mb_substr($award['number'],5,3,'utf8');
                            if($award['number']==mb_substr($number,5,3,'utf8')){
                                $award_j[]=$number;
                                $award_t[]="增開六獎";
                                $money_t[]=200;
                                $allResult=0;
                            }
                    break;
                        }
                }
            }     

            if($allResult==-1){
                echo "別灰心，幸運女神終會眷顧您~<br>";
            }


?>
</div>

    <div class=" container d-flex justify-content-center flex-wrap">
    <table>
        <tr class="award_thisth">
            <td class="award_thistd">本期中獎發票總張數</td>
            <td class="award_thistd">本期中發票總金額</td>
        </tr>
        <tr>
            <td class="award_thistd">
                <?php
                echo count($award_j);
                ?>
            </td>
            <td class="award_thistd"><?php
                echo array_sum($money_t);
                ?>
    </table>
    </div>
    <div class=" container d-flex justify-content-center">
    <table class="mt-5">
            <tr class="award_thisth">
                <td class="award_thisth">中獎號碼</td>
                <td class="award_thisth">中獎獎別</td>
                <td class="award_thisth">中獎金額</td>
            </tr>

 
                 <?php
                 for($k=0;$k<count($award_j);$k++){ 
                        echo "<tr class='award_thisp'>";           
                        echo "<td class='award_thisp'>"; //製造格子
                        echo "<p style='color:#242423; font-size:1.2rem; line-height:1.2rem; padding-top:10px;'>".$award_j[$k]."</p>";
                        echo "</td>"; //製造格子
                        echo "<td class='award_thisp'>"; //製造格子
                        echo "<p style='color:#242423; font-size:1.2rem; line-height:1.2rem;padding-top:10px;'>".$award_t[$k]."</p>";
                        echo "</td>"; //製造格子
                        echo "<td class='award_thisp'>"; //製造格子
                        echo "<p style='color:#242423; font-size:1.2rem; line-height:1.2rem;padding-top:10px;'>".$money_t[$k]."</p>";
                        echo "</td>"; //製造格子
                        echo "</tr>";
                }
                 ?>
            </div>
    </table>
    </div>

</div>

<!-- 單期全部對獎 -->