<?php

include_once "../base.php";  //要寫入資料庫的資料都要先include base.php

$str="ABCEDEFGHIJKLMNOPQRSTUVWXYZ";
$str_2="0123456789";
$str_3="123456";

echo "資料產生中...........";
echo date("Y-m-d H:i:s");

for($i=0;$i<300;$i++){
    
    //**變數一：code */
    $let_1=substr(str_shuffle($str),0,2);       //要產生一萬個、兩個大寫英文字母
          
    //**變數二：number */
    $num_1=substr(str_shuffle($str_2),0,8);     //8個字元，都是數字，必需得是字串的形態 
                                                    //寫法二：str_pad($number,8,'0',STR_PAD_LEFT)."<br>";
    
    //**變數三：payment */
    $pay_1=rand(1,99999);
    
    
    //**變數四：date */
    $start=strtotime("2020-01-01");
    $end=strtotime("2020-12-31");
    $date=date("Y-m-d",rand($start,$end));         //格式一樣得是字串

    //**變數五：period */
    $period=ceil(explode("-",$date)[1]/2);

    $hope=[                          //陣列內容是欄位名稱去對應我的變數
            'code'=>$let_1,
            'number'=>$num_1,
            'payment'=>$pay_1,
            'date'=>$date,
            'period'=>$period,
    ];  

    $sql="insert into invoices (`".implode("`,`",array_keys($hope))."`) values('".implode("','",$hope)."')";    
    /**因為原語法是POST，如果不想改的話，就讓系統 */
    $pdo->exec($sql);  //新增的話不用用FETCH

}


echo "<hr>";
echo "資料產生完成...........";
echo date("Y-m-d H:i:s");

?>
