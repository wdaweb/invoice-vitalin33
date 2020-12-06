
<?php

include_once "base.php";
session_start();

if(isset($_GET['pd'])){
    $period=mb_substr($_GET['pd'],-1);
}else{
    $period=ceil(date("m")/2); 
}

//撰寫新增消費發票的程式碼

// echo "<pre>";
// print_r(array_keys($_POST));
// echo "</pre>";

// echo "<pre>";
// print_r($tmp);
// echo "</pre>";



//將發票的號碼及相關資訊寫入資料庫
// foreach($_POST as $key => $value){  //解晰KEY跟POST的內容
    // echo "欄位".$key."==值".$value."<br>";
//    $tmp[]=$key;    
// }
// foreach($_POST as $key => $value){ 
//    // echo "欄位".$key."==值".$value."<br>";    
//    $tmp2[]=$value;
// }
//--------------------------上面是解析演進史-----------------------
    
    // echo "<pre>";
    // print_r(array_keys($_POST));
    // echo "</pre>";

    $sql="insert into invoices (`".implode("`,`",array_keys($_POST))."`) values('".implode("','",$_POST)."'), ";
    echo $sql;
    $pdo->exec($sql);  //新增的話不用用FETCH

    echo "新增完成";
    $z=date("Y");
    header("location:../main.php?do=invoice_list&pd=$z-$period&page=1");


?>