<?php

include_once "base.php";

    $inv_id=$_GET['id'];   //GET跟POST過來的資料應該要先做過濾

    // echo "select * from `invoices` where `id`='$inv_id'";
    $invoice=$pdo->query("select * from `invoices` where `id`='$inv_id'")->fetch();  //只有一筆的話用fetch , 多筆的話用fecthALL()
    
    // echo "<pre>";
    // print_r($invoice);
    // echo "</pre>";

    $number=$invoice['number'];    //取出該筆發票號碼
    
    // 找出獎號：
    /**
     * 1.確認期數 -> 目前的發票日期進行分析
     * 2.得到期數資料 -> 撈出該期的開獎獎號
     * 
     */

    $date=$invoice['date'];  
    /**
     * 方法一：先使用Strtotime取得時間戳記，再用date('m')抓出資料
     * 方法二：用explode的方式將"-"破裂，取出陣列，陣列的第二個元素就是月份  ==> explode('-',$date)
     *
     *
     * 只要取得月份，就可以用月份推算期數，就可以找到開獎號碼
     * 
     * */
    $year=explode('-',$date)[0]; //取出年份
    $period=ceil(explode('-',$date)[1]/2);   //explode取出的是陣列，要取出第二個元素，[]裡要寫上1，ceil是無條件進入

    /**
     * 分段寫的話：
     * $array=explode('-',$date);
     * $month=$array[1];
     * $period=ceil($month/2);
     */
    // echo "select * from award_numbers where year='$year' && period='$period'";
    $awards=$pdo->query("select * from award_numbers where year='$year' && period='$period'")->fetchAll();

    /*一筆對多筆的比對*/

    // echo "<pre>";
    // print_r($awards);
    // echo "</pre>";

    $allResult=-1;
   
    foreach($awards as $award){
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

        if($allResult==-1){
            echo "別灰心，幸運女神終會眷顧您~<br>";
        }

        //作業：請新增中了這個獎會有多少錢
?>