<?php
    //撰寫一支程式來模擬統一發票號碼，
    //並將大量的號碼及發票資訊寫入資料庫以方便做系統測試


    include_once "../base.php";

    $str="ABCEDEFGHIJKLMNOPQRSTUVWXYZ";
    $str_2="0123456789";
    $str_3="123456";
    $startTime=mktime(date("Y"),date("m"));
    $a=date("m"); 

              if($a-6<=0){        // 預設半年內要對發票，所以最久追溯到半年前的測試資料
                $nYear=date("Y")-1;
                $nMonth=date("m")+12;
                $endTime=$nYear."-".$nMonth;
                $endTime=strtotime($endTime);
              }else{
                $nYear=date("Y");
                $nMonth=date("m")-6;
                $endTime=$nYear."-".$nMonth;
                $endTime=strtotime($endTime);
              } 


      for($i=0;$i<10000;$i++){   
        str_shuffle($str);
        $let_1[$i]=substr(str_shuffle($str),0,2);
        str_shuffle($str_2);
        $num_1[$i]=substr(str_shuffle($str_2),0,8);

        $date_1[$i]=date("Y-m",mt_rand($endTime,$startTime));
        $e=substr($date_1[$i],-2,2);
              switch($e){
                
                case "1": case "2":
                  $per_1[$i]=1;
                break;  
                case "3": case "4":
                  $per_1[$i]=2; 
                break;  
                case "5": case "6":
                  $per_1[$i]=3;
                break;  
                case "7": case "8":
                  $per_1[$i]=4;
                break;  
                case "9": case "10":
                  $per_1[$i]=5;
                break;  
                case "11": case "12":
                  $per_1[$i]=6;
                break;  
              }

        $pay_1[$i]=rand(1,99999);
        $f=date("t",strtotime($date_1[$i]));
        $day=rand(1,$f);      


        echo "<br>".$let_1[$i].$num_1[$i]."----".$per_1[$i]."----".$date_1[$i]."-".$day."<br>";

  

          // echo "<pre>";
          // print_r($final[$i]);
          // echo "</pre>";

          // if (empty($let_1[$i])) {
        //   exit();
        // }else{
        // $sql="insert into invoices(`id`,`code`,`number`,`period`,`payment`,`date`,`create_time`)
        // values({'','{$let_1[$i]}','{$num_1[$i]}','{$per_1[$i]}','{$pay_1[$i]}','{$date_1[$i]}."-".$day',''})";   //$變數加不加 {} 都沒關係，但如果是陣列的話一定要加 {}
        //     $pdo->exec($sql);
        //   }
     }

?>
