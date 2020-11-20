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

    echo "您要對的發票是".$_GET['year']."年的";
    echo $period_str[$_GET['period']]."的發票";

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
                            echo "<br>您的發票號碼為".$number."<br>";
                            echo "中了特別獎!!! 恭喜您~!!<br>";
                            $allResult=0;
                            }
                            
                    break;
                        
                    case 2:
                            if($award['number']==$number){     //資料型態需要一致
                                echo "<br>您的發票號碼為".$number."<br>";
                                echo "中了特獎!!! 恭喜您~!!<br>";
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
                            echo "<br>您的發票號碼為".$number."<br>";
                            echo "中了{$awardStr[$res]}獎!!! 恭喜您~!!<br>";  //$awardStr因為是不會變更的資料，這個變數在base.php
                            $allResult=0;
                        }
        
                    break;
        
                    case 4:
                        //   $target=mb_substr($award['number'],5,3,'utf8');
                            if($award['number']==mb_substr($number,5,3,'utf8')){
                                echo "<br>您的發票號碼為".$number."<br>";
                                echo "中了增開六獎!!! 恭喜您~!!<br>";  //$awardStr因為是不會變更的資料，這個變數在base.php
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

<!-- 單期全部對獎 -->